<?php
$title 	= 'E-paper';
$url 	= Yii::app()->createAbsoluteUrl(Yii::app()->request->url);

$this->pageTitle=Yii::app()->name . ' - '.$title;
$this->breadcrumbs=array(
	$title
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