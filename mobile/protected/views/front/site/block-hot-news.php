<!-- Start Hot News -->
<div class="tab-berita mb1 mt1">
	<ul class="tabhome">
		<li id="tab-hotnews"><a href="#hotnews">HOT NEWS</a></li>
	</ul>
	<div class="content-tabhome" id="hotnews">
		<ul id="list-hotnews">
			<?php 
				// 2 berita diawal
				$stickyhotnewssql	= "SELECT option_value FROM options WHERE option_id IN (6,7)";
				$stickyhotnews	= Yii::app()->db->createCommand($stickyhotnewssql)->queryAll();
				$stickyhotnewsid = '';
				foreach($stickyhotnews as $sticky){
					$hotnewsid = $sticky['option_value'];
					if(!empty($hotnewsid)){
						$stickyhotnewsid .= $hotnewsid.',';
					}
				}
				$stickyhotnewsid = trim($stickyhotnewsid, ',');
				
				if(!empty($stickyhotnewsid)){
				$stickyhotnewssqltrue = "SELECT news_id,news_title,news_content,news_slug,news_date FROM view_latest_news WHERE news_type='1' AND news_status='1' AND news_id IN ($stickyhotnewsid) ORDER BY news_id DESC";
				$stickyhotnewstrue	= Yii::app()->db->createCommand($stickyhotnewssqltrue)->queryAll();
				foreach($stickyhotnewstrue as $hotnewsstick){
			?>
					<li>		
						<div class="title-newstab">
							<span class="time-newstab"><?php echo date('H:i',strtotime($hotnewsstick['news_date'])); ?> - </span>
							<a title="<?php echo strip_tags($hotnewsstick['news_title']); ?>" href="<?php echo get_link_berita('berita',$hotnewsstick['news_id'],$hotnewsstick['news_slug']);?>"><?php echo get_excerpt($hotnewsstick['news_title'], 32); ?></a>
						</div>
						<div class="clearfix"></div>
					</li>
			<?php
				// Hotnewssticky foreach end;
				}
				
				//Hotnewssticky if end;
				}
			?>
			<?php 
				// 2 berita ditengah 
				$stickyhotnewssqltengah	= "SELECT option_value FROM options WHERE option_id IN (8,9)";
				$stickyhotnewstengah	= Yii::app()->db->createCommand($stickyhotnewssqltengah)->queryAll();
				$stickyhotnewsid1 = '';
				foreach($stickyhotnewstengah as $sticky){
					$hotnewsid = $sticky['option_value'];
					if(!empty($hotnewsid)){
						$stickyhotnewsid1 .= $hotnewsid.',';
					}
				}
				$stickyhotnewsid1 = trim($stickyhotnewsid1, ',');
				
				
			?>
			<?php 	
				$hotnews 		= "SELECT news_id,news_title,news_slug,news_date FROM view_hotnews_latest";  
				$datahotnews	= Yii::app()->db->createCommand($hotnews)->queryAll(); 
				$i = 0;
				foreach($datahotnews as $dhotnews){
					$i++;
					
						if($i=='5'){
							
							if(!empty($stickyhotnewsid1)){
								$stickyhotnewssqltrue1 = "SELECT news_id,news_title,news_content,news_slug,news_date FROM view_latest_news WHERE news_type='1' AND news_status='1' AND news_id IN ($stickyhotnewsid1) ORDER BY news_id DESC";
								$stickyhotnewstrue1	= Yii::app()->db->createCommand($stickyhotnewssqltrue1)->queryAll();
								foreach($stickyhotnewstrue1 as $hotnewsstick){ 
								?>
								
										<li>		
								<div class="title-newstab">
									<span class="time-newstab"><?php echo date('H:i',strtotime($hotnewsstick['news_date'])); ?> - </span>
									<a title="<?php echo strip_tags($hotnewsstick['news_title']); ?>" href="<?php echo get_link_berita('berita',$hotnewsstick['news_id'],$hotnewsstick['news_slug']);?>"><?php echo get_excerpt($hotnewsstick['news_title'], 32); ?></a>
								</div>
								<div class="clearfix"></div>
							</li>
							<?php	
								}
								
							}
							
							//
							//}
						}	
							
						
				?>		
			<li>		
				<div class="title-newstab">
					<span class="time-newstab"><?php echo date('H:i',strtotime($dhotnews['news_date'])); ?> - </span>
					<a title="<?php echo strip_tags($dhotnews['news_title']); ?>" href="<?php echo get_link_berita('berita',$dhotnews['news_id'],$dhotnews['news_slug']);?>"><?php echo get_excerpt($dhotnews['news_title'], 32); ?></a>
				</div>
				<div class="clearfix"></div>
			</li>
			<?php } ?>
			
			
			
			
			<?php 
				// 2 berita diakhir
				$stickyhotnewssql	= "SELECT option_value FROM options WHERE option_id IN (10,11)";
				$stickyhotnews	= Yii::app()->db->createCommand($stickyhotnewssql)->queryAll();
				$stickyhotnewsid = '';
				foreach($stickyhotnews as $sticky){
					$hotnewsid = $sticky['option_value'];
					if(!empty($hotnewsid)){
						$stickyhotnewsid .= $hotnewsid.',';
					}
				}
				$stickyhotnewsid = trim($stickyhotnewsid, ',');
				
				if(!empty($stickyhotnewsid)){
				$stickyhotnewssqltrue = "SELECT news_id,news_title,news_content,news_slug,news_date FROM view_latest_news WHERE news_type='1' AND news_status='1' AND news_id IN ($stickyhotnewsid) ORDER BY news_id DESC";
				$stickyhotnewstrue	= Yii::app()->db->createCommand($stickyhotnewssqltrue)->queryAll();
				foreach($stickyhotnewstrue as $hotnewsstick){
			?>
					<li>		
						<div class="title-newstab">
							<span class="time-newstab"><?php echo date('H:i',strtotime($hotnewsstick['news_date'])); ?> - </span>
							<a title="<?php echo strip_tags($hotnewsstick['news_title']); ?>" href="<?php echo get_link_berita('berita',$hotnewsstick['news_id'],$hotnewsstick['news_slug']);?>"><?php echo get_excerpt($hotnewsstick['news_title'], 32); ?></a>
						</div>
						<div class="clearfix"></div>
					</li>
			<?php
				// Hotnewssticky foreach end;
				}
				
				//Hotnewssticky if end;
				}
			?>
		</ul>
		<a href="<?php echo Yii::app()->getBaseUrl(true)."/"; ?>indeks" class="hotnews_readmorelink">Baca Selanjutnya</a>
	</div>
</div>
<!-- End Hot News -->