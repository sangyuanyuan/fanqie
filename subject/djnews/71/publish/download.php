<?php
require_once "common.php";
require_once ROOT_PATH."plugins/base/plugin.config.php";
require_once ROOT_INCLUDE_PATH."kDate.class.php";
require_once "download.config.php";


$ClientInfo = parse_url($_SERVER[HTTP_REFERER]);
$url = $IN['url'];
if(_Protect_Link && $ClientInfo[host] != _Domain) {
	die($_DIE_INFO);

}

if(empty($IN['id']) && empty($IN['IndexID']) && empty($IN['Id'])) {
	die('IndexID empty');
} else {
	$IndexID = $Id = empty($IN['id']) ? (empty($IN['IndexID']) ? $IN['Id'] : $IN['IndexID']) : $IN['id'];
}
$table_count =  &$plugin_table['base']['count'];

$result = $db->getRow("SELECT Download,LocalUpload  FROM $table_download  where IndexID='$IndexID'");
$result['Download']= str_replace("\r\n", "\n",  $result['Download']);
$result['Download'] = str_replace("\r", "\n", $result['Download']);
$urls = explode("\n", $result['Download']);
$urls['local'] = $result['LocalUpload'];

$result = $db->getRow("SELECT Hits_Date  FROM $table_count  where IndexID='$IndexID'");
$Hits_Date = $result['Hits_Date'];

if(kDate::InToday($Hits_Date)) {
	$db->query("UPDATE $table_count Set `Hits_Today`=Hits_Today+1 where IndexID='$IndexID'"); //本日计数

} else {
	$db->query("UPDATE $table_count Set `Hits_Today`=1 where IndexID='$IndexID'"); //本日计数

}

if(kDate::InWeek($Hits_Date)) {
	$db->query("UPDATE $table_count Set `Hits_Week`=Hits_Week+1 where IndexID='$IndexID'"); //本周计数
} else {
	$db->query("UPDATE $table_count Set `Hits_Week`=1 where IndexID='$IndexID'"); //本周计数
}

if(kDate::InMonth($Hits_Date)) {
	$db->query("UPDATE $table_count Set `Hits_Month`=Hits_Month+1 where IndexID='$IndexID'"); //本月计数

} else {
	$db->query("UPDATE $table_count Set `Hits_Month`=1 where IndexID='$IndexID'"); //本月计数

}


$db->query("UPDATE $table_count Set `Hits_Total`=Hits_Total+1 where IndexID='$IndexID'"); //总计数

$db->query("UPDATE $table_count Set `Hits_Date`='".time()."' where IndexID='$IndexID'"); //更新时间

$db->close();
header("Location:".$urls[$url]);
	


?>
