function login(param)
{
  var p;
  if($.cookie('smg_username')!="")
  {
  	p=$.cookie('smg_username');	
  }
	else
	{	
		p='<a href="login.frame.php?height=120&width=300&modal=true" class="thickbox" title="Please Sign In">登录</a>';
	}	
	alert(param);
	$('#'+param).text(p);
	
}
