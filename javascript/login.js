function login(param)
{
  var p;
  if($.cookie('smg_username')!="")
  {
  	p=$.cookie('smg_username');	
  }
	else
	{	
		p='<a href="login.frame.php?height=120&width=300&modal=true" class="thickbox" title="Please Sign In">��¼</a>';
	}	
	
	$('#'+param).html(p);
	
}
