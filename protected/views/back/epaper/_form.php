<?php
/* @var $this EpaperController */
/* @var $model Epaper */
/* @var $form CActiveForm */
?>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'epaper-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>E-Paper</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'title'); ?>
						<?php echo $form->textField($model,'title',array('class'=>'form-control')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'content'); ?>
						<?php echo $form->textArea($model,'content',array('class'=>'form-control')); ?>
					</div>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default','id'=>'page-upload-button')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>