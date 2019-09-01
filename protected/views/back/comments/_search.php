<?php
/* @var $this NewsController */
/* @var $model News */
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
			echo $form->dropDownList($model, 'comment_date', $this->displayDate(), array('empty' => 'Pilih Tanggal', 'class'=>'form-control','submit'=>'','placeholder'=>''));
			?>
			
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">
			Filter
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php echo $form->dropDownList($model, 'comment_status',array(''=>'Status', '0'=>'Belum Disetujui', '1'=>'Sudah Disetujui'), array('class'=>'form-control','submit'=>'','placeholder'=>'')); ?>
		</div>
<?php $this->endWidget(); ?>