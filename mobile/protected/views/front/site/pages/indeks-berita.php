<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Indeks Berita';
$this->breadcrumbs=array(
	'Indeks Berita',
);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="block-filter-berita">
			<?php 
				$form = $this->beginWidget('CActiveForm', array(
						'id'=>'form-search',
						'htmlOptions'=>array(
							'class'=>'form-search',
						),
						'method'=>'POST',
						'action'=>Yii::app()->getBaseUrl(true)."/indeks/filter"
				)); 
			?>
				<select name="tgl" class="selectDate">
					<?php for($i=1;$i<32;$i++){ ?>
					<option value=""><?php echo $i; ?></option>
					<?php }?>
				</select>
				<select name="bln" class="selectMonth">
					<option value="">Bulan</option>
					<option value="01">Januari</option>
					<option value="02">Februari</option>
					<option value="03">Maret</option>
					<option value="04">April</option>
					<option value="05">Mei</option>
					<option value="06">Juni</option>
					<option value="07">Juli</option>
					<option value="08">Agustus</option>
					<option value="09">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select>
				<select name="thn"class="selectYear">
					<?php for($i=2014;$i>2009;$i--){ ?>
					<option value=""><?php echo $i; ?></option>
					<?php }?>
				</select>
				<select name="" class="selectCat">
					<option value="">Semua Kanal</option>
					<option value="">Ekonomi</option>
					<option value="">Religia</option>
					<option value="">Nasional & Peristiwa</option>
					<option value="">Otomotif</option>
				</select>
				<input type="submit" value="FILTER" class="inputSubmit"/>
			<?php $this->endWidget(); ?>
		</div>
		<div class="list-category-indeks">
			<?php
				$cat1  		= array("EKONOMI","RELIGIA","NASIONAL DAN PERISITIWA","OTOMOTIF","POLITIK & BIROKRASI");
				$arrlength 	= count($cat1);
				for($i=0;$i<$arrlength;$i++){ 
			?>
			<div class="category-item" id="">
				<div class="title-cagory-item"><?php echo $cat1[$i]; ?></div>
				<div class="list-category-item">
					<ul>
						<?php for($j=1;$j<6;$j++){ ?>
						<li>
							<div class="date-category-item">Sabtu, 8 Februari 2014 | 13:15 WIB</div>
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
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
