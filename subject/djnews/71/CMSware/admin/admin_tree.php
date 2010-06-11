<?php
require_once 'common.php';
require_once INCLUDE_PATH."admin/site_admin.class.php";
require_once INCLUDE_PATH."admin/contribution_admin.class.php";
require_once INCLUDE_PATH."admin/collection_cate_admin.class.php";
require_once INCLUDE_PATH."admin/collection_admin.class.php";


$site = new site_admin();
switch($IN[o]) {
	case 'publish':
		$NodeInfo = $site->getAll4Tree();
		//debug($NodeInfo);

		if($SYS_ENV['DisplayPublishCount']) {
			if(!empty($NodeInfo)) {
				foreach($NodeInfo as $key=>$var) {
					if(!empty($var['NodeID'])) {
 						$NInfo = $iWPC->loadNodeInfo($var['NodeID']);
						$NodeInfo[$key][contributionNum] = contributionAdmin::getContributionRecordNum($NInfo, '1') ;
						$NodeInfo[$key][unpublishNum] = contributionAdmin::getPublishRecordNum($NInfo,'=0');
						if(!empty($NodeInfo[$key][contributionNum]) || !empty($NodeInfo[$key][unpublishNum]))
							$NodeInfo[$key][Stats_Num] = "(".$NodeInfo[$key][unpublishNum]."/".$NodeInfo[$key][contributionNum].")";
						}					
					}

			
			}		
			 
		}

		$TPL->assign('NodeInfo', $NodeInfo);
		$TPL->assign_by_ref('DisplayNodeID', $SYS_ENV[DisplayNodeID]);
		$TPL->display('tree_publish.html');
		break;
	case 'publish_xml':
		if(!empty($IN[NodeID])) {
			$NodeInfo = $site->getAll4Tree($IN[NodeID]);
			if($SYS_ENV['DisplayPublishCount']) {
				foreach($NodeInfo as $key=>$var) {
					$NInfo = $iWPC->loadNodeInfo($var[NodeID]);
					$NodeInfo[$key][contributionNum] = contributionAdmin::getContributionRecordNum($NInfo, '1') ;
					$NodeInfo[$key][unpublishNum] = contributionAdmin::getPublishRecordNum($NInfo,'=0');
					if(!empty($NodeInfo[$key][contributionNum]) || !empty($NodeInfo[$key][unpublishNum]))
						$NodeInfo[$key][Stats_Num] = "(".$NodeInfo[$key][unpublishNum]."/".$NodeInfo[$key][contributionNum].")";
					
					
				}

			}
			$TPL->assign('NodeInfo', $NodeInfo);
			$TPL->assign_by_ref('DisplayNodeID', $SYS_ENV[DisplayNodeID]);
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);

			$TPL->display('publish_xml.xml');
		} else {
	
		}
		break;
	case 'publishauth_xml':
		if(!empty($IN[NodeID])) {
			require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
			$pubAuth = new publishAuthAdmin();
			$TPL->assign('pInfo', $pubAuth->getInfo($IN[pId]));
			$TPL->assign('NodeInfo', $site->getAll4Tree($IN[NodeID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('publishauth_xml.xml');
		} else {
	
		}
		break;
	case 'tpl':
		header("Location: admin_tpl.php?sId={$sys->sId}&o=tree");
		break;

	case 'site':
		$TPL->assign('NodeInfo', $site->getAll4Tree());
		$TPL->display('tree_site.html');
		break;
		break;
	case 'site_xml':
		if(!empty($IN[NodeID])) {
			$TPL->assign('NodeInfo', $site->getAll4Tree($IN[NodeID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			
			$TPL->display('site_xml.xml');
		} else {
	
		}
		break;

	case 'common':
		$TPL->assign('param', $IN['param']);
		$TPL->assign('url', $IN['url']);
		$TPL->assign('NodeInfo', $site->getAll4Tree());
		$TPL->display('tree_common.html');
		break;
		break;
	case 'common_xml':
		if(!empty($IN[NodeID])) {
			$TPL->assign('param', str_replace('**', '::' , $IN['param']));
			$TPL->assign('url', $IN['url']);
			$TPL->assign('NodeInfo', $site->getAll4Tree($IN[NodeID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
 		    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			
			$TPL->display('common_xml.xml');
		} 
		break;

	case 'node_select':
		$TPL->assign('NodeInfo', $site->getAll4Tree());
		$TPL->display('tree_node_select.html');
		break;
	case 'node_select_xml':
		if(!empty($IN[NodeID])) {
			$TPL->assign('NodeInfo', $site->getAll4Tree($IN[NodeID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('node_select_xml.xml');
		} else {
	
		}
		break;
	case 'contribution':
		contributionAdmin::isValid();
		$NodeInfo = $site->getAll4Tree();

		if($SYS_ENV['DisplayPublishCount']) {
			if(!empty($NodeInfo)) {
				foreach($NodeInfo as $key=>$var) {
					$NInfo = $iWPC->loadNodeInfo($var[NodeID]);
					$NodeInfo[$key][contributionNum] = contributionAdmin::getContributionRecordNum($NInfo, '1') ;
					if(!empty($NodeInfo[$key][contributionNum]))
						$NodeInfo[$key][Name] = $NodeInfo[$key][Name].' ('.$NodeInfo[$key][contributionNum].')';
					
					
				}
			}	
		}
		$TPL->assign('NodeInfo', $NodeInfo);
		$TPL->display('tree_contribution.html');
		break;

	case 'contribution_xml':
		if(!empty($IN[NodeID])) {
			$NodeInfo = $site->getAll4Tree($IN[NodeID]);
			if($SYS_ENV['DisplayPublishCount']) {
				foreach($NodeInfo as $key=>$var) {
					$NInfo = $iWPC->loadNodeInfo($var[NodeID]);
					$NodeInfo[$key][contributionNum] = contributionAdmin::getContributionRecordNum($NInfo, '1') ;
					if(!empty($NodeInfo[$key][contributionNum]))
						$NodeInfo[$key][Name] = $NodeInfo[$key][Name].' ('.$NodeInfo[$key][contributionNum].')';
				
				
				}
			}
			$TPL->assign('NodeInfo', $NodeInfo);
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('contribution_xml.xml');
		} else {
	
		}
		break;

	case 'collection_cate':
		collection_admin::isValid();

		$collection = new collection_cate_admin();

		$TPL->assign('CateInfo', $collection->getAll4Tree());
		$TPL->display('tree_collection_cate.html');
		break;
		break;
	case 'collection_cate_xml':
		$collection = new collection_cate_admin();
		if(!empty($IN[CateID])) {
			$TPL->assign('CateInfo', $collection->getAll4Tree($IN[CateID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('collection_cate_xml.xml');
		} else {
	
		}
		break;
	case 'collection_cate_select':
		$collection_cate = new collection_cate_admin();
		$TPL->assign('CateInfo', $collection_cate->getAll4Tree());
		$TPL->display('tree_collection_cate_select.html');
		break;
	case 'collection_cate_select_xml':
		$collection_cate = new collection_cate_admin();
		if(!empty($IN[CateID])) {
			$TPL->assign('CateInfo',  $collection_cate->getAll4Tree($IN[CateID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('collection_cate_select_xml.xml');
		} else {
	
		}
		break;
	case 'site_recycle_bin_xml':
			$TPL->assign('NodeInfo', $site->getRecycleBin());
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('site_recycle_bin_xml.xml');

		break;
	case 'tpl_cate':
		 require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
		$tplcate = new tpl_cate_admin();

		$TPL->assign('CateInfo', $tplcate->getAll4Tree());
		$TPL->display('tree_tpl_cate.html');
		break;
	case 'tpl_cate_xml':
		require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
		$tplcate = new tpl_cate_admin();
		if(!empty($IN[TCID])) {
			$TPL->assign('CateInfo', $tplcate->getAll4Tree($IN['TCID']));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('tpl_cate_xml.xml');
		} else {
	
		}
		break;
	case 'tpl_cate_select':
		require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
		$tpl_cate = new tpl_cate_admin();
		$TPL->assign('CateInfo', $tpl_cate->getAll4Tree());
		$TPL->display('tree_tpl_cate_select.html');
		break;
	case 'tpl_cate_select_xml':
		require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
		$tpl_cate = new tpl_cate_admin();
		if(!empty($IN[TCID])) {
			$TPL->assign('CateInfo',  $tpl_cate->getAll4Tree($IN[TCID]));
			header("Content-Type: text/xml; charset=".CHARSET."\n");
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
		    header('Expires: ' . $now);
			$TPL->display('tpl_cate_select_xml.xml');
		} else {
	
		}
		break;

}

?>