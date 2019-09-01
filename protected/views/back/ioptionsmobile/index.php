<?php
/* @var $this NewsOptionsController */
/* @var $dataProvider CActiveDataProvider */

/* 14-21 = Iklan mobile */

$this->breadcrumbs=array(
	'Pengaturan Iklan Mobile',
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
					<h4>Pengaturan Iklan Mobile</h4>
				</div>
				
				<div class="panel-body">
				<?php echo CHtml::beginForm(); ?>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah Logo</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-bawah-logo]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-bawah-logo"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=14')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-bawah-logo" type="checkbox" name="Iklan[tipe-mobile-bawah-logo]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-bawah-logo">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah Menu</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-bawah-menu]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-bawah-menu"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=15')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-bawah-menu" type="checkbox" name="Iklan[tipe-mobile-bawah-menu]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-bawah-menu">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Berita Utama</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-atas-berita-utama]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-atas-berita-utama"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=16')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-atas-berita-utama" type="checkbox" name="Iklan[tipe-mobile-atas-berita-utama]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-atas-berita-utama">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Berita Utama 2</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-atas-berita-utama-2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-atas-berita-utama-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=16')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-atas-berita-utama-2" type="checkbox" name="Iklan[tipe-mobile-atas-berita-utama-2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-atas-berita-utama-2">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Berita Utama 3</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-atas-berita-utama-3]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-atas-berita-utama-3"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=16')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-atas-berita-utama-3" type="checkbox" name="Iklan[tipe-mobile-atas-berita-utama-3]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-atas-berita-utama-3">Adsense</label>
								</div>
							</div>
						</div>
						

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Hot News</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-atas-hot-news]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-atas-hot-news"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=17')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-atas-hot-news" type="checkbox" name="Iklan[tipe-mobile-atas-hot-news]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-atas-hot-news">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Hot News 2</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-atas-hot-news2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-atas-hot-news2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=27')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-atas-hot-news2" type="checkbox" name="Iklan[tipe-mobile-atas-hot-news2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-atas-hot-news">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas Hot News 3</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-atas-hot-news3]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-atas-hot-news3"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=28')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-atas-hot-news3" type="checkbox" name="Iklan[tipe-mobile-atas-hot-news3]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-atas-hot-news">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah Hot News</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-bawah-hot-news]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-bawah-hot-news"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=18')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-bawah-hot-news" type="checkbox" name="Iklan[tipe-mobile-bawah-hot-news]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-bawah-hot-news">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah Blok</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-bawah-blok]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-bawah-blok"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=19')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-bawah-blok" type="checkbox" name="Iklan[tipe-mobile-bawah-blok]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-bawah-blok">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Detail Berita Bawah</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-detail-berita-bawah]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-detail-berita-bawah"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=20')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-detail-berita-bawah" type="checkbox" name="Iklan[tipe-mobile-detail-berita-bawah]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-detail-berita-bawah">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Detail Berita Bawah 2</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-detail-berita-bawah2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-detail-berita-bawah2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=25')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-detail-berita-bawah2" type="checkbox" name="Iklan[tipe-mobile-detail-berita-bawah2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-detail-berita-bawah">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Detail Berita Tengah</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-detail-berita-tengah]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-detail-berita-tengah"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=24')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-detail-berita-tengah" type="checkbox" name="Iklan[tipe-mobile-detail-berita-tengah]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-detail-berita-tengah">Adsense</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Detail Berita - Bawah Berita Populer</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-detail-berita-bawah-berita-populer]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-detail-berita-bawah-berita-populer"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=21')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-detail-berita-bawah-berita-populer" type="checkbox" name="Iklan[tipe-mobile-detail-berita-bawah-berita-populer]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-detail-berita-bawah-berita-populer">Adsense</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Detail Berita - Bawah Berita Populer 2</div>
								<div class="col-md-6">
									<select name="Iklan[mobile-detail-berita-bawah-berita-populer2]" class="selectize" style="width:100%;">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position, style')->from('module_iklan_options')->where('position="mobile-detail-berita-bawah-berita-populer2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=22')->orWhere('position=0')->order('id DESC')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-md-2">
									<input id="tipe-mobile-detail-berita-bawah-berita-populer2" type="checkbox" name="Iklan[tipe-mobile-detail-berita-bawah-berita-populer2]" value="1" <?php if($iklanPos['style'] == 1){ echo "checked='checked'"; } ?> /> 
									<label for="tipe-mobile-detail-berita-bawah-berita-populer2">Adsense</label>
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