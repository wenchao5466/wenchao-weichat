<?php
class CommonModel extends Model {

	// 获取当前用户的ID
    public function getMemberId() {
        return isset($_SESSION[C('USER_AUTH_KEY')])?$_SESSION[C('USER_AUTH_KEY')]:0;
    }

    
    /**
     * 
     * 通过ID获取单条记录
     * @param int $id
     * @return 返回查询结果
     */
    public function getById($id){
    	if (!is_numeric($id)) {
    		return false;
    	} else {
    		return $this->where(array('id'=>$id))->find();
    	}
    }
    
    
    /**
    *
    * 增加一条记录
    * @param array $info
    * @return 返回查询结果
    */
    public function addInfo($info) {
    	if(!$this->create($info)){
//     		print_r($this->getError());
    		return array('result'=>'0','msg'=>$this->getError());
    	}else{
    		$result = $this->add($info);
    		return array('result'=>'ok','id'=>$result);
    	}	
    }
    /**
    *
    * 更新主键更新数据
    * @param int $id
    * @param array $info
    * @return 返回查询结果
    */
    
    public function updateInfo($id,$info){
    	$model = $this->getById($id);
    	
    	if(!$model){
    		return array('result'=>'0','msg'=>'记录不存在');
    	}else{
//     		print_r($this->create($info));die;
//     		print_r($this->create($info));
//     		die;
    		if($this->create($info)){
	    		$result = $this->where(array('id'=>$id))->save($info);
	    		if($result){
	    			return array('result'=>'ok');
	    		}else{
	    			return array('result'=>'0','msg'=>'未知错误，请重试');
	    		}
    		}else{
    			return array('result'=>'0','msg'=>$this->getError());
    		}
    	}
    }
    
    
    public function deleteInfo($id){
    	$model = $this->getById($id);
    	if(!$model){
    		return array('result'=>'0','msg'=>'记录不存在');
    	}else{
    		$this->where(array('id'=>$id))->delete();
    		return array('result'=>'1','msg'=>'删除成功');
    	}
    }
    /* 
    if ($list=$faultedit->create()) {
    	$editid=$list['id'];
    	unset($list['id']);
    	if ($faultedit->where("id={$editid}")->save($list)){
    		$this->assign("jumpUrl",U('/Admin/Fault/index'));
    		$this->success('修改成功');
    	}else {
    		$this->error('修改失败');
    	}
    } */
   /**
     +----------------------------------------------------------
     * 根据条件禁用表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function forbid($options,$field='status'){

        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

	 /**
     +----------------------------------------------------------
     * 根据条件批准表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */

    public function checkPass($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }


    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function resume($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function recycle($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    public function recommend($options,$field='is_recommend'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    public function unrecommend($options,$field='is_recommend'){
        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }
}
?>