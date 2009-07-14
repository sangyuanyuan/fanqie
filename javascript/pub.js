/**
 * @author Administrator
 */
$(function(){
	$("#submit_comment").click(function(){
		if($("#commenter").attr('value'))
		$.post('/pub/pub.post.php',{'type':'comment','commenter':$("#commenter").attr('value'),'content':$("#comment_content").attr('value'),'resource_id':$("#resource_id").attr('value'),'resource_type':$("#resource_type").attr('value')},function(data){
			if(data==''){
				window.location.reload();
			}else{
				alert(data);
			}
		});
	});
});
