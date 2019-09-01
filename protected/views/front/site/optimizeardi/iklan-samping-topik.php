<!-- Iklan Samping Topik Khas -->
<?php 
	$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'samping-topik-1'")->queryRow();?>
	<div class="iklan mb1 mt2">
	<?php 	if($mio['style'] == 0):
				$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-topik-1' AND f.module_id ='2' ";
				$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
				if($dataiklant1['is_external'] =='1'){ $link = $dataiklant1['link_iklan']; }else{ $link = get_link($dataiklant1['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant1['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-topik-1'";
				$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
				echo $dataiklant1['keterangan_iklan'];
			endif;?>
	</div>			
<?php
	$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'samping-topik-2'")->queryRow();?>
	<div class="iklan mb1 mt1">
	<?php 	if($mio['style'] == 0):
				$sqliklant2 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-topik-2' AND f.module_id ='2' ";
				$dataiklant2		= Yii::app()->db->createCommand($sqliklant2)->queryRow(); 	
				if($dataiklant2['is_external'] =='1'){ $link = $dataiklant2['link_iklan']; }else{ $link = get_link($dataiklant2['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant2['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklant2 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-topik-2'";
				$dataiklant2		= Yii::app()->db->createCommand($sqliklant2)->queryRow(); 	
				echo $dataiklant2['keterangan_iklan'];
			endif;?>
	</div>