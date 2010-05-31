function debug(msg){
	$('#top_container').append('<br/>' + msg);
}
function save_position(pos_name){
	var pos = $('#'+pos_name);
	$.post('user_page.post.php?' + pos.sortable('serialize') + "&pos_name="+pos_name + '&type=sort');
}
$(function() {
	$(".sortable").sortable({
		connectWith:'.sortable',
		stop:function(e,ui){
			save_position($(this).attr('id'));
		},
		receive:function(e,ui){
			save_position($(this).attr('id'));
		}
	});
	
	$('div.remove').live('click',function(){
		if(!confirm("您确认要删除此模块嘛?")) return;
		var model = $(this).parent().parent();
		$.post('user_page.post.php?type=delete&id='+ model.attr('id'),function(){
			model.remove();
		});
	});

});
