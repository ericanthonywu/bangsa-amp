<?php
/* @var $this IklanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Iklan',
);
?>
<div class="form-group" style="overflow:hidden;">
	<h1>Iklan</h1>
	<div class="pull-right">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div>
	<a class="btn btn-default" href="<?php echo Yii::app()->createUrl('iklan/create'); ?>">Tambah Iklan</a>
</div>
	<?php 
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
	<?php $this->renderPartial('_iklan', array('model'=>$model)); ?>