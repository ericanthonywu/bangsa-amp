<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'Setting Poling'=>array('index')
);
?>

<h1>Setting Poling</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'parameter'=>$parameter)); ?>