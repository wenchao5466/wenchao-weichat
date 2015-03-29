<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>404...</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
          
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <!--[if lt IE 9]>
      <script src="/assets/js/vendor/html5shiv.js"></script>
      <script src="/assets/js/vendor/respond.min.js"></script>
    <![endif]-->
    <div class="container">
		<form class="form-signin" action="__URL__/checkLogin" method="post">
			<h2 class="form-signin-heading">此页面不存在</h2>
			<p class="detail"></p>
			<p class="jump">
			<a id="href" href="/activity/index"></a>
			<script type="text/javascript">
			/* (function(){
			var wait = document.getElementById('wait'),href = document.getElementById('href').href;
			var interval = setInterval(function(){
				location.href = href;
			}, 1000);
			})(); */
			</script>
		</form>
	</div>

   
    <script>
        var _ncf={"prd":"event","pstr":"","pfunc":null,"pcon":"","pck":{"whoid":"whoid"}};
		(function(p,h,s){var o=document.createElement(h);o.src=s;p.appendChild(o)})(document.getElementsByTagName("HEAD")[0],"script","http://zcs1.ncfstatic.com/js/ncfpb.1.1.min.js");
    </script>
  </body>
</html>