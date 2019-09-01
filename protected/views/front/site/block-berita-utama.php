<div class="block-berita-utama mt1 mb1">
	<div class="title-cat-berita">
		<h3><a href="<?php ?>">BERITA UTAMA</a></h3>
	</div>
	<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">
				<?php 
					$slider_cache =Yii::app()->cache->get('slider_c');
					if($slider_cache===false)
					{
						$sqlutama  = "SELECT * FROM `view_slide` ORDER BY news_date DESC LIMIT 5";
						$datautama	= Yii::app()->db->createCommand($sqlutama)->queryAll();
						Yii::app()->cache->set('slider_c', $datautama, 300);
					}else{
						$datautama = $slider_cache;
					}
				?>
				<?php foreach($datautama as $dutama){ ?>
				<div class="panel" title="Panel">
					<div class="wrapper">
						<div class="title-meta-data">
							<h1><a href="<?php echo get_link_berita("berita",$dutama['news_id'],$dutama['news_slug']); ?>"><?php echo $dutama['news_title']; ?></a></h1>
						</div>
						<?php echo get_image($dutama['filename'],'berita','700x350',$dutama['news_slug'],'700px','350px'); ?>					
						<div class="photo-meta-data">
							<div class="date-berita"><?php echo $dutama['news_date']?></div>
							<a href="<?php echo get_link_berita("berita",$dutama['news_id'],$dutama['news_slug']); ?>">
								<?php if(!empty($dutama['news_excerpt'])){ echo $dutama['news_excerpt']; }else{  echo get_excerpt($dutama['news_content'],'250'); } ?>
							</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id="movers-row">
			<?php $i ='1'; ?>
			<?php foreach($datautama as $dutama){ ?>	
			<div>
				<a href="#<?php echo $i; ?>" class="cross-link active-thumb">
					<?php echo get_image($dutama['filename'],'berita','135x75',$dutama['news_slug'],'135px','75px',"nav-thumb"); ?>
				</a>
			</div>
			<?php $i++; ?>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>