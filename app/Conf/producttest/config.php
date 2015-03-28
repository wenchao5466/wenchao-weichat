<?php
/**
 * 合并配置文件
 */
$config = array(
	'URL_MODEL'	=>	2,
	'URL_CASE_INSENSITIVE' =>true,
	'DB_TYPE'	=>	'mysql',
	'DB_HOST'	=>	'172.31.33.8',
	'DB_NAME'	=>	'firstp2p_event',
	'DB_USER'	=>	'f_event_user',
	'DB_PWD'	=>	'6F480DDADJYAE',
	'DB_PORT'	=>	'3306',
	'DB_PREFIX'	=>	'event_',
	'WEB_HOST' =>'event.firstp2p.com',
	//'DATA_CACHE_TYPE'=>'file',//设置缓存方式为file
	//'DATA_CACHE_TIME'=>'600',//缓存周期600秒 
	'LOAD_EXT_CONFIG' => array(
		'ERROR_MSG' => 'config_errormsg',
	),		
	'sso' => array(
		'sign_key' => '85b190',
		'pass_key' => 'c96765',
		'from' => 'event',
		'token' => '123456',
		'sso_url' => 'http://who.corp.ncfgroup.com/Public/loginsso',
		'redirect_url' => 'http://event.firstp2p.com/admin/login/checksso?is_redirect=1',
	),
);

$code_config = require ('common_config.php');
return array_merge($config ,$code_config); //合并配置项，返回


?>