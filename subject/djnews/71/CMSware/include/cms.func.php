<?php

/* ------------------------------------
计数器
---------------------------------------

<cms action="COUNT" return="value" Function="count(*)" Field="" sql="" />

Function : count(*) | SUM(c.Price) | AVG(c.Price)

--------------------------------------- */
function CMS_COUNT($params)
{
	global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware,$PageInfo, $CONTENT_MODEL_INFO, $DSN_INFO;
	$PageMode = false;
	extract ($params, EXTR_PREFIX_SAME, "cms_");
	
	$cache = empty($cache) ? 0 : 2;

	$query = str_replace("#TABLE_HEADER#",$db_config['table_pre'], $query);
	if(empty($nodeid)) { //所有节点
		$list_where = '';
	} elseif(preg_match("/^[0-9]+,[0-9]+/", $nodeid)) { //多个节点
		$list_where.= "  i.NodeID IN($nodeid)";
		$nodeidArray = explode(',', $nodeid);
		$NodeInfo = $iWPC->loadNodeInfo($nodeidArray[0]);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeidArray[0]}</font> you have set does not exist!";
			return false;
		}

	} elseif(preg_match("/^all-[0-9]+/", $nodeid)) { //根节点并包括所有子节点
		$nodeid = str_replace("all-",'',$nodeid);
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);
		$list_where.= "   i.NodeID IN($nodeid)";
	} elseif($nodeid == 'self') { //自动获取节点,可以多个节点共享一个模板，用的就是self
		
		
		$nodeid = $GLOBALS[IN][NodeID];
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$list_where= "  i.NodeID='$nodeid'";
	
	} else {//单一一个节点
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$list_where= "   i.NodeID='$nodeid'";

	}

	if(isset($nodeguid)) {
		if(preg_match("/^[^,]+,[^,]+/", $nodeguid)) { //多个节点
			//$list_where.= " AND i.NodeID IN($nodeid)";
 			foreach(explode(',',  $nodeguid) as $key=>$var) {
				$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$var'", 2);
				//$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
				if($key == 0) $nodeids = $resultGUID['NodeID'];
				else  $nodeids.=",".$resultGUID['NodeID'];


		
			
			}

			$list_where= " i.NodeID IN($nodeids)";

			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The NodeGUID <font color=#FF0000>{$var}</font> you have set does not exist!";
				return false;
			}

		} elseif(preg_match("/^all-[^,]+/", $nodeguid)) { //根节点并包括所有子节点
			$nodeguid = str_replace("all-",'',$nodeguid);
			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'",2);

			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The NodeGUID <font color=#FF0000>{$nodeguid}</font> you have set does not exist!";
				return false;
			}
			$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);
			$list_where.= "  i.NodeID IN($nodeid)";
		} else {
			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'",2);
			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			$list_where= "  i.NodeID='".$resultGUID['NodeID']."'";
		
		}
	
	}  





	/**
	自定义where标签
	e.g : <where: c.Photo!=''> 可以实现只调用包括新闻图片的记录
	*/
	if(!empty($where)) {
		$where = "AND ".$where;
	}else {
		$where = "";
	}

	/**
	预设TableID,大部分情况下不用设置，系统会自动根据NodeID获取TableID
	*/
	if(empty($tableid)) {
		if(!empty($NodeInfo))
			$tableid = $NodeInfo[TableID];

	}
	
	 
	//获得我们的内容模型表名称

	$table_name = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$tableid;
	$table_count = $db_config['table_pre'].'plugin_base_count';

	$list_where1 = empty($list_where) ? "" : " AND ".$list_where;
	if(empty($query)) {
		$sql = "SELECT $function as TotalNum  FROM $table->content_index i,$table->content_index i2 ,$table_name c where (i.PublishDate <= UNIX_TIMESTAMP() ) AND i.ParentIndexID=i2.IndexID AND i.IndexID =c.IndexID  AND i2.State=1 AND i.State!=-1 AND i2.Type!=3 $list_where1 $where ";
	} else {
		$sql = $query;
	}
	//echo $sql;
	

	$result = $db->getRow($sql);

	return $result[TotalNum];

}

function CMS_SQL($params)
{	//print_r($params);
	global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware,$PageInfo, $CONTENT_MODEL_INFO, $DSN_INFO;
	$PageMode = false;
	extract ($params, EXTR_PREFIX_SAME, "cms_");
	
	$cache = empty($cache) ? 0 : 2;

	$query = str_replace("#TABLE_HEADER#",$db_config['table_pre'], $query);
	/**
	初始化调用数量sql
	*/
	if(empty($num)) {// 调用所有记录
		$list_limit = ' ';
	}elseif(preg_match("/^[0-9]+,[0-9]+$/", $num)){ //调用x,y条记录
		list($start,$offset) = explode(",",$num);
		$list_limit = " Limit $start,$offset ";
	}elseif(preg_match("/^page-[0-9]+$/", $num)){ //分页调用
		$offset = str_replace("page-",'', $num);
		$offset = (int)$offset;
		$PageMode = true;
	}elseif(preg_match("/^[0-9]+$/", $num)) { //调用0,x条记录
		$list_limit = " Limit 0,$num ";
	}else
		die("<font color =red >Fatal Error!</font> attribute 'num' invalid");
	
	$sql_query = &$query;


	//如果是分页调用模式.continue...
	if($PageMode) {
		if(preg_match("/select (.*) from/isU", $sql_query, $matches)) {
			$sql_num = str_replace($matches[1], "Count(*) as TotalNum", $sql_query);
			//echo $sql_num;
			$result = $db->getRow($sql_num, 2);
			$TotalNum = $result[TotalNum];
		} else {
			$TotalNum = 10;
		
		}

		 

		$TotalPage = ceil($TotalNum/$offset);
		$SYS_ENV[tpl_pagelist][run] = "yes";

		if(empty($SYS_ENV[tpl_pagelist][page]))
			$SYS_ENV[tpl_pagelist][page] = 0;

		$start = ($SYS_ENV[tpl_pagelist][page])*$offset;
		$SYS_ENV[tpl_pagelist][page] = $SYS_ENV[tpl_pagelist][page] + 1;
		if(($start+$offset) >= $TotalNum)
			$SYS_ENV[tpl_pagelist][run] = "no";
		$list_limit = "Limit $start,$offset";

		//if($NodeInfo[])
		$list_page = list_page($TotalPage,$SYS_ENV[tpl_pagelist][page],$SYS_ENV[tpl_pagelist][filename]);

		$cmsware['page'] = array (
			'TotalNum' => $TotalNum,
			'TotalPage' => $TotalPage,
			'CurrentPage' => $SYS_ENV[tpl_pagelist][page],
			'PageList' => $list_page,
			'PageNum'=> $offset,
			'URL'=> $SYS_ENV[tpl_pagelist][filename],

		);
		$PageInfo = $cmsware['page'];
		
		//print_r($PageInfo);

	}

 	$sql_query  = $sql_query .' '. $list_limit;
	
 
	//echo $sql_query;
	$result = $db->Execute($sql_query, $cache);
	while(!$result->EOF) {
		if(isset($result->fields[NodeID])) {
			$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
			$result->fields[NodeInfo] = $NInfo;
			$result->fields[NodeName] = $NInfo[Name];
			$result->fields[NodeURL] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
		
		}

		$data[] = $result->fields;
		$result->MoveNext();
	}
	return $data;


}



