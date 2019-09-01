<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Semua Halaman</h4>
				</div>
				<div class="panel-body">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'user-grid',
							'pager' => array('htmlOptions'=>array('class'=>'pagination pagination-sm')),
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
									'header'=>'Judul Halaman',
									'name' => 'page_title',
									'value' => '$data->page_title',
								),
								array(
									'header'=>'Tanggal Dibuat',
									'name' => 'page_date',
									'value'=>'Yii::app()->dateFormatter->format("dd MMMM yyyy",strtotime($data->page_date))',
								),
								array(
									'header'=>'Penulis',
									'name' => 'page_author',
									'type'=>'raw',
									'value'=>'CHtml::link($data->itemAlias("Author",$data->page_author), array("page/index%2Findex&Page%5Bpage_author%5D=$data->page_author"))',
								),
								array(
									'header'=>'Status',
									'name' => 'page_status',
									'value'=>'Page::itemAlias("Status",$data->page_status)',
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
				<div class="panel-footer">
					<div class="col-md-2">
						<select name="mass_act" class="form-control">
							<option value="">Aksi Massal</option>
							<option value="del">Hapus</option>
						</select>
					</div>
					<div class="col-md-2">
						<a href="javascript:;" class="btn btn-default" id="applyBulk" data-id="page" >Apply</a>
					</div>
				</div>
			</div>
		</div>
	</div>