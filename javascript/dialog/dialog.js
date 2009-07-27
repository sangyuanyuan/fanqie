/**
 * @author sauger
 */
$(function(){
	display_fqbq('div_q_emotion','fck_question_content');
	display_fqbq('comment_emotion','fck_comment_content');
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
		if(question.length > 200){
			alert('提问内容请不要超过100个汉字');
			return false;
		}
		var dialog_id = $('#dialog_id').val();
		var query_str = $('#div_hidden').serialize();
		$('#ajax_ret').load('dialog.ajax.php?' + query_str,{'dialog_id':dialog_id,'writer':writer,'content':question,'optype':'add_question','is_master':$('#is_master').val()});
		oeditor.SetHTML('');
	});
	
	$('#comment_button').click(function(){
		var writer = $('#comment_writer').val();
		if(writer == ''){
			alert('请输入用户名');
			return;
		}
		var oeditor = FCKeditorAPI.GetInstance('fck_comment_content') ;
		var content = oeditor.GetHTML();
		if(content==''){
			alert('请输入评论内容!');
			return;
		}else{
			if(content.length > 200){
				alert('评论内容请不要超过100个汉字');
				return false;
			}
			$('#comment_content').val(content);
		}
		var dialog_id = $('#dialog_id').val();
		$.post('/pub/comment.post.php',{'comment[resource_type]':'dialog','comment[resource_id]':dialog_id,'comment[nick_name]':writer,'comment[comment]':content},function(data){
			if(data > 0){
				//alert('发表评论成功!');
			}else{
				alert('发表评论失败');
			}			
			var dialog_id = $('#dialog_id').val();
			var query_str = $('#div_hidden').serialize();
			$('#ajax_ret').load('dialog.ajax.php?' + query_str,{'dialog_id':dialog_id});
		});
	});
	//tb_init('.comment_href');
	scroll_buttom();
	setInterval('refresh_data()',10000);
});

function refresh_data(){
	var dialog_id = $('#dialog_id').val();
	var query_str = $('#div_hidden').serialize();
	$('#ajax_ret').load('dialog.ajax.php?' + query_str,{'dialog_id':dialog_id});
}

function delete_question(id){
	var dialog_id = $('#dialog_id').val();
	if(confirm('删除问题将问题相关的答案,确认删除此问题?')){
		$('#ajax_ret').load('dialog.ajax.php',{'dialog_id':dialog_id,'optype':'delete_question','question_id':id});
	}
}

function delete_answer(id){
	if(confirm('确认删除此回复?')){
		var dialog_id = $('#dialog_id').val();
		$('#ajax_ret').load('dialog.ajax.php',{'dialog_id':dialog_id,'optype':'delete_answer','answer_id':id});
	}
}

function answer_question(id){
	var dialog_id = $('#dialog_id').val();	
	tb_show('回答问题','answer_question.php?height=350&width=661&modal=true&question_id=' + id + '&dialog_id=' + dialog_id,false);
	//$('#ajax_ret').load('dialog.ajax.php',{'dialog_id':dialog_id,'optype':'answer_question','question_id':id});
}

function edit_answer(qid, id){
	var dialog_id = $('#dialog_id').val();	
	tb_show('回答问题','edit_answer.php?height=350&width=661&modal=true&question_id=' + qid + '&dialog_id=' + dialog_id + '&answer_id=' + id,false);	
}

function show_comment_box(id){
	tb_show('评论问题','comment_question.php?height=310&width=661&question_id=' + id,false);
}

function scroll_buttom(){
	$('#div_question').scrollTop(10000);
	$('#div_answer_list').scrollTop(10000);
	//$('#comment_list_box').scrollTop(10000);
}
