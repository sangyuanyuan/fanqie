<?php

/*
* ------------------------------------------------------------------------------------------------------
 * 文章列表调用自动分页函数，用户可修改定义样式
 * list_page($pagenum,$currentpage,$sendVar)
* ------------------------------------------------------------------------------------------------------
 **/



function list_page($PageNum,$CurrentPage,$Url, $lang = '上一页,下一页,前10页,下10页') {
 	list($lang_previous, $lang_next, $lang_previous10, $lang_next10) = explode(',', $lang);
	$page = "";
	$header = floor($CurrentPage/10);

	$start = $header*10;

	for($i= $start;$i<=$start + 9;$i++){


		if($i+1 > $PageNum) break;
		if($i == 0) {
			$link = $Url;

		} else
			$link = preg_replace("/\.([A-Za-z0-9]+)$/isU","_$i.\\1",$Url);

		$j = $i+1;

		 
		
		if($CurrentPage-1 ==$i){
			//$page.= "<b>[".$j."]</b>&nbsp;";
			$page.= "[".$j."]&nbsp;";
		}else{

			$page.= "<a href='".$link."'>".$j."</a>&nbsp;";
		}

	}

	if ($CurrentPage < $PageNum) {
		$link1= preg_replace("/\.([A-Za-z0-9]+)$/isU","_".$CurrentPage.".\\1",$Url);
		$page= $page."&nbsp;<b><a href='".$link1."' >".$lang_next."</a></b>";
	}

	if($CurrentPage > 1) { //前一页
		if(($CurrentPage-1) == 1)
			$link1 = $Url;
		else
			$link1= preg_replace("/\.([A-Za-z0-9]+)$/isU","_".($CurrentPage-2).".\\1",$Url);
		$page= "<b><a href='".$link1."' >".$lang_previous."</a></b>&nbsp;&nbsp;".$page;
	}

	if((($CurrentPage+10)) <= $PageNum && (($CurrentPage-10) <= 0)) {
		$i =  $start + 10;
		$link = preg_replace("/\.([A-Za-z0-9]+)$/isU","_$i.\\1",$Url);
		$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >".$lang_next10."</a></b>";
	} elseif(($CurrentPage-10) >= 0 && ($CurrentPage+10) >= $PageNum) {
		$i =  $start - 10;
		if($i == 0)
			$i='';
		else
			$i="_$i";
		$link = preg_replace("/\.([A-Za-z0-9]+)$/isU","$i.\\1",$Url);
		$page= "<b><a href='".$link."' >".$lang_previous10."</a></b>&nbsp;&nbsp;".$page;

	}elseif((($CurrentPage-10) > 0) && (($CurrentPage+10) < $PageNum)) {
		$i =  $start - 10;
		if($i == 0)
			$i='';
		else
			$i="_$i";
		$link = preg_replace("/\.([A-Za-z0-9]+)$/isU","$i.\\1",$Url);
		$i =  $start + 10;
		$link1 = preg_replace("/\.([A-Za-z0-9]+)$/isU","_$i.\\1",$Url);


		$page= "<b><a href='".$link."' >".$lang_previous10."</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >".$lang_next10."</a></b>";

	}
	return $page;

}

/**
 * 生成导航分页
 * @param int $pagenum 总页数
 * @param int $currentpage  当前页
 * @param int $sendVar 传入的URL
 *        -  php程序分页  index.php?action=list&page={page} 生成 index.php?action=list&page=, index.php?action=list&page=1, index.php?action=list&page=2
 *        -  静态分页     index{symbol}{page}.html 生成 index.html, index_1.html, index_2.html
 * @param string $symbol page标
 * @param string $code 分页的函数
 */
