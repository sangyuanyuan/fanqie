$(function(){
		$(".del").click(function(){
			if(!window.confirm("确定要删除吗"))
			{
				return false;
			}
			else
			{
				$.post("/admin/pub/pub.post.php",{'del_id':$(this).attr('name'),'db_table':$('#db_talbe').attr('value'),'post_type':'del'},function(data){
					$("#"+data).remove();
				});
			}
		});
		
		
		
		
		
		

});