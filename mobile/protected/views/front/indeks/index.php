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
		<div class="block-filter-berita mb1">
			<?php 
				$form = $this->beginWidget('CActiveForm', array(
						'id'=>'form-filter',
						'htmlOptions'=>array(
							'class'=>'form-filter',
						),
				)); 
			?>
				<select name="Filter[Tgl]" class="selectDate form-control">
					<?php for($i=1;$i<32;$i++){ ?>
					<option value="<?php echo $i;?>" <?php if($tanggal==$i)echo "selected='selected'";?>><?php echo $i; ?></option>
					<?php }?>
				</select>
				<select name="Filter[Bulan]" class="selectMonth form-control mt1">
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
				<select name="Filter[Tahun]"class="selectYear form-control mt1">
		<?php 		$tahun = date('Y'); $tahuns = $tahun+5; for($i = $tahuns;$i>2009;$i--){ ?>
					<option value="<?php echo $i;?>"<?php if($i==$tahun)echo "selected='selected'";?>><?php echo $i;?></option>
					<?php }?>
				</select>
				<select name="Filter[Kanal]" class="selectCat form-control mt1">
					<option value="">Semua Kanal</option>
			<?php	foreach($allCat as $key=>$allCatss):?>
						<option value="<?php echo $allCatss['category_id']; ?>"<?php if($kanal==$allCatss['category_id'])echo "selected='selected'";?>><?php echo $allCatss['category_name']; ?></option>	
		<?php		endforeach;?>
				</select>
				<input type="submit" value="FILTER" class="inputSubmit btn mt1"/>
			<?php $this->endWidget(); ?>
		</div>
		<div class="list-category-indeks">	
			<?php				
				// sql check today category has news
				//$sqlcheck= "SELECT SELECT b.*,cr.* FROM category_relationship cr INNER JOIN module_news b ON(cr.post_id = b.news_id)  WHERE cr.category_id = '$thiscatid' AND b.news_id AND b.news_type=1 AND b.news_status =1 AND DATE(b.news_date) = DATE(NOW()) ORDER BY b.news_id DESC";
			
				// $sqlindeks = "SELECT * FROM category WHERE active='1' AND is_indeks='1' ORDER BY category_id ASC ";
				// $dataindeks	= Yii::app()->db->createCommand($sqlindeks)->queryAll();	
			?> 
			<?php foreach($allCat as $dindeks){ ?>		
			<?php 
				// check this cat has news
				$thiscatid = $dindeks['category_id'];
				$sqlcheck = "SELECT b.*,cr.* FROM category_relationship cr INNER JOIN module_news b ON(cr.post_id = b.news_id)  WHERE cr.category_id = '$thiscatid' AND b.news_type=1 AND b.news_status =1 AND DATE(b.news_date) LIKE '%$tahun-$bulan-$tanggal%' AND cr.category_id LIKE '{$kanal}' ORDER BY b.news_id DESC";
				$datanewscheck	= Yii::app()->db->createCommand($sqlcheck)->queryAll();
			?>
			<?php if(!empty($datanewscheck)){ ?>
			<div class="category-item-indeks" id="">
				<div class="title-category-item">
					<a href="<?php echo get_link($dindeks['category_slug'],"kanal"); ?>"><?php echo $dindeks['category_name']; ?></a>
				</div>
				<div class="list-category-item">
					<ul>
						<?php foreach($datanewscheck as $dnewspercat){ ?>
						<?php 
							// get sub berita
							$thisid = $dnewspercat['news_id'];
							$sqlgetsub ="SELECT r.*,rl.* FROM running_news r INNER JOIN running_news_relationship rl ON(rl.running_id=r.id) WHERE rl.post_id='$thisid' ";
							$datasub	= Yii::app()->db->createCommand($sqlgetsub)->queryRow();	
						?>
						<li>
							<div class="date-category-item"><?php echo get_time($dnewspercat['news_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
							<?php if(!empty($datasub)){ ?><div class="sub-judul"><?php echo $datasub['running_title']; ?></div> <?php } ?>
							<div class="link-news"><a href="<?php echo get_link_berita("berita",$dnewspercat['news_id'],$dnewspercat['news_slug']); ?>"><?php echo $dnewspercat['news_title']; ?></a></div>
						</li>
						<?php } ?>
						
					</ul>
				</div>
			</div>
			<?php } ?>
			<?php } ?> 

		</div>
	</div>
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt2">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>

