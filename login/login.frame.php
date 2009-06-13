<?
require_once('../frame.php');
//use_jquery();
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
  	 alert(data);	
	});
}	
</script>