<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($activity['name']); ?></title>
<script src='<?php echo ($static_url); ?>assets/js/jquery-1.10.2.min.js'></script>	
<script src='<?php echo ($static_url); ?>assets/js/html.js'></script>

<script>
var ajax_url = '<?php echo ($check_user_status_url); ?>';

</script>

<!-- 活动专题内容 -->
    <?php echo ($activity['content']); ?>
    
<!-- 活动专题内容 -->

<script>
<?php if(($activity['weixintitle'] != '' AND $activity['weixinimg'] != '' AND $activity['weixindes'] != '')): ?>//微信分享功能
function _bindWeiXinDetail(img_url, link, title, desc){
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		var shareInfo = {"img_url":img_url,"link":link,"title":title,"desc":desc};
		WeixinJSBridge.on('menu:share:appmessage', function(argv) {
			WeixinJSBridge.invoke('sendAppMessage', shareInfo, function(res) {});
		});
		WeixinJSBridge.on('menu:share:timeline', function(argv) {
			WeixinJSBridge.invoke('shareTimeline', shareInfo, function(res) {});
		});
	}, false);
};

var _weixinsharedata = <?php echo ($activity_jsonstr); ?>;
_bindWeiXinDetail(_weixinsharedata.weixinimg, '<?php echo ($publish_url); ?>',_weixinsharedata.weixintitle,_weixinsharedata.weixindes);<?php endif; ?>


//统计代码

</script>
</html>