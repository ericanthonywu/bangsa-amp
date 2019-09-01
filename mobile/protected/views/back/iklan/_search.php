<?php
/* @var $this IklanController */
/* @var $model Iklan */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
		<div class="pull-left">
			<?php echo $form->textField($model,'judul_iklan',array('class'=>'form-control','placeholder'=>'Ketik Judul Disini')); ?>
		</div>

<?php $this->endWidget(); ?>