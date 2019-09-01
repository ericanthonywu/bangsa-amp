<?php
/* @var $this EpaperController */
/* @var $model Epaper */
/* @var $form CActiveForm */
?>

<div class="row">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>
		<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">	
			Filter
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php 
				echo $form->dropDownList($model, 'date', $this->displayDate(), array('empty' => 'Pilih Tanggal', 'class'=>'form-control','submit'=>'','placeholder'=>''));
			?>
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php echo $form->textField($model,'title',array('class'=>'form-control', 'placeholder'=>'Ketik judul disini', 'submit'=>'')); ?>
		</div>
	<?php $this->endWidget(); ?>
</div>