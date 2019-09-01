<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Full Width';
$this->breadcrumbs=array(
	'Full Width',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="mt2 mb1 block-iklan-2 tcenter">
			<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-konten.jpg" /></a>
		</div>
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="block-fullwidth">
			<div class="title-block-fullwidth"><h1>Tentang Bangsa Online</h1></div>
			
			<?php 
				$connection = Yii::app()->db;
				$command	= $connection->createCommand("SELECT *FROM `users` ");
				$dataReader	= $command->query();
				
				//$rows=$dataReader->readAll();
				
			?>
			
			
	
			
			<div class="content-block-fullwdith">
				<?php for($i=1;$i <5;$i++){ ?>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis purus a orci hendrerit vehicula id at risus. Nam mauris lorem, accumsan non leo ut, adipiscing porta urna. Vestibulum a ultrices elit, non semper augue. Curabitur tellus libero, viverra vitae quam vitae, ultrices tempus dolor. Aenean tempor enim erat. Donec non lorem convallis purus ornare porttitor a nec lectus. Nulla vestibulum euismod urna, vitae mollis diam placerat sit amet. Nulla hendrerit augue sed orci porta, id facilisis turpis commodo.</p>
				<?php } ?>
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
