<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_publishAccess');

}

require_once INCLUDE_PATH."admin/publishAccessAdmin.class.php";

$pubAccess = new publishAccessAdmin();

switch($IN[o]) {

	case 'view':
		$TPL->assign('pInfo', $pubAccess->getAll());
		$TPL->display("publishaccess_view.html");
		break;

	case 'add':
		$TPL->assign('cInfo', $CATE_LIST);
		$TPL->display("publishaccess_add.html");
		break;

	case 'add_submit':
		$pubAccess->flushData();
		$pubAccess->addData("pName", $IN[pName]);
		$pubAccess->addData("pInfo", $IN[pInfo]);
		$pubAccess->addData("comment",'['.$IN[comment_submit].',]');
		$pubAccess->addData("view",'['.$IN[view_submit].',]');
		$pubAccess->addData("grade", '['.$IN[grade_submit].',]');
		$pubAccess->addData("print", '['.$IN[print_submit].',]');
		$pubAccess->addData("mail", '['.$IN[mail_submit].',]');
		$pubAccess->addData("cate", '['.$IN[cate_submit].',]');
		$pubAccess->addData("search", '['.$IN[search_submit].',]');
		$pubAccess->addData("contribute", '['.$IN[contribute_submit].',]');
		if($pubAccess->add()) { 
			goto("view", 'add_publishaccess_ok');

		} else {
			goto("view", 'add_publishaccess_fail');
		
		}

		break;

	case 'edit':
		if(empty($IN[pId])) goto('view');

		$TPL->assign('pInfo', $pubAccess->getInfo($IN[pId]));
		$TPL->assign('cInfo', $CATE_LIST);
		$TPL->display("publishaccess_edit.html");
		break;

	case 'edit_submit':
		if(empty($IN[pId])) goto('view');

		$pubAccess->flushData();
		$pubAccess->addData("pName", $IN[pName]);
		$pubAccess->addData("pInfo", $IN[pInfo]);
		$pubAccess->addData("comment",'['.$IN[comment_submit].',]');
		$pubAccess->addData("view",'['.$IN[view_submit].',]');
		$pubAccess->addData("grade", '['.$IN[grade_submit].',]');
		$pubAccess->addData("print", '['.$IN[print_submit].',]');
		$pubAccess->addData("mail", '['.$IN[mail_submit].',]');
		$pubAccess->addData("cate", '['.$IN[cate_submit].',]');
		$pubAccess->addData("search", '['.$IN[search_submit].',]');
		$pubAccess->addData("contribute", '['.$IN[contribute_submit].',]');
		if($pubAccess->update($IN[pId])) { 
			goto("view", 'edit_publishaccess_ok');

		} else {
			goto("view", 'edit_publishaccess_fail');
		
		}

		break;

	case 'del':
		if(empty($IN[pId])) goto('view');
		if($pubAccess->del($IN[pId])) {
			goto("view", 'del_publishaccess_ok');
			
		} else
			goto("view", 'del_publishaccess_fail');
		
		break;


}

	
include('./modules/footer.php');

?>
