<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/azzamsource/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/back.php';
require( dirname(__FILE__).'/global.php');

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
set_time_limit(0);
Yii::createWebApplication($config)->runEnd('back');
Yii::app()->onBeginRequest = function($event)
{
	return ob_start("ob_gzhandler");
};
/*Yii::app()->onBeginRequest = function($event)
{
	return ob_start("ob_gzhandler");
};
*/