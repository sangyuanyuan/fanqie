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
});