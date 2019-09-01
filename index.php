<?php
set_time_limit(0);
// change the following paths if necessary
$yii	= dirname(__FILE__).'/azzamsource/framework/yii.php';
$config	= dirname(__FILE__).'/protected/config/front.php';
require( dirname(__FILE__).'/global.php');
//debug
error_reporting(E_ALL ^ E_NOTICE);
defined('YII_DEBUG') or define('YII_DEBUG', true);

//show profiler
defined('YII_DEBUG_SHOW_PROFILER') or define('YII_DEBUG_SHOW_PROFILER', true);
//enable profiling
defined('YII_DEBUG_PROFILING') or define('YII_DEBUG_PROFILING', true);
//trace level
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 2);
//execution time
defined('YII_DEBUG_DISPLAY_TIME') or define('YII_DEBUG_DISPLAY_TIME', true);
// set_time_limit(0);

require_once($yii);
Yii::createWebApplication($config)->runEnd('front');

if(YII_DEBUG_DISPLAY_TIME)
echo Yii::getLogger()->getExecutionTime();

//echo "Using ", memory_get_peak_usage(1), " bytes of ram.";
