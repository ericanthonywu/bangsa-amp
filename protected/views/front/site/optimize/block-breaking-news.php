<?php
	$sqlbreaking 		= "SELECT news_id,news_title,news_slug FROM module_news WHERE news_type = '1' AND news_status='1' ORDER BY news_id DESC LIMIT 5";
	$databreakingnews	= Yii::app()->db->createCommand($sqlbreaking)->queryAll(); 
?>
<div class="breaking-news mt1 mb1 clearfix">
	<div class="title-breaking-news">BREAKING NEWS</div>
	<div class="arrow-right"></div>
	<div class="content-breaking-news">
		<ul id="list-breaking-news" class="js-hidden">
			<?php foreach($databreakingnews as $break){ ?>
				<li class="news-item">
					<a href="<?php echo get_link_berita("berita",$break['news_id'],$break['news_slug']); ?>"><?php echo get_excerpt($break['news_title'],73); ?></a>
				</li>
			<?php } ?>
		</ul>			
	</div>
</div>	