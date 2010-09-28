<?php
require_once 'common.php';

require('../license.php');
$license_array = $License;
unset($License);
if($license_array['Module-PublishAuth']!=1)
		goback('license_Module_PublishAuth_disabled');

if(!$sys->isAdmin()) {
	goback('access_deny_module_publishAuth');

}

require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."admin/site_admin.class.php";




 

$pubAuth = new publishAuthAdmin();
$site = new site_admin();

switch($IN[o]) {

	case 'view':
		$TPL->assign('pInfo', $pubAuth->getAll());
		$TPL->display("publishauth_view.html");
		break;

	case 'add':
/*浏览 附带发布 设置 

查看  编辑 发布 审核

（添加 复制 转移 删除 创建虚链接） 本来就是可以用一个编辑权限来概括*/

		$TPL->assign('NodeInfo', $site->getAll4Tree());
		$TPL->display("publishauth_add.html");
		break;

	case 'add_submit':
		//debug($IN);
		$pubAuth->flushData();
		$pubAuth->addData("pName", $IN[pName]);
		$pubAuth->addData("pInfo", $IN[pInfo]);
		$pubAuth->addData("NodeList",'['.$IN[node_list_submit].',]');
		$pubAuth->addData("NodeExtraPublish",'['.$IN[node_extracontent_submit].',]');
		$pubAuth->addData("NodeSetting", '['.$IN[node_set_submit].',]');
		$pubAuth->addData("ContentRead", '['.$IN[content_read_submit].',]');
		$pubAuth->addData("ContentWrite", '['.$IN[content_write_submit].',]');
		$pubAuth->addData("ContentApprove", '['.$IN[content_approve_submit].',]');
		$pubAuth->addData("ContentPublish", '['.$IN[content_publish_submit].',]');
		$pubAuth->addData("AuthInherit", '['.$IN[auth_inherit_submit].',]');
		if($pubAuth->add()) { 
			goto("view", 'add_publishadmin_ok');

		} else {
			goto("view", 'add_publishadmin_fail');
		
		}

		break;

	case 'edit':
		if(empty($IN[pId])) goto('view');

		$TPL->assign('pInfo', $pubAuth->getInfo($IN[pId]));
		$TPL->assign('NodeInfo', $site->getAll4Tree());
		$TPL->display("publishauth_edit.html");
		break;

	case 'edit_submit':
		if(empty($IN[pId])) goto('view');

		$pubAuth->flushData();
		$pubAuth->flushData();
		$pubAuth->addData("pName", $IN[pName]);
		$pubAuth->addData("pInfo", $IN[pInfo]);
		$pubAuth->addData("NodeList",'['.$IN[node_list_submit].',]');
		$pubAuth->addData("NodeExtraPublish",'['.$IN[node_extrapublish_submit].',]');
		$pubAuth->addData("NodeSetting", '['.$IN[node_set_submit].',]');
		$pubAuth->addData("ContentRead", '['.$IN[content_read_submit].',]');
		$pubAuth->addData("ContentWrite", '['.$IN[content_write_submit].',]');
		$pubAuth->addData("ContentApprove", '['.$IN[content_approve_submit].',]');
		$pubAuth->addData("ContentPublish", '['.$IN[content_publish_submit].',]');
		$pubAuth->addData("AuthInherit", '['.$IN[auth_inherit_submit].',]');
		//debug($IN);
		if($pubAuth->update($IN[pId])) { 
			goto("view", 'edit_publishadmin_ok');

		} else {
			goto("view", 'edit_publishadmin_fail');
		
		}

		break;

	case 'del':
		if(empty($IN[pId])) goto('view');
		if($pubAuth->del($IN[pId])) {
			goto("view", 'del_publishadmin_ok');
			
		} else
			goto("view", 'del_publishadmin_fail');
		
		break;


}

	
include('./modules/footer.php');

?>
