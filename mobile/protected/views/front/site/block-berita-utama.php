<div class="slider-controls" data-snap-ignore="true">        
	<?php 
		$slider_cache =Yii::app()->cache->get('slider_c');
		if($slider_cache===false)
		{
			// $sqlutama  = "SELECT b.news_id,b.news_slug,b.news_title,b.news_date,f.filename FROM module_news b INNER JOIN files f ON(b.news_id=f.object_id) WHERE f.module_id ='1' AND b.is_headline = '1' AND b.news_type='1' AND b.news_status='1' ORDER BY b.news_id DESC LIMIT 5";
			$sqlutama  = "SELECT * FROM `view_slide` ORDER BY news_date DESC LIMIT 5";
			$datautama	= Yii::app()->db->createCommand($sqlutama)->queryAll(); 
			Yii::app()->cache->set('slider_c', $datautama, 300);
		}else{
			$datautama = $slider_cache;
		}
	?>
	<?php foreach($datautama as $dutama){ ?>
	<div style="position:relative"]>
		<?php echo get_image($dutama['filename'],'berita','700x350',$dutama['news_slug'],"","","responsive-image"); ?>
		<p class="title-slider-caption">
			<em><?php echo $dutama['news_date']?></em>
			<strong>
				<a style="color:#FFF !important;" href="<?php echo get_link_berita("berita",$dutama['news_id'],$dutama['news_slug']); ?>">
					<?php echo $dutama['news_title']; ?>
				</a>
			</strong>
		</p>
	</div>
	<?php } ?>
</div>
<a href="#" class="next-slider"></a>
<a href="#" class="prev-slider"></a>
