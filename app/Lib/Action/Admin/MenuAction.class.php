<?php


import("app.ORG.Wechat");
import("app.ORG.WxPayPubHelper");
//("ORG.Util.Page")
class IndexAction extends AdminBaseAction{
	
	private $_options;
	
	public function __construct(){
		$this->_options = C('weichat');
	}
	public function index(){
		$weObj = new Wechat($this->_options);
		$newmenu =  array(
		   		"button"=>
		   			array(
		   				array('type'=>'click','name'=>'菜单1','key'=>'MENU_KEY_NEWS'),
		   				array('type'=>'view','name'=>'菜单1','url'=>'http://www.baidu.com')
		  				),
		   			array(
		   				array('type'=>'click','name'=>'菜单1','key'=>'MENU_KEY_NEWS'),
		   				array('type'=>'view','name'=>'菜单1','url'=>'http://www.baidu.com')
		  				),
		   			array(
		   				array('type'=>'click','name'=>'菜单1','key'=>'MENU_KEY_NEWS'),
		   				array('type'=>'view','name'=>'菜单1','url'=>'http://www.baidu.com')
		  				)
		  		);
		$result = $weObj->createMenu($newmenu);
	}
	
}
    

	
