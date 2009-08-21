<?php
	include "../frame.php";
	use_jquery();
	
	$url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone=13817499668&content=" .urlencode(iconv('utf-8','gbk','您爆料的新闻已通过审批')) ."&sign=1";
	$fp = fopen($url,'r') ;
	fclose($fp);
	
	echo $url;
?>
<div><?php  ?>aa</div>
<a href="<?php echo $url;?>" id=test>test</a>
<a href="http://www.sohu.com">sohu</a>
<div id="ret"></div>
<iframe id="iframe" width=1 height=1 src="#" style="display:none;"></iframe>

<script>
	$(function(){
		$('#test').click(function(e){
			e.preventDefault();
			$('#iframe').attr('src','<?php echo $url;?>');
		});
	});
</script>
