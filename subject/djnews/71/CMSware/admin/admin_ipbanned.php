<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_ipbanned');

}

 require_once INCLUDE_PATH."admin/ipbannedAdmin.class.php";
 
$ip = new ipbannedAdmin();

switch($IN[o]) {

	case 'list':
		$offset = empty( $IN['offset']) ?  15 : $IN['offset'];
		$num= $ip->getRecordNum();

		$pagenum=ceil($num/$offset);
		if(empty($IN[Page]))
			$Page = 1;
		else
			$Page = $IN[Page];

		$start=($Page-1)*$offset;
			
		$recordInfo[currentPage] = $Page;
		$recordInfo[pageNum] = $pagenum;
		$recordInfo[recordNum] = $num;
		$recordInfo[offset] = $offset;
		$recordInfo[from] = $start;
		$recordInfo[to] = $start+$offset;

			$hour = date("H");
			for($i=0;$i<=24;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $hour)
						$output_hour .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_hour .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $hour)
						$output_hour .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_hour .= "<option value=\"$i\">$i</option>";
					
				}
			}
			$minute = date("i");
			for($i=0;$i<=60;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $minute)
						$output_minute  .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_minute  .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $minute)
						$output_minute  .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_minute  .= "<option value=\"$i\">$i</option>";
					
				}
			}

			$second = date("s");
			for($i=0;$i<=60;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $second)
						$output_second  .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_second  .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $second)
						$output_second  .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_second  .= "<option value=\"$i\">$i</option>";
					
				}
			}
			
		
		
		
		
		$TPL->assign("pList",  $ip->getRecordLimit($start, $offset));
		$TPL->assign("recordInfo", $recordInfo);
		$TPL->assign("NodeInfo", $NodeInfo);
		$TPL->assign("offset", $offset);
			
		$TPL->assign("pagelist",pagelist($pagenum,$Page,$base_url."o=list&offset={$offset}",'#000000'));
		$TPL->display('ipbanned_list.html');
		break;
	case 'add_submit':
		if(!empty($IN['IP'])) {
			$ip->flushData();
			$ip->addData('IP', $IN[IP]);
			$ip->addData('ExpireTime', strtotime($IN[year].' '.$IN[hour].':'.$IN[minute].':'.$IN[second]));
			$ip->addData('Reason', $IN[Reason]);
 

			if($ip->add()) 
				showmessage('add_block_ip_ok', $referer);
			else
				showmessage('add_block_ip_fail', $referer);
		
		} else {
			showmessage('add_block_ip_null', $referer);

		}
		break;
	case 'del':
		if(!empty($IN['Id'])) {

			if($ip->del($IN['Id'])) 
				showmessage('del_block_ip_ok', $referer);
			else
				showmessage('del_block_ip_fail', $referer);
		
		} else {
			showmessage('del_block_ip_null', $referer);

		}
		break;


}

	
include MODULES_DIR.'footer.php' ;



?>
