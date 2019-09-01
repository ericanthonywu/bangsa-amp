<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Kategori Berita';
$this->breadcrumbs=array(
	'Kategori Berita',
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
		<div class="title-category"><h1>Politik</h1></div>
		
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		
		<!-- Start List Berita -->
		<div class="list-category-berita">
			<?php 
				for($i=1;$i<9;$i++){
			?>
			<div class="berita-row mb1">
				<div class="left-category-berita">
					<div class="image-category-berita"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/images-news-category.jpg" /></div>
				</div>
				<div class="right-category-berita">
					<div class="title-category-berita"><h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a></h3></div>
					<div class="date-category-berita">19 Januari 2014 | <span class="total_comment">19 Komentar</span> </div>
					<div class="excerpt-category-berita">
						<p>Ut ut risus id massa aliquet varius ac sit amet ante. Ut ultrices lacus vel fringilla feugiat. Vivamus quis velit non orci feugiat venenatis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec nec leo at arcu venenatis dignissim eu in eros. Nunc massa lacus, venenatis ut... </p><span class="readmore_button"><a href="#">Baca Selanjutnya</a></span>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="social-sharing-category">
					<!-- AddThis Button BEGIN -->
				<!--	<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515a98304fda50f6"></script>
					<!-- AddThis Button END -->
				</div>
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
	<div class="span4 mb1 mt2">
		<!-- Start Tab Berita -->
		<div class="tab-berita mb2">
			<ul class="tabhome">
				<li id="tab-hotnews"><a href="#hotnews">HOT NEWS</a></li>
				<li id="tab-beritapopuler"><a href="#beritapopuler">BERITA TERPOPULER</a></li>
			</ul>
			<div class="content-tabhome" id="hotnews">
				<ul id="list-hotnews">
					<?php for($i=1;$i<11;$i++){ ?>
					<li>
						<div class="time-newstab"></div>
						<div class="title-newstab"><span class="time-newstab">08:10 - </span><a href="#">Lorem ipsum dolor sit amet, consecteturs</a></div>
						<div class="clearfix"></div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="content-tabhome" id="beritapopuler">
				<ul id="list-beritapopuler">
					<?php for($i=1;$i<11;$i++){ ?>
					<li>
						<div class="time-newstab"></div>
						<div class="title-newstab"><span class="time-newstab">08:30 - </span><a href="#">Bagaimana Upaya Terakhir RI Bebaskan..</a></div>
						<div class="clearfix"></div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- End Tab Berita -->
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-1.jpg" />
		</div>
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-2.jpg" />
		</div>
	</div>
</div>