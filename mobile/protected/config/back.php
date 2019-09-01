<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'Administrator Bangsa Online',
		'defaultController'=>'kelola',
		'sourceLanguage'=> 'id',
		'language'=>'id',
		'timeZone' => 'Asia/Jakarta',

		// preloading 'log' component
		'preload'=>array('log'),

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
				'password'=>'password',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1','::1'),
			),
			
			//Yii default Authorization and Authentication ENHANCHED!
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
				'loginUrl' => array('/kelola/login'),
				# page after login
				'returnUrl' => array('/user/profile'),
				# page after logout
				'returnLogoutUrl' => array('/kelola/login'),
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
				//Yii default Authorization and Authentication ENHANCHED!
				'class'=>'RWebUser',
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
				'loginUrl'=>array('/kelola/login'),
			),
			//Yii default Authorization and Authentication ENHANCHED!
			'authManager'=>array(
					'class'=>'RDbAuthManager',
					'connectionID'=>'db',
			),
			'facebook'=>array(
				'class' 	=> 'ext.yii-facebook-opengraph.SFacebook',
				'appId'		=> '362682617206965', // needed for JS SDK, Social Plugins and PHP SDK
				'secret'	=> '7f4d315d87cd15a737b24363043f67b2', // needed for the PHP SDK
				//'fileUpload'=>false, // needed to support API POST requests which send files
				//'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
				'locale'=>'en_US', // override locale setting (defaults to en_US)
				//'jsSdk'=>true, // don't include JS SDK
				'async'=>true, // load JS SDK asynchronously
				//'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
				//'status'=>true, // JS SDK - check login status
				//'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
				'oauth'=>true,  // JS SDK - enable OAuth 2.0
				'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
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
			
			// uncomment the following to enable URLs in path-format
			/*'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=>false,
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),*/
			/*
			'db'=>array(
				'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			),
			*/
			// uncomment the following to use a MySQL database
			'db'=>array(
				//'connectionString' => 'mysql:host=192.168.23.10;dbname=bangsaon_utama',
				'connectionString' => 'mysql:host=localhost;dbname=bangsaon_utama',
				'emulatePrepare' => true,
				// 'username' => 'bangsaon_user',
				// 'password' => 'af#k;1^;z4!T',
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
			'errorHandler'=>array(
				// use 'site/error' action to display errors
				'errorAction'=>'kelola/error',
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'info, error, warning',
					),
					// uncomment the following to show log messages on web pages
					/*
					array(
						'class'=>'CWebLogRoute',
					),
					*/
				),
			),
			'image'=>array(
				'class'=>'application.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'GD',
			),
			'mailgun' => array(
				'class' => 'application.extensions.php-mailgun.MailgunYii',
				'domain' => 'sandbox97640.mailgun.org',
				'key' => 'key-8mcf6xpv7-fnr5x8p7n9lnb-85jiqj44',
				'tags' => array('bangsaonline'), // You may also specify some Mailgun parameters
				'enableTracking' => false,
			),
		),
		

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			// this is used in contact page
			'adminEmail'=>'webmaster@example.com',
		),
    )
);