<?php
/* ----------------------------------------------------------------------------
普通搜索程序 使用说明(前台publish基础插件):
-------------------------------------------
search.php?o=search&TableID=1&Field=Content&Keywords=关键字&NodeID=1,2,3&Sub=1&Page=1

**以下是可用参数,大小写敏感,在URL中写时用&分开:
o=search 则触发搜索,否则显示默认页,或
o=pro 显示高级搜索参数页 *此参数必须要
TableID 内容模型ID，例如新闻模型的ID为1，*此参数必须要
Field 后台所设置的可搜索字段名,大小写敏感,可用英文逗号分开多个,或在HTML表单中用多个Input做成数组，*此参数必须要
Keywords 关键字,支持多组关键字，对应多个搜索字段Field，每组之间用英文逗号分开。 而在每组关键字中还可以用空格分开多个词在同一字段中搜索。大小写敏感。也可把每一组关键字在HTML表单中用多个Input做成数组。*此参数必须要
  注意: 如果使用多个字段,则字段和关键字的组数一定要匹配!!!!
  举例: Field=Title,Content&Keywords=中国,上海 小吃
  以上的参数指定搜索 Title标题 字段中包含'中国',而且 Content内容 字段中包含'上海'和'小吃'的记录
Andor 逻辑运算联结符，支持多组，用于多组字段关键字之间的逻辑运算联结符,默认都为AND,可以不要此参数。如果加此参数，请注意是和字段数有关的，如有三个字段，此参数最大就有两组，每组值可为空，为空或拼错字母时默认为AND
NodeID 搜索的节点,可用英文逗号分开多个, 可以不要此参数
Sub 是否搜索子节点, 0为不搜索(默认), 1为搜索,可以不要此参数
Time 检索内容的时间限制,可以不要此参数
Page 分页号，可以不要，默认是1
Tpl 指定结果页模板文件名,从模板目录的根目录开始指定,如/plugins/base/search_2.html，可以不要此参数，默认是用在后台基础插件设置中设置的那个模板
Orderby 指出排序关键字, 一般情况不需要用， 如默认为"PublishDate DESC, IndexID DESC" ,可以不要此参数,默认排序是按IndexID(索引id)倒序排列,即最后发表的在前

---------------------------
**结果页里可用模板变量如下：
searchResult  搜索结果数组
pageList  分页列表
searchResultInfo  搜索结果信息（num,from,to,pageNum）
searchKeywords  第一个非空的单关键字
KeywordsList  空格分开的所有关键字列表（可用于高亮函数）
--------------------------------------------------------------------------  */

/* 
更新：easyT,2005.11.10
    增加操作符参数Op，可以指定不同组字段的比较操作符,用逗号分开多组，如果为空默认为模糊匹配查找(Like方式)
　　　“LT”意为“小于，less than”；
　　　“GT”意为“大于，greater than”；
　　　“EQ”意为“等于，equal”； 
　　　“LE”意为“小于等于，less than or equal”； 
　　　“GE”意为“大于等于，greater or equal”； 
　　　“NE”意为“不等于， not equal”；
	 “IN”意为在列表中，列表项间用空格分开
	 “LK”意为在目标串中模糊匹配查找Like
     “BT”意为在。。。范围之间，范围值用空格分开

更新: easyT,2005.08.10
    *现在开始,可以构建复杂查询应用
    + 增加可以同时使用多个字段和关键字组合查询的处理,用逗号分开传递或使用HTML表单数组传递,默认用AND关联条件
    + 增加Andor参数可以指定不同的字段关键字组合之间的逻辑运算符
    + 增加Orderby参数可以指定排序关键字,修正为默认按IndexID倒序排列,大的最后发表在前
    + 增加了Tpl参数来指定结果页模板文件或高级搜索页模板
    + 增加了可以在一个关键字中使用空格分开多个词
*/

require_once 'common.php';  //调用公共文件,其中调用公共config.php
require_once ROOT_PATH.'plugins/base/plugin.config.php';     //调用cmsware系统目录下的基础插件配置
require_once "search.lang.php";


