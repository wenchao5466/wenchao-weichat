<?php
/**
 * 素材管理
 *
 * @author Song Wenchao <songwenchao@ucfgroup.com>
 *
 */
class RepayController extends AdminController
{
	public $nav_id=1;
	public $sub_nav_id = 4;
	public $pageTitle  = '素材管理'; //页面标题
        
	/**
	 * Index action is the default action in a controller.
	 */
	public function index()
	{
		$repay_model = new ReplyModel();
		$repay_list = $repay_model->getList();
		print_r($repay_list);die;
		$this->_view('repay_list',array('list'=>$repay_list,'title'=>'自动回复列表'));
	}
	
	public function actionAdd()
	{
		$type=$this->_getParam('type');
		switch($type)
		{
			case "simple":
				$this->_view('resource_simple',array('page_title'=>'新增单图文消息'));
				break;
			case "many":
				$list1=Resource::model()->getByType(1);
				
				$this->_view('resource_many',array('list1'=>$list1,'page_title'=>'新增多图文消息'));
				break;
			default:
				break;				
		}		
	}
	
	public function actionEdit()
	{
		$id=$this->_getParam('id');
		$m=Resource::model()->getById($id);
		if($m)
		{	
			
			switch($m->type)
			{
				case '1'://单图文
					$model=$m->getAttributes();
					$s=json_decode($m->body,true);
					// var_dump($s);exit;
					$model['name']=$model['title'];
					$data=array_merge($model,$s['Articles']['item']);			
					$this->_view('resource_simple',array('model'=>$data,'page_title'=>'修改单图文消息'));
					break;
				case '2'://多图文
					
					$list1=Resource::model()->getByType(1);
					$cids=json_decode($m->content);
					
					foreach($cids as $row)
					{
						$list2[]=Resource::model()->getById($row);
					}
					$this->_view('resource_many',array('model'=>$m,'list1'=>$list1,'list2'=>$list2,'page_title'=>'修改多图文消息'));
					break;
				default:
					break;	
			}
		}
		else
		{
			$this->_redirectMessage('素材没有找到','error');			
		}
	}
	
	public function actionDel()
	{
		
		$id=$this->_getParam('id');
		$m=Resource::model()->deleteById($id);
		if($m)
		{
			$this->_redirectMessage('删除成功','success');	
			
		}
		else
		{
			$this->_redirectMessage('素材没有找到','error');			
		}
	}
	
	public function actionSaveSimple()
	{
		$body=array('Articles'=>
					array('item'=>
						array(
						'Title'=>$this->_getParam('title'),
						'Description'=>$this->_getParam('info'),
						'PicUrl'=>$this->_getParam('picurl'),
						'Url'=>$this->_getParam('url'),
						))
					);
		// $body='<Articles><item><Title><![CDATA['.$this->_getParam('title').']]></Title><Description><![CDATA['.$this->_getParam('info').']]></Description><PicUrl><![CDATA['.$this->_getParam('picurl').']]></PicUrl><Url><![CDATA['.$this->_getParam('url').']]></Url></item></Articles>';
		$id=$this->_getParam('id');
		$info = array(
				'user_id'=>9,
				'title'=>$this->_getParam('name'),
				'type'=>$this->_getParam('type'),
				'body'=>json_encode($body),
				'content'=>$this->_getParam('content'),
				'update_time'=>time(),
		);
		if(!empty($id))
		{
// 			$info=Resource::model()->getById($id);	
			if (empty($info)){
				$this->_redirectMessage('信息错误','error',array('/resource'));
			}
			$res = Resource::model()->updateById($id,$info);
		}
		else
		{
			$info['create_time'] = time();
			$model= Resource::model();	
			$res = $model->addInfo($info);	
		}
		
		if($res[0] >= 0)
		{
			$this->_redirectMessage('保存成功','success',array('/resource'));
		}
		else
		{
			$this->_redirectMessage(array('保存失败',$res[1]),'error');
		}
		
	}
	public function actionSaveMany()
	{
		$cids=$this->_getParam('cids');
		if(empty($cids))
		{
			$this->_redirectMessage('图文列表为空','error');
		}
		$body=array('ArticleCount'=>count($cids),'Articles'=>array());
		foreach($cids as $id)
		{
			$model = Resource::model();
			$row=$model->getByTypeAndId(1,$id);
			if($row)
			{
				$content=json_decode($row->body,true);
				$body['Articles'][]=$content['Articles']['item'];				
			}else
			{
				$this->_redirectMessage('图文不存在#'.$id.'#','error');
			}
		}
		// $body.='</Articles>';
		$id=$this->_getParam('id');
		$info = array(
				'user_id'=>9,
				'title'=>$this->_getParam('name'),
				'type'=>2,
				'body'=>json_encode($body),
				'content'=>json_encode($cids),
		);
		if(!empty($id))
		{
			$getOne = Resource::model()->getById($id);
			if (empty($getOne)){
				$this->_redirectMessage('信息错误','error',array('/resource'));
			}
			$res = Resource::model()->updateById($id, $info);
		}
		else
		{
			$res = Resource::model()->addInfo($info);		
		}
		
// 		print_r($res);die;
		if($res[0] >= 0)
		{
			$this->_redirectMessage('保存成功','success',array('/resource'));
		}
		else
		{
			$this->_redirectMessage(array('保存失败',$res[1]),'error');
		}
		
	}
}