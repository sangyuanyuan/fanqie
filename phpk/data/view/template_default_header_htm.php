<?php
//Nemo Cache @ 2010-05-19 15:53:38
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>'.$siteName.'</title>
<meta content="'.$siteName.',PHP��ǽ����Ĭ��85825770,PHP��ǽ����ϵͳ" name="Description" />
<style><!--@import url(inc/style.css);--></style>
</head>
<body>
<div style="display:none;" id="aspk" onclick="Hide();"></div>
<div id="header">
	<span style="float:left;"><a href="'.$PHP_SELF.'" target="_blank"><img src="images/logo.gif" alt="��԰��ǽ" /></a></span>
	
</div>
<div id="menu">
	<a href="'.$PHP_SELF.'"><img src="images/btn_index.gif" alt="��ҳ" /></a>
	<a href="'.$PHP_SELF.'?a=add"><img src="images/btn_add.gif" alt="������" /></a>
	<a href="'.$PHP_SELF.'?a=list"><img src="images/btn_list.gif" alt="�����б�" /></a>
	<input id="find" name="id" class="input" type="text" maxlength="10" size="15" value=" ������������� " onclick="this.value=\'\';" />
	<input type="image" src="images/btn_search.gif" alt="����" onclick="find();" />
</div>
<script type="text/javascript">
<!--
function find(){
	var noStr = document.getElementById("find").value;
	var no = parseInt(noStr);
	if(isNaN(no)){
		alert("[�������]�϶������ְ�");
		return;
	}else if(no < 1){
		alert("[�������]�϶���������");
		return;
	}else{
		window.location.href = "'.$PHP_SELF.'?a=so&id="+no;		
	}
}
//-->
</script>';
?>