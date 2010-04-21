<?php
    require_once('../frame.php');
?>
<div style="width:280px; height:200px; float:left; display:inline;">
<div style='width:280px; height:30px; margin-top:65px; line-height:15px; float:left; display:inline;'>
	姓名：<input type="text" id='flower_name'>
</div>
<div style='width:280px; height:100px; line-height:15px; float:left; display:inline;'>
	内容：<textarea style="width:200px; height:50px;" id='flower_comment'></textarea><br><br>
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
<script>
	$(function(){
		$("#button").click(function(){
			if($("#flower_comment").val()==''){
				alert('请输入祈福内容！');
				return false;
			}
			$.post("comment.post.php",{
				name:$("#flower_name").val(),
				comment:$("#flower_comment").val()
			},function(date){
				$("#comment_show").html(date);
				tb_remove();
			})
		})
	})
</script>
