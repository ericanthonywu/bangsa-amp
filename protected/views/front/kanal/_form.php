<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>

<div class="con">
	<div class="con">
	<div class="con">
		<?php 
			$models = Yii::app()->db->createCommand()->select('id, object_id, name, filename, module_id, caption_title, caption_desc')->from('files')->where('module_id=:ggrks AND object_id=:ggrksu AND user_id=:awaw', array(':ggrks'=>1, ':ggrksu'=>0, ':awaw'=>Yii::app()->user->id))->queryAll();
				
			if(count($models) > 0):
				foreach($models as $model):?>
					<div class="col-md-12 teenage-journalism just-once" style="margin-bottom:5px;overflow:hidden;" data-diff="<?php echo $model['id']."-".$model['module_id']; ?>">
						<div class="con">
							<hr />
							<div class="con" style="margin-bottom:5px;overflow:hidden;">
								<span class="span12" style="word-wrap:break-word;">
									<?php echo $model['name']; ?>
								</span>
							</div>
							<div class="con" style="margin-bottom:5px;overflow:hidden;">
								<div class="span5 preview">
									<a href="<?php echo Yii::app( )->getBaseUrl( )."/images/uploads/berita/".$model['filename']; ?>" title="<?php echo $model['name']; ?>" rel="gallery" download="<?php echo $model['filename'];?>">
										<img src="<?php echo Yii::app( )->getBaseUrl( )."/images/uploads/berita/150x150/".$model['filename']; ?>" />
									</a>
								</div>
								<div class="span7">
									<strong>Judul Caption</strong>
									<div style="margin-bottom:5px;word-wrap:break-word;">
										<span class="caption-title" data-text="<?php echo $model['caption_title']; ?>"><?php echo $model['caption_title']; ?></span>
									</div>
									<strong>Deskripsi Caption</strong>
									<div style="word-wrap:break-word;">
										<span class="caption-desc" data-text="<?php echo $model['caption_desc']; ?>"><?php echo $model['caption_desc']; ?></span>
									</div>
								</div>
							</div>
							<div>
								<span class="pull-right">
									<a class="teenage-journalism btn btn-danger delete-caption" data-id="<?php echo $model['id']."-".$model['module_id']; ?>" data-modul="teenage-journalism">
										<i class="icon-trash"></i>
										<span>Hapus</span>
									</a>
								</span>
							</div>
						</div>
					</div>
		<?php	endforeach;
			endif;
		?>
		<hr />
	</div>
	</div>
</div>
<div class="con fileupload-buttonbar">
	<div class="con">
	<div class="col-md-12">
		<!-- The fileinput-button col-md- is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button <?php if(count($models) > 0) echo "disabled"; ?>">
            <i class="icon-plus icon-white"></i>
            <col-md-><?php echo $this->t('1#Tambah file|0#Pilih file', $this->multiple); ?></col-md->
			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
		</span>
        <?php if ($this->multiple) { ?>
		<button type="submit" class="btn btn-primary start">
			<i class="icon-upload icon-white"></i>
			<span>Upload</span>
		</button>
		<button type="reset" class="btn btn-warning cancel">
			<i class="icon-ban-circle icon-white"></i>
			<span>Batal</span>
		</button>
		<button type="button" class="btn btn-danger delete">
			<i class="icon-trash icon-white"></i>
			<span>Hapus</span>
		</button>
		<input type="checkbox" class="toggle">
        <?php } ?>
	</div>
	</div>
	<div class="col-md-5">
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
<div class="con">
<table class="table table-condensed col-md-12">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>
</div>
<?php if ($this->showForm) echo CHtml::endForm();?>
