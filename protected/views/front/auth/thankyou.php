<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Terimakasih';
$this->breadcrumbs=array(
	'Terimakasih',
);
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
		<?php 
			$messages = Yii::app()->user->getFlashes();
			if(count($messages)>0):
			foreach($messages as $key => $message):?>
			<div class="alert alert-dismissable alert-<?php echo $key; ?> errorMessage">
				<?php echo $message; ?>
			</div>
		<?php endforeach;
			else:
				$this->redirect(Yii::app()->getBaseUrl(true));
			endif;?>
		</div>
		
	</div>
	
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
