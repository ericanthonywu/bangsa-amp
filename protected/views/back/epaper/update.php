<?php
/* @var $this EpaperController */
/* @var $model Epaper */

$this->breadcrumbs=array(
	'E-Paper'=>array('index'),
	'Edit',
);
?>

<h1>Edit Epaper</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>