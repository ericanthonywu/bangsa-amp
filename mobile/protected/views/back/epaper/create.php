<?php
/* @var $this EpaperController */
/* @var $model Epaper */

$this->breadcrumbs=array(
	'E-Paper'=>array('index'),
	'Tambah',
);
?>

<h1>Tambah E-Paper</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>