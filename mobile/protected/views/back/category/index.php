<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kategori Berita',
);
?>
<h1>Kategori Berita</h1>
<div class="form-group">
	<a class="btn btn-default" href="<?php echo Yii::app()->createUrl('category/create'); ?>">Tambah Kategori Berita</a>
</div>
	<?php 
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
<?php $this->renderPartial('_category'); ?>