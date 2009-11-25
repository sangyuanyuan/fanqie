<?php
    require_once('../../frame.php');
    $id=$_REQUEST['id'];
?>
<div style="width:300px; height:200px; float:left; display:inline;">
<div style='width:300px; height:200px; line-height:20px; float:left; display:inline;'>
	数量：<input type="text" id="maxnum" name="maxnum">
	内容：<?php show_fckeditor('flower_comment','Title',true,"160","","300");?><br><br>
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
<script>
	$(function(){
		$("#button").click(function(){
			var parentwin=window.parent;
			var oEditor = FCKeditorAPI.GetInstance('flower_comment');
			var content = oEditor.GetHTML();
			var fckcomment=FCKeditorAPI.GetInstance('item<?php echo $id;?>[content]');
			var maxnum=$("#maxnum").attr("value");
			if(content==''){
				alert('请输入内容！');
				return false;
			}
			$("#item<?php echo $id;?>maxnum").attr("value",maxnum);
			fckcomment.SetHTML(content);
			tb_remove();
		})
	})
</script>