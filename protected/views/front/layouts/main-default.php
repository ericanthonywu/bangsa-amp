<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<!--[if lt IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en-US" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en-US" class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<!--<![endif]-->
<head>
<meta charset="utf-8" >
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="robots" content="index, follow" >
<meta name="googlebot" content="index, follow" >
<meta name="author" content="Bangsa Onlne" />
<meta name="rating" content="general" >
<meta name="revisit-after" content="1 days" >
<link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" /> 

<?php 
	$baseUrl 	= Yii::app()->baseUrl; 
	$cs 		= Yii::app()->getClientScript();
	
	$cs->registerCssFile($baseUrl.'/css/style.min.css');
	$cs->registerCssFile($baseUrl.'/css/nivo-slider.css');
			$query = Yii::app()->db->createCommand('SELECT option_name, option_value FROM options ORDER BY option_id')->queryAll();
			$facebook = '#';$gplus = '#';$twitter = '#';$pinterest = '#';$instagram = '#';
			foreach($query as $quer){
				if($quer['option_name'] == 'facebook_link') {$facebook = $quer['option_value'];}
				elseif($quer['option_name'] == 'google_plus_link') {$gplus = $quer['option_value'];}
				elseif($quer['option_name'] == 'twitter_link') {$twitter = $quer['option_value'];}
				elseif($quer['option_name'] == 'pinterest_link') {$pinterest = $quer['option_value'];}
				elseif($quer['option_name'] == 'instagram_link') {$instagram = $quer['option_value'];}
			}
		?>

<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Lato:400,900italic,900,700italic,400italic,700,300italic,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic%7CRoboto+Slab:400,100,300,700%7CBitter:400,400italic,700%7CNoticia+Text:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<!-- Twitter Meta Card -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
<body>
	<?php 
		$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'atas'")->queryRow();?>
	<!-- Top Iklan -->
	<div class="top-container mt2 mb2">
		<div class="block-iklan-1 iklan tcenter" id="iklan-top">
	<?php 	if($mio['style'] == 0):
				$sqliklantop = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas' AND f.module_id ='2' ";
				$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow();
				if($dataiklantop['is_external'] =='1'){ $link = $dataiklantop['link_iklan']; }else{ $link = get_link($dataiklantop['id'],"iklan"); }  ?>
			<a href="<?php echo $link; ?>"><?php echo get_image($dataiklantop['filename'],'iklan',null); ?></a>
	<?php	else:
				$sqliklantop = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'atas'";
				$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow();
				echo $dataiklantop['keterangan_iklan'];
			endif;?>
		</div>
	</div>
	<div class="container">
		<?php 
			$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'samping-halaman-kiri'")->queryRow();?>
		<!-- Iklan Samping Kiri -->
		<div id="iklan-fixed-kiri">
	<?php 	if($mio['style'] == 0):
				$sqliklankiri = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-halaman-kiri' AND f.module_id ='2' ";
				$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow();
				if($dataiklankiri['is_external'] =='1'){ $link = $dataiklankiri['link_iklan']; }else{ $link = get_link($dataiklankiri['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankiri['filename'],'iklan',null); ?></a>
	<?php	else:
				$sqliklankiri = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-halaman-kiri'";
				$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow();
				echo $dataiklankiri['keterangan_iklan'];
			endif;?>
		</div>
		<?php
			$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'samping-halaman-kanan'")->queryRow();	?>
		<!-- Iklan Samping Kanan -->
		<div id="iklan-fixed-kanan">
	<?php 	if($mio['style'] == 0):
			$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-halaman-kanan' AND f.module_id ='2' ";
			$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
				if($dataiklankanan['is_external'] =='1'){ $link = $dataiklankanan['link_iklan']; }else{ $link = get_link($dataiklankanan['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankanan['filename'],'iklan',null); ?></a>
	<?php	else:
			$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-halaman-kanan'";
			$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
				echo $dataiklankanan['keterangan_iklan'];
			endif;?>
		</div>
		
		<!-- This is Spaartaaaaan -->
		<div class="row bo-header clearfix">
			<div class="headerblock1 clearfix">
				<div class="span12 mt1 mb1">
					<div class="logo-container">
						<div class="datenow"><?php echo get_time(date("Y-m-d H:i:s"),"dd MMMM yyyy","no");  ?></div>
						<div class="logo mb1">
							<a href="<?php echo Yii::app()->getBaseUrl(true); ?>">
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" alt="Bangsa Online - Portal Berita Jawa TImur" width="341px" height="73px" />
							</a>
						</div>
					</div>
					<div class="search-containers">
						<div class="search-container">
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
							<div class="resgisterblock">
							<?php	if(Yii::app()->user->isGuest):?>
								<a href="<?php echo Yii::app()->createUrl('user/registration'); ?>">Daftar User</a> | <a href="<?php echo Yii::app()->createUrl('user/login'); ?>">Login User</a>
							<?php else: ?>
								<?php echo Yii::app()->user->name; ?> | <a href="<?php echo Yii::app()->createUrl('auth/settings'); ?>">Pengaturan</a> | <a href="<?php echo Yii::app()->createUrl('auth/logout'); ?>">Logout</a>
							<?php endif;?>
							</div>
						</div>
					</div>
					<div class="social_header">
						<ul>
							<li class="fb"><a href="<?php echo $facebook; ?>"></a></li>
							<li class="twitter"><a href="<?php echo $twitter; ?>"></a></li>
							<li class="gplus"><a href="<?php echo $gplus; ?>"></a></li>
							<li class="rss"><a href="#"></a></li>
							<li class="pinterest"><a href="<?php echo $pinterest; ?>"></a></li>
						</ul>
					</div>
				</div>
				<div class="span12 mb1 mt2">
				<?php 
					$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'samping-logo'")->queryRow();
						if($mio['style'] == 0):
							$sqliklansl = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-logo' AND f.module_id ='2'";
							$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
							if($dataiklansl['is_external'] =='1'){ $link = $dataiklansl['link_iklan']; }else{ $link = get_link($dataiklansl['id'],"iklan"); }  ?>
								<a href="<?php echo $link; ?>"><?php echo get_image($dataiklansl['filename'],'iklan',null); ?></a>	
			<?php		else:
							$sqliklansl = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-logo'";
							$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
				?>
							<?php echo $dataiklansl['keterangan_iklan']; ?>
			<?php 		endif;?>
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
			<div class="block-footer footer-3">
				<div class="row">
					<div class="span12">
						<div class="menu-bottom-2 mt1">
							<ul>
							<?php 
								$querys = Yii::app()->db->createCommand("SELECT menu_title, menu_title_attribute, menu_url, menu_url_id, menu_type FROM menu WHERE group_id = 4")->query();
								foreach($querys as $query):?>
									<?php 
										if($query['menu_type'] =='category'){
											$queryslug = Yii::app()->db->createCommand()->select('category_id,category_slug')->from('category')->where('category_id=:catid', array(':catid'=>$query['menu_url_id']))->queryRow();
											$querylink = get_link($queryslug['category_slug'],"kanal");
										}else if($query['menu_type'] =='page'){
											$queryslug = Yii::app()->db->createCommand()->select('page_id,page_slug')->from('page')->where('page_id=:pageid', array(':pageid'=>$query['menu_url_id']))->queryRow();
											$querylink = get_link($queryslug['page_slug']);
										}else{
											$querylink = $query['menu_url'];	
										}
									?>								
									<li>
										<a href="<?php echo $querylink; ?>"><?php echo $query['menu_title']; ?></a>
									</li>		
						<?php 	endforeach; ?>
						</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="block-footer footer-1">
				<div class="row">
					<div class="span3 mt2 mb1 br1">
						<a href="http://www.bangsaonline.com/">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo-footer.png" alt="Bangsa Online" width="215px" height="100px"/>
						</a>
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
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="block-footer footer-2">
				<div class="row">
					<div class="span7">
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
									endforeach;
								?>
								<li>
									<?php 
										$browse = "";
										if(Yii::app()->request->getQuery('browsefrom') == 'mobile'){
											$browse = "?browsefrom=mobile";
										}
									?>
									<?php 
										if(Yii::app()->mobileDetect->isMobile()){?>
											<a href="<?php echo "http://m.bangsaonline.com" ?>">Kembali ke versi mobile</a>
								<?php	}
									?>
								</li>
							</ul>
						</div>
						<div class="copyright mt1 mb1">
							&copy; <?php echo date('Y');?> bangsaonline.com
						</div>
					</div>
					<div class="span5">
						<div class="social_footer mt2">
							<ul>
								<li class="fb"><a href="<?php echo $facebook; ?>"></a></li>
								<li class="twitter"><a href="<?php echo $twitter; ?>"></a></li>
								<li class="gplus"><a href="<?php echo $gplus; ?>"></a></li>
								<li class="rss"><a href="#"></a></li>
								<li class="pinterest"><a href="<?php echo $pinterest; ?>"></a></li>
								<li class="linkedin"><a href="<?php echo $instagram; ?>"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer -->
		<!-- Histats.com  START (hidden counter)-->
		<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
		<a href="http://www.histats.com" target="_blank" title="free web hit counter" ><script  type="text/javascript" >
		try {Histats.start(1,3119281,4,0,0,0,"");
		Histats.track_hits();} catch(err){};
		</script></a>
		<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3119281&101" alt="free web hit counter" border="0"></a></noscript>
		<!-- Histats.com  END  -->
	</div>
	<?php
		Yii::app()->clientScript->registerCoreScript('jquery');   	
		$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.9.0.custom.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery-ui-tabs-rotate.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery.ticker.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/superfish.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery-easing-1.3.pack.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery-easing-compatibility.1.2.pack.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/coda-slider.1.1.1.pack.js',CClientScript::POS_END);
		
		$cs->registerScriptFile($baseUrl.'/js/responsiveslides.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery.nivo.slider.pack.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/config.min.js',CClientScript::POS_END);
	?>
	<script type="text/javascript">
	/*
		function downloadJSAtOnload() {
	
			var element = document.createElement("script");
			element.src = "http://www.bangsaonline.com/js/jquery-ui-1.9.0.custom.min.js";
			document.body.appendChild(element);
			
			var element2 = document.createElement("script");
			element2.src = "http://www.bangsaonline.com/js/jquery-ui-tabs-rotate.min.js";
			document.body.appendChild(element2);
			
			var element3 = document.createElement("script");
			element3.src = "http://www.bangsaonline.com/js/jquery.ticker.min.js";
			document.body.appendChild(element3);
			
			var element4 = document.createElement("script");
			element4.src = "http://www.bangsaonline.com/js/superfish.min.js";
			document.body.appendChild(element4);
			
			var element5 = document.createElement("script");
			element5.src = "http://www.bangsaonline.com/js/jquery-easing-1.3.pack.min.js";
			document.body.appendChild(element5);
			
			var element6 = document.createElement("script");
			element6.src = "http://www.bangsaonline.com/js/jquery-easing-compatibility.1.2.pack.js";
			document.body.appendChild(element6);
			
			var element7 = document.createElement("script");
			element7.src = "http://www.bangsaonline.com/js/coda-slider.1.1.1.pack.js";
			document.body.appendChild(element7);
			
			var element8 = document.createElement("script");
			element8.src = "http://www.bangsaonline.com/js/responsiveslides.min.js";
			document.body.appendChild(element8);
			
			var element9 = document.createElement("script");
			element9.src = "http://www.bangsaonline.com/js/jquery.nivo.slider.pack.js";
			document.body.appendChild(element9);
			
			var element10 = document.createElement("script");
			element10.src = "http://www.bangsaonline.com/js/config.min.js";
			document.body.appendChild(element10);
			

		}
		if (window.addEventListener)
		   window.addEventListener("load", downloadJSAtOnload, false);
		else if (window.attachEvent)
		   window.attachEvent("onload", downloadJSAtOnload);
		else window.onload = downloadJSAtOnload;
		*/
	</script>
</body>
</html>
