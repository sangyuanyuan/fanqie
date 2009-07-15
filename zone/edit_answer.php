<?php
	#var_dump($_GET);	
	require "../frame.php";
	$dialog_id = $_REQUEST['dialog_id'];
	$answer_id = $_REQUEST['answer_id'];
	$question_id = $_REQUEST['question_id'];
	$question = new table_class('smg_dialog_question');
	$question = $question->find($question_id);
	$answer = new table_class('smg_dialog_answer');
	$answer = $answer->find($answer_id);
?>
<h2>编辑回复</h2>
<div class="answer_question"><span class="answer_question_index"><b>问题:</b></span><?php echo $question->content;?><span class="question_time"> <?php echo $question->writer .' ' .$question->create_time;?></span></div>
<form id="answer">
	<?php show_fckeditor('fck_content','Title',false,200,$answer->content,660);?>
	<div id="answer_emtion"></div>
	<input type="hidden" name="answer[dialog_id]" value="<?php echo $dialog_id;?>">
	<input type="hidden" name="answer[question_id]" value="<?php echo $question_id;?>">
	<input type="hidden" name="answer[content]" id="answer_content" value="">
	<input type="hidden" name="optype" value="edit_answer">
	<input type="hidden" name="dialog_id" value="<?php echo $dialog_id;?>">	
	<input type="hidden" name="answer_id" value="<?php echo $answer_id;?>">
</form>
<button id="save">提交</button> <button id="cancel">取消</button>
<script>
	$(function(){
		$('#save').click(function(){
			var oeditor = FCKeditorAPI.GetInstance('fck_content') ;
			var question = oeditor.GetHTML();
			if(question == ''){
				alert('请输入问题回复!');
				return;
			}else{
				
				$('#answer_content').val(question);
			};
			var query_str = $('#div_hidden').serialize();
			$('#ajax_ret').load('dialog.ajax.php?' + query_str,$('form').serializeArray());
			tb_remove();
		});
		$('#cancel').click(function(){
			tb_remove();
		});
		display_fqbq('answer_emtion','fck_content');
	});
</script>