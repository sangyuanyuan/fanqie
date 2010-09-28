<?php
/*
全文检索程序使用说明:
search.php?TableID=1&SearchName=Content&keywords=xxx&NodeID=1,2,3&Sub=1&Page=1

o:search则触发搜索，否则显示默认页
TableID: 内容模型ID，例如新闻模型的ID为1
SearchName: 全文检索后台所设置的'检索名'
Keywords: 关键字,多个关键字使用空格分离
NodeID: 搜索的节点
Sub:是否搜索子节点, 0为不搜索,1为搜索
Time:检索内容的时间限制
Page:分页

*/
require_once 'common.php';
require_once SYS_PATH."plugins/FullTextSearch/plugin.config.php";
require_once "se.lang.php";

 
$TableID = empty($IN['TableID'])? 1 : intval($IN['TableID']);
$Setting = $db->getRow("SELECT * FROM {$plugin_table['fulltext']['setting']}  WHERE TableID=$TableID ");
if(empty($Setting['TableID'])) {
	goback('invalid_tableid_setting');
}
$tpl = &$Setting['SearchTpl'];

switch($IN['o']) {
	case 'pro':
		include_once(CACHE_DIR.'Cache_CateList.php');
		$TPL->assign('Cate_List', $NODE_LIST);
		$TPL->display($Setting['SearchProTpl']);
		break;
	case 'search':
		$table_search = $db_config['table_pre'].'plugin_fulltext_search_'.$TableID; 
 		$table_publish = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$TableID;
		if(empty($IN['Keywords'])) goback('please_input_keywords');
		if(empty($IN['SearchName'])) goback('please_input_searchname');

		if(empty($IN['NodeID'])) {
			$node_where_count = "";
			$node_where_execute = "";
		} else {
			if(is_array($IN['NodeID'])) {
				$NodeIDs = $IN['NodeID'];
				foreach($NodeIDs as $key=>$var) {
					if($key==0) {
						$IN['NodeID'] = $var;
					} else{
						$IN['NodeID'] .= ','.$var;
					}
				}
			} else {
				$NodeIDs = explode(',', $IN['NodeID']);
			
			}
			//$NodeIDs = array_unique($NodeIDs);
			if($IN['Sub'] == 1) {
				foreach($NodeIDs as $key=>$var) {
					$var = intval($var);
					$NodeInfo = $iWPC->loadNodeInfo($var);
					$subnode = str_replace('%', ',', $NodeInfo['SubNodeID']);
					if($key == 0) {
						$node_where = $subnode;
					} else {
						$node_where .= ','.$subnode;
					}

				}		
			} else {
				foreach($NodeIDs as $key=>$var) {
					$var = intval($var);
					if($key == 0) {
						$node_where = $var;
					} else {
						$node_where .= ','.$var;
					}
				}		
			}

			$node_where_count = "AND NodeID IN($node_where)";
			$node_where_execute = "AND s.NodeID IN($node_where)";
		}
		$result = $db->getRow("SELECT FullTextFields FROM {$plugin_table['fulltext']['fields']}  WHERE TableID=$TableID AND SearchName='{$IN['SearchName']}'");
		$FullTextFields = explode(',', $result['FullTextFields']);
		foreach($FullTextFields as $key=>$var) {
			if($key == 0) {
				$fields = 's.'.$var;
			} else {
				$fields .= ', s.'.$var;
				
			}
		}
		

 		$offset = &$Setting['SearchPageOffset'];
		$Page = empty($IN['Page']) ? 1 : intval($IN['Page']);
		$Time = empty($IN['Time']) ? 0 : intval($IN['Time']);
		if($Time == 0) {
			$time_where_count = '';
			$time_where_execute = '';
		} else {
			$timestamp = time() - $Time*60*60*24;
			$time_where_count = 'AND PublishDate > '.$timestamp;
			$time_where_execute = 'AND s.PublishDate > '.$timestamp;
 		}

		//echo $node_where;exit;
		$Keywords = fulltextEncoder(trim($IN[Keywords]));

		$result= $db->getRow("SELECT COUNT(*) as nr  From $table_search  WHERE  MATCH ({$result['FullTextFields']})  AGAINST ('$Keywords') $node_where_count   $time_where_count");			
		$num= intval ($result[nr]);

		$pagenum=ceil($num/$offset);
 		$start=($Page-1)*$offset;

		$sql = "SELECT p.*,s.IndexID,s.NodeID,s.PublishDate,s.URL,MATCH ($fields) AGAINST ('$Keywords') AS score From $table_search s ,$table_publish p WHERE p.ContentID=s.ContentID AND MATCH ($fields) AGAINST ('$Keywords') $node_where_execute $time_where_execute  Limit $start, $offset ";
		//echo $sql;
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}

		$sendVar= 'se.php?o=search&TableID='.$TableID.'&Keywords='.urlencode($IN[Keywords]).'&SearchName='.$IN['SearchName'].'&NodeID='.$IN['NodeID'].'&Sub='.$IN['Sub'].'&Time='.$IN['Time'];

		$pagelist=search_page($pagenum, $Page, $sendVar);

		$searchResultInfo=array(
				  'num'    => $num,
				  'from' => ($start+1),
				  'to'		=> ($start+$offset),
				  'pageNum'=>$pagenum,
				  );

		$TPL->assign("searchResult", $data);
		$TPL->assign('pageList',$pagelist);
		if($searchResultInfo[num] < $searchResultInfo[to]) {
				$searchResultInfo[to]=$searchResultInfo[num];
		}
		$TPL->assign('searchResultInfo',$searchResultInfo);
 		$TPL->assign('searchKeywords', $IN['Keywords']);
		$TPL->display($tpl);
		break;
	default:
		$TPL->display($tpl);
		break;
}
include('debug.php');

?>
