<?php
	include "../frame.php";
	use_jquery();
	
	$url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone=13817499668&content=" .urlencode(iconv('utf-8','gbk','您爆料的新闻已通过审批')) ."&sign=1";
	echo $url;
?>

<a href="<?php echo $url;?>" id=test>test</a>
<div id="ret"></div>
<iframe id="iframe" width=0 height=0 src="#"></iframe>

<script>
	$(function(){
		$('#test').click(function(e){
			e.preventDefault();
			$('#iframe').attr('src','<?php echo $url;?>');
		});
	});
</script>
