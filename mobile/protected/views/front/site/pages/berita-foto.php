<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Berita Foto';
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
					<li class="ui-tabs-nav-item" id="nav-fragment-1">
						<a href="#fragment-1">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/small-slider1.jpg" alt="" />
							<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit aliquam semper </span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="ui-tabs-nav-item" id="nav-fragment-2">
						<a href="#fragment-2">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/small-slider2.jpg" alt="" />
							<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit aliquam semper </span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="ui-tabs-nav-item" id="nav-fragment-3">
						<a href="#fragment-3">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/small-slider3.jpg" alt="" />
							<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit aliquam semper</span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="ui-tabs-nav-item" id="nav-fragment-4">
						<a href="#fragment-4">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/small-slider4.jpg" alt="" />
							<span>Create a Vintage Photograph in Photoshop</span>
							<div class="clearfix"></div>
						</a>
					</li>	
				</ul>
				
				<!-- First Content -->
				<div id="fragment-1" class="ui-tabs-panel" style="">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/slider1.jpg" alt="" />
					 <div class="info" >
						<h2><a href="#" >15+ Excellent High Speed Photographs</a></h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
					 </div>
				</div>

				<!-- Second Content -->
				<div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/slider2.jpg" alt="" />
					 <div class="info" >
						<h2><a href="#" >20 Beautiful Long Exposure Photographs</a></h2>
						<p>Vestibulum leo quam, accumsan nec porttitor a, euismod ac tortor. Sed ipsum lorem, sagittis non egestas id, suscipit....<a href="#" >read more</a></p>
					 </div>
				</div>

				<!-- Third Content -->
				<div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/slider3.jpg" alt="" />
					 <div class="info" >
						<h2><a href="#" >35 Amazing Logo Designs</a></h2>
						<p>liquam erat volutpat. Proin id volutpat nisi. Nulla facilisi. Curabitur facilisis sollicitudin ornare....<a href="#" >read more</a></p>
					 </div>
				</div>

				<!-- Fourth Content -->
				<div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/slider4.jpg" alt="" />
					 <div class="info" >
						<h2><a href="#" >Create a Vintage Photograph in Photoshop</a></h2>
						<p>Quisque sed orci ut lacus viverra interdum ornare sed est. Donec porta, erat eu pretium luctus, leo augue sodales....<a href="#" >read more</a></p>
					 </div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="separator-block mt2 mb2"></div> <!-- Spearator -->
	</div>	
	<div class="clearfix"></div>
	<div class="mb1 mt1 block-full-photo-category">
		<?php 
			$cat1  		= array("RELIGIA","NASIONAL DAN PERISITIWA","OTOMOTIF","POLITIK & BIROKRASI");
			$arrlength 	= count($cat1);
			for($l=1;$l<$arrlength;$l++){ 
		?>
		<div class="mb1 mt1 item-list-photo" id="">
			<div class="title-full-photo-category"><?php echo $cat1[$l]; ?></div>
			<div class="content-full-photo-category">
				<ul>
					<?php for($i=1;$i<6;$i++){ ?>
					<li>
						<div class="image-photo-category"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-news.jpg" width="200" /></div>
						<div class="title-photo-category"><a href="#">Lorem Ipsum Dolor Sit amet</a></div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<?php } ?>
	</div>
</div>

