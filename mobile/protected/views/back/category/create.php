<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Kategori'=>array('index'),
	'Tambah Kategori Berita',
);
?>

<h1>Tambah Kategori Berita</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>