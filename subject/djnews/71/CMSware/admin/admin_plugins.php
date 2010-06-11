<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_plugins');

}
require_once INCLUDE_PATH.'admin/plugins_admin.class.php';
require_once INCLUDE_PATH."admin/groupAdmin.class.php";
require_once INCLUDE_PATH."admin/userAdmin.class.php";
function getPluginsList()
{
		$dir=dir(SYS_PATH.'plugins');
		$dir->rewind();
		while($file=$dir->read()) {
			if( $file=="." || $file=="..") {
				continue;
			} elseif( is_dir(SYS_PATH.'plugins/'. $file)) {
				$dirlist[] = $file;			
			}else {
				continue;
			}
			
		}
		$dir->close();
		return $dirlist;	
}

$plugins = new PluginsAdmin();

switch($IN['o']) {

	case 'view':
		$TPL->assign('pList', $plugins->getAll());
		$TPL->display("plugins_view.html");
		break;

	case 'add':

		$TPL->assign('User', userAdmin::getAll());
		$TPL->assign('Group', groupAdmin::getAll());
		$TPL->assign('pList', getPluginsList());
		$TPL->display("plugins_add.html");
		break;

	case 'add_submit':
		$plugins->flushData();
		$plugins->addData("pName",$IN[pName]);
		$plugins->addData("Path",$IN[Path]);
		$plugins->addData("LicenseKey",$IN[LicenseKey]);
		$plugins->addData("Info",$IN[Info]);

		if(!empty($IN['AccessUser'])) {
			foreach($IN['AccessUser'] as $key=>$var) {
					$AccessUser .= ','.$var;
			}

			$AccessUser = '['.$AccessUser.',]';
			$plugins->addData("AccessUser",$AccessUser);
		}

		if(!empty($IN['AccessGroup'])) {
			foreach($IN['AccessGroup'] as $key=>$var) {
					$AccessGroup .= ','.$var;
			}

			$AccessGroup = '['.$AccessGroup.',]';
			$plugins->addData("AccessGroup",$AccessGroup);
		}

		if($plugins->add()) { 
			execJS("top.panelHeader.sp_isRefash = true;");
			execJS("top.panelHeader.location.reload();");
			showmessage('add_plugins_ok', $base_url."o=view");
		} else	
			showmessage('add_plugins_fail', $referer);


		
				

		break;

	case 'edit':
		if(!empty($IN[pId])) {
			$TPL->assign('User', userAdmin::getAll());
			$TPL->assign('Group', groupAdmin::getAll());
			$TPL->assign('pList', getPluginsList());
			$pluginsInfo = $plugins->getInfo($IN[pId]);
			$TPL->assign('pInfo', $pluginsInfo);
			$TPL->display("plugins_edit.html");
	
		} else
			goto('view');

		break;

	case 'edit_submit':
		if(empty($IN[pId])) goto('view');
 
		if(!empty($IN[pName])) {
			$plugins->flushData();
			$plugins->addData("pName",$IN[pName]);
			$plugins->addData("Path",$IN[Path]);
			$plugins->addData("Info",$IN[Info]);
			$plugins->addData("LicenseKey",$IN[LicenseKey]);

			if(!empty($IN['AccessUser'])) {
				foreach($IN['AccessUser'] as $key=>$var) {
						$AccessUser .= ','.$var;
				}

				$AccessUser = '['.$AccessUser.',]';
				$plugins->addData("AccessUser",$AccessUser);
			}

			if(!empty($IN['AccessGroup'])) {
				foreach($IN['AccessGroup'] as $key=>$var) {
						$AccessGroup .= ','.$var;
				}

				$AccessGroup = '['.$AccessGroup.',]';
				$plugins->addData("AccessGroup",$AccessGroup);
			}

			
			if($plugins->update($IN[pId])) { 
				execJS("top.panelHeader.sp_isRefash = true;");
				execJS("top.panelHeader.location.reload();");

				showmessage('edit_plugins_ok', $base_url."o=view");
			} else	
				showmessage('edit_plugins_fail', $referer);

		}

		break;


	case 'del':
		if(empty($IN[pId])) goto('view');
			if($plugins->del($IN[pId])) {
				execJS("top.panelHeader.sp_isRefash = true;");
				execJS("top.panelHeader.location.reload();");

				showmessage('del_plugins_ok', $base_url."o=view");
			} else
				showmessage('del_plugins_fail', $referer);

	
		break;


}

	
include MODULES_DIR.'footer.php' ;

?>
