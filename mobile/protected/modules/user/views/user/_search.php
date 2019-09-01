<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

	<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">
		Filter Level User
    </div>
	<div class="pull-left" style="margin:0 10px 0 0;">
        <?php echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatuss'), array('class'=>'form-control','submit'=>'')); ?>
    </div>

	<div class="pull-left" style="margin:0 10px 0 0;line-height:30px;">
		Filter Status
    </div>
	<div class="pull-left" style="margin:0 10px 0 0;">
        <?php echo $form->dropDownList($model,'status',$model->itemAlias('UserStatuss'), array('class'=>'form-control','submit'=>'')); ?>
    </div>
	
	<div class="pull-left" style="margin:0 10px 0 0;">
        <?php echo $form->textField($model,'username',array('class'=>'form-control','submit'=>'','placeholder'=>'Ketik Username Disini')); ?>
    </div>

	<div class="pull-left">
        <?php echo $form->textField($model,'email',array('class'=>'form-control','submit'=>'','placeholder'=>'Ketik Email Disini')); ?>
    </div>


<?php $this->endWidget(); ?>