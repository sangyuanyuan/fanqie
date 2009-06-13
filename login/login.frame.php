<?
require_once('../frame.php');
if(!is_ajax()){use_jquery();}
js_include_once_tag('jquery.cookie');
?>

<div style="text-align:center ">
<table border="0" cellpadding="3" cellspacing="3" style="margin:0 auto;" >
  <tr>
    <td><label>用户名：</label></td>
    <td><input id="login_text" type="text" size="20" style="width:180px;"></td>
  </tr>
  <tr>
    <td><label>密　码：</label></td>
    <td><input id="passwod_text" type="password" size="20" style="width:180px;"></td>
  </tr>
  <tr align="right">
    <td colspan="2"><input type="button" style="width:90px;" value="登录" onclick="check_login();">&nbsp;<input type="button" style="width:90px;"  value="取消" onclick="tb_remove();"></td>
  </tr>
</table>
</div>
<script language="javascript">
function check_login()
{	
	var login_text=$('#login_text').attr('value');
	var password_text=$('#passwod_text').attr('value');

	$.post('login.post.php',{'login_text':login_text,'password_text':password_text},function(data){
  	 if(data == "error"){alert("用户名或密码错误"); return false;}
  	 if(data == "ok")
  	 {
		   var smg_username = $.cookie('smg_username');
	  	 var smg_user_nickname = $.cookie('smg_user_nickname');
	  	 $('#login_context').html(smg_user_nickname);
	  	 tb_remove();
		}
	});
}	
</script>