<?php
/**
* 基类，其它类都要继承这个类
*
* @author Song Wenchao <songwenchao@ucfgroup.com>
*/
import("ORG.Util.Page");// 导入分页类

class AdminBaseAction extends Action {
	public	$nav_id = 0;
	public	$admin_id = 0;
	public $data = array();
    function _initialize() {
    	$user_id = session("user_id");
    		//echo $user_id;die;
    	if(!$user_id && 'user' != strtolower(MODULE_NAME)){
    		$this->redirect('/admin/user/login');
    	}
    	
    }
    
    
    protected function _empty(){
    	$this->_view('404');
    
    }
    protected function _redirectMessage($message='成功',$status='success',$url=true,$time=3)
    {
    
    	$style = array('class'=>'panel-danger','color'=>'#FF0000','icon'=>'glyphicon-remove-circle');
    	if(!is_array($message))
    	{
    		$message=array($message,'');
    	}
    	elseif(!is_array ($message[1]))
    	{
    		$message[1]=array($message[1]);
    	}
    	if($status =='success')
    	{
    		$style = array('class'=>'panel-success','color'=>'#31708F','icon'=>'glyphicon-ok-circle');
    	}
    
    	if(is_array($url))
    	{
    		$route=isset($url[0]) ? $url[0] : '';
    		$url=$this->createUrl($route,array_splice($url,1));
    	}
    	if($url===true)
    	{
    		$url='javascript:history.back();';
    		$redirect = "history.back();";
    	}
    	elseif ($url)
    	{
    		$redirect = "window.location.href='{$url}';";
    	}
    	else
    	{
    		$redirect = "";
    	}
    
    	$this->_view('redirectMessage',array(
                'style'=>$style,
                'message'=>$message[0],
                'info' => $message[1],
                'time'=>$time,
                'url'=>$url,
                'redirect'=>$redirect,
    	));
    	exit;
    }
    
    /**
     * 
     * 普通用户不能查看管理员页面
     */
    private function _checkUserPri(){
    	$user = session('user_info');
//     	echo $user['is_admin'];die;
    	if($user['is_admin']!=1 && in_array(strtolower(MODULE_NAME), C('admin_model')) && strtolower(ACTION_NAME)!="rank" && strtolower(ACTION_NAME)!="detail" && strtolower(ACTION_NAME)!="apply"){
			$this->error('您没有权限查看此页面');
    	}
    }
    
    /**
     * 获取参数
     * @param string $name 变量名称
     */
    
    protected function _getParam($name) {
    	if (!$this->_request($name)) {
    		return trim($this->_request($name));
    	} else {
    		return $this->_request($name);
    	}
    }
    
    /**
    * 验证签名
    * @param array $params 除签名外所有参数
    * @param string $signKey 签名种子
    * @param string $sign 签名
    * @return bool
    */
    protected function _verify_signature($params, $sign, $sign_key){
    	ksort($params);
    	$verify_sign = md5(implode('', $params).$sign_key);
    	if($verify_sign == $sign){
    		return true;
    	}else{
    		return false;
    	}
    }
    /**
     * 签名
     * @param array $params 所有请求参数
     * @param string $signKey 签名种子
     * @return string
     */
    protected function _signature($params, $sign_key){
    	ksort($params);
    	$sign = md5(implode('', $params).$sign_key);
    	return $sign;
    }
    function _build_http_query($query){
    	$query_array = array();
    	foreach( $query as $key => $key_value ){
    		$query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
    	}
    	return implode( '&', $query_array );
    }


	/**
	* 渲染模板
	* @param string $tpl 模板名称，不包含路径
	* @param array $data 变量
	*/
	protected function _view($tpl, $data = array()) {
		$user_model = new UserModel();
		
		$this->_setTemplateParam();
		$this->data = array_merge($this->data,$data);
		$this->assign($this->data);
		$this->display('./'.$tpl);
	}
	
	private function _setTemplateParam(){
		$user_model = new UserModel();
		$user = $user_model->getById(session('user_id')); 
		$this->data['nav_id'] = $this->nav_id;
		$this->data['admin_id'] = $this->admin_id;
		$this->data['list'] = C('nav_list');
		$this->data['admin_nav_list'] = C('admin_nav_list');
		$this->data['current_user'] = $user;
		$this->data['user_name'] = session('user_name');
		$this->data['user_id'] = session('user_id');
		$this->data['user'] = $user;
// 		print_r($user);die;
	}
	
	protected function displayPage($page){
		$show = $page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
	}
	
}
    

	
