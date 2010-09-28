<?php
require_once 'common.php';
require_once INCLUDE_PATH."admin/content_table_admin.class.php";


switch($IN[o]) {
	case 'search':
		$TableID = $IN['TableID'];
  		$table_content = $db_config['table_pre'].$db_config['table_content_pre'].'_'.$TableID;
 		//if(empty($IN['Field'])) goback('please_input_field');
			
		///*初始化搜索字段SQL $field_where
		//print_r($IN);
		$Field = $IN['Field'];
		if($IN['Field'] == 'all' || $IN['Field'] == '') {
				$searchFields = content_table_admin::getSearchFieldsInfo($TableID);
				$field_where = " AND ( ";
				foreach($searchFields as $key=>$var) {
					if($key ==0) {
						if(!empty($IN['Exact']))
							$field_where .= "c.".$var['FieldName']."='{$IN[Keywords]}' ";
						else
							$field_where .= "c.".$var['FieldName']." LIKE '%{$IN[Keywords]}%' ";
				
					} else {
						if(!empty($IN['Exact']))
							$field_where .= " OR c.".$var['FieldName']."='{$IN[Keywords]}' ";
						else
							$field_where .= " OR c.".$var['FieldName']." LIKE '%{$IN[Keywords]}%' ";
				
					}
				
				}

				$field_where .= " ) ";
			
 

		} elseif(is_array($IN['Field'])) {
			$IN['Field'] = array_values($IN['Field']);
			if(!empty($IN['Field'][0])) {
				$Fields = $IN['Field'];
				$field_where = " AND ( ";
				foreach($Fields as $key=>$var) {
					if(empty($key)) {
							$IN['Field'] = $var;
							if(!empty($IN['Exact']))
								$field_where .= " c.{$var}='{$IN[Keywords]}' ";
							else
								$field_where .= " c.{$var} LIKE '%{$IN[Keywords]}%' ";
					} else{
							$IN['Field'] .= ','.$var;
							if(!empty($IN['Exact']))
								$field_where .= " OR c.{$var}='{$IN[Keywords]}' ";
							else
								$field_where .= " OR c.{$var} LIKE '%{$IN[Keywords]}%' ";
					}
				}
				$field_where .= " ) ";
			
			} else {
 					$IN['Field'] = '';
					$searchFields = content_table_admin::getSearchFieldsInfo($TableID);
					$field_where = " AND ( ";
					foreach($searchFields as $key=>$var) {
						if($key ==0) {

							if(!empty($IN['Exact']))
								$field_where .= "c.".$var['FieldName']."='{$IN[Keywords]}' ";
							else
								$field_where .= "c.".$var['FieldName']." LIKE '%{$IN[Keywords]}%' ";
					
						} else {
							if(!empty($IN['Exact']))
								$field_where .= " OR c.".$var['FieldName']."='{$IN[Keywords]}' ";
							else
								$field_where .= " OR c.".$var['FieldName']." LIKE '%{$IN[Keywords]}%' ";
					
						}
					
					}

					$field_where .= " ) ";				
	 

		
			}

			
		
		} elseif(strpos($IN['Field'], ",")) {
 				$Fields = explode(',', $IN['Field']);
				 
				$field_where = " AND ( ";
				foreach($Fields as $key=>$var) {
					if(empty($key)) {
							$IN['Field'] = $var;
							if(!empty($IN['Exact']))
								$field_where .= "c.{$var}='{$IN[Keywords]}' ";
							else
								$field_where .= "c.{$var} LIKE '%{$IN[Keywords]}%' ";
					} else{
							$IN['Field'] .= ','.$var;
							if(!empty($IN['Exact']))
								$field_where .= " OR c.{$var}='{$IN[Keywords]}' ";
							else
								$field_where .= " OR c.{$var} LIKE '%{$IN[Keywords]}%' ";
					}
				}
				$field_where .=" ) ";			
 
			
		}  elseif(!empty($Field)) {
			if(!empty($IN['Exact']))
				$field_where = " AND c.{$Field}='{$IN[Keywords]}'";
			else
				$field_where = " AND c.{$Field} LIKE '%{$IN[Keywords]}%'";
		 
		} else {
			$field_where = '';
		}
		//初始化搜索字段SQL $field_where */
		

		if($IN['Keywords'] == '') {
			$field_where ='';
		}


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

			$node_where = "AND i.NodeID IN($node_where)";
		}


		$offset = empty( $IN['offset']) ?  $SYS_ENV['SearchPageNum'] : $IN['offset'];
		$Page = empty($IN['Page']) ? 1 : intval($IN['Page']);
		$Time = empty($IN['Time']) ? 0 : intval($IN['Time']);
		if($Time == 0) {
			$time_where = '';
 		} else {
			$timestamp = time() - $Time*60*60*24;
			$time_where = 'AND i.PublishDate > '.$timestamp;
  		}

		$Date = empty($IN['Date']) ? 0 : strtotime($IN['Date']);
		if($Date == 0) {
			$date_where = '';
 		} else {
 			$date_where = "AND (i.PublishDate > $Date AND i.PublishDate < ".($Date + 60*60*24).")";
  		}

		//echo $node_where;exit;

		if($IN['Published'] == '0') {
			$publish_where = " AND i.State=0 ";
		} elseif($IN['Published'] == '1') {
			$publish_where = " AND i.State=1 ";
		
		} else {
			$publish_where = " AND i.State!=-1 ";
		}
 
		$result= $db->getRow("SELECT COUNT(*) as nr  From $table->content_index i,$table_content c WHERE i.ContentID=c.ContentID AND i.Type=1 AND i.TableID='$TableID'  $field_where $node_where $time_where $date_where  $publish_where ");			
		$num= intval ($result[nr]);

		$pagenum=ceil($num/$offset);
 		$start=($Page-1)*$offset;

		$sql = "SELECT i.*,c.*,u.uName as CreationUser From $table->content_index i,$table_content c Left Join $table->user u ON u.uId=c.CreationUserID WHERE i.ContentID=c.ContentID AND i.Type=1 AND i.TableID='$TableID'  $field_where $node_where $time_where $date_where $publish_where Order By i.PublishDate DESC Limit $start, $offset ";
		//echo $sql;
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}

		$sendVar= "admin_search.php?sId={$IN['sId']}&offset={$IN[offset]}&o=search&TableID=".$TableID."&Keywords=".urlencode($IN[Keywords])."&Field=".$IN['Field']."&NodeID=".$IN['NodeID']."&Sub=".$IN['Sub']."&Time=".$IN['Time']."&Date=".$IN['Date']."&Tpl=".$IN['Tpl']."&Published=".$IN['Published']."&Exact=".$IN['Exact'];
		
		if(empty($IN['Page'])) {
 			header("Location: ".$sendVar."&Page=1");
 		}

		$pagelist = pagelist($pagenum, $Page,$sendVar);

		$searchResultInfo=array(
				  'recordNum'    => $num,
				  'from' => ($start+1),
				  'too'		=> ($start+$offset),
				  'pageNum'=>$pagenum,
				  'page'=>$Page,
				  );

		$TPL->assign('DisplayItem', content_table_admin::getDisplayFieldsInfo($TableID));
		$TPL->assign('TitleField', content_table_admin::getTitleFieldInfo($TableID));
		$TPL->assign('catelist', $CATE_LIST);
		//$TPL->assign("pList", $publish->getIndexLimit($IN[NodeID], $start, $offset, $State));
		$TPL->assign("recordInfo", $recordInfo);
		$TPL->assign("IN", $IN);
		$TPL->assign("offset", $offset);
		$TPL->assign("TableID", $TableID);
		$TPL->assign("pList", $data);
		$TPL->assign('pagelist',$pagelist);
		if($searchResultInfo[num] < $searchResultInfo[to]) {
				$searchResultInfo[to]=$searchResultInfo[num];
		}
		$TPL->assign('searchResultInfo',$searchResultInfo);
 		$TPL->assign('searchKeywords', $IN['Keywords']);
		$TPL->display($IN['Tpl']);
		break;


	default:
		$TableID = &$IN['TableID'];
		$searchFields = content_table_admin::getSearchFieldsInfo($TableID);
		$TPL->assign("searchFields", $searchFields);
		$TPL->assign("node_list", $NODE_LIST);
		$TPL->display('search.html');




}

 
include MODULES_DIR.'footer.php' ;
?>
