<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Semua Halaman'=>array('index'),
	'Edit',
);
?>
<h1>Edit Halaman <?php echo $model->page_title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'photos'=>$photos)); ?>