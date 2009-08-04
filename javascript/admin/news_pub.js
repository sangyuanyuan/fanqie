/**
 * @author sauger
 */
var category_count = 0;

$(function(){
	$('#td_newstype input').click(function(){
		toggle_news_type();
	});
	
	$('#a_add_category').click(function(e){
		e.preventDefault();
		category_count++;
		str = '<tr class="tr_news_category_add" align="center" bgcolor="#f9f9f9" height="25px;"><td>分　类</td><td colspan="5" align="left">';
		str += '<span id="td_category_select_'+ category_count +'"></span>';
		str += '<a href="#" class="a_delete_category" style="color:blue;"> 删除</a>';
		$('#td_category_select').parent().parent().after(str);
		category.display_select('news_category_add',$('#td_category_select_'+ category_count),-1);
		$('.a_delete_category').click(function(e){
			e.preventDefault();			
			$(this).parent().parent().remove();
		});
	});
	
	category.display_select('news_category',$('#td_category_select'),$("#category_id").val(),'',function(id,max_len){
		if(id != -1){
			$('#max_len').html('('+ max_len + ')');
		}else{
			$('#max_len').html('');
		}
	});	
	$('#image_flag_checkbox').click(function(){
		if($(this).attr('checked')){
			$('#hidden_image_flag').val('1');
		}else{
			$('#hidden_image_flag').val('0');
		}	
	});
	$('#forbbide_copy_checkbox').click(function(){
		if($(this).attr('checked')){
			$('#hidden_forbbide_copy').val('1');
		}else{
			$('#hidden_forbbide_copy').val('0');
		}		
	});
	$('#check_box_commentable').click(function(){
		if($(this).attr('checked')){
			$('#hidden_is_commentable').val(1);
		}else{
			$('#hidden_is_commentable').val(0);
		}
		
	});
	$('#ch_low_quality').change(function(){
		if($(this).attr('checked')){
			$('#hidden_low_quality').val(1);
		}else{
			$('#hidden_low_quality').val(0);
		}
	});	
	toggle_news_type();	
});


function toggle_news_type(){
	news_type=  $('#td_newstype').find('input:checked').attr('value');
	if (news_type == 1){
		$('.normal_news').show();
		$('#target_url').hide();
		$('#tr_file_name').hide();
	}else if(news_type == 2){
		$('.normal_news').hide();
		$('#target_url').hide();
		$('#tr_file_name').show();
	}else if(news_type == 3){
		$('.normal_news').hide();
		$('#target_url').show();
		$('#tr_file_name').hide();
	}
}
var related_news = new Array();
function add_related_news(id){
	//remove_related_news(id);
	related_news.push(id);
	$('#hidden_related_news').attr('value',related_news.join(','));
	//alert(related_news.toString());
}

function remove_related_news(id){
	icount = related_news.length;
	for(i=0;i<icount;i++){
		if(related_news[i] == id){
			related_news.splice(i,1);
		}
	}
	$('#hidden_related_news').attr('value',related_news.join(','));
}

var related_videos = new Array();
function add_related_videos(id){
	related_videos.push(id);
	$('#hidden_related_videos').attr('value',related_videos.join(','));
}

function remove_related_videos(id){
	icount = related_videos.length;
	for(i=0;i<icount;i++){
		if(related_videos[i] == id){
			related_videos.splice(i,1);
		}
	}
	$('#hidden_related_videos').attr('value',related_videos.join(','));
}

var sub_headlines = new Array();
function add_sub_headlines(id){
	sub_headlines.push(id);
	$('#hidden_sub_headlines').attr('value',sub_headlines.join(','));
}

function remove_sub_headlines(id){
	icount = sub_headlines.length;
	for(i=0;i<icount;i++){
		if(sub_headlines[i] == id){
			sub_headlines.splice(i,1);
		}
	}
	$('#hidden_sub_headlines').attr('value',sub_headlines.join(','));
}
function str_length(str){
	//return   str.replace(/[^\x00-\xff]/g,"**").length;
	 var i;   
    var len;   
    len = 0;   
    for (i=0;i<str.length;i++)   
    {   
        if (str.charCodeAt >255) len+=2; else len++;   
    }   
    return len;  
}

 function remove_hmtl_tag(str) 
{ 
 	return str.replace(/<\/?.+?>/g,"");//去掉所有的html标记 
} 


