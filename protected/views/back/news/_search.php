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
				echo $form->dropDownList($model, 'news_type', array('1'=>'Berita', '2'=>'Berita Foto', '3'=>'Berita Video'), array('empty' => 'Jenis Berita', 'class'=>'form-control','submit'=>'','placeholder'=>''));
			?>
			
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">	
			Filter
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php 
				echo $form->dropDownList($model, 'news_date', $this->displayDate(), array('empty' => 'Pilih Tanggal', 'class'=>'form-control','submit'=>'','placeholder'=>''));
			?>
			
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">	
			Filter
		</div>
		<div class="pull-left" style="margin:0 10px 0 0;">
			<?php echo $form->dropDownList($model, 'news_status',array(''=>'Status','1'=>'Published ('.News::searchStatus(1).')', '2'=>'Draft ('.News::searchStatus(2).')', '3'=>'Trash ('.News::searchStatus(3).')'), array('class'=>'form-control','submit'=>'','placeholder'=>'')); ?>
		</div>
		<div class="pull-left">
			<?php echo $form->textField($model,'news_title',array('class'=>'form-control','placeholder'=>'Ketik Judul Disini')); ?>
		</div>

<?php $this->endWidget(); ?>