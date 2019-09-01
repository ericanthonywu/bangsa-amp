<?php 
	$getVideoLast = Yii::app()->db->createCommand("SELECT * FROM view_latest_news WHERE news_type=3 AND news_status=1 ORDER BY news_id DESC LIMIT 1")->queryRow();
	// var_dump($getVideoLast);
?>
<?php if ( count($getVideoLast) > 0 AND  $getVideoLast['embed'] !== ''): ?>
<div class="blocks_home_feature block-berita-4 mt1 mb1">
	<div class="title-cat-berita">
			<h3><a href="<?php echo Yii::app()->createUrl('/berita-video'); ?>">VIDEO</a></h3>
			<div class="clearfix"></div>
		</div>	

	<div class="thumbnails">
		<a href="<?php echo get_link_berita('berita-video',$getVideoLast['news_id'],$getVideoLast['news_slug']);?>"><img src="https://img.youtube.com/vi/<?php echo $getVideoLast['embed'] ?>/mqdefault.jpg" alt=""></a>
	</div>
	<div class="infos">
		<a href="<?php echo get_link_berita('berita-video',$getVideoLast['news_id'],$getVideoLast['news_slug']);?>"><span class="names"><?php echo $getVideoLast['news_title'] ?></span></a>
		<div class="tgl-berita"><?php echo get_time($getVideoLast['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
		<div class="content-berita">
			<?php echo get_excerpt($getVideoLast['news_content'],250); ?>
		</div>
	</div>
	<div class="clear clearfix"></div>
</div>
<?php endif ?>