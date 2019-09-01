<?php
$title 			= $data['0']['category_name']." | Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat";
$keyword 		= "jatim,jatim timur";
$url			= Yii::app()->getBaseUrl(true).$slug;

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

$this->breadcrumbs=array( $data['0']['category_name'] );
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
		<div class="height-5"></div>
		<div class="title-category df_top_section"><h1><?php echo $data['0']['category_name']; ?></h1></div>
		<?php if($_GET['slug']=="teenage-jurnalism"):?>
			<div style="float:right;"><a href="<?php echo Yii::app()->createUrl('kanal/writer'); ?>">Ingin Menjadi Penulis?</a></div>
		<?php endif;?>
		<div class="height-5"></div>
		<div class="featured_data_kanal list-category-berita">
			<div class="category-berita-row">	
				<?php 
					if(!empty($feature_data['filename'])){
				?>
					<div class="left-category-berita">
						<div class="image-category-berita">			
							<a href="<?php echo get_link_berita('berita',$feature_data['news_id'],$feature_data['news_slug']);?>">
								<?php if(!empty($feature_data['filename'])){ ?>
									<?php echo get_image($feature_data['filename'],"berita",'340x170',$feature_data['caption_title']); ?>
								<?php } ?>
							</a>
						</div>
					</div>
				<?php } ?>
					<div class="title-category-berita">
						<h3><a href="<?php echo get_link_berita('berita',$feature_data['news_id'],$feature_data['news_slug']);?>"><?php echo $feature_data['news_title']; ?></a></h3>
					</div>
					<div class="date-category-berita">
						<?php echo get_time($feature_data['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
						<!-- <span class="total_comment">19 Komentar</span> -->
					</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- end featured kanal -->

		<div class="height-10"></div>

		<div class="list-category-berita">
			<?php foreach($data as $key => $listberita){ ?>
			<?php if($key == 0): continue; endif; ?>
			<div class="category-berita-row">	
				<?php 
					if(!empty($listberita['filename'])){
				?>
					<div class="left-category-berita">
						<div class="image-category-berita">			
							<a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>">
								<?php if(!empty($listberita['filename'])){ ?>
									<?php echo get_image($listberita['filename'],"berita",'100x100',$listberita['caption_title']); ?>
								<?php } ?>
							</a>
						</div>
					</div>
				<?php } ?>
					<div class="title-category-berita">
						<h3><a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>"><?php echo $listberita['news_title']; ?></a></h3>
					</div>
					<div class="date-category-berita">
						<?php echo get_time($listberita['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
						<!-- <span class="total_comment">19 Komentar</span> -->
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
	<div class="decoration"></div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>