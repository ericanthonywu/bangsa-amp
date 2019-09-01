<?php
/* @var $this KanalController */
$title 			= "Penulis Remaja Harian Bangsa";
$url		 	= Yii::app()->getBaseUrl(true)."/kanal/writer/write";


/* Facebook Open Graph */
Yii::app()->facebook->ogTags['og:title'] 		= $title; 
Yii::app()->facebook->ogTags['og:image'] 		= ""; 
Yii::app()->facebook->ogTags['og:site_name'] 	= "Harian Bangsa Online"; 
Yii::app()->facebook->ogTags['og:description'] 	= "Jadi wartawan itu mengasyikkan, yuk gabung jadi penulis."; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

$this->pageTitle=Yii::app()->name . ' - '.$title;
$this->breadcrumbs=array( 'Teenage Journalism','Write' );
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="title-category"><h1><?php echo $title; ?></h1></div>	
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		<div class="list-category-berita">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'journalism-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
		)); 
			if(!Yii::app()->user->isGuest):?>
			<div class="row mb1">
				<div class="span2">
					Nama
				</div>
				<div class="span5">
					<?php echo $form->textField($model,'news_penulis',array('class'=>'form-control', 'placeholder'=>'Tulis nama mu')); ?>
				</div>
			</div>
			<div class="row mb1">
				<div class="span2">
					Ide
				</div>
				<div class="span5">
					<?php echo $form->textField($model,'news_title',array('class'=>'form-control', 'placeholder'=>'Tulis judul ide mu')); ?>
				</div>
			</div>
			<div class="row mb1">
				<div class="span2">
					Isi Berita
				</div>
				<div class="span5">
					<?php echo $form->textArea($model,'news_content',array('class'=>'form-control', 'placeholder'=>'Tulis isi ide mu', 'style'=>'max-width:495px;min-width:495px;min-height:200px;')); ?>
				</div>
			</div>
			<div class="row">
				<div class="span2">
					Gambar Berita
				</div>
				<div class="span5">
					<?php 
					$url = Yii::app()->createUrl('kanal/writer/upload');
					$this->widget('xupload.XUpload', array(
															'url' => $url,
															'model' => $photos,
															'attribute' => 'journalismfile',
															'multiple' => false,
															'htmlOptions' => array('id'=>'journalism-form'),
															'options' => array(
																'maxNumberOfFiles'=>1,
																'maxFileSize' => 2000000,
																'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
																'submit' => "js:function (e, data) {
																	var inputs = data.context.find(':input');
																	data.formData = inputs.serializeArray();
																	return true;
																}",
															),
															'formView' => 'application.views.front.kanal._form',
															'downloadView' => 'application.views.front.kanal._download',
															'uploadView' => 'application.views.front.kanal._upload',
									));
					?>
				</div>
				<?php
				// <div class="clear"></div>
				// <div>
				// Validasi
				// $this->widget('application.extensions.recaptcha.EReCaptcha', 
						// array('model'=>$model, 'attribute'=>'validacion',
								 // 'theme'=>'red', 'language'=>'id_ID', 
								 // 'publicKey'=>'6Lck7O8SAAAAAE5wKHyyvFjI-YzzQxYbOVD1D7zr'));
				 // echo CHtml::error($model, 'validacion'); 
				// </div>
				?>
				<input type="submit" name="submit" value="Kirim Tulisan" />
			</div>
		<?php else:
				$loginUrl = Yii::app()->createUrl('user/login');
				$registerUrl = Yii::app()->createUrl('user/registration');
				echo "<strong>Anda belum Login, untuk menulis berita anda harus login terlebih dahulu . Login <a style='color:#01806F' href='$loginUrl'>disini</a></strong>
					<br/> <strong>Jika belum mempunyai akun, silahkan register telebih dahulu <a style='color:#01806F' href='$registerUrl'>disini</a></strong>";
			endif;?>
		</div>
<?php $this->endWidget(); ?>
	</div>
	
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>