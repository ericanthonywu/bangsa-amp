<?php
$this->breadcrumbs=array(
  'Polling Pemilu',
);
?>
<div class="form-group" style="overflow:hidden;">
	<h1>Polling Pemilu</h1>
	<div class="pull-right">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div>
	<a class="btn btn-default" href="<?php echo Yii::app()->createUrl('/poll/poll2/create'); ?>">Tambah Polling Baru</a>
</div>
	<?php 
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
	<?php $this->renderPartial('_polls', array('model'=>$model)); ?>