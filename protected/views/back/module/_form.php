<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'module_name'); ?>
		<?php echo $form->textField($model,'module_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'module_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'module_title'); ?>
		<?php echo $form->textField($model,'module_title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'module_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'module_description'); ?>
		<?php echo $form->textArea($model,'module_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'module_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'module_url'); ?>
		<?php echo $form->textField($model,'module_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'module_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'searchable'); ?>
		<?php echo $form->textField($model,'searchable'); ?>
		<?php echo $form->error($model,'searchable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'access'); ?>
		<?php echo $form->textField($model,'access',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'access'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->