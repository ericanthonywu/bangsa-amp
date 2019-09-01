<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  $model->title=>array('view','id'=>$model->id),
  'Edit',
);
?>

<h1>Edit Polling: <?php echo CHtml::encode($model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'choices'=>$choices)); ?>
