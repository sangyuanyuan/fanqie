/**
 * @author sauger
 */
$(function(){
	
	$('#news_edit').submit(function(){		
		var video_array = new Array('flv','wmv','wav','mp3','mp4','avi','rm');
		var pic_array = new Array('jpg','png','bmp','gif','icon');
		if($('#video_src').val() != ''){
			var video_src = $('#video_src').val().replace(/.+\./,'');
			video_src = video_src.toLowerCase();
			if(jQuery.inArray(video_src,video_array) == -1){
				alert('视频格式不支持,请转换格式后再上传!可上传格式:' + video_array.join('|'));
				return false;
			}
		}
		if($('#video_pic').val() != ''){
			var video_pic = $('#video_pic').val().replace(/.+\./,'');
			video_pic = video_pic.toLowerCase();
			if(jQuery.inArray(video_pic,pic_array) == -1){
				alert('图片格式不支持,请转换格式后再上传!可上传格式:' + pic_array.join('|'));
				return false;
			}
		}
		category_add = '';
		$('.tr_news_category_add').each(function(i){
			if(i==0){
				category_add += $(this).find('td span select:last').attr('value');
			}else{
				category_add += ',' + $(this).find('td span select:last').attr('value');
			}			
		});
		$('#category_add').attr('value',category_add);
		if($('#news_keywords').val()==''){
			alert("请输入关键字!");
			return false;
		}
		var oEditor = FCKeditorAPI.GetInstance('news[title]') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入标题！");
			return false;
		}	
		var oEditor = FCKeditorAPI.GetInstance('news[short_title]') ;
		var short_title = remove_hmtl_tag(oEditor.GetHTML());
		if(short_title==""){
			alert("请输入短标题！");
			return false;
		}
		var oEditor = FCKeditorAPI.GetInstance('news[content]') ;
		var title = oEditor.GetHTML();
		if(news_type==1&&title==""){
			alert("请输入新闻内容！");
			return false;
		}
		priority = $('#priority').attr('value');
		if(priority == '') priority = 100;
		
		$('#priority').attr('value', priority);		
		category_id = $('.news_category:last').attr('value');
		if(category_id == -1){
			alert('请选择分类!');
			return false;
		}
		$('#category_id').attr('value',category_id);
		var item = category.get_item(category_id);
		if(str_length(short_title) > item.short_title_length){
			alert('短标题太长,请重新输入!');
			return false;
		}	
		news_type=  $('#td_newstype').find('input:checked').attr('value');
		if(news_type == 3){
			if($('#target_url input').attr('value')== ''){
				alert('请输入新闻目标地址!');
				return false;
			}
		}else if(news_type==2 && $('#file_name').next('a').length <= 0 && $('#file_name').val() == ''){
			alert('请选择上传的文件!');
			return false;
		}
				
		return true;
	});
	
	var item = category.get_item($("#category_id").val());
	if(item != undefined &&  item.id != -1){
		$('#max_len').html('('+ item.short_title_length +')');
	}

});