function CMS_LIST($params)
{
	global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware,$PageInfo, $CONTENT_MODEL_INFO, $DSN_INFO;
	$PageMode = false;
	extract ($params, EXTR_PREFIX_SAME, "cms_");

	
	/**
	初始化调用节点sql
	*/
	
	$cache = empty($cache) ? 0 : 2;
	$isIgnore = false;
	
	if(!empty($ignore)) {
		$ignoreNodeIds = explode(',', $ignore);
		$isIgnore = true;
	}

	//print_r($params);exit;
	if(empty($nodeid)) { //所有节点
		$list_where = '';
	} elseif(preg_match("/^[0-9]+,[0-9]+/", $nodeid)) { //多个节点
		$list_where.= "  i.NodeID IN($nodeid)";
		$nodeidArray = explode(',', $nodeid);
		$NodeInfo = $iWPC->loadNodeInfo($nodeidArray[0]);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeidArray[0]}</font> you have set does not exist!";
			return false;
		}

	} elseif(preg_match("/^all-[0-9]+/", $nodeid)) { //根节点并包括所有子节点
		$nodeid = str_replace("all-",'',$nodeid);
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}

		
		//$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);

		foreach(explode('%', $NodeInfo[SubNodeID]) as $key=>$var) {

			if($isIgnore) {
				if(in_array($var, $ignoreNodeIds)) {
					continue;
				} else {
					$nodeid .= ",".$var;
				}		

				$nodeid = substr($nodeid, 1);
			} else {
				if($key==0) $nodeid = $var;
				else $nodeid .= ",".$var;

			}
		}

		//add at 2006-1-10
		if(substr($nodeid,0,1) == ',') $nodeid = substr($nodeid,1);
		if(substr($nodeid,-1) == ',') $nodeid = substr($nodeid,0,-1);


		$list_where.= "   i.NodeID IN($nodeid)";
	} elseif($nodeid == 'self') { //自动获取节点,可以多个节点共享一个模板，用的就是self
		
		
		$nodeid = $GLOBALS[IN][NodeID];
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$list_where= "  i.NodeID='$nodeid'";
	
	} else {//单一一个节点
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$list_where= "   i.NodeID='$nodeid'";

	}

	if(isset($nodeguid)) {
		if(preg_match("/^[^,]+,[^,]+/", $nodeguid)) { //多个节点
			//$list_where.= " AND i.NodeID IN($nodeid)";
 			foreach(explode(',',  $nodeguid) as $key=>$var) {
				$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$var'", 2);
				//$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
				if($key == 0) $nodeids = $resultGUID['NodeID'];
				else  $nodeids.=",".$resultGUID['NodeID'];


		
			
			}

			$list_where= " i.NodeID IN($nodeids)";

			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The NodeGUID <font color=#FF0000>{$var}</font> you have set does not exist!";
				return false;
			}

		} elseif(preg_match("/^all-[^,]+/", $nodeguid)) { //根节点并包括所有子节点
			$nodeguid = str_replace("all-",'',$nodeguid);
			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'",2);

			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The NodeGUID <font color=#FF0000>{$nodeguid}</font> you have set does not exist!";
				return false;
			}
			$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);
			$list_where.= "  i.NodeID IN($nodeid)";
		} else {
			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'",2);
			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			$list_where= "  i.NodeID='".$resultGUID['NodeID']."'";
		
		}
	
	}  


	/**
	初始化调用数量sql
	*/
	if(empty($num)) {// 调用所有记录
		$list_limit = ' ';
	}elseif(preg_match("/^[0-9]+,[0-9]+$/", $num)){ //调用x,y条记录
		list($start,$offset) = explode(",",$num);
		$list_limit = " Limit $start,$offset ";
	}elseif(preg_match("/^page-[0-9]+$/", $num)){ //分页调用
		$offset = str_replace("page-",'', $num);
		$offset = (int)$offset;
		$PageMode = true;
	}elseif(preg_match("/^[0-9]+$/", $num)) { //调用0,x条记录
		$list_limit = " Limit 0,$num ";
	}else
		die("<font color =red >Fatal Error!</font> attribute 'num' invalid");


	/**
	初始化排序字段sql
	*/
	$table_count_field = array(
		'Hits_Total', 'Hits_Today', 'Hits_Week', 'Hits_Month', 'Hits_Date', 'CommentNum'	
	);
	$INCLUDE_COUNT_TABLE = true; //包含计数表
	$ORDER_BY_COUNT = false;
	$orderby_field = preg_replace("/[\s]+DESC[\s]*/isU", "", $orderby);
	$orderby_field = preg_replace("/[\s]+ASC[\s]*/isU", "", $orderby_field);
	 
	if(empty($orderby)) { //默认按照 置顶-权重-发布时间 排序
		$list_orderby = " ORDER BY i.Top DESC,i.Sort DESC,i.PublishDate DESC";

	} elseif($orderby == 'PublishDate'){ //兼容1.0.xx旧标签调用

		$list_orderby = " ORDER BY i.Top DESC,i.Sort DESC,i.PublishDate DESC";	
		
	} elseif(in_array($orderby, $table_count_field)) {
		$INCLUDE_COUNT_TABLE = true;
		$ORDER_BY_COUNT = true;
		$list_orderby = " ORDER BY {table_count}$orderby DESC";	
	} elseif(in_array($orderby_field, $table_count_field)) {
		$INCLUDE_COUNT_TABLE = true;
		$ORDER_BY_COUNT = true;
		$list_orderby = " ORDER BY {table_count}$orderby ";	
	} else { //用户可以自定义orderby属性
		$list_orderby = " ORDER BY $orderby ";
	}

	/**
	自定义where标签
	e.g : <where: c.Photo!=''> 可以实现只调用包括新闻图片的记录
	*/
	if(!empty($where)) {
		$where = "AND ".$where;
	}else {
		$where = "";
	}

	/**
	预设TableID,大部分情况下不用设置，系统会自动根据NodeID获取TableID
	*/
	if(empty($tableid)) {
		if(!empty($NodeInfo))
			$tableid = $NodeInfo[TableID];

	}
	
	 
	//获得我们的内容模型表名称

	$table_name = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$tableid;
	$table_count = $db_config['table_pre'].'plugin_base_count';

	if(!empty($returnkey)) {
		foreach(explode(',', $returnkey) as $key=>$var) {
			if($key==0) $c_return = "c.".$var;
			else $c_return .= ",c.".$var;
		}
		
	} else {
		$c_return .= "c.*";
	}

	//如果是分页调用模式.continue... date("Y-m-d H:i")
	if($PageMode) {
		$list_where1 = empty($list_where) ? "" : " AND ".$list_where;
		$sql_num = "SELECT DISTINCT Count(*) as TotalNum  FROM $table->content_index i,$table->content_index i2 ,$table_name c where (i.PublishDate <= UNIX_TIMESTAMP() ) AND i.ParentIndexID=i2.IndexID AND i2.IndexID =c.IndexID  AND i2.State=1 AND i.State!=-1 AND i2.Type!=3 $list_where1 $where ";
		//echo $sql_num;
		$result = $db->getRow($sql_num, 2);
		$TotalNum = $result[TotalNum];
		$TotalPage = ceil($result[TotalNum]/$offset);
		$SYS_ENV[tpl_pagelist][run] = "yes";

		if(empty($SYS_ENV[tpl_pagelist][page]))
			$SYS_ENV[tpl_pagelist][page] = 0;

		$start = ($SYS_ENV[tpl_pagelist][page])*$offset;
		$SYS_ENV[tpl_pagelist][page] = $SYS_ENV[tpl_pagelist][page] + 1;
		if(($start+$offset) >= $TotalNum)
			$SYS_ENV[tpl_pagelist][run] = "no";
		$list_limit = "Limit $start,$offset";

		//if($NodeInfo[])
		$list_page = list_page($TotalPage,$SYS_ENV[tpl_pagelist][page],$SYS_ENV[tpl_pagelist][filename]);

		$cmsware['page'] = array (
			'TotalNum' => $TotalNum,
			'TotalPage' => $TotalPage ,
			'CurrentPage' => $SYS_ENV[tpl_pagelist][page],
			'PageList' => $list_page,
			'PageNum'=> $offset,
			'URL'=> $SYS_ENV[tpl_pagelist][filename],

		);
		$PageInfo = $cmsware['page'];
		//echo $list_where."-----------------------------------";
		//print_r($PageInfo);

	}

	if($INCLUDE_COUNT_TABLE) {
		//$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i2.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink,  $c_return ,co.Hits_Total, co.Hits_Today, co.Hits_Week, co.Hits_Month, co.Hits_Date, co.CommentNum FROM $table->content_index i,$table->content_index i2 ,$table_name c LEFT JOIN $table_count co ON co.IndexID=i2.IndexID where (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.IndexID =c.IndexID  AND i2.State=1  AND i.State=1  AND i2.Type!=3 $list_where $where  $list_orderby $list_limit";
		if($ORDER_BY_COUNT) {
			if(empty($where)) {
				$list_where = empty($list_where) ? '' : 'where'.$list_where;
				$list_where = str_replace("i.","", $list_where);
				$sql_query  = "SELECT * From $table_count $list_where  $list_orderby $list_limit";
				$sql_query = str_replace("{table_count}","", $sql_query);
				$result = $db->Execute($sql_query);
				while(!$result->EOF) {	
					$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
					$result->fields[NodeInfo] = $NInfo;
					$result->fields[NodeName] = $NInfo[Name];
					$result->fields[NodeURL] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
					$tmpResult = $db->getRow("SELECT i.URL,i.PublishDate,i.Type,i.Sort,i.Pink, $c_return  FROM $table->content_index i ,$table_name c  where  i.IndexID='".$result->fields['IndexID']."' AND c.ContentID=i.ContentID");
					$data[] = array_merge($tmpResult, $result->fields);
					$result->MoveNext();
				}
				
		//	echo $sql_query;
				return $data;

			} else {
				$list_where = empty($list_where) ? "" : " AND ".$list_where;

				$sql_query  = "SELECT i.NodeID,i.ContentID,i.State,i.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink,  $c_return ,co.Hits_Total, co.Hits_Today, co.Hits_Week, co.Hits_Month, co.Hits_Date, co.CommentNum From $table_count co, $table->content_index i,$table_name c  where co.IndexID=i.IndexID AND c.IndexID=i.IndexID  $list_where $where  $list_orderby $list_limit";
				$sql_query = str_replace("{table_count}","co.", $sql_query);
			}
			


		
		} else {
			$list_where = empty($list_where) ? "" : " AND ".$list_where;
			$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i2.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink,co.*, $c_return FROM $table->content_index i,$table->content_index i2 , $table_name c , $table_count co  where c.IndexID=i2.IndexID AND co.IndexID=i2.IndexID AND (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.State=1 AND i.State=1 AND i2.Type!=3 $list_where $where  $list_orderby $list_limit";
		}
		//$result = $db->Execute($sql_query, $cache);

	
	} else {
		 
		$list_where = empty($list_where) ? "" : " AND ".$list_where;
		$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i2.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink,co.*, $c_return FROM $table->content_index i,$table->content_index i2 $table_name c , $table_count co  where c.IndexID=i2.IndexID AND co.IndexID=i2.IndexID AND (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.State=1 AND i.State=1 AND i2.Type!=3 $list_where $where  $list_orderby $list_limit";
	
	}
 
	if(!empty($debug)) {
		echo $sql_num;
		echo "<HR>".$sql_query."<HR>";
	}
 //echo $sql_query;
	//$pub = new publishAdmin();
	$result = $db->Execute($sql_query, $cache);
	while(!$result->EOF) {
		$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
		//$pub->publishInfo = &$result->fields;
		//$pub->NodeInfo = $NInfo;
		//$pub->IndexID = $result->fields[ContentID];
		/*foreach($result->fields as $key=>$var ) {
			$pub->publishAll($var);
			$result->fields[$key] = $var;


		}*/
		$result->fields[NodeInfo] = $NInfo;
		$result->fields[NodeName] = $NInfo[Name];
		$result->fields[NodeURL] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
		$data[] = $result->fields;
		$result->MoveNext();
	}
 	return $data;
}


/**
 * 内容调用CMS::CONTENT
 * IndexID=1 return var[]
 * IndexID=1,2,3	return var[IndexID][]
 */
function CMS_CONTENT($params)
{
	global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware;
	extract ($params, EXTR_PREFIX_SAME, "cms_");
	
	
	$cache = empty($cache) ? 0 : 2;
	if(!empty($returnkey)) {
		foreach(explode(',', $returnkey) as $key=>$var) {
			if($key==0) $c_return = "c.".$var;
			else $c_return .= ",c.".$var;
		}
		
	} else {
		$c_return .= "c.*";
	}
	$pos = strpos($indexid, ',');

	if(empty($indexid)) {// 调用所有记录
		return false;
	}elseif($pos !== false){ //调用x,y条记录
		//exit($indexid);
		$IndexIDs = explode(',', $indexid);
		foreach($IndexIDs as $key=>$var) {

			if(empty($var)) continue;

			$NodeID= publishAdmin::getIndexInfo($var, $field = 'NodeID');
			$NodeInfo = $iWPC->loadNodeInfo($NodeID);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The IndexID <font color=#FF0000>{$indexid}</font> you have set does not exist!";
 			}

			$table_name = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$NodeInfo[TableID];
			$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i2.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink, $c_return FROM $table->content_index i,$table->content_index i2 ,$table_name c where (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.IndexID =c.IndexID  AND i2.State=1 AND i.State!=-1 AND i2.Type!=3 AND i.IndexID='{$var}'";

			$result[$var] = $db->getRow($sql_query, $cache);
			$result[$var][NodeInfo] = $NodeInfo;
			$result[$var][NodeName] = $NodeInfo[Name];
			$result[$var][NodeURL] = CMSware::cms_getHtmlURL($NodeInfo[IndexName], $NodeInfo);

			
		}
	} else {
		$NodeID= publishAdmin::getIndexInfo($indexid, $field = 'NodeID');
		$NodeInfo = $iWPC->loadNodeInfo($NodeID);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The IndexID <font color=#FF0000>{$indexid}</font> you have set does not exist!";
			return false;
		}

		$table_name = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$NodeInfo[TableID];
		$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink, $c_return FROM $table->content_index i,$table->content_index i2 ,$table_name c where (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.IndexID =c.IndexID  AND i2.State=1 AND i.State!=-1 AND i2.Type!=3 AND i.IndexID='{$indexid}'";

		$returnResult = $db->getRow($sql_query, $cache);
		$returnResult[NodeInfo] = $NodeInfo;
		$returnResult[NodeName] = $NodeInfo[Name];
		$returnResult[NodeURL] = CMSware::cms_getHtmlURL($NodeInfo[IndexName], $NodeInfo);
		if($loopmode == '1') {
			$result = array();
			$result[] = $returnResult;
		} else $result = $returnResult;
	
	
	}

	return $result;

	
}


/*
 * 模板函数名称: 节点信息调用函数(标签调用)
 *
 * 用途: 获取指定NodeID的节点名称+节点首页的URL，返回一个2维数组
 * array(
 *		[0] => array(
 *				'Title'=> "节点名称"
 *				'URL'  => "节点首页URL"
 *		...
 *		..
 *		.
 *				)
 *	);
 * 可以实现( 网站首页 | 新闻频道 | 下载频道 | 娱乐频道 | 生活频道 )这样的导航条的自动生成
 * 甚至包括下拉菜单等的生成
 * @access public
 * @param array $params 
 *        $params['type'] = sub|set  节点调用类型,sub(子节点调用,set(自定义节点调用)
 *        $params['nodeid'] = [0-9]+
 *        $params['ignore'] = [0-9]+,[0-9]+,[0-9]+...
 * @return array 
 * @example 使用方法举例:
 *          1. <CMS::NODELIST:List type="sub" nodeid="5">
 *             type="sub": 取nodeid为5下面的所有子节点,nodeid不能为空.
 *		       返回一个包含NodeInfo的2维数组
 *	        2. <CMS::NODELIST:List type="set" nodeid="2,5,8,12">
 *                type="set": 取指定nodeid的节点数据,nodeid的格式为"2,5,8,12"这样的格式, 节点间使用逗号分隔.
 *		          返回一个包含NodeInfo的2维数组
 *          $ignorenodeids:忽略节点id，使用,号分隔
 */
function  CMS_NODELIST($params)
{
    global $iWPC,$db,$table,$SYS_ENV,$db_config,$cmsware;
    extract ($params, EXTR_PREFIX_SAME, "cms_");
	$cache = empty($cache) ? 0 : 2;

	$return = array();
		$isIgnore = false;
		if(!empty($ignore)) {
			$ignoreNodeIds = explode(',', $ignore);
			$isIgnore = true;
		}



		if(!empty($orderby)) {  
			$list_orderby = " ORDER BY $orderby ";

		} else {  
			$list_orderby = " Order by NodeSort DESC ";
		}



		switch($type) {
			case 'son':
			case 'sub': //子节点
 				if($nodeid == '' && $nodeguid == '') {
					$nodeid = $GLOBALS[IN][NodeID];
					
				} elseif($nodeguid !='') {
					$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);
					$nodeid = $resultGUID['NodeID'];
					 
				
				}
				
				$sql = "SELECT NodeID FROM $table->site WHERE ParentID='$nodeid' and Disabled=0 $list_orderby ";
 				$result = $db->Execute($sql, $cache);
				while(!$result->EOF) {

					if($isIgnore) {
						if(in_array($result->fields[NodeID], $ignoreNodeIds)) {
							$result->MoveNext();
								continue;
						}
					
					}

					$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
					$NInfo['URL'] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
					$NInfo['NodeURL'] = $NInfo['URL'];
					$NInfo['NodeName'] = $NInfo[Name];
					$NInfo['Title'] = $NInfo[Name];
					$return[] = $NInfo;
					$result->MoveNext();
				}

				break;
			case 'parent': //父节点
 				if($nodeid == '' && $nodeguid == '') {
					$nodeid = $GLOBALS[IN][NodeID];
					
				} elseif($nodeguid !='') {
					$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);
					$nodeid = $resultGUID['NodeID'];
					 
				
				}

				$ThisNodeInfo = $db->getRow("SELECT ParentID FROM $table->site WHERE NodeID='$nodeid' and Disabled=0 ", $cache);
				$ParentNodeInfo = $db->getRow("SELECT ParentID FROM $table->site WHERE NodeID='".$ThisNodeInfo['ParentID']."' and Disabled=0 ", $cache);

 				
				$sql = "SELECT NodeID FROM $table->site WHERE ParentID='".$ParentNodeInfo['ParentID']."' and Disabled=0 $list_orderby ";
				$result = $db->Execute($sql, $cache);
				while(!$result->EOF) {

					if($isIgnore) {
						if(in_array($result->fields[NodeID], $ignoreNodeIds)) {
							$result->MoveNext();
								continue;
						}
					
					}

					$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
					$NInfo['URL'] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
					$NInfo['NodeURL'] = $NInfo['URL'];
					$NInfo['NodeName'] = $NInfo[Name];
					$NInfo['Title'] = $NInfo[Name];
					$return[] = $NInfo;
					$result->MoveNext();
				}
				
				break;
			case 'brother': //兄节点
 				if($nodeid == '' && $nodeguid == '') {
					$nodeid = $GLOBALS[IN][NodeID];
					
				} elseif($nodeguid !='') {
					$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);
					$nodeid = $resultGUID['NodeID'];
					 
				
				}

				$ThisNodeInfo = $db->getRow("SELECT ParentID FROM $table->site WHERE NodeID='$nodeid' and Disabled=0 ", $cache);

 				
				$sql = "SELECT NodeID FROM $table->site WHERE ParentID='".$ThisNodeInfo['ParentID']."' and Disabled=0 $list_orderby ";
				$result = $db->Execute($sql, $cache);
				while(!$result->EOF) {

					if($isIgnore) {
						if(in_array($result->fields[NodeID], $ignoreNodeIds)) {
							$result->MoveNext();
								continue;
						}
					
					}

					$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
					$NInfo['URL'] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
					$NInfo['NodeURL'] = $NInfo['URL'];
					$NInfo['NodeName'] = $NInfo[Name];
					$NInfo['Title'] = $NInfo[Name];
					$return[] = $NInfo;
					$result->MoveNext();
				}
				
				break;
				break;
			case 'set':
 				if($nodeid != '') {
					$NodeIDs = explode(',', $nodeid);
					foreach($NodeIDs as $key=>$var) {

						$NInfo = $iWPC->loadNodeInfo($var);
						$NInfo['URL'] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
						$NInfo['NodeURL'] = $NInfo['URL'];
						$NInfo['NodeName'] = $NInfo[Name];
						$NInfo['Title'] = $NInfo[Name];
						$return[] = $NInfo;



					}
					
					
				} elseif($nodeguid !='') {
 					foreach( explode(',', $nodeguid) as $key=>$var) {
						$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$var'", $cache);

						$NInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
						$NInfo['URL'] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
						$NInfo['NodeURL'] = $NInfo['URL'];
						$NInfo['NodeName'] = $NInfo[Name];
						$NInfo['Title'] = $NInfo[Name];
						$return[] = $NInfo;



					}
 					 
				
				}
				
				break;
		}
	//print_r($return);
       return $return;

	}

