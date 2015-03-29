<?php


import("app.ORG.Wechat");
import("app.ORG.WxPayPubHelper");
//("ORG.Util.Page")
class WeichatAction extends BaseAction {
	
	private $_options;
	
	public function __construct(){
		
	}
	public function index(){
	
//		include "wechat.class.php";
		
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

			$data['jsApiParameters'] = $jsApi->getParameters();
			//echo $jsApiParameters;
			$this->_view('payment');
	}
	
	public function queryOrder(){
		//退款的订单号
		if (!isset($_POST["out_trade_no"]))
		{
			$out_trade_no = " ";
		}else{
			$out_trade_no = $_POST["out_trade_no"];

			//使用订单查询接口
			$orderQuery = new OrderQuery_pub();
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$orderQuery->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			//非必填参数，商户可根据实际情况选填
			//$orderQuery->setParameter("sub_mch_id","XXXX");//子商户号  
			//$orderQuery->setParameter("transaction_id","XXXX");//微信订单号
			
			//获取订单查询结果
			$orderQueryResult = $orderQuery->getResult();
			
			//商户根据实际情况设置相应的处理流程,此处仅作举例
			if ($orderQueryResult["return_code"] == "FAIL") {
				echo "通信出错：".$orderQueryResult['return_msg']."<br>";
			}
			elseif($orderQueryResult["result_code"] == "FAIL"){
				echo "错误代码：".$orderQueryResult['err_code']."<br>";
				echo "错误代码描述：".$orderQueryResult['err_code_des']."<br>";
			}
			else{
				echo "交易状态：".$orderQueryResult['trade_state']."<br>";
				echo "设备号：".$orderQueryResult['device_info']."<br>";
				echo "用户标识：".$orderQueryResult['openid']."<br>";
				echo "是否关注公众账号：".$orderQueryResult['is_subscribe']."<br>";
				echo "交易类型：".$orderQueryResult['trade_type']."<br>";
				echo "付款银行：".$orderQueryResult['bank_type']."<br>";
				echo "总金额：".$orderQueryResult['total_fee']."<br>";
				echo "现金券金额：".$orderQueryResult['coupon_fee']."<br>";
				echo "货币种类：".$orderQueryResult['fee_type']."<br>";
				echo "微信支付订单号：".$orderQueryResult['transaction_id']."<br>";
				echo "商户订单号：".$orderQueryResult['out_trade_no']."<br>";
				echo "商家数据包：".$orderQueryResult['attach']."<br>";
				echo "支付完成时间：".$orderQueryResult['time_end']."<br>";
			}	
		}
		
		
		$this->_view();
		
		
		
	}
	public function downloadBill(){
		/**
	 * 对账单接口demo
	 * ====================================================
	 * 商户可以通过该接口下载历史交易清单。
	*/
		
		//对账单日期
		if (!isset($_POST["bill_date"])){
			$bill_date = "20140814";
		}
		else{
			$bill_date = $_POST["bill_date"];
			
			//使用对账单接口
			$downloadBill = new DownloadBill_pub();
			//设置对账单接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$downloadBill->setParameter("bill_date","$bill_date");//对账单日期 
			$downloadBill->setParameter("bill_type","ALL");//账单类型 
			//非必填参数，商户可根据实际情况选填
			//$downloadBill->setParameter("device_info","XXXX");//设备号  
			
			//对账单接口结果
			$downloadBillResult = $downloadBill->getResult();
			echo $downloadBillResult['return_code'];
			
			if ($downloadBillResult['return_code'] == "FAIL") {
				echo "通信出错：".$downloadBillResult['return_msg'];
			}else{
				 print_r('<pre>');
				 echo "【对账单详情】"."</br>";
				 print_r($downloadBill->response);
				 print_r('</pre>');
			}
			
			$this->_view('download_bill');
		}
	}
	
