<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>
<?php // if( $parameter->users_id == Yii::app()->user->id || $parameter->users_id != 1):?>
	<div class="container">
		<div class="row">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-indigo">
					<div class="panel-body">
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'contact-form',
							'htmlOptions'=>array(
								'class'=>'form-horizontal row-border',
								'enctype' => 'multipart/form-data',
							),
							// Please note: When you enable ajax validation, make sure the corresponding
							// controller action is handling ajax validation correctly.
							// There is a call to performAjaxValidation() commented in generated controller code.
							// See class documentation of CActiveForm for details on this.
							'enableAjaxValidation'=>false,
						)); ?>
							<?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')); ?>

							<div class="form-group">
								<label class="col-sm-3 control-label">Nama</label>
								<div class="col-sm-6">
									<?php echo $form->textField($model,'nama',array('class'=>'form-control', 'readonly'=>'readonly', 'value'=>$model->nama)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Penempatan</label>
								<div class="col-sm-6">
									<?php
									$val_dataPenempatan = array(
										                '' => '-- Pilih --',
														// 1 => 'Kiri Tengah',
														2 => 'Sidebar Top',
														3 => 'Sidebar Bottom',
													);
									?>
									<?php echo $form->dropDownList($model, 'value', $val_dataPenempatan, array('class'=>'form-control')); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Gambar Banner Polling</label>
								<div class="col-sm-6">
									<?php echo $form->fileField($model,'gambar'); ?>
									<?php if ($model->gambar != ''): ?>
										<div class="poll_picture_ed"><img src="<?php echo Yii::app()->baseUrl; ?>/images/uploads/banner_polling/<?php echo $model->gambar ?>" alt="" class="pict_back_polling"></div>
									<?php endif ?>
									<p class="help-block">
										*) Note: Maksimal width 340px, tinggi proporsional banner
									</p>
								</div>
							</div>
							<!-- <div class="form-group">
								<label class="col-sm-3 control-label">Url</label>
								<div class="col-sm-6">
									<?php echo $form->textField($model,'url',array('class'=>'form-control', 'value'=>$model->url, 'placeholder'=>'Url Tujuan')); ?>
									<p class="help-block">*) harus memakai http:// contoh: http://www.bangsaonline.com</p>
								</div>
							</div> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Subtitle</label>
								<div class="col-sm-6">
									<?php echo $form->textField($model,'subtitle',array('class'=>'form-control', 'value'=>$model->subtitle, 'placeholder'=>'')); ?>
								</div>
							</div>

							<?php /*
							<div class="form-group">
								<label class="col-sm-3 control-label">Isi Pesan</label>
								<div class="col-sm-6">
								<textarea id="yii-redactor" class="form-control"></textarea>
									<?php
										Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
										$this->widget('ImperaviRedactorWidget', array(
											'selector' => '#yii-redactor',
											'options' => array(
												'lang' => 'id',
												'minHeight'=>200
											),
											'plugins' => array(
												'fullscreen' => array(
													'js' => array('fullscreen.js',),
												),
											),
										));
									?>
								</div>
							</div>*/
							?>

							<div class="form-group">
								<div class="col-sm-6">
									<div class="pull-sright">
										<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-default')); ?>
									</div>
								</div>
							</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php // else: 
		// throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
?>
<?php // endif; ?>
<style type="text/css">
	.poll_picture_ed{
		margin-top: 15px;
		border: 2px solid #ccc;
		padding: 7px;
		max-width: 285px;
	}
	.poll_picture_ed img{
		max-width: 100%;
	}
</style>