/**
 * 获取节点内容
 *
 *
 * <CMS::NODE:NodeInfo NodeID="$NodeID" >
 *		<a href=" [$NodeInfo.NodeURL]" title="确定">返回上一级</a> <br/>
 * </CMS> 
 * $NodeID : '', 'self','parent','[0-9]*'
 * ''       : 自动获取NodeID，包括内容页属于的父节点NodeID，或者节点首页归属的节点NodeID
 * 'self'   : 等同于''
 * 'parent' : 等同于''NodeID的父节点NodeID
 * '[0-9]*' : 自定义NodeID，为数字
 *
 * @param array $params 
 * @access public
 * @return array
 */
function CMS_NODE($params)
{
    global $iWPC,$db,$table,$SYS_ENV,$db_config,$cmsware;
    extract ($params, EXTR_PREFIX_SAME, "cms_");
	$cache = empty($cache) ? 0 : 2;
		
	if((empty($nodeid) || $nodeid == 'self') && $nodeguid =='') {
		$nodeid = empty($GLOBALS[IN][NodeID]) ? $GLOBALS[NodeID] : $GLOBALS[IN][NodeID];

	} elseif($nodeid == 'parent' && $nodeguid =='') {
		$SonNodeID = empty($GLOBALS[IN][NodeID]) ? $GLOBALS[NodeID] : $GLOBALS[IN][NodeID];
		$SonNodeInfo = $iWPC->loadNodeInfo($SonNodeID);
		$nodeid = $SonNodeInfo['ParentID'];
	
	} elseif($nodeguid !='') {
 			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);

			$nodeid = $resultGUID['NodeID'];
	 
 	}
				
	$NInfo = $iWPC->loadNodeInfo($nodeid);
	$NInfo['URL'] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
	$NInfo['NodeURL'] = $NInfo['URL'];
	$NInfo['NodeName'] = $NInfo[Name];
	$NInfo['Title'] = $NInfo[Name];

	return $NInfo;

}


