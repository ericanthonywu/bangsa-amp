<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'portlet-poll-form',
  'enableAjaxValidation'=>false,
  'action'=>''
)); ?>

  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php $template = '<span class="row-choice clearfix"><span class="form-radio">{input}</span><span class="form-label">{label}</span></span>'; ?>
    <?php echo $form->radioButtonList($userVote,'choice_id',$choices,array(
      'template'=>$template,
      'separator'=>'',
      'name'=>'PortletPollVote_choice_id')); ?>
    <?php echo $form->error($userVote,'choice_id'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Vote'); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
