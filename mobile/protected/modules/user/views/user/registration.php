<?php 
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Daftar User");
$this->breadcrumbs=array(
	UserModule::t("Daftar User"),
);
?>

<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1">
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
					<div class="formFieldWrap">
						<?php echo $form->labelEx($model,'Username'); ?>
						<?php echo $form->error($model,'username'); ?>
						<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
					
					</div>
					<div class="formFieldWrap">
						<?php echo $form->labelEx($model,'Password'); ?>
						<?php echo $form->error($model,'password'); ?>
						<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
						<p class="hint">
							<?php echo UserModule::t("Minimal password 4 karakter"); ?>
						</p>
					</div>
					<div class="formFieldWrap">
						<?php echo $form->labelEx($model,'verifyPassword'); ?>
						<?php echo $form->error($model,'verifyPassword'); ?>
						<?php echo $form->passwordField($model,'verifyPassword', array('class'=>'form-control')); ?>						
					</div>
					<div class="formFieldWrap">
						<?php echo $form->labelEx($model,'email'); ?>
						<?php echo $form->error($model,'email'); ?>
						<?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>						
					</div>
					<div class="formFieldWrap">
						<?php 
							$profileFields=$profile->getFields();
							if ($profileFields) {
								foreach($profileFields as $field) {
						?>
						<div class="formFieldWrap">
							<?php echo $form->labelEx($profile,$field->varname); ?>
							<?php 
							if ($widgetEdit = $field->widgetEdit($profile)) {
								echo $widgetEdit;
							} elseif ($field->range) {
								echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
							} elseif ($field->field_type=="TEXT") {
								echo$form->textArea($profile,$field->varname, array('class'=>'form-control'));
							} else {
								echo $form->textField($profile,$field->varname, array('class'=>'form-control'));
							}
							 ?>
							<?php echo $form->error($profile,$field->varname); ?>
						</div>	
								<?php
								}
							}
						?>
					</div>
					<div class="formFieldWrap">
					
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Ketikkan kode verifikasi diatas."); ?>
	</div>
	<?php endif; ?>
					</div>
					<div class="formFieldWrap">
						<?php echo CHtml::submitButton(UserModule::t("Daftar"), array('class'=>'btn')); ?>
					</div>
				
				<?php endif; ?>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div><br /><br />
					<div class="formFieldWrap">
						<a href="<?php echo Yii::app()->createUrl('auth/forgot');?>">Lupa Password</a>
					</div>