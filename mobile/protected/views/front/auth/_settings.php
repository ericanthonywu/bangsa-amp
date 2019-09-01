<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Pengaturan User';
$this->breadcrumbs=array(
	'Pengaturan User',
);
?>
<?php 

	//print_r($query);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<!-- Start List Berita -->
		<div class="list-search-berita">
		<?php 
			$messages = Yii::app()->user->getFlashes();
			foreach($messages as $key => $message):?>
			<div class="alert alert-dismissable alert-<?php echo $key; ?> errorMessage">
				<?php echo $message; ?>
			</div>
		<?php endforeach; ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'page-form',
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
			<div class="span3">
				<div style="margin:10px 0 0 0;">
					<label for="settings_password">
						Password
					</label>
					<div></div>
					<input class="form-control" id="settings_password" type="password" name="Auth[password]" value="" />
				</div>
				<div style="margin:10px 0 0 0;">
					<label for="settings_password">
						Ketik Ulang Password
					</label>
					<div></div>
					<input class="form-control" id="settings_repassword" type="password" name="Auth[repassword]" value="" />
				</div>
				<div style="margin:10px 0 0 0;">
					<label for="settings_finame">
						Firstname
					</label>
					<div></div>
					<input class="form-control" id="settings_finame" type="text" name="Auth[firstname]" value="<?php echo $aw['firstname']; ?>" />
				</div>
				<div style="margin:10px 0 0 0;">
					<label for="settings_lname">
						Lastname
					</label>
					<div></div>
					<input class="form-control" id="settings_lname" type="text" name="Auth[lastname]" value="<?php echo $aw['lastname']; ?>" />
				</div>
				<div style="margin:10px 0 0 0;">
					<label for="settings_fname">
						Email
					</label>
					<div></div>
					<input class="form-control" id="settings_fname" type="email" name="Auth[email]" value="<?php echo $aw['email']; ?>" />
				</div>
				<div style="margin:10px 0 0 0;">
					<input type="file" name="Auth[filename]" />
				</div>
				<div style="margin:10px 0 0 0;">
					<input class="btn" style="padding-bottom:9px;" type="submit" name="submit" value="Simpan"/>
				</div>
			</div>
			<div class="span4">				
				<?php if(isset($au['filename'])):?>
					<div>
						<div>Gambar Sekarang</div>
						<img src="<?php echo Yii::app( )->getBaseUrl( )."/images/uploads/user/".$au['filename']; ?>" />
					</div>
				<?php endif;?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
