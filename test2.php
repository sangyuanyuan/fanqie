<a href="test2.php?name=<?php echo urlencode('盛志峰');?>">我的名字</a>
<?
echo urldecode($_REQUEST['name']); 
?>