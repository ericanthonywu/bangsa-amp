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
		<div class="title-category"><h1><?php echo $data['0']['category_name']; ?></h1></div>
		<?php if($_GET['slug']=="teenage-jurnalism"):?>
			<div style="float:right;"><a href="<?php echo Yii::app()->createUrl('kanal/writer'); ?>">Ingin Menjadi Penulis?</a></div>
		<?php endif;?>
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<div class="block_featured_kanal">
			<div class="bg_item">
				<?php echo get_image($data[0]['filename'],"berita",'700x350',$data[0]['caption_title']); ?>
				<div class="info">
					<h2><a href="<?php echo get_link_berita('berita',$data[0]['news_id'],$data[0]['news_slug']);?>"><?php echo $data[0]['news_title']; ?></a></h2>
					<div class="clear"></div>
					<div class="date-category-berita post-meta">
						<?php echo get_time($data[0]['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<!-- end featured kanal -->

		<div class="clear height-30"></div>
		<div class="list-category-berita">
			<?php foreach($data as $keys => $listberita){ ?>
			<?php if ($keys == 0){ continue; } ?>
			<div class="berita-row mb1">	
				<?php 
					if(!empty($listberita['filename'])){
				?>
					<div class="left-category-berita">
						<div class="image-category-berita">			
							<a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>">
								<?php echo get_image($listberita['filename'],"berita",'150x150',$listberita['caption_title']); ?>
							</a>
						</div>
					</div>
				<?php } ?>
				<div class="right-category-berita" <?php if(empty($listberita['filename'])){ ?>style="width:100%!important"<?php } ?> >
					<div class="title-category-berita">
						<h3><a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>"><?php echo $listberita['news_title']; ?></a></h3>
					</div>
					<div class="date-category-berita">
						<?php echo get_time($listberita['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
						<!-- <span class="total_comment">19 Komentar</span> -->
					</div>
					<div class="excerpt-category-berita">
						<?php echo get_excerpt($listberita['news_content'],360); ?>
						<span class="readmore_button"><a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>">Baca Selanjutnya</a></span>
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
					'maxButtonCount' => 7,
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