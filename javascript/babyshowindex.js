$(function(){
	$("#reg").click(function(){
		window.open('/login/register.php');	
	});
	$("#sub").click(function(){
		alert('OK');
		if($("#login_text").val()!="" && $("#password_text").val()!="")
		{
			document.babylogin.submit();
		}
	});
});