<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<!--[if lt IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en-US" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en-US" class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en-US">
<!--<![endif]-->
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="charset" content="UTF-8" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<meta http-equiv="content-language" content="ID" />
<meta name="copyright" content="" />
<meta name="author" content="Bangsa Onlne" />
<meta name="email" content="info@bangsaonline.com" />
<meta name="rating" content="general" />
<meta name="distribution" content="Global" />
<meta name="revisit-after" content="1 days" />
<link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" /> 
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php 
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	
	$cs->registerCssFile($baseUrl.'/css/style.css');
	$cs->registerCssFile($baseUrl.'/css/menu.css');
	
	Yii::app()->clientScript->registerCoreScript('jquery');   

	$cs->registerScriptFile($baseUrl.'/js/jquery.ticker.js');
	$cs->registerScriptFile($baseUrl.'/js/superfish.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-easing-1.3.pack.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-easing-compatibility.1.2.pack.js');
	$cs->registerScriptFile($baseUrl.'/js/coda-slider.1.1.1.pack.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.9.0.custom.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-tabs-rotate.js');
	$cs->registerScriptFile($baseUrl.'/js/responsiveslides.min.js');
	$cs->registerScriptFile($baseUrl.'/js/config.js');
?>


<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Lato:400,900italic,900,700italic,400italic,700,300italic,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic|Roboto+Slab:400,100,300,700|Bitter:400,400italic,700|Noticia+Text:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- Twitter Meta Card -->

<!-- Google Tracking -->
	
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48722781-1', 'bangsaonline.com');
  ga('send', 'pageview');

</script>
</head>
<body id="" class="">
	<?php 
		$sqliklantop = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas' AND f.module_id ='2' ";
		$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow(); 	
		if(!empty($dataiklantop)){	
	?>
	<!-- Top Iklan -->
	<div class="top-container mt2 mb2">
		<div class="block-iklan-1 iklan tcenter" id="iklan-top">
			<?php if($dataiklantop['is_external'] =='1'){ $link = $dataiklantop['link_iklan']; }else{ $link = get_link($dataiklantop['id'],"iklan"); }  ?>
			<a href="<?php echo $link; ?>"><?php echo get_image($dataiklantop['filename'],'iklan',null); ?></a>
		</div>
	</div>
	<?php } ?>
	<div class="container">
		<?php 
			$sqliklankiri = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-halaman-kiri' AND f.module_id ='2' ";
			$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow(); 	
			if(!empty($dataiklankiri)){	
		?>
		<!-- Iklan Samping Kiri -->
		<div id="iklan-fixed-kiri">
			<?php if($dataiklankiri['is_external'] =='1'){ $link = $dataiklankiri['link_iklan']; }else{ $link = get_link($dataiklankiri['id'],"iklan"); }  ?>
			<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankiri['filename'],'iklan',null); ?></a>
		</div>
		<?php } ?>
		<?php 
			$sqliklankanan = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-halaman-kanan' AND f.module_id ='2' ";
			$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow(); 	
			if(!empty($dataiklankanan)){	
		?>
		<!-- Iklan Samping Kanan -->
		<div id="iklan-fixed-kanan">
			<?php if($dataiklankanan['is_external'] =='1'){ $link = $dataiklankanan['link_iklan']; }else{ $link = get_link($dataiklankanan['id'],"iklan"); }  ?>
			<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankanan['filename'],'iklan',null); ?></a>
		</div>
		<?php } ?>
		
		<div class="row bo-header clearfix">
			<div class="headerblock1 clearfix">
				<div class="span4 mt1 mb1">
					<div class="datenow"><?php echo get_time(date("Y-m-d H:i:s"),"dd MMMM yyyy","no");  ?></div>
					<div class="logo mb1">
						<a href="<?php echo Yii::app()->getBaseUrl(true); ?>">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" alt="Bangsa Online - Portal Berita Jawa TImur" />
						</a>
					</div>
				</div>
				<div class="span5 mb1 mt2">
				<?php 
					$sqliklansl = "SELECT mio.object_id,mio.position,mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-logo' AND f.module_id ='2' ";
					$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
					if(!empty($dataiklansl)){	
				?>				
					<?php if($dataiklansl['is_external'] =='1'){ $link = $dataiklansl['link_iklan']; }else{ $link = get_link($dataiklansl['id'],"iklan"); }  ?>
					<a href="<?php echo $link; ?>"><?php echo get_image($dataiklansl['filename'],'iklan',null); ?></a>	
				<?php } ?>
				</div>
				<div class="span3 mt2">
					<div class="searchblock">
						<?php 
							$form = $this->beginWidget('CActiveForm', array(
									'id'=>'form-search',
									'htmlOptions'=>array(
										'class'=>'form-search',
									),
									'method'=>'GET',
									'action'=>Yii::app()->getBaseUrl(true)."/cari/search"
							)); 
						?>
							<input type="text" tabindex="1" value="Cari Berita disini" onfocus="if (this.value == 'Cari Berita disini') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cari Berita disini';}" name="title" class="input-search">
							<input type="submit" class="input-search-submit" value="Cari Berita" />
						<?php $this->endWidget(); ?>
					</div>
					<div class="resgisterblock tright">
					<?php	if(Yii::app()->user->isGuest):?>
						<a href="<?php echo Yii::app()->createUrl('user/registration'); ?>">Daftar User</a> | <a href="<?php echo Yii::app()->createUrl('user/login'); ?>">Login User</a>
					<?php else: ?>
						<?php echo Yii::app()->user->name; ?> | <a href="<?php echo Yii::app()->createUrl('auth/settings'); ?>">Pengaturan</a> | <a href="<?php echo Yii::app()->createUrl('auth/logout'); ?>">Logout</a>
					<?php endif;?>
					</div>
				</div>
			</div>
			<div class="header-menu">
				<div class="menublock">
					<ul class="list-menu sf-menu" id="menu-top">
						<li class="index"><a class="object-active" href="<?php echo Yii::app()->getBaseUrl(true)."/"; ?>"><i class="fa fa-home fa-lg"></i></a></li>
						<?php 
							$menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>'1'))->order('lft ASC')->queryAll();

							$level=0;
							$ullevel=0;
							foreach($menus as $n=>$menu):
								if($menu['level']==$level){
									echo CHtml::closeTag('li')."\n";
								}else if($menu['level']>$level){
									if($ullevel==0){ $ullevel++; }
									else{ echo CHtml::openTag('ul')."\n"; }
								}else{
									echo CHtml::closeTag('li')."\n";
									for($i=$level-$menu['level'];$i;$i--){
										if($ullevel==0){ $ullevel++; }
										else{ echo CHtml::closeTag('ul')."\n"; }
										echo CHtml::closeTag('li')."\n";
									}
								}
							if($menu['menu_id'] != 1):

							// konversi 
							if($menu['menu_type'] =='category'){
								$menuslug = Yii::app()->db->createCommand()->select('category_id,category_slug')->from('category')->where('category_id=:catid', array(':catid'=>$menu['menu_url_id']))->queryRow();
								$menulink = get_link($menuslug['category_slug'],"kanal");
							}else if($menu['menu_type'] =='page'){
								$menuslug = Yii::app()->db->createCommand()->select('page_id,page_slug')->from('page')->where('page_id=:pageid', array(':pageid'=>$menu['menu_url_id']))->queryRow();
								$menulink = get_link($menuslug['page_slug']);
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
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<!-- End Header -->
		
		<?php echo $content; ?>

		<!-- Start Footer -->
		<div class="bo-footer">
			<div class="block-footer footer-1">
				<div class="row">
					<div class="span3 mt2 mb1 br1">
						<a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo-footer.png" /></a>
					</div>
					<div class="span9 mt2 mb1">
						<div class="menu-bottom">
							<ul class="menulist-bottom">
								<?php 
									$menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>'2'))->order('lft ASC')->queryAll();
									
									
									$level=0;
									$ullevel=0;
									foreach($menus as $n=>$menu):
										if($menu['level']==$level){
											echo CHtml::closeTag('li')."\n";
										}else if($menu['level']>$level){
											if($ullevel==0){ $ullevel++; }
											else{ echo CHtml::openTag('ul')."\n"; }
										}else{
											echo CHtml::closeTag('li')."\n";
											for($i=$level-$menu['level'];$i;$i--){
												if($ullevel==0){ $ullevel++; }
												else{ echo CHtml::closeTag('ul')."\n"; }
												echo CHtml::closeTag('li')."\n";
											}
										}
									if($menu['menu_id'] != 1):
									
									// konversi 
									if($menu['menu_type'] =='category'){
										$menuslug = Yii::app()->db->createCommand()->select('category_id,category_slug')->from('category')->where('category_id=:catid', array(':catid'=>$menu['menu_url_id']))->queryRow();
										$menulink = get_link($menuslug['category_slug'],"kanal");
									}else if($menu['menu_type'] =='page'){
										$menuslug = Yii::app()->db->createCommand()->select('page_id,page_slug')->from('page')->where('page_id=:pageid', array(':pageid'=>$menu['menu_url_id']))->queryRow();
										$menulink = get_link($menuslug['page_slug']);
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
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="block-footer footer-2">
				<div class="row">
					<div class="span6">
						<div class="menu-bottom-2 mt1">
							<ul>
								<?php 
									$menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>'3'))->order('lft ASC')->queryAll();
									
									
									$level=0;
									$ullevel=0;
									foreach($menus as $n=>$menu):
										if($menu['level']==$level){
											echo CHtml::closeTag('li')."\n";
										}else if($menu['level']>$level){
											if($ullevel==0){ $ullevel++; }
											else{ echo CHtml::openTag('ul')."\n"; }
										}else{
											echo CHtml::closeTag('li')."\n";
											for($i=$level-$menu['level'];$i;$i--){
												if($ullevel==0){ $ullevel++; }
												else{ echo CHtml::closeTag('ul')."\n"; }
												echo CHtml::closeTag('li')."\n";
											}
										}
									if($menu['menu_id'] != 1):
									
									// konversi 
									if($menu['menu_type'] =='category'){
										$menuslug = Yii::app()->db->createCommand()->select('category_id,category_slug')->from('category')->where('category_id=:catid', array(':catid'=>$menu['menu_url_id']))->queryRow();
										$menulink = get_link($menuslug['category_slug'],"kanal");
									}else if($menu['menu_type'] =='page'){
										$menuslug = Yii::app()->db->createCommand()->select('page_id,page_slug')->from('page')->where('page_id=:pageid', array(':pageid'=>$menu['menu_url_id']))->queryRow();
										$menulink = get_link($menuslug['page_slug']);
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
							</ul>
						</div>
						<div class="copyright mt1 mb1">
							&copy;2014 Harian Bangsa Online . Partnership with <a href="http://www.azzamedia.com" target="_blank">Azzamedia Digital </a>
						</div>
					</div>
					<div class="span6">
						<div class="social_footer mt2">
							<ul>
								<li class="fb"><a href="#"></a></li>
								<li class="twitter"><a href="#"></a></li>
								<li class="gplus"><a href="#"></a></li>
								<li class="rss"><a href="#"></a></li>
								<li class="pinterest"><a href="#"></a></li>
								<li class="linkedin"><a href="#"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer -->
	</div>	
</body>
</html>
