<?php 
	$dynamicblock 		= "SELECT block_title,block_type, block_style, block_object_id FROM block_mobile WHERE block_type != 'root' ORDER BY lft ASC";
	$datablock			= Yii::app()->db->createCommand($dynamicblock)->queryAll(); 
	foreach($datablock as $keysL => $datab){
?>
	<?php if($datab['block_type'] == "category"){ ?>
	<?php 
		// select this category 
		$thiscat 		= $datab['block_object_id'];
		$sqlselectcat 	= "SELECT category_slug FROM category WHERE category_id ='$thiscat'";
		$datacat		= Yii::app()->db->createCommand($sqlselectcat)->queryRow();
		
		// Select Latest 3 News
		// $sqllatestnews = "SELECT b.news_id,b.news_slug,b.news_title,b.news_date,
		// 				fls.caption_title, fls.caption_desc, fls.filename
		// 				FROM category_relationship cr 
		// 				INNER JOIN module_news b ON(cr.post_id = b.news_id) 
		// 				LEFT JOIN `files` fls ON(fls.object_id=b.news_id)
		// 				WHERE cr.category_id = '$thiscat' AND b.news_type=1 AND b.news_status =1 AND fls.module_id =1 ORDER BY b.news_id DESC LIMIT 3";
		$latest_news_c_{$keysL} =Yii::app()->cache->get('latest_news_kanalc_'.$keysL);
		if($latest_news_c_{$keysL}===false)
		{
			$sqllatestnews = "SELECT * FROM view_kanal_news b
								WHERE b.category_id = '$thiscat' 
								AND b.news_type=1 
								AND b.news_status=1
								AND b.module_id=1
								ORDER BY b.news_id DESC LIMIT 3";
			
			$lastestnews	= Yii::app()->db->createCommand($sqllatestnews)->queryAll();
			Yii::app()->cache->set('latest_news_kanalc_'.$keysL, $lastestnews, 300);
		}else{
			$lastestnews = $latest_news_c_{$keysL};
		}	
	?>
			
		<?php if($datab['block_style'] =='1' || $datab['block_style'] =='0' ){ ?>
			<div class="subs4 block-berita-1 mt1" id="<?php echo $datacat['category_slug'].'-'.$thiscat; ?>">
				<div class="title-cat-berita df_top_section">
					<h3><a href="<?php echo get_link($datacat['category_slug'],"kanal"); ?>">
						<?php echo $datab['block_title']; ?></a>
					</h3>
					<div class="clearfix"></div>
				</div>
				<div class="list-block-berita-1">
					<ul class="df_list_section">
						<?php foreach($lastestnews as $lnews){ ?>
						<?php	
							//get latest news running berita 
							$idnewslist = $lnews['news_id'];
							$sqlrun2 	= "SELECT r.running_title FROM running_news_relationship rl INNER JOIN running_news r ON(rl.running_id = r.id) WHERE rl.post_id ='$idnewslist' ";
							$datarun2	= Yii::app()->db->createCommand($sqlrun2)->queryRow();
						?>
							<li>
								<div class="picture_news_df">
									<a href="<?php echo get_link_berita("berita",$lnews['news_id'],$lnews['news_slug']); ?>">
								<?php if(!empty($lnews['filename'])){ ?>
									<?php echo get_image($lnews['filename'],"berita",'100x100',$lnews['caption_title']); ?>
								<?php } ?>
									</a>
								</div>
								<div class="date-berita"><?php echo get_time($lnews['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
								<div class="running-berita"><?php echo $datarun2['running_title']; ?></div>
								<div class="link-berita">
									<a href="<?php echo get_link_berita("berita",$lnews['news_id'],$lnews['news_slug']); ?>"><?php echo $lnews['news_title']; ?></a>
								</div>
								<div class="clearfix"></div>
							</li>
						<?php } ?>
						</ul>
					</div>
			</div>
				<!-- End Block Type 1 -->
				<!-- <div class="decoration"></div> -->
				
			<?php }else{ ?>
				<!-- Start Block Style 2 -->
				<div class="subs4 block-berita-2" id="<?php echo $datacat['category_slug'].$thiscat; ?>">
					<div class="top-block-berita-2">
						<div class="title-cat-berita df_top_section">
							<h3><a href="<?php echo get_link($datacat['category_slug'],"kanal"); ?>"><?php echo $datab['block_title']; ?></a></h3>
						</div>
						<div class="clearfix"></div>				
					</div>				
					<div class="list-block-berita-2">
						<ul class="df_list_section">
							<?php foreach($lastestnews as $lnews){ ?>
							<?php	
								//get latest news running berita 
								$idnewslist = $lnews['news_id'];
								$sqlrun2 	= "SELECT r.running_title FROM running_news_relationship rl INNER JOIN running_news r ON(rl.running_id = r.id) WHERE rl.post_id ='$idnewslist' ";
								$datarun2	= Yii::app()->db->createCommand($sqlrun2)->queryRow();
							?>
							<li>
								<div class="picture_news_df">
										<a href="<?php echo get_link_berita("berita",$lnews['news_id'],$lnews['news_slug']); ?>">
									<?php if(!empty($lnews['filename'])){ ?>
										<?php echo get_image($lnews['filename'],"berita",'100x100',$lnews['caption_title']); ?>
									<?php } ?>
										</a>
								</div>
								<div class="date-berita"><?php echo get_time($lnews['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
								<div class="running-berita"><?php echo $datarun2['running_title']; ?></div>
								<div class="link-berita">
									<a href="<?php echo get_link_berita("berita",$lnews['news_id'],$lnews['news_slug']); ?>"><?php echo $lnews['news_title']; ?></a>
								</div>
								<div class="clearfix"></div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div> 
				<!-- <div class="decoration"></div> -->
	
			<?php }?>

		<?php }elseif($datab['block_type'] == "iklan"){ ?>
			<?php 
				$iklanid = $datab['block_object_id'];	
			?>
			<div class="block-iklan-2 mt1" style="text-align:center;">
				<div class="clearfix"></div>
			<?php 	if($datab['block_style'] == 1):
						$sqliklankontent = "SELECT f.filename,mi.id,mi.link_iklan,mi.is_external FROM module_iklan mi INNER JOIN files f ON(mi.id=f.object_id) WHERE f.module_id='2' AND mi.id='$iklanid' ";
						$dataiklan = Yii::app()->db->createCommand($sqliklankontent)->queryRow(); 
						if($dataiklan['is_external'] =='1'){ $link = $dataiklan['link_iklan']; }else{ $link = get_link($dataiklan['id'],"iklan"); }  ?>
						<a href="<?php echo $link; ?>" target="_blank">
							<?php echo get_image($dataiklan['filename'],'iklan',null); ?>
						</a>
			<?php 	else:
						$sqliklankontent = "SELECT mi.keterangan_iklan FROM module_iklan mi WHERE mi.id='$iklanid' ";
						$dataiklan = Yii::app()->db->createCommand($sqliklankontent)->queryRow(); 
						echo $dataiklan['keterangan_iklan'];
					endif;?>
			</div>
			<div class="clearfix"></div>
		<?php }elseif($datab['block_type'] == "separator"){ ?>
			<!--<div class="separator-block mt1 mb1"></div> 
			<div class="clear"></div>-->
		<?php }else{ ?>
		
		<?php } ?>
		<?php } ?>	