<?php 
	session_start();
	setsession($_SERVER['HTTP_HOST']); 
?>
<div style="width:280px; height:200px; float:left; display:inline;">
<div style='width:280px; height:30px; margin-top:65px; line-height:15px; float:left; display:inline;'>
	标题：<input type="text" id='qtitle'>
</div>
<div style='width:280px; height:100px; line-height:15px; float:left; display:inline;'>
	内容：<textarea id='qcontent'></textarea><br><br>
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $_COOKIE['smg_user_id']; ?>">
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
<script>
	$(function(){
		$("#button").click(function(){
			if($("#qcontent").val()==''){
				alert('请输入内容！');
				return false;
			}
			$.post("/fqzd/question.post.php",{
				qtitle:$("#qtitle").val(),
				qcontent:$("#qcontent").val(),
				smg_uid:$("#user_id").val()
			},function(data){
				tb_remove();
				window.location.reload();
			})
		})
	})
</script>
