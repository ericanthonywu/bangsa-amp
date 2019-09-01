<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="icon" type="image/x-icon" href="http://www.bangsaonline.com/img/favicon.png" /> 

<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/new_style.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/framework.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/owl.theme.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/styles/colorbox.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/jquery.js"></script>

<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/asset/bootstrap/js/bootstrap.min.js"></script>  
<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<!-- Google Tracking -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48722781-2', 'bangsaonline.com');
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

<div id="wrapper">
    <!-- <div class="overlay"></div> -->
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav sf-menu">
       		<li class="sidebar-brand">
                <a href="javascript:;">
                   <b>BangsaOnline.com</b>
                </a>
            </li>
            <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>">Home</a></li>
            <?php 
			$menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>'5'))->order('lft ASC')->queryAll();

			$level=0;
			$ullevel=0;
			foreach($menus as $n=>$menu):
				if($menu['level']==$level){
					echo CHtml::closeTag('li')."\n";
				}else if($menu['level']>$level){
					if($ullevel==0){ $ullevel++; }
					else{ echo CHtml::openTag('ul', array('class'=>'dropdown-menu'))."\n"; }
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
			<li id="list_<?php echo $menu['menu_id']; ?>" class="<?php if($menu['level']==2){echo "dropdown";}?>">
			<a href="<?php echo $menulink; ?>" ><?php echo $menu['menu_title']; ?></a>					
			<?php endif;
			$level=$menu['level'];
			?>
			<?php 
			endforeach;
			?>
			<li><a href="http://www.bangsaonline.com/?browsefrom=mobile"><small>Ganti versi desktop</small></a></li>
        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        
        <div class="all-elements">
		    <div id="content" class="page-content">
		    	<div class="page-header">
		    		<div class="container c2">
			    		<div class="row custom">
			    			<div class="col-xs-3">
			    				<div class="navs_bt_menu">
			    				<?php /*<a href="javascript: return false;" class="btn_menu hamburger is-closed" data-toggle="offcanvas">
			    				<i class="fa fa-bars"></i></a>*/ ?>
			    				<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
					                <span class="hamb-top"></span>
					    			<span class="hamb-middle"></span>
									<span class="hamb-bottom"></span>
					            </button>
			    				</div>
			    			</div>
			    			<div class="col-xs-6">
			    				<div class="logo_responsive">
									<a href="<?php echo Yii::app()->getBaseUrl(true); ?>">
										<img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo_res.png" alt="Bangsaonline"/>
									</a>
								</div>
			    			</div>
			    			<div class="col-xs-3">
			    				<div class="search_sbt"><a href="#" class="btn btn-link btns_search"><i class="fa fa-search"></i></a></div>
			    			</div>
			    		</div>
			            <div class="clear"></div>
		    		</div>
		    		<div class="views_box_search">
		    			<?php 
							$form = $this->beginWidget('CActiveForm', array(
									'id'=>'form-search',
									'htmlOptions'=>array(
										'class'=>'form-search form-inline',
									),
									'method'=>'GET',
									'action'=>Yii::app()->getBaseUrl(true)."/cari/search"
							)); 
						?>
		    				<div class="form-group">
		    					<input type="text" tabindex="1" value="Cari Berita disini" onfocus="if (this.value == 'Cari Berita disini') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cari Berita disini';}" name="title" class="input-search form-control">
		    				</div>
		    				<button class="btn btn-link"><i class="fa fa-search"></i></button>
		    			<?php $this->endWidget(); ?>
		    		</div>
		        </div>
			
		        <div class="content">
				
					<!-- Iklan Bawah Logo -->
			<?php 
				$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-bawah-logo'")->queryRow();?>
				<?php 	if($mio['style'] == 0):
						$sqliklantop = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-bawah-logo' AND f.module_id ='2' ";
						$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow();
						if($dataiklantop['is_external'] =='1'){ $link = $dataiklantop['link_iklan']; }else{ $link = get_link($dataiklantop['id'],"iklan"); }  ?>
						<?php if(!empty($dataiklantop['filename'])): ?>
							<a href="<?php echo $link; ?>"><?php echo get_image($dataiklantop['filename'],'iklan',null); ?></a>
						<?php endif;?>
			<?php	else:
						$sqliklantop = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-bawah-logo'";
						$dataiklantop		= Yii::app()->db->createCommand($sqliklantop)->queryRow();
						echo $dataiklantop['keterangan_iklan'];
					endif;?>

				<!-- Iklan Bawah Menu -->
				<div id="iklan-fixed-kiri">
				<div class="container">
			<?php 	
					$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-bawah-menu'")->queryRow();
					if($mio['style'] == 0):
						$sqliklankiri = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-bawah-menu' AND f.module_id ='2' ";
						$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow();
						if($dataiklankiri['is_external'] =='1'){ $link = $dataiklankiri['link_iklan']; }else{ $link = get_link($dataiklankiri['id'],"iklan"); }  ?>
						<?php if(!empty($dataiklankiri['filename'])): ?>
							<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankiri['filename'],'iklan',null); ?></a>
						<?php endif; ?>
			<?php	else:
						$sqliklankiri = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-bawah-menu'";
						$dataiklankiri		= Yii::app()->db->createCommand($sqliklankiri)->queryRow();
						echo $dataiklankiri['keterangan_iklan'];
					endif;?>
					</div>
					
				<!-- Iklan Atas Berita Utama -->
				<div id="iklan-fixed-kanan">
				<div class="container">
			<?php 	
					$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-atas-berita-utama'")->queryRow();
					if($mio['style'] == 0):
						$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-atas-berita-utama' AND f.module_id ='2' ";
						$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
						if($dataiklankanan['is_external'] =='1'){ $link = $dataiklankanan['link_iklan']; }else{ $link = get_link($dataiklankanan['id'],"iklan"); }  ?>
						<?php if(!empty($dataiklankanan['filename'])): ?>
							<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankanan['filename'],'iklan',null); ?></a>
						<?php endif; ?>
			<?php	else:
						$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-atas-berita-utama'";
						$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
						echo $dataiklankanan['keterangan_iklan'];
					endif;?>
			<?php 	
					// new iklan top mobile
					$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-atas-berita-utama-2'")->queryRow();
					if($mio['style'] == 0):
						$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-atas-berita-utama-2' AND f.module_id ='2' ";
						$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
						if($dataiklankanan['is_external'] =='1'){ $link = $dataiklankanan['link_iklan']; }else{ $link = get_link($dataiklankanan['id'],"iklan"); }  ?>
						<?php if(!empty($dataiklankanan['filename'])): ?>
							<div class="mb1"></div>
							<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankanan['filename'],'iklan',null); ?></a>
						<?php endif; ?>
			<?php	else:
						$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-atas-berita-utama-2'";
						$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
						echo '<div class="mb1"></div>';
						echo $dataiklankanan['keterangan_iklan'];
			endif;?>
			<?php 	
					// new iklan top mobile 3
					$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-atas-berita-utama-3'")->queryRow();
					if($mio['style'] == 0):
						$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-atas-berita-utama-3' AND f.module_id ='2' ";
						$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
						if($dataiklankanan['is_external'] =='1'){ $link = $dataiklankanan['link_iklan']; }else{ $link = get_link($dataiklankanan['id'],"iklan"); }  ?>
						<?php if(!empty($dataiklankanan['filename'])): ?>
							<div class="mb1"></div>
							<a href="<?php echo $link; ?>"><?php echo get_image($dataiklankanan['filename'],'iklan',null); ?></a>
						<?php endif; ?>
			<?php	else:
						$sqliklankanan = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-atas-berita-utama-3'";
						$dataiklankanan		= Yii::app()->db->createCommand($sqliklankanan)->queryRow();
						echo '<div class="mb1"></div>';
						echo $dataiklankanan['keterangan_iklan'];
			endif;?>

				<div class="mb1">
					<?php 
						$form = $this->beginWidget('CActiveForm', array(
								'id'=>'form-search',
								'htmlOptions'=>array(
									'class'=>'form-search-mobile',
								),
								'method'=>'GET',
								'action'=>Yii::app()->getBaseUrl(true)."/cari/search"
						)); 
					?>
					<input type="text" tabindex="1" value="Cari Berita disini" onfocus="if (this.value == 'Cari Berita disini') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cari Berita disini';}" name="title" class="input-search-mobile form-control"/>
					<?php $this->endWidget(); ?>
				</div>
				</div>
		            
		            <div class="container">
						<?php echo $content; ?>
		            	<div class="clearfix"></div>
		            </div>
					
						
					<!-- Iklan Bawah Blok -->
					<div class="top-container mt2 mb2">
						<div class="block-iklan-1 iklan tcenter" id="iklan-top">
					<?php 
							$mio = Yii::app()->db->createCommand("SELECT style FROM module_iklan_options WHERE position = 'mobile-bawah-blok'")->queryRow();
								if($mio['style'] == 0):
									$sqliklansl = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan,f.object_id,f.module_id,f.filename FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) INNER JOIN files f ON(mi.id=f.object_id) WHERE mio.position = 'mobile-bawah-blok' AND f.module_id ='2'";
									$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
									if($dataiklansl['is_external'] =='1'){ $link = $dataiklansl['link_iklan']; }else{ $link = get_link($dataiklansl['id'],"iklan"); }  ?>
									<?php if(!empty($dataiklansl['filename'])): ?>
										<a href="<?php echo $link; ?>"><?php echo get_image($dataiklansl['filename'],'iklan',null); ?></a>	
									<?php endif; ?>
					<?php		else:
									$sqliklansl = "SELECT mio.object_id,mio.position, mio.style, mi.keterangan_iklan, mi.id,mi.is_external,mi.link_iklan FROM module_iklan_options mio INNER JOIN module_iklan mi ON(mio.object_id = mi.id) WHERE mio.position = 'mobile-bawah-blok'";
									$dataiklansl		= Yii::app()->db->createCommand($sqliklansl)->queryRow(); 	
						?>
									<?php echo $dataiklansl['keterangan_iklan']; ?>
					<?php 		endif;?>
						</div>
					</div>
					
					<footer class="foot">
						<ul class="navigations">
							<li>
								<a href="<?php echo Yii::app()->getBaseUrl(true); ?>" >Home</a>
							</li>
						<?php $menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>'5'))->order('lft ASC')->queryAll();

						$level=0;
						$ullevel=0;
						foreach($menus as $n=>$menu):
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
									<a href="<?php echo $menulink; ?>" class="<?php if($menu['level']==2){echo "object-active";}?>">
										<?php echo $menu['menu_title']; ?>
									</a>
								</li>
							<?php endif;?>
						<?php endforeach;?>
						</ul>
						<div class="clearfix height-2"></div>
						<div class="lines-white"></div>
						<div class="clearfix height-20"></div>
						<ul class="navigations">
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
								endforeach;?>
							<li><a href="http://www.bangsaonline.com/?browsefrom=mobile" >Ganti versi desktop<em></em></a></li>
						</ul>
					<?php
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
			            <div class="content-footer">
			            	<p class="copyright-content">&copy; <?php echo date('Y'); ?> bangsaonline.com </p>
			                <a href="#" class="go-up-footer"></a>
			                <a href="<?php echo $facebook; ?>" class="facebook-footer"></a>
			                <a href="<?php echo $twitter; ?>" class="twitter-footer"></a>
			                <div class="clear"></div>
			            </div>
		            </footer>
		        </div>                
		    </div>  
		</div>
		<!-- end content-wrap responsive -->
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="free web tracker" ><script  type="text/javascript" >
try {Histats.start(1,3119284,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3119284&101" alt="free web tracker" border="0"></a></noscript>
<!-- Histats.com  END  -->

<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/jqueryui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/colorbox.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/snap.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/contact.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/custom.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/framework.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/scripts/framework.launcher.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function (e) {
      hamburger_cross();
      e.preventDefault();
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });

	// replace menu anchor if having sub menu
	$('#sidebar-wrapper ul.nav li.dropdown').has("ul.dropdown-menu").children('a').attr({
		'href': "javascript:;",
		'class': "dropdown-toggle",
		'data-toggle': "dropdown"
	});

	$('a.btns_search').click(function () {
        $('.views_box_search').slideToggle();
  });

});
</script>
</body>
</html>

<!-- adpush 2 -->
<script type="text/javascript">var SC_CId = "224309",SC_Domain="n.pc3ads.com";SC_Start_224309=(new Date).getTime();</script>
<script type="text/javascript" src="//st-n.pc3ads.com/js/adv_out.js"></script>