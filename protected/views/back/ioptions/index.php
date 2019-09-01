<?php
/* @var $this NewsOptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pengaturan Iklan',
);
?>
<div class="rows">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
		<?php 
			$messages = Yii::app()->user->getFlashes();
			foreach($messages as $key => $message):?>
			<div class="alert alert-dismissable alert-<?php echo $key; ?>">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $message; ?>
			</div>
		<?php endforeach; ?>
				<div class="panel-heading">
					<h4>Pengaturan Iklan</h4>
				</div>
				
				<div class="panel-body">
				<?php echo CHtml::beginForm(); ?>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas</div>
								<div class="col-md-6">
									<select name="Iklan[atas]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=1')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-atas" type="checkbox" name="Iklan[tipe-atas]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-atas">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Logo</div>
								<div class="col-md-6">
									<select name="Iklan[samping-logo]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="samping-logo"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=2')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-samping-logo" type="checkbox" name="Iklan[tipe-samping-logo]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-samping-logo">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Topik Khas 1 </div>
								<div class="col-md-6">
									<select name="Iklan[samping-topik-1]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="samping-topik-1"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=3')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-samping-topik-1" type="checkbox" name="Iklan[tipe-samping-topik-1]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-samping-topik-1">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Topik Khas 2 </div>
								<div class="col-md-6">
									<select name="Iklan[samping-topik-2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="samping-topik-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=4')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-samping-topik-2" type="checkbox" name="Iklan[tipe-samping-topik-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-samping-topik-2">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Topik Khas 1 </div>
								<div class="col-md-6">
									<select name="Iklan[atas-topik-khas-1]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas-topik-khas-1"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=12')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-atas-topik-khas-1" type="checkbox" name="Iklan[tipe-atas-topik-khas-1]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-atas-topik-khas-1">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Topik Khas 2 </div>
								<div class="col-md-6">
									<select name="Iklan[atas-topik-khas-2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas-topik-khas-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=13')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-atas-topik-khas-2" type="checkbox" name="Iklan[tipe-atas-topik-khas-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-atas-topik-khas-2">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Topik Khas 3 </div>
								<div class="col-md-6">
									<select name="Iklan[atas-topik-khas-3]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas-topik-khas-3"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=13')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-atas-topik-khas-3" type="checkbox" name="Iklan[tipe-atas-topik-khas-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-atas-topik-khas-2">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Topik Khas 4 </div>
								<div class="col-md-6">
									<select name="Iklan[atas-topik-khas-4]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas-topik-khas-4"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=13')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-atas-topik-khas-4" type="checkbox" name="Iklan[tipe-atas-topik-khas-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-atas-topik-khas-2">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Hot News 1</div>
								<div class="col-md-6">
									<select name="Iklan[atas-hot-news-1]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas-hot-news-1"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=10')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-hot-news-1" type="checkbox" name="Iklan[tipe-atas-hot-news-1]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-hot-news-1">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Hot News 2</div>
								<div class="col-md-6">
									<select name="Iklan[atas-hot-news-2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="atas-hot-news-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=11')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-hot-news-2" type="checkbox" name="Iklan[tipe-atas-hot-news-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-hot-news-2">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah 1</div>
								<div class="col-md-6">
									<select name="Iklan[iklan-bawah-1]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="iklan-bawah-1"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=5')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-iklan-bawah-1" type="checkbox" name="Iklan[tipe-iklan-bawah-1]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-iklan-bawah-1">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah 2</div>
								<div class="col-md-6">
									<select name="Iklan[iklan-bawah-2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="iklan-bawah-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=6')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-iklan-bawah-2" type="checkbox" name="Iklan[tipe-iklan-bawah-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-iklan-bawah-2">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Kiri</div>
								<div class="col-md-6">
									<select name="Iklan[iklan-halaman-kiri]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="samping-halaman-kiri"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=7')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-iklan-halaman-kiri" type="checkbox" name="Iklan[tipe-iklan-halaman-kiri]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-iklan-halaman-kiri">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Kanan</div>
								<div class="col-md-6">
									<select name="Iklan[iklan-halaman-kanan]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="samping-halaman-kanan"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=8')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-iklan-halaman-kanan" type="checkbox" name="Iklan[tipe-iklan-halaman-kanan]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-iklan-halaman-kanan">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah Detail Berita</div>
								<div class="col-md-6">
									<select name="Iklan[bawah-detail-berita]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="bawah-detail-berita"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=9')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-bawah-detail-berita" type="checkbox" name="Iklan[tipe-bawah-detail-berita]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-bawah-detail-berita">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah Detail Berita 2</div>
								<div class="col-md-6">
									<select name="Iklan[bawah-detail-berita2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="bawah-detail-berita2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=26')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-bawah-detail-berita2" type="checkbox" name="Iklan[tipe-bawah-detail-berita2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-bawah-detail-berita">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Tengah Detail Berita</div>
								<div class="col-md-6">
									<select name="Iklan[tengah-detail-berita]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="tengah-detail-berita"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=23')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-tengah-detail-berita" type="checkbox" name="Iklan[tipe-tengah-detail-berita]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-tengah-detail-berita">Adsense</label>
								</div>
							</div>
						</div>

					<hr />
					<input type="submit" class="btn btn-default" value="Simpan" />
				<?php echo CHtml::endForm(); ?>
				</div>
			</div>
		</div>
	</div>
</div>