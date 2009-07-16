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
			<input type="text" name="comment[nick_name]" id="cq_writer"> 请填写用户名
			<?php show_fckeditor('fck_cq','Title',false,115,'',666);?>
			<input type="hidden" id="cq_comment" name="comment[comment]" value="" style="display:none;">
			<input type="hidden" name="comment[resource_type]" value="dialog_question" style="display:none;">
			<input type="hidden" name="comment[resource_id]" value="<?php echo $question->id;?>" style="display:none;">
			<div id="cq_emotion" class="div_emotion"></div>
			<div style="text-align:center"><button id="cq_save">提交</button> <button id="cq_cancel">取消</button></div>			
		</form>
	</div>
	<div><h3>历史评论</h3></div>
	<div id="q_comment_list">			
	</div>
</div>

<script>
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
					alert('发表评论成功!');
				}else{
					alert('发表评论失败!');
				}				
				load_comments();
			});
			return false;
			
		});
		
		$('#cq_cancel').click(function(){
			tb_remove();
			return false;
		});
		
		load_comments();
		
		function load_comments(){
			$('#q_comment_list').load('cq_list.php?question_id=<?php echo $question->id;?>');
		};
				
	});
	
</script>