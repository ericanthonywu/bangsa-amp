<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/delAjaxImage.js', CClientScript::POS_END);
?>
<div class="container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'page-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
		)); ?>
	<div class="row">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Halaman</h4>
				</div>
				<div class="panel-body">
					<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'page_title'); ?>
						<?php echo $form->textField($model,'page_title',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'page_content'); ?>
						<?php echo $form->textArea($model,'page_content',array('class'=>'form-control', 'id'=>'yii-redactor')); ?>
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
										'js' => array('fullscreen.js'),
									),
								),
							));
						?>
					</div>
					<div class="form-group">
								<?php
									if($model->isNewRecord)
										$url = Yii::app()->createUrl("page/upload");
									else
										$url = Yii::app()->createUrl("page/upload&id=".Yii::app()->request->getParam('id'));
									
									$this->widget('xupload.XUpload', array(
															'url' => $url,
															'model' => $photos,
															'attribute' => 'file',
															'multiple' => false,
															'htmlOptions' => array('id'=>'page-form'),
															'options' => array(
																'maxNumberOfFiles'=>1,
																'maxFileSize' => 2000000,
																'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
															),
									));
								?>
					</div>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default','id'=>'page-upload-button')); ?>
					</div>
				</div>
			</div>
		</div>
			<div class="col-md-4">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Status Halaman</h4>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<?php echo $form->labelEx($model,'page_status'); ?>
							<?php echo $form->dropDownList($model,'page_status', array('1'=>'Publish', '2'=>'Draft', '3'=>'Trash'), array('class'=>'form-control')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>
							<div class="modal fade" id="pageForm" tabindex="-1" role="dialog" aria-labelledby="pageForm" aria-hidden="true">
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
													<input class="form-control caption-title" name="page_caption_title" />
												</div>
												<div id="deskripsi-caption" style="margin-top:5px;">
													Deskripsi Caption
												</div>
												<div>
													<textarea class="form-control caption-desc" name="page_caption_desc" ></textarea>
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