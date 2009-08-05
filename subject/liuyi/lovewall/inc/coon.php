<?php
$db = mysql_connect('172.27.203.82','root','xunao');
mysql_query("set names'utf8'");
if(!@mysql_select_db("smg_new",$db)) { die("��ݿ�t��ʧ��"); }
?>