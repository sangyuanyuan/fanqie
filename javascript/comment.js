$(function(){
	$(".edit").click(function(){
		if(!window.confirm("编辑评论内容")){return false;}
		$.post("/admin/comment/comment.post.php",{id:$("#id").attr('value'),comment:$(".comment").attr('value')},function(data){
			if(""==data){window.location.reload();}
		});	
	});
	
	$("#search").click(function(){
				window.location.href="?key1="+$("#user_name").attr('value')+"&key2="+$("#comment").attr('value');
	});
})