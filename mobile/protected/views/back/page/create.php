<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Semua Halaman'=>array('index'),
	'Tambah Halaman Baru',
);
?>

<h1>Tambah Halaman</h1>
<?php $this->renderPartial('_form', array('model'=>$model, 'photos'=>$photos)); ?>
