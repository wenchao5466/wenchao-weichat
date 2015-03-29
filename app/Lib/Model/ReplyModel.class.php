<?php

/**
 * 文件名称: Reply.php
 * 摘    要: 关键词回复数据模型类
 *
 */
class ReplyModel extends CommonModel
{
	
	public function getList(){
		
		return $this->field('*')->select();
	}
	
	public function getByKeyword($keyword){
		$where['keyword'] = $keyword;
		return $this->where($where)->find();
	}
}
