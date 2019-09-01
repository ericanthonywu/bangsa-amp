<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>
<?php if( $parameter->users_id == Yii::app()->user->id || $parameter->users_id != 1):?>
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
							),
							// Please note: When you enable ajax validation, make sure the corresponding
							// controller action is handling ajax validation correctly.
							// There is a call to performAjaxValidation() commented in generated controller code.
							// See class documentation of CActiveForm for details on this.
							'enableAjaxValidation'=>false,
						)); ?>
							<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Penerima</label>
								<div class="col-sm-6">
									<?php echo $form->textField($model,'name',array('class'=>'form-control', 'value'=>$parameter->name)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Email Penerima</label>
								<div class="col-sm-6">
									<?php echo $form->textField($model,'email',array('class'=>'form-control', 'value'=>$parameter->email)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Subjek</label>
								<div class="col-sm-6">
									<?php echo $form->textField($model,'subject',array('class'=>'form-control', 'value'=>$parameter->subject)); ?>
								</div>
							</div>
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
							</div>
							<div class="form-group">
								<div class="col-sm-6">
									<div class="pull-sright">
										<?php echo CHtml::submitButton('Kirim', array('class'=>'btn btn-default')); ?>
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
<?php else: 
		throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
?>
<?php endif; ?>