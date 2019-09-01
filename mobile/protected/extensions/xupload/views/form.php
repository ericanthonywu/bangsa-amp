<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>

<div class="container">
	<div class="row">
	<div class="row">
		<?php 
			$modul = explode("/", Yii::app()->urlManager->parseUrl(Yii::app()->request));
			if($modul[0] == "iklan"){
				$module_id = 2;
				$file = "";
				$fFolder = "iklan";}
			elseif($modul[0] == "news"){
				$module_id = 1;
				$file = "/150x150";
				$fFolder = "berita";}
			elseif($modul[0] == "page"){
				$module_id = 0;
				$file = "/700";
				$fFolder = "halaman";}
			elseif($modul[0] == "topik"){
				$module_id = 3;
				$file = "";
				$fFolder = "topikkhas";}
				
			if(isset($modul[1])){
				if($modul[1] == "update"){
					$models = Yii::app()->db->createCommand()->select('id, object_id, name, filename, module_id, caption_title, caption_desc')->from('files')->where('module_id=:ggrks AND object_id=:ggrksu', array(':ggrks'=>$module_id, ':ggrksu'=>Yii::app()->request->getParam('id')))->queryAll();
				}
				elseif($modul[1] == "index"){
					$models = Yii::app()->db->createCommand()->select('id, name, filename, module_id, caption_title, caption_desc')->from('files')->where('module_id=:ggrks', array(':ggrks'=>$module_id))->queryAll();
				}
				else{
					$models = Yii::app()->db->createCommand()->select('id, object_id, name, filename, module_id, caption_title, caption_desc')->from('files')->where('module_id=:ggrks AND object_id=:ggrksu AND user_id=:awaw', array(':ggrks'=>$module_id, ':ggrksu'=>0, ':awaw'=>Yii::app()->user->id))->queryAll();
				}
			}
			else{
				$models = Yii::app()->db->createCommand()->select('id, name, filename, module_id, caption_title, caption_desc')->from('files')->where('module_id=:ggrks', array(':ggrks'=>$module_id))->queryAll();
			}
			
			if(count($models) > 0):
				foreach($models as $model):?>
					<div class="col-md-12 <?php echo $modul[0]; ?><?php if($modul[0] != "news")echo " just-once"; ?>" style="margin-bottom:5px;overflow:hidden;" data-diff="<?php echo $model['id']."-".$model['module_id']; ?>">
						<div class="row">
							<hr />
							<div class="row" style="margin-bottom:5px;overflow:hidden;">
								<span class="col-md-12" style="word-wrap:break-word;">
									<?php echo $model['name']; ?>
								</span>
							</div>
							<div class="row" style="margin-bottom:5px;overflow:hidden;">
								<div class="col-md-<?php if($modul[0]=="iklan" || $modul[0]=="topik"){echo "12";}else{echo "5";} ?> preview">
									<a href="<?php echo Yii::app( )->getBaseUrl( )."/images/uploads/{$fFolder}/".$model['filename']; ?>" title="<?php echo $model['name']; ?>" rel="gallery" download="<?php echo $model['filename'];?>">
										<img src="<?php echo Yii::app( )->getBaseUrl( )."/images/uploads/{$fFolder}{$file}/".$model['filename']; ?>" />
									</a>
								</div>
								<div class="col-md-<?php if($modul[0]=="iklan" || $modul[0]=="topik"){echo "12";}else{echo "7";} ?>">
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
									<a class="<?php echo $modul[0]; ?> btn btn-primary edit-caption" data-id="<?php echo $model['id']."-".$model['module_id']; ?>">
										<i class="icon-pencil"></i>
										<span>Edit Caption</span>
									</a>
									<a class="<?php echo $modul[0]; ?> btn btn-danger delete-caption" data-id="<?php echo $model['id']."-".$model['module_id']; ?>" data-modul="<?php echo $modul[0]; ?>">
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
<div class="row fileupload-buttonbar">
	<div class="row">
	<div class="col-md-12">
		<!-- The fileinput-button col-md- is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button <?php if(count($models) >= 2 && $modul[0] == "iklan") echo "disabled"; ?><?php if(count($models) > 0 && $modul[0] == "page") echo "disabled"; ?>">
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
		<button type="submit" class="btn btn-primary start uploadsors">
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
<div class="row">
<table class="table table-condensed col-md-12">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>
</div>
<?php if ($this->showForm) echo CHtml::endForm();?>
