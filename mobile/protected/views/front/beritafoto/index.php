<?php
/* @var $this SiteController */
$title 	= $data['news_title'];
$url 	= Yii::app()->createAbsoluteUrl(Yii::app()->request->url);

$this->pageTitle=Yii::app()->name . ' - Berita Foto';
$this->breadcrumbs=array(
	'Berita Foto',
);


// Facebook OG
Yii::app()->facebook->ogTags['og:title'] 		= $data['news_title']; 
Yii::app()->facebook->ogTags['og:image'] 		= ""; 
Yii::app()->facebook->ogTags['og:site_name'] 	= "Harian Bangsa Online"; 
Yii::app()->facebook->ogTags['og:description'] 	= ""; 
Yii::app()->facebook->ogTags['og:type'] 		= "article"; 
Yii::app()->facebook->ogTags['og:url'] 			= $url;

// Meta Tag
Yii::app()->clientScript->registerMetaTag('', 'title');
Yii::app()->clientScript->registerMetaTag('', 'description');
Yii::app()->clientScript->registerMetaTag('', 'keyword');

?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="block-foto-top mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		<div class="block-full-berita-foto mt1 mb1">
			<div class="container">
				<div class="slider-controls" data-snap-ignore="true"> 
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
					<div>
						<?php echo get_image($datafirstfoto['filename'],'berita','700x350',$dbfoto['news_slug'],"","","responsive-image"); ?>
						<p class="title-slider-caption">
							<em><?php echo $dbfoto['news_date']; ?></em>
							<strong>
								<a style="color:#FFF !important;" href="<?php echo get_link_berita("beritafoto",$dbfoto['news_id'],$dbfoto['news_slug']); ?>">
									<?php echo $dbfoto['news_title']; ?>
								</a>
							</strong>
						</p>
					</div>
					<?php $i++; ?>
					<?php } ?>
				</div>
				<a href="#" class="next-slider"></a>
				<a href="#" class="prev-slider"></a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="block-full-berita-foto mt1 mb1">
				<div class="subs4 block-berita-1">
					<div class="list-block-berita-1">
						<?php 
							// get latest 4 photos from beritafoto
							$sqlgetbfoto = "SELECT * FROM module_news WHERE news_status='1' AND news_type='2' ORDER BY news_id DESC LIMIT 5,6";
							$databfoto	= Yii::app()->db->createCommand($sqlgetbfoto)->queryAll(); 
						?>
						<?php $i =1; ?>
						<ul>
						<?php foreach($databfoto as $dbfoto){ ?>
							<li>
								<div class="date-berita"><?php echo get_time($dbfoto['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
								<div class="link-berita">
									<a href="<?php echo get_link_berita("beritafoto",$dbfoto['news_id'],$dbfoto['news_slug']); ?>"><?php echo $dbfoto['news_title']; ?></a>
								</div>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

