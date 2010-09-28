<?php
require_once 'common.php';

/*
if(!$sys->isAdmin()) {
	goback('access_deny_module_user');

}
*/
require_once INCLUDE_PATH."admin/groupAdmin.class.php";
require_once INCLUDE_PATH."admin/userAdmin.class.php";
 
$user = new userAdmin();
$user->PermissionDetector($IN);
$group = new groupAdmin();

 
switch($IN[o]) {

	case 'view':

		$TPL->assign('uInfo', $user->getAllByPermission());
		$TPL->display("user_view.html");
		break;

	case 'add':
		$TPL->assign('gInfo', $group->getAllByPermissionAdmin());
		$TPL->display("user_add.html");
		break;

	case 'add_submit':
		$user->flushData();
		$user->addData("uName", $IN[uName]);
		$user->addData("uInfo", $IN[uInfo]);
		$user->addData("uPass", md5($IN[uPass]));
		$user->addData("uGId", $IN[uGId]);
		
		/*$user_extra->flushData();
		$user_extra->addData("gender", $IN[gender]);
		$user_extra->addData("location", $IN[location]);
		$user_extra->addData("bday", $IN[year].'-'.$IN[month].'-'.$IN[day]);
		$user_extra->addData("homepage", $IN[homepage]);
		$user_extra->addData("qq", $IN[qq]);
		$user_extra->addData("icq", $IN[icq]);
		$user_extra->addData("msn", $IN[msn]);
		$user_extra->addData("email", $IN[email]);
		$user_extra->addData("about", $IN[about]);
		*/
		if($user->userExist($IN[uName])) {
			goback('add_user_fail_username_exists');
		
		}
		if($user->add()) { 
			//$user_extra->addData("uId", $user->db_insert_id);
			//$user_extra->add();
			goto("view", 'add_user_ok');

		} else {
			goto("view", 'add_user_fail');
		
		}

		break;

	case 'edit':
		if(empty($IN[uId])) goto('view');
		$data = $user->getInfo($IN[uId]);

		/*for($i=1;$i<=12;$i++) {
			if($i == $data[month]) 
				$month.="<option value='$i' selected>$i</option>";
			else
				$month.="<option value='$i' >$i</option>";
		}
		$TPL->assign('month', $month);

		for($i=1;$i<=31;$i++) {
			if($i == $data[day]) 
				$day.="<option value='$i' selected>$i</option>";
			else
				$day.="<option value='$i' >$i</option>";
		}
		$TPL->assign('day', $day);
		*/
		$TPL->assign('uInfo', $data);
 		$TPL->assign('gInfo', $group->getAllByPermissionAdmin());
		$TPL->display("user_edit.html");
		break;

	case 'edit_submit':
		if(empty($IN[uId])) goto('view');

		$user->flushData();
		$user->addData("uName", $IN[uName]);
		$user->addData("uInfo", $IN[uInfo]);

		if(!empty($IN[uPass]))
			$user->addData("uPass", md5($IN[uPass]));

		$user->addData("uGId", $IN[uGId]);
		/*
		$user_extra->flushData();
		$user_extra->addData("gender", $IN[gender]);
		$user_extra->addData("location", $IN[location]);
		$user_extra->addData("bday", $IN[year].'-'.$IN[month].'-'.$IN[day]);
		$user_extra->addData("homepage", $IN[homepage]);
		$user_extra->addData("qq", $IN[qq]);
		$user_extra->addData("icq", $IN[icq]);
		$user_extra->addData("msn", $IN[msn]);
		$user_extra->addData("email", $IN[email]);
		$user_extra->addData("about", $IN[about]);*/

		if($user->update($IN[uId])) { 
			// && $user_extra->update($IN[uId])
			goto("view", 'edit_user_ok');

		} else {
			goto("view", 'edit_user_fail');
		
		}


		break;

	case 'del':
		if(empty($IN[uId])) goto('view');
		if($user->del($IN[uId])) {
			 //&& $user_extra->del($IN[uId])
			goto("view", 'del_user_ok');
			
		} else
			goto("view", 'del_user_fail');
		
		break;

	case 'stat':
		$info = $user->getAll();
		foreach($info as $key=>$var) {
			$info[$key][TotalNum] = $info[$key][ApproveNum] + $info[$key][ContributionNum] + $info[$key][CallBackNum] + $info[$key][NoContributionNum];
		}
		$TPL->assign('uInfo', $info);
		$TPL->display("user_stat.html");
		break;

}

	
include MODULES_DIR.'footer.php' ;



?>
