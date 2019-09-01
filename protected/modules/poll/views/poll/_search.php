<?php $form=$this->beginWidget('CActiveForm', array(
  'action'=>Yii::app()->createUrl($this->route),
  'method'=>'get',
)); ?>

  <div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">
    <?php echo $form->textField($model,'title',array('class'=>'form-control','submit'=>'', 'placeholder'=>'Ketikkan Judul Polling')); ?>
  </div>

  <div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">
    <?php echo $form->dropDownList($model,'status', array(''=>'Semua', '1'=>'Dibuka', '0'=>'Ditutup'), array('class'=>'form-control','submit'=>'')); ?>
  </div>

<?php $this->endWidget(); ?>