/**
 * 获取节点内容
 *
 *
 * <CMS action="ExtraPublish" NodeID="$NodeID" >
 *		<a href=" [$NodeInfo.NodeURL]" title="确定">返回上一级</a> <br/>
 * </CMS> 
 * $NodeID : '', 'self','parent','[0-9]*'
 * ''       : 自动获取NodeID，包括内容页属于的父节点NodeID，或者节点首页归属的节点NodeID
 * 'self'   : 等同于''
 * 'parent' : 等同于''NodeID的父节点NodeID
 * '[0-9]*' : 自定义NodeID，为数字
 *
 * @param array $params 
 * @access public
 * @return array
 */
function CMS_ExtraPublish($params)
{
    global $iWPC,$db,$table,$SYS_ENV,$db_config,$cmsware,$_BeanFactory;
    extract ($params, EXTR_PREFIX_SAME, "cms_");
	$cache = empty($cache) ? 0 : 2;
		
	if((empty($nodeid) || $nodeid == 'self') && $nodeguid =='') {
		$nodeid = empty($GLOBALS[IN][NodeID]) ? $GLOBALS[NodeID] : $GLOBALS[IN][NodeID];

	} elseif($nodeid == 'parent' && $nodeguid =='') {
		$SonNodeID = empty($GLOBALS[IN][NodeID]) ? $GLOBALS[NodeID] : $GLOBALS[IN][NodeID];
		$SonNodeInfo = $iWPC->loadNodeInfo($SonNodeID);
		$nodeid = $SonNodeInfo['ParentID'];
	
	} elseif($nodeguid !='') {
 			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);

			$nodeid = $resultGUID['NodeID'];
	 
 	}

	if(!empty($where)) {
		$where = "AND ".$where;
	}else {
		$where = "";
	}

	$NodeInfo = $iWPC->loadNodeInfo($nodeid);
 

	$ep = &$_BeanFactory->getBean('extra_publish');
	//$extraInfo = $ep->getAll($nodeid);

	$sql  ="SELECT t.*, u.uName as LastModifiedUser FROM $table->extra_publish t left join $table->user u ON   u.uId=t.LastModifiedUserID where t.NodeID='$nodeid' $where ";
	
	$result = $db->Execute($sql);
	while(!$result->EOF) {
		$result->fields['URL'] = $ep->getView($result->fields['PublishID']);
		$extraInfo[] = $result->fields;
		$result->MoveNext();
	}


 	return $extraInfo;

}



