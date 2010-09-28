$(function(){
	
	$("#submit_comment").click(function(){
		$.post('/pub/pub.post.php',{'type':'comment','post[nick_name]':$("#commenter").attr('value'),'post[comment]':$("#comment_content").attr('value'),'post[resource_id]':$("#resource_id").attr('value'),'post[resource_type]':$("#resource_type").attr('value')},function(data){
				window.location.reload();
		});
	});
	
	
});
