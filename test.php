<?php
require_once('frame.php');
$db=get_db();
$sql="select * from smg_user where password=''";
$up=$db->query($sql);
for($i=0;$i<count($up);$i++)
{
	$sql="update smg_user set password=(select distinct(password) from smg_user_real where loginname='".$up[$i]->name."') where name='".$up[$i]->name."'";
	$db->execute($sql);	
}
?>
