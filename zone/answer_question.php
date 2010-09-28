<?php
	#var_dump($_GET);	
	require "../frame.php";
	$dialog_id = $_REQUEST['dialog_id'];
	$question_id = $_REQUEST['question_id'];
	$question = new table_class('smg_dialog_question');
	$question = $question->find($question_id);
?>
<div style="width:100%; height:25px; padding-top:5px; background:#E8E8E8; margin-bottom:5px; text-align:center; font-weight:bold;">回复问题</div>
<div class="answer_question"><span class="answer_question_index"><b>问题:</b></span><?php echo $question->content;?><span class="question_time"> <?php echo $question->writer .' ' .$question->create_time;?></span></div>
<form id="answer">
	<?php show_fckeditor('fck_content','Title',false,150,'',660);?>
	<div id="answer_emtion"  class="div_emotion"></div>
	<input type="hidden" name="answer[dialog_id]" value="<?php echo $dialog_id;?>">
	<input type="hidden" name="answer[question_id]" value="<?php echo $question_id;?>">
	<input type="hidden" name="answer[content]" id="answer_content" value="">
	<input type="hidden" name="optype" value="answer_question">
	<input type="hidden" name="dialog_id" value="<?php echo $dialog_id;?>">	
</form>
<div style="text-align:center"><button id="save" style="width:100px;">提交</button> <button id="cancel" style="width:100px;">取消</button></div>
<script>
	total("对话","zone");
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