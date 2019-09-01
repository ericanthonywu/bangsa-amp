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
	$sqlimage 		= "SELECT object_id,module_id,filename,caption_title,caption_desc FROM files WHERE object_id='$idnews' AND module_id='1' ";
	$datathumb		= Yii::app()->db->createCommand($sqlimage)->queryRow();
	if(!empty($datathumb['filename'])){
		$image 			= get_image_thumb($datathumb['filename'],"beritafoto");
	}else{
		$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
	}

	$sitename 		= "Harian Bangsa Online";
	
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

	$url 	= Yii::app()->getBaseUrl(true)."/beritafoto/".$slugid;

	$this->pageTitle=Yii::app()->name . ' - '.$title;
	$this->breadcrumbs=array(
		$title
	);

	// Facebook OG
	Yii::app()->facebook->ogTags['og:title'] 		= $title; 
	Yii::app()->facebook->ogTags['og:image'] 		= $image; 
	Yii::app()->facebook->ogTags['og:site_name'] 	= $sitename; 
	Yii::app()->facebook->ogTags['og:description'] 	= strip_tags($description); 
	Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
	Yii::app()->facebook->ogTags['og:url'] 			= $url;
	Yii::app()->facebook->ogTags['fb:app_id'] 		= "362682617206965";

	// Meta Tag
	Yii::app()->clientScript->registerMetaTag(html_entity_decode(strip_tags($description)), 'description');
	Yii::app()->clientScript->registerMetaTag($keyword, 'keywords');

	// Berita Foto
	$baseUrl 	= Yii::app()->baseUrl; 
	$cs 		= Yii::app()->getClientScript();

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
			<?php 
				$idberita 		= $data['news_id'];
				$sqlgetimage 	= "SELECT object_id,module_id,filename,caption_title,caption_desc FROM files WHERE object_id='$idberita' AND module_id='1' ";
				$dataimage		= Yii::app()->db->createCommand($sqlgetimage)->queryAll();
			?>
			<?php if(!empty($dataimage)){ ?>
				<script>
					$(function() {
						$(".rslides").responsiveSlides();
					});
				</script>
				<div class="image-detail-berita-slider rslides">
					<ul class="rslides">
						<?php foreach($dataimage as $dimage){ ?>		
							<li><?php echo get_image($dimage['filename'],"berita",'700',$dimage['caption_title']); ?></li>											
						<?php } ?>	
					</ul>
				</div>
			<?php } ?>
			
			<div class="content-detail-berita">
				<?php echo $data['news_content']; ?>
			</div>
			<div class="att-detail-berita">
				<?php if(!empty($data['news_penulis'])){ ?><div class="editor-berita"><span>editor :</span> <?php echo $data['news_penulis']; ?></div><?php } ?>
				<?php if(!empty($data['news_wartawan'])){ ?><div class="wartawan-berita"><span>wartawan :</span> <?php echo $data['news_wartawan']; ?></div><?php } ?>
				<?php if(!empty($data['news_source'])){ ?><div class="sumber-berita"><span>sumber :</span> <?php echo $data['news_source']; ?></div><?php } ?>
				<?php 
					// get tag from this news
					$idnews 	= $data['news_id'];
					$sqltag 	= "SELECT t.*,tr.* FROM tag t INNER JOIN tag_relationship tr ON(tr.tagId=t.id) WHERE tr.post_id = '$idnews' ";
					$datatag	= Yii::app()->db->createCommand($sqltag)->queryAll();
				?>
				<?php if(!empty($datatag)){ ?>
				<div class="tag-berita">
					<span>tag : </span>
					<ul>
						<?php foreach($datatag as $dtag){ ?>
							<li><?php echo $dtag['tag_name']; ?></li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
			<div class="like-fb" style="float:left;">
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
				<?php 
				
					$titlef = strip_tags(str_replace(array("\r", "\n", "\xE2\x80\x8B"), '', $title));
					$titlef = str_replace("'", '&#039;', $titlef);
					$descriptionf = addslashes(strip_tags(str_replace(array("\r", "\n", "\xE2\x80\x8B"), '', get_excerpt($description, 150))));
					$descriptionf = str_replace("'", '&#039;', $descriptionf);
					Yii::app()->clientScript->registerScript('script', <<<JS
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
				
				<div class="fbpostbutton" onClick="postToFeed()">
					<img src="<?php echo Yii::app()->getBaseUrl(true) ."/img/share.png"; ?>" />
					<!--
					<span class="facebook-logo"></span>
					<span>Share</span>
					-->
				</div>
			</div>
			<div class="att-sharing-berita">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_tweet"></a>
				</div>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515a98304fda50f6"></script>
				<!-- AddThis Button END -->
			</div>
		</div>
		<?php if(!empty($datatag)){ ?>
		<div class="block-other-berita mt1 mb1">
			<div class="berita-terkait">
				<div class="title-berita-terkait">Berita Terkait</div>
				<div class="list-berita-terkait">
					<?php 
						$this_id = $data['news_id'];
						
						// cache
						$ids_r = abs( (int) $this_id);
						$related_news_d_cache =Yii::app()->cache->get('related_news_d_'.$ids_r);
						if($related_news_d_cache===false)
						{
							if(!empty($datatag)){
								$sqlrelatednews = "SELECT b.news_title, b.news_id, b.news_slug, b.news_type FROM module_news b INNER JOIN tag_relationship tr ON(tr.post_id=b.news_id) WHERE tr.tagId IN(SELECT tagId FROM tag_relationship WHERE post_id ='$this_id') AND b.news_id !='$this_id' GROUP BY news_id ORDER BY news_id DESC LIMIT 10";
								$datarelated	= Yii::app()->db->createCommand($sqlrelatednews)->queryAll();
							}
							Yii::app()->cache->set('related_news_d_'.$ids_r, $datarelated, 300);
						}else{
							$datarelated = $related_news_d_cache;
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
		</div>
		<?php } ?>
		<div class="fb-comments" data-href="<?php echo $url; ?>" data-numposts="5" data-width="100%"></div>
	</div>
	<div class="decoration"></div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
