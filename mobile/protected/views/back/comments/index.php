<?php
/* @var $this CommentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Komentar',
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/commentsDo.js', CClientScript::POS_END);
?>

<div class="form-group" style="overflow:hidden;">
	<h1>Komentar</h1>
	<div class="pull-right">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div>
</div>
	<?php
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Semua Halaman</h4>
				</div>
				<div class="panel-body">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'user-grid',
					'selectableRows' => 2,
					'pager'=>array(
						'htmlOptions'=>array(
							'class'=>'pagination pagination-sm'
						)
					),
					'itemsCssClass'=>'table table-condensed table-striped table-bordered table-hover',
					'dataProvider'=>$model->search(),
					'ajaxUpdate'=>false,
					'columns'=>array(
						array(
							'class'=>'CCheckBoxColumn',
							'selectableRows'=>2,
							'htmlOptions'=>array(
								'class'=>'bulk-act'
							)
						),
						array(
							'header'=>'Tanggal',
							'name' => 'comment_date',
							'value'=>'Yii::app()->dateFormatter->format("dd MMMM yyyy",strtotime($data->comment_date))',
						),
						array(
							'header'=>'Komentar Kepada',
							'type'=>'raw',
							'value' =>'Comments::whomever($data->comment_news_id, "id")',
						),
						array(
							'header'=>'',
							'type'=>'raw',
							'value' => 'Comments::approveThis($data->comment_status, $data->comment_id)',
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}',
							'updateButtonImageUrl'=>false,
							'updateButtonLabel' => 'Baca',
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{delete}',
							'deleteButtonImageUrl'=>false,
							'deleteButtonLabel' => 'Hapus',
							'deleteConfirmation' => 'Apakah anda yakin?',
						)
					)
				)); ?>
				</div>
				<div class="panel-footer">
					<div class="col-md-2">
						<select name="mass_act" class="form-control">
							<option value="">Aksi Massal</option>
							<option value="del">Hapus</option>
						</select>
					</div>
					<div class="col-md-2">
						<a href="#" class="btn btn-default" id="applyBulk" data-id="comments" >Apply</a>
					</div>
				</div>
			</div>
		</div>
	</div>