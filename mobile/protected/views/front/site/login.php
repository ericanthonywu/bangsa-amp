<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login User';
$this->breadcrumbs=array(
	'Login User',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
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
					<div class="formFieldWrap">
						<?php echo $form->labelEx($model,'username', array('class'=>'field-title')); ?>
						<?php echo $form->error($model,'username'); ?>
						<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>						
					</div>
					<div class="formFieldWrap">
						<?php echo $form->labelEx($model,'password', array('class'=>'field-title')); ?>
						<?php echo $form->error($model,'password'); ?>
						<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
						
					</div>
					<div class="formFieldWrap">
						<?php echo CHtml::submitButton('LOGIN', array('class'=>'btn','style'=>'padding-bottom:9px;')); ?>
					</div>
				<?php $this->endWidget(); ?>
				<p><strong>Jika belum mempunyai akun, silakan register telebih dahulu.
				<a style='color:#01806F' href='<?php echo Yii::app()->createUrl('user/registration'); ?>'>Daftar disini</a></strong></p>
				<p><strong>Lupa Password? <a style='color:#01806F' href='<?php echo Yii::app()->createUrl('auth/forgot'); ?>'>Klik disini</a></strong></p>
			</div>
		</div>
	</div>
</div>