function Content_Page($pagenum,$currentpage,$sendVar,$symbol = '_', $code = '上一页,下一页,前10页,下10页') {
	
	$currentpage--;
	if($pagenum == '')
		return false;
	$header = floor($currentpage/10);
	$pagenum--;
	$start = $header*10;
	$code = explode(',', $code);
	for($i= $start;$i<=$start + 9;$i++){
		
		if($i == 0) {
			$link = str_replace("{symbol}", '', $sendVar);
			$link = str_replace("{page}", '', $link);
			
		} else {
			$link = str_replace("{symbol}", $symbol, $sendVar);
			$link = str_replace("{page}", $i, $link);
		
		}
		
		 
		if($currentpage==$i){
			$page.= "<b>[".($i+1)."]</b>&nbsp;";
		}else{
			
			$page.= "<a href='".$link."'>".($i+1)."</a>&nbsp;";
		}
		if($i==$pagenum) break;
	
	}
	if ($currentpage + 1 <= $pagenum) {
		$link1 = str_replace("{symbol}", $symbol, $sendVar);
		$link1 = str_replace("{page}", $currentpage+1, $link1);
		$page= $page."&nbsp;<b><a href='".$link1."' >{$code[1]}</a></b>";
	}
	
	if($currentpage > 0) {
		if(($currentpage-1) == 0) {
			$link1 = str_replace("{symbol}", '', $sendVar);
			$link1 = str_replace("{page}", '', $link1);

		} else {
			$link1 = str_replace("{symbol}", $symbol, $sendVar);
			$link1 = str_replace("{page}", $currentpage-1, $link1);
		
		}
		$page= "<b><a href='".$link1."' >{$code[0]}</a></b>&nbsp;&nbsp;".$page;
	}

	
		
	if((($currentpage+9)) < $pagenum && (($currentpage-9) <= 0)) {
		$i =  $start + 10;

		$link1 = str_replace("{symbol}", $symbol, $sendVar);
		$link1 = str_replace("{page}", $i, $link1);
		$page= $page."&nbsp;&nbsp;<b><a href='".$link1."' >{$code[3]}</a></b>";
	}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
		$i =  $start - 10;
		//$i = $i<=0 ? 0 : $i;
		if($i < 0) {
		
		} elseif($i > 0) {
			$link = str_replace("{symbol}", $symbol, $sendVar);
			$link = str_replace("{page}", $i, $link);
			$page= "<b><a href='".$link."' >{$code[2]}</a></b>&nbsp;&nbsp;".$page;
		
		} elseif($i ==  0) {
			$link = str_replace("{symbol}", '', $sendVar);
			$link = str_replace("{page}", '', $link);
			$page= "<b><a href='".$link."' >{$code[2]}</a></b>&nbsp;&nbsp;".$page;
		
		}

	
	}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
		$i =  $start - 10;
		if($i == 0){
			$link = str_replace("{symbol}", '', $sendVar);
			$link = str_replace("{page}", '', $link);
		
		}else {
			$link = str_replace("{symbol}", $symbol, $sendVar);
			$link = str_replace("{page}", $i, $link);
		
		}
		$i =  $start + 10;
		$link1 = str_replace("{symbol}", $symbol, $sendVar);
		$link1 = str_replace("{page}", $i, $link1);
		
		
		$page= "<b><a href='".$link."' >{$code[2]}</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >{$code[3]}</a></b>";
	
	
	}
return $page;

}



function pagelist($pagenum,$currentpage,$sendVar) 
{
	$pagenum = intval($pagenum);
	$currentpage = intval($currentpage);
	if($pagenum <= 0)
		return false;

	$header = floor($currentpage/10);
	$start = $header*10;
	if($start==0) {
		$start =1;
	}

	

	for($i= $start;$i<=$start + 9;$i++){

		$link = $sendVar."&Page=".$i;

		if($currentpage==$i){
			$page.= "<font color=\"#FF0000\">[".$i."]</font>&nbsp;&nbsp;";
		}else{

			$page.= "<a href='".$link."'>[".$i."]</a>&nbsp;&nbsp;";
		}
		if($i==$pagenum) break;

	}

	if ($currentpage < $pagenum) {
		$link1= $sendVar."&Page=".($currentpage+1);
		$page= $page."&nbsp;&nbsp;<b><a href='".$link1."' >下一页</a></b>";
	}

	if($currentpage > 1) {
		if(($currentpage-1) <= 0)
			$link1 = $sendVar;
		else
			$link1= $sendVar."&Page=".($currentpage-1);
		$page= "<b><a href='".$link1."' >上一页</a></b>&nbsp;&nbsp;".$page;
	}

	if((($currentpage+9)) <= $pagenum && (($currentpage-9) <= 0)) {
		$i =  $start + 9;
		$link = $sendVar."&Page=".$i;
		$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >下10页</a></b>";
	}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
		$i =  $start - 9;
		if($i <= 0)
			$i='';
		$link =  $sendVar."&Page=".$i;
		$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page;

	}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
		$i =  $start - 9;
		if($i <= 0)
			$i='';

		$link = $sendVar."&Page=".$i;
		$i =  $start + 10;
		$link1 = $sendVar."&Page=".$i;


		$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >下10页</a></b>";

	}

	if($currentpage>1) {
		$page = "<a href='".$sendVar."'>[首页]</a>&nbsp;".$page;
	} else {
		$page = "[首页]&nbsp;".$page;
	
	}

	if($currentpage!=$pagenum) {
		$page .= "&nbsp;<a href='".$sendVar."&Page=".$pagenum."'>[尾页]</a>";
	} else {
		$page .= "&nbsp;[尾页]";
	
	}

