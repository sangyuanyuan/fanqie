<?php
//$mainContentLabel = 'Content';	

$mainContentLabel = $GLOBALS['CONTENT_MODEL_INFO'][$NodeInfo['TableID']]['MainField'];	

$patt = "/<h3[^>]*><font[^>]*>\[Page:(.*)]<\/font><\/h3>/siU";
$patt1 = "/<h3[^>]*><font[^>]*>\[Page:(.*)]<\/font><\/h3>/siU";
$filenameFormatMap = array(
	'{IndexID}'=>'{$IndexID}',
	'{ContentID}'=>'{$IndexID}',
	'{NodeID}'=>'{$publishInfo[NodeID]}',
	'{TimeStamp}'=>'{$publishInfo[CreationDate]}',
	//'{Page}'=> '{$Page}',
);
$IndexPageTitle = "前言";
$_pageList = "PageList";
$_pageTitle = "PageTitle";
$_pageLink = "PageLink";
$_pageNav = "PageNav";

$RelateDocArray = $publish->getRelateDoc($IndexID,0,15);
//debug($RelateDocArray);
$RelateDoc = "<TABLE cellSpacing=3 cellPadding=0  border=0><TBODY>";
if(is_array($RelateDocArray)) {
	foreach($RelateDocArray as $key=>$var) {
		$RelateDoc.= "<TR><TD >· </TD><TD ><A href='{$var[URL]}' target=_blank>{$var[Title]}</A></TD></TR>";
	}

} else {
	$RelateDoc.= "<TR> <TD >没有相关文章</TD></TR>";
}

$RelateDoc .= "</TBODY></TABLE>";

$NodeArray = unserialize($NodeInfo[Nav]);
$tmpNodeInfo = $publish->NodeInfo;

foreach($NodeArray as $key=>$var) {
	$publish->NodeInfo = $iWPC->loadNodeInfo($var[NodeID]);
	$URL = $publish->getHtmlURL($publish->NodeInfo[IndexName]);

	if($key == 0) {

		$Navigation = "<a href='{$URL}' >{$var[Name]}</a>";
	
	} else {
		$Navigation .= "&nbsp;&gt;&nbsp;<a href='{$URL}' >{$var[Name]}</a>";
	
	}


}

$publish->NodeInfo = $tmpNodeInfo;
/*
***使用说明***

分页子标题数组：$pageNav
$pageNav = array(
	Title => 分页子标题,
	Link => 分页链接,
)
内容数组：$Publish
分页第一页默认子标题：$IndexPageTitle
*/
?>