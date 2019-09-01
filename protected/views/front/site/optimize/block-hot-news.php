<!-- Start Hot News -->
<div class="tab-berita mb2">
	<ul class="tabhome">
		<li id="tab-hotnews"><a href="#hotnews">HOT NEWS</a></li>
	</ul>
	<div class="content-tabhome" id="hotnews">
		<ul id="list-hotnews">
			<?php
				$hotnews 		= "SELECT news_id,news_title,news_content,news_slug,news_date FROM module_news WHERE news_type='1' AND news_status='1' ORDER BY news_id DESC LIMIT 20";  
				$datahotnews	= Yii::app()->db->createCommand($hotnews)->queryAll();  
				foreach($datahotnews as $dhotnews){
			?>		
			<li>		
				<div class="title-newstab">
					<span class="time-newstab"><?php echo date('H:i',strtotime($dhotnews['news_date'])); ?> - </span>
					<a href="<?php echo get_link_berita('berita',$dhotnews['news_id'],$dhotnews['news_slug']);?>"><?php echo get_excerpt($dhotnews['news_title'],32); ?></a>
				</div>
				<div class="clearfix"></div>
			</li>
			<?php } ?>
		</ul>
		<a href="<?php echo Yii::app()->getBaseUrl(true)."/"; ?>indeks" class="hotnews_readmorelink">Baca Selanjutnya</a>
	</div>
</div>
<!-- End Hot News -->