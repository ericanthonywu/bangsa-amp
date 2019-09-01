<div class="block-berita-foto mt1 mb1">
	<div class="top-block-berita-foto">
		<div class="title-cat-berita">
			<h3><a href="<?php echo Yii::app()->createUrl("beritafoto"); ?>">BERITA FOTO</a></h3>
			<div class="clearfix"></div>
		</div>
		<?php
			$bottom_photos_news =Yii::app()->cache->get('bottom_photo_news_d');
			if($bottom_photos_news===false)
			{
				// get latest photo
				$sqlp1 		= "SELECT b.*,f.* 
				FROM view_latest_news b 
				LEFT JOIN view_files f ON(f.object_id=b.news_id) 
				WHERE f.module_id='1' AND news_status='1' AND news_type='2' ORDER BY news_id DESC LIMIT 1";
				$datafoto1	= Yii::app()->db->createCommand($sqlp1)->queryRow(); 

				Yii::app()->cache->set('bottom_photo_news_d', $datafoto1, 300);
			}else{
					$datafoto1 = $bottom_photos_news;
			}

			$first_id = $datafoto1['news_id'];
		?> 
		<div class="image-berita img-large">
			<a href="<?php echo get_link_berita("beritafoto",$datafoto1['news_id'],$datafoto1['news_slug']); ?>">
				<?php echo get_image($datafoto1['filename'],'berita','340x170',$datafoto1['news_slug'],'340px','170px'); ?>
			</a>
		</div>
		<div class="title-berita"><a href="<?php echo get_link_berita("beritafoto",$datafoto1['news_id'],$datafoto1['news_slug']); ?>"><?php echo $datafoto1['news_title']; ?></a></div>
		<div class="foto-berita-lain">
			
			<?php 
			$bottom_photos_news2 =Yii::app()->cache->get('bottom_photo_news_d2');
			if($bottom_photos_news2===false)
			{
				if(!empty($first_id)){
					$sqlp2 		= "SELECT * FROM view_latest_news WHERE news_id NOT IN($first_id) AND news_status='1' AND news_type='2' ORDER BY news_id DESC LIMIT 4";
					$datafoto2	= Yii::app()->db->createCommand($sqlp2)->queryAll(); 	
				}else{
					$sqlp2 		= "SELECT * FROM view_latest_news WHERE news_status='1' AND news_type='2' ORDER BY news_id DESC LIMIT 4";
					$datafoto2	= Yii::app()->db->createCommand($sqlp2)->queryAll(); 	
				}

				Yii::app()->cache->set('bottom_photo_news_d2', $datafoto2, 300);
			}else{
					$datafoto2 = $bottom_photos_news2;
			}
			?>
			<ul>
				<?php foreach($datafoto2 as $dfoto2) { ?>
				<?php 
					$idne = $dfoto2['news_id'];
					$sqlphotone = "SELECT b.*,f.* FROM view_latest_news b INNER JOIN view_files f ON(f.object_id=b.news_id) WHERE f.module_id='1' AND news_status='1' AND news_type='2' AND b.news_id='$idne' ORDER BY news_id DESC";
					$datafotone	= Yii::app()->db->createCommand($sqlphotone)->queryRow(); 	
				?>
				<li>
					<div class="image-berita-lain">
						<?php echo get_image($datafotone['filename'],'berita','135x75',$datafotone['news_slug'],'135px','75px'); ?>
					</div>
					<div class="title-berita-lain"><a href="<?php echo get_link_berita("beritafoto",$dfoto2['news_id'],$dfoto2['news_slug']); ?>"><?php echo $dfoto2['news_title']; ?></a></div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>	
</div>