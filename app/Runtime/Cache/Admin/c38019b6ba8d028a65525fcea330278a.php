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
	<style>
	  .togetherjs-focus {border:0;}
	  .btn-primary {}
	   body {overflow-x:hidden;}
	  .navbar-fixed-top, .navbar-fixed-bottom {position:static;}
	  #content{margin-top:5px;}
	  .progress{height: 0px;}
	  .upfile_word{display:none;}
	</style>
	<script type="text/javascript" charset="utf-8" src="/assets/js/ueditor-v2/ueditor.config.js"></script> 
	<script charset="utf-8"  src="/assets/js/ueditor-v2/ueditor.all.js"></script> 
	<script charset="utf-8"  src="/assets/js/ueditor-v2/lang/zh-cn/zh-cn.js"></script> 
    <script src="/assets/js/upload.v1.js" type="text/javascript"></script>
	<!-- <script src="/assets/js/togetherjs/togetherjs.js"></script>  -->
	<script src="/assets/js/doc.js?v=1" /> </script>
	<div id="content-main" class="main clearfix">
	<form method="post" class="form-inline" id="doc_form" action='/admin/activity/edit/id/<?php echo ($doc["id"]); ?>'>
		<input type="hidden" name="user_id" value="<?php echo ($user["id"]); ?>"/>
		<input type="hidden" name="saveDoc" value="1"/>
		<input type="hidden" name="doc_id" id="doc_id" value="<?php if($doc): echo ($doc["id"]); else: ?>0<?php endif; ?>"/>
		<input type="hidden" name="parent_id" id="parent_id" value="<?php echo ($parent_id); ?>"/>
		<input type="hidden" name="edit_status" id="edit_status" value="edit"/>
		<div class="version">
			<h3 style="display:none;">选择分类:</h3>
			<div class="mulDom" id="mullist" style="display:none;">
			<select class="select" name="category_id" id="category_id">
				<!-- <option value=''>请选择分类</option> -->
				<?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><option value='<?php echo ($category["id"]); ?>' <?php if(($category["id"] == $category_id)): ?>selected<?php endif; ?>><?php echo ($category["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			</div>
			<!-- <h3>历史版本回顾:</h3>
			<select id="select">
				<option>请选择历史版本</option>
			</select> -->
			<?php if(($doc["publish_type"] == 2)): ?><div id='publish_url' style="clear:both;padding-top:15px; display:block;"> 
				发布链接为：<a class="doc_url" href="<?php echo ($publish_url); ?>" target="_blank"><?php echo ($publish_url); ?></a>
				<?php if(($doc["alias"] != '')): ?><br>或者为：<a class="doc_url" href="<?php echo ($site_url); ?>/<?php echo ($activity_url); ?>/<?php echo ($doc["alias"]); ?>" target="_blank"><?php echo ($site_url); ?>/<?php echo ($activity_url); ?>/<?php echo ($doc["alias"]); ?></a><?php endif; ?>
				</div>
			<?php else: ?>
				<div id='publish_url' style="clear:both;padding-top:15px; display:block;"></div><?php endif; ?>
		</div>
		<div class="row" style="position:relative;clear:both;">
			<div class="form-group text-input">
				标题：
				<input type="text" class="form-control input-sm" id="doc_name" placeholder="请输入活动标题" value="<?php echo ($doc["name"]); echo ($parent_id); ?>" name="doc_name"><br>
				别名：
				<input type="text" style="" class="form-control input-sm" id="alias" placeholder="别名" value="<?php echo ($doc["alias"]); ?>" name="alias"><br>
			</div>
			<div class="bt-group"> <span style="color:red;font-size:12px;" ></span> 
			<input type="submit" value='保存' class="btn btn-primary" /><!-- <a id="doc_save"  class="btn btn-primary"> 保存</a> --> 
			<a href="/admin/activity/index/" class="btn btn-primary " style="">返回列表</a>
			<?php if(($doc)): ?><a class="btn btn-primary" activity_id="<?php echo ($doc["id"]); ?>" href="javascript:;" id="preview">预览</a> 
				<?php if(($doc["publish_type"] != 2)): ?><a class="btn btn-primary "  href="javascript:void(0);" id="release" data-toggle="modal" data-target="#pModal">发布</a> 
					<a class="btn btn-primary " style="display:none;" href="javascript:;" id="cancle_publish" >取消发布</a>
				<?php else: ?>
					<a class="btn btn-primary " style="display:none;" href="javascript:;" id="release" data-toggle="modal" data-target="#pModal">发布</a> 
					<a class="btn btn-primary "  href="javascript:;" id="cancle_publish" >取消发布</a><?php endif; endif; ?> 
			<a class="btn btn-primary"  href="javascript:void(0);" id="help" data-toggle="modal" data-target="#helpModal">使用说明</a>
			<span class="red f12"></span></div>
		</div>
		
		<div class="col-xs-6">
			微信分享标题：
			<input type="text" style="" class="form-control input-sm" id="weixintitle" placeholder="分享标题" value="<?php echo ($doc["weixintitle"]); ?>" name="weixintitle"><br>
			微信分享图片：
			<div id="content_h5"></div>
			<div id="myimg_h5">
				<?php if($doc["weixinimg"] != ''): ?><img src="<?php echo ($doc["weixinimg"]); ?>" width="100px;" height="100px"><?php endif; ?>
			</div>
				<input type="hidden" id="weixinimg" value="<?php echo ($doc["weixinimg"]); ?>" name="weixinimg">
            
			微信分享图片内容：
			<textarea class="cked itor" name="weixindes"  id="weixindes" style="min-height:50px;width:100%;"><?php echo ($doc["weixindes"]); ?></textarea>
		</div>
		<div class="col-xs-6" style="margin-bottom:15px;clear:both;width:100%;margin-top:20px;" id="list" style="display:none;">
		<div>
			<textarea class="ckeditor" name="editor"  id="editor" style="min-height:350px;width:100%;"><?php echo ($doc["content"]); ?></textarea>
		</div>
		</div>
	</form>
	</div>
	
	<!--发布弹窗 start-->
	<div class="modal fade" id="pModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form>
			<div class="modal-dialog w400">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">发布</h4>
					</div>
					<div class="modal-body">
						<div class="t_window">
							<div class="d_url"> 发布链接为：
								<?php echo ($site_url); ?>/<?php echo ($activity_url); ?>/<?php echo ($doc["id"]); ?>
								<?php if(($doc["alias"] != '')): ?><br>或者为：<?php echo ($site_url); ?>/<?php echo ($activity_url); ?>/<?php echo ($doc["alias"]); endif; ?>
							</div>
							<input type="hidden" name='doc_id'  value="<?php echo ($doc["id"]); ?>"/>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="p_button">发布</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!--发布弹窗 end--> 
	
	
	
	<!--模板使用说明 start-->
	<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form>
			<div class="modal-dialog w400">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">模板使用说明</h4>
					</div>
					<div class="modal-body">
						<div class="t_window">
							<div class="d_url">
								1.需要在用户登录之后显示的内容写在&lt;user_login_show&gt;&lt;/user_login_show&gt;标记中。<br/>
								2.需要在用户登录之后隐藏的内容写在&lt;user_login_hide&gt;&lt;/user_login_hide&gt;标记中。<br/>
								3.当用户登陆之后显示用户登录名字用此标签标记{{username}}<br/>
								例如:&lt;user_login_show&gt; &lt;h3&gt;欢迎{{username}}登陆&lt;/h3&gt; &lt;/user_login_show&gt; <br/><br/>
								用户没有登陆之前这段代码是隐藏的<br/>
								当某用户登陆之后就是这样显示出来的:<br/><h3>欢迎张三登陆</h3>
							</div>
							<input type="hidden" name='doc_id'  value="<?php echo ($doc["id"]); ?>"/>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="p_close">关闭</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!--模板使用说明 end--> 
	
	

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