return $page;

}


//--------------------------------------------
//以下为系统默认函数,一般情况不需要改动

/**
 *@ignore
 */




//系统默认动态发布调用类(如需要修改动态发布的分页的样式请修改否则不要动)
class DynamicPublish {
	function Page($pagenum,$currentpage,$sendVar)
	{
		$currentpage--;
		if($pagenum == '')
			return false;
		$header = floor($currentpage/10);
		
		$start = $header*10;
		
		for($i= $start;$i<=$start + 9;$i++){
			
			if($i == 0) {
				$link = str_replace("{Page}", 0,$sendVar);
				
			} else 
				$link = str_replace("{Page}", $i,$sendVar);
			
			$j = $i+1;
			if($currentpage==$i){
				$page.= "<a href='".$link."'><b>".$j."</b></a>&nbsp;";
			}else{
				
				$page.= "<a href='".$link."'>".$j."</a>&nbsp;";
			}
			if($i==$pagenum) break;
		
		}
		if ($currentpage < $pagenum) {
			$link1= str_replace("{Page}", $currentpage+1 ,$sendVar);
			$page= $page."&nbsp;<b><a href='".$link1."' >下一页</a></b>";
		}
		
		if($currentpage > 0) {
			if(($currentpage-1) == 0)
				$link = str_replace("{Page}", 0,$sendVar);
			else
				$link1= str_replace("{Page}" , $currentpage-1 ,$sendVar);
			$page= "<b><a href='".$link1."' >上一页</a></b>&nbsp;&nbsp;".$page;
		}

		
			
		if((($currentpage+9)) <= $pagenum && (($currentpage-9) <= 0)) {
			$i =  $start + 10;
			$link = str_replace("{Page}", $i,$sendVar);
			$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >下10页</a></b>";
		}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
			$i =  $start - 9;
			if($i == 0)
				$i='';
			else
				$i="_$i";
			$link = str_replace("{Page}", $i,$sendVar);
			$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page;
		
		}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
			$i =  $start - 10;
			if($i == 0)
				$i='';
			else
				$i="_$i";
			$link = str_replace("{Page}", $i ,$sendVar);
			$i =  $start + 10;
			$link1 = str_replace("{Page}", $i ,$sendVar);
			
			
			$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >下10页</a></b>";
		
		
		}
	return $page;
	
	}




	function IndexPage()
	{
		global $PageInfo,$params,$IN;
		$pagenum = $PageInfo['TotalPage'];
		$currentpage = $PageInfo['CurrentPage'];
		$sendVar = $PageInfo['URL'];
		if($params['nodeid'] == 'self') {
			$NodeID = $GLOBALS['IN']['NodeID'];
		} else {
			$NodeID = $params['nodeid'];
		
		}
		$currentpage--;
		if($pagenum == '')
			return false;
		$header = floor($currentpage/10);
		
		$start = $header*10;
		$sendVar = str_replace("{NodeID}", $NodeID,$sendVar);
		for($i= $start;$i<=$start + 9;$i++){
			
			if($i == 0) {
				$link = str_replace("{Page}", 0,$sendVar);
				
			} else 
				$link = str_replace("{Page}", $i,$sendVar);
			
			$j = $i+1;
			if($currentpage==$i){
				$page.= "<a href='".$link."'><b>".$j."</b></a>&nbsp;";
			}else{
				
				$page.= "<a href='".$link."'>".$j."</a>&nbsp;";
			}
			if($i==$pagenum) break;
		
		}
		if ($currentpage < $pagenum) {
			$link1= str_replace("{Page}", $currentpage+1 ,$sendVar);
			$page= $page."&nbsp;<b><a href='".$link1."' >下一页</a></b>";
		}
		
		if($currentpage > 0) {
			if(($currentpage-1) == 0)
				$link = str_replace("{Page}", 0,$sendVar);
			else
				$link1= str_replace("{Page}" , $currentpage-1 ,$sendVar);
			$page= "<b><a href='".$link1."' >上一页</a></b>&nbsp;&nbsp;".$page;
		}

		
			
		if((($currentpage+9)) <= $pagenum && (($currentpage-9) <= 0)) {
			$i =  $start + 10;
			$link = str_replace("{Page}", $i,$sendVar);
			$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >下10页</a></b>";
		}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
			$i =  $start - 9;
			if($i == 0)
				$i='';
			else
				$i="_$i";
			$link = str_replace("{Page}", $i,$sendVar);
			$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page;
		
		}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
			$i =  $start - 10;
			if($i == 0)
				$i='';
			else
				$i="_$i";
			$link = str_replace("{Page}", $i ,$sendVar);
			$i =  $start + 10;
			$link1 = str_replace("{Page}", $i ,$sendVar);
			
			
			$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >下10页</a></b>";
		
		
		}
	return $page;
	
	}

}


	function IndexPage($pagenum,$currentpage,$sendVar)
	{
		global $PageInfo,$params,$IN;
		$pagenum --;
		//$pagenum = $PageInfo['TotalPage']-1;
		//$currentpage = $PageInfo['CurrentPage'];
		//$sendVar = $PageInfo['URL'];
		if($params['nodeid'] == 'self' || $params['nodeid'] == '') {
			$NodeID = $GLOBALS['IN']['NodeID'];
		} else {
			$NodeID = $params['nodeid'];
		}
		$currentpage--;
		if($pagenum == '')
			return false;
		$header = floor($currentpage/10);
		
		$start = $header*10;
		$sendVar = str_replace("{NodeID}", $NodeID,$sendVar);
		$sendVar = str_replace("{fid}", $IN['fid'],$sendVar);  //modify by easyt,2005.10.24,增加fid和tid的处理
		$sendVar = str_replace("{tid}", $IN['tid'],$sendVar);
		$sendVar = str_replace("{Custom1}", $IN['Custom1'],$sendVar);  //modify by easyt,2005.10.24,增加自定义变量处理
		$sendVar = str_replace("{Custom2}", $IN['Custom2'],$sendVar);
		$sendVar = str_replace("{Custom3}", $IN['Custom3'],$sendVar);
		$sendVar = str_replace("{Custom4}", $IN['Custom4'],$sendVar);
		$sendVar = str_replace("{Custom5}", $IN['Custom5'],$sendVar);
		for($i= $start;$i<=$start + 9;$i++){
			
			if($i == 0) {
				$link = str_replace("{Page}", 0,$sendVar);
				
			} else 
				$link = str_replace("{Page}", $i,$sendVar);
			
			$j = $i+1;
			if($currentpage==$i){
				$page.= "<FONT  COLOR='#FF0000'>[$j]</FONT>&nbsp;";
			}else{
				
				$page.= "<a href='".$link."'>".$j."</a>&nbsp;";
			}
			if($i==$pagenum) break;
		
		}
		if ($currentpage < $pagenum) {
			$link1= str_replace("{Page}", $currentpage+1 ,$sendVar);
			$page= $page."&nbsp;<b><a href='".$link1."' >下一页</a></b>";
		}
		
		if($currentpage > 0) {
			if(($currentpage-1) == 0)
				$link1 = str_replace("{Page}", 0,$sendVar);
			else
				$link1= str_replace("{Page}" , $currentpage-1 ,$sendVar);
			$page= "<b><a href='".$link1."' >上一页</a></b>&nbsp;&nbsp;".$page;
		}

		
			
		if((($currentpage+9)) <= $pagenum && (($currentpage-9) <= 0)) {
			$i =  $start + 10;
			$link = str_replace("{Page}", $i,$sendVar);
			$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >下10页</a></b>";
		}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
			$i =  $start - 9;
			if($i == 0)
				$i='';
			else
				$i="_$i";
			$link = str_replace("{Page}", $i,$sendVar);
			$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page;
		
		}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
			$i =  $start - 10;
			if($i == 0)
				$i='';
			else
				$i="_$i";
			$link = str_replace("{Page}", $i ,$sendVar);
			$i =  $start + 10;
			$link1 = str_replace("{Page}", $i ,$sendVar);
			
			
			$page= "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >下10页</a></b>";
		
		
		}
	return $page;
	
	}

//如果有wap功能调用则装载
if( file_exists(SETTING_DIR."wap.func.php") ) include_once SETTING_DIR."wap.func.php";
	


//官方额外扩展调用
//如果当前目录下存在系统调用标签扩展函数文件cms.func.xinga.php,则装入(不能修改)
if( file_exists(SETTING_DIR."cms.func.xinga.php") ) include_once SETTING_DIR."cms.func.xinga.php";
	

if( file_exists(INCLUDE_PATH."/lib/utf8.func.php") ) include_once INCLUDE_PATH."/lib/utf8.func.php";
	

?>