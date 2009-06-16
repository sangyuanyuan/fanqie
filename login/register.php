<?
require_once('../frame.php');
if(!is_ajax()){use_jquery();}
js_include_once_tag('jquery.cookie');
?>

<div style="text-align:center ">
		<table border="0" cellpadding="3" cellspacing="3" style="margin:0 auto;" >
		  <tr>
		    <td><label>用户名：</label></td>
		    <td><input id="user_text" type="text" size="20" style="width:180px;" > </td>
		  </tr>
		  <tr>
		    <td><label>密　码：</label></td>
		    <td><input id="passwod_text" type="password" size="20" style="width:180px;" ></td>
		  </tr>
		  <tr>
		    <td><label>重复密码：</label></td>
		    <td><input id="passwod2_text" type="password" size="20" style="width:180px;" ></td>
		  </tr>
		  <tr>
		    <td><label>邮　箱：</label></td>
		    <td><input id="email_text" type="text" class="required email" size="20" style="width:180px;"  ></td>
		  </tr> 
		  <tr align="right">
		    <td colspan="2"><input type="button" style="width:90px;" value="注册" onclick="check_reg('login_context','logout_context','reg_context');">&nbsp;<input type="button" style="width:90px;"  value="取消" onclick="tb_remove();"></td>
		  </tr>

		</table>
</div>
