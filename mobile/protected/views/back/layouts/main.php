<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo Yii::app()->name; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="AZZAMCMS" />
<meta name="author" content="Azzam Digital Creative Solution" />

<link href="<?php echo Yii::app()->baseUrl; ?>/css/styles.min.css" rel="stylesheet" type='text/css' media="all" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
		 
<link href='<?php echo Yii::app()->baseUrl; ?>/css/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher' /> 
<link href='<?php echo Yii::app()->baseUrl; ?>/css/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher' /> 
		
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
<!--[if lt IE 9]>
	<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
	<script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
	<link rel="stylesheet" href="assets/css/ie8.css">
<![endif]-->

<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/plugins/fullcalendar/fullcalendar.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/plugins/form-markdown/css/bootstrap-markdown.min.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/plugins/form-toggle/toggles.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/fonts/glyphicons/css/glyphicons.min.css' />
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->baseUrl; ?>/css/general.css' />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body class="">
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
	<a id="leftmenu-trigger" class="pull-left" data-toggle="tooltip" data-placement="bottom" title="Toggle Left Sidebar"></a>
	<a id="rightmenu-trigger" class="pull-right" data-toggle="tooltip" data-placement="bottom" title="Toggle Right Sidebar"></a>
	<div class="navbar-header pull-left">
		<a style="color:#FFF;line-height:40px;padding:25px 0 0 15px;" class="navbar-brands" href="<?php echo Yii::app()->getBaseUrl(true);?>" target="_blank">Lihat Tampilan Website</a>
	</div>

	<ul class="nav navbar-nav pull-right toolbar">
		<li class="dropdown">
			<?php
				if(Yii::app()->user->isGuest){
					$this->redirect(array('kelola/login'));
				}
				else{
					$loggedsUser 	= User::model()->findByPk(Yii::app()->user->id);
					$loggedUser 	= Yii::app()->db->createCommand()->select('lastname, firstname')->from('profiles')->where('user_id='.Yii::app()->user->id)->queryRow();
				}
			?>
			<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
				<span class="hidden-xs"><?php echo $loggedUser['firstname'] ." ". $loggedUser['lastname'];?><i class="icon-caret-down icon-scale"></i></span><!--<img src="" alt="<?php echo $loggedUser['firstname'] ." ". $loggedUser['lastname']; ?>" />--></a>
        		<ul class="dropdown-menu userinfo arrow">
        			<li class="username">
                        <a href="javascript:;">
        				    <!--<div class="pull-left"><img class="userimg" src="" alt="<?php echo $loggedUser['firstname']; ?>" /></div>-->
        				    <div><h5>Halo, 
				<?php echo $loggedUser['lastname'];?>!</h5><small>Masuk sebagai <span><?php echo $loggedsUser->username;?></span></small></div>
                        </a>
        			</li>
        			<li class="userlinks">
        				<ul class="dropdown-menu">
        					<li><a href="#">Edit Profil <i class="pull-right icon-pencil"></i></a></li>
        					<!-- <li><a href="#">Bantuan <i class="pull-right icon-question-sign"></i></a></li> -->
        					<li class="divider"></li>
        					<li><a href="<?php echo Yii::app()->createUrl('kelola/logout'); ?>" class="text-right">Keluar / Logout</a></li>
        				</ul>
        			</li>
        		</ul>
		</li>
	</ul>
