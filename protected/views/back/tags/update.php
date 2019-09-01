<?php
/* @var $this EpaperController */
/* @var $model Epaper */

$this->breadcrumbs=array(
	'Tag'=>array('index'),
	'Edit',
);
?>

<h1>Edit Tag Berita</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>