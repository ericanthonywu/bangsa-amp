<?php
$title 			= "Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->getBaseUrl(true) ."/img/logo.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Portal Berita Harian Bangsa Online - Cepat, Lugas dan Akurat, Portal Berita Harian Jawa Timur";
$keyword 		= "berita jatim,jatim timur,jatim barat,jatim utara,jatim tengah,jatim selatan,jatim metro,jatim madura,portal berita surabaya, protal berita jatim, koran surabaya, korang online, harian bangsa, website koran";
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

// Link Canonical
Yii::app()->clientScript->registerLinkTag('canonical',null,'http://www.bangsaonline.com/');

?>
<!-- <div class="container"> -->
	<?php $this->renderPartial('block-berita-utama'); ?>	
<!-- </div> -->
<div class="decoration"></div>
<div class=" no-bottom">
	<?php $this->renderPartial('block-hot-news'); ?>
	<?php // This is Desktop Advertise $this->renderPartial('iklan-samping-topik'); ?>
	<?php $this->renderPartial('block-home-catnews'); ?>
</div>
<div class="">
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('sidebar-home'); ?>
	</div>
</div>