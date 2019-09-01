<?php
/* @var $this IndeksController */

$this->breadcrumbs=array(
	'Indeks Berita',
);
$this->pageTitle= Yii::app()->name . ' - Indeks Berita';
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
		<div class="title-page"><h1>Indeks Berita</h1></div>
		<div class="block-filter-berita">
			<?php 
				$form = $this->beginWidget('CActiveForm', array(
						'id'=>'form-search',
						'htmlOptions'=>array(
							'class'=>'form-search',
						),
				)); 
			?>
				<select name="Filter[Tgl]" class="selectDate">
					<?php for($i=1;$i<32;$i++){ ?>
					<option value="<?php echo $i;?>" <?php if($tanggal==$i)echo "selected='selected'";?>><?php echo $i; ?></option>
					<?php }?>
				</select>
				<select name="Filter[Bulan]" class="selectMonth">
					<option value="01" <?php if($bulan==01)echo "selected='selected'";?>>Januari</option>
					<option value="02" <?php if($bulan==02)echo "selected='selected'";?>>Februari</option>
					<option value="03" <?php if($bulan==03)echo "selected='selected'";?>>Maret</option>
					<option value="04" <?php if($bulan==04)echo "selected='selected'";?>>April</option>
					<option value="05" <?php if($bulan==05)echo "selected='selected'";?>>Mei</option>
					<option value="06" <?php if($bulan==06)echo "selected='selected'";?>>Juni</option>
					<option value="07" <?php if($bulan==07)echo "selected='selected'";?>>Juli</option>
					<option value="08" <?php if($bulan==08)echo "selected='selected'";?>>Agustus</option>
					<option value="09" <?php if($bulan==09)echo "selected='selected'";?>>September</option>
					<option value="10" <?php if($bulan==10)echo "selected='selected'";?>>Oktober</option>
					<option value="11" <?php if($bulan==11)echo "selected='selected'";?>>November</option>
					<option value="12" <?php if($bulan==12)echo "selected='selected'";?>>Desember</option>
				</select>
				<select name="Filter[Tahun]"class="selectYear">
					<?php for($i=2014;$i<=2018;$i++){ ?>
					<option value="<?php echo $i;?>"<?php if($tahun==$i)echo "selected='selected'";?>><?php echo $i; ?></option>
					<?php }?>
				</select>
				<select name="Filter[Kanal]" class="selectCat">
					<option value="">Semua Kanal</option>
			<?php	foreach($allCat as $key=>$allCatss):?>
						<option value="<?php echo $allCatss['category_id']; ?>"<?php if($kanal==$allCatss['category_id'])echo "selected='selected'";?>><?php echo $allCatss['category_name']; ?></option>	
		<?php		endforeach;?>
				</select>
				<input type="submit" value="FILTER" class="inputSubmit"/>
			<?php $this->endWidget(); ?>
		</div>

		<div class="list-category-indeks">
	<?php 	foreach($allCat as $key=>$dindeks):
				$sqls = "SELECT n.news_title, n.news_date, n.news_id, n.news_slug FROM module_news AS n INNER JOIN category_relationship AS cr ON n.news_id=cr.post_id WHERE cr.category_id={$dindeks['category_id']} AND n.news_date LIKE '%$tahun-$bulan-$tanggal%' AND n.news_status = 1 AND cr.category_id LIKE '{$kanal}' ORDER BY n.news_id";
				$data	= Yii::app()->db->createCommand($sqls)->queryAll();
				if(count($data)>0):?>
					<?php echo $dindeks['category_name']."<br />";
					foreach($data as $ds):?>
					<div class="mb1">
						<div>
							<?php echo get_time($ds['news_date'], "long");?>
						</div>
						<div>
							<a href="<?php echo get_link_berita("berita", $ds['news_id'], $ds['news_slug']); ?>">
								<?php echo $ds['news_title']."<br />";?></div>
							</a>
					</div>
	<?php			endforeach;?>
					<br />
	<?php 		endif;
			endforeach; ?> 
		</div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>

