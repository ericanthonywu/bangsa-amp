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
								array(
									'class'=>'CCheckBoxColumn',
									'selectableRows'=>2,
									'htmlOptions'=>array(
										'class'=>'bulk-act'
									)
								),
								array(
									'header'=>'Judul Tag',
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
				<div class="panel-footer">
					<div class="col-md-2">
						<select name="mass_act" class="form-control">
							<option value="">Aksi Massal</option>
							<option value="del">Hapus</option>
						</select>
					</div>
					<div class="col-md-2">
						<a href="javascript:;" class="btn btn-default" id="applyBulk" data-id="tags" >Apply</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style type="text/css">
		.panel-body table tbody td:nth-child(2) {
		    width: 130px;
		}
	</style>
	<script type="text/javascript">
		function getValueUsingClass(){
			var chkArray = [];
			/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
			$(".bulk-act input[type=checkbox]:checked").each(function() {
				chkArray.push($(this).val());
			});
			/* we join the array separated by the comma */
			var selected;
			selected = chkArray.join(',') + ",";
			return selected;
		}

		$(document).ready(function(){
			
			$('#applyBulk').click(function(){
				z = $(this).attr('data-id');

				if($('select[name=mass_act]').val() == 'del'){
					$.ajax({
						type: 'POST',
						url: 'kelola.php?r='+z+'/DelActAjax',
						data: {ajaxCall: getValueUsingClass() },
						// beforeSend:  function(data){
						// 	// window.location.reload(true);
						// }
					}).done(function(data){
						// console.log(data);
						// return false;
						window.location.reload(true);
					});

				}
				else{}
			});
		});
	</script>