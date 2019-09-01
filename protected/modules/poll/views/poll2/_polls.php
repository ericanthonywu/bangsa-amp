<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Semua Polling Pemilu</h4>
				</div>
				<div class="panel-body">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
					  'id'=>'poll-grid',
					  'dataProvider'=>$model->search(),
					  'itemsCssClass'=>'table table-condensed table-striped table-bordered table-hover',
					  'ajaxUpdate'=>false,
					  'enableSorting' => false,
					  'columns'=>array(
						array(
							'header'=>'Judul Polling',
							'name'=>'title',
							'value'=>'$data->title'
						),
						// array(
						// 	'header'=>'Deskripsi Polling',
						// 	'value'=>'$data->description'
						// ),
						array(
						  'name' => 'rekayasa',
						  'value' => '($data->rekayasa != 0)? "Ya" : "Tidak"',
						),
						array(
						  'name' => 'date_end',
						  'value' => 'date("d - M - Y", strtotime($data->date_end))',
						),
						array(
						  'name' => 'status',
						  'value' => 'CHtml::encode($data->getStatusLabel($data->status))',
						),
						// array(
						// 	'class'=>'CButtonColumn',
						// 	'template'=>'{view}',
						// 	'viewButtonImageUrl'=>false,
						// 	'viewButtonLabel' => 'Lihat',
						// ),
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