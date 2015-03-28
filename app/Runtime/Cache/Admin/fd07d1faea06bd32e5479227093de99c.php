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
      <?php if(($user["is_admin"] == 1)): ?><div class="col-sm-3">
            <nav class="clearfix navbar-togglable" role="navigation">
			<ul class="nav">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(($nav_id == $i)): ?>class="active"<?php endif; ?> ><a href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				
	                <?php if(is_array($admin_nav_list)): $i = 0; $__LIST__ = $admin_nav_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(($admin_id == $i)): ?>class="active"<?php endif; ?>><a href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				
                </ul>
            </nav>
          </div><?php endif; ?>
        <div class="col-sm-9" <?php if(($user["is_admin"] != 1)): ?>style="width:100%;"<?php endif; ?>>
          
<link rel="stylesheet" href="/assets/css/doc.css">
<script src="/assets/js/user.js"></script>
<style>
	.pagination {margin-left:15px;margin-bottom:0;}    
</style>

<div id="content-main" class="main">
	<div class="Right-body-left"><?php echo ($now_title); ?></div>
	<div class="row" style="margin-top:20px;"> 
<!-- doc start -->
<div class="col-xs-8"> 
	<!-- <a class="" href="javascript:;" id="add_group" data-toggle="modal" data-target="#groupModal" ><input type="button" class="btn btn-sm btn-success" value="管理分组"></a> -->
	<a class="user_manage" href="javascript:;" data-toggle="modal" data-target="#helpModal" user_id='' user_name='' is_admin='' email='' group=''><input type="button" class="btn btn-sm btn-success" value="新增用户"></a>
	<a href="javascript:;" class="btn btn-primary btn-xs j_docs_delete" action='remove'>删除用户</a> 
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
		<table class="table table-hover folder-list" style="margin-top:20px;margin-bottom: 0px;" id="user_table">
		<tr>
			<th class="col-sm-1" style="border-top: medium none;"><input type="checkbox" name="input_checkbox" id="checkAll"/></th>
			<th class="col-sm-3" style="border-top: medium none;" >姓名</th>
			<!-- <th class="col-sm-2" style="border-top: medium none;" >所属分组</th> -->
			<th class="col-sm-2" style="border-top: medium none;" >邮箱</th>
			<th class="col-sm-2" style="border-top: medium none;" >权限</th>
			<th class="col-sm-2" style="border-top: medium none;" >操作</th>
		</tr>
		<?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td class="col-sm-1" style="width:5%">
					<input class="j_check" type="checkbox" name="input_checkbox[]" id="input_checkbox_<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>"/>
				</td>
				<td class="col-sm-3" style="width:20%"><?php echo ($vo["name"]); ?></td>
				<!-- <td class="col-sm-2" style="width:20%"><?php echo ($vo["group_name"]); ?></td> -->
				<td class="col-sm-2" style="width:10%"><?php echo ($vo["email"]); ?></td>
				<td class="col-sm-2" style="width:20%"><?php if(($vo["is_admin"] == 1)): ?>管理员<?php else: ?>普通用户<?php endif; ?></td>
				<td class="col-sm-2" style="width:20%"><a class="user_manage" href="javascript:;" data-toggle="modal" data-target="#helpModal" user_id='<?php echo ($vo["id"]); ?>' user_name='<?php echo ($vo["name"]); ?>' group='<?php echo ($vo["group"]); ?>' is_admin='<?php echo ($vo["is_admin"]); ?>' email='<?php echo ($vo["email"]); ?>'>修改</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		</form>
	</div>
	<ul class="pagination">
		<?php echo ($page); ?>
	</ul>
</div>

<!-- 管理分组弹窗 start-->
<div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="post">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">管理分组</h4>
				</div>
				<div class="modal-body">
					<div class="t_window">
						<h3  class="add-h3">现有文档分类</h3>
						<div class="dev-list  edit_list"  id="group_list"> 
							<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><div class="yd_pop" id="div<?php echo ($group["id"]); ?>">
								<h2 id="ulh2<?php echo ($group["id"]); ?>">
									<label class="edit_label"><?php echo ($group["name"]); ?></label>
									<input class="edit_input" id="<?php echo ($group["id"]); ?>" type="text" value="宋文超" style="display:none">
									<a href="javascript:del(<?php echo ($group["id"]); ?>);" class="j_del_classify">删除</a>
								</h2>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							<!-- 收缩展开效果 --> 
						</div>
				<h3 class="add-h3">添加分组名称</h3>
				<input class="form-control" type="text" maxlength="10" name="group_name" id="group_name" placeholder="输入分组名称">
				<input type="button" value="添加" class="btn btn-primary" id="j_add_group" style="margin-top:10px;">
					</div>
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