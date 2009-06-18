<?
require_once('../frame.php');
if(!is_ajax()){use_jquery();}
js_include_once_tag('jquery.cookie');
?>

<div style="text-align:center ">
<table border="0" cellpadding="3" cellspacing="3" style="margin:0 auto;" >
  <tr>
    <td><label>用户名：</label></td>
    <td><input id="login_text" name="login_text" type="text" size="20" style="width:180px;"></td>
  </tr>
  <tr>
    <td><label>密　码：</label></td>
    <td><input id="passwod_text" name="passwod_text" type="password" size="20" style="width:180px;"></td>
  </tr>
  <tr align="right">
    <td colspan="2"><input type="button" style="width:90px;" value="登录" onclick="check_login('login_context','logout_context','reg_context');">&nbsp;<input type="button" style="width:90px;"  value="取消" onclick="tb_remove();"></td>
  </tr>
</table>
</div>
