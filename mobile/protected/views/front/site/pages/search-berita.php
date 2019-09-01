<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Search Berita';
$this->breadcrumbs=array(
	'Search Berita',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="mt2 mb1 block-iklan-2 tcenter">
			<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-konten.jpg" /></a>
		</div>
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		
		<div class="title-search"><h1>Hasil Cari : Jokowi</h1></div>
		
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<!-- Start List Berita -->
		<div class="list-search-berita">
			<?php 
				for($i=1;$i<9;$i++){
			?>
			<div class="berita-row mb1">
				<div class="left-search-berita">
					<div class="image-search-berita"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/images-news-category.jpg" /></div>
				</div>
				<div class="right-search-berita">
					<div class="title-search-berita"><h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a></h3></div>
					<div class="date-search-berita">19 Januari 2014 | <span class="total_comment">19 Komentar</span> </div>
					<div class="excerpt-search-berita">
						<p>Ut ut risus id massa aliquet varius ac sit amet ante. Ut ultrices lacus vel fringilla feugiat. Vivamus quis velit non orci feugiat venenatis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec nec leo at arcu venenatis dignissim eu in eros. Nunc massa lacus, venenatis ut... </p><span class="readmore_button"><a href="#">Baca Selanjutnya</a></span>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
		<div class="pagination">
			<ul>
				<li class="previous_link"><a href="#"><< Previous</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li class="next_link"><a href="#">Next >></a></li>
		</div>
		
	</div>
	
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-1.jpg" />
		</div>
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-2.jpg" />
		</div>
	</div>
</div>
