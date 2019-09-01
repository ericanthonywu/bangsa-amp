<div class="row">
	<div class="col-md-12">
		<div class="panel panel-green">
			<div class="panel-heading">
				<h4>Semua Kategori</h4>
			</div>
			<div class="panel-body">
				<table class="table table-condensed table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Nama Kategori</th>
							<th>Deskripsi</th>
							<th>Status</th>
							<th colspan="2"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$roots = Category::model()->roots()->findAll();
							$level = 0;
							if(count($roots) > 0):
							foreach($roots as $n=>$root):
								$level=0;
								$categories = Yii::app()->db->createCommand()->select('category_id, level, category_name, category_description, active')->from('category')->where('root=:root', array(':root'=>$root->root))->order('lft')->queryAll();
								foreach($categories as $n=>$category):
						?>
							<tr>
								<td>
									<?php 
										for($lvl=1;$lvl<$category['level'];$lvl++){echo '&#8212 ';}
										echo $category['category_name'];
									?>
								</td>
								<td>
									<?php 
										echo $category['category_description'];
									?>
								</td>
								<td>
									<?php 
										echo Category::itemAlias("categoryStatus", $category['active']);
									?>
								</td>
								<td>
									<?php echo CHtml::link(CHtml::encode('Edit'), array('category/update', 'id'=>$category['category_id'])); ?>
								</td>
								<td>
									<?php
										echo CHtml::link(CHtml::encode('Hapus'), array('category/delete', 'id'=>$category['category_id']),
										  array(
											'submit'=>array('category/delete', 'id'=>$category['category_id']),
											'class' => 'delete','confirm'=>'Apakah anda yakin?'
										  )
										);
									?>
								</td>
							</tr>
							<?php			
							endforeach;
							endforeach;
							else:?>
								<tr>
									<td colspan="4">Kategori masih belum ada</td>
								</tr>
					<?php	endif;
							?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>