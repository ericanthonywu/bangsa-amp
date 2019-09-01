<?php
$title 			= $data['judul_iklan']." | Bangsa Online - Cepat, Lugas dan Akurat";
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
	$data['judul_iklan']
);
?>
<div class="row bo-main">
	<div class="span12 mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="block-iklan">
			<div class="title-block-iklan">
				<h1><?php echo $data['judul_iklan']; ?></h1>
			</div>		
			<div class="content-block-fullwdith">
				<?php 
					// get second or latest images
					$idiklan = $data['id'];
					$sqlimageiklan_detail	= "SELECT * FROM files WHERE object_id='$idiklan' ORDER BY id ASC";
					$dataiklan				= Yii::app()->db->createCommand($sqlimageiklan_detail)->queryAll(); 	
							
				?>
				<?php if(!empty($dataiklan[1])){ echo get_image($dataiklan[1]['filename'],'iklan'); } ?>
				<?php echo $data['keterangan_iklan']; ?>
			</div>		
		</div>
	</div>
</div>
