<?php
$title 			= "E-Paper | Bangsa Online - Cepat, Lugas dan Akurat";
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

// Link Alternate
$mobileurl = 'http://m.bangsaonline.com/';
$mobileurl2 		= "epaper/";
Yii::app()->clientScript->registerLinkTag('alternate',null,$mobileurl.$mobileurl2,'only screen and (max-width: 640px)');

$this->breadcrumbs=array(
	'E-Paper'
);
?>

<div class="row bo-main content-epaper">
	<span class="breadcrumb" style="margin:10px 0px;display:block;">
	<?php 
		$this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));
	?>
	</span>
	<?php 
		$page 	= (isset($_GET['page']) ? $_GET['page'] : 1);
		$limit 	= 4;
		if($page !='0'){ $start = ($page - 1) * $limit; }else{ $start = 0; }		
		
		$sqlepaper ="SELECT title,content FROM module_epaper ORDER BY id DESC LIMIT $start,$limit";
		$dataepaper = Yii::app()->db->createCommand($sqlepaper)->queryAll();
		
		// count 
		$count ="SELECT COUNT(id) AS enum FROM module_epaper";
		$datacount	= Yii::app()->db->createCommand($count)->queryRow();   
		
		// Pagination  
		$pages = new CPagination($datacount);
		$pages->setPageSize($limit);		
	?>
	<?php foreach($dataepaper as $depaper){ ?>
	<div class="span4 mt1 mb1">
		<div class="title-epaper-detail"><h3><?php echo $depaper['title']; ?></h3></div>
		<div class="content-epaper-detail"><?php echo $depaper['content']; ?></div>
	</div>
	<?php } ?>
	<div class="clear"></div>
	<div class="pagination" style="margin:0 0 15px 0;">
		<?php 
			$this->widget('CLinkPager', array(
				//'currentPage'	=> $pages->getCurrentPage(),
				'itemCount'		=> $datacount['enum'],
				'pageSize'		=> $limit,
				'header'=>'',
				'htmlOptions'=>array('class'=>''),
			));
		?>
	</div>
	<div class="clear"></div>
</div>