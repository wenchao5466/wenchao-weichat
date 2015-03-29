<?php


import("app.ORG.Wechat");
import("app.ORG.WxPayPubHelper");
//("ORG.Util.Page")
class IndexAction extends Action {
	
	private $_options;
	
	public function __construct(){
		$this->_options = C('weichat');
	}
	public function index(){
//		include "wechat.class.php";
		print_r(99);die;
		$weObj = new Wechat($this->_options);
		print_r($weObj);die;
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
	
	
	/**
	 * JS_API支付demo
	 * ====================================================
	 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
	 * 成功调起支付需要三个步骤：
	 * 步骤1：网页授权获取用户openid
	 * 步骤2：使用统一支付接口，获取prepay_id
	 * 步骤3：使用jsapi调起支付
	*/
	public function payment(){
		
			
			
			//使用jsapi接口
			$jsApi = new JsApi_pub();

			//=========步骤1：网页授权获取用户openid============
			//通过code获得openid
			if (!isset($_GET['code']))
			{
				//触发微信返回code码
				$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL);
				Header("Location: $url"); 
			}else
			{
				//获取code码，以获取openid
				$code = $_GET['code'];
				$jsApi->setCode($code);
				$openid = $jsApi->getOpenId();
			}
			
			//=========步骤2：使用统一支付接口，获取prepay_id============
			//使用统一支付接口
			$unifiedOrder = new UnifiedOrder_pub();
			
			//设置统一支付接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//spbill_create_ip已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$unifiedOrder->setParameter("openid","$openid");//商品描述
			$unifiedOrder->setParameter("body","贡献一分钱");//商品描述
			//自定义订单号，此处仅作举例
			$timeStamp = time();
			$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
			$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$unifiedOrder->setParameter("total_fee","1");//总金额
			$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
			$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
			//非必填参数，商户可根据实际情况选填
			//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
			//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
			//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
			//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
			//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
			//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
			//$unifiedOrder->setParameter("openid","XXXX");//用户标识
			//$unifiedOrder->setParameter("product_id","XXXX");//商品ID

			$prepay_id = $unifiedOrder->getPrepayId();
			//=========步骤3：使用jsapi调起支付============
			$jsApi->setPrepayId($prepay_id);

			$jsApiParameters = $jsApi->getParameters();
			//echo $jsApiParameters;
	}
	
}
    

	
