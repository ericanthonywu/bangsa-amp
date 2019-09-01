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
								<div class="block-holder pull-right">
									<a class="ajaxContentDelete" href="javascript:;">
										<i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i>
									</a>
								</div>
								<span class="text"><?php echo " ".$kategori['category_name']; ?></span>
								<div class="block-holder pull-right">
									<label class="">Category <i class="icon-sort"></i> </label>
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
								<div class="block-holder pull-right">
									<a class="ajaxContentDelete" href="javascript:;">
										<i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i>
									</a>
								</div>
								<span class="text"><?php echo " ".$iklan['judul_iklan']; ?></span>
								<div class="block-holder pull-right">
									<label class="">Jenis Iklan <i class="icon-sort"></i> </label>
									<label><input type="radio" name="jenisBlok[<?php echo $iklan['id']; ?>]" value="1" checked /> Gambar</label>
									<label style="margin:0 10px 0 0;"><input type="radio" name="jenisBlok[<?php echo $iklan['id']; ?>]" value="2" /> Text</label>
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
				<h4>Pengaturan Halaman Depan</h4>
			</div>
			<?php echo CHtml::beginForm('', 'post', array('id'=>'ajaxkonten')); ?>
			<div class="panel-body sortable">
				<?php 	$kategoris = Yii::app()->db->createCommand()->select('level, block_style, id, block_title, block_type, block_object_id')->from('block')->where('block_type != "root"')->order('lft ASC')->queryAll();
						foreach($kategoris as $kategori):?>
							<div style="overflow:hidden;" class="alert btn-<?php if($kategori['block_type']=='category'){echo "green";}elseif($kategori['block_type']=='separator'){echo "midnightblue";}else{echo "primary";} ?> strshp" data-kid="<?php echo $kategori['id']; ?>" data-id="<?php echo $kategori['block_object_id']; ?>" data-type="<?php echo ($kategori['block_type'] != "separator") ? $kategori['block_type'] : "separator"; ?>">
								<?php //for($i=1;$i<$kategori['level'];$i++){echo "&#8212";}  ?><span class="text">
									<?php echo $kategori['block_title']; ?>
								</span>
									<div class="block-holder pull-right">
										<a class="ajaxContentDelete" href="javascript:;">
											<i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i>
										</a>
									</div>
								<?php 
									if($kategori['block_type'] == "category"):?>
									<div class="block-holder pull-right">
										<label class=""><?php echo ucfirst($kategori['block_type']); ?> <i class="icon-sort"></i> </label>
										<label><input type="radio" name="jenisBlok[<?php echo $kategori['id']; ?>]" value="1" <?php echo ($kategori['block_style']==1) ? "checked=checked" : ""; ?> /> Style 1</label>
										<label style="margin:0 10px 0 0;"><input type="radio" name="jenisBlok[<?php echo $kategori['id']; ?>]" value="2" <?php echo ($kategori['block_style']==2) ? "checked=checked" : ""; ?> /> Style 2</label>
									</div>
							<?php elseif($kategori['block_type'] == "iklan"):?>
								<div class="block-holder pull-right" style="margin-right:5px;">
									<label class=""><?php echo ucfirst($kategori['block_type']); ?> <i class="icon-sort"></i> </label>
									<label>
										<input type="radio" name="jenisBlok[<?php echo $kategori['id']; ?>]" value="1" <?php echo ($kategori['block_style']==1) ? "checked=checked" : ""; ?> /> Gambar</label>
									<label style="margin:0 10px 0 0;">
										<input type="radio" name="jenisBlok[<?php echo $kategori['id']; ?>]" value="2" <?php echo ($kategori['block_style']==2) ? "checked=checked" : ""; ?> /> Text</label>
								</div>
							<?php endif;?>
							</div>
				<?php 	endforeach; ?>
			</div>
			<div class="panel-footer">
				<a href="javascript:;" id="ajaxMenuPost" class="btn btn-default">Simpan Posisi</a>
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