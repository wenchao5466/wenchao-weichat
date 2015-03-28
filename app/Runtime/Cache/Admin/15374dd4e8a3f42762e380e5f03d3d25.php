<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo ($title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">
    <!--[if lt IE 9]>
      <script src="/assets/js/vendor/html5shiv.js"></script>
      <script src="/assets/js/vendor/respond.min.js"></script>
    <![endif]-->
    <!-- <script src="/assets/js/togetherjs/libs/require.js?bust=1397656225625"></script> -->
    <script>
        
    </script>
    <script src="/assets/js/vendor/jquery-1.9.1.min.js"></script>
    <script src="/assets/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="/assets/js/vendor/jquery.validate.js"></script>
    <script src="/assets/js/vendor/jquery-form.js"></script>
  </head>
  <body>
    <header class="navbar navbar-inverse navbar-fixed-top wj-navbar" role="banner">
      <div class="container">
        <div class="navbar-header">
         <!-- <button class="navbar-toggle" id="logout-button"><a href="/Public/logout"><span class="glyphicon glyphicon-log-out"></span></a></button> -->
          <button class="navbar-toggle" id="logout-button" type="button"  data-target=".usercontent" ><span class="glyphicon glyphicon-user"></span></button>
          <!-- <button class="navbar-toggle email-help" id="help-button"><a class="glyphicon glyphicon-question-sign" data-toggle="modal" href="#helpModal"></a></button> -->
          <?php if(($user["is_admin"] == 1)): ?><button class="navbar-toggle" type="button" data-target="nav" data-height="103" >
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button><?php endif; ?>
          <!-- <button class="navbar-toggle" id="search-toggler" type="button" data-target=".search-container" data-height="58"><span class="glyphicon glyphicon-search"></span></button>
           -->
          <a href="/admin" class="navbar-brand logo-container">Event<span class="glyphicon glyphicon-home"></span></a>
          <!-- <div class="pull-left search-container navbar-togglable">
            <input id="site-search" type="search" class="form-control people-search" placeholder="搜索互联网金融集团的人">
            <input id="site-search-term-id" type="hidden" value="">
          </div> -->
          <!-- 手机 下拉 -->
 		   <div class="search-user navbar-togglable usercontent" style="display:none;">
	           	<ul class="nav">
	           		<li><a href="#">欢迎 <?php echo ($user_name); ?></a></li>
		           <li>
		             <a href="/admin/login/logout">退出</a>
		           </li> 
	         	</ul>
            </div>
            <!-- end 手机 下拉 -->
        </div>
        <div class="navbar-text pull-right mobile-pulldown">
          <!-- <?php if((!isset($menu_prv))): ?><a href="/User/changePassword" class="" style="margin-right:10px;margin-left:10px;"><b>修改密码</b></a>
        <?php else: ?>
          <a href="/User/profile" class="" style="margin-right:120px;"><b>返回个人主页</b></a><?php endif; ?> -->
          <?php if(($user_name)): ?><a href="#" class=""><b><?php echo ($user_name); ?></b></a>
							
             <a href="/admin/login/logout" class="">退出</a> 
          <?php else: ?>
            <a href="/admin/login" class="">登录</a><?php endif; ?>
          <!-- <a class="glyphicon glyphicon-question-sign email-help" style="font-size:17px;" data-toggle="modal" href="#helpModal"></a> -->
        </div>
      </div>
    </header>
    <div class="container" id="content" >
      <div class="row">
      <?php if(($user["is_admin"] == 1)): ?><div class="col-sm-3 tree-container" >
	<div id="container" role="main">
		<div id="tree" style=""></div>
		<div id="data">
			<div class="content code" style="display:none;"><textarea id="code" readonly="readonly"></textarea></div>
			<div class="content folder" style="display:none;"></div>
			<div class="content image" style="display:none; position:relative;"><img src="" alt="" style="display:block; position:absolute; left:50%; top:50%; padding:0; max-height:90%; max-width:90%;" /></div>
			<div class="content default" style="text-align:center;">Select a node from the tree.</div>
		</div>
	</div>
</div><?php endif; ?>
        <div class="col-sm-9" <?php if(($user["is_admin"] != 1)): ?>style="width:100%;"<?php endif; ?>>
          
<link rel="stylesheet" href="/assets/css/doc.css">
<script src="/assets/js/jstree.js"></script>
<script src="/assets/js/news.js"></script>
<style>
	.pagination {margin-left:15px;margin-bottom:0;}    
	#container { min-width:200px; margin:0px auto 0 auto; background:white; border-radius:0px; padding:0px; overflow:hidden; }
	#tree { margin-top:40px; min-width:200px;overflow:auto; padding:0px 0; border-right:1px solid #dddddd;}
	.jstree-contextmenu{z-index:10000;}
	.tree-container{padding-left: 8px;}
</style>

<div id="content-main" class="main">

	<div class="Right-body-left"><?php echo ($categoryName); ?></div>
	<div class="row" style="margin-top:20px;"> 
<!-- doc start -->

<div class="col-xs-8"> 
	<a href="/admin/activity" class="btn btn-primary btn-xs " action='remove'>返回首页</a> 
	<a class="user_manage" href="/admin/news/edit/categoryid/<?php echo ($category_id); ?>"><input type="button" class="btn btn-sm btn-success" value="增加新闻"></a>
	<a href="javascript:;" class="btn btn-primary btn-xs j_news_delete" action='remove'>删除新闻</a> 
	<span class="wrong_info red f12"></span> 
</div>
<!-- doc end-->

<div class="col-xs-4">
	<form method="get" class="pull-right form-inline" id="user_search_form">
		<div style="margin-right:5px" class="form-group">
				<input type="text" class="form-control input-sm" id="input-name" value="<?php echo ($keyword); ?>" name="keyword">
			</div>
			<div class="form-group">
				<input type="submit" value="查询" class="btn btn-success btn-sm" id="" name="search">
			</div>
		</form>
</div>
<ul class="pagination" style="margin-left:30px">
		<?php echo ($page); ?>
</ul>
</div>
<div class="form-group">
	<form action="" method="post" name="menu_form" >
		<input type="hidden" name="category_id" id="category_id" value="<?php echo ($category_id); ?>"/>
		<table class="table table-hover folder-list" style="margin-top:20px;margin-bottom: 0px;" id="user_table">
		<tr>
			<th class="col-sm-1" style="border-top: medium none;"><input type="checkbox" name="input_checkbox" id="checkAll"/></th>
			<th class="col-sm-2" style="border-top: medium none;" >标题</th>
			<th class="col-sm-1" style="border-top: medium none;" >创建者</th>
			<th class="col-sm-2" style="border-top: medium none;" >分类</th>
			<th class="col-sm-2" style="border-top: medium none;" >创建时间</th>
			<th class="col-sm-1" style="border-top: medium none;" >状态</th>
			<!-- <th class="col-sm-2" style="border-top: medium none;" >最后修改时间</th> -->
			<th class="col-sm-3" style="border-top: medium none;" >操作</th>
		</tr>
		<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
				<td class="col-sm-1">
					<input class="j_check" type="checkbox" name="input_checkbox[]" id="input_checkbox_<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>"/>
				</td>
				<td class="col-sm-2" ><a class="user_manage" href="/admin/news/edit/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
				<td class="col-sm-1" ><?php echo ($vo["name"]); ?></td>
				<td class="col-sm-2" ><?php echo ($vo["categoryName"]); ?></td>
				<td class="col-sm-2" ><?php echo (date('Y-m-d',$vo["create_date"])); ?></td>
				<td class="col-sm-1" ><?php if($vo["publish_type"] == 1): ?>草稿<?php else: ?>已发布<?php endif; ?></td>
				<!-- <td class="col-sm-2" ><?php echo (date('Y-m-d',$vo["update_date"])); ?></td> -->
				<td class="col-sm-3" >
					<a class="btn btn-default btn-xs" href="/admin/news/edit/id/<?php echo ($vo["id"]); ?>">修改</a>
					<a class="btn btn-default btn-xs" href="/admin/news/preview/id/<?php echo ($vo["id"]); ?>">预览</a><br>
					<?php if($vo["publish_type"] == 1): ?><a class="btn btn-default btn-xs" href="/admin/news/publish/id/<?php echo ($vo["id"]); ?>">发布</a>
					<?php else: ?>
						<a class="btn btn-default btn-xs" href="/admin/news/cancelPublish/id/<?php echo ($vo["id"]); ?>">取消发布</a><?php endif; ?>
					<?php if($vo["show_home_page"] == 2): ?><a class="btn btn-default btn-xs" href="/admin/news/setshow/category_id/<?php echo ($category_id); ?>/status/1/id/<?php echo ($vo["id"]); ?>">取消首页显示</a>
					<?php else: ?>
						<a class="btn btn-default btn-xs" href="/admin/news/setshow/category_id/<?php echo ($category_id); ?>/status/2/id/<?php echo ($vo["id"]); ?>">设置首页显示</a><?php endif; ?>
					
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		</form>
	</div>
	<ul class="pagination">
		<?php echo ($page); ?>
	</ul>
	
</div>

<!-- 管理分类弹窗 start-->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="post">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">管理分类</h4>
				</div>
				<div class="modal-body">
					<div class="t_window">
						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="add_group_button">确定</button>
					<!-- <button type="button" class="btn btn-primary" data-dismiss="modal" id="cancel">取消</button> -->
				</div>
			</div>
		</div>
	</form>
</div>
<!-- 管理分组弹窗 start-->

<!-- 修改分类弹窗 start-->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="post" id="user_form">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="user_title">创建新用户</h4>
				</div>
				<div class="modal-body">
					<div class="t_window">
						<div class="hei50">
							<h3>姓名：</h3>
							<div class="y_ren padd0">
								<input class="form-control" type="text" name='user_name' id="user_name"  placeholder="请输入姓名"/>
								<input class="form-control" type="hidden" name='user_id' id="user_id"  />
							</div>
						</div>
						<div class="hei50">
							<h3>Email：</h3>
							<div class="y_ren padd0">
								<input class="form-control" type="text" name='user_email' id="user_email"  placeholder="请输入Email">
							</div>
						</div>
						<div class="hei50">
							<h3>权限：</h3>
							<div class="y_ren padd0">
								<input type="radio" name="is_admin" value="admin" id="authority_admin"/>管理员
								<input type="radio" name="is_admin" value="general" id="authority_general"/>普通用户
							</div>
						</div>
						<!-- <div class="hei50" id="group_div" style="display:none;">
							<h3>所属分组：</h3>
							<div class="y_ren padd0">
							<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><input type="checkbox" name="group[]" value="<?php echo ($group["id"]); ?>" id="group<?php echo ($group["id"]); ?>"/><?php echo ($group["name"]); endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div> -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data- dismiss="modal" id="add_user_btn">添加</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- 修改分类弹窗 end --> 

<script type="text/javascript" src="/assets/js/jquery.contextmenu.r2.packed.js"></script> 

        </div>
      </div>
    </div>
   
    <script src="/assets/js/vendor/bootstrap.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/common.js"></script>
    <div id="conversejs"></div>
    <script>
        var _ncf={"prd":"event","pstr":"","pfunc":null,"pcon":"","pck":{"whoid":"whoid"}};
		(function(p,h,s){var o=document.createElement(h);o.src=s;p.appendChild(o)})(document.getElementsByTagName("HEAD")[0],"script","http://zcs1.ncfstatic.com/js/ncfpb.1.1.min.js");
    </script>
  </body>
</html>