/*
 * 模板函数名称: 
 * 用途: 搜索相关文章
 * 传递的参数:
 * nodeid 搜索节点id("1,2,3";"all-5";"self";"6","")
 * field 搜索字段
 * keywords 搜索关键字
 * num 调用数量
 * orderby 排序字段
  $separator
$ignorecontentid
 */
function CMS_SEARCH($params)
{
    global $iWPC,$db,$table,$SYS_ENV,$db_config,$cmsware,$PageInfo;
	$PageMode = false;
    extract ($params, EXTR_PREFIX_SAME, "cms_");
	$cache = empty($cache) ? 0 : 2;
	if(!empty($returnkey)) {
		foreach(explode(',', $returnkey) as $key=>$var) {
			if($key==0) $c_return = "c.".$var;
			else $c_return .= ",c.".$var;
		}

	} else {
		$c_return .= "c.*";
	}
	//exact精确查找
	
	$exact = ($exact==1) ? true : false;

	/**
	初始化调用节点sql
	*/
	if(empty($nodeid)) { //所有节点
		$list_where = '';
	} elseif(preg_match("/^[0-9]+,[0-9]+/", $nodeid)) { //多个节点
		$list_where.= " AND i.NodeID IN($nodeid)";
		$nodeidArray = explode(',', $nodeid);
		$NodeInfo = $iWPC->loadNodeInfo($nodeidArray[0]);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}

	} elseif(preg_match("/^all-[0-9]+/", $nodeid)) { //根节点并包括所有子节点
		$nodeid = str_replace("all-",'',$nodeid);
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);
		$list_where.= " AND i.NodeID IN($nodeid)";
	} elseif($nodeid == 'self') { //自动获取节点,可以多个节点共享一个模板，用的就是self
		$nodeid = $GLOBALS[IN][NodeID];
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$list_where= " AND i.NodeID='$nodeid'";
	
	} else {//单一一个节点
		$NodeInfo = $iWPC->loadNodeInfo($nodeid);
		if(!$NodeInfo) {
			echo "<B>Error:</B>The NodeID <font color=#FF0000>{$nodeid}</font> you have set does not exist!";
			return false;
		}
		$list_where= " AND i.NodeID='$nodeid'";

	}

	if(isset($nodeguid)) {
		if(preg_match("/^[^,]+,[^,]+/", $nodeguid)) { //多个节点
			//$list_where.= " AND i.NodeID IN($nodeid)";
 			foreach(explode(',',  $nodeguid) as $key=>$var) {
				$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$var'", $cache);
				//$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
				if($key == 0) $nodeids = $resultGUID['NodeID'];
				else  $nodeids.=",".$resultGUID['NodeID'];


				$list_where= " AND i.NodeID IN($nodeids)";
		
			
			}

			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The NodeGUID <font color=#FF0000>{$var}</font> you have set does not exist!";
				return false;
			}

		} elseif(preg_match("/^all-[^,]+/", $nodeguid)) { //根节点并包括所有子节点
			$nodeguid = str_replace("all-",'',$nodeguid);
			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);

			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			if(!$NodeInfo) {
				echo "<B>Error:</B>The NodeGUID <font color=#FF0000>{$nodeguid}</font> you have set does not exist!";
				return false;
			}
			$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);
			$list_where.= " AND i.NodeID IN($nodeid)";
		} else {
			$resultGUID = $db->getRow("select * from $table->site where NodeGUID='$nodeguid'", $cache);
			$NodeInfo = $iWPC->loadNodeInfo($resultGUID['NodeID']);
			$list_where= " AND i.NodeID='".$resultGUID['NodeID']."'";
		
		}
	
	}  

	/**
	初始化调用数量sql
	*/
	if(empty($num)) {// 调用所有记录
		$list_limit = ' ';
	}elseif(preg_match("/^[0-9]+,[0-9]+$/", $num)){ //调用x,y条记录
		list($start,$offset) = explode(",",$num);
		$list_limit = " Limit $start,$offset ";
	}elseif(preg_match("/^page-[0-9]+$/", $num)){ //分页调用
		$offset = str_replace("page-",'', $num);
		$offset = (int)$offset;
		$PageMode = true;
	}elseif(preg_match("/^[0-9]+$/", $num)) { //调用0,x条记录
		$list_limit = " Limit 0,$num ";
	}else
		die("<font color =red >Fatal Error!</font> attribute 'num' invalid");


	/**
	初始化排序字段sql
	*/
	if(empty($orderby)) { //默认按照 置顶-权重-发布时间 排序
		$list_orderby = " ORDER BY i.Top DESC,i.Sort DESC,i.PublishDate DESC";

	} elseif($orderby == 'PublishDate'){ //兼容1.0.xx旧标签调用

		$list_orderby = " ORDER BY i.Top DESC,i.Sort DESC,i.PublishDate DESC";	
		
	} else { //用户可以自定义orderby属性
		$list_orderby = " ORDER BY $orderby ";
	}
	
	/**
	自定义where标签
	e.g : <where: c.Photo!=''> 可以实现只调用包括新闻图片的记录
	*/
	if(!empty($where)) {
		$where = "AND ".$where;
	}else {
		$where = "";
	}



	/**
	 * 搜索where
	 */
	 $field = empty($field) ? 'Keywords' : $field;

	 if(empty($keywords)) {
		echo "<!--Error:Please set the Keywords!-->";
		return false;
	 
	 } else {
		//$list_where. = "AND $field";

		$separator = empty($separator) ? ',' : $separator;
		$separator = str_replace("，", ',', $separator);//兼容中文，号
		$keywords = array_unique(explode($separator, $keywords));
		
		if(!is_array($keywords))
			return false;

		$i = 0;
		$list_where .= " AND ( ";
		foreach ($keywords as $key=>$var) {
			if($var=='') continue;
			
			if($exact) {
				if($i == 0) {
					$list_where .= " c.{$field}='{$var}' ";
				} else {
					$list_where .= "OR c.{$field}='{$var}' ";
				
				}			
			} else {
				if($i == 0) {
					$list_where .= " c.{$field}  LIKE '%{$var}%' ";
				} else {
					$list_where .= "OR c.{$field}  LIKE '%{$var}%' ";
				
				}			
			
			}

			$i++;



			
		}

		$list_where .= " ) ";



	 }

	/**
	 * 忽略本身的id
	 */
	if(!empty($ignorecontentid)) {
		$list_where .= "AND c.ContentID!= $ignorecontentid ";
	
	}

	 




	/**
	预设TableID
	*/
	if(empty($tableid)) {
		if(!empty($NodeInfo))
			$tableid = $NodeInfo[TableID];

	}

	$table_name = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$tableid;


	//如果是分页调用模式.continue...
	if($PageMode) {
		$sql_num = "SELECT Count(*) as TotalNum  FROM $table->content_index i,$table_name c where (i.PublishDate <= UNIX_TIMESTAMP() ) AND i.Type!=3 AND i.IndexID =c.IndexID  AND i.State!=-1  $list_where $where ";
		//echo $sql_num;exit;
		$result = $db->getRow($sql_num, 2);
		$TotalNum = $result[TotalNum];
		$TotalPage = ceil($result[TotalNum]/$offset);
		$SYS_ENV[tpl_pagelist][run] = "yes";

		if(empty($SYS_ENV[tpl_pagelist][page]))
			$SYS_ENV[tpl_pagelist][page] = 0;

		$start = ($SYS_ENV[tpl_pagelist][page])*$offset;
		$SYS_ENV[tpl_pagelist][page] = $SYS_ENV[tpl_pagelist][page] + 1;
		if(($start+$offset) >= $TotalNum)
			$SYS_ENV[tpl_pagelist][run] = "no";
		$list_limit = "Limit $start,$offset";

		$list_page = list_page($TotalPage,$SYS_ENV[tpl_pagelist][page],$SYS_ENV[tpl_pagelist][filename]);



		$cmsware['page'] = array (
			'TotalNum' => $TotalNum,
			'TotalPage' => $TotalPage,
			'CurrentPage' => $SYS_ENV[tpl_pagelist][page],
			'PageList' => $list_page,
			'URL'=> $SYS_ENV[tpl_pagelist][filename],

		);
		$PageInfo = $cmsware['page'];

		//print_r($cmsware);

	}
	$pub = new publishAdmin();

	$sql_query  = "SELECT i.NodeID,i.ContentID,i.State,i.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink, $c_return  FROM $table->content_index i ,$table_name c where (UNIX_TIMESTAMP() >= i.PublishDate)  AND i.IndexID =c.IndexID  AND i.State!=-1 AND i.Type!=3 $list_where $where  $list_orderby $list_limit";
	//echo $sql_query; 
	$result = $db->Execute($sql_query, $cache);
	while(!$result->EOF) {
		$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
		$pub->publishInfo = &$result->fields;
		$pub->IndexID = $result->fields[ContentID];
		foreach($result->fields as $key=>$var ) {
			//$pub->publishAll($var);
			$result->fields[$key] = $var;


		}
		$result->fields[NodeInfo] = $NInfo;
		$result->fields[NodeName] = $NInfo[Name];
		$result->fields[NodeURL] = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
		$data[] = $result->fields;
		$result->MoveNext();
	}
	return $data;
}