//搜索处理开始
$TableID = empty($IN['TableID'])? 1 : intval($IN['TableID']);
$Setting = $db->getRow("SELECT * FROM {$plugin_table['base']['setting']}  WHERE TableID=$TableID ");
if(empty($Setting['TableID'])) {
	goback('invalid_tableid_setting');
}
//设置默认结果页模板
if(empty($IN['Tpl'])) {
	if(preg_match("/\{TID:([0-9]+)\}/isU", $Setting['SearchTpl'], $matches)) { 
		require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
		if(!isset($cate_tpl)) {
			$cate_tpl = new cate_tpl_admin();
			$TID = $matches[1];
			$TInfo = $cate_tpl->getInfo($TID);
			$Setting['SearchTpl']="/ROOT/".$TInfo[TCID]."/".$TInfo[TID].".tpl";
				
		}
			
	}
	$tpl = &$Setting['SearchTpl'];  //没有Tpl参数就设置为后台预设的结果页模板
} else {
    //去掉传入的地址中的..为了安全,然后有Tpl参数就设置为指定的结果页模板
  	$tpl = str_replace("..", "", $IN['Tpl']);
}
$TPL->registerPreFilter('CMS_Parser');

switch($IN['o']) {
	case 'pro':
        //高级搜索方式
	    //设置默认结果页模板
	    if(empty($IN['Tpl'])) {
	        $tpl = &$Setting['SearchProTpl'];  //没有Tpl参数就设置为后台预设的高级搜索页模板
	    } else {
	        //去掉传入的地址中的..为了安全,然后有Tpl参数就设置为指定的高级搜索页模板
	        $tpl = str_replace("..", "", $IN['Tpl']);
	    }
		include_once(CACHE_DIR.'Cache_CateList.php');
		$TPL->assign('Cate_List', $NODE_LIST);
		$TPL->assign('TableID', $IN['TableID']);
		$TPL->display($tpl);
		break;

	case 'search':
    	//搜索动作
  		$table_publish = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$TableID;
		$table_count =  &$plugin_table['base']['count'];
		if(empty($IN['Keywords'])) goback('please_input_keywords');
		if(empty($IN['Field'])) goback('please_input_field');

        //检查在后台搜索插件中设置的可搜索字段是否匹配
        $validFields = explode(',', $Setting['AllowSearchField']);
		if(empty($Setting['AllowSearchField'])) {}
		else {
			foreach(explode(',', $IN['Field']) as $fieldvar) {
				if( !in_array($fieldvar, $validFields) ) goback('invalid_field');
			}
		}


     //处理 搜索字段 和 关键字 和 操作符 数组,组合成条件串 同时 形成逗号分隔串供URL参数传递用(add by easyt 2005.02.24
        if(!is_array($IN['Field'])) {
			$IN['Field'] = addslashes($IN['Field']);
			$IN['Field'] = explode(',', $IN['Field']);   //如果字段不是数组就转换成数组
        }
        if(!is_array($IN['Keywords'])) {
			$IN['Keywords'] = addslashes($IN['Keywords']);
			$IN['Keywords'] = explode(',', $IN['Keywords']);   //如果关键字不是数组就转换成数组
        }
	$isOp = false;
	if( isset($IN['Op']) ) {
        if(!is_array($IN['Op'])) {
			$IN['Op'] = addslashes($IN['Op']);
			$IN['Op'] = explode(',', $IN['Op']);   //如果操作符不是数组就转换成数组
			$isOp = true;
        }
	}
	$isAndor = false;
	if( isset($IN['Andor']) ) {
		if( !is_array($IN['Andor']) ) {
			$IN['Andor'] = addslashes($IN['Andor']);
			$IN['Andor'] = explode(',', $IN['Andor']);   //如果逻辑运算符不是数组就转换成数组
			$isAndor = true;
		}
	}

  	//开始组合条件串,同时把字段和关键字数组生成逗号分开的字符串供URL传递
 	$field_where = '';	//字段条件串
    $field_list = '';	//字段列表
    $keywords_list = '';	//关键字列表
	$andor_list = '';	//逻辑运算符列表
	$op_list = '';	//操作符列表

	foreach($IN['Field'] as $key=>$var) {
            if ( !empty($IN['Field'][$key]) && !empty($IN['Keywords'][$key]) ) {

            	if ( !empty($IN['Op'][$key]) ) {	//如果操作符不为空，则组合操作符和关键字
                	switch ( substr(strtoupper($IN['Op'][$key]),0,2) ) {
                		case 'EQ':	//等于
 	               			$strWhere = $IN['Field'][$key]." = '".$IN['Keywords'][$key]."'";
                			break;
                		case 'LT':	//小于
 	               			$strWhere = $IN['Field'][$key]." < '".$IN['Keywords'][$key]."'";
                			break;
                		case 'LE':	//小于等于
 	               			$strWhere = $IN['Field'][$key]." <= '".$IN['Keywords'][$key]."'";
                			break;
                		case 'GT':	//大于
 	               			$strWhere = $IN['Field'][$key]." > '".$IN['Keywords'][$key]."'";
                			break;
                		case 'GE':	//大于等于
 	               			$strWhere = $IN['Field'][$key]." >= '".$IN['Keywords'][$key]."'";
                			break;
                		case 'NE':	//不等于
 	               			$strWhere = $IN['Field'][$key]." <> '".$IN['Keywords'][$key]."'";
                			break;
                		case 'IN':	//在列表中，列表项间用空格分开
 	               			$strWhere = $IN['Field'][$key]." IN ('" . str_replace(" ","','",ltrim(trim($IN['Keywords'][$key]))) . "')";
                			break;
                		case 'LK':	//模糊匹配查找
		                	$strWhere = $IN['Field'][$key]." LIKE '%".str_replace(" ", "%", $IN['Keywords'][$key])."%'";  //组合,关键字中间的空格变成%
                			break;
                		case 'BT':	//在。。范围之间，范围值用空格分开
 	               			$strWhere = $IN['Field'][$key]." BETWEEN " . str_replace(" "," and ",ltrim(trim($IN['Keywords'][$key])));
                			break;
                	}
                } else {	//如果操作符为空则默认模糊查找
                	$strWhere = $IN['Field'][$key]." LIKE '%".str_replace(" ", "%", $IN['Keywords'][$key])."%'";  //组合,关键字中间的空格变成%
                }

                if( $field_where=='' ) {
                    $field_where = $strWhere;   //关键字条件串
                    $field_list = $IN['Field'][$key];
                    $keywords_list = $IN['Keywords'][$key];
                    $op_list = $IN['Op'][$key];
                } else{
					if ( $isAndor && (in_array(strtoupper($IN['Andor'][$key-1]), array('AND','OR'))) ) {
						$andor_list .= (empty($andor_list) ? '' : ',') . $IN['Andor'][$key-1];	//逻辑运算符个数要比字段个数少一个,从第二个字段前面开始加
						$field_where .= " ".$IN['Andor'][$key-1]." ".$strWhere;    //关键字条件串追加组合
					}
					else {
						$field_where .= ' AND '.$strWhere;    //关键字条件串追加组合
					}
					$field_list .= ','.$IN['Field'][$key];
					$keywords_list .= ','.$IN['Keywords'][$key];
					$op_list .= ','.$IN['Op'][$key];
                }
            };
        }
	$isAndor = !empty($andor_list);
	$isOp = !empty($op_list);
//echo $field_where."<br>".$field_list."<br>".$keywords_list."<br>".$andor_list; die;


        //处理 结点NodeID参数，变成条件串
		$node_list = '';
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
			$node_list = $node_where; 
			$node_where = "AND p.NodeID IN($node_where)";
		}


        //处理页号和搜索时间段参数
 		$offset = &$Setting['SearchPageOffset'];
		$Page = empty($IN['Page']) ? 1 : intval($IN['Page']);
		$Time = empty($IN['Time']) ? 0 : intval($IN['Time']);
		if($Time == 0) {
			$time_where = '';
 		} else {
			$timestamp = time() - $Time*60*60*24;
			$time_where = 'AND p.PublishDate > '.$timestamp;
  		}

		//处理排序字段参数
		$isOrderby = !empty($IN['Orderby']);
		$Orderby = empty($IN['Orderby']) ? "p.PublishDate DESC, p.IndexID DESC" : $IN['Orderby'];

		//echo $node_where;exit;
        //查询总共计数
		$result= $db->getRow("SELECT COUNT(*) as nr  From $table_publish p WHERE  $field_where $node_where $time_where");
		$num= intval ($result[nr]);

		$pagenum=ceil($num/$offset);
 		$start=($Page-1)*$offset;


		//防SQL注入检查, 过滤掉分号-----------
		$field_where = str_replace(';','',$field_where);
		$keywords_where = str_replace(';','',$keywords_where);
		$node_where = str_replace(';','',$node_where);
		$time_where = str_replace(';','',$time_where);
		$Orderby = str_replace(';','',$Orderby);

		//组合所有的条件参数，形成SQL查询语句
		$sql = "SELECT p.*,co.* From $table_publish p left join $table_count co ON p.IndexID=co.IndexID  WHERE  $field_where $node_where $time_where ORDER BY $Orderby Limit $start, $offset ";
		//echo $sql;
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}

		$sendVar= 'search.php?o=search&amp;TableID='.$TableID.'&amp;Keywords='.urlencode($keywords_list).'&amp;Field='.$field_list;
		if ( $isAndor ) { $sendVar .= '&amp;Andor='.$andor_list; }	//如果传入时有Andor参数,则附加上
		if ( $isOrderby ) { $sendVar .= '&amp;Orderby='.$Orderby; } //如果传入时有Orderby参数 ,则加上
		if ( $isOp ) { $sendVar .= '&amp;Op='.$op_list; } //如果传入时有Op参数 ,则加上
		if ( !empty($node_list) ) { $sendVar .= '&amp;NodeID='.$node_list; }  //如果传入时有NodeID参数就加上
		if ( !empty($IN['Sub']) ) { $sendVar .= '&amp;Sub='.$IN['Sub']; }  //如果传入时有Sub参数就加上
		if ( !empty($IN['Time']) ) { $sendVar .= '&amp;Time='.$IN['Time']; }  //如果传入时有Time参数就加上
		if ( !empty($IN['Tpl'])) { $sendVar .= '&amp;Tpl='.$tpl; }  //如果传入时有Tpl参数就加上
		
		$pagelist=search_page($pagenum, $Page, $sendVar);

		$searchResultInfo=array(
				  'num'    => $num,
				  'from' => ($start+1),
				  'to'		=> ($start+$offset),
				  'pageNum'=>$pagenum,
				  );

		$tmpkeywords = explode(',',$keywords_list);  //只取第一个关键字,方便结果页里调用
		$keywordslist = str_replace(',',' ',$keywords_list);

if ($IN['DEBUG']==='YES') {print_r($GLOBALS); die;}  //调试用==================================================

		$TPL->assign("searchResult", $data);
		$TPL->assign('pageList',$pagelist);
		if($searchResultInfo[num] < $searchResultInfo[to]) {
				$searchResultInfo[to]=$searchResultInfo[num];
		}
		$TPL->assign('TableID',$IN['TableID']);
		$TPL->assign_by_ref('searchResultInfo',$searchResultInfo);
		$TPL->assign_by_ref('searchKeywords', $tmpkeywords[0]);
		$TPL->assign_by_ref('KeywordsList', $keywordslist);
		$TPL->assign_by_ref('IN', $IN);
		$TPL->display($tpl);
		break;
	default:
 		$TPL->display($tpl);
		break;
}

include('debug.php');

?>