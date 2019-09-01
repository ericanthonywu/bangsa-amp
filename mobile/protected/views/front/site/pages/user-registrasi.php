<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Registrasi User';
$this->breadcrumbs=array(
	'Registrasi User',
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
			<div class="title-block-registrasi"><h1>Registrasi User</h1></div>
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
						<input type="submit" value="DAFTAR" />
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
