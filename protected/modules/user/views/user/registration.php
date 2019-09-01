<?php
$title 			= $this->pageTitle="Daftar User | Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->request->baseUrl ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat";
$keyword 		= "jatim,jatim timur";
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
	UserModule::t("Daftar User"),
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
		<div class="block-registrasi mt1">
			<div class="title-block-registrasi"><h1><?php echo UserModule::t("Daftar User"); ?></h1></div>
			<div class="content-block-registrasi">
				<?php 
					$form =$this->beginWidget('UActiveForm', array(
						'id'					=> 'registration-form',
						'enableAjaxValidation'	=> true,
						'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
						'htmlOptions' => array('enctype'=>'multipart/form-data'),
					)); 
				?>
				<?php if(Yii::app()->user->hasFlash('registration')): ?>
					<div class="success">
						<?php echo Yii::app()->user->getFlash('registration'); ?>
					</div>
				<?php else: ?>
					<p class="note"><?php echo UserModule::t('Field dengan tanda <span class="required">(*)</span> wajib diisi.'); ?></p>
					<?php //echo $form->errorSummary(array($model,$profile)); ?>
					<div class="group_registrasi">
						<?php echo $form->labelEx($model,'Username'); ?>
						<?php echo $form->error($model,'username'); ?>
						<?php echo $form->textField($model,'username'); ?>
					
					</div>
					<div class="group_registrasi">
						<?php echo $form->labelEx($model,'Password'); ?>
						<?php echo $form->error($model,'password'); ?>
						<?php echo $form->passwordField($model,'password'); ?>
						<p class="hint">
							<?php echo UserModule::t("Minimal password 4 karakter"); ?>
						</p>
					</div>
					<div class="group_registrasi">
						<?php echo $form->labelEx($model,'verifyPassword'); ?>
						<?php echo $form->error($model,'verifyPassword'); ?>
						<?php echo $form->passwordField($model,'verifyPassword'); ?>						
					</div>
					<div class="group_registrasi">
						<?php echo $form->labelEx($model,'email'); ?>
						<?php echo $form->error($model,'email'); ?>
						<?php echo $form->textField($model,'email'); ?>						
					</div>
					<div class="group_registrasi">
						<?php 
							$profileFields=$profile->getFields();
							if ($profileFields) {
								foreach($profileFields as $field) {
						?>
						<div class="group_registrasi">
							<?php echo $form->labelEx($profile,$field->varname); ?>
							<?php 
							if ($widgetEdit = $field->widgetEdit($profile)) {
								echo $widgetEdit;
							} elseif ($field->range) {
								echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
							} elseif ($field->field_type=="TEXT") {
								echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
							} else {
								echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
							}
							 ?>
							<?php echo $form->error($profile,$field->varname); ?>
						</div>	
								<?php
								}
							}
						?>
					</div>
					<div class="group_registrasi">
					
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Ketikkan kode verifikasi diatas."); ?>
	</div>
	<?php endif; ?>
					</div>
					<div class="group_registrasi">
						<?php echo CHtml::submitButton(UserModule::t("Daftar")); ?>
					</div>
				
				<?php endif; ?>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>