/*
 * 文章评论调用函数
 * 用途: 评论调用
 * 传递的参数:
 * indexid 
 * start 开始位置
 * num 调用数量
 * hiddenip 隐藏ip
 */
function CMS_COMMENT($params)
{
    global $iWPC,$db,$table,$SYS_ENV,$db_config,$PageInfo,$cmsware,$BeanFactory;
    extract ($params, EXTR_PREFIX_SAME, "cms_");
	$cache = empty($cache) ? 0 : 2;
	$return  = array();
	$NodeID = publishAdmin::getIndexInfo($indexid, 'NodeID');
	$NodeInfo = $iWPC->loadNodeInfo($NodeID);
	$start = empty($start) ? 0 : $start;
	$num   = empty($num) ? 10 : $num;
	$hiddenip = empty($hiddenip) ? 1 : $hiddenip;
	$orderby = empty($orderby) ? "CommentID DESC" :  $orderby;

	$table_comment = $db_config['table_pre'].'plugin_base_comment';
	$table_count = $db_config['table_pre'].'plugin_base_count';
	//$table_comment = empty($db_name) ? $db_config['table_pre'].'deploy_comment_'.$NodeInfo['TableID'] : $COMMENT_SETTING['db_name'] . '.' . $db_config['table_pre'].'deploy_comment_'.$NodeInfo['TableID'];
	//$table_count = empty($db_name) ? $db_config['table_pre'].'deploy_count_'.$NodeInfo['TableID'] : $COMMENT_SETTING['db_name'] . '.' . $db_config['table_pre'].'deploy_count_'.$NodeInfo['TableID'];
			
			$sc = &$BeanFactory->getBean('SettingCache');
			$commentSetting = $sc->load('plugin_base_comment');
			
			// {{{ add 2006-01-14
			if($commentSetting['enableCommentApprove'] == 1) {
				$where = " IndexID=$indexid AND Approved=1 ";
 			} else {
				$where = " IndexID=$indexid ";
 			}
			// }}}


	$sql="SELECT * FROM $table_comment where $where Order by $orderby LIMIT $start,$num";
				
	$recordSet=$db->Execute($sql,$cache);
				
	while(!$recordSet->EOF) {	
							
		if($hiddenip) {
			$pattern = "/^([0-9]+).([0-9]+).([0-9]+).([0-9]+)$/";
			$replacement = "\\1.\\2.\\3.*";
			$recordSet->fields[Ip] = preg_replace($pattern, $replacement, $recordSet->fields[Ip] );
					
		}
					
		$return[]=$recordSet->fields;
		$recordSet->MoveNext();
					
	}
	$recordSet->Close(); 

	$result = $db->getRow("SELECT CommentNum FROM $table_count  where IndexID='$indexid'",$cache);
	$PageInfo['CommentNum'] = $result['CommentNum'];
	//print_r($return);exit;
 	return $return;

}














/*
* =================================================================
*   SSI方式调用函数
* =================================================================
*/


class CMSware {
	/*
	* ------------------------------------------------------------------------------------------------------
	* 调用结点列表函数
	* type:      sub:子节点列表
	*               set:用户定义节点id列表,比如"1,2,55,67,889"
	* igoreNodeID: 要忽略的ID列表
	* ------------------------------------------------------------------------------------------------------
	*/
	function cms_nodelist($type, $NodeID, $tplname, $ignoreNodeID = '')
	{
		global $iWPC,$db,$table,$SYS_ENV;

		switch($type) {
			case 'sub':
				$sql = "SELECT NodeID FROM $table->site WHERE ParentID='$NodeID' ";
				$result = $db->Execute($sql);
				while(!$result->EOF) {
					$NInfo = $iWPC->loadNodeInfo($result->fields[NodeID]);
					if($NodeInfo[notExist]) {
						echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
						return false;
					}
					$URL = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
					$return[] = array(
						'Title'=> $NInfo[Name],
						'URL'=> $URL,

					);
					$result->MoveNext();
				}

				break;
			case 'set':
				$NodeIDs = explode(',', $NodeID);
				foreach($NodeIDs as $key=>$var) {

					$NInfo = $iWPC->loadNodeInfo($var);
					if($NodeInfo[notExist]) {
						echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
						return false;
					}
					$URL = CMSware::cms_getHtmlURL($NInfo[IndexName], $NInfo);
					$return[] = array(
						'Title'=> $NInfo[Name],
						'URL'=> $URL,

					);



				}

				break;
		}
		$template = new kTemplate();

		$template->caching = false;
		//$template->register_prefilter("CMS_TPL_Prefilter");

		$template->template_dir = $SYS_ENV[templatePath].'/ssi/';
		$template->compile_dir = SYS_PATH.'sysdata/templates_c/';
		$template->assign('List', $return);
		$template->display($tplname);

	}



