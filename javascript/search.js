/**
 * @author sauger
 */
function toggle_category(){
	var search_type = $('#search_type').val();
	if(search_type == 'smg_news'){
		news_category.display_select('category',$('#category'),$('#category_id').val(),'',function(id){
			$('#category_id').val(id);	
		});
	}else if(search_type == 'smg_video'){
		video_category.display_select('category',$('#category'),$('#category_id').val(),'',function(id){
			$('#category_id').val(id);	
		});
	}else if(search_type == 'smg_images'){
		image_category.display_select('category',$('#category'),$('#category_id').val(),'',function(id){
			$('#category_id').val(id);	
		});
	}
}

$(function(){
	$('#search_type').change(function(){
		$('#category_id').val(0);
		toggle_category();
	});
	
	$(".date_jquery").datepicker(
		{
			monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
			dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			dayNamesMin:["日","一","二","三","四","五","六"],
			dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			dateFormat: 'yy-mm-dd'
		}
	);
	
	$('#search_text').keydown(function(e){
		if(e.keycode == 13){
			$('form').submit();
		}
	});
	
	$('#submit').click(function(e){
		$('form').submit();
	});
	toggle_category();
});