	public function refund(){
		if (!isset($_POST["out_trade_no"]) || !isset($_POST["refund_fee"])){
			$out_trade_no = " ";
			$refund_fee = "1";
		}else{
			$out_trade_no = $_POST["out_trade_no"];
			$refund_fee = $_POST["refund_fee"];
			//商户退款单号，商户自定义，此处仅作举例
			$out_refund_no = "$out_trade_no"."$time_stamp";
			//总金额需与订单号out_trade_no对应，demo中的所有订单的总金额为1分
			$total_fee = "1";
			
			//使用退款接口
			$refund = new Refund_pub();
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$refund->setParameter("out_trade_no","$out_trade_no");//商户订单号
			$refund->setParameter("out_refund_no","$out_refund_no");//商户退款单号
			$refund->setParameter("total_fee","$total_fee");//总金额
			$refund->setParameter("refund_fee","$refund_fee");//退款金额
			$refund->setParameter("op_user_id",WxPayConf_pub::MCHID);//操作员
			//非必填参数，商户可根据实际情况选填
			//$refund->setParameter("sub_mch_id","XXXX");//子商户号 
			//$refund->setParameter("device_info","XXXX");//设备号 
			//$refund->setParameter("transaction_id","XXXX");//微信订单号
			
			//调用结果
			$refundResult = $refund->getResult();
			
			//商户根据实际情况设置相应的处理流程,此处仅作举例
			if ($refundResult["return_code"] == "FAIL") {
				echo "通信出错：".$refundResult['return_msg']."<br>";
			}
			else{
				echo "业务结果：".$refundResult['result_code']."<br>";
				echo "错误代码：".$refundResult['err_code']."<br>";
				echo "错误代码描述：".$refundResult['err_code_des']."<br>";
				echo "公众账号ID：".$refundResult['appid']."<br>";
				echo "商户号：".$refundResult['mch_id']."<br>";
				echo "子商户号：".$refundResult['sub_mch_id']."<br>";
				echo "设备号：".$refundResult['device_info']."<br>";
				echo "签名：".$refundResult['sign']."<br>";
				echo "微信订单号：".$refundResult['transaction_id']."<br>";
				echo "商户订单号：".$refundResult['out_trade_no']."<br>";
				echo "商户退款单号：".$refundResult['out_refund_no']."<br>";
				echo "微信退款单号：".$refundResult['refund_idrefund_id']."<br>";
				echo "退款渠道：".$refundResult['refund_channel']."<br>";
				echo "退款金额：".$refundResult['refund_fee']."<br>";
				echo "现金券退款金额：".$refundResult['coupon_refund_fee']."<br>";
			}
		}
		
		$this->_view('refund');
	}
	
	
	public function refundQuery(){
	
		//要查询的订单号
		if (!isset($_POST["out_trade_no"]))
		{
			$out_trade_no = " ";
		}else{
			$out_trade_no = $_POST["out_trade_no"];
			
			//使用退款查询接口
			$refundQuery = new RefundQuery_pub();
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$refundQuery->setParameter("out_trade_no","$out_trade_no");//商户订单号
			// $refundQuery->setParameter("out_refund_no","XXXX");//商户退款单号
			// $refundQuery->setParameter("refund_id","XXXX");//微信退款单号
			// $refundQuery->setParameter("transaction_id","XXXX");//微信退款单号
			//非必填参数，商户可根据实际情况选填
			//$refundQuery->setParameter("sub_mch_id","XXXX");//子商户号 
			//$refundQuery->setParameter("device_info","XXXX");//设备号 
			
			//退款查询接口结果
			$refundQueryResult = $refundQuery->getResult();
			
			//商户根据实际情况设置相应的处理流程,此处仅作举例
			if ($refundQueryResult["return_code"] == "FAIL") {
				echo "通信出错：".$refundQueryResult['return_msg']."<br>";
			}
			else{
				echo "业务结果：".$refundQueryResult['result_code']."<br>";
				echo "错误代码：".$refundQueryResult['err_code']."<br>";
				echo "错误代码描述：".$refundQueryResult['err_code_des']."<br>";
				echo "公众账号ID：".$refundQueryResult['appid']."<br>";
				echo "商户号：".$refundQueryResult['mch_id']."<br>";
				echo "子商户号：".$refundQueryResult['sub_mch_id']."<br>";
				echo "设备号：".$refundQueryResult['device_info']."<br>";
				echo "签名：".$refundQueryResult['sign']."<br>";
				echo "微信订单号：".$refundQueryResult['transaction_id']."<br>";
				echo "商户订单号：".$refundQueryResult['out_trade_no']."<br>";
				echo "退款笔数：".$refundQueryResult['refund_count']."<br>";
				echo "商户退款单号：".$refundQueryResult['out_refund_no']."<br>";
				echo "微信退款单号：".$refundQueryResult['refund_idrefund_id']."<br>";
				echo "退款渠道：".$refundQueryResult['refund_channel']."<br>";
				echo "退款金额：".$refundQueryResult['refund_fee']."<br>";
				echo "现金券退款金额：".$refundQueryResult['coupon_refund_fee']."<br>";
				echo "退款状态：".$refundQueryResult['refund_status']."<br>";
			}
		}
		$this->_view('refund_query');

		
	}
	
	public function weiquan(){
	
		$weObj = new Wechat($this->_options);
		print_r($weObj);die;
//		print_r($weObj);die;
		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
		$rev_data = $weObj->getRev()->getRevData();
		$data = array(
			'openid' => trim($rev_data['OpenId']),
			'appid' => trim($rev_data['AppId']),
			'timestamp' => trim($rev_data['TimeStamp']),
			'msgtype' => trim($rev_data['MsgType']),
			'feedbackid' => trim($rev_data['FeedBackId']),
			'transid' => trim($rev_data['TransId']),
			'reason' => trim($rev_data['Reason']),
			'solution' => trim($rev_data['Solution']),
			'extinfo' => trim($rev_data['ExtInfo']),
			'appsignature' => trim($rev_data['AppSignature']),
			'signmethod' => trim($rev_data['SignMethod'])
		);		
	}
}
    

	