	/*
	* ------------------------------------------------------------------------------------------------------
	* 调用导航条列表函数
	* igoreNodeID: 要忽略的ID列表
	* ------------------------------------------------------------------------------------------------------
	*/
	function cms_nav($ignoreNodeID = '')
	{
		global $NodeID,$iWPC;
		$NodeInfo = $iWPC->loadNodeInfo($NodeID);
		if($NodeInfo[notExist]) {
			echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
			return false;
		}
		$NodeArray = unserialize($NodeInfo[Nav]);
		$ignoreNodeIDs = explode(',', $ignoreNodeID);

		foreach($NodeArray as $key=>$var) {

			if(in_array($var[NodeID], $ignoreNodeIDs))
				continue;

			$NInfo = $iWPC->loadNodeInfo($var[NodeID]);
			$URL = CMSware::cms_getNodeUrl( $NInfo);

			if($key == 0) {

				$Navigation = "<a href='{$URL}' >{$var[Name]}</a>";

			} else {
				$Navigation .= "&nbsp;&gt;&nbsp;<a href='{$URL}' >{$var[Name]}</a>";

			}


		}

		echo $Navigation;

	}



	/*
	* ------------------------------------------------------------------------------------------------------
	* 函数
	* ------------------------------------------------------------------------------------------------------
	*/
	function cms_getHtmlURL($publishFileName, $NodeInfo)
	{
			global $SYS_ENV;

			if($NodeInfo['PublishMode'] == 1) {
				$patt = "/{PSN-URL:([0-9]+)}([\S]*)/is";
				$publishFileName = str_replace('{NodeID}', $NodeInfo['NodeID'], $publishFileName);
				
				foreach($NodeInfo as $key=>$var) {
					$publishFileName = str_replace('{'.$key.'}', $var, $publishFileName);
				
				}

				if(preg_match("/\{(.*)\}/isU", $publishFileName , $match)) {
					eval("\$fun_string = $match[1];");
					$publishFileName  = str_replace($match[0], $fun_string, $publishFileName );

				}

				if(preg_match ($patt, $NodeInfo[ContentURL] ,$matches)) {
					$PSNID = $matches[1];
					$publish_path = $matches[2];
					$psnInfo = psn_admin::getPSNInfo($PSNID);

					$url = $psnInfo[URL].$publish_path.'/'.$publishFileName;


				} else {
					$url = $NodeInfo[ContentURL].'/'.$publishFileName;
				}			
			} elseif($NodeInfo['PublishMode'] == 2 || $NodeInfo['PublishMode'] == 3) {
				$url = str_replace('{NodeID}', $NodeInfo['NodeID'], $NodeInfo['IndexPortalURL']);
				$url = str_replace('{Page}', 0, $url);
			
			}



		$url = formatPublishFile($url);


			return $url;
	}



	/*
	* ------------------------------------------------------------------------------------------------------
	* 函数
	* ------------------------------------------------------------------------------------------------------
	*/
	function cms_getNodeUrl($NodeInfo)
	{
			global $SYS_ENV;
			$patt = "/{PSN-URL:([0-9]+)}([\S]*)/is";

			if(preg_match ($patt, $NodeInfo[ContentURL] ,$matches)) {
				$PSNID = $matches[1];
				$publish_path = $matches[2];
				$psnInfo = psn_admin::getPSNInfo($PSNID);

				$url = $psnInfo[URL].$publish_path.'/'.$NodeInfo[IndexName];


			} else {
				$url = $NodeInfo[ContentURL].'/'.$NodeInfo[IndexName];
			}
					
		$url = formatPublishFile($url);

		return $url;
	}
 

	function cms_content($IndexID,$tplname)
	{
		global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware;

		$NodeID= publishAdmin::getIndexInfo($IndexID, $field = 'NodeID');
		//echo $NodeID;
		$NodeInfo = $iWPC->loadNodeInfo($NodeID);
		if($NodeInfo[notExist]) {
			echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
			return false;
		}
		//print_r($NodeInfo);
		$More = CMSware::cms_getNodeUrl($NodeInfo);

		$table_name = $db_config['table_pre'].$db_config['table_content_pre'].'_'.$NodeInfo[TableID];
		$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i2.URL,i.IndexID,i.PublishDate,i.Type,c.* FROM $table->content_index i,$table->content_index i2 ,$table_name c where (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.ContentID =c.ContentID  AND i2.State=1 AND i.State!=-1 AND i2.Type!=3 AND i.IndexID='{$IndexID}'";


		// echo $sql_query;
		$result = $db->getRow($sql_query);
		$template = new kTemplate();
		//print_r($result);
		$template->caching = false;

		$template->template_dir = $SYS_ENV[templatePath].'/ssi/';
		$template->compile_dir = SYS_PATH.'sysdata/templates_c/';
		$template->assign('Content', $result);
		$template->assign('More', $More);
		$template->display($tplname);
	}

	/*
	* ------------------------------------------------------------------------------------------------------
	 *文章列表调用函数
	 *type 调用类型
	 *nodeid 调用节点id
	 *num 调用数量
	 *substr 取串长度
	 *tableid 表id
	 *tplname 调用模板文件名SSI方式
		暂未用 *orderby 排序字段
		暂未用 *order 排序 DESC ASC
	 *articleID 指定的文章id，可忽略
	* ------------------------------------------------------------------------------------------------------
	*/
                   /*
	     modify by Daniel,2004.7.21,增加了参数:$articleID,用于调用指定文章ID
	*/
	function cms_list($type, $nodeid, $num, $substr, $tableid,$tplname = 'list.default.html',$articleID)
	{
		global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware;
		$PageMode = false;


		/**
		初始化调用节点sql
		*/
		if(empty($nodeid)) { //所有节点
			$list_where = '';
		} elseif(preg_match("/^[0-9]+,[0-9]+/", $nodeid)) { //多个节点
			$list_where.= " AND i.NodeID IN($nodeid)";

		} elseif(preg_match("/^all-[0-9]+/", $nodeid)) { //根节点并包括所有子节点
			$nodeid = str_replace("all-",'',$nodeid);
			$NodeInfo = $iWPC->loadNodeInfo($nodeid);
			if($NodeInfo[notExist]) {
				echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
				return false;
			}
			$More = cms_getNodeUrl($NodeInfo);

			$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);

			$list_where.= " AND i.NodeID IN($nodeid)";
		}else {//单一一个节点
			$NodeInfo = $iWPC->loadNodeInfo($nodeid);
			if($NodeInfo[notExist]) {
				echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
				return false;
			}
			$More = CMSware::cms_getNodeUrl($NodeInfo);
			$list_where= " AND i.NodeID='$nodeid'";
		}

        /* Add by Daniel,2004.7.21,增加调用指定文章id的查询参数串 */

	if(empty($articleID)) { //所有节点
		$list_assign = '';
	} else {//单一一个节点
		$list_assign = " AND i.ContentID='$articleID'";
	}
    /* Add end by Daniel,2004.7.21 */

		/**
		初始化调用数量sql
		*/
		if(empty($num)) {
			$list_limit = ' ';
		}elseif(preg_match("/^[0-9]+,[0-9]+$/", $num)){
			list($start,$offset)=explode(",",$num);
			$list_limit = " Limit $start,$offset ";
		}elseif(preg_match("/^page-[0-9]+$/", $num)){
			$offset = str_replace("page-",'', $num);
			$offset = (int)$offset;
			$PageMode = true;
		}elseif(preg_match("/^[0-9]+$/", $num)) {
			$list_limit = " Limit 0,$num ";
		}else
			die("<font color =red >Fatal Error!</font> 你的调用语法书写有误,请返回修改!");


		/**
		初始化排序字段sql
		*/
		if(!empty($orderby)) {
			$list_orderby = " ORDER BY i.Top DESC,i.{$orderby} ";
		}else {
			$list_orderby = " ORDER BY i.Top DESC,i.PublishDate ";
		}



		/**
		初始化排序sql
		*/
		if(!empty($order)) {
			$list_order = " $order ";
		}else {
			$list_order = " DESC ";
		}

		/**
		预设TableID
		*/
		if(empty($tableid)) {
			if(!empty($NodeInfo))
				$tableid = $NodeInfo[TableID];
		}

		$table_name = $db_config['table_pre'].$db_config['table_content_pre'].'_'.$tableid;

		if($PageMode) {
			$sql_num = "SELECT Count(*) as TotalNum  FROM $table->content_index i,$table->content_index i2 ,$table_name c where (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i.IndexID =c.IndexID  AND i2.State=1 AND i.State!=-1  AND i2.Type!=3 $list_where $list_assign ";

			$result = $db->getRow($sql_num);
			$TotalNum = $result[TotalNum];
			$TotalPage = ceil($result[TotalNum]/$offset);
			$SYS_ENV[tpl_pagelist][run] = "yes";

			if(empty($SYS_ENV[tpl_pagelist][page]))
				$SYS_ENV[tpl_pagelist][page] = 0;

			$start = ($SYS_ENV[tpl_pagelist][page])*$offset;
			$SYS_ENV[tpl_pagelist][page] = $SYS_ENV[tpl_pagelist][page] + 1;
			if(($start+$offset) >= $TotalNum)
				$SYS_ENV[tpl_pagelist][run] = "no";
			$list_limit = "Limit $start,$offset";

			$list_page = list_page($TotalPage,$SYS_ENV[tpl_pagelist][page],$SYS_ENV[tpl_pagelist][filename]);

			$cmsware['page'] = array (
				'TotalNum' => $TotalNum,
				'TotalPage' => $TotalPage,
				'CurrentPage' => $SYS_ENV[tpl_pagelist][page],
				'PageList' => $list_page,

			);

			//print_r($cmsware);

		}

		$sql_query  = "SELECT i2.NodeID,i2.ContentID,i2.State,i2.URL,i.IndexID,i.PublishDate,i.Type,c.* FROM $table->content_index i,$table->content_index i2 ,$table_name c where (UNIX_TIMESTAMP() >= i.PublishDate) AND i.ParentIndexID=i2.IndexID AND i2.ContentID =c.ContentID  AND i2.State=1 AND i.State!=-1 AND i2.Type!=3 $list_where $list_assign  $list_orderby $list_order $list_limit";
		//echo $sql;exit;
		$result = $db->Execute($sql_query);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}

