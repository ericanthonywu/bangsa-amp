<div class="container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'page-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
	<div class="row">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>User</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<?php echo $form->errorSummary($model); ?>
					</div>
					<div class="form-group row">
						<span class="col-md-3">Username*</span>
						<span class="col-md-9"><?php echo $form->textField($model,'username',array('class'=>'form-control')); ?></span>
						<?php echo $form->error($model,'username'); ?>
					</div>
					<div class="form-group row">
						<span class="col-md-3">Password*</span>
						<span class="col-md-9">	<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?></span>
						<?php echo $form->error($model,'password'); ?>
					</div>
					<div class="form-group row">
						<span class="col-md-3">Email*</span>
						<span class="col-md-9"><?php echo $form->textField($model,'email',array('class'=>'form-control')); ?></span>
						<?php echo $form->error($model,'email'); ?>
					</div>
					<div class="form-group row">
						<span class="col-md-3">Level User</span>
						<span class="col-md-9"><?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus'),array('class'=>'form-control')); ?></span>
						<?php echo $form->error($model,'superuser'); ?>
					</div>
					<div class="form-group row">
						<span class="col-md-3">Status*</span>
						<span class="col-md-9"><?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus'),array('class'=>'form-control')); ?></span>
						<?php echo $form->error($model,'status'); ?>
					</div>
						<?php 
							$profileFields=$profile->getFields();
							if ($profileFields) {
								foreach($profileFields as $field) {
								?>
									<div class="form-group row">
										<?php echo "<span class='col-md-3'>".$form->labelEx($profile,$field->varname)."</span>"; ?>
										<?php 
										if ($widgetEdit = $field->widgetEdit($profile)) {
											echo $widgetEdit;
										} elseif ($field->range) {
											echo "<span class='col-md-9'>".$form->dropDownList($profile,$field->varname,Profile::range($field->range),array('class'=>'form-control'))."</span>";
										} elseif ($field->field_type=="TEXT") {
											echo "<span class='col-md-9'>".CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50),array('class'=>'form-control'))."</span>";
										} else {
											echo "<span class='col-md-9'>".$form->textField($profile,$field->varname,array('maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'))."</span>";
										}
										 ?>
										<?php echo $form->error($profile,$field->varname); ?>
									</div>
								<?php
								}
							}
					?>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php $this->endWidget(); ?>
</div><!-- container -->