<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>成功了...</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
          
<link rel="stylesheet" href="/assets/css/error.css">
<div class="container-error" style="margin: 97px auto 0px;">
	<div class="contentHeader"></div>
	<!-- start: contentMiddle -->
	<div class="contentMiddle clear">
		<!-- start: leftContent -->
		<!-- <div class="leftContent">
			<div class="smiley"></div>
		</div> -->
		<!-- end: leftContent -->
		<!-- start: contentMiddle -->
		<div class="rightContent">
			<div class="mark-header"></div>
			<h1>成功了...</h1>
			<form class="form-signin" action="__URL__/checkLogin" method="post" >
				<h2 class="form-signin-heading">
				<?php if(isset($message)): ?><p class="success"><?php echo($message); ?></p>
				<?php else: ?>
				<p class="error"><?php echo($error); ?></p><?php endif; ?>
				</h2>
				<p class="detail"></p>
				<p class="jump">
				<a id="href" href="<?php echo($jumpUrl); ?>"></a>
				<script type="text/javascript">
				(function(){
				var wait = document.getElementById('wait'),href = document.getElementById('href').href;
				var interval = setInterval(function(){
					location.href = href;
				}, 1000);
				})(); 
				</script>
		 	</form>
		 	<div class="mark-footer"></div>
		</div>
		<!-- end: contentMiddle -->
	</div>
	<!-- end: contentMiddle -->
	<div class="contentFooter"></div>
	<!-- start: footerMenu -->
	<!-- <div class="footerMenu">
		<ul>
			<li><a href="#">Home</a></li><li>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</li>
			<li><a href="#">About</a></li><li>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</li>
			<li><a href="#">Products</a></li><li>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</li>
			<li><a href="#">Contact</a></li><li>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</li>
			<li><a href="#">Support</a></li>
		</ul>
	</div> -->
	<!-- end: footerMenu -->
</div>

   
    <script>
        var _ncf={"prd":"event","pstr":"","pfunc":null,"pcon":"","pck":{"whoid":"whoid"}};
		(function(p,h,s){var o=document.createElement(h);o.src=s;p.appendChild(o)})(document.getElementsByTagName("HEAD")[0],"script","http://zcs1.ncfstatic.com/js/ncfpb.1.1.min.js");
    </script>
  </body>
</html>