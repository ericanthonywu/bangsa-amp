<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>

<?php 
$form = $this->beginWidget('CActiveForm', array(
	'id'						=> 'login-form',
	'enableClientValidation'	=> true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array(
        'class'=>	'form-horizontal',
    ),
)); ?>
<div class="panel-body">
	<h4 class="text-center" style="margin-bottom: 25px;">Halaman Administrator</h4>
	<div class="form-group" style="text-align:left!important;">
		<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'username', array('for'=>'username','class'=>'control-label col-sm-4','style'=>'text-align: left;')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model,'username', array('class'=>'form-control','id'=>'username','placeholder'=>'Username')); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'password', array('for'=>'password','class'=>'control-label col-sm-4','style'=>'text-align: left;')); ?>
		<div class="col-sm-8">
			<?php echo $form->passwordField($model,'password', array('class'=>'form-control','id'=>'password','placeholder'=>'Password')); ?>
		</div>
	</div>
	<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary btn-block btn-green')); ?>
</div>
<?php $this->endWidget(); ?>
