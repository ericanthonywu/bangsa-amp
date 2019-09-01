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
<meta name="author" content="Bangsa Online" />
<meta name="rating" content="general" >
<meta name="revisit-after" content="1 days" >
<meta name="alexaVerifyID" content="pnTbUYcfyK1Tn3YhOGuEq7GQXOA"/>
<link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" /> 

<?php 
	$baseUrl 	= Yii::app()->baseUrl; 
	$cs 		= Yii::app()->getClientScript();
	
	$cs->registerCssFile($baseUrl.'/asset/bootstrap/css/bootstrap.min.css');
	$cs->registerCssFile($baseUrl.'/css/style.min.css');
	$cs->registerCssFile($baseUrl.'/css/styles_new.css');
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

<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/asset/bootstrap/js/bootstrap.min.js"></script>  

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bitter:400,400i,700|Noticia+Text:400,400i,700,700i|PT+Serif+Caption:400,400i|Roboto+Slab:100,300,400,700" rel="stylesheet">

<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<!-- Twitter Meta Card -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- Google Tracking -->	
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48722781-1', 'bangsaonline.com');
  ga('send', 'pageview');
</script>

<?php /*
<!-- Adpushup Init Begins -->
<script data-cfasync="false" type="text/javascript">(function (w, d) {
var siteId = 15652;
(w.adpushup=w.adpushup||{}).configure={config:{e3Called:false,jqLoaded:0,apLoaded:0,e3Loaded:0,rand:Math.random()}};var adp=w.adpushup,json=null,config=adp.configure.config,tL=adp.timeline={},apjQuery=null;tL.tl_adpStart=+new Date;adp.utils={uniqueId:function(appendMe){var d=+new Date,r,appendMe=((!appendMe||(typeof appendMe=="number"&&appendMe<0))?Number(1).toString(16):Number(appendMe).toString(16));appendMe=("0000000".substr(0,8-appendMe.length)+appendMe).toUpperCase();return appendMe+"-xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,function(c){r=((d=Math.floor(d / 16))+Math.random()*16)%16|0;return(c=="x"?r:(r&0x3|0x8)).toString(16);});},loadScript:function(src,sC,fC){var s=d.createElement("script");s.src=src;s.type="text/javascript";s.async=true;s.onerror=function(){if(typeof fC=="function"){fC.call();}};if(typeof d.attachEvent==="object"){s.onreadystatechange=function(){(s.readyState=="loaded"||s.readyState=="complete")?(s.onreadystatechange=null&&(typeof sC=="function"?sC.call():null)):null};}else{s.onload=function(){(typeof sC=="function"?sC.call():null)};}
(d.getElementsByTagName("head")[0]||d.getElementsByTagName("body")[0]).appendChild(s);}};adp.configure.push=function(obj){for(var key in obj){this.config[key]=obj[key];}
if(!this.config.e3Called&&this.config.siteId&&this.config.pageGroup&&this.config.packetId){var c=this.config,ts=+new Date;adp.utils.loadScript("//e3.adpushup.com/E3WebService/e3?ver=2&callback=e3Callback&siteId="+c.siteId+"&url="+encodeURIComponent(c.pageUrl)+"&pageGroup="+c.pageGroup+"&referrer="+encodeURIComponent(d.referrer)+"&cms="+c.cms+"&pluginVer="+c.pluginVer+"&rand="+c.rand+"&packetId="+c.packetId+"&_="+ts);c.e3Called=true;tL.tl_e3Requested=ts;init();}
adp.ap&&typeof adp.ap.configure=="function"&&adp.ap.configure(obj);};function init(){(w.jQuery&&w.jQuery.fn.jquery.match(/^1.11./))&&!config.jqLoaded&&(tL.tl_jqLoaded=+new Date)&&(config.jqLoaded=1)&&(apjQuery=w.jQuery.noConflict(true))&&(w.jQuery=!w.jQuery?apjQuery:w.jQuery)&&(w.$=!w.$?w.jQuery:w.$);(typeof adp.runAp=="function")&&!config.apLoaded&&(tL.tl_apLoaded=+new Date)&&(config.apLoaded=1);if(!adp.configure.config.apRun&&adp.configure.config.pageGroup&&apjQuery&&typeof adp.runAp=="function"){adp.runAp(apjQuery);adp.configure.push({apRun:true});}
if(!adp.configure.config.e3Run&&w.apjQuery&&typeof adp.ap!="undefined"&&typeof adp.ap.triggerAdpushup=="function"&&json&&typeof json!="undefined"){adp.ap.triggerAdpushup(json);adp.configure.push({e3Run:true});}};w.e3Callback=function(){(arguments[0])&&!config.e3Loaded&&(tL.tl_e3Loaded=+new Date)&&(config.e3Loaded=1);json=arguments[0];init();};adp.utils.loadScript("//optimize.adpushup.com/"+siteId+"/apv2.js",init);tL.tl_apRequested=+new Date;adp.utils.loadScript("//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js",init);tL.tl_jqRequested=+new Date;adp.configure.push({siteId:siteId,packetId:adp.utils.uniqueId(siteId),cms:"custom",pluginVer:1.0});})(window,document);
</script>
<!-- Adpushup Init Ends -->

<?php 
	// add push custom page setting
	$active_adpush = '';
	$e_activemenu = $this->action->id;
    $controllers_ac = $this->id;
    $active_menu_pg = $controllers_ac.'/'.$e_activemenu;
    if ($controllers_ac == 'kanal') {
    	$active_adpush = 'Category';
    }elseif ($controllers_ac == 'berita') {
    	$active_adpush = 'Article';
    } else {
    	$active_adpush = 'Homepage';
    }
?>
<!-- AdPushup Pagegroup Code Starts -->
<script data-cfasync="false" type="text/javascript">
((window.adpushup = window.adpushup || {}).configure = (window.adpushup.configure || [])).push({"pageGroup": "<?php echo $active_adpush; ?>"});
</script>
<!-- AdPushup Pagegroup Code Ends -->

<script type="text/javascript">
    (sc_adv_out = window.sc_adv_out || []).push({
id : "268651",
domain : "n.ads3-adnow.com"
    });
</script>
<script type="text/javascript" src="//st-n.ads3-adnow.com/js/adv_out.js"></script>
*/ ?>
 
 <?php /*
 <script type="text/javascript">
  (sc_adv_out = window.sc_adv_out || []).push({
    id : "289221",
    domain : "n.ads2-adnow.com"
  });
</script>
<script type="text/javascript" src="http://st-n.ads2-adnow.com/js/adv_out.js"></script> 

<script type="text/javascript">
	var SC_CId = "320898",SC_Domain="n.pc5ads.com";
	SC_Start_320898=(new Date).getTime();
</script>
<script type="text/javascript" src="http://st-n.pc5ads.com/js/adv_out.js"></script>
*/ ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6186859288171509",
          enable_page_level_ads: true
     });
