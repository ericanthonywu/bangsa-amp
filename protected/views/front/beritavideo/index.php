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

// Link Alternate
$mobileurl = 'http://m.bangsaonline.com/';
$mobileurl2 		= "beritavideo/";
Yii::app()->clientScript->registerLinkTag('alternate',null,$mobileurl.$mobileurl2,'only screen and (max-width: 640px)');

$this->breadcrumbs=array(
	'Video',
);
$base_siteurl = 'https://www.bangsaonline.com';
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
		<?php /*
		<div class="first-bvideo-berita">
			<div class="first-image-bvideo-berita">
				<div class="embed-responsive embed-responsive-16by9">
					 <!-- width="700" height="394" -->
				<iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $datafirst['embed']; ?>?controls=0&showinfo=0&rel=0&autoplay=0&mute=0&enablejsapi=1&origin=<?php echo $base_siteurl; ?>&widgetid=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="first-title-bvideo-berita"><h1><a href="<?php echo get_link_berita("berita-video",$datafirst['news_id'],$datafirst['news_slug']); ?>"><?php echo $datafirst['news_title']; ?></a></h1></div>
			<div class="first-content-bvideo-berita">
				<p>
					<?php if(!empty($datafirst['news_excerpt'])){ echo $datafirst['news_excerpt']; }else{  echo get_excerpt($datafirst['news_content'],'250'); } ?>
				</p>
			</div>
		</div>*/ ?>
		<div class="block_featured_kanal">
			<div class="bg_item">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $datafirst['embed']; ?>?controls=0&showinfo=0&rel=0&autoplay=0&mute=0&enablejsapi=1&origin=<?php echo $base_siteurl; ?>&widgetid=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
				</div>
				<div class="info">
					<h2><a href="<?php echo get_link_berita('berita-video',$datafirst['news_id'],$datafirst['news_slug']);?>"><?php echo $datafirst['news_title']; ?></a></h2>
					<div class="clear"></div>
					<div class="date-category-berita post-meta">
						<?php echo get_time($datafirst['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<!-- end featured kanal -->
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<!-- Start List Berita -->
		<div class="list-bvideo-berita list-category-berita">
			<?php 
				foreach($data as $dt){
			?>
			<div class="berita-row mb1">
				<div class="left-bvideo-berita">
					<?php if ($dt['embed']): ?>
					<div class="image-bvideo-berita"><img src="https://img.youtube.com/vi/<?php echo $dt['embed']; ?>/0.jpg" /></div>
					<?php else: ?>
					<div class="image-bvideo-berita">
						<a href="<?php echo get_link_berita('berita-video',$dt['news_id'],$dt['news_slug']);?>">
						<?php echo get_image($dt['filename'],"berita",'150x150',$dt['caption_title']); ?>
						</a>
					</div>
					<?php endif ?>
				</div>
				<?php /*<div class="right-bvideo-berita">
					<div class="title-bvideo-berita"><h3><a href="<?php echo get_link_berita("berita-video",$dt['news_id'],$dt['news_slug']); ?>"><?php echo $dt['news_title']; ?></a></h3></div>
					<div class="date-bvideo-berita"><?php echo get_time($dt['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?></div>
					<div class="excerpt-bvideo-berita">
						<?php if(!empty($dt['news_excerpt'])){ echo $dt['news_excerpt']; }else{  echo get_excerpt($dt['news_content'],'250'); } ?><span class="readmore_button"><a href="<?php echo get_link_berita("berita-video",$dt['news_id'],$dt['news_slug']); ?>">Baca Selanjutnya</a></span>
					</div>
				</div>*/ ?>
				<div class="right-category-berita" >
					<div class="title-category-berita">
						<h3><a href="<?php echo get_link_berita('berita-video',$dt['news_id'],$dt['news_slug']);?>"><?php echo $dt['news_title']; ?></a></h3>
					</div>
					<div class="date-category-berita">
						<?php echo get_time($dt['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
						<!-- <span class="total_comment">19 Komentar</span> -->
					</div>
					<div class="excerpt-category-berita">
						<?php echo get_excerpt($dt['news_content'],360); ?>
						<span class="readmore_button"><a href="<?php echo get_link_berita('berita-video',$dt['news_id'],$dt['news_slug']);?>">Baca Selanjutnya</a></span>
					</div>
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