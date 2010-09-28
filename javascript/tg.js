	$(document).ready(function(){
		
		$("#content11").click(function(){
			if($('#commenter').attr('value').length>100)
			{
				alert("用户名太长！");
				return false;
			}
			 if($('#commenter').attr('value')=="小番茄"||$('#commenter').attr('value')=="番茄小编")
			  {
			  		if($('#username').attr('value')!="01004660"&&$('#username').attr('value')!="01004645")
			  		{
			  			alert("特殊名字仅番茄网管理员才能使用！");
						return false;	
			  		}
			  }
			$("#comment").submit();
		})
	})