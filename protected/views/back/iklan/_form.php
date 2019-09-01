<?php
/* @var $this iklanController */
/* @var $model iklan */
/* @var $form CActiveForm */
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/delAjaxImage.js', CClientScript::POS_END);
?>

<div class="container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'iklan-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
		)); ?>
	<div class="row">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Iklan</h4>
				</div>
				<div class="panel-body">
					<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'judul_iklan'); ?>
						<?php echo $form->textField($model,'judul_iklan',array('class'=>'form-control')); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'keterangan_iklan'); ?>
						<?php echo $form->textArea($model,'keterangan_iklan',array('class'=>'form-control','id'=>'yii-redactor')); ?>
					</div>
						<?php
							Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
							$this->widget('ImperaviRedactorWidget', array(
								'selector' => '#yii-redactor',
								'options' => array(
									'lang' => 'id',
									'minHeight'=>200,
									'imageGetJson'=> '\iklan_json.json',
									//'imageUpload'=> '/webUpload/redactor/uploadImage/',
									//'clipboardUploadUrl'=> '/webUpload/redactor/clipboardUpload/',
									//'fileUpload'=> '/webUpload/redactor/fileUpload/' 
								),
								'plugins' => array(
									'fullscreen' => array(
										'js' => array('fullscreen.js'),
									),
								),
							));
						?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'is_external'); ?>
						<?php echo $form->dropDownList($model,'is_external', array('0'=>'Tidak','1'=>'Ya'), array('class'=>'form-control', 'placeholder'=>'Link Iklan')); ?>
						<label>Jika dipilih ya, iklan akan terbuka pada tab baru</label>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'link_iklan'); ?>
						<?php echo $form->textField($model,'link_iklan',array('class'=>'form-control', 'placeholder'=>'Link Iklan')); ?>
					</div>
					<div class="form-group">
						<label>Penempatan Iklan</label>
						<select id="Iklan_position" name="Iklan[position]" class="form-control">
							<option value="0">Semua</option>
							<?php
								$modelIklans = Yii::app()->db->createCommand()->select('id, object_id, position')->from('module_iklan_options')->queryAll();
								foreach($modelIklans as $modelIklan):?>
									<option value="<?php echo $modelIklan['id']; ?>" <?php if($model->position == $modelIklan['id']) echo "selected='selected'"; ?>><?php echo ucwords(str_replace("-"," ", $modelIklan['position'])); ?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<div class="container">
								<?php
									if($model->isNewRecord)
										$url = Yii::app()->createUrl("iklan/upload");
									else
										$url = Yii::app()->createUrl("iklan/upload&id=".Yii::app()->request->getParam('id'));
									
									$this->widget('xupload.XUpload', array(
															'url' => $url,
															'model' => $photos,
															'attribute' => 'iklanfile',
															'multiple' => true,
															'htmlOptions' => array('id'=>'iklan-form'),
															'options' => array(
																'maxNumberOfFiles'=>2,
																'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
															),
									));
								?>
						</div>
					</div>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default', 'id'=>'topikkhas-upload-button')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php $this->endWidget(); ?>
							<div class="modal fade" id="iklanForm" tabindex="-1" role="dialog" aria-labelledby="iklanForm" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Edit </h4>
										</div>
										<div class="modal-body">
											<div>
												<div id="judul-caption">
													Judul Caption
												</div>
												<div>
													<input class="form-control caption-title" name="iklan_caption_title" />
												</div>
												<div id="deskripsi-caption" style="margin-top:5px;">
													Deskripsi Caption
												</div>
												<div>
													<textarea class="form-control caption-desc" name="iklan_caption_desc" ></textarea>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary save-caption" data-modul="iklan">Simpan Caption</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
</div><!-- container -->