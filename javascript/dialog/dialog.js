/**
 * @author sauger
 */
var question_count = 1;
var last_question_id = 0;
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
		}
		;
		$('#ajax_ret').load('dialog.ajax.php',{'question_count':$('#question_count').val(),'last_question_id':$('#last_question_id').val(),'writer':writer,'content':question,'optype':'add_question'});
	});
});
