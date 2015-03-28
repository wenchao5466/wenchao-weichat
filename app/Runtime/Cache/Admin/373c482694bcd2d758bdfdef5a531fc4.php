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
      <?php if(($user["is_admin"] == 1)): endif; ?>
        <div class="col-sm-9" <?php if(($user["is_admin"] != 1)): ?>style="width:100%;"<?php endif; ?>>
          
	<link rel="stylesheet" href="/assets/css/doc.css">
	<style>
	  .togetherjs-focus {border:0;}
	  .btn-primary {}
	   body {overflow-x:hidden;}
	  .navbar-fixed-top, .navbar-fixed-bottom {position:static;}
	  #content{margin-top:5px;}
	</style>
	<script type="text/javascript" charset="utf-8" src="/assets/js/ueditor-v2/ueditor.config.js"></script> 
	<script charset="utf-8"  src="/assets/js/ueditor-v2/ueditor.all.js"></script> 
	<script charset="utf-8"  src="/assets/js/ueditor-v2/lang/zh-cn/zh-cn.js"></script> 
	<!-- <script src="/assets/js/togetherjs/togetherjs.js"></script>  -->
	<script src="/assets/js/news_info.js" /> </script>
	<div id="content-main" class="main clearfix">
	<form method="post" class="form-inline" id="doc_form" action='/admin/news/edit/id/<?php echo ($news["id"]); ?>' enctype="multipart/form-data" >
		<input type="hidden" name="user_id" value="<?php echo ($user_id); ?>"/>
		<input type="hidden" name="saveDoc" value="1"/>
		<input type="hidden" name="news_id" id="news_id" value="<?php if($news): echo ($news["id"]); else: ?>0<?php endif; ?>"/>
		<input type="hidden" name="parent_id" id="parent_id" value="<?php echo ($parent_id); ?>"/>
		<input type="hidden" name="edit_status" id="edit_status" value="edit"/>
		<div class="version">
			<h3 style="display:;">分类:</h3>
			<?php echo ($select_html); ?>
			<?php if(($news["publish_type"] == 2)): ?><div id='publish_url' style="clear:both;padding-top:15px; display:block;"> 
				发布链接为：<a class="doc_url" href="<?php echo ($publish_url); ?>" target="_blank"><?php echo ($publish_url); ?></a>
				</div>
			<?php else: ?>
				<div id='publish_url' style="clear:both;padding-top:15px; display:block;"></div><?php endif; ?>
		</div>
		<div class="row" style="position:relative;clear:both;">
		<div class="form-group text-input">
			<label for="title">标题：</label>
			<input type="text" class="form-control input-sm" id="title" placeholder="请输入标题" value="<?php echo ($news["title"]); ?>" name="title" maxlength="50" required="">
		</div>
		<div class="bt-group"> <span style="color:red;font-size:12px;" ></span> 
		<input type="submit" value='保存' class="btn btn-primary" /><!-- <a id="doc_save"  class="btn btn-primary"> 保存</a> --> 
		<a href="/admin/news/index/" class="btn btn-primary " style="">返回列表</a>
		<?php if(($news)): ?><a class="btn btn-primary" target="_blank" href="/admin/news/preview/id/<?php echo ($news["id"]); ?>" id="pre view">预览</a> 
			<?php if(($news["publish_type"] != 2)): ?><a class="btn btn-primary "  href="javascript:void(0);" id="release" data-toggle="modal" data-target="#pModal">发布</a> 
				<a class="btn btn-primary " style="display:none;" href="javascript:;" id="cancle_publish" >取消发布</a>
			<?php else: ?>
				<a class="btn btn-primary " style="display:none;" href="javascript:;" id="release" data-toggle="modal" data-target="#pModal">发布</a> 
				<a class="btn btn-primary "  href="javascript:;" id="cancle_publish" >取消发布</a><?php endif; endif; ?> 
		<span class="red f12"></span></div>
	</div>
	<div class="col-xs-6" style="margin-bottom:15px;clear:both;width:100%;margin-top:20px;" id="list" style="display:none;">
	<textarea class="ckeditor" name="editor"  id="editor" style="min-height:350px;width:100%;" maxlength="1000"><?php echo ($news["content"]); ?></textarea>
	</div>
	<div class="form-group text-input" style="margin-left:15px;">
		<label for="abstract">摘要：</label>
		<textarea name="abstract"  id="abstract" style="margin-top: 10px;" class="form-control input-sm" placeholder="请输入摘要" maxlength="200" required=""><?php echo ($news["alias"]); ?></textarea>
		<label for="video_url">视频地址：</label>
		<input type="text" class="form-control input-sm" id="video_url" placeholder="请输入视频地址" value="<?php echo ($news["video_url"]); ?>" name="video_url" style="margin-top: 10px;" >
		<label for="cover">上传封面：</label>
		<input type="file" class="form-control input-sm" id="cover" name="cover" style="width:275px;margin-top: 10px;" <?php if(!isset($news['img_url'])): endif; ?>>
		<input type="hidden"  name="cover" <?php if(isset($news['img_url'])): ?>value="<?php echo ($news["img_url"]); ?>"<?php endif; ?>>
		<?php if(isset($news['img_url'])): ?><div class="col-xs-6" style="margin-bottom:10px;clear:both;width:100%;margin-top:10px;" id="list" >
	        	<div>
	      			<img id="show_image"  required="" class="img-thumbnail" <?php if(isset($news['img_url'])): ?>src="<?php echo ($news["img_url"]); ?>"<?php endif; ?>>
	        	</div>
			</div><?php endif; ?>
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
								<?php echo ($publish_url); ?>
							</div>
							<input type="hidden" name='news_id'  value="<?php echo ($news["id"]); ?>"/>
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