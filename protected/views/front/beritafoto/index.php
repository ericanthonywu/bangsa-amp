<?php
$title 			= "Berita Foto | Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat";
$keyword 		= "jatim,jatim timur";
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

$this->breadcrumbs=array(
	'Berita Foto',
);

?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="block-foto-top mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="block-full-berita-foto mt1 mb1">
			<div id="featured" >
				<ul class="ui-tabs-nav">
					<?php 
						// get latest 4 photos from beritafoto
						$sqlgetbfoto = "SELECT * FROM module_news WHERE news_status='1' AND news_type='2' ORDER BY news_id DESC LIMIT 4";
						$databfoto	= Yii::app()->db->createCommand($sqlgetbfoto)->queryAll(); 
					?>
					<?php $i =1; ?>
					<?php foreach($databfoto as $dbfoto){ ?>
					<?php 
						// sql get latest photo 
						$idnews = $dbfoto['news_id'];
						$sqlphoto = "SELECT * FROM files WHERE object_id='$idnews' AND module_id='1' ";
						$datafirstfoto	= Yii::app()->db->createCommand($sqlphoto)->queryRow(); 
					?>
					<li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $i; ?>">
						<a href="#fragment-<?php echo $i; ?>">
							<?php echo get_image($datafirstfoto['filename'],'berita','135x75',$dbfoto['news_slug']); ?>
							<span><?php echo $dbfoto['news_title']; ?></span>
							<div class="clearfix"></div>
						</a>
					</li>	
					<?php $i++; ?>
					<?php } ?>
				</ul>
				<?php $ii =1; ?>
				<?php foreach($databfoto as $dbfoto){ ?>
				<?php 
					// sql get latest photo 
					$idnews = $dbfoto['news_id'];
					$sqlphoto = "SELECT * FROM files WHERE object_id='$idnews' AND module_id='1' ";
					$datafirstfoto	= Yii::app()->db->createCommand($sqlphoto)->queryRow(); 
				?>
				<div id="fragment-<?php echo $ii; ?>" class="ui-tabs-panel" style="">
						<?php echo get_image($datafirstfoto['filename'],'berita','700x350',$dbfoto['news_slug']); ?>
					 <div class="info" >
						<h2><a href="<?php echo get_link_berita("beritafoto",$dbfoto['news_id'],$dbfoto['news_slug']); ?>" ><?php echo $dbfoto['news_title']; ?></a></h2>
						<p><?php if(!empty($dbfoto['news_excerpt'])){ echo $dbfoto['news_excerpt']; }else{  echo get_excerpt($dbfoto['news_content'],'100'); } ?></p>
					 </div>
				</div>
				<?php $ii++; ?>
				<?php } ?>

			</div>
			<div class="clearfix"></div>
		</div>
		<div class="separator-block mt2 mb2"></div> <!-- Spearator -->
	</div>	
	<div class="clearfix"></div>
</div>