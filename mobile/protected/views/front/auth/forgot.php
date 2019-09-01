<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Lupa Password';
$this->breadcrumbs=array(
	'Lupa Password',
);
?>
<?php 

	//print_r($query);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1">
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		<!-- Start List Berita -->
		<div class="list-search-berita">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'forgot-form',
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
				<?php echo $form->labelEx($model,'email', array('class'=>'field-title')); ?>
				<?php echo $form->textField($model,'email', array('class'=>'form-control','id'=>'email','placeholder'=>'Email')); ?>
				<?php echo $form->error($model,'email'); ?>
				<div>
					<?php echo CHtml::submitButton('Kirim Ulang Password', array('class'=>'btn')); ?>
				</div>
			</div>
		<?php $this->endWidget(); ?>
		<?php 
			$messages = Yii::app()->user->getFlashes();
			foreach($messages as $key => $message):?>
			<div class="alert alert-dismissable alert-<?php echo $key; ?> errorMessage">
				<?php echo $message; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
