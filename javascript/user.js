function login(param)
{
  var p;
  if($.cookie('smg_user_nickname')!=null)
  {
  	p=$.cookie('smg_user_nickname');	
  }
	else
	{	
		p='<a href="login.php?height=120&width=300&modal=true" class="thickbox">登录</a>';
	}	
	$('#'+param).html(p);
}

function logout(param)
{
  var p;
  if($.cookie('smg_user_nickname')==null)
  {
		 $('#'+param).hide();
	}
	else
	{
		 $('#'+param).show();
	}	
}

function check_login(param1,param2)
{	
	var login_text=$('#login_text').attr('value');
	var password_text=$('#passwod_text').attr('value');

  if(login_text==""||password_text==""){return false;}
  
	$.post('user.post.php',{'user_type':'login','login_text':login_text,'password_text':password_text},function(data){
  	 if(data == "error"){alert("用户名或密码错误"); return false;}
  	 if(data == "ok")
  	 {
		   var smg_username = $.cookie('smg_username');
	  	 var smg_user_nickname = $.cookie('smg_user_nickname');
	  	 $('#'+param1).html(smg_user_nickname);
	  	 $('#'+param2).show();
	  	 tb_remove();
		}
	});
}

function check_logout(param1,param2)
{	
	$.post('user.post.php',{'user_type':'logout'},function(data){
  	 if(data == "ok")
  	 {
	  	 login(param1);
	  	 $('#'+param2).hide();
	   }

	});
}