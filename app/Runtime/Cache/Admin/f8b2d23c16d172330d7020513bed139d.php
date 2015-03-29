<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo ($data['title']); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
          
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/login.css">
	<div class="container">
      <div class="container">

      <form role="form" class="form-signin" method="post" action="/admin/user/checkUser">
        <h2>微信后台</h2>
        <input type="text" name="username" autofocus="" required="" placeholder="用户名" class="form-control">
        <input type="password" name="password"  required="" placeholder="密码" class="form-control">
        <label class="checkbox">
        </label>
        <button type="submit" class="btn btn-lg btn-primary btn-block">登录</button>
      </form>
      <footer></footer>

    </div>

    </div>

   
    <script>
        var _ncf={"prd":"event","pstr":"","pfunc":null,"pcon":"","pck":{"whoid":"whoid"}};
		(function(p,h,s){var o=document.createElement(h);o.src=s;p.appendChild(o)})(document.getElementsByTagName("HEAD")[0],"script","http://zcs1.ncfstatic.com/js/ncfpb.1.1.min.js");
    </script>
  </body>
</html>