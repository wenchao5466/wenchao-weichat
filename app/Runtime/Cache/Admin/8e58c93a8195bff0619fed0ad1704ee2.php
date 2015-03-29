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
	          <button class="navbar-toggle" type="button" data-target="nav" data-height="103" >
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
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
      <if>
        
          <div class="col-sm-3">
            <nav class="clearfix navbar-togglable" role="navigation">
			<ul class="nav">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(($nav_id == $i)): ?>class="active"<?php endif; ?> ><a href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				
                </ul>
            </nav>
          </div>
        
        </if>
        <div class="col-sm-9" >
          
<link rel="stylesheet" href="/assets/css/doc.css">
<script src="/assets/js/category.js"></script>
<style>
	.pagination {margin-left:15px;margin-bottom:0;}    
</style>
<div id="content-main" class="main">
	<div class="Right-body-left"><?php echo ($now_title); ?></div>
	<div class="row" style="margin-top:20px;"> 
<!-- doc start -->
<div class="col-xs-6"> 
	<a href="/admin/index/edit" class="btn btn-primary btn-xs " action='remove'>新增</a>
	<span class="wrong_info red f12"></span> 
</div>
<!-- doc end-->

<ul class="pagination" style="margin-left:30px">
		<?php echo ($page); ?>
</ul>
</div>
<div class="form-group"  class="col-xs-6">
	<form action="/quarter/save" method="post" name="menu_form" >
		<table class="table table-hover folder-list" style="margin-top:20px;margin-bottom: 0px;" id="category_table">
		<tr>
			<th class="col-sm-5" style="border-top: medium none;" >关键词</th>
			<th class="col-sm-2" style="border-top: medium none;" >回复内容</th>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td class="col-sm-2" style="width:10%"><?php echo ($vo["keyword"]); ?></td>
				<td class="col-sm-2" style="width:10%"><?php echo ($vo["message"]); ?></td>
				<td class="col-sm-2" style="width:20%"><a class="category_manage" href="/admin/index/edit/id/<?php echo ($vo["id"]); ?>" >修改</a></td>
				<td class="col-sm-2" style="width:20%"><a class="category_manage" href="/admin/index/delete/id/<?php echo ($vo["id"]); ?>" >删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		</form>
	</div>
	<ul class="pagination">
		<?php echo ($page); ?>
	</ul>
</div>

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