$(function(){
	$(".del").click(function(){
		if(!window.confirm("确定要删除吗"))
		{
			return false;
		}
		else
		{
			$.post("/admin/vote/vote.post.php",{'del_id':$(this).attr('name'),'db_table':'smg_vote','post_type':'del'},function(data){
				$("#"+data).remove();
			});
		}
	});
	
	$("#vote_search").click(function(){
				window.location.href="?key="+$("#search_text").attr('value');
	});
	
	$('#search_text').keydown(function(e){
		if(e.keyCode == 13){
			window.location.href="?key="+ encodeURI($("#search_text").attr('value'));			
		}
	});
});