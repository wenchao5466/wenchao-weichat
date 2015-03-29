<?php


class IndexAction extends AdminBaseAction {
	
	
	public function index(){
		$repay_model = new ReplyModel();
		$repay_list = $repay_model->getList();
// 		print_r($repay_list);die;
		$this->_view('reply_list',array('list'=>$repay_list,'title'=>'自动回复列表'));
	}
	public function edit(){
		$id = $this->_getParam('id');
		if($id!=0){
			$repay_model = new ReplyModel();
			$repay_item = $repay_model->getById($id);
		}else{
			$repay_item = array('keyword'=>'','message'=>'','id'=>0);
		}
		
		
		$this->_view('reply_edit',array('repay_item'=>$repay_item,'title'=>'编辑'));
	}
	
	public function delete(){
		$id = $this->_getParam('id');
		$reply_model = new ReplyModel();
		$item = $reply_model->getById($id);
		if($item){
			$result = $reply_model->deleteInfo($id);
			if($result){
				$this->success('删除成功','/admin/index');
			}else{
				
				$this->error('删除失败','/admin/index');
			}
		}else{
			$this->error('记录不存在','/admin/index');
		}
	}
	
	public function saveItem(){
		$id = $this->_getParam('id');
		$data['keyword'] = $this->_getParam('keyword');
		$data['message'] = $this->_getParam('message');
		$repay_model = new ReplyModel();
		if(!$id){
			$result = $repay_model->addInfo($data);
			if($result){
				$this->success('增加成功','/admin/index');
			}else{
				
				$this->error('增加失败','/admin/index');
			}
		}else{
			$result = $repay_model->updateInfo($id,$data);
			if($result){
				$this->success('更新成功','/admin/index');
			}else{
				
				$this->error('更新失败','/admin/index');
			}
		}
		
	}
}
    

	
