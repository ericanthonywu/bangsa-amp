<?php
// change the following paths if necessary
$yii	= dirname(__FILE__).'/azzamsource/framework/yii.php';
$config	= dirname(__FILE__).'/protected/config/front.php';
require( dirname(__FILE__).'/global.php');
//debug
defined('YII_DEBUG') or define('YII_DEBUG',false );
//show profiler
defined('YII_DEBUG_SHOW_PROFILER') or define('YII_DEBUG_SHOW_PROFILER',false);
//enable profiling
defined('YII_DEBUG_PROFILING') or define('YII_DEBUG_PROFILING',false);
//trace level
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',0);
//execution time
defined('YII_DEBUG_DISPLAY_TIME') or define('YII_DEBUG_DISPLAY_TIME',false);
if(YII_DEBUG_DISPLAY_TIME)
echo Yii::getLogger()->getExecutionTime();

require_once($yii);
Yii::createWebApplication($config)->runEnd('front');
//echo "Using ", memory_get_peak_usage(1), " bytes of ram.";

