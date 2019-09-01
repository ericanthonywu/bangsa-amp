<!-- Start Hot News -->
<div class="tab-berita mb1 mt1">
	<ul class="tabhome">
		<li id="tab-hotnews"><a href="#terkini" class="mw85">TERKINI</a></li>
	</ul>
	<div class="content-tabhome" id="terkini">
		<ul id="list-hotnews">
			<?php 
				$news_terknini_q  = "SELECT b.news_id,b.news_slug,b.news_title,b.news_excerpt,b.news_date,b.news_content,f.filename FROM module_news b INNER JOIN files f ON(b.news_id=f.object_id) WHERE f.module_id ='1' AND b.news_type='1' AND b.news_status='1' ORDER BY b.news_id DESC LIMIT 10";
				$news_terkini_qr	= Yii::app()->db->createCommand($news_terknini_q)->queryAll();
				foreach($news_terkini_qr as $value_terkini){
			?>
					<li>		
						<div class="title-newstab">
							<span class="time-newstab custom_time"><?php echo date('H:i',strtotime($value_terkini['news_date'])); ?> - </span>
							<a title="<?php echo strip_tags($value_terkini['news_title']); ?>" href="<?php echo get_link_berita('berita',$value_terkini['news_id'],$value_terkini['news_slug']);?>"><?php echo get_excerpt($value_terkini['news_title'], 32); ?></a>
						</div>
						<div class="clearfix"></div>
					</li>
			<?php
				// Hotnewssticky foreach end;
				}
			?>
		</ul>

	</div>
</div>
<!-- End Hot News -->
<div class="clear height-10"></div>