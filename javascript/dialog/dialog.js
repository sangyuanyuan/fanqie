/**
 * @author sauger
 */
$(function(){
	display_fqbq('div_q_emotion','fck_question_content');
	$('#a_submit_q').click(function(e){
		e.preventDefault();
		var writer = $('#writer').val();
		if(writer == '' || writer == '请填写用户名'){
			alert('请填写用户名');
			return;
		}
		var oeditor = FCKeditorAPI.GetInstance('fck_question_content') ;
		var question = oeditor.GetHTML();
		if(question == ''){
			alert('请输入问题内容!');
			return;
		};
		var dialog_id = $('#dialog_id').val();
		var query_str = $('#div_hidden').serialize();
		$('#ajax_ret').load('dialog.ajax.php?' + query_str,{'dialog_id':dialog_id,'writer':writer,'content':question,'optype':'add_question'});
	});
	
	$('#comment_button').click(function(){
		var writer = $('#comment_writer').val();
		if(writer == ''){
			alert('请输入用户名');
			return;
		}
		var content = $('#comment_content').val();
		if(content==''){
			alert('请输入评论内容!');
			return;
		}
		var dialog_id = $('#dialog_id').val();
		$.post('/pub/comment.post.php',{'resource_type':'dialog','resource_id':dialog_id,'comment[nick_name]':writer,'comment[content]':content},function(){
			
		});
	});
	scroll_buttom();
});

function delete_question(id){
	var dialog_id = $('#dialog_id').val();
	$('#ajax_ret').load('dialog.ajax.php',{'dialog_id':dialog_id,'optype':'delete_question','question_id':id});
}

function delete_answer(id){
	var dialog_id = $('#dialog_id').val();
	$('#ajax_ret').load('dialog.ajax.php',{'dialog_id':dialog_id,'optype':'delete_answer','answer_id':id});
}

function answer_question(id){
	var dialog_id = $('#dialog_id').val();	
	tb_show('回答问题','answer_question.php?height=350&width=670&modal=true&question_id=' + id + '&dialog_id=' + dialog_id,false);
	//$('#ajax_ret').load('dialog.ajax.php',{'dialog_id':dialog_id,'optype':'answer_question','question_id':id});
}

function edit_answer(qid, id){
	var dialog_id = $('#dialog_id').val();	
	tb_show('回答问题','edit_answer.php?height=350&width=670&modal=true&question_id=' + qid + '&dialog_id=' + dialog_id + '&answer_id=' + id,false);	
}

function scroll_buttom(){
	$('#div_question').scrollTop(10000);
	$('#div_answer_list').scrollTop(10000);
}
