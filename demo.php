<?php
include "wechat.class.php";
$options = array(
		'token'=>'tokenaccesskey', //填写你设定的key
        //'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
		'appid'=>'wx5f98bc23815489a3',
		'appsecret'=>'88221fdc7ac069119e1939751d3cef7b',
		'debug'=>true,
		'logcallback'=>'logfile',
	);
	 function logfile($logs=NULL,$url='',$filename='')
	{
		$getinfo = print_r($_REQUEST, true);
		$svrinfo = print_r($_SERVER, true);
		$now = date("Y-m-d H:i:s");
		if($logs){
			if(is_array($logs)||is_object($logs))
			{
				$msg=print_r($logs,true);
			}else{
				$msg=$logs;
			}
		}else{
			$msg='';
		}
		$msg="[#LOG#]:".$msg;

		if(empty($url))
		{
			$path = 'logs/'.date("Ymd").'/';
		}
		else
		{
			$path='logs/'.date("Ymd").'/'.$url;
		}
		echo $path;die;
		if(file_exists($path)==false)
		mkdir($path,0777,true);
		if(empty($filename))
		$filename='test'.date('md');
		error_log( "\n-------------------\n$now \n[REQUEST]\n $getinfo \n$msg", 3,"$path/$filename.log");
	}
$weObj = new Wechat($options);

$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
$type = $weObj->getRev()->getRevType();
switch($type) {
	case Wechat::MSGTYPE_TEXT:
			$weObj->text("hello, I'm wechat")->reply();
			exit;
			break;
	case Wechat::MSGTYPE_EVENT:
			break;
	case Wechat::MSGTYPE_IMAGE:
			break;
	default:
			$weObj->text("help info")->reply();
}