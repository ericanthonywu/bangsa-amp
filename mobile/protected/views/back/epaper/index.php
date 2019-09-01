<?php
/* @var $this EpaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'E-Paper',
);
?>
<div class="form-group">
<h1>E-Paper</h1>
	<div class="pull-right">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
	</div>
	<a class="btn btn-default" href="<?php echo Yii::app()->createUrl('epaper/create'); ?>">Tambah E-Paper</a>
</div>
	<?php 
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
<?php $this->renderPartial('_epaper', array('model'=>$model)); ?>
