<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'Setting Poling'=>array('index'),
	$model->nama => array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	// array('label'=>'List Setting Poling', 'url'=>array('index')),
);
?>

<h1>Update Setting Polling</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>