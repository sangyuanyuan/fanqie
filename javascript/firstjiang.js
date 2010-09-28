	$(document).ready(function(){	
		$("#comment_sub").click(function(){
			var content = $('#comment').val();
			if(content==""){
				alert('评论内容不能为空！');
				return false;
			}
			if(content.length>1500)
			{
				alert('评论内容过长请分次评论！');
				return false;
			}
			document.subcomment.submit();
		});
	});
		