<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Semua Berita</h4>
				</div>
				<div class="panel-body">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'user-grid',
							'selectableRows' => 2,
							'pager'=>array(
								'htmlOptions'=>array(
									'class'=>'pagination pagination-sm'
								),
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
									'header'=>'Judul Berita',
									'name' => 'news_title',
									'value' => '$data->news_title',
								),
								array(
									'header'=>'Tanggal Dibuat',
									'name' => 'news_date',
									'value'=>'Yii::app()->dateFormatter->format("dd MMMM yyyy",strtotime($data->news_date))',
									'htmlOptions'=>array(
										'width'=>'140'
									)
								),
								array(
									'header'=>'Penulis',
									'name' => 'news_author',
									'type'=>'raw',
									'value'=>'CHtml::link($data->itemAlias("Author",$data->news_author), array("news/index%2Findex&Page%5Bpage_author%5D=$data->news_author"))',
								),
								array(
									'header'=>'Status',
									'name' => 'news_status',
									'value'=>'News::itemAlias("Status",$data->news_status)',
								),
								array(
									'header'=>'Kategori',
									'value'=>'News::category($data)',
									'htmlOptions'=>array(
										'width'=>'240'
									)
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
						<a href="javascript:;" class="btn btn-default" id="applyBulk" data-id="news" >Apply</a>
					</div>
				</div>
			</div>
		</div>
	</div>