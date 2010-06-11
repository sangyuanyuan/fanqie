<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_keywords');

}
require_once INCLUDE_PATH."admin/keywordsAdmin.class.php";

$keywords = new keywordsAdmin();
switch($IN[o]) {
	case 'view':
		$offset = 15;
		$num= $keywords->getRecordNum();

		$pagenum=ceil($num/$offset);
		if(empty($IN[Page]))
			$Page = 1;
		else
			$Page = $IN[Page];

		$start=($Page-1)*$offset;

		$TPL->assign("_keywords",$keywords->getLimit($start, $offset));

		$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=view",'#000000'));
		$TPL->display('admin_keywords.html');
		
		break;

	case 'add':
 		$TPL->assign('NODE_LIST', $NODE_LIST);
		$TPL->display('keywords_add.html');

		break;
	case 'add_submit':
		$keywords->flushData();
		$keywords->addData("keyword", $IN[keyword]);
		$keywords->addData("kReplace", $IN[kReplace]);
		$keywords->addData("IsGlobal", $IN[IsGlobal]);
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

 		$keywords->addData('NodeScope', $SubNodeIDs.$NodeIDs);
		
		
		if($keywords->add()) {
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			goto('view', 'add_keywords_ok');
		
		} else
			goto('view', 'add_keywords_fail');

		break;
	case 'edit':
		if(empty($IN[kId])) goto('view');

 		$TPL->assign('NODE_LIST', $NODE_LIST);
		$TPL->assign('kInfo', $keywords->getInfo($IN[kId]));
		$TPL->display('keywords_edit.html');

		break;
	case 'edit_submit':
		if(empty($IN[kId])) goto('view');

		$keywords->flushData();
		$keywords->addData("keyword", $IN[keyword]);
		$keywords->addData("kReplace", $IN[kReplace]);
		$keywords->addData("IsGlobal", $IN[IsGlobal]);

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

 		$keywords->addData('NodeScope', $SubNodeIDs.$NodeIDs);

		if($keywords->update($IN[kId])) {
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			goto('view', 'edit_keywords_ok');
		
		} else
			goto('view', 'edit_keywords_fail');
		break;
	case 'del':
		if(empty($IN[kId])) goto('view');

		if($keywords->del($IN[kId])) {
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			goto("view", 'del_keywords_ok');
		
		} else
			goto("view", 'del_keywords_fail');


}

include MODULES_DIR.'footer.php' ;
?>
