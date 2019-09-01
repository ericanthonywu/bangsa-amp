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
				<div class="panel-heading">
					<h4>Pengaturan Iklan</h4>
				</div>
				<div class="panel-body">
				<?php echo CHtml::beginForm(); ?>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Atas</div>
								<div class="col-md-8">
									<select name="Iklan[atas]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="atas"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=1')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Logo</div>
								<div class="col-md-8">
									<select name="Iklan[samping-logo]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="samping-logo"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=2')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Topik Khas 1 </div>
								<div class="col-md-8">
									<select name="Iklan[samping-topik-1]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="samping-topik-1"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=3')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Topik Khas 2 </div>
								<div class="col-md-8">
									<select name="Iklan[samping-topik-2]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="samping-topik-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=4')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah 1</div>
								<div class="col-md-8">
									<select name="Iklan[iklan-bawah-1]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="iklan-bawah-1"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=5')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Bawah 2</div>
								<div class="col-md-8">
									<select name="Iklan[iklan-bawah-2]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="iklan-bawah-2"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=6')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Kiri</div>
								<div class="col-md-8">
									<select name="Iklan[iklan-halaman-kiri]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="samping-halaman-kiri"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=7')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">Iklan Samping Kanan</div>
								<div class="col-md-8">
									<select name="Iklan[iklan-halaman-kanan]" class="form-control">
										<option value="0">Pilih Iklan</option>
										<?php 
											$iklanPos = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->where('position="samping-halaman-kanan"')->queryRow();
											$models = Yii::app()->db->createCommand()->select('judul_iklan, id')->from('module_iklan')->where('position=8')->orWhere('position=0')->queryAll();
											foreach($models as $model):?>	
												<option value="<?php echo $model['id']; ?>" <?php if($model['id'] == $iklanPos['object_id']){echo "selected='selected'";} ?>><?php echo $model['judul_iklan']; ?></option>
										<?php endforeach;?>
									</select>
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