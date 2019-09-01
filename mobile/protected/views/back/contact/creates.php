<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'Pesan'=>array('index'),
	'Kirim Pesan',
);
?>

<h1>Kirim email</h1>

<?php $this->renderPartial('_forms', array('model'=>$model)); ?>