<?php
	include "../frame.php";
	use_jquery();
	echo basename(dirname(__FILE__));
	$url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone=13817499668&content=" .iconv('utf-8','gbk','测试') ."&sign=1";
?>

<a href="<?php echo $url;?>">test</a>

<script>
	$(function(){
	});
</script>
