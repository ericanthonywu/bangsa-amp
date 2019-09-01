<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Detail Berita';
$this->breadcrumbs=array(
	'Detail',
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
		<div class="block-detail-berita">
			<div class="title-detail-berita">
				<h1>Donec nec leo at arcu nunc massa lacus,venenatis ut blandit a nulla.</h1>
			</div>
			<div class="date-detail-berita">Sabtu, 25 Januari 2014  |  21:33 WIB</div>
			<div class="image-detail-berita"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/images-detail-berita.jpg" /></div>
			<div class="descimage-detail-berita"></div>
			<div class="content-detail-berita">
				<p>
					<strong>JAKARTA, BANGSAONLINE.COM</strong>   -   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis purus a orci hendrerit vehicula id at risus. Nam mauris lorem, accumsan non leo ut, adipiscing porta urna. Vestibulum a ultrices elit, non semper augue. Curabitur tellus libero, viverra vitae quam vitae, ultrices tempus dolor. Aenean tempor enim erat. Donec non lorem convallis purus ornare porttitor a nec lectus. Nulla vestibulum euismod urna, vitae mollis diam placerat sit amet. Nulla hendrerit augue sed orci porta, id facilisis turpis commodo.
				</p>
				<?php for($i=1;$i<5;$i++){ ?>
				<p>Donec nec leo at arcu venenatis dignissim eu in eros. Nunc massa lacus, venenatis ut pretium non, blandit a nulla. Duis in quam sodales, blandit dui a, bibendum neque. Nunc non vulputate elit. Mauris vel ante tincidunt, adipiscing urna vitae, hendrerit nisl. Ut ac arcu bibendum, suscipit massa at, rutrum turpis. Integer mattis odio eget leo lobortis, sed fringilla tellus sollicitudin. Nulla tellus dui, venenatis at malesuada in, tincidunt pulvinar quam. Integer at elit nisl. Maecenas porta velit adipiscing sapien varius interdum.
				</p>
				<?php } ?>
			</div>
			<div class="att-detail-berita">
				<div class="author-berita">Diposkan Oleh : Administrator </div>
				<div class="tag-berita">
					<span>Tag Berita : </span>
					<ul>
						<li><a href="">presiden</a></li>
						<li><a href="">susilo bambang</a></li>
						<li><a href="">yudhoyono</a></li>
						<li><a href="">hormat bendera</a></li>
						<li><a href="">upacara</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="att-sharing-berita">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
					<a class="addthis_counter addthis_pill_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515a98304fda50f6"></script>
				<!-- AddThis Button END -->
			</div>
		</div>
		<div class="block-other-berita mt1 mb1">
			<div class="berita-terkait">
				<div class="title-berita-terkait">Berita Terkait</div>
				<div class="list-berita-terkait">
					<ul>
						<?php for($i=1;$i<6;$i++){ ?>
						<li><a href="#">Lorem ipsum dolor sit amet, consectetur, Lorem ipsum dolor sit amet, consectetur</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="mt2 mb1 block-iklan-2 tcenter">
			<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-konten.jpg" /></a>
		</div>
		<?php $this->renderPartial('_komentar'); ?>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-1.jpg" />
		</div>
		<div class="block-iklan-5 mb2">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/iklan-widget-2.jpg" />
		</div>
	</div>
</div>
