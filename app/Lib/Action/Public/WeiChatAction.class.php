<?php


import("app.ORG.Wechat");
//("ORG.Util.Page")
class WeiChatAction extends Action {
	
	private $_options;
	
	public function __construct(){
		$this->_options = C('weichat');
	}
	public function index(){
//		include "wechat.class.php";
//		print_r($options);die;
		$weObj = new Wechat($this->_options);
//		print_r($weObj);die;
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
	}
	
	public function deliverGoods(){
		$package['appid'] = 'wx801dfba11b0c7a44';
		$package['appkey']  = "Kquzg4b3nuoROeaAVb0rtBoxsgWPciPFQMuhNWDh8vmCeO4Z6oza9fWU24dkHrDVPtgJA5kzqRjsZDHj5aWVmk7XnnVFCEMCLxRXnB6Jq9MDnVVkDd7wEJU9j6WW8fvT";
		//$package['appkey'] = 'wx801dfba11b0c7a44';
		$package['openid'] ='ojuNdtwOtM54v7s1DW6_ElqAm20Q'; 
		$package['transid'] ='1218811701201405073192805637'; 

		$package['out_trade_no'] = "222223";

		$package['deliver_timestamp'] ="1369745073";

//		$package['time_expire'] = date('YmdHis',  time() + 600);

		$package['deliver_status'] = '1';
		$package['deliver_msg'] = 'ok';


		ksort($package);
	
		$string1 = '';
	
		foreach($package as $key => $v) {
	
			$string1 .= "{$key}={$v}&";
	
		}
		$string1 = rtrim($string1, '&');
		$sign = (sha1($string1));
		
		
		$data = array("appid" => "wx801dfba11b0c7a44", 
		"openid" => "ojuNdtwOtM54v7s1DW6_ElqAm20Q",
		"transid" => "1218811701201405073192805637",
		"out_trade_no" => "222223",
		"deliver_timestamp" => "1369745073",
		"deliver_status" => "1",
		"deliver_msg" => "ok",
		"app_signature" => "$sign",
		"sign_method" => "sha1"
		); 
				
		
		                                                                  
		$data_string = json_encode($data);                                                                                  
		 
		$ch = curl_init('https://api.weixin.qq.com/pay/delivernotify?access_token=c0bLlvg-1LtGR0qMba1w7bC6zHLY7427g_8zF7ukxV1C0gKEs3LtQjicc5pKLKWP');                                                                     
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                    
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                     
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
		    'Content-Type: application/json',                                                                               
		    'Content-Length: ' . strlen($data_string))                                                                      
		);                                                                                                                  
		 
		$result = curl_exec($ch);
		curl_close($ch);
		echo $result;
	}
	
}
    

	
