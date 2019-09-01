<?php
$title 			= ucwords( strtolower($data['judul']) ) ." | Bangsa Online - Cepat, Lugas dan Akurat";
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
		<div class="title-category"><h1><?php echo ucwords($data['judul']); ?></h1></div>
		<div class="clearfix height-0"></div>
		<div class="separator-block-2"></div> <!-- Spearator -->
		<div class="clearfix height-15"></div>
		
		<div class="details_polling_dtn">
			<div class="dates_o">
				<span class="op"><i class="fa fa-calendar"></i> &nbsp;<?php echo date("d M Y", strtotime($data['tanggal_1'])) ?> – <?php echo date("d M Y", strtotime($data['tanggal_2'])) ?></span>
				<!-- // jika selesai -->
				<div class="clearfix h10"></div>
				<?php if ($data['status'] == 1): ?>
					<span class="status_r"><i class="fa fa-clock-o"></i> &nbsp;Polling Dibuka</span>
					<?php else: ?>
					<span class="status_r closed"><i class="fa fa-clock-o"></i> &nbsp;Polling Selesai</span>
				<?php endif; ?>
			</div>	
			<div class="clearfix height-20"></div>
			
			<div class="share_poling"></div>
			<div class="lines-grey"></div>
			<div class="clearfix height-30"></div>

			<!-- form list polling -->
			<?php if ( !empty($errorMessage) ): ?>
				<div class="alert alert-warning">
					<p><?php echo($errorMessage[0]); ?></p>
				</div>
			<?php endif ?>
			
			<div class="pads_form_poll">
			<?php if ($data['status'] == 1): ?>
			<form action="" method="post" class="form-horizontal form_polling">
			<?php else: ?>
			<form action="#" method="post" class="form-horizontal form_polling">
			<?php endif; ?>
			<?php if ($data['list_pil']): ?>
				<div class="lists_pil">
				<?php foreach ($data['list_pil'] as $key => $value): ?>
				<div class="form-group">
					<div class="radio">
					  <label>
					  	<?php echo get_image_polling($value->image, $value->label, 'img-responsive'); ?>
					  	<span class="clear height-4" style="display: block; height: 6px;"></span>
					    <input <?php if ($key == 0): ?>checked<?php endif ?> type="radio" name="Poll2Vote[choice_id]" id="optionsRadios1" value="<?php echo $value->id ?>">
					    <?php echo $value->label ?>
					    <span class="clear height-4" style="display: block;"></span>
					  </label>
					</div>
				</div>
				<?php endforeach ?>
				</div>
			<?php endif ?>
			<div class="clear clearfix height-15" style="height: 15px;"></div>
			<div class="padding-left-15" style="padding-left: 15px;">
				<?php if ($data['status'] == 1): ?>
				<div class="form-group">
					<div class="g-recaptcha" data-sitekey="6Ld5HhYUAAAAALlxrt-_0J5jGKhb9nnN20-DsJ17"></div>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">SUBMIT</button>
				</div>
				<?php endif; ?>
			</div>
			</form>
			</div>

			<div class="clearfix height-15"></div>
			<div class="alert alert-info">
				<?php if ($data['status'] == 1): ?>
					<p>Salurkan partisipasi anda dengan memberikan polling untuk kandidat yang anda inginkan, terima kasih atas partisipasi Anda.</p>
				<?php else: ?>
					<p>Mohon maaf polling sudah ditutup, terima kasih atas partisipasi Anda.</p>
				<?php endif ?>
			</div>

			<!-- result list polling -->
			<div class="clearfix height-20"></div>
			<div class="lines-grey"></div>
			<div class="clearfix height-30"></div>
			
			<h3 style="margin-left: 0px;">HASIL POLLING SEMENTARA</h3>
			<div class="clear height-10"></div>
			<?php $n_total = 0; ?>
			<?php if ($data['nilai_polling']): ?>
				<?php foreach ($data['nilai_polling'] as $keus => $values): ?>
				<?php 
				$n_total = $n_total + $values['suara'];
				?>		
				<?php endforeach ?>	
			<?php endif ?>
			<p>Total polling: <?php echo $n_total; ?> suara</p>
			<div class="height-25"></div>

			<div class="results_polling">
			<?php foreach ($data['nilai_polling'] as $ke => $valu): ?>
				<div class="items">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<a href="#" class="thumbnail">
						      <?php echo get_image_polling($valu['image'], $valu['title_s'], 'img-responsive no-borders'); ?>
						    </a>
						</div>
						<div class="col-xs-12 col-md-9">
							<span class="names"><?php echo $valu['title_s'] ?> &nbsp;&nbsp;&nbsp; <small><?php echo "(".$valu['nilai']."%)" ?></small></span>
							<div class="clearfix height-15"></div>
							<!-- start progress -->
							<div class="progress">
							  <div class="progress-bar progress-bar-warning progress-bar-striped active"  role="progressbar" aria-valuenow="<?php echo $valu['nilai'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $valu['nilai'] ?>%;">
							  </div>
							</div>
							<!-- end progress -->
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="clearfix"></div>
			</div>
			<?php endforeach; ?>
			</div>
			
			<div class="clearfix"></div>
		</div>
		<div class="lines-grey"></div>

		<div class="clearfix"></div>
	</div>

	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>

</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	#iklan-fixed-kanan img, 
	#iklan-fixed-kiri img {
	    width: auto;
	    max-width: 160px !important;
	    border: 1px solid #ccc;
	    padding: 5px;
	}
	img.no-borders{
		border: 0px !important;
		padding: 0px !important;
	}
</style>