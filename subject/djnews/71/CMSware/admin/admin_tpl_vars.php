<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_tpl_vars');

}
require_once INCLUDE_PATH.'admin/TplVarsAdmin.class.php';
$tpl_vars = new TplVarsAdmin();

switch($IN['o']) {

	case 'view':
		$TPL->assign('List', $tpl_vars->getAll());
		$TPL->display("tpl_vars_view.html");
		break;

	case 'add':
		$TPL->assign('NODE_LIST', $NODE_LIST);
		$TPL->display("tpl_vars_add.html");
		break;

	case 'add_submit':
 		$tpl_vars->flushData();
		$tpl_vars->filterData($IN);

		if(!empty($IN[NodeIDs])) {
			foreach($IN[NodeIDs] as $key=>$var) {

				if(!empty($IN[SubNodeIDs]) && in_array($var, $IN[SubNodeIDs])) continue;
				else {
					$NodeIDs .= ','.$var;
				
				}
			}
		
		}

		if(!empty($IN[SubNodeIDs])) {
			foreach($IN[SubNodeIDs] as $key=>$var) {
				if($key ==0) {
					$SubNodeIDs = 'all-'.$var;
				} else {
					$SubNodeIDs .= 'all-'.$var.",";
				
				}
			
			}
		
		
		}

 		$tpl_vars->addData('NodeScope', $SubNodeIDs.$NodeIDs);


		if($tpl_vars->add()) { 

			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;

			goto("view", 'add_tpl_vars_ok');
		} else	
			goto("view", 'add_tpl_vars_fail');
		break;

	case 'edit':
		if(!empty($IN[Id])) {
			$TPL->assign('NODE_LIST', $NODE_LIST);
			$Info = $tpl_vars->getInfo($IN[Id]);
 			$TPL->assign('Info', $Info);
			$TPL->display("tpl_vars_edit.html");
	
		} else
			goto('view');

		break;

	case 'edit_submit':
		if(empty($IN[Id])) goto('view');
 
 		$tpl_vars->flushData();
		$tpl_vars->filterData($IN);

		if(!empty($IN[NodeIDs])) {
			foreach($IN[NodeIDs] as $key=>$var) {

				if(!empty($IN[SubNodeIDs]) && in_array($var, $IN[SubNodeIDs])) continue;
				else {
					$NodeIDs .= ','.$var;
				
				}
			}
		
		}

		if(!empty($IN[SubNodeIDs])) {
			foreach($IN[SubNodeIDs] as $key=>$var) {
				if($key ==0) {
					$SubNodeIDs = 'all-'.$var;
				} else {
					$SubNodeIDs .= 'all-'.$var.",";
				
				}
			
			}
		
		
		}

 		$tpl_vars->addData('NodeScope', $SubNodeIDs.$NodeIDs);

		if($tpl_vars->update($IN[Id])) { 
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			goto("view", 'edit_tpl_vars_ok');
		} else	
			goto("view", 'edit_tpl_vars_fail');

	 

		break;


	case 'del':
		if(empty($IN[Id])) goto('view');
			if($tpl_vars->del($IN[Id])) {
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("view", 'del_tpl_vars_ok');		
			} else
				goto("view", 'del_tpl_vars_fail');

	
		break;
}

	
include MODULES_DIR.'footer.php' ;

?>
