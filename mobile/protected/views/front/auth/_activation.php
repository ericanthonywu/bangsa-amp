<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Aktivasi User';
$this->breadcrumbs=array(
	'Aktivasi User',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1">
		
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		<!-- Start List Berita -->
		<div class="list-search-berita">
			<?php foreach($model as $zz):?>
					Selamat username <strong><?php echo $zz['username']; ?></strong> berhasil melakukan aktifasi.<br />
					Silakan <strong><a href="<?php echo Yii::app()->createUrl("user/login"); ?>">LOGIN</a></strong>
			<?php endforeach;?>
		</div>
		
	</div>
</div>
