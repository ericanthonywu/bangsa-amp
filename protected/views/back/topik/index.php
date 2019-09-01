<?php
/* @var $this TopikKhasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Topik Khas',
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/delAjaxImage.js', CClientScript::POS_END);
?>
<h1>Topik Khas</h1>
<div class="rows">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Pengaturan Topik Khas</h4>
				</div>
				<div class="panel-body">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'TK-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
					'htmlOptions' => array('enctype' => 'multipart/form-data'),
				)); ?>
					<div class="form-group">
					Tag Topik Khas
						<input type="hidden" id="azm11" style="width:100%" name="Topik[object_id]" value="<?php 
							if(!empty($model->object_id)){
								$tagArr = explode(',', $model->object_id);
								foreach($tagArr as $tag){
									if(end($tagArr) == $tag)
										echo $tag; 
									else 
										echo $tag.",";	
								}
							}
							$tagArr = explode(',', $model->object_id);
						?>"
						/>
					</div>
					<div class="form-group">
					Judul Topik Khas
					<?php echo $form->textField($model,'judul',array('class'=>'form-control', 'placeholder'=>'Judul Topik Khas')); ?>
					</div>
					Gambar
					<div class="form-group">
						<div class="container">
								<?php
									$url = Yii::app()->createUrl("topik/upload");
									$this->widget('xupload.XUpload', array(
															'url' => $url,
															'model' => $photos,
															'attribute' => 'TKFile',
															'multiple' => false,
															'htmlOptions' => array('id'=>'TK-form'),
															'options' => array(
																'maxNumberOfFiles'=>1,
																'maxFileSize' => 2000000,
																'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
															),
									));
								?>
						</div>
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default', 'id'=>'topikkhas-upload-button')); ?>
					</div>
				<?php $this->endWidget(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
