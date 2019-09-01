<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Semua E-Paper</h4>
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
									'header'=>'Judul E-Paper',
									'name' => 'title',
									'value' => '$data->title',
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