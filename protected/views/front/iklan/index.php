<?php
$title 			= 'Iklan';
$url		 	= Yii::app()->createAbsoluteUrl(Yii::app()->request->url);


/* Facebook Open Graph */
Yii::app()->facebook->ogTags['og:title'] 		= $title; 
Yii::app()->facebook->ogTags['og:image'] 		= ""; 
Yii::app()->facebook->ogTags['og:site_name'] 	= "Harian Bangsa Online"; 
Yii::app()->facebook->ogTags['og:description'] 	= ""; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

$this->pageTitle=Yii::app()->name . ' - '.$title;
$this->breadcrumbs=array( $title );
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
		<div class="list-iklan">
			<?php foreach($data as $dataiklan){ ?>
				<div><a href="<?php echo get_link($dataiklan['id'],"iklan"); ?>"><?php echo $dataiklan['judul_iklan']; ?></a></div>
			<?php } ?>
			
		</div>
		<div class="pagination">
			<?php 
				$this->widget('CLinkPager', array(
					'itemCount'		=> $item_count,
					'pageSize'		=> $page_size,
					'header'=>'',
					'htmlOptions'=>array('class'=>''),
				));
			?>
		</div>	
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>