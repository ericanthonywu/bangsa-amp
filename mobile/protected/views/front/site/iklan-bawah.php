<!-- Iklan Bawah -->
<div class="block-iklan-4">
	<?php 
		$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'iklan-bawah-1'")->queryRow();?>
	<div class="span7 mt1 mb1">
	<?php 	if($mio['style'] == 0):
				$sqliklanb1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'iklan-bawah-1' AND f.module_id ='2' ";
				$dataiklanb1		= Yii::app()->db->createCommand($sqliklanb1)->queryRow(); 	
				if($dataiklanb1['is_external'] =='1'){ $link = $dataiklanb1['link_iklan']; }else{ $link = get_link($dataiklanb1['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklanb1['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklanb1 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'iklan-bawah-1'";
				$dataiklanb1		= Yii::app()->db->createCommand($sqliklanb1)->queryRow(); 	
				echo $dataiklanb1['keterangan_iklan'];
			endif;?>
	</div>	
	<?php 
		$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'iklan-bawah-2'")->queryRow();?>
	<div class="span5 mt1 mb1">
		<?php if($mio['style'] == 0):
				$sqliklanb2 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style, f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'iklan-bawah-2' AND f.module_id ='2' ";
				$dataiklanb2		= Yii::app()->db->createCommand($sqliklanb2)->queryRow(); 	
				if($dataiklanb2['is_external'] =='1'){ $link = $dataiklanb2['link_iklan']; }else{ $link = get_link($dataiklanb2['id'],"iklan"); }  ?>
			<a href="<?php echo $link; ?>"><?php echo get_image($dataiklanb2['filename'],'iklan',null); ?></a>
	<?php 	else:
				$sqliklanb2 = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan, mi.keterangan_iklan, mio.style FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'iklan-bawah-2'";
				$dataiklanb2		= Yii::app()->db->createCommand($sqliklanb2)->queryRow(); 	
				echo $dataiklanb2['keterangan_iklan'];
			endif;?>
	</div>
</div>