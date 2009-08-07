<?php
	require "../frame.php";
	//var_dump($_REQUEST);
	$question = new table_class('smg_dialog_question');
	$question = $question->find($_REQUEST['question_id']);
?>
<div>
	<div class="answer_question">
		<span class="answer_question_index"><b>问题:</b></span>
		<?php echo $question->content; ?>
		<div style="text-align:right;" class="question_time">　　　[<?php echo $question->writer;?>] <?php echo $question->create_time; ?></div>
	</div>
	<div>
		<form id="form_comment_q">
			<input type="text" name="comment[nick_name]" id="cq_writer" style="width:300px"> 请填写用户名
			<?php show_fckeditor('fck_cq','Title',false,115,'',660);?>
			<input type="hidden" id="cq_comment" name="comment[comment]" value="" style="display:none;">
			<input type="hidden" name="comment[resource_type]" value="dialog" style="display:none;">
			<input type="hidden" name="comment[resource_id]" value="<?php echo $question->dialog_id;?>" style="display:none;">
			<div id="cq_emotion" class="div_emotion"></div>
			<div style="text-align:center"><button id="cq_save" style="width:100px;">提交</button> <button id="cq_cancel" style="width:100px;">取消</button></div>			
			<input type="hidden" name="comment[reserve]" value='<?php echo ($question->content); ?>'>
		</form>
	</div>

</div>

<script>
	total("对话","zone");
	$(function(){
		display_fqbq('cq_emotion','fck_cq');
		$('#cq_save').click(function(){
			var writer = $('#cq_writer').val();
			if(writer == ''){
				alert('请填写昵称');
				return false;		
			}
			var oeditor = FCKeditorAPI.GetInstance('fck_cq') ;
			var content = oeditor.GetHTML();
			if(content == ''){
				alert('请输入评论内容!');
				return false;
			};
			$('#cq_comment').val(content);
			$.post('/pub/comment.post.php',$('#form_comment_q').serializeArray(),function(data){
				if(data > 0){
					//alert('发表评论成功!');
				}else{
					alert('发表评论失败!');
				}				
				tb_remove();
				refresh_data();				
			});
			return false;
			
		});
		
		$('#cq_cancel').click(function(){
			tb_remove();
			return false;
		});
				
	});
	
</script>