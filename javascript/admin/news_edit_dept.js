/**
 * @author sauger
 */
var category_count = 0;
$(function(){
	
	$('#news_add').submit(function(){
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
		if(category_id == -1){
			alert('请选择分类!');
			return false;
		}
		$('#category_id').attr('value',category_id);
		if($('#is_recommend').attr('checked')){					
			category_id_index = $('.news_category_index:last').attr('value');
			if(category_id_index == -1){
				alert('请选择首页分类!');
				return false;
			}
			$('#category_id_index').attr('value',category_id_index);		
		}
		var item = dept_category.get_item(category_id);
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
			
		return true;
	});
	
	$('#is_recommend').click(function(){
		toggle_is_recommend();
	});
	
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
		dept_category.display_select('news_category_add',$('#td_category_select_'+ category_count),-1);
		$('.a_delete_category').click(function(e){
			e.preventDefault();			
			$(this).parent().parent().remove();
		});
	});

	//category.display_select('news_category',$('#td_category_select'),-1);	
	//alert($('#category_id_index').val());
	category.display_select('news_category_index',$('#td_category_index'),$('#category_id_index').val(),'');
	dept_category.display_select('news_category',$('#td_category_select'),$('#category_id').val(),'',function(id,max_len){
		//alert('id=' + id + ';max_len=' + max_len);
		if(id != -1){
			$('#max_len').html('(长度限制:'+ max_len / 2 + '个汉字)');
		}else{
			$('#max_len').html('');
		}
	});		
	toggle_news_type();
	toggle_is_recommend();
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
	return   str.replace(/[^\x00-\xff]/g,"**").length;
}

 function remove_hmtl_tag(str) 
  { 
             return str.replace(/<\/?.+?>/g,"");//去掉所有的html标记 
  } 
