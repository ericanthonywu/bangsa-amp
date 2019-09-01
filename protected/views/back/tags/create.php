<?php
/* @var $this EpaperController */
/* @var $model Epaper */

$this->breadcrumbs=array(
	'Tag'=>array('index'),
	'Tambah',
);
?>

<h1>Tambah Tag Berita</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>