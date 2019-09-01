<?php
$title 			= "Berita Video - Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat";
$keyword 		= "jatim,jatim timur";
$url			= Yii::app()->getBaseUrl(true);

$this->pageTitle = $title;
// Facebook OG
Yii::app()->facebook->ogTags['og:title'] 		= $title; 
Yii::app()->facebook->ogTags['og:image'] 		= $image; 
Yii::app()->facebook->ogTags['og:site_name'] 	= $sitename;
Yii::app()->facebook->ogTags['og:description'] 	= $description; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

// Meta tag
Yii::app()->clientScript->registerMetaTag($description, 'description');
Yii::app()->clientScript->registerMetaTag($keyword, 'keywords');

$this->breadcrumbs=array(
	'Video',
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
		<div class="title-bvideo"><h1>Video</h1></div>
		
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		<div class="first-bvideo-berita">
			<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $datafirst['embed']; ?>?controls=0&showinfo=0&rel=0&autoplay=0&mute=0&enablejsapi=1&origin=<?php echo $url; ?>&widgetid=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
				</div>
			<div class="first-title-bvideo-berita"><h1><a href="<?php echo get_link_berita("berita-video",$datafirst['news_id'],$datafirst['news_slug']); ?>"><?php echo $datafirst['news_title']; ?></a></h1></div>
			<div class="first-content-bvideo-berita">
				<p>
					<?php if(!empty($datafirst['news_excerpt'])){ echo $datafirst['news_excerpt']; }else{  echo get_excerpt($datafirst['news_content'],'250'); } ?>
				</p>
			</div>
		</div>
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<!-- Start List Berita -->
		<div class="list-bvideo-berita">
			<?php 
			foreach($data as $dt){
			?>
			<div class="berita-row mb1">
				<div class="left-bvideo-berita">
					<div class="image-bvideo-berita"><img src="http://img.youtube.com/vi/<?php echo $dt['embed']; ?>/0.jpg" /></div>
				</div>
				<div class="right-bvideo-berita">
					<div class="title-bvideo-berita"><h3><a href="<?php echo get_link_berita("berita-video",$dt['news_id'],$dt['news_slug']); ?>"><?php echo $dt['news_title']; ?></a></h3></div>
					<div class="date-bvideo-berita"><?php echo get_time($datafirst['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?></div>
					<div class="excerpt-bvideo-berita">
						<?php if(!empty($dt['news_excerpt'])){ echo $dt['news_excerpt']; }else{  echo get_excerpt($dt['news_content'],'250'); } ?><span class="readmore_button"><a href="<?php echo get_link_berita("berita-video",$dt['news_id'],$dt['news_slug']); ?>">Baca Selanjutnya</a></span>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="social-sharing-bvideo">
					<!-- AddThis Button BEGIN -->
				<!--	<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515a98304fda50f6"></script>
					<!-- AddThis Button END -->
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
		<div class="pagination">
			<?php 
				$this->widget('CLinkPager', array(
					'itemCount'		=> $item_count,
					'pageSize'		=> $page_size,
					'header'=>'',
					'maxButtonCount' => 8,
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