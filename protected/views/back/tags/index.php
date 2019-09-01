<?php
/* @var $this EpaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tags',
);
?>
<div class="form-group">
<h1>Tag Berita</h1>
	<div class="pull-right">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
	</div>
	<a class="btn btn-default" href="<?php echo Yii::app()->createUrl('tags/create'); ?>">Tambah Tags</a> 
</div>
	<?php 
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
	<div style="clear: both;"></div>
<?php $this->renderPartial('_tag', array('model'=>$model)); ?>
