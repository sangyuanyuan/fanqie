/**
 * @author sauger
 */



$(function(){
	$('#news_add').submit(function(){
		var oEditor = FCKeditorAPI.GetInstance('news[title]') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入标题！");
			return false;
		}	
		var oEditor = FCKeditorAPI.GetInstance('news[short_title]') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入短标题！");
			return false;
		}
		var oEditor = FCKeditorAPI.GetInstance('news[title]') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入标题！");
			return false;
		}
		var oEditor = FCKeditorAPI.GetInstance('news[content]') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入新闻内容！");
			return false;
		}
		priority = $('#priority').attr('value');
		if(priority == '') priority = 100;
		$('#priority').attr('value', priority);
		category_id = $('#category_select select:last').attr('value');
		if(category_id == -1){
			alert('请选择分类!');
			return false;
		}
		$('#category_id').attr('value',category_id);
		news_type=  $('#td_newstype').find('input:checked').attr('value');
		if(news_type == 3){
			if($('#target_url input').attr('value')== ''){
				alert('请输入新闻目标地址!');
				return false;
			}
		}
		if(news_type == 2){
			if($('#tr_file_name input').attr('value')== ''){
				alert('请选择上传文件!');
				return false;
			}
		}
		
		alert('ok');
		return true;
	});
});
