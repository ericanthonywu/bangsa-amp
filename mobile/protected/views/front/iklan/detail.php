<?php
$title 	= $data['judul_iklan'];
$url 	= Yii::app()->createAbsoluteUrl(Yii::app()->request->url);

$this->pageTitle=Yii::app()->name . ' - '.$title;
$this->breadcrumbs=array(
	$title
);

// Facebook OG
Yii::app()->facebook->ogTags['og:title'] 		= ''; 
Yii::app()->facebook->ogTags['og:image'] 		= ""; 
Yii::app()->facebook->ogTags['og:site_name'] 	= "Harian Bangsa Online"; 
Yii::app()->facebook->ogTags['og:description'] 	= ""; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url; 

// Meta Tag

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
					$sqlimageiklan_detail	= "SELECT * FROM files WHERE object_id='$idiklan' ORDER BY id ASC ";
					$dataiklan				= Yii::app()->db->createCommand($sqlimageiklan_detail)->queryAll(); 	
							
				?>
				<?php if(!empty($dataiklan[1])){ echo get_image($dataiklan[1]['filename'],'iklan'); } ?>
				<?php echo $data['keterangan_iklan']; ?>
			</div>		
		</div>
	</div>
</div>
