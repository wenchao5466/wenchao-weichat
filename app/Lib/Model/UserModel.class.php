<?php
/**
 * 用户
 *
 * @author Zhong Yuan 
 */
class UserModel extends CommonModel {
	
	/* protected $_validate = array(
		array('name','require','用户名称必填'),
		array('email','require','email必填'),
		array('email','email','邮箱格式错误！',2),
		array('email','','邮箱已经存在',0,'unique',1),
		array('group','require','请选择用户所属分组'),
	); */
	public function getUserByUsername($username){
		$map['username'] = $username;
		return $this->where($map)->select();
	}
	
}