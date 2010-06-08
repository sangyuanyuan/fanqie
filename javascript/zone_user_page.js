function debug(msg){
	$('#top_container').append('<br/>' + msg);
}
function save_position(pos_name){
	var pos = $('#'+pos_name);
	$.post('user_page.post.php?' + pos.sortable('serialize') + "&pos_name="+pos_name + '&type=sort');
	reset_size();
}

function reset_size(){
	var maxheight = 0;
	$(".sortable").each(function(){
		if($(this).height() > maxheight){
			maxheight = $(this).height();
		}
	});
	
	$(".sortable").css('height',maxheight);
}

$(function() {
	$(".sortable").sortable({
		connectWith:'.sortable',
		dropOnEmpty: true,
		stop:function(e,ui){
			save_position($(this).attr('id'));
		},
		receive:function(e,ui){
			save_position($(this).attr('id'));
		}
	});
	$('div.remove').live('click',function(){
		if(!confirm("您确认要删除此模块吗?")) return;
		var model = $(this).parent().parent();
		$.post('user_page.post.php?type=delete&id='+ model.attr('id'),function(){
			model.remove();
		});
	});

	$('#add_model').click(function(e){
		e.preventDefault();
		$.fn.colorbox({href:'add_model.php',width:'600px', height:'440px'});
	});
	
	$('.color').live('click',function(){
		$('#select_color').css('background-color',$(this).css('background-color'));
		$('#title_color').val($(this).css('background-color'));
	});
	reset_size();
});
