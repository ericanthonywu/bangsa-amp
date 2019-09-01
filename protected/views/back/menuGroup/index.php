<?php
/* @var $this MenuGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menu Groups',
);

$this->menu=array(
	array('label'=>'Create MenuGroup', 'url'=>array('create')),
	array('label'=>'Manage MenuGroup', 'url'=>array('admin')),
);
?>

<h1>Menu Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
