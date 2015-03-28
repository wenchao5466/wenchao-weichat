<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($activity['name']); ?></title>
<script src='<?php echo ($static_url); ?>/assets/js/jquery-1.10.2.min.js'></script>	
<script>



</script>

<!-- 活动专题内容 -->
    <?php echo ($news_info['content']); ?>
<?php if($news_info['video_url']): ?><iframe height=498 width=510 isAutoPlay=true src="<?php echo ($news_info['video_url']); ?>" frameborder=0 allowfullscreen></iframe><?php endif; ?>
<!-- 活动专题内容 -->

<script>
//统计代码

</script>
</html>