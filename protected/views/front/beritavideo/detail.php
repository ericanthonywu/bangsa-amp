<?php
	// Get ID News
	$idnews 		= $data['news_id'];
	
	// Get click count_news for SQL Popular News
	$dataRclick_c		= Yii::app()->db->createCommand("SELECT click_count FROM module_news WHERE news_id='$idnews'")->queryRow();
	// Update SQL ++ Popular News 
	$clicked_count = $dataRclick_c['click_count'] + 1;
	$updatePopular = Yii::app()->db->createCommand("UPDATE module_news SET click_count = '$clicked_count' WHERE news_id = '$idnews'")->query();
	
	// Set Title for Facebook & SEO
	if($data['news_meta_title'] != ""){
		$title = $data['news_meta_title']." | Bangsa Online - Cepat, Lugas dan Akurat";
	}else{
		$title = $data['news_title']." | Bangsa Online - Cepat, Lugas dan Akurat";
	}

	// Set Thumbnail for Facebook - Share
	$sqlimage 		= "SELECT object_id,module_id,filename,caption_title,caption_desc FROM view_files WHERE object_id='$idnews' AND module_id='1' ";
	$datathumb		= Yii::app()->db->createCommand($sqlimage)->queryRow();
	if(!empty($datathumb['filename'])){
		$image 			= get_image_thumb($datathumb['filename'],"berita");
	}else{
		$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
	}
	
	// Set Description
	if($data['news_meta_desc'] != ""){ $description = $data['news_meta_desc']; }
	elseif($data['news_excerpt'] != ""){ $description = $data['news_excerpt']; }
	else{ $description = $data['news_content']; }
	
	/*Keyword*/
	if($data['news_meta_keyword'] != ""){
		$keyword = $data['news_meta_keyword'];
	}else{
		$keyword = "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat";
	}

	$sitename 		= "Harian Bangsa Online";
	$url			= Yii::app()->getBaseUrl(true);

	$this->pageTitle = $title;
	// Facebook OG
	Yii::app()->facebook->ogTags['og:title'] 		= $title; 
	Yii::app()->facebook->ogTags['og:image'] 		= $image; 
	Yii::app()->facebook->ogTags['og:site_name'] 	= $sitename;
	Yii::app()->facebook->ogTags['og:description'] 	= strip_tags($description); 
	Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
	Yii::app()->facebook->ogTags['og:url'] 			= $url; 
	Yii::app()->facebook->ogTags['fb:app_id'] 		= "362682617206965";

	// Meta tag
	Yii::app()->clientScript->registerMetaTag($description, 'description');
	Yii::app()->clientScript->registerMetaTag($keyword, 'keywords');
	
	$this->breadcrumbs=array(
		$data['news_title']
	);
