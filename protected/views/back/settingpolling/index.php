<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */
?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Setting Poling</h4>
				</div>
				<div class="panel-body">
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$model->search(),
						'pager' => array('htmlOptions'=>array('class'=>'pagination pagination-sm')),
						'itemsCssClass'=>'table table-condensed table-striped table-bordered table-hover',
						'id'=>'index-page',
						'ajaxUpdate'=>false,
						'columns'=>array(
							// array(
							// 	'class'=>'CCheckBoxColumn',
							// 	'selectableRows'=>2,
							// 	'htmlOptions'=>array(
							// 		'class'=>'contact'
							// 	)
							// ),
							array(
								'header'=>'Nama',
								'name' => 'nama',
								'value' => '$data->nama',
							),

							array(
								'header'=>'Penempatan',
								'name' => 'value',
								'value'=>'SettingPolling::LabelPoling($data->value)',
							),
							array(
								'class'=>'CButtonColumn',
								'template'=>'{update}',
								'viewButtonImageUrl'=>false,
								'viewButtonLabel' => 'Edit',
							),
							// array(
							// 	'class'=>'CButtonColumn',
							// 	'template'=>'{delete}',
							// 	'deleteButtonImageUrl'=>false,
							// 	'deleteButtonLabel' => 'Hapus',
							// 	'deleteConfirmation' => 'Apakah anda yakin?',
							// )
						),
					)); 
				?>
				</div>
				<div class="panel-footer">

				</div>
			</div>
		</div>
	</div>