<?php
$link=mysql_connect('172.27.203.80','root','xunao');
if(!$link) echo "fail";
else echo "success";
mysql_close();
?>