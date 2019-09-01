<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Berita'=>array('index'),
	'Edit',
);
?>

<h1>Edit Berita <?php echo $model->news_title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'photos'=>$photos)); ?>