		/**
		开始进行调用类型判断
		*/
		switch ($type) {
			case 'node':
				break;
			case 'new':
				break;
			case 'hot':
				break;
			case 'comment':
				break;
		}

		$template = new kTemplate();

		$template->caching = false;
		//$template->register_prefilter("CMS_TPL_Prefilter");

		$template->template_dir = $SYS_ENV[templatePath].'/ssi/';
		$template->compile_dir = SYS_PATH.'sysdata/templates_c/';
		$template->assign('List', $data);
		$template->assign('More', $More);
		$template->display($tplname);
		//debug($data);
		//return $data;
	}





	/*
	* ------------------------------------------------------------------------------------------------------
	 *图片文章列表调用函数
	 *type 调用类型
	 *nodeid 调用节点id
	 *pixel 图片
	 *num 调用数量
	 *td 
	 *substr 取串长度
	 *tableid 表id
	 *tplname 调用模板文件名SSI方式
		暂未用 *orderby 排序字段
		暂未用 *order 排序 DESC ASC
	 *articleID 指定的文章id，可忽略
	* ------------------------------------------------------------------------------------------------------
	*/
	 /*
	     modify by Daniel,2004.7.21,增加了参数:$articleID,用于调用指定文章ID
	*/
	function cms_photolist($type, $nodeid, $pixel, $num, $td, $substr, $tableid, $tplname = 'photo_list.default.html',$articleID)
	{
		global $db,$SYS_ENV,$table,$iWPC,$db_config,$cmsware;

		/**
		初始化调用节点sql
		*/
		if(empty($nodeid)) { //所有节点
			$list_where = '';
		} elseif(preg_match("/^[0-9]+,[0-9]+/", $nodeid)) { //多个节点
			$list_where.= " AND i.NodeID IN($nodeid)";

		} elseif(preg_match("/^all-[0-9]+/", $nodeid)) { //根节点并包括所有子节点
			$nodeid = str_replace("all-",'',$nodeid);
			$NodeInfo = $iWPC->loadNodeInfo($nodeid);
			if($NodeInfo[notExist]) {
				echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
				return false;
			}

			$More = cms_getNodeUrl($NodeInfo);

			$nodeid=str_replace('%', ',', $NodeInfo[SubNodeID]);

			$list_where.= " AND i.NodeID IN($nodeid)";
		}else {//单一一个节点
			$NodeInfo = $iWPC->loadNodeInfo($nodeid);
			if($NodeInfo[notExist]) {
				echo '<B>Error:</B>The NodeID <font color=#FF0000></font> you have set does not exist!';
				return false;
			}
			$More = CMSware::cms_getNodeUrl($NodeInfo);
			$list_where= " AND i.NodeID='$nodeid'";
		}

         /* Add by Daniel,2004.7.21,增加调用指定文章id的查询参数串 */

	if(empty($articleID)) { //所有节点
		$list_assign = '';
	} else {//单一一个节点
		$list_assign = " AND i.ContentID='$articleID'";
	}
    /* Add end by Daniel,2004.7.21 */

		/**
		初始化调用数量sql
		*/
		if(empty($num)) {
			$list_limit = ' ';
		}elseif(preg_match("/^[0-9]+,[0-9]+$/", $num)){
			list($start,$offset)=explode(",",$num);
			$list_limit = " Limit $start,$offset ";
		}elseif(preg_match("/^page-[0-9]+$/", $num)){
			$offset = str_replace("page-",'', $num);
			$offset = (int)$offset;
			$PageMode = true;

		}elseif(preg_match("/^[0-9]+$/", $num)) {
			$list_limit = " Limit 0,$num ";
		}else
			die("<font color =red >Fatal Error!</font> 你的调用语法书写有误,请返回修改!");


		/**
		初始化排序字段sql
		*/
		if(!empty($orderby)) {
			$list_orderby = " ORDER BY i.Top DESC,i.{$orderby} ";
		}else {
			$list_orderby = " ORDER BY i.Top DESC,i.PublishDate ";
		}



		/**
		初始化排序sql
		*/
		if(!empty($order)) {
			$list_order = " $order ";
		}else {
			$list_order = " DESC ";
		}

		list($dstW,$dstH)=explode("*",$pixel);

		/**
		预设TableID
		*/
		if(empty($tableid)) {
			if(!empty($NodeInfo))
				$tableid = $NodeInfo[TableID];
		}

		$table_name = $db_config['table_pre'].$db_config['table_content_pre'].'_'.$tableid;
        

		$sql  ="SELECT i.*,c.* FROM $table->content_index i LEFT JOIN $table_name c ON i.IndexID =c.IndexID LEFT JOIN $table->site n  ON n.NodeID=i.NodeID where (UNIX_TIMESTAMP() >= PublishDate) $list_where  AND i.State=1 $list_orderby $list_order $list_limit";
		//echo $sql;exit;
		$result = $db->Execute($sql);
		$i=0;
		while(!$result->EOF) {
			$data[$i] = $result->fields;
			$data[$i][PhotoData]="src=\"{$data[$i][Photo]}\" width=$dstW height=$dstH";
			$i++;
			$result->MoveNext();
		}
		/**
		开始进行调用类型判断
		*/
		switch ($type) {
			case 'node':
				break;
			case 'new':
				break;
			case 'hot':
				break;
			case 'comment':
				break;
		}

		$template = new kTemplate();
		//$template->register_prefilter("CMS_TPL_Prefilter");
		$template->assign('td',$td);

		$template->template_dir = $SYS_ENV[templatePath].'/ssi/';
		$template->compile_dir = SYS_PATH.'sysdata/templates_c/';
		$template->assign('List', $data);
		$template->assign('More', $More);
		$template->display($tplname);
		//debug($data);
		//return $data;
	}

}

?>