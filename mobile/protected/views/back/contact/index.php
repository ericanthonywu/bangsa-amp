<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */
if($type == 'send')
	$z = " Terkirim"; 
else 
	$z = " Masuk";
$this->breadcrumbs=array(
	'Pesan'.$z,
);
?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Pesan <?php if($type == 'send')echo "Terkirim"; else echo "Masuk"; ?></h4>
				</div>
				<div class="panel-body">
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$dataProvider->search(),
						'pager' => array('htmlOptions'=>array('class'=>'pagination pagination-sm')),
						'itemsCssClass'=>'table table-condensed table-striped table-bordered table-hover',
						'id'=>'index-page',
						'ajaxUpdate'=>false,
						'columns'=>array(
							array(
								'class'=>'CCheckBoxColumn',
								'selectableRows'=>2,
								'htmlOptions'=>array(
									'class'=>'contact'
								)
							),
							array(
								'header'=>'Nama Pengirim',
								'name' => 'name',
								'value' => '$data->name',
							),
							array(
								'header'=>'Email Pengirim',
								'name' => 'email',
							),
							array(
								'header'=>'Subjek',
								'name' => 'subject',
							),
							array(
								'header'=>'Tanggal',
								'name' => 'quiry_date',
								'value'=>'Yii::app()->dateFormatter->format("dd MMMM yyyy",strtotime($data->quiry_date))',
							),
							array(
								'header'=>'Status',
								'name' => 'is_read',
								'value'=>'Contact::itemAlias("Status", $data->is_read)',
							),
							array(
								'class'=>'CButtonColumn',
								'template'=>'{view}',
								'viewButtonImageUrl'=>false,
								'viewButtonLabel' => 'Baca',
							),
							array(
								'class'=>'CButtonColumn',
								'template'=>'{delete}',
								'deleteButtonImageUrl'=>false,
								'deleteButtonLabel' => 'Hapus',
								'deleteConfirmation' => 'Apakah anda yakin?',
							)
						),
					)); 
				?>
				</div>
				<div class="panel-footer">
					<div class="col-md-2">
						<select name="mass_act" class="form-control">
							<option value="">Aksi Massal</option>
							<option value="del">Hapus</option>
						</select>
					</div>
					<div class="col-md-2">
						<a href="javascript:;" class="btn btn-default" id="applyBulkPage" >Apply</a>
					</div>
				</div>
			</div>
		</div>
	</div>