?>
<div class="row bo-main">
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="block-detail-berita">
			<div class="title-detail-berita">
				<h1><?php echo $data['news_title']; ?></h1>
			</div>
			<div class="date-detail-berita"><?php echo get_time($data['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
			<div class="att-detail-berita custom">
				<div class="row custom">
					<div class="col-md-6 col-sm-6">
						<?php if(!empty($data['news_penulis'])){ ?><div class="editor-berita"><span>Editor:</span> <?php echo $data['news_penulis']; ?></div><?php } ?>
						<?php if(!empty($data['news_wartawan'])){ ?><div class="wartawan-berita"><span>Wartawan:</span> <?php echo $data['news_wartawan']; ?></div><?php } ?>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="att-sharing-berita" style="float:right;">	
						<?php /*<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">	
							<a class="addthis_button_tweet"></a>
						</div> 
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515a98304fda50f6"></script> 
						<!-- AddThis Button END -->*/ ?>
						<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58cbae43a2e32e2b"></script>
						<div class="addthis_inline_share_toolbox"></div>
					</div>
					</div>
				</div>
			</div>

			<div class="video-detail-berita">
				<iframe width="700" height="394" src="https://www.youtube.com/embed/<?php echo $data['embed']; ?>" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<div class="content-detail-berita">
				<?php // echo $data['news_content']; ?>
				<?php 
				$text = $data['news_content'];
				$text = str_replace('</p>', '', $text);
				$array = explode('<p>', $text);
				$p_arr_1 = array_filter($array);
				echo '<p>'.$p_arr_1[1].'</p>'; 

				echo '<p>'.$p_arr_1[2].'</p>';
				echo '<p>'.$p_arr_1[3].'</p>';
				?>
				<?php 
				// iklan tengah bawah berita
				$mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'tengah-detail-berita'")->queryRow();?>
				<?php if($mio['object_id'] != 0):?>
				<div class="mt1 custom">
				<?php 	if($mio['style'] == 0):
							$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'tengah-detail-berita' AND f.module_id ='2' ";
							$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
							if($dataiklant1['is_external'] =='1'){ $link = $dataiklant1['link_iklan']; }else{ $link = get_link($dataiklant1['id'],"iklan"); }  ?>
							<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant1['filename'],'iklan',null); ?></a>
				<?php 	else:
							$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'tengah-detail-berita'";
							$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
							echo $dataiklant1['keterangan_iklan'];
						endif;?>
				</div>
				<?php endif;?>
				<?php 
				foreach ( $p_arr_1 as $key => $item ) {
					if ($key != 1 AND $key != 2 AND $key != 3) {
				  		echo '<p>'.$item . '</p>';
					}
				}
				?>
			</div>

			<?php 
			// iklan detail bawah berita
			$mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'bawah-detail-berita'")->queryRow();?>
			<?php if($mio['object_id'] != 0):?>
			<div class="mt1">
			<?php 	if($mio['style'] == 0):
						$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'bawah-detail-berita' AND f.module_id ='2' ";
						$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
						if($dataiklant1['is_external'] =='1'){ $link = $dataiklant1['link_iklan']; }else{ $link = get_link($dataiklant1['id'],"iklan"); }  ?>
						<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant1['filename'],'iklan',null); ?></a>
			<?php 	else:
						$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'bawah-detail-berita'";
						$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
						echo $dataiklant1['keterangan_iklan'];
					endif;?>
			</div>
			<?php endif;?>

			<div class="att-detail-berita">

				<?php if(!empty($data['news_source'])){ ?><div class="sumber-berita padding-bottom-10"><span>Sumber:</span> <?php echo $data['news_source']; ?></div><?php } ?>

				<?php 
					$log_tag = array();
					// get tag from this news
					$sqltag 	= "SELECT * FROM view_tag_news WHERE post_id = '$idnews' ";
					$datatag	= Yii::app()->db->createCommand($sqltag)->queryAll();
				?>
				<?php if(!empty($datatag)){ ?>
				<div class="tag-berita">
					<ul>
						<li class="first"><span><i class="fa fa-tags"></i> &nbsp;Tag: </span></li>
						<?php foreach($datatag as $dtag){ ?>
							<?php 
							$log_tag[] = $dtag['id'];
							?>
							<li><a href="<?php echo Yii::app()->baseUrl; ?>/tag/<?php echo $dtag['tag_title']; ?>"><?php echo $dtag['tag_title']; ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>

				<div class="clearfix"></div>
			</div>
			<div class="like-fb" style="float:left;margin-top:10px;">
				<?php 
					/*$this->widget('ext.yii-facebook-opengraph.plugins.LikeButton', array(
					   //'href' => 'YOUR_URL', // if omitted Facebook will use the OG meta tag
					   'show_faces'=>true,
					   'send' => true
					)); */ ?>
				<!--<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=362682617206965&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script> -->
				
				<?php /*<div class="fbpostbutton" onclick="postToFeed();">
					<img src="<?php echo Yii::app()->getBaseUrl(true) ."/img/share.png"; ?>" />
					<!--
					<span class="facebook-logo"></span>
					<span>Share</span>
					-->
				</div>*/ ?>
				<?php 
					$titlef = strip_tags(str_replace(array("\r", "\n", "\xE2\x80\x8B"), '', $title));
					$titlef = str_replace("'", '&#039;', $titlef);
					$descriptionf = addslashes(strip_tags(str_replace(array("\r", "\n", "\xE2\x80\x8B"), '', get_excerpt($description, 150))));
					$descriptionf = str_replace("'", '&#039;', $descriptionf);
				?>
				<?php Yii::app()->clientScript->registerScript('script', <<<JS
						function postToFeed() {
							
							function callback(response) {
								document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
							}

							FB.ui({
								method: 'feed',
								link: '$url',
								picture: '$image',
								name: '$titlef',
								caption: '$titlef',
								description: '$descriptionf',
								display:'popup'
							}, function(response){});
							
							return true;
						}
JS
, CClientScript::POS_HEAD);?>
			</div>
			<?php /*<div class="att-sharing-berita">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_tweet"></a>
				</div>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515a98304fda50f6"></script>
				<!-- AddThis Button END -->
			</div>*/ ?>
			<div class="clearfix"></div>
		</div>

		<?php if(!empty($datatag)){ ?>
		<div class="block-other-berita mt1 mb1">
			<div class="berita-terkait">
				<div class="title-berita-terkait">Video Terkait</div>
				<div class="list-berita-terkait related_news_edit">
					<?php 
						$this_id = $data['news_id'];
						$res_impTag = implode(',', $log_tag);
						if(!empty($datatag)){
							// cache
							$ids_r = abs( (int) $this_id);
							$related_news_d_cache =Yii::app()->cache->get('videorelated_news_d_'. $ids_r);
							if($related_news_d_cache===false)
							{
									$sqlrelatednews = "SELECT b.news_title, b.news_id, b.news_image, b.news_slug, b.news_type, b.caption_title, b.caption_desc, b.news_embed, b.filename 
									FROM `view_other_news` b WHERE `news_id` != '$this_id' AND `tagId` IN ($res_impTag) LIMIT 12";
									$datarelated	= Yii::app()->db->createCommand($sqlrelatednews)->queryAll();
								Yii::app()->cache->set('videorelated_news_d_'.$ids_r, $datarelated, 1800);
							}else{
								$datarelated = $related_news_d_cache;
							}
						}
					?>
					<ul>
						<?php 	foreach($datarelated as $drelated){
									// get image for news related / berita terkait
									// $id_newsl = $drelated['news_id'];
									// $sqlgetimage2 	= "SELECT object_id,module_id,filename,caption_title,caption_desc FROM files WHERE object_id='$id_newsl' AND module_id='1' ";
									// $dataimage2		= Yii::app()->db->createCommand($sqlgetimage2)->queryRow();
									
									// $images_related = '';
									// if(!empty($drelated['filename'])){
									// 	$images_related =  get_image($drelated['filename'],"berita","340x170", $drelated['caption_title']);
									// }
									?>
										<li>
											<a href="<?php echo get_link_berita("berita-video",$drelated['news_id'],$drelated['news_slug']); ?>">
											<?php // echo $images_related ?>
											<img src="https://img.youtube.com/vi/<?php echo $drelated['news_embed']; ?>/0.jpg" />
											<?php echo $drelated['news_title']; ?></a>
										</li>
						<?php
								} ?>
					</ul>
				</div>
			</div>
		</div>
		<?php /*<div class="block-other-berita mt1 mb1">
			<div class="berita-terkait">
				<div class="title-berita-terkait">Berita Terkait</div>
				<div class="list-berita-terkait">
					<?php 
						$this_id = $data['news_id'];

						if(!empty($datatag)){
							// cache
							$ids_r = abs( (int) $this_id);
							$related_news_d_cache =Yii::app()->cache->get('related_news_dvid_'.$ids_r);
							if($related_news_d_cache===false)
							{
									$sqlrelatednews = "SELECT b.news_title, b.news_id, b.news_slug, b.news_type FROM module_news b INNER JOIN tag_relationship tr ON(tr.post_id=b.news_id) WHERE tr.tagId IN(SELECT tagId FROM tag_relationship WHERE post_id ='$this_id') AND b.news_id !='$this_id' GROUP BY news_id ORDER BY news_id DESC LIMIT 10";
									$datarelated	= Yii::app()->db->createCommand($sqlrelatednews)->queryAll();

								Yii::app()->cache->set('related_news_dvid_'.$ids_r, $datarelated, 300);
							}else{
								$datarelated = $related_news_d_cache;
							}
						}
			
					?>
					<ul>
						<?php 	foreach($datarelated as $drelated){
									if($drelated['news_type'] == 1):?>
										<li>
											<a href="<?php echo get_link_berita("berita",$drelated['news_id'],$drelated['news_slug']); ?>"><?php echo $drelated['news_title']; ?></a>
										</li>
						<?php 		elseif($drelated['news_type'] == 2):?>
										<li>
											<a href="<?php echo get_link_berita("beritafoto",$drelated['news_id'],$drelated['news_slug']); ?>"><?php echo $drelated['news_title']; ?></a>
										</li>
						<?php 		elseif($drelated['news_type'] == 3):?>
										<li>
											<a href="<?php echo get_link_berita("beritavideo",$drelated['news_id'],$drelated['news_slug']); ?>"><?php echo $drelated['news_title']; ?></a>
										</li>
						<?php		endif;
								} ?>
					</ul>
				</div>
			</div>
		</div>*/ ?>
		<?php } ?>
		<div class="mt2 mb1 block-iklan-2 tcenter">
			<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/iklan-konten.jpg" /></a>
		</div>
		<div class="fb-comments" data-href="<?php echo $url; ?>" data-numposts="5" data-width="100%"></div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
