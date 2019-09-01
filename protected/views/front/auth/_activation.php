<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Aktivasi User';
$this->breadcrumbs=array(
	'Aktivasi User',
);
?>
<?php 

	//print_r($query);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		<!-- Start List Berita -->
		<div class="list-search-berita">
			<?php foreach($model as $zz):?>
					Selamat username <strong><?php echo $zz['username']; ?></strong> berhasil melakukan aktifasi.<br />
					Silakan <strong><a href="<?php echo Yii::app()->createUrl("user/login"); ?>">LOGIN</a></strong>
			<?php endforeach;?>
		</div>
		
	</div>
	
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
