<?php
	return array(
		'weichat' => array(
			'token'=>'tokenaccesskey', //填写你设定的key
//	        'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
			'appid'=>'wx5f98bc23815489a3',
			'appsecret'=>'88221fdc7ac069119e1939751d3cef7b',
			'debug'=>true,
			'logcallback'=>'logfile',
		),
		'base_setting'=>array(
			
		),
		'LOG_RECORD' =>	true,
        'URL_404_REDIRECT' => './404',
		'URL_HTML_SUFFIX'=>'',//伪静态URL设置
        'URL_CASE_INSENSITIVE' => true,
		'TMPL_ACTION_ERROR' => './error',
		'TMPL_ACTION_SUCCESS' => './success',
		'APP_GROUP_LIST'=>'Public,Admin',
		'DEFAULT_GROUP'=>'Public',
		'PUBLIC_MODULE_NAME'=>array('WeiChat'),
		'DEFAULT_MODULE' => 'WeiChat',
	)
?>
	
	
	