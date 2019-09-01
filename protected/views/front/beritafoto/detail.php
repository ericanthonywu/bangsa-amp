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
	$url			= Yii::app()->getBaseUrl(true)."/beritafoto/".$slugid;

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

	// Link Alternate
	$mobileurl = 'http://m.bangsaonline.com/';
	$mobileurl2 		= "beritafoto/".$slugid;
	Yii::app()->clientScript->registerLinkTag('alternate',null,$mobileurl.$mobileurl2,'only screen and (max-width: 640px)');


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
			<?php 
				$idberita 		= $data['news_id'];
				$sqlgetimage 	= "SELECT object_id,module_id,filename,caption_title,caption_desc FROM view_files WHERE object_id='$idberita' AND module_id='1' ";
				$dataimage		= Yii::app()->db->createCommand($sqlgetimage)->queryAll();
			?>
			<?php if(!empty($dataimage)){ ?>
				 <script type="text/javascript">
					$(window).load(function() {
						$('#slider').nivoSlider({
							effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown'
							slices: 15,                     // For slice animations
							boxCols: 8,                     // For box animations
							boxRows: 4,                     // For box animations
							animSpeed: 600,                 // Slide transition speed
							pauseTime: 3000,                // How long each slide will show
							startSlide: 0,                  // Set starting Slide (0 index)
							directionNav: true,             // Next & Prev navigation
							controlNav: false,               // 1,2,3... navigation
							controlNavThumbs: false,        // Use thumbnails for Control Nav
							pauseOnHover: true,             // Stop animation while hovering
							manualAdvance: false,           // Force manual transitions
							prevText: 'Prev',               // Prev directionNav text
							nextText: 'Next',               // Next directionNav text
							randomStart: false,             // Start on a random slide
							beforeChange: function(){},     // Triggers before a slide transition
							afterChange: function(){},      // Triggers after a slide transition
							slideshowEnd: function(){},     // Triggers after all slides have been shown
							lastSlide: function(){},        // Triggers when last slide is shown
							afterLoad: function(){}         // Triggers when slider has loaded
						});
					});
				</script>
				<div id="wrapper">
					<div class="slider-wrapper theme-default">
						<div id="slider" class="nivoSlider">
							<?php foreach($dataimage as $dimage){ 
								if($dimage['caption_title']){
									$caption = $dimage['caption_title'];
								}elseif($dimage['caption_desc']){
									$caption = $dimage['caption_desc'];
								}
								else{
									$caption = "";
								}
							?>
								<?php echo get_image($dimage['filename'],"berita",'700x350',$caption); ?>								
							<?php } ?>	
							
						</div>
					</div>
				</div>

			<?php } ?>
			
			<div class="content-detail-berita">
				<?php echo $data['news_content']; ?>
			</div>

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
			<div class="clearfix"></div>
		</div>
		<?php if(!empty($datatag)){ ?>
		<div class="block-other-berita mt1 mb1">
			<div class="berita-terkait">
				<div class="title-berita-terkait">Berita Terkait</div>
				<div class="list-berita-terkait related_news_edit">
					<?php 
						$this_id = $data['news_id'];
						$res_impTag = implode(',', $log_tag);
						if(!empty($datatag)){
							// cache
							$ids_r = abs( (int) $this_id);
							$related_news_d_cache =Yii::app()->cache->get('related_news_dfoto_'.$ids_r);
							if($related_news_d_cache===false)
							{
									// $sqlrelatednews = "SELECT b.news_title, b.news_id, b.news_slug, b.news_type,
									// 			fls.caption_title,fls.caption_desc,fls.filename
									// 			FROM module_news b 
									// 			INNER JOIN tag_relationship tr ON(tr.post_id=b.news_id) 
									// 			LEFT JOIN `files` fls ON(fls.object_id=b.news_id)
									// 			WHERE tr.tagId IN(SELECT tagId FROM tag_relationship WHERE post_id ='$this_id') 
									// 			AND b.news_id !='$this_id' AND fls.module_id = '1' GROUP BY b.news_id ORDER BY b.news_id DESC LIMIT 10";
									$sqlrelatednews = "SELECT b.news_title, b.news_id, b.news_slug, b.news_type, b.caption_title,b.caption_desc,b.filename 
									FROM `view_other_news` b WHERE `news_id` != '$this_id' AND `tagId` IN ($res_impTag) LIMIT 10";
							$datarelated	= Yii::app()->db->createCommand($sqlrelatednews)->queryAll();
								Yii::app()->cache->set('related_news_dfoto_'.$ids_r, $datarelated, 1800);
							}else{
								$datarelated = $related_news_d_cache;
							}
						}
			
					?>
					<ul>
						<?php 	foreach($datarelated as $drelated){
									$images_related = '';
									if(!empty($drelated['filename'])){
										$images_related =  get_image($drelated['filename'],"berita","100x100", $drelated['caption_title']);
									}
									if($drelated['news_type'] == 1):?>
										<li>
											<a href="<?php echo get_link_berita("berita",$drelated['news_id'],$drelated['news_slug']); ?>">
											<?php echo $images_related ?><?php echo $drelated['news_title']; ?></a>
										</li>
						<?php 		elseif($drelated['news_type'] == 2):?>
										<li>
											<a href="<?php echo get_link_berita("beritafoto",$drelated['news_id'],$drelated['news_slug']); ?>"><?php echo $images_related ?><?php echo $drelated['news_title']; ?></a>
										</li>
						<?php 		elseif($drelated['news_type'] == 3):?>
										<li>
											<a href="<?php echo get_link_berita("beritavideo",$drelated['news_id'],$drelated['news_slug']); ?>"><?php echo $images_related ?><?php echo $drelated['news_title']; ?></a>
										</li>
						<?php		endif;
								} ?>
					</ul>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="fb-comments" data-href="<?php echo $url; ?>" data-numposts="5" data-width="100%"></div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
