<?php
/*
计数器使用方法:

[计数显示]
本日计数显示:{url}/publish/counter.php?o=display&type=today&IndexID=2
本周计数显示:{url}/publish/counter.php?o=display&type=week&IndexID=2
本月计数显示:{url}/publish/counter.php?o=display&type=month&IndexID=2
总计数显示:{url}/publish/counter.php?o=display&IndexID=2或者{url}/publish/counter.php?o=display&type=total&IndexID=2

[计数器]
{url}/publish/counter.php?IndexID=2

[计数器+显示]
{url}/publish/counter.php?o=display_counter&IndexID=2
*/
require_once "common.php";
require_once SYS_PATH."plugins/base/plugin.config.php";
require_once INCLUDE_PATH."kDate.class.php";

if(empty($IN['id']) && empty($IN['IndexID']) && empty($IN['Id'])) {
	die('IndexID empty');
} else {
	$IndexID = $Id = empty($IN['id']) ? (empty($IN['IndexID']) ? $IN['Id'] : $IN['IndexID']) : $IN['id'];
}
$table_count =  &$plugin_table['base']['count'];

$row = $db->getRow("SELECT *  FROM $table_count  where IndexID='$Id'");
$Hits_Date = &$row['Hits_Date'];
$Hits = &$row[Hits_Total];




if($IN['o'] == 'display') {
	switch($IN['type']) {
		case 'today':
			echo "document.write(\"{$row['Hits_Today']}\");";
			break;
		case 'week':
			echo "document.write(\"{$row['Hits_Week']}\");";
			break;
		case 'month':
			echo "document.write(\"{$row['Hits_Month']}\");";
			break;
		case 'total':
		default:
			echo "document.write(\"{$row['Hits_Total']}\");";
			break;

	}

} elseif($IN['o'] == 'display_counter') {
	switch($IN['type']) {
		case 'today':
			echo "document.write(\"{$row['Hits_Today']}\");";
			break;
		case 'week':
			echo "document.write(\"{$row['Hits_Week']}\");";
			break;
		case 'month':
			echo "document.write(\"{$row['Hits_Month']}\");";
			break;
		case 'total':
		default:
			echo "document.write(\"{$row['Hits_Total']}\");";
			break;

	}

	if(kDate::InToday($Hits_Date)) {
		$db->query("UPDATE $table_count Set `Hits_Today`=Hits_Today+1 where IndexID='$Id'"); //本日计数

	} else {
		$db->query("UPDATE $table_count Set `Hits_Today`=1 where IndexID='$Id'"); //本日计数

	}

	if(kDate::InWeek($Hits_Date)) {
		$db->query("UPDATE $table_count Set `Hits_Week`=Hits_Week+1 where IndexID='$Id'"); //本周计数
	} else {
		$db->query("UPDATE $table_count Set `Hits_Week`=1 where IndexID='$Id'"); //本周计数
	}

	if(kDate::InMonth($Hits_Date)) {
		$db->query("UPDATE $table_count Set `Hits_Month`=Hits_Month+1 where IndexID='$Id'"); //本月计数

	} else {
		$db->query("UPDATE $table_count Set `Hits_Month`=1 where IndexID='$Id'"); //本月计数

	}


	$db->query("UPDATE $table_count Set `Hits_Total`=Hits_Total+1 where IndexID='$Id'"); //总计数
	$db->query("UPDATE $table_count Set `Hits_Date`='".time()."' where IndexID='$Id'"); //更新时间
	$db->close();
} else {
	if(kDate::InToday($Hits_Date)) {
		$db->query("UPDATE $table_count Set `Hits_Today`=Hits_Today+1 where IndexID='$Id'"); //本日计数

	} else {
		$db->query("UPDATE $table_count Set `Hits_Today`=1 where IndexID='$Id'"); //本日计数

	}

	if(kDate::InWeek($Hits_Date)) {
		$db->query("UPDATE $table_count Set `Hits_Week`=Hits_Week+1 where IndexID='$Id'"); //本周计数
	} else {
		$db->query("UPDATE $table_count Set `Hits_Week`=1 where IndexID='$Id'"); //本周计数
	}

	if(kDate::InMonth($Hits_Date)) {
		$db->query("UPDATE $table_count Set `Hits_Month`=Hits_Month+1 where IndexID='$Id'"); //本月计数

	} else {
		$db->query("UPDATE $table_count Set `Hits_Month`=1 where IndexID='$Id'"); //本月计数

	}


	$db->query("UPDATE $table_count Set `Hits_Total`=Hits_Total+1 where IndexID='$Id'"); //总计数
	$db->query("UPDATE $table_count Set `Hits_Date`='".time()."' where IndexID='$Id'"); //更新时间
	$db->close();

}




?>
