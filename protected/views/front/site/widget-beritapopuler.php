<div class="block-berita-foto mt1 mb1">
	<div class="top-block-berita-foto">
		<div class="title-cat-berita">
			<h3>BERITA POPULER</h3>
			<div class="clearfix"></div>
		</div>
		<?php
		$berita_populer_cache =Yii::app()->cache->get('popular_news_d');
		if($berita_populer_cache===false)
		{
			$nrmlDate = date('Y-m-d');
			$dates = strtotime($nrmlDate);
			$datex = strtotime("-1 day", $dates);
			$date = date('Y-m-d',$datex);
			$query = Yii::app()->db->createCommand("SELECT news_id, news_title, news_slug, click_count FROM view_latest_news WHERE news_status = 1 AND news_date between '$date' AND '$nrmlDate' ORDER BY click_count DESC, news_id DESC LIMIT 5")->queryAll();

		Yii::app()->cache->set('popular_news_d', $query, 300);
		}else{
			$query = $berita_populer_cache;
		}

		?>
		<ul class="berita-pops">
		<?php foreach($query as $queryx): ?>
			<li>
				<a href="<?php echo get_link_berita("berita",$queryx['news_id'],$queryx['news_slug']) ?>"><?php echo $queryx['news_title']; ?></a>
			</li>
		<?php endforeach;?>
		</ul>
		<div class="clearfix"></div>
	</div>	
</div>