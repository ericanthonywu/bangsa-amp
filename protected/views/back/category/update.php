<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Kategori'=>array('index'),
	'Edit',
);
?>

<h1>Edit Kategori <?php echo $model->category_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>