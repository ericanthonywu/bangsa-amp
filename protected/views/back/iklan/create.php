<?php
/* @var $this IklanController */
/* @var $model Iklan */

$this->breadcrumbs=array(
	'Iklan'=>array('index'),
	'Create',
);
?>

<h1>Tambah Iklan</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'photos'=>$photos)); ?>