<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Edit User';
$this->breadcrumbs=array(
	'Edit User',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb mt1 mb1">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="clearfix"></div>
		<div class="block-registrasi mt1">
			<div class="title-block-registrasi"><h1>Edit Data User</h1></div>
			<div class="content-block-registrasi">
				<form action="" method="">
					<div class="group_registrasi">
						<label class="">Nama</label>
						<input type="text" name="nama" />
					</div>
					<div class="group_registrasi">
						<label class="">Username</label>
						<input type="text" name="username" />
					</div>
					<div class="group_registrasi">
						<label class="">Email</label>
						<input type="text" name="email" />
					</div>
					<div class="group_registrasi">
						<label class="">Password</label>
						<input type="password" name="password" />
					</div>
					<div class="group_registrasi">
						<label class="">Ulangi Password</label>
						<input type="password" name="confirm_password" />
					</div>
					<div class="group_registrasi">
						<input type="submit" value="EDIT USER" />
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-1.jpg" />
		</div>
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-2.jpg" />
		</div>
	</div>
</div>
