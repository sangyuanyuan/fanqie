<?php
  require_once('../frame.php');
	$id = $_REQUEST['id'];
	$db = get_db();
	$sql = 'select content,news_id from smg_show_question where id='.$id;
	$record = $db->query($sql);
?>

<form action="answer.post.php" method="post" id='flower_from'>
<div style="width:280px;  float:left; display:inline;">
<div style='width:280px; line-height:15px; float:left; display:inline;'><?php if($record[0]->content!=''){?>网友提问：<?php echo strip_tags($record[0]->content);?><?php }?></div>
<div style='width:280px; height:180px; margin-top:10px; line-height:15px; float:left; display:inline;'>
	内容：<textarea name='post[content]' id='flower_omment' rows="10"></textarea><br><br>
	<input type="hidden" name="post[question_id]" value="<?php echo $id;?>">
	<input type="hidden" name="post[news_id]" value="<?php echo $record[0]->news_id;?>">
	<input type="hidden" name="type" value="replay">
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
</form>

<script>
	$(function(){
		$("#button").click(function(){
			if($("#flower_omment").val()==''){
				alert('请输入回答内容！');
				return false;
			}
			$("#flower_from").submit();
		})
	})
</script>
