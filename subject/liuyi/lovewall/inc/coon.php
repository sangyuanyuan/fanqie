<?php
$db = mysql_connect('172.27.203.80','root','xunao');
mysql_query("set names'utf8'");
if(!@mysql_select_db("smg_new",$db)) { die("没有找到网站"); }
?>