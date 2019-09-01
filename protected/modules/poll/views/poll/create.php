<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  'Create',
);
?>

<h1>Tambah Polling Baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'choices'=>$choices)); ?>
