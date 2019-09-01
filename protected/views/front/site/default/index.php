<?php
$title 			= "Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat, Portal Berita Harian Jawa Timur";
$keyword 		= "berita jatim,jatim timur,jatim barat,jatim utara,jatim tengah,jatim selatan,jatim metro,jatim madura,portal berita surabaya, protal berita jatim, koran surabaya, korang online, harian bangsa, website koran ";
$url			= Yii::app()->getBaseUrl(true);

$this->pageTitle = $title;

// Facebook OG
Yii::app()->facebook->ogTags['og:title'] 		= $title; 
Yii::app()->facebook->ogTags['og:image'] 		= $image; 
Yii::app()->facebook->ogTags['og:site_name'] 	= $sitename;
Yii::app()->facebook->ogTags['og:description'] 	= $description; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

// Meta tag
Yii::app()->clientScript->registerMetaTag($description, 'description');
Yii::app()->clientScript->registerMetaTag($keyword, 'keywords');

// Link Alternate
$mobileurl = 'http://m.bangsaonline.com/';
Yii::app()->clientScript->registerLinkTag('alternate',null,$mobileurl,'only screen and (max-width: 640px)');

?>
<div class="row bo-main">
<div class="span8 mb1"> 
	<?php $this->renderPartial('block-breaking-news'); ?>
	<?php $this->renderPartial('block-topik-khas'); ?>	
	<div class="clear"></div>
	<?php $this->renderPartial('block-berita-utama'); ?>	
	<div class="clearfix"></div>
	<div class="separator-block mt1 mb2"></div>
	<!-- Start Dynamic Content -->
	<div class="sub-row">
		<?php 
			$dynamicblock 		= "SELECT block_title,block_type, block_style, block_object_id FROM block WHERE block_type != 'root' ORDER BY lft ASC  ";
			$datablock			= Yii::app()->db->createCommand($dynamicblock)->queryAll(); 
			foreach($datablock as $datab){
		?>
		<?php if($datab['block_type'] == "category"){ ?>
			<?php 
				// select this category 
				$thiscat 		= $datab['block_object_id'];
				$sqlselectcat 	= "SELECT category_id,category_slug FROM category WHERE category_id ='$thiscat' ";
				$datacat		= Yii::app()->db->createCommand($sqlselectcat)->queryRow();
				//echo $thiscat;
				
				// select latest news has image
				$sqlnewshimage = "SELECT b.news_id,b.news_slug,b.news_title,b.news_date,cr.*,f.filename FROM category_relationship cr INNER JOIN module_news b ON(cr.post_id = b.news_id) INNER JOIN files f ON(cr.post_id = f.object_id) WHERE cr.category_id = '$thiscat' AND f.module_id =1 AND b.news_type=1 AND b.news_status =1 ORDER BY b.news_id DESC LIMIT 1";
				$lastnewshimage	= Yii::app()->db->createCommand($sqlnewshimage)->queryRow();
				$idtop = $lastnewshimage['news_id'];
				
				//get latest news running berita 
				$sqlrun 	= "SELECT r.*,rl.* FROM running_news_relationship rl INNER JOIN running_news r ON(rl.running_id = r.id) WHERE rl.post_id ='$idtop' ";
				$datarun	= Yii::app()->db->createCommand($sqlrun)->queryRow();
				
				// select 5 latest news, except first image 
				if(!empty($idtop)){
					$sqllatestnews = "SELECT b.news_id,b.news_slug,b.news_title,b.news_date,cr.* FROM category_relationship cr INNER JOIN module_news b ON(cr.post_id = b.news_id)  WHERE cr.category_id = '$thiscat' AND b.news_id NOT IN($idtop) AND b.news_type=1 AND b.news_status =1 ORDER BY b.news_id DESC LIMIT 3 ";
				}else{
					$sqllatestnews = "SELECT b.news_id,b.news_slug,b.news_title,b.news_date,cr.* FROM category_relationship cr INNER JOIN module_news b ON(cr.post_id = b.news_id)  WHERE cr.category_id = '$thiscat' AND b.news_type=1 AND b.news_status =1 ORDER BY b.news_id DESC LIMIT 3 ";
				}
				$lastestnews	= Yii::app()->db->createCommand($sqllatestnews)->queryAll();
			?>
			
			<?php if($datab['block_style'] =='1' || $datab['block_style'] =='0' ){ ?>
				<!-- Start Block Style 1 -->
				<div class="subs4 block-berita-1 mt1" id="<?php echo $datacat['category_slug'].'-'.$thiscat; ?>">
					<div class="title-cat-berita">
						<h3><a href="<?php echo get_link($datacat['category_slug'],"kanal"); ?>"><?php echo $datab['block_title']; ?></a></h3>
						<span><a href="<?php echo get_link($datacat['category_slug'],"kanal"); ?>">Indeks</a></span>
						<div class="clearfix"></div>
					</div>
					<div class="top-block-berita-1">			
						<div class="image-berita">
							<a href="<?php echo get_link_berita("berita",$lastnewshimage['news_id'],$lastnewshimage['news_slug']); ?>">
								<?php echo get_image($lastnewshimage['filename'],'berita','340x170',$lastnewshimage['news_slug'],'100','100'); ?>
							</a>
						</div>						
						<div class="title-berita">
							<div class="date-berita"><?php echo get_time($lastnewshimage['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
							<div class="sub-judul"><?php echo $datarun['running_title']; ?></div>
							<a href="<?php echo get_link_berita("berita",$lastnewshimage['news_id'],$lastnewshimage['news_slug']); ?>">
								<?php echo $lastnewshimage['news_title']; ?>
							</a>
						</div>
					</div>
					<div class="list-block-berita-1">
						<ul>
						<?php foreach($lastestnews as $lnews){ ?>
						<?php	
							//get latest news running berita 
							$idnewslist = $lnews['news_id'];
							$sqlrun2 	= "SELECT r.*,rl.* FROM running_news_relationship rl INNER JOIN running_news r ON(rl.running_id = r.id) WHERE rl.post_id ='$idnewslist' ";
							$datarun2	= Yii::app()->db->createCommand($sqlrun2)->queryRow();
						?>
							<li>
								<div class="date-berita"><?php echo get_time($lnews['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
								<div class="running-berita"><?php echo $datarun2['running_title']; ?></div>
								<div class="link-berita">
									<a href="<?php echo get_link_berita("berita",$lnews['news_id'],$lnews['news_slug']); ?>"><?php echo $lnews['news_title']; ?></a>
								</div>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
				<!-- End Block Type 1 -->
				
			<?php }else{ ?>
				<!-- Start Block Style 2 -->
				<div class="subs4 block-berita-2 mt1" id="<?php echo $datacat['category_slug'].$thiscat; ?>">
					<div class="top-block-berita-2">
						<div class="title-cat-berita">
							<h3><a href="<?php echo get_link($datacat['category_slug'],"kanal"); ?>"><?php echo $datab['block_title']; ?></a></h3>
							<span><a href="<?php echo get_link($datacat['category_slug'],"kanal"); ?>">Indeks </a></span>
						</div>
						<div class="clearfix"></div>
						
						<div class="first-news-block">
							<div class="image-berita">
								<a href="<?php echo get_link_berita("berita",$lastnewshimage['news_id'],$lastnewshimage['news_slug']); ?>">
									<?php echo get_image($lastnewshimage['filename'],'berita','100x100',$lastnewshimage['news_slug'],'100','100'); ?>
								</a>
							</div>
							<div class="sub-judul"><?php echo $datarun['running_title']; ?></div>
							<div class="date-berita"><?php echo get_time($lastnewshimage['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
							<div class="title-berita">
								<a href="<?php echo get_link_berita("berita",$lastnewshimage['news_id'],$lastnewshimage['news_slug']); ?>">
									<?php echo $lastnewshimage['news_title']; ?>
								</a>
							</div>
						
							<div class="clearfix"></div>
						</div>				
					</div>
					
					<div class="list-block-berita-2">
						<ul>
							<?php foreach($lastestnews as $lnews){ ?>
							<?php	
								//get latest news running berita 
								$idnewslist = $lnews['news_id'];
								$sqlrun2 	= "SELECT r.*,rl.* FROM running_news_relationship rl INNER JOIN running_news r ON(rl.running_id = r.id) WHERE rl.post_id ='$idnewslist' ";
								$datarun2	= Yii::app()->db->createCommand($sqlrun2)->queryRow();
							?>
							<li>
								<div class="date-berita"><?php echo get_time($lnews['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
								<div class="running-berita"><?php echo $datarun2['running_title']; ?></div>
								<div class="link-berita">
									<a href="<?php echo get_link_berita("berita",$lnews['news_id'],$lnews['news_slug']); ?>"><?php echo $lnews['news_title']; ?></a>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div> 
	
			<?php }?>
		<?php }elseif($datab['block_type'] == "iklan"){ ?>
			<?php 
				$iklanid = $datab['block_object_id'];	
			?>
			<div class="block-iklan-2 mt1 mb1" style="padding-top:10px;text-align:center;">
				<div class="clearfix"></div>
			<?php 	if($datab['block_style'] == 1):
						$sqliklankontent = "SELECT f.filename,mi.* FROM module_iklan mi INNER JOIN files f ON(mi.id=f.object_id) WHERE f.module_id='2' AND mi.id='$iklanid' ";
						$dataiklan = Yii::app()->db->createCommand($sqliklankontent)->queryRow(); 
						if($dataiklan['is_external'] =='1'){ $link = $dataiklan['link_iklan']; }else{ $link = get_link($dataiklan['id'],"iklan"); }  ?>
						<a href="<?php echo $link; ?>" target="_blank">
							<?php echo get_image($dataiklan['filename'],'iklan',null); ?>
						</a>
			<?php 	else:
						$sqliklankontent = "SELECT mi.* FROM module_iklan mi WHERE mi.id='$iklanid' ";
						$dataiklan = Yii::app()->db->createCommand($sqliklankontent)->queryRow(); 
						echo $dataiklan['keterangan_iklan'];
					endif;?>
			</div>
			<div class="clearfix"></div>
		<?php }elseif($datab['block_type'] == "separator"){ ?>
			<div class="separator-block mt1 mb1"></div> 
			<div class="clear"></div>
		<?php }else{ ?>
		
		<?php } ?>
		
		
		<?php } ?>	
	</div>
	<div class="clear"></div>
	<!-- End Dynamic Content -->
</div>

<!-- SIDEBAR -->
<div class="span4 mb1 mt1">
	<?php $this->renderPartial('sidebar-home'); ?>
</div>
<!-- End SIDEBAR -->
</div>
<!-- Start Block Iklan Bottom -->
<div class="row bo-bottom-ads">
	<?php $this->renderPartial('iklan-bawah'); ?>
</div>
<!-- End Block Iklan Bottom -->