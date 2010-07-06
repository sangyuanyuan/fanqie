<?php 
include('../../frame.php');
$jssh = new table_class('smg_jspd_jssh');
if($_POST['jsshid']!="")
{
	$jssh->find($_POST['jsshid']);
}
$jssh->update_attributes($_POST['jspd'],false);
$jssh->datetime=$_POST['datetime'];
$jssh->save();
alert('提交成功！');
redirect('jssh_list.php');
?>