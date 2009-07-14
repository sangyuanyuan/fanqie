/**
 * @author Administrator
 */
$(function(){
	$("#submit_comment").click(function(){
		if($("#commenter").attr('value')!='undefined'){
			var commenter = $("#commenter").attr('value');
		}else{
			var commenter = '';
		}
		if($("#title").attr('value')!='undefined'){
			var title = $("#title").attr('value');
		}else{
			var title = '';
		}
		if($("#comment").attr('value')!='undefined'){
			var comment = $("#comment").attr('value');
		}else{
			var comment = '';
		}
		if($("#resource_id").attr('value')!='undefined'){
			var resource_id = $("#resource_id").attr('value');
		}else{
			var resource_id = '';
		}
		if($("#resource_type").attr('value')!='undefined'){
			var resource_type = $("#resource_type").attr('value');
		}else{
			var resource_type = '';
		}
		$.post('/pub/pub.post.php',{'post_type':'comment','post[nick_name]':commenter,'post[title]':title,'post[comment]':comment,'post[resource_id]':resource_id,'post[resource_type]':resource_type},function(data){
			if(data==''){
				window.location.reload();
			}else{
				alert(data);
			}
		});
	});
});
