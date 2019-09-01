<div class="row">
	<div class="col-md-3">
		<div class="panel panel-primary panel-green">
			<div class="panel-heading"><h4>Kategori</h4></div>
			<div class="panel-body">
				<div class="content-manager">
				<?php 	$kategoris = Yii::app()->db->createCommand()->select('category_id, category_name, level')->from('category')->where('active=1')->queryAll();
						if(count($kategoris)>0):
						foreach($kategoris as $kategori):?>
							<div class="alert btn-green strshp draggable" data-kid="" data-id="<?php echo $kategori['category_id']; ?>" data-type="category">
								<span class="text"><?php echo " ".$kategori['category_name']; ?></span>
								<div class="block-holder pull-right">
									<a class="ajaxContentDelete" href="javascript:;">
										<i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i>
									</a>
								</div>
								<div class="block-holder pull-right">
									<label class="">Category | </label>
									<label><input type="radio" name="jenisBlok[<?php echo $kategori['category_id']; ?>]" value="1" checked="checked" /> Style 1</label>
									<label style="margin:0 10px 0 0;"><input type="radio" name="jenisBlok[<?php echo $kategori['category_id']; ?>]" value="2" /> Style 2</label>
								</div>
							</div>
				<?php 	endforeach; ?>
				<?php 	else:?>
						Kategori Masih Belum Ada
				<?php 	endif;?>
				</div>
			</div>
		</div>
		<div class="panel panel-primary panel-green">
			<div class="panel-heading"><h4>Iklan</h4></div>
			<div class="panel-body">
				<div class="content-manager">
				<?php 	$iklans = Yii::app()->db->createCommand()->select('id, judul_iklan')->from('module_iklan')->queryAll();
						if(count($iklans)>0):
						foreach($iklans as $iklan):?>
							<div class="alert btn-primary strshp draggable" data-kid="" data-id="<?php echo $iklan['id']; ?>" data-type="iklan">
								<span class="text"><?php echo " ".$iklan['judul_iklan']; ?></span>
								<div class="block-holder pull-right">
									<a class="ajaxContentDelete" href="javascript:;">
										<i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i>
									</a>
								</div>
							</div>
				<?php 	endforeach; ?>
				<?php 	else:?>
						Iklan Masih Belum Ada
				<?php 	endif;?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-primary panel-green">
			<div class="panel-heading">
				<h4>Pengaturan Sidebar</h4>
				<div class="options">
					<ul class="nav nav-tabs">
					<?php 	$grpWidgets = Yii::app()->db->createCommand()->select('id, title, name')->from('widget_group')->order('id ASC')->queryAll();
							foreach($grpWidgets as $grpWidget):?>
							<li <?php if($grpWidget['id'] == 1)echo "class='active'"; ?> data-id="<?php echo $grpWidget['name']."-".$grpWidget['id']; ?>">
								<a href="#<?php echo $grpWidget['name']."-".$grpWidget['id']; ?>" data-toggle="tab"><?php echo $grpWidget['title']; ?></a>
							</li>
					<?php	endforeach;?>
					</ul>
				</div>
			</div>
			<div class="panel-body">
				<?php echo CHtml::beginForm('', 'post', array('id'=>'ajaxkonten')); ?>
				<div class="tab-content">
					<?php foreach($grpWidgets as $grpWidget):?>
						<div class="tab-pane sortable <?php if($grpWidget['id'] == 1)echo "active"; ?>" id="<?php echo $grpWidget['name']."-".$grpWidget['id']; ?>" data-id="<?php echo $grpWidget['name']."-".$grpWidget['id']; ?>">
						<?php	$grpsWidgets = Yii::app()->db->createCommand()->select('widget_id, widget_name, widget_type, widget_style, object_id, widget_group_id')->from('widget')->where('widget_group_id = :ggrks', array(':ggrks'=>$grpWidget['id']))->order('lft ASC')->queryAll();
								foreach($grpsWidgets as $grpsWidget):?>
										<div style="overflow:hidden;" class="alert btn-<?php if($grpsWidget['widget_type']=='category'){echo "green";}elseif($grpsWidget['widget_type']=='separator'){echo "midnightblue";}else{echo "primary";} ?> strshp" data-kid="<?php echo $grpsWidget['widget_id']; ?>" data-id="<?php echo $grpsWidget['object_id']; ?>" data-type="<?php echo ($grpsWidget['widget_type'] != "separator") ? $grpsWidget['widget_type'] : "separator"; ?>">
											<span class="text"><?php echo $grpsWidget['widget_name']; ?></span>
											<div class="block-holder pull-right">
												<a class="ajaxContentDelete" href="javascript:;">
													<i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i>
												</a>
											</div>
									<?php if($grpsWidget['widget_type'] == "category"):?>
											<div class="block-holder pull-right">
												<label class=""><?php echo ucfirst($grpsWidget['widget_type']); ?> | </label>
											<label><input type="radio" name="jenisBlok[<?php echo $grpsWidget['widget_id']; ?>]" value="1" <?php echo ($grpsWidget['widget_style']==1) ? "checked=checked" : ""; ?> /> Style 1</label>
											<label style="margin:0 10px 0 0;"><input type="radio" name="jenisBlok[<?php echo $grpsWidget['widget_id']; ?>]" value="2" <?php echo ($grpsWidget['widget_style']==2) ? "checked=checked" : ""; ?> /> Style 2</label>
											</div>
									<?php elseif($grpsWidget['widget_type'] == "iklan"):?>
										<div class="block-holder pull-right" style="margin-right:5px;">
											<label class=""><?php echo ucfirst($grpsWidget['widget_type']); ?> | </label>
										</div>
									<?php endif;?>
										</div>
						<?php	endforeach;?>
						</div>
					<?php	endforeach;?>
				</div>
			</div>
			<div class="panel-footer">
				<a href="javascript:;" id="ajaxWidgetPost" class="btn btn-default">Simpan Posisi</a>
				<a href="javascript:;" id="addSeparator" class="btn btn-default">Tambah Pemisah</a>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>
		<div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<div class="modal-title modal-title-text">Error</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</div>