</script>
<script type="text/javascript">
    (sc_adv_out = window.sc_adv_out || []).push({
        id : "289221",
        domain : "n.ads3-adnow.com"
    });
</script>
<script type="text/javascript" src="//st-n.ads3-adnow.com/js/a.js"></script>

</head>
<body>
	<?php $mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'atas'")->queryRow();?>
	<!-- Top Iklan -->
	<?php if($mio['object_id'] != 0):?>
	<div class="top-container mt2 mb2">
		<div class="block-iklan-1 iklan tcenter" id="iklan-top">
	<?php 	if($mio['style'] == 0):
				$sqliklantop = "SELECT mi.id,mi.is_external,mi.link_iklan,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'atas' AND f.module_id ='2' ";
				$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow();
				if($dataiklantop['is_external'] =='1'){ $link = $dataiklantop['link_iklan']; }else{ $link = get_link($dataiklantop['id'],"iklan"); }  ?>
			<a href="<?php echo $link; ?>"><?php echo get_image($dataiklantop['filename'],'iklan',null); ?></a>
	<?php	else:
				$sqliklantop = "SELECT mi.keterangan_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'atas'";
				$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow();
				echo "<span style='display:block;margin-bottom: -4px;'>".$dataiklantop['keterangan_iklan']."</span>";
			endif;?>
		</div>
	</div>
	<?php endif;?>
	<div class="container">
	<?php $mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'samping-halaman-kiri'")->queryRow();?>
		<!-- Iklan Samping Kiri -->
	<?php if($mio['object_id'] != 0):?>
		<div id="iklan-fixed-kiri">
	<?php 	if($mio['style'] == 0):
				$sqliklankiri = "SELECT mi.id,mi.is_external,mi.link_iklan,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-halaman-kiri' AND f.module_id ='2' ";
				$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow();
				if($dataiklankiri['is_external'] =='1'){ $link = $dataiklankiri['link_iklan']; }else{ $link = get_link($dataiklankiri['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankiri['filename'],'iklan',null); ?></a>
	<?php	else:
				$sqliklankiri = "SELECT mi.keterangan_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-halaman-kiri'";
				$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow();
				echo "<span style='display:block;margin-bottom: -4px;'>".$dataiklankiri['keterangan_iklan']."</span>";
			endif;?>
		</div>
	<?php endif;?>
	<?php $mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'samping-halaman-kanan'")->queryRow();?>
		<!-- Iklan Samping Kanan -->
	<?php if($mio['object_id'] != 0):?>
		<div id="iklan-fixed-kanan">
	<?php 	if($mio['style'] == 0):
			$sqliklankanan = "SELECT mi.id,mi.is_external,mi.link_iklan,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-halaman-kanan' AND f.module_id ='2' ";
			$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
				if($dataiklankanan['is_external'] =='1'){ $link = $dataiklankanan['link_iklan']; }else{ $link = get_link($dataiklankanan['id'],"iklan"); }  ?>
				<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankanan['filename'],'iklan',null); ?></a>
	<?php	else:
			$sqliklankanan = "SELECT mi.keterangan_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-halaman-kanan'";
			$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
				echo "<span style='display:block;margin-bottom: -4px;'>".$dataiklankanan['keterangan_iklan']."</span>";
			endif;?>
		</div>
	<?php endif;?>
		
		<div class="row bo-header clearfix">
			<div class="headerblock1 clearfix">
				<div class="span12 mt1">
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
				<?php $mio = Yii::app()->db->createCommand("SELECT style, object_id FROM module_iklan_options WHERE position = 'samping-logo'")->queryRow();?>
				<?php if($mio['object_id']):?>
				<div class="span12 mb1">
				<?php 	if($mio['style'] == 0):
							$sqliklansl = "SELECT mi.keterangan_iklan,mi.id,mi.is_external,mi.link_iklan,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'samping-logo' AND f.module_id ='2'";
							$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
							if($dataiklansl['is_external'] =='1'){ $link = $dataiklansl['link_iklan']; }else{ $link = get_link($dataiklansl['id'],"iklan"); }  ?>
								<a href="<?php echo $link; ?>"><?php echo get_image($dataiklansl['filename'],'iklan',null); ?></a>	
			<?php		else:
							$sqliklansl = "SELECT mi.keterangan_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'samping-logo'";
							$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
				?>
							<?php echo "<span style='display:block;margin-bottom: -4px;'>".$dataiklansl['keterangan_iklan']."</span>"; ?>
			<?php 		endif;?>
				</div>
			<?php endif;?>
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
								<li class="linkedin"><a rel="dofollow" title="" href=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer -->
	</div>
	<?php
		Yii::app()->clientScript->registerCoreScript('jquery');   	
		$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.9.0.custom.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/mainlibrary.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery.ticker.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/superfish.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery-easing-1.3.pack.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery-easing-compatibility.1.2.pack.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/coda-slider.1.1.1.pack.js',CClientScript::POS_END);
		
		$cs->registerScriptFile($baseUrl.'/js/responsiveslides.min.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/jquery.nivo.slider.pack.js',CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/js/config.js',CClientScript::POS_END);
	?>
	<div id="back-top" class="t-backtop">
    <div class="clear height-5"></div>
        <a href="#top"><i class="fa fa-chevron-up"></i></a>
    </div>
    <script type="text/javascript">
        $(window).load(function(){
        	$('.t-backtop').hide();
        });
        $(function(){
            $('.t-backtop').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });

            var $win = $(window);
                     $win.scroll(function () {
                         if ($win.scrollTop() == 0)
                         $('.t-backtop').hide();
                         else if ($win.height() + $win.scrollTop() != $(document).height() || $win.height() + $win.scrollTop() > 1000) {
                         $('.t-backtop').show();
                         }
                     });
        });             
    </script>
</body>
</html>

<!-- adpush 2 -->
<script type="text/javascript">var SC_CId = "224309",SC_Domain="n.pc3ads.com";SC_Start_224309=(new Date).getTime();</script>
<script type="text/javascript" src="//st-n.pc3ads.com/js/adv_out.js"></script>