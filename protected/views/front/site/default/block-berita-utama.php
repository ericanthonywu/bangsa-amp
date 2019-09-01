<div class="block-berita-utama mt1 mb1">
	<div class="title-cat-berita">
		<h3><a href="<?php ?>">BERITA UTAMA</a></h3>
	</div>
	<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">
				<?php 
					$sqlutama  = "SELECT b.news_id,b.news_slug,b.news_title,b.news_excerpt,b.news_date,b.news_content,f.* FROM module_news b INNER JOIN files f ON(b.news_id=f.object_id) WHERE f.module_id ='1' AND b.is_headline = '1' AND b.news_type='1' AND b.news_status='1' ORDER BY b.news_id DESC LIMIT 5";
					$datautama	= Yii::app()->db->createCommand($sqlutama)->queryAll(); 
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