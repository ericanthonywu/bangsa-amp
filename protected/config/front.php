<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
		'basePath'		=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'			=>'Bangsa Online',
		'sourceLanguage'=>'id',
		'language'		=>'id',
		'timeZone' 		=> 'Asia/Jakarta',

		// autoloading model and component classes
		'import'=>array(
			'application.models.*',
			'application.components.*',
			'ext.YiiMail.YiiMailer',
			'application.modules.user.models.*',
			'application.modules.user.components.*',
			'application.modules.rights.*',
			'application.modules.rights.components.*',
			'application.modules.poll.models.*',
			'application.modules.poll.components.*',
			'application.helpers.*',
		),
		'aliases'=>array(
			'xupload' => 'ext.xupload'
		),
		'modules'=>array(
			// uncomment the following to enable the Gii tool
			
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'okeee',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1', '192.168.1.9', '192.168.1.8','::1'),
			),
			
			'user'=>array(
				// Yii Modules RIGHTS
				'tableUsers' => 'users',
				'tableProfiles' => 'profiles',
				'tableProfileFields' => 'profiles_fields',
				# encrypting method (php hash function)
				'hash' => 'md5',
				# send activation email
				'sendActivationMail' => true,
				# allow access for non-activated users
				'loginNotActiv' => false,
				# activate user on registration (only sendActivationMail = false)
				'activeAfterRegister' => false,
				# automatically login from registration
				'autoLogin' => true,
				# registration path
				'registrationUrl' => array('/user/registration'),
				# recovery password path
				'recoveryUrl' => array('/user/recovery'),
				# login form path
				'loginUrl' => array('/user/login'),
				# page after login
				'returnUrl' => array('index.php'),
				#logout url
				'logoutUrl' => array('/user/logout'),
				# page after logout
				'returnLogoutUrl' => array('//site/index'),
			),
			'rights'=>array(
				'superuserName'=>'Admin', // Name of the role with super user privileges. 
				'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
				'userIdColumn'=>'id', // Name of the user id column in the database. 
				'userNameColumn'=>'username',  // Name of the user name column in the database. 
				'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
				'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
				'displayDescription'=>true,  // Whether to use item description instead of name. 
				'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
				'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
				'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
				'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
				'appLayout'=>'application.views.back.layouts.main', // Application layout. 
				'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
				'install'=>false,  // Whether to enable installer. 
				'debug'=>false, 
			),
			'poll' => array(
			   // Force users to vote before seeing results
			   'forceVote' => TRUE,
			   // Restrict anonymous votes by IP address,
			   // otherwise it's tied only to user_id 
			   'ipRestrict' => TRUE,
			   // Allow guests to cancel their votes
			   // if ipRestrict is enabled
			   'allowGuestCancel' => FALSE,
			),
		),

		// application components
		'components'=>array(
			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
				'loginUrl'=>array('/user/login'),
			),
			'authManager'=>array(
					'class'=>'RDbAuthManager',
					'connectionID'=>'db',
					'defaultRoles'=>array('Guest'),
			),
			// uncomment the following to enable URLs in path-format
			'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=>false,
				'rules'=>array(
					'kanal/<slug:[a-zA-Z0-9-]+>/' => 'kanal/detail',
					'video/list' => 'kanal/videos',
					'tag/<slug>/' => 'tag/detail',
					'berita/<id:[0-9]+>/<slug:>/' => 'berita/detail',
					'beritafoto/<id:[0-9]+>/<slug:[a-zA-Z0-9-]+>/' => 'beritafoto/detail',
					'beritavideo/<id:[0-9]+>/<slug:[a-zA-Z0-9-]+>/' => 'beritavideo/detail',
					'iklan/<id:[0-9]+>' => 'iklan/detail',
					'iklan' => 'iklan',
					'epaper'=>'epaper',
					'cari/<keyword:>'=>'cari/keyword',
					'auth/activation/<keygen:>'=>'auth/activation',
					'indeks'=>'indeks',
					'beritafoto'=>'beritafoto',
					'berita-video'=>'beritavideo',
					'berita-video/<id:[0-9]+>/<slug:[a-zA-Z0-9-]+>/' => 'beritavideo/detail',
					'gii'=>'gii',
					'kanal/writer/write'=>'kanal/writer',
					'kanal/writer/upload'=>'kanal/upload',
					'kanal/writer/AjaxEditCaption'=>'kanal/AjaxEditCaption',
					'<slug:[a-zA-Z0-9-]+>/'=>'halaman/detail',

					// polling
					'polling/<id:[0-9]+>/<slug:[a-zA-Z0-9-]+>/' => 'polling/detail',
					// 'polling/<id:[0-9]+>/<slug:[a-zA-Z0-9-]+>/' => 'polling/detail',

					'/sitemap-news.xml'=>'site/sitemapxmlnews',

					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),
			'facebook'=>array(
				'class' 	=> 'ext.yii-facebook-opengraph.SFacebook',
				'appId'		=> '362682617206965', // needed for JS SDK, Social Plugins and PHP SDK
				'secret'	=> '7f4d315d87cd15a737b24363043f67b2', // needed for the PHP SDK
				//'fileUpload'=>false, // needed to support API POST requests which send files
				//'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
				'locale'=>'en_US', // override locale setting (defaults to en_US)
				//'jsSdk'=>true, // don't include JS SDK
				//'async'=>true, // load JS SDK asynchronously
				//'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
				//'status'=>true, // JS SDK - check login status
				'cookie'=>false, // JS SDK - enable cookies to allow the server to access the session
				//'oauth'=>true,  // JS SDK - enable OAuth 2.0
				//'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
				//'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
				//'html5'=>true,  // use html5 Social Plugins instead of XFBML
				'ogTags'=>array(  // set default OG tags
					'og:title'		=> 'Harian Bangsa Online',
					'og:description'=> 'Harian Bangsa Online',
					'og:image'		=> '',
				),
			),
			'mobileDetect'=>array(
				'class'=>'ext.mobiledetect.MobileDetect'
			),
			/*'clientScript'=>array(
				'class'=>'ext.minScript.components.ExtMinScript',
				'optionName'=>'optionValue',
			), */
			
			
			/*
			'db'=>array(
				'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			),
			// uncomment the following to use a MySQL database
			*/
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=bangsa',
				'emulatePrepare' => true,
				// 'username' => 'bangsaon_user',
				// 'password' => 'af#k;1^;z4!T',
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
			'errorHandler'=>array(
				// use 'site/error' action to display errors
				'errorAction'		=>'site/error',
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error,trace,info,warning',
					),
					// uncomment the following to show log messages on web pages
					/*
					array(
						'class'=>'CWebLogRoute',
					),
					*/
					// array(
		   //              'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
		   //              'ipFilters'=>array('127.0.0.1', '192.168.1.101', '192.168.1.18', '192.168.1.11'),
		   //          ),
				),
			),
			'cache' => array(
	            'class' => 'CFileCache'
	        ),
			'image'=>array(
				'class'=>'application.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'GD',
			),
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			// this is used in contact page
			'adminEmail'=>'webmaster@example.com',
		),
		'behaviors'=>array(
			'seo'=>array('class'=>'ext.seo.components.SeoControllerBehavior'),
		)
    )
);