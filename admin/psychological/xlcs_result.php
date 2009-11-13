<?php
    require_once('../frame.php');
?>
<div style="width:280px; height:200px; float:left; display:inline;">
<div style='width:280px; height:200px; line-height:15px; float:left; display:inline;'>
	内容：<?php show_fckeditor('flower_comment','Admin',true,"200");?><br><br>
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
<script>
	$(function(){
		$("#button").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('flower_comment');
			var content = oEditor.GetHTML();
			if($(content==''){
				alert('请输入留言内容！');
				return false;
			}
			$("#hidden_flower_comment").attr("value",content);
			tb_remove();
		})
	})
</script>