/*技术支持群：342893058作者：福州程序员*/<?phpheader('Content-Type: text/html; charset=utf-8');error_reporting(E_ALL & ~E_NOTICE); ini_set('display_errors', '1'); function getIP() { if (getenv('HTTP_CLIENT_IP')) { $ip = getenv('HTTP_CLIENT_IP'); } elseif (getenv('HTTP_X_FORWARDED_FOR')) { $ip = getenv('HTTP_X_FORWARDED_FOR'); } elseif (getenv('HTTP_X_FORWARDED')) { $ip = getenv('HTTP_X_FORWARDED'); } elseif (getenv('HTTP_FORWARDED_FOR')) { $ip = getenv('HTTP_FORWARDED_FOR'); } elseif (getenv('HTTP_FORWARDED')) { $ip = getenv('HTTP_FORWARDED'); } else { $ip = $_SERVER['REMOTE_ADDR']; } return $ip; } 	 function create_password($pw_length=1)      {        $randpwd ="";         for ($i = 0; $i < $pw_length; $i++)         {              $randpwd .= chr(mt_rand(65,90));          }         return $randpwd;      }    function wechat_build() {	$wOpt['appId'] ="wx801dfba11b0c7a44";	$wOpt['timeStamp'] = time();	$wOpt['nonceStr'] = "333";	$package = array();	$package['bank_type'] = 'WX';	$package['body'] ="妆媒体年会员";	$package['attach'] ="test";	$package['partner'] = "1218811701";		$package['out_trade_no'] = "233444";		$package['out_trade_no'] =create_password(6);	$package['total_fee'] =10000;	$package['fee_type'] = '1';	$package['notify_url'] ='http://diy.zhuang5.cn/pay/payqrcode.php'; 	$package['spbill_create_ip'] =getIP();	$package['time_start'] = date('YmdHis', time());	$package['time_expire'] = date('YmdHis',  time() + 600);	$package['input_charset'] = 'UTF-8';	ksort($package);	$string1 = '';	foreach($package as $key => $v) {		$string1 .= "{$key}={$v}&";	}		$string1 .= "key=595da8ce27b297bb80b1d505240fbacb";	$sign = strtoupper(md5($string1));	$string2 = '';	foreach($package as $key => $v) {		$v = urlencode($v);		$string2 .= "{$key}={$v}&";	}	$string2 .= "sign={$sign}";	$wOpt['package'] = $string2;	$string = '';	$keys = array('appId', 'timeStamp', 'nonceStr', 'package', 'appKey');	sort($keys);	foreach($keys as $key) {		$v = $wOpt[$key];		if($key == 'appKey') {			$v = "Kquzg4b3nuoROeaAVb0rtBoxsgWPciPFQMuhNWDh8vmCeO4Z6oza9fWU24dkHrDVPtgJA5kzqRjsZDHj5aWVmk7XnnVFCEMCLxRXnB6Jq9MDnVVkDd7wEJU9j6WW8fvT";		}		$key = strtolower($key);		$string .= "{$key}={$v}&";	}	$string = rtrim($string, '&');	$wOpt['signType'] = 'SHA1';	$wOpt['paySign'] = sha1($string);	return $wOpt;}$wOpt = wechat_build();?><script type="text/javascript">document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {	WeixinJSBridge.invoke('getBrandWCPayRequest', {		'appId' : '<?php echo $wOpt['appId'];?>',		'timeStamp': '<?php echo $wOpt['timeStamp'];?>',		'nonceStr' : '<?php echo $wOpt['nonceStr'];?>',		'package' : '<?php echo $wOpt['package'];?>',		'signType' : '<?php echo $wOpt['signType'];?>',		'paySign' : '<?php echo $wOpt['paySign'];?>'	}, function(res) {		if(res.err_msg == 'get_brand_wcpay_request:ok') {			location.search += '&done=1';		} else {		//	alert('启动微信支付失败, 请检查你的支付参数. 详细错误为: ' + res.err_msg);			history.go(-1);		}	});}, false);</script>