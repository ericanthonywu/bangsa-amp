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
	<!-- <a class="btn btn-default" href="<?php echo Yii::app()->createUrl('tags/create'); ?>">Tambah Tags</a> -->
</div>
	<?php 
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>

<br>
<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Semua Tags</h4>
				</div>
				<div class="panel-body">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'user-grid',
							'pager' => array('htmlOptions'=>array('class'=>'pagination pagination-sm')),
							'itemsCssClass'=>'table table-condensed table-striped table-bordered table-hover',
							'dataProvider'=>$model->search(),
							'ajaxUpdate'=>false,
							'columns'=>array(
								/*array(
									'class'=>'CCheckBoxColumn',
									'selectableRows'=>2,
									'htmlOptions'=>array(
										'class'=>'page'
									)
								),*/
								array(
									'header'=>'',
									'name' => 'tag_title',
									'value' => '$data->tag_title',
								),

								array(
									'class'=>'CButtonColumn',
									'template'=>'{link_berita}',
									// 'updateButtonImageUrl'=>false,
									// 'updateButtonLabel' => 'Berita Terkait',
									// 'updateButtonUrl' => '',
									'buttons'=>array
										    (
										        'link_berita' => array
										        (
										            'label'=>'View Berita',
										            'imageUrl'=>false,
										            'url'=>'Yii::app()->createUrl("tags/view_berita", array("id"=>$data->id))',
										            'options' => array('class'=>'vw_w125'),
										        )
										    ),
								),

								array(
									'class'=>'CButtonColumn',
									'template'=>'{update}',
									'updateButtonImageUrl'=>false,
									'updateButtonLabel' => 'Edit',
								),
								array(
									'class'=>'CButtonColumn',
									'template'=>'{delete}',
									'deleteButtonImageUrl'=>false,
									'deleteButtonLabel' => 'Hapus',
									'deleteConfirmation' => 'Apakah anda yakin?',
								)
							),
						)); ?>
				</div>
			</div>
		</div>
	</div>

	<style type="text/css">
		.panel-body table tbody td:nth-child(2) {
		    width: 130px;
		}
	</style>
