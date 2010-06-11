<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_dsn');

}


$dsn = new dsn_admin();

switch($IN['o']) {

	case 'view':
		$TPL->assign('dsnList', $dsn->getAllDSN());
		$TPL->display("dsn_view.html");
		break;

	case 'add':
		$TPL->assign('db_config', $db_config);
		$TPL->display("dsn_add.html");
		break;

	case 'add_submit':
		if(!empty($IN[Name])) {
			$dsn->flushData();
			$dsn->addData("Name",$IN[Name]);
			//$dsn->addData("dbHost",$IN[dbHost]);
			//$dsn->addData("dbUser",$IN[dbUser]);
			//$dsn->addData("dbPass",$IN[dbPass]);
			$dsn->addData("dbName",$IN[dbName]);

		}

		if($dsn->add()) { 
			//$cache = new CacheData();
			//$cache->makeCache('dsn');
			//$iWPC->clearALLNodeInfo();

			goto("view", 'add_dsn_ok');
		} else	
			goto("view", 'add_dsn_fail');


		
				

		break;

	case 'edit':
		if(!empty($IN[DSNID])) {
			$dsnInfo = $dsn->getDSNInfo($IN[DSNID]);
			$TPL->assign('db_config', $db_config);
			$TPL->assign('dsnInfo', $dsnInfo);
			$TPL->display("dsn_edit.html");
	
		} else
			goto('view');

		break;

	case 'edit_submit':
		if(empty($IN[DSNID])) goto('view');
 
		if(!empty($IN[Name])) {
			$dsn->flushData();
			$dsn->addData("Name",$IN[Name]);
			//$dsn->addData("dbHost",$IN[dbHost]);
			//$dsn->addData("dbUser",$IN[dbUser]);
			//$dsn->addData("dbPass",$IN[dbPass]);
			$dsn->addData("dbName",$IN[dbName]);
			if($dsn->update($IN[DSNID])) { 
				//$cache = new CacheData();
				//$cache->makeCache('dsn');
				//$iWPC->clearALLNodeInfo();
				goto("view", 'edit_dsn_ok');
			} else	
				goto("view", 'edit_dsn_fail');

		}

		break;


	case 'del':
		if(empty($IN[DSNID])) goto('view');
			if($dsn->del($IN[DSNID])) {
				//$cache = new CacheData();
				//$cache->makeCache('dsn');
				//$iWPC->clearALLNodeInfo();
				goto("view", 'del_dsn_ok');		
			} else
				goto("view", 'del_dsn_fail');

	
		break;
	case 'detect':

		$params = array(
			'db_driver'=> 'db',	 
			'db_type'=> 'mysql',
			'db_host'=> $IN[dbHost],
			'db_user'=> $IN[dbUser],
			'db_password'=> $IN[dbPass],
			'db_name'=> $IN[dbName],
	
		);
		//print_r($params);
		if($dsn->detect($params)) {
			exit('1');		
		} else
			exit('0');
		break;

}

	
include MODULES_DIR.'footer.php' ;

?>
