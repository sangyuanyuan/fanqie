function login(param)
{
  var p;
  if($.cookie('smg_user_nickname')!="")
  {
  	p=$.cookie('smg_user_nickname');	
  }
	else
	{	
		p='<a href="login.php?height=120&width=300&modal=true" class="thickbox" title="Please Sign In">µÇÂ¼</a>';
	}	
	
	$('#'+param).html(p);
	
}
