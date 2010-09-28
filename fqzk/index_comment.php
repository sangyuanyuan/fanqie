<?php
    require_once('../frame.php');
?>
<div style="width:600px; height:200px; float:left; display:inline;">
<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
<div style='width:600px; height:200px; line-height:20px; float:left; display:inline;'>
	昵称：<input type="text" id="commenter" name="post[nick_name]"><br>
	内容：<?php show_fckeditor('post[comment]','Title',false,'75','','600');?><br><br>
	<input type="hidden" id="resource_type" name="post[resource_type]" value="fqzk">
	<input type="hidden" name="type" value="comment">
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</form>
</div>
<script>
	$(function(){
		$("#button").click(function(){
			var parentwin=window.parent;
			var oEditor = FCKeditorAPI.GetInstance('post[comment]');
			var content = oEditor.GetHTML();
			if(content==''){
				alert('请输入内容！');
				return false;
			}
			$('#subcomment').submit();
			tb_remove();
		})
	})
</script>