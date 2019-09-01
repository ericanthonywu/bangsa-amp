<?php $this->renderPartial('iklan-samping-topik'); ?>	
<?php $this->renderPartial('block-hot-news'); ?>

<!-- Start Dynamic Content -->
<?php 
	$dynamic_widget = "SELECT widget_id,widget_name,widget_type,object_id,widget_group_id,widget_style FROM widget WHERE widget_name !='root' AND widget_group_id='1' ORDER BY lft ASC";
	$datawidget		= Yii::app()->db->createCommand($dynamic_widget)->queryAll(); 
	foreach($datawidget as $dwidget){
?>
<?php if($dwidget['widget_type'] == "separator"){ ?>
	<div class="clearfix"></div>
<?php }elseif($dwidget['widget_type'] == "category"){ ?>
		
		
	<?php
		// sql select category
		$thiscat 		= $dwidget['object_id'];
		$sqlgetslugcat 	= "SELECT category_id,category_slug,category_description FROM category WHERE category_id='$thiscat' ";
		$slugcat		= Yii::app()->db->createCommand($sqlgetslugcat)->queryRow();  	
		
		// get last news from cat
		$sqlastnewscat 	= "SELECT b.news_id,b.news_content,b.news_title,b.news_date,b.news_slug,b.ayat,b.oleh,cr.post_id,cr.category_id FROM module_news b INNER JOIN category_relationship cr ON(cr.category_id='$thiscat') WHERE cr.post_id = b.news_id AND news_type='1' AND b.news_status =1 ORDER BY b.news_id DESC LIMIT 1";
		$lastnewscat	= Yii::app()->db->createCommand($sqlastnewscat)->queryRow();
		$newsid = $lastnewscat['news_id'];
		
		// get image from latest news
		$sqlimagenews 	= "SELECT filename FROM files WHERE object_id = '$newsid' AND module_id='1' ORDER BY id DESC ";
		$dataimgnews	= Yii::app()->db->createCommand($sqlimagenews)->queryRow();			
	?>
	
	<?php if($dwidget['widget_style'] == "1" || $dwidget['widget_style'] == "0"){ ?>
	<!-- Widget Category Style 1 , Big Photo -->
	<div class="block-berita-3 mt1 mb1">
		<div class="top-block-berita-3">
	
			<div class="title-cat-berita">
				<h3><a href="<?php echo get_link($slugcat['category_slug'],"kanal"); ?>"><?php echo $dwidget['widget_name']; ?></a></h3>
				<span><a href="<?php echo get_link($slugcat['category_slug'],"kanal"); ?>">Indeks</a></span>
				<div class="clearfix"></div>
			</div>
			<?php 
						
			?>
			<?php if(!empty($dataimgnews)){ ?>
			<div class="image-berita img-large">
				<a href="<?php echo get_link_berita("berita",$lastnewscat['news_id'],$lastnewscat['news_slug']); ?>">
					<?php echo get_image($dataimgnews['filename'],'berita','340x170',$lastnewscat['news_slug'],'340px','170px'); ?>
				</a>
			</div>
			<?php } ?>
			<div class="title-berita">
				<a href="<?php echo get_link_berita("berita",$lastnewscat['news_id'],$lastnewscat['news_slug']); ?>"><?php echo $lastnewscat['news_title']; ?></a>
			</div>
			<div class="tgl-berita"><?php echo get_time($lastnewscat['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
			<div class="content-berita">
				<?php echo get_excerpt($lastnewscat['news_content'],250); ?>
			</div>
		</div>		
	</div>
	<?php }else{ ?>
		<!-- Widget Category Style 2 , Small Photo -->
		<div class="block-berita-4 mt1 mb1">
			<div class="top-block-berita-4">
				<div class="title-cat-berita">
					<h3><a href="<?php echo get_link($slugcat['category_slug'],"kanal"); ?>"><?php echo $dwidget['widget_name']; ?></a></h3>
					<span><a href="<?php echo get_link($slugcat['category_slug'],"kanal"); ?>">Indeks</a></span>
					<div class="clearfix"></div>
				</div>
				<?php 
					// khusus tafsir alquran aktual, id =58 . 
					if($thiscat !='58'){					
				?>
					<?php if(!empty($dataimgnews)){ ?>
						<div class="image-berita img-thumb">
							<a href="<?php echo get_link_berita("berita",$lastnewscat['news_id'],$lastnewscat['news_slug']); ?>">
								<?php echo get_image($dataimgnews['filename'],'berita','100x100',$lastnewscat['news_slug'],'100px','100px'); ?>
							</a>
						</div>
					<?php } ?>
				<?php }else{ ?>
					<div class="image-berita img-thumb">
						<a href="<?php echo get_link_berita("berita",$lastnewscat['news_id'],$lastnewscat['news_slug']); ?>">
							<img class="" alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/img/default-tafsir.jpg">
						</a>
					</div>
				<?php } ?>
			
				<div class="title-berita">
					<?php if($lastnewscat['ayat']){ ?><div class="ayat"><?php echo $lastnewscat['ayat']; ?></div><?php } ?>
					<a href="<?php echo get_link_berita("berita",$lastnewscat['news_id'],$lastnewscat['news_slug']); ?>"><?php echo $lastnewscat['news_title']; ?></a>
				</div>
				<?php if($thiscat !='58'){	?>
					<?php if($lastnewscat['oleh']){ ?><div class="desc-cat"><?php echo $lastnewscat['oleh']; ?></div><?php } ?>
				<?php } ?>
				<div class="tgl-berita"><?php echo get_time($lastnewscat['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
				<div class="clearfix"></div>
				<?php if($thiscat =='58'){	?>
					<?php if($lastnewscat['oleh']){ ?><div class="desc-cat" style="margin-bottom:5px;"><?php echo $lastnewscat['oleh']; ?></div><?php } ?>
				<?php } ?>
				<div class="content-berita">
					<?php echo get_excerpt($lastnewscat['news_content'],250); ?>
				</div>
			</div>		
		</div>		
	<?php } ?>
<?php }elseif($dwidget['widget_type'] == "iklan"){
		$idwidgiklan = $dwidget['object_id'];?>
	<div class="block-iklan-5 mb2">
	<?php 	if($dwidget['widget_style'] == "1"):
				$sqliklanside = "SELECT mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, f.object_id,f.module_id,f.filename FROM module_iklan mi INNER JOIN files f ON(f.object_id ='$idwidgiklan') WHERE mi.id = '$idwidgiklan' AND f.module_id ='2' ";
				$dataiklanside		= Yii::app()->db->createCommand($sqliklanside)->queryRow();
				if($dataiklanside['is_external'] =='1'){ $link = $dataiklanside['link_iklan']; }else{ $link = get_link($dataiklanside['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>" target="_blank"><?php echo get_image($dataiklanside['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklanside = "SELECT mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan FROM module_iklan mi WHERE mi.id = '$idwidgiklan'";
				$dataiklanside		= Yii::app()->db->createCommand($sqliklanside)->queryRow();

				echo $dataiklanside['keterangan_iklan'];
			endif;?>
	</div>
<?php }else{ ?>
	<div class="clearfix"></div>	
<?php } ?>
<?php } ?>

<?php $this->renderPartial('widget-beritafoto'); ?>
<?php $this->renderPartial('widget-polling'); ?>
<?php //$this->renderPartial('widget-epaper'); ?>
<?php //if(Yii::app()->user->id == 1 || Yii::app()->user->id == 3)$this->renderPartial('widget-histats'); ?>
<?php //$this->renderPartial('widget-histats'); ?>

<!-- End Dynamic Sidebar -->