</header>
<div id="page-container">
	<!-- BEGIN SIDEBAR -->
	<nav id="page-leftbar" role="navigation">
	<!-- BEGIN SIDEBAR MENU -->
		<ul class="acc-menu" id="sidebar">
			<li><a href="<?php echo Yii::app()->homeUrl; ?>"><i class="icon-home"></i> <span>Beranda</span></a></li>
			<li><a href="javascript:;"><i class="icon-tags"></i> <span>Kategori Berita</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('category'); ?>">Semua Kategori Berita</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('category/create'); ?>">Tambah Kategori Baru</a></li>
				</ul>
			</li>
			<li><a href="<?php echo Yii::app()->createUrl('menu'); ?>"><i class="icon-pencil"></i> <span>Pengaturan Menu</span></a></li>
			<li><a href="javascript:;"><i class="icon-h-sign"></i> <span>Halaman</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('page'); ?>">Semua Halaman</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('page/create'); ?>">Tambah Halaman Baru</a></li>
				</ul>
			</li>
			<?php 
				$items = Yii::app()->db->createCommand()->select('module_name, module_title')->from('module')->queryAll();
				foreach($items as $item):
			?>
			<li><a href="javascript:;"><i class="icon-book"></i> <span><?php echo $item['module_title']; ?></span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl($item['module_name']); ?>">Semua <?php echo $item['module_title']; ?></a></li>
					<li><a href="<?php echo Yii::app()->createUrl($item['module_name'].'/create'); ?>">Tambah <?php echo $item['module_title']; ?> Baru</a></li>
			<?php	if($item['module_name'] == 'news'):?>
					<li><a href="<?php echo Yii::app()->createUrl($item['module_name'].'/teenagefilter'); ?>">Kanal Teenage Journalism</a></li>
			<?php 	endif;?>
				</ul>
			</li>
			<?php endforeach; ?>
			<li><a href="javascript:;"><i class="icon-comment"></i> <span>Komentar</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('comments'); ?>">Semua Komentar</a></li>
				</ul>
			</li>
			<li><a href="javascript:;"><i class="icon-thumbs-up"></i> <span>Polling</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('poll'); ?>">Semua Polling</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('poll/poll/create'); ?>">Tambah Polling</a></li>
				</ul>
			</li>
			<li><a href="javascript:;"><i class="icon-user"></i> <span>User</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('user'); ?>">Semua User</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('user/default/create'); ?>">Tambah User</a></li>
					<?php 	if(Yii::app()->user->id == 1):?>
								<li><a href="<?php echo Yii::app()->createUrl('rights'); ?>">Manajemen User</a></li>
					<?php	endif;?>
					
				</ul>
			</li>
			<!--
			<li><a href="javascript:;"><i class="icon-list-alt"></i> <span>Kontak</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('contact'); ?>">Pesan Terkirim</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('contact/sent'); ?>">Pesan Masuk</a></li>
				</ul>
			</li>
			-->
			<li class="hasChild">
				<a href="javascript:;"><i class="icon-cogs"></i> <span>Pengaturan</span></a>
				<ul class="acc-menu">
					<li><a href="<?php echo Yii::app()->createUrl('content'); ?>">Pengaturan Halaman Depan</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('widget'); ?>">Pengaturan Sidebar</a></li>
					<!-- <li><a href="#">Pengaturan Berita</a></li> -->
					<li><a href="<?php echo Yii::app()->createUrl('ioptions'); ?>">Pengaturan Iklan</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('topik'); ?>">Pengaturan Topik Khas</a></li>
				</ul>
			</li>
			<li class="divider"></li>
		</ul>
		<!-- END SIDEBAR MENU -->
	</nav>
	<div id="page-content">
		<div id="wrap">
			<div id="page-heading">
				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
				<?php endif?>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php echo $content; ?>
					</div>
				</div>
			</div> <!-- container -->
		</div> <!--wrap -->
	</div> <!-- page-content -->

    <footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline">
                <li>AZZAMEDIA DIGITAL CREATIVE SOLUTION&copy; 2013</li>
                <button class="pull-right btn btn-inverse btn-xs" id="back-to-top" style="margin-top: -1px; text-transform: uppercase;"><i class="icon-arrow-up"></i></button>
            </ul>
        </div>
    </footer>
</div> 
<!-- page-container -->

<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/enquire.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/jquery.cookie.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/jquery.touchSwipe.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/jquery.nicescroll.min.js'></script>

<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/plugins/form-toggle/toggle.min.js'></script>

<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/placeholdr.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/application.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/demo.js'></script>
</body>
</html>
