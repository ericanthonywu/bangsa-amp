<?php
/* @var $this MenuGroupController */
/* @var $model MenuGroup */

$this->breadcrumbs=array(
	'Menu Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuGroup', 'url'=>array('index')),
	array('label'=>'Create MenuGroup', 'url'=>array('create')),
	array('label'=>'View MenuGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MenuGroup', 'url'=>array('admin')),
);
?>

<h1>Update MenuGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>