<?php
namespace Admin\Controller;
use Think\Controller;
class WeixinController extends Controller {

	var $parameters;//静态链接参数
	var $APPID = '';
		//受理商ID，身份标识
	var $MCHID = '';
		//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	var	$KEY = '';
		//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	var	$APPSECRET = '';
		
		//=======【JSAPI路径设置】===================================
		//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	var	$JS_API_CALL_URL = '';
		
		//=======【证书路径设置】=====================================
		//证书路径,注意应该填写绝对路径
	var	$SSLCERT_PATH = '/xxx/xxx/xxxx/WxPayPubHelper/cacert/apiclient_cert.pem';
	var	$SSLKEY_PATH = '/xxx/xxx/xxxx/WxPayPubHelper/cacert/apiclient_key.pem';
		
		//=======【异步通知url设置】===================================
		//异步通知url，商户根据实际开发过程设定
		//C('url')."admin.php/order/notify_url.html";
	var	$NOTIFY_URL = '';
	
		//=======【curl超时设置】===================================
		//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	var	$CURL_TIMEOUT = 30;
	
	var $prepay_id;
	
	
	
	
	/**
	 * 	作用：生成可以获得code的url
	 */
	function  createOauthUrlForCode($redirectUrl)
	{
		$urlObj["appid"] = $this->APPID;
		$urlObj["redirect_uri"] = urlencode("$redirectUrl"."&showwxpaytitle=1");
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "snsapi_base";
		$urlObj["state"] = "STATE"."#wechat_redirect";
		$bizString = $this->formatBizQueryParaMap($urlObj, false);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
	}
	
	/**
	 * 	作用：格式化参数，签名过程需要使用
	 */
	function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
		    if($urlencode)
		    {
			   $v = urlencode($v);
			}
			//$buff .= strtolower($k) . "=" . $v . "&";
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	
	/**
	 * 	作用：生成可以获得openid的url
	 */
	function createOauthUrlForOpenid($code)
	{
		$urlObj["appid"] = $this->APPID;
		$urlObj["secret"] = $this->APPSECRET;
		$urlObj["code"] = $code;
		$urlObj["grant_type"] = "authorization_code";
		$bizString = $this->formatBizQueryParaMap($urlObj, false);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
	}
	
