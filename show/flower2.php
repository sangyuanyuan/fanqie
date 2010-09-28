<?php
    require_once('../frame.php');
	$id = $_REQUEST['id'];
?>

<form action="flower2.post.php" method="post" id='flower_from'>
<div style="width:280px; height:280px;  float:left; display:inline;">
<div style='width:280px; height:30px; margin-top:5px; line-height:15px; float:left; display:inline;'>
	姓名：<input type="text" name='flower_name'>
</div>
<div style='width:280px; height:180px; line-height:15px; float:left; display:inline;'>
	内容：<textarea name='flower_omment' id='flower_omment'></textarea><br><br>
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<img src="/images/show/xianhua.jpg" width=200; height=140 border=0 style="float:left; display:inline;">
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
</form>

<script>
	$(function(){
		$("#button").click(function(){
			if($("#flower_omment").val()==''){
				alert('请输入祝福语！');
				return false;
			}
			$("#flower_from").submit();
		})
	})
</script>
