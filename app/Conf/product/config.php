<?php
/**
 * 合并配置文件
 */

$config = array(
		'URL_MODEL'	=>	2,
		'URL_CASE_INSENSITIVE' =>true,
		'DB_TYPE'	=>	'mysql',
		'DB_HOST'	=>	'123.57.68.39',
		'DB_NAME'	=>	'weixin',
		'DB_USER'	=>	'root',
		'DB_PWD'	=>	'WGS!@#1314527',
		'DB_PORT'	=>	'3306',
		'DB_PREFIX'	=>	'weixin_',
		'WEB_HOST' =>'lc.app.com',		
		//'DATA_CACHE_TYPE'=>'file',//设置缓存方式为file
		//'DATA_CACHE_TIME'=>'600',//缓存周期600秒 
		'LOAD_EXT_CONFIG' => array(
			'ERROR_MSG' => 'config_errormsg',
		),
		//'SERVICE_URL'=>'http://dev.who.ucfgroup.com/hub',
		'sso' => array(
           	'sign_key' => '85b190',
           	'pass_key' => 'c96765',
           	'from' => 'event',
           	'token' => '123456',
           	'sso_url' => 'http://lc.who.ucfgroup.com/Public/loginsso',
           	'redirect_url' => 'http://lc.event.firstp2p.com/admin/login/checksso?is_redirect=1',
		),
	);
$code_config = require ('common_config.php');
return array_merge($config ,$code_config); //合并配置项，返回


?>