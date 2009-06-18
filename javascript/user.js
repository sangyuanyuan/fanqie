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

function login_with_ajax($name, $password){
	
}

function display_login(dom_name){
	if(!dom_name) dom_name = "login_div";
	var logout_text = '<span id=login_context>欢迎您　' + $.cookie('smg_user_nickname') + '</span>　<span id=logout_context><a href="#" id="logout_a">退出</a></span>';
	var login_text = '<a href="login_ajax.php?height=120&width=300&modal=true" class="thickbox">登录</a>　<span id=reg_context>注册</span>';
	var text = $.cookie('smg_user_nickname') == null ? login_text : logout_text;
	$("#" + dom_name).html(text);			
	$('#logout_a').click(function(e){
		alert('ok');
		e.preventDefault();
		$.post('/login/user.post.php',{'user_type':'logout'},function(){display_login(dom_name)});
	});
	tb_init('a.thickbox');
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

function reg(param)
{
  var p;
  if($.cookie('smg_user_nickname')!=null)
  {
  	p="";	
  }
	else
	{	
		p='<a href="register.php?height=180&width=300&modal=true" class="thickbox">注册</a>';
	}	
	$('#'+param).html(p);
}



function check_login(param1,param2,param3)
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
 	  	 reg(param3);
	  	 tb_remove();
		}
	});
}

function check_logout(param1,param2,param3)
{	
	$.post('user.post.php',{'user_type':'logout'},function(data){
  	 if(data == "ok")
  	 {
	  	 login(param1);
	  	 $('#'+param2).hide();
 	  	 reg(param3);
		 	 tb_init('a.thickbox');
	   }
	});
}

function check_reg(param1,param2,param3)
{	
	var user_text=$('#user_text').attr('value');
	var password_text=$('#passwod_text').attr('value');
	var password2_text=$('#passwod2_text').attr('value');
	var email_text=$('#email_text').attr('value');

  if(user_text==""||password_text==""||password2_text==""||email_text==""){alert("注册信息填写不完整");return false;}
  if(password_text!=password2_text){alert("密码重复错误");return false;}
  
	$.post('user.post.php',{'user_type':'reg','user_text':user_text,'password_text':password_text,'email_text':email_text},function(data){
  	 if(data == "error"){alert("用户名存在"); return false;}
  	 else if(data == "ok")
  	 {
		   alert("注册成功!");
			 var smg_username = $.cookie('smg_username');
	  	 var smg_user_nickname = $.cookie('smg_user_nickname');
	  	 $('#'+param1).html(smg_user_nickname);
	  	 $('#'+param2).show();
	  	 reg(param3);
	  	 tb_remove();
		}
		else{alert("注册失败"); return false;}
		
	});
}