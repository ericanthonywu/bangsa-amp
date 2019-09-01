<?php
$this->breadcrumbs=array(
  'Polling Pemilu'=>array('index'),
  $model->title,
);
?>

<h1><?php echo CHtml::encode($model->title); ?></h1>

<?php if ($model->description): ?>
<p class="description"><?php echo CHtml::encode($model->description); ?></p>
<?php endif; ?>

<?php $this->renderPartial('_results', array('model' => $model)); ?>

<?php if ($userVote->id): ?>
  <p id="pollvote-<?php echo $userVote->id ?>">
    Anda memilih: <strong><?php echo $userChoice->label ?></strong>.<br />
  </p>
<?php else: ?>
  <p><?php echo CHtml::link('Vote', array('/poll/poll2/vote', 'id' => $model->id)); ?></p>
<?php endif; ?>
