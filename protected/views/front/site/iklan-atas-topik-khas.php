<!-- Iklan Samping Topik Khas -->
	<?php $mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'atas-topik-khas-1'")->queryRow();?>
	<?php $mioo = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'atas-topik-khas-2'")->queryRow();?>

	<?php $mio3 = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'atas-topik-khas-3'")->queryRow();?>
	<?php $mioo4 = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'atas-topik-khas-4'")->queryRow();?>
	
	<?php 
		$is_mio = $mio['object_id'];
		$is_mioo = $mioo['object_id'];

		$is_mio3 = $mio3['object_id'];
		$is_mioo4 = $mioo4['object_id'];
		$class = '';
		if( (!empty($is_mio) && empty($is_mioo)) || (!empty($is_mioo) && empty($is_mio)) 
			|| (!empty($is_mio3) && empty($is_mioo4)) || (!empty($is_mioo4) && empty($is_mio3)) )
			$class = 'one';
	?>
<div class="mb1 iklan-atas-topik-khas <?php echo $class; ?>">
	<?php if($is_mio != 0):?>
	<div class="iklan mt1">
	<?php 	if($mio['style'] == 0):
				$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas-topik-khas-1' AND f.module_id ='2' ";
				$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
				if($dataiklant1['is_external'] =='1'){ $link = $dataiklant1['link_iklan']; }else{ $link = get_link($dataiklant1['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant1['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklant1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-topik-1'";
				$dataiklant1		= Yii::app()->db->createCommand($sqliklant1)->queryRow(); 	
				echo $dataiklant1['keterangan_iklan'];
			endif;?>
	</div>
	<?php endif;?>

	<?php if($is_mioo != 0):?>
	<div class="iklan mt1">
	<?php 	if($mioo['style'] == 0):
				$sqliklant2 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas-topik-khas-2' AND f.module_id ='2' ";
				$dataiklant2		= Yii::app()->db->createCommand($sqliklant2)->queryRow(); 	
				if($dataiklant2['is_external'] =='1'){ $link = $dataiklant2['link_iklan']; }else{ $link = get_link($dataiklant2['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant2['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklant2 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-topik-2'";
				$dataiklant2		= Yii::app()->db->createCommand($sqliklant2)->queryRow(); 	
				echo $dataiklant2['keterangan_iklan'];
			endif;?>
	</div>
	<?php endif;?>
	
	<?php // new iklan ?>
	<?php if($is_mio3 != 0):?>
	<div class="iklan mt1">
	<?php 	if($mio3['style'] == 0):
				$sqliklant3 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas-topik-khas-3' AND f.module_id ='2' ";
				$dataiklant3		= Yii::app()->db->createCommand($sqliklant3)->queryRow(); 	
				if($dataiklant3['is_external'] =='1'){ $link = $dataiklant3['link_iklan']; }else{ $link = get_link($dataiklant3['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant3['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklant3 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-topik-2'";
				$dataiklant3		= Yii::app()->db->createCommand($sqliklant3)->queryRow(); 	
				echo $dataiklant3['keterangan_iklan'];
			endif;?>
	</div>
	<?php endif;?>

	<?php if($is_mioo4 != 0):?>
	<div class="iklan mt1">
	<?php 	if($mioo4['style'] == 0):
				$sqliklant4 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas-topik-khas-4' AND f.module_id ='2' ";
				$dataiklant4		= Yii::app()->db->createCommand($sqliklant4)->queryRow(); 	
				if($dataiklant4['is_external'] =='1'){ $link = $dataiklant4['link_iklan']; }else{ $link = get_link($dataiklant4['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklant4['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklant4 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-topik-2'";
				$dataiklant4		= Yii::app()->db->createCommand($sqliklant4)->queryRow(); 	
				echo $dataiklant4['keterangan_iklan'];
			endif;?>
	</div>
	<?php endif;?>

</div>