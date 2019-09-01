<?php
/* @var $this IklanController */
/* @var $model Iklan */

$this->breadcrumbs=array(
	'Iklan'=>array('index'),
	'Update',
);
?>

<h1>Edit Iklan <?php echo $model->judul_iklan; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'photos'=>$photos)); ?>