	/**
	 * 	作用：通过curl向微信提交code，以获取openid
	 */
	function getOpenid($code)
	{
		$url = $this->createOauthUrlForOpenid($code);
	
        //初始化curl
       	$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOP_TIMEOUT, $this->curl_timeout);
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//运行curl，结果以jason形式返回
        $res = curl_exec($ch);
		curl_close($ch);
		//取出openid
		$data = json_decode($res,true);
		$this->openid = $data['openid'];
		return $this->openid;
	}
	
    public function js_api_call(){
		
		/**
		* 微信支付的核心方法，请在上面设置已经认证好的微信号的APPID和APPSECRET并设置ou2.0的授权目录 已确定可以获取到openid
		* 注意如果全局使用了唯一的APPID和APPSECRET 那么你其他的业务最好也是使用该参数获取的openid 根据微信开发文档的描述可能出现openid不一致的情况
		* 虽然我没测试过 233333
		*
		**/
		$orderid = $_GET['orderid'];
    	if (!isset($_GET['code'])){
			$url = $this->createOauthUrlForCode($this->JS_API_CALL_URL."?orderid=$orderid");
			Header("Location: $url"); 
		}else
		{
			$openid = $this->getOpenId($_GET['code'],$APPID,$APPSECRET);
		}
		
		//此处可以动态获取数据库中的MCHID和KEY

		$this->APPID = $order['user_weizhifu_APPID'];
		$this->MCHID =// 动态MCHID;
		$this->KEY = // 动态KEY;
		$this->APPSECRET = $order['user_weizhifu_Secret'];
		
		
		//=========步骤2：使用统一支付接口，获取prepay_id============
		//使用统一支付接口
		
		$this->parameters['openid']=$openid;//商品描述
		$this->parameters['body']="订单结算";//商品描述
		$this->parameters['out_trade_no'] = $orderid;
		$this->parameters['total_fee'] = $order['order_toolprice']*100; //此处单位为分 出现小数点接口报错必须是整数
		$this->parameters['notify_url'] = $this->NOTIFY_URL;
		$this->parameters['trade_type'] = "JSAPI";
		$prepay_id = $this->getPrepayId();
		//=========步骤3：使用jsapi调起支付============
		$this->prepay_id = $prepay_id;
		$jsApiParameters = $this->getParameters();
		$this->assign("jsApiParameters",$jsApiParameters);
		$this->assign("orderid",$orderid);
		$this->display();
    }
	/**
	 * 	作用：设置jsapi的参数
	 */
	public function getParameters()
	{
		$jsApiObj["appId"] = $this->APPID;
		$timeStamp = time();
	    $jsApiObj["timeStamp"] = "$timeStamp";
	    $jsApiObj["nonceStr"] = $this->createNoncestr();
		$jsApiObj["package"] = "prepay_id=$this->prepay_id";
	    $jsApiObj["signType"] = "MD5";
	    $jsApiObj["paySign"] = $this->getSign($jsApiObj);
	    $this->parameters = json_encode($jsApiObj);
		return $this->parameters;
	}
    
	/**
	 * 获取prepay_id
	 */
	function getPrepayId()
	{
		$result = $this->xmlToArray($this->postXml());
		$prepay_id = $result["prepay_id"];
		return $prepay_id;
	}
	/**
	 * 	作用：将xml转为array
	 */
	public function xmlToArray($xml)
	{		
        //将XML转为array        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);		
		return $array_data;
	}
	/**
	 * 	作用：post请求xml
	 */
	function postXml()
	{
	    $xml = $this->createXml();
		return  $this->postXmlCurl($xml,"https://api.mch.weixin.qq.com/pay/unifiedorder",$this->curl_timeout);
		
	}
	/**
	 * 	作用：以post方式提交xml到对应的接口url
	 */
	public function postXmlCurl($xml,$url,$second=30)
	{		
        //初始化curl        
       	$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOP_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
        $data = curl_exec($ch);
		curl_close($ch);
		//返回结果
		if($data)
		{
			curl_close($ch);
			return $data;
		}
		else 
		{ 
			$error = curl_errno($ch);
			echo "curl出错，错误码:$error"."<br>"; 
			echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
			curl_close($ch);
			return false;
		}
	}
	/**
	 * 	作用：设置标配的请求参数，生成签名，生成接口参数xml
	 */
	function createXml()
	{
	   	$this->parameters["appid"] = $this->APPID;//公众账号ID
	   	$this->parameters["mch_id"] = $this->MCHID;//商户号
	    $this->parameters["nonce_str"] = $this->createNoncestr();//随机字符串
	    $this->parameters["sign"] = $this->getSign($this->parameters);//签名
	    return  $this->arrayToXml($this->parameters);
	}
	/**
	 * 	作用：产生随机字符串，不长于32位
	 */
	public function createNoncestr( $length = 32 ) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str;
	}
	/**
	 * 	作用：array转xml
	 */
	function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
        	 if (is_numeric($val))
        	 {
        	 	$xml.="<".$key.">".$val."</".$key.">"; 

        	 }
        	 else
        	 	$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>";
        return $xml; 
    }
	/**
	 * 	作用：生成签名
	 */
	public function getSign($Obj)
	{
		foreach ($Obj as $k => $v)
		{
			$Parameters[$k] = $v;
		}
		//签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		//echo '【string1】'.$String.'</br>';
		//签名步骤二：在string后加入KEY
		$String = $String."&key=".$this->KEY;
		//echo "【string2】".$String."</br>";
		//签名步骤三：MD5加密
		$String = md5($String);
		//echo "【string3】 ".$String."</br>";
		//签名步骤四：所有字符转为大写
		$result_ = strtoupper($String);
		//echo "【result】 ".$result_."</br>";
		return $result_;
	}
    
}