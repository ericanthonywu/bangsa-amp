<?php
/* @var $this EpaperController */
/* @var $model Epaper */
/* @var $form CActiveForm */
?>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'tags-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Tag Berita</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'tag_name'); ?>
						<?php echo $form->textField($model,'tag_name',array('class'=>'form-control tag_nameInput')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'tag_title'); ?>
						<?php echo $form->textField($model,'tag_title',array('class'=>'form-control fors_tag_title', 'readonly'=>'readonly')); ?>
					</div>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default','id'=>'page-upload-button')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('input.tag_nameInput').keyup(function(){
			var th_inputs = convertToSlug( $(this).val() );
			console.log(th_inputs);
		});
	});

	function convertToSlug(Text)
	{
	    return Text
	        .toLowerCase()
	        .replace(/[^\w ]+/g,'')
	        .replace(/ +/g,'-')
	        ;
	}
</script>