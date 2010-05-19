<?php
require_once('frame.php');
$db=get_db();
$ret = $db->query("show slave status");
$db->move_first();
#var_dump($ret);
$io_status =  $db->field_by_index(10);
$sql_status = $db->field_by_index(11);
$syn_status = $io_status == 'Yes' &&  $sql_status == 'Yes';
#var_dump($db);
#send_sms('13482678134','东方时代');
?>