<!-- The file upload form used as target for the file upload widget -->
<?php 
	$aw = Yii::app()->request->getParam('id');
	$model = Yii::app()->db->createCommand()->select('object_id, name')->from('files')->where('object_id=:obj', array(':obj'=>$aw))->queryAll();
	$dx = "";
	if(count($model) > 0) $dx = "disabled";
?>
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>
<div class="row fileupload-buttonbar">
	<div class="span7">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button <?php echo $dx ?>">
            <i class="icon-plus icon-white"></i>
            <span><?php echo $this->t('1#Tambah file|0#Pilih file', $this->multiple); ?></span>
			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
		</span>
        <?php if ($this->multiple) { ?>
		<button type="submit" class="btn btn-primary start <?php echo $dx ?>">
			<i class="icon-upload icon-white"></i>
			<span>Upload</span>
		</button>
		<button type="reset" class="btn btn-warning cancel <?php echo $dx ?>">
			<i class="icon-ban-circle icon-white"></i>
			<span>Batal</span>
		</button>
		<button type="button" class="btn btn-danger delete <?php echo $dx ?>">
			<i class="icon-trash icon-white"></i>
			<span>Hapus</span>
		</button>
		<input type="checkbox" class="toggle <?php echo $dx ?>">
        <?php } ?>
	</div>
	<div class="span5">
		<!-- The global progress bar -->
		<div class="progress progress-success progress-striped active fade">
			<div class="bar" style="width:0%;"></div>
		</div>
	</div>
</div>
<!-- The loading indicator is shown during image processing -->
<div class="fileupload-loading"></div>
<br>
<!-- The table listing the files available for upload/download -->
<table class="table table-condensed col-md-12">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>
<?php if ($this->showForm) echo CHtml::endForm();?>
