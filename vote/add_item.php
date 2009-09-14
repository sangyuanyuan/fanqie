<?php
    require_once('../frame.php');
	$id = $_REQUEST['id'];
?>

<form action="vote_item.post.php" method="post" id='vote_add_item'>
	请输入一个选项：<input type="text" name="title" id="item"><br><br>
	<button type="submit" id="button">提交</button>
	<input type="hidden" name="vote_id" value="<?php echo $id;?>">
</form>

<script>
	$(function(){
		$("#button").click(function(){
			if($("#item").val()==''){
				alert('请输入选项内容！');
				return false;
			}else{
				$("#vote_add_item").submit();
			}
			
		})
	})
</script>
