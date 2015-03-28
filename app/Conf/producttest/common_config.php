<?php
	return array(
        'LOG_RECORD' =>	true,
        'URL_404_REDIRECT' => './404',
		'URL_HTML_SUFFIX'=>'',//伪静态URL设置
        'URL_CASE_INSENSITIVE' => true,
		'TMPL_ACTION_ERROR' => './error',
		'TMPL_ACTION_SUCCESS' => './success',
		'user_message_url' => 'http://www.firstp2p.com/',
		'activity_url' => 'zt',
// 		'user_message_url' => 'http://lc.who.ucfgroup.com/public/getUserMessage',
		'APP_GROUP_LIST'=>'Public,Admin',
		'DEFAULT_GROUP'=>'Public',
		'PUBLIC_MODULE_NAME'=>array('zt'),
		'SESSION_TYPE' => 'Db',
// 		'DEFAULT_MODULE' => 'Zt',
		'admin_nav_list' => array(
			array('url'=>'/admin/user','title'=>'用户管理','is_admin'=>1),
		),
		'nav_list' => array(
			array('url'=>'/admin/activity','title'=>'活动列表','is_admin'=>0),
			array('url'=>'/admin/news','title'=>'新闻管理','is_admin'=>0),
		),
		'PASS_KEY'=>'who20140225',
        'PASSPORT_SITE'=>array(
            'logncf'=>array(
                'passkey'=>'d4a363',
                'signKey'=>'d935b1',
            ),
            'testncf'=>array(
                'passKey'=>'3c8155',
                'signKey'=>'7088a7',
            ),
        ),
        'page_num'=>10,
        'check_user_status_url' => 'http://www.firstp2p.com',
		'static_url'=>'//event.firstp2p.com/',
        'ip_list' =>array('106.39.52.78','116.90.82.118','106.39.35.2','106.39.35.6','58.246.144.97','58.246.144.98','58.246.144.29','106.39.5.206'),
        'role'=>array(1=>'admin',2=>'editor',3=>'web_developer'),
        'FM'=>array('user_manage'=>'用户管理','activity_manage'=>'活动发布管理','news_manage'=>'新闻管理')
    )
?>
	
	
	