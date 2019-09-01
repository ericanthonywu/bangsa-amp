<?php
/* @var $this KanalController */
$title 			= $data['0']['tag_name'];
$url		 	= Yii::app()->createAbsoluteUrl(Yii::app()->request->url);


/* Facebook Open Graph */
Yii::app()->facebook->ogTags['og:title'] 		= $title; 
Yii::app()->facebook->ogTags['og:image'] 		= ""; 
Yii::app()->facebook->ogTags['og:site_name'] 	= "Harian Bangsa Online"; 
Yii::app()->facebook->ogTags['og:description'] 	= ""; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

$this->pageTitle=Yii::app()->name . ' - '.$title;
$this->breadcrumbs=array( $data['0']['tag_name'] );

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
		<div class="title-tag df_top_section"><h1>Topik : <?php echo $data['0']['tag_name']; ?></h1></div>
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<div class="list-category-berita">
			<?php foreach($data as $listberita){ ?>
			<div class="berita-row mb1">	
				<?php 
					$news_slug 	= $listberita['news_slug'];
					$news_id 	= $listberita['news_id'];
					$getimage 	= "SELECT caption_title,caption_desc,filename FROM files WHERE object_id = '$news_id' AND module_id = '1' ";
					$dataimg 	= Yii::app()->db->createCommand($getimage)->queryRow();   
					if(!empty($dataimg)){
				?>
					<div class="left-category-berita">
						<div class="image-category-berita">			
							<a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>">
								<?php if(!empty($dataimg['filename'])){ ?>
									<?php echo get_image($dataimg['filename'],"berita",'340x170',$dataimg['caption_title']); ?>
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
					<div class="excerpt-category-berita">
						<?php echo get_excerpt($listberita['news_content'],360); ?>
						<span class="readmore_button"><a href="<?php echo get_link_berita('berita',$listberita['news_id'],$listberita['news_slug']);?>">Baca Selanjutnya</a></span>
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