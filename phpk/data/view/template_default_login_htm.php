<?php
//Nemo Cache @ 2010-05-19 15:53:08
echo '��<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
';
if ($master) {
echo '
<title>PHP��ǽ-��½</title>
';
} else {
echo '
<title>PHP��ǽ-��½</title>
';
}
echo '
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">
<!-- 
body{font:12px Verdana,"sans-serif";color:#333;margin:100px;text-align:center;}
table{background:#F6FFDA;border:1px solid #70b817}
th{color:#fff;font-size:14px;background:#70b817;text-align:center;border:1px solid #fff}
td{text-align:left;}
a{color:#70b817;}
a:hover{color:#ff3992;}
-->	
</style>
';
if ($master) {
echo '
<script type="text/javascript">
<!--
function check(obj){
	if(obj.pass.value==""){
        alert("����д[������]");
        obj.password.focus();
        return false;
    }
	if(obj.password.value==""){
        alert("���ظ���д[������]");
        obj.password.focus();
        return false;
    }
	frmLogin.submit.disabled=true;
    return true;
}
//-->
</script>
</head>
<body>
<table width="300px" border="0" cellpadding="8" cellspacing="0">
	<tr>
		<th colspan="2">��ӭʹ��PHP��ǽ</th>
	</tr>
	<form method="post" action="'.$PHP_SELF.'?a=admin&m=editpass" name="frmLogin" onsubmit="return check(this)">
    <input type="hidden" name="formhash" value="';
echo _FORMHASH_;
echo '">
	<tr>
		<td>������</td>
		<td><input name="pass" type="text" value="" size="19" maxlength="14"/></td>
	</tr>
	<tr>
		<td>�ظ�����</td>
		<td><input name="password" type="password" value="" size="20" maxlength="14"/></td>
	</tr>
';
} else {
echo '
<script type="text/javascript">
<!--
function check(obj){
    if(obj.username.value==""){
        alert("����д[�û���]");
        obj.username.focus();
        return false;
    }
	if(obj.password.value==""){
        alert("����д[����]");
        obj.password.focus();
        return false;
    }
    if(obj.seccode.value==""){
        alert("������[��֤��]");
        obj.key.focus();
        return false;
    }else{
		var noStr = obj.key.value;
		var no = parseInt(noStr);
	}
	frmLogin.submit.disabled=true;
    return true;
}
//-->
</script>
</head>
<body>
<table width="300px" border="0" cellpadding="8" cellspacing="0">
	<tr>
		<th colspan="2">��ӭʹ��PHP��ǽ</th>
	</tr>
	<form method="post" action="'.$PHP_SELF.'?a=admin" name="frmLogin" onsubmit="return check(this)">
    <input type="hidden" name="formhash" value="';
echo _FORMHASH_;
echo '">
	<tr>
		<td>�û���</td>
		<td><input name="username" type="text" value="" size="19" maxlength="14"/></td>
	</tr>
	<tr>
		<td>����</td>
		<td><input name="password" type="password" value="" size="20" maxlength="14"/></td>
	</tr>
';
}
if ($seccodestatus['admin']) {
echo '
	<tr>
		<td>��֤��</td>
		<td><input class="input" name="seccode" type="text" value="" size="6" maxlength="4" onfocus="this.value=\'\';" /> <img id="secimg" src="seccode.php?&'.$timestamp.'" onClick="this.src=\'seccode.php?&\' + Math.random()" /></td>
	</tr>
	';
}
echo '
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value=" �� �� " name="Submit" />
	    </td>
	</tr>
	</form>
	<tr>
		<td colspan="2">��Ȩ���� <a href="http://user.qzone.qq.com/85825770/" target="_blank">��Ĭ</a>&nbsp;&nbsp;&nbsp;&nbsp;QQ:85825770</td>
	</tr>
</table>
</body>
</html>';
?>