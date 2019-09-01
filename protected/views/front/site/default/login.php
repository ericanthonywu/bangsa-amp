<?php
$title 			= $this->pageTitle="Login User | Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->request->baseUrl ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat";
$keyword 		= "berita jatim,jatim timur,jatim barat,jatim utara,jatim tengah,jatim selatan,jatim metro,jatim madura,portal berita surabaya, protal berita jatim, koran surabaya, korang online, harian bangsa, website koran ";
$url			= Yii::app()->request->requestUri;

// Facebook OG
Yii::app()->facebook->ogTags['og:title'] 		= $title; 
Yii::app()->facebook->ogTags['og:image'] 		= $image; 
Yii::app()->facebook->ogTags['og:site_name'] 	= $sitename;
Yii::app()->facebook->ogTags['og:description'] 	= $description; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

// Meta tag
Yii::app()->clientScript->registerMetaTag($title, 'title');
Yii::app()->clientScript->registerMetaTag($description, 'description');
Yii::app()->clientScript->registerMetaTag($keyword, 'keyword');


$this->breadcrumbs=array(
	'Login User',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb mt1 mb1">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="clearfix"></div>
		<div class="block-login mt1">
			<div class="title-block-login"><h1>Login User</h1></div>
			<div class="content-block-login">
			<?php echo Yii::app()->user->id; ?>
			<p class="note">Field dengan tanda <span class="required">(*)</span> wajib diisi.</p>
				<?php 
					$form = $this->beginWidget('CActiveForm', array(
							'id'						=>'login-form',
							'enableClientValidation'	=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,
							),
					)); 
				?>
					<div class="group_registrasi">
						<?php echo $form->labelEx($model,'username'); ?>
						<?php echo $form->error($model,'username'); ?>
						<?php echo $form->textField($model,'username'); ?>						
					</div>
					<div class="group_registrasi">
						<?php echo $form->labelEx($model,'password'); ?>
						<?php echo $form->error($model,'password'); ?>
						<?php echo $form->passwordField($model,'password'); ?>
						
					</div>
					<div class="group_registrasi">
						<span class="left"><?php echo $form->checkBox($model,'rememberMe'); ?></span>
						<span class="left ml1"><?php echo $form->label($model,'rememberMe'); ?></span>
						<div class="clearfix"></div>
						<?php echo $form->error($model,'rememberMe'); ?>
					</div>
					<div class="group_registrasi">
						<?php echo CHtml::submitButton('LOGIN'); ?>
					</div>
				<?php $this->endWidget(); ?>
				<p><strong>Jika belum mempunyai akun, silahkan register telebih dahulu <a style='color:#01806F' href='<?php echo Yii::app()->createUrl('user/registration'); ?>'>disini</a></strong></p>
			</div>
		</div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>