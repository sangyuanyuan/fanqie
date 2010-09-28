<?php
/*****************必须正确配置以下2个参数*****************/

$PUBLISH_CONFIG['ROOT_PATH'] = "../"; //定义cmsware系统根目录,也就是publish目录相对{cmsware}目录的路径
$PUBLISH_CONFIG['OAS_PATH'] = "../../oas/";	//定义OAS目录的位置，请勿忘记最后的斜杠


/*******************以下内容请不要随意修改****************/$PUBLISH_CONFIG['BBS_INTERFACE'] = false; //是否挂接会员系统
$PUBLISH_CONFIG['BBS_NAME'] = "ipb2";
$PUBLISH_CONFIG['comment_validcode'] = true; //评论启用验证码

$PUBLISH_DEBUG = false; //是否开启调试模式

//如果需要挂接会员系统，请设置。会员接口挂接论坛名，论坛名为{cmsware}plugins/bbsInterface/bbs下的目录名

/*********************************************************/







/*******************以下内容请不要随意修改****************/
define('ROOT_PATH', $PUBLISH_CONFIG['ROOT_PATH']); 
define('_BBS_INTERFACE', $PUBLISH_CONFIG['BBS_INTERFACE']); 
define('PLUGIN', 'bbsInterface'); //会员接口插件目录名
define('BBS_NAME', $PUBLISH_CONFIG['BBS_NAME']); 


$INDEX_SETTING = array(
	'cache_time'=> 3600*24, //节点首页缓存刷新时间(秒)
);

$CONTENT_SETTING = array(
	'cache_time'=> 3600*24, //内容页缓存刷新时间(秒)
);


function comment_display_page($pagenum,$currentpage,$sendVar) {

	if($pagenum == '')
		return false;
	$header = floor($currentpage/10);
	
	$start = $header*10;
	if($start == 0)
		$start = 1;
	for($i= $start;$i<=$start + 9;$i++){
		if($currentpage==$i){
			$page.= "<a href='".$sendVar."&amp;Page=".$i."'><font color=#ffffff><b>".$i."</b></font></a>&nbsp;";
		}else{
			
			$page.= "<a href='".$sendVar."&amp;Page=".$i."'><font color=#ffffff>".$i."</font></a>&nbsp;";
		}
		if($i==$pagenum) break;
	
	}
	if($start == 1 && ($start+9) < $pagenum)
		$page= $page."&nbsp;&nbsp;<b><a href='".$sendVar."&amp;Page=".($start + 10)."' ><font color=#ffffff>&#x4E0B;10&#x9875;</font></a></b>";
	elseif ($start == 1 && ($start+9) > $pagenum)
		$page = $page;
	elseif(($start+10) > $pagenum)
		$page= "<b><a href='".$sendVar."&amp;Page=".($start - 10)."' ><font color=#ffffff>&#x524D;10&#x9875;</font></a></b>&nbsp;&nbsp;".$page;
	else
		$page= "<b><a href='".$sendVar."&amp;Page=".($start - 10)."' ><font color=#ffffff>&#x524D;10&#x9875;</font></a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$sendVar."&amp;Page=".($start + 10)."' ><font color=#ffffff>&#x4E0B;10&#x9875;</font></a></b>";
	
	return $page;

}


function search_page($pagenum,$currentpage,$sendVar) 
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

		$link = $sendVar."&amp;Page=".$i;

		if($currentpage==$i){
			$page.= "<font color=\"#FF0000\">[".$i."]</font>&nbsp;&nbsp;";
		}else{

			$page.= "<a href='".$link."'>[".$i."]</a>&nbsp;&nbsp;";
		}
		if($i==$pagenum) break;

	}

	if ($currentpage < $pagenum) {
		$link1= $sendVar."&amp;Page=".($currentpage+1);
		$page= $page."&nbsp;&nbsp;<b><a href='".$link1."' >&#x4E0B;&#x4E00;&#x9875;</a></b>";
	}

	if($currentpage > 1) {
		if(($currentpage-1) <= 0)
			$link1 = $sendVar;
		else
			$link1= $sendVar."&amp;Page=".($currentpage-1);
		$page= "<b><a href='".$link1."' >&#x4E0A;&#x4E00;&#x9875;</a></b>&nbsp;&nbsp;".$page;
	}

	if((($currentpage+9)) <= $pagenum && (($currentpage-9) <= 0)) {
		$i =  $start + 9;
		$link = $sendVar."&amp;Page=".$i;
		$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >&#x4E0B;10&#x9875;</a></b>";
	}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
		$i =  $start - 9;
		if($i <= 0)
			$i='';
		$link =  $sendVar."&amp;Page=".$i;
		$page= "<b><a href='".$link."' >&#x524D;10&#x9875;</a></b>&nbsp;&nbsp;".$page;

	}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
		$i =  $start - 9;
		if($i <= 0)
			$i='';

		$link = $sendVar."&amp;Page=".$i;
		$i =  $start + 10;
		$link1 = $sendVar."&amp;Page=".$i;


		$page= "<b><a href='".$link."' >&#x524D;10&#x9875;</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >&#x4E0B;10&#x9875;</a></b>";

	}
return $page;

}

?>