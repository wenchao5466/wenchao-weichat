<?php


class UserAction extends AdminBaseAction {
	public function login(){
		$user_id = session("user_id");
		if($user_id){
			$this->redirect('/admin/index');
		}
		$data['title'] = '登陆';
		$this->_view('login',$data);
	}
	public function loginOut(){
		if(session('user_id')){
        	session('user_id',null); // 删除user_id
            $this->redirect('User/login');
        }else {
            $this->_view('./error');
        }
	}
	
	public function checkUser(){
		
		if($this->_getParam('username')){
// 			echo md5($password);die;
			
			$username = $this->_getParam('username');
// 			print_r($username);die;
			$password = $this->_getParam('password');
			$user_model = new UserModel();
			$user_item = $user_model->getUserByUsername($username);
			if($user_item){
				if($user_item['password'] == md5($password)){
					session('user_id',$user_item['id']);
					$this->redirect('/admin/index');
				}
			}
		}
		$this->redirect('/admin/user/login');
	}
	
}
    

	
