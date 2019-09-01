<?php
$title 			= $data['page_title']." | Bangsa Online - Cepat, Lugas dan Akurat";
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
	$data['page_title']
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
		<div class="block-fullwidth">
			<div class="title-block-fullwidth">
				<h1><?php echo $data['page_title']; ?></h1>
			</div>		
			<!-- <div class="date-detail-fullwidth"><?php echo get_time($data['page_date'],"dd MMMM yyyy","yes"); ?></div> -->
			<?php
				$idhalaman 		= $data['page_id'];
				$sqlgetimage 	= "SELECT object_id,module_id,filename,caption_title,caption_desc FROM files WHERE object_id='$idhalaman' AND module_id='0' ";
				$dataimage		= Yii::app()->db->createCommand($sqlgetimage)->queryRow();
			?>
			<?php if(!empty($dataimage['filename'])){ ?>
				<div class="image-detail-fullwidth">
					<?php echo get_image($dataimage['filename'],"halaman","700",$dataimage['caption_title']); ?>
				</div>
				<div class="descimage-detail-fullwidth">
					<?php echo $dataimage['caption_desc']; ?>
				</div>
			<?php } ?>		

			<?php if ($data['page_title'] == 'Tentang Kami' OR $data['page_title'] == 'Kontak Kami'): ?>
				<div class="content-block-fullwdith customs_redaksi">
			<?php elseif ($data['page_title'] == 'Pedoman Media Siber'): ?>
				<div class="content-block-fullwdith customs_media_s">
			<?php else: ?>
				<div class="content-block-fullwdith">
			<?php endif ?>
				<?php echo $data['page_content']; ?>
			</div>		
		</div>
	</div>
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
