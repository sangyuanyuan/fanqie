/**
 * @author sauger
 */
	$(function(){
		$('.input_vote_item').click(function(e){
			var item_box = $(this).parent().parent();
			var max_item = $(item_box).attr('max-item');
			if(max_item != undefined){
				var select_count = $(this).parent().parent().find('input:checked').length;
				if(max_item < select_count){
					alert('投票:' + $(item_box).attr('vote_name') + ' 最多只能选择 ' + max_item +' 个选项');
					return false;
				}
			}			
		});
		$('.submit_vote').click(function(){
			var result = true;;
			$(this).parent().parent().find('.vote_items_box').each(function(){
				if($(this).find('input:checked').length <=0 && $(this).find('input:selected').length <= 0){
					alert('投票:' + $(this).attr('vote_name') +' 至少选择一个选项');
					result = false;
					return false;
				}
				var max_item = $(this).attr('max-item');
				if(max_item != undefined){
					var select_count = $(this).find('input:checked').length;
					if(max_item < select_count){
						alert('投票:' + $(this).attr('vote_name') + ' 最多只能选择 ' + max_item +' 个选项');
						result = false;
						return false;
					}
				}
					
			});	
			$(this).parent().parent().attr('action','/pub/vote.post.php');
			return result;		
		});
		
		$('.view_vote').click(function(){
			$(this).parent().parent().attr('action','/vote/vote_show.php');
			return true;
		});
	});
	
	 function remove_html_tag(str) 
	{ 
 		return str.replace(/<\/?.+?>/g,"");//去掉所有的html标记 
	} 
