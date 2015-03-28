<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($activity['name']); ?></title>
<script src='/assets/js/jquery-1.10.2.min.js'></script>	
<script>
var ajax_url = '<?php echo ($check_user_status_url); ?>';
</script>

<!-- 活动专题内容 -->
    <?php echo ($news['content']); ?>
    
<!-- 活动专题内容 -->

<script>
//统计代码

</script>
</html>