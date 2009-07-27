/**
 * @author sauger
 */
$(function(){
	
	$('#news_add').submit(function(){
		if($('#video_src').val() != undefined && $('#video_src').val() != ''){
			var video_src = $('#video_src').val().replace(/.+\./,'');
			video_src = video_src.toLowerCase();
			if(jQuery.inArray(video_src,video_array) == -1){
				alert('视频格式不支持,请转换格式后再上传!可上传格式:' + video_array.join('|'));
				return false;
			}
		}
		if($('#video_pic').val() != undefined && $('#video_pic').val() != ''){
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
		if(news_type == 1){
			var oEditor = FCKeditorAPI.GetInstance('news[content]') ;
			var title = oEditor.GetHTML();
			if(news_type==1&&title==""){
				alert("请输入新闻内容！");
				return false;
			}
		}
		
		priority = $('#priority').attr('value');
		if(priority == '') priority = 100;
		
		$('#priority').attr('value', priority);					
		category_id = $('.news_category:last').attr('value');

		$('#category_id').attr('value',category_id);
		if($('#is_recommend').attr('checked')){					
			category_id_index = $('.news_category_index:last').attr('value');
			if(category_id_index == -1){
				alert('请选择首页分类!');
				return false;
			}
			$('#category_id_index').attr('value',category_id_index);
			var item1 = category_index.get_item(category_id_index);	
			
			if(item1 != undefined && str_length(short_title) > item1.short_title_length){
				alert('短标题长度大于首页分类限制'+ item1.short_title_length +',请重新输入!');
				return false;	
			}	
		}
		var item = category.get_item(category_id);
		if(item != undefined && str_length(short_title) > item.short_title_length){
			alert('短标题太长,请重新输入!');
			return false;	
		}
						
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
		if($('#video_src').attr('value') != '' && $('#video_pic').attr('value') == ''){
			alert('请选择视频图片!');
			return false;
		}
		$('#check_box_commentable').click(function(){
		if($(this).attr('checked')){
			$('#hidden_is_commentable').val(1);
		}else{
			$('#hidden_is_commentable').val(0);
		}
		
	});
			
		return true;
	});
	
	$('#is_recommend').click(function(){
		toggle_is_recommend();
	});
		
	category_index.display_select('news_category_index',$('#td_category_index'),-1,'');
	toggle_is_recommend();
});

function toggle_is_recommend(){
	if($('#is_recommend').attr('checked')){
		$('#hidden_is_recommend').val('1');
		$('#index_category').show();
	}else{
		$('#category_id_index').val('');
		$('#hidden_is_recommend').val('0');
		$('#index_category').hide();
	}	
}
