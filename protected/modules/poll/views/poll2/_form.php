<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
	  'id'=>'poll-form',
	  //'enableAjaxValidation'=>TRUE,
	'htmlOptions' => array('enctype' => 'multipart/form-data')
	)); ?>
		<div class="row">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Tambah Polling Pemilu</h4>
					</div>
					<div class="panel-body">
						<?php echo $form->errorSummary($model); ?>
						<div class="form-group">
							<?php echo $form->labelEx($model,'title'); ?>
							<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
							<?php echo $form->error($model,'title'); ?>
						</div>
						<?php 
						/*<div class="form-group">
							<?php echo $form->labelEx($model,'description'); ?>
							<?php echo $form->textArea($model,'description',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'description'); ?>
						</div>*/
						 ?>
						
						<!-- rekayasa, date_input, date_end -->
						<div class="form-group">
							<?php echo $form->labelEx($model,'rekayasa'); ?>
							<?php echo $form->dropDownList($model, 'rekayasa', array(
								'0'=>'Tidak Aktif',
								'1'=>'Aktif',
							), array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'rekayasa'); ?>
						</div>
						<?php if ($model->scenario == 'insert'):
						$model->date_input = date("Y-m-d");
						$model->date_end = date("Y-m-d", strtotime("+ 1 month"));
						endif ?>
						<div class="form-group">
							<?php echo $form->labelEx($model,'date_input'); ?>
							<?php echo $form->textField($model,'date_input',array('class'=>'form-control datepicker')); ?>
							<?php echo $form->error($model,'date_input'); ?>
						</div>
						<div class="form-group">
							<?php echo $form->labelEx($model,'date_end'); ?>
							<?php echo $form->textField($model,'date_end',array('class'=>'form-control datepicker')); ?>
							<?php echo $form->error($model,'date_end'); ?>
						</div>

						<div class="form-group">
							<?php echo $form->labelEx($model,'status'); ?>
							<?php echo $form->dropDownList($model,'status',$model->statusLabels(),array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'status'); ?>
						</div>

						<h3>Pilihan</h3>

						<table id="poll-choices" class="table table-condensed table-striped">
							<thead>
							  <th>Weight</th>
							  <th>Nama Kandidat</th>
							  <th>Foto</th>
							  <th>Jumlah Manipulasi</th>
							  <th></th>
							</thead>
							<tbody>
							<?php
							  $newChoiceCount = 0;
							  foreach ($choices as $choice) {
								$this->renderPartial('/poll2choice/_formChoice', array(
								  'id' => isset($choice->id) ? $choice->id : 'new'. ++$newChoiceCount,
								  'choice' => $choice,
								));
							  }
							  ++$newChoiceCount; // Increase once more for Ajax additions
							?>
							<tr id="add-pollchoice-row">
							  <td class="weight"></td>
							  <td class="labels">
								<span class="col-smd-11">
									<?php echo CHtml::textField('add_choice', '', array('class'=>'form-control input-sm', 'size'=>60, 'id'=>'add_choice')); ?>
								</span>
								<div class="col-md-11">
									<div class="errorMessage" style="display:none">Anda harus mengisi pilihan polling</div>
								</div>
							  </td>
							  <td class="image">
								<span class="col-smd-11">
									<?php echo CHtml::fileField('add_choice', '', array('class'=>'input-sm', 'id'=>'add_choice')); ?>
								</span>
								<div class="col-md-11">
									<div class="errorMessage" style="display:none">Isilah Foto Polling</div>
								</div>
							  </td>
							  <td class="jumlah_rekayasa">
								<span class="col-smd-11">
									<?php echo CHtml::textField('add_choice', '', array('class'=>'form-control input-sm', 'size'=>60, 'id'=>'add_choice')); ?>
								</span>
								<div class="col-md-11">
									<div class="errorMessage" style="display:none">Isilah apabila ingin memanipulasi voting polling</div>
								</div>
							  </td>
							  <td class="actions">
								<a href="#" id="add-pollchoice">Tambah pilihan</a>
							  </td>
							</tr>
							</tbody>
						</table>

						<div class="row buttons">
							<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default')); ?>
						</div>
					</div>
				</div>
			</div>
			<div style="clear: both; height:5px;"></div>
			<div style="padding: 0 10px;">
				<div class="well alert-warning">
					<p class="help-block">*) Note:</p>
					<ul class="list-unstyled bulletss">
						<li>Gantilah Pilihan "Manipulasi" menjadi "Aktif" apbila anda ingin memanipulasi data dan sub pilihan yang ada sekarang,</li>
						<li>lengkapi persentase yang anda inginkan.</li>
						<li>Foto kandidat harus ukuran 160px X 160px jpg, 70%.</li>
						<li>Biarkan kosong jumlah manipulasi apabila tidak ingin memanipulasi.</li>
					</ul>
				</div>
			</div>

		</div>
		</div>
	<?php $this->endWidget(); ?>
</div>

<?php
$callback = Yii::app()->createUrl('/poll/poll2choice/ajaxcreate');
$js = <<<JS
var PollChoice = function(o) {
  this.target = o;
  this.label  = jQuery(".labels input", o);
  this.weight = jQuery(".weight select", o);
  this.jumlah_rekayasa = jQuery(".jumlah_rekayasa input", o);
  this.image = jQuery(".image input", o);
  this.errorMessage = jQuery(".errorMessage", o);

  var pc = this;

  pc.label.blur(function() {
    pc.validate();
  });
}
PollChoice.prototype.validate = function() {
  var valid = true;

  if (this.label.val() == "") {
    valid = false;
    this.errorMessage.fadeIn();
  }
  else {
    this.errorMessage.fadeOut();
  }

  return valid;
}

var newChoiceCount = {$newChoiceCount};
var addPollChoice = new PollChoice(jQuery("#add-pollchoice-row"));

jQuery("tr", "#poll-choices tbody").each(function() {
  new PollChoice(jQuery(this));
});

jQuery("#add-pollchoice").click(function() {
  if (addPollChoice.validate()) {
    jQuery.ajax({
      url: "{$callback}",
      type: "POST",
      dataType: "json",
      data: {
        id: "new"+ newChoiceCount,
        label: addPollChoice.label.val()
      },
      success: function(data) {
        addPollChoice.target.before(data.html);
        addPollChoice.label.val('');
        addPollChoice.jumlah_rekayasa.val('');
        addPollChoice.image.val('');

        new PollChoice(jQuery('#'+ data.id));
      }
    });

    newChoiceCount += 1;
  }

  return false;
});
JS;

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('pollHelp', $js, CClientScript::POS_END);
?>

<style type="text/css">
	ul.bulletss{
		list-style: square;
		padding-left: 20px;
	}
</style>