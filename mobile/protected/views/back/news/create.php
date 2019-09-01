<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Berita'=>array('index'),
	'Tambah Berita',
);
?>

<h1>Tambah Berita Baru</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'photos'=>$photos)); ?>