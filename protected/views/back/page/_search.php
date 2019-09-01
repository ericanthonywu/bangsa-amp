<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get', 
	)); ?>
		<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">	
			Filter
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php 
				echo $form->dropDownList($model, 'page_date', $this->displayDate(), array('empty' => 'Pilih Tanggal', 'class'=>'form-control','submit'=>'','placeholder'=>''));
			?>
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">Filter</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php echo $form->dropDownList($model, 'page_status', array(''=>'Status','1'=>'Published ('.Page::searchStatus(1).')', '2'=>'Draft ('.Page::searchStatus(2).')', '3'=>'Trash ('.Page::searchStatus(3).')'), array('class'=>'form-control','submit'=>'')); ?>
		</div>
		<div class="pull-left">
			<?php echo $form->textField($model,'page_title',array('class'=>'form-control','placeholder'=>'Ketik Judul Disini')); ?>
		</div>
	<?php $this->endWidget(); ?>