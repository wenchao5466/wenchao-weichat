<?php

//定义项目名称和路径
define('APP_NAME', 'app');
define('APP_PATH', '../app/');

SWITCH($_SERVER['SERVER_NAME']){
	CASE 'lc.app.com':		//LocalHost
		define('CONCIG', 'lc/'); // 项目配置目录
		BREAK;
	CASE 'test.app.com':	//TEST
		define('CONCIG',  'test/'); // 项目配置目录
		BREAK;
	CASE 'producttest.app.com':	//DEV
		define('CONCIG', 'producttest/'); // 项目配置目录
		BREAK;
	default:	//www
		define('CONCIG',  'product/'); // 项目配置目录
	$env = "live";
	BREAK;

}
// echo CONF_PATH;die;
// 开启调试模式
define('APP_DEBUG',true);
// 加载框架入口文件
require( "../ThinkPHP/ThinkPHP.php");