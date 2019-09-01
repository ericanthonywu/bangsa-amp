<?php
	$popular_news =Yii::app()->cache->get('popular_news_m');
	if($popular_news===false)
	{
		$nrmlDate = date('Y-m-d');
		$dates = strtotime($nrmlDate);
		$datex = strtotime("-1 day", $dates);
		$date = date('Y-m-d',$datex);
		$query_res = Yii::app()->db->createCommand(
			"SELECT b.news_id, b.news_title, b.news_slug, b.click_count, b.news_date, fls.caption_title,fls.caption_desc,fls.filename 
			FROM `module_news` `b` 
			LEFT JOIN `files` `fls` ON(fls.object_id=b.news_id)
			WHERE b.news_status = 1 AND fls.module_id = 1 AND b.news_date between '$date' AND '$nrmlDate' ORDER BY b.click_count DESC, b.news_id DESC LIMIT 5"
			)->queryAll();

		Yii::app()->cache->set('popular_news_m', $query_res, 300);
	}else{
			$query_res = $popular_news;
	}
?>
<?php if ($query_res): ?>
<div class="block-berita-foto mt1 mb1">
	<div class="top-block-berita-foto">
		<div class="title-cat-berita df_top_section">
			<div class="title-berita-terkait">Berita Populer</div>
			<div class="clearfix"></div>
		</div>
		<ul class="berita-pops df_list_section">
		<?php foreach($query_res as $queryx): ?>
			<li>
				<div class="picture_news_df">
					<a title="<?php echo strip_tags($queryx['news_title']); ?>" href="<?php echo get_link_berita('berita',$queryx['news_id'],$queryx['news_slug']);?>">
				<?php if(!empty($queryx['filename'])){ ?>
					<?php echo get_image($queryx['filename'],"berita",'100x100',$queryx['caption_title']); ?>
				<?php } ?>
					</a>
				</div>
				<div class="title-newstab">
					<span class="time-newstab"><?php echo date('H:i',strtotime($queryx['news_date'])); ?></span>
					<a title="<?php echo strip_tags($queryx['news_title']); ?>" href="<?php echo get_link_berita('berita',$queryx['news_id'],$queryx['news_slug']);?>"><?php echo $queryx['news_title']; ?></a>
				</div>
				<div class="clearfix"></div>
			</li>
		<?php endforeach;?>
		</ul>
		<div class="clearfix"></div>
	</div>	
</div>
<!-- end berita populer -->
<?php endif ?>
			
<!-- Iklan Detail Berita Bawah Berita Populer -->
<?php $mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-detail-berita-bawah-berita-populer'")->queryRow();?>
<div class="mt1 iklan">
<?php 	if($mio['style'] == 0):
			$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-detail-berita-bawah-berita-populer' AND f.module_id ='2' ";
			$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
			if($dataiklant1['is_external'] =='1'){ $link = $dataiklant1['link_iklan']; }else{ $link = get_link($dataiklant1['id'],"iklan"); }  ?>
			<?php if(!empty($dataiklant1['filename'])): ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant1['filename'],'iklan',null); ?></a>
			<?php endif; ?>
<?php 	else:
			$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-detail-berita-bawah-berita-populer'";
			$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
			echo $dataiklant1['keterangan_iklan'];
		endif;?>
</div>
<!-- Iklan Detail Berita Bawah End -->

<!-- Iklan Detail Berita Bawah Berita Populer Dua -->
<?php $mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-detail-berita-bawah-berita-populer2'")->queryRow();?>
<div class="mt1 iklan">
<?php 	if($mio['style'] == 0):
			$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-detail-berita-bawah-berita-populer2' AND f.module_id ='2' ";
			$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
			if($dataiklant1['is_external'] =='1'){ $link = $dataiklant1['link_iklan']; }else{ $link = get_link($dataiklant1['id'],"iklan"); }  ?>
			<?php if(!empty($dataiklant1['filename'])): ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant1['filename'],'iklan',null); ?></a>
			<?php endif; ?>
<?php 	else:
			$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-detail-berita-bawah-berita-populer2'";
			$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
			echo $dataiklant1['keterangan_iklan'];
		endif;?>
</div>
<!-- Iklan Detail Berita Bawah End Dua -->