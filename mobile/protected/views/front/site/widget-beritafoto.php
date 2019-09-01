<div class="block-berita-foto mt1 mb1">
	<div class="top-block-berita-foto" id="">
		<div class="title-cat-berita df_top_section">
			<h3><a href="<?php echo Yii::app()->createUrl("beritafoto"); ?>">BERITA FOTO</a></h3>
			<div class="clearfix"></div>
		</div>
		<?php
		$bottom_photos_news =Yii::app()->cache->get('bottom_photo_news_m');
		if($bottom_photos_news===false)
		{
			// Get 4 Photos 
			$sqlphotonews = "SELECT b.news_id, b.news_title, b.news_slug, b.news_date, fls.caption_title,fls.caption_desc,fls.filename 
			FROM `view_latest_news` `b` 
			LEFT JOIN `view_files` `fls` ON(fls.object_id=b.news_id)
			WHERE b.news_status='1' AND b.news_type='2' ORDER BY b.news_id DESC LIMIT 4";
			$dataphotonews	= Yii::app()->db->createCommand($sqlphotonews)->queryAll();

			Yii::app()->cache->set('bottom_photo_news_m', $dataphotonews, 300);
		}else{
				$dataphotonews = $bottom_photos_news;
		}
		?> 

		<div class="image-berita img-large">
			<a href="<?php echo get_link_berita("beritafoto",$dataphotonews[0]['news_id'],$dataphotonews[0]['news_slug']); ?>">
				<?php if(!empty($dataphotonews[0]['filename'])){ ?>
					<?php echo get_image($dataphotonews[0]['filename'],"berita",'340x170',$dataphotonews[0]['caption_title']); ?>
				<?php } ?>
			</a>
		</div>
		<div class="title-berita customs_bl">
			<div class="clearfix height-5"></div>
			<span class="time-newstab tgl-berita">
			<?php echo get_time($dataphotonews[0]['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
			</span>
			<div class="clearfix height-5"></div>
			<a href="<?php echo get_link_berita("beritafoto",$dataphotonews[0]['news_id'],$dataphotonews[0]['news_slug']); ?>"><?php echo $dataphotonews[0]['news_title']; ?></a>
		</div>
		<div class="clearfix height-15"></div>
		<div class="foto-berita-lain">
			<ul style="margin-bottom:0;" class="df_list_section">
				<?php
					$i = 0;		
					foreach($dataphotonews as $dfoto2) {
					if($i != 0){
				?>
				<li>
					<div class="picture_news_df">
						<a title="<?php echo strip_tags($dfoto2['news_title']); ?>" href="<?php echo get_link_berita('berita',$dfoto2['news_id'],$dfoto2['news_slug']);?>">
					<?php if(!empty($dfoto2['filename'])){ ?>
						<?php echo get_image($dfoto2['filename'],"berita",'100x100',$dfoto2['caption_title']); ?>
					<?php } ?>
						</a>
					</div>
					<div class="title-newstab">
						<span class="time-newstab">
						<?php echo get_time($dfoto2['news_date'],"dd MMMM yyyy | HH:MM",'yes'); ?>
						</span>
						<a title="<?php echo strip_tags($dfoto2['news_title']); ?>" href="<?php echo get_link_berita('berita',$dfoto2['news_id'],$dfoto2['news_slug']);?>"><?php echo $dfoto2['news_title']; ?></a>
					</div>
					<div class="clearfix"></div>
				</li>
				<?php  } 
					$i++;
				} ?>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>	
</div>