<?php
$d_banner_polling = SettingPolling::model()->find('nama = :name', array(':name'=>'polling'));

$title 			= $d_banner_polling->subtitle ." | Bangsa Online - Cepat, Lugas dan Akurat";
$image 			= Yii::app()->getBaseUrl(true) ."/img/logo-g2.png";
$sitename 		= "Harian Bangsa Online";
$description 	= "Vote kandidat pilihan anda, dan forward polling ini ke teman-teman";
$keyword 		= "jatim,jatim timur";
$url			= Yii::app()->getBaseUrl(true).'/polling/index';

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

$this->breadcrumbs=array( 'Polling Pilihan' );
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="title-category"><h1><?php echo 'Polling Pilihan'; ?></h1></div>

		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<?php if ($jum_data > 0): ?>
		<div class="list_polling_data_n">
			<div class="row custom">
					<?php foreach ($data->getData() as $key => $value){ ?>
					<div class="col-md-6 col-sm-6">
						<div class="items">
							<div class="tx"><a href="<?php echo CHtml::normalizeUrl(array('/polling/detail', 'id'=> $value->id, 'slug'=>Slug::Create($value->title) )); ?>"><span><?php echo $value->title; ?></span></a></div>
							<div class="clear"></div>
							<div class="btms">
								<a href="<?php echo CHtml::normalizeUrl(array('/polling/detail', 'id'=> $value->id, 'slug'=>Slug::Create($value->title) )); ?>" class="btn btn_vote"><i class="fa fa-edit"></i> &nbsp;Vote</a>
								&nbsp;&nbsp;&nbsp;
								<a href="<?php echo CHtml::normalizeUrl(array('/polling/detail', 'id'=> $value->id, 'slug'=>Slug::Create($value->title) )); ?>" class="btn btn_result"><i class="fa fa-eye"></i> &nbsp;View Results</a>
							</div>
						</div>
					</div>
					<?php } ?>
				<div class="clear clearfix"></div>
			</div>
			<div class="clear clearfix"></div>
		</div>
		<?php endif ?>

		<div class="clear height-20"></div>
		
		<div class="pagination customs_pagin">
			<?php 
			$this->widget('CLinkPager', array(
		        'pages' => $data->getPagination(),
		        'header' => '',
		        'nextPageLabel' => 'Next',
		        'prevPageLabel' => 'Prev',
		        'selectedPageCssClass' => 'active',
		        'hiddenPageCssClass' => 'disabled',
		        'htmlOptions' => array(
		            'class' => 'paginaton',
		        )
		    ));
           ?>
		</div>	

		<div class="clear"></div>
	</div>

	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>

</div>