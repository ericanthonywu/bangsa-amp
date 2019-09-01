<?php 
	$menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>'1'))->order('lft ASC')->queryAll();
	
	
	$level=0;
	$ullevel=0;
	foreach($menus as $n=>$menu):
		if($menu['level']==$level){
			echo CHtml::closeTag('li')."\n";
		}else if($menu['level']>$level){
			if($ullevel==0){
				$ullevel++;
			}
			else{
				echo CHtml::openTag('ul')."\n";
			}
		}else{
			echo CHtml::closeTag('li')."\n";
			for($i=$level-$menu['level'];$i;$i--){
				if($ullevel==0){
					$ullevel++;
				}
				else{
					echo CHtml::closeTag('ul')."\n";
				}
				echo CHtml::closeTag('li')."\n";
			}
		}
	if($menu['menu_id'] != 1):
	
	// konversi 
	if($menu['menu_type'] =='category'){
		$menutype = 'kanal';
		$menuslug = Yii::app()->db->createCommand()->select('category_id,category_slug')->from('category')->where('category_id=:catid', array(':catid'=>$menu['menu_url_id']))->queryRow();
		$menulink = get_link_kategori($menuslug['category_slug']);
	}else if($menu['menu_type'] =='page'){
		$menutype = 'halaman';
		$menuslug = Yii::app()->db->createCommand()->select('page_id,page_slug')->from('page')->where('page_id=:pageid', array(':pageid'=>$menu['menu_url_id']))->queryRow();
		$menulink = get_link_halaman($menuslug['page_slug']);
	}else{
		$menulink = $menu['menu_url'];	
	}
	
?>
	<li id="list_<?php echo $menu['menu_id']; ?>">
	<a href="<?php echo $menulink; ?>" class="<?php if($menu['level']==2){echo "object-active";}?>"><?php echo $menu['menu_title']; ?></a>					
<?php endif;
	$level=$menu['level'];
?>
<?php 
	endforeach;

	for($i=$level;$i;$i--){
		echo CHtml::closeTag('li')."\n";
		echo CHtml::closeTag('ul')."\n";
	}
?>