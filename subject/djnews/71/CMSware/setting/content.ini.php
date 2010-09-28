<?php
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
$IndexPageTitle = "CONTENT_HEADER";
$_pageList = "PageList";
$_pageTitle = "PageTitle";
$_pageLink = "PageLink";
$_pageNav = "PageNav";

//$RelateDocArray = $this->getRelateDoc($IndexID,0,15);
//debug($RelateDocArray);
$NodeArray = unserialize($NodeInfo[Nav]);
$tmpNodeInfo = $this->NodeInfo;

foreach($NodeArray as $key=>$var) {
	$this->NodeInfo = $iWPC->loadNodeInfo($var[NodeID]);
	$URL = $this->getHtmlURL($this->NodeInfo[IndexName]);
	$URL = str_replace('{NodeID}', $this->NodeInfo['NodeID'], $URL);
	if(preg_match("/\{(.*)\}/isU", $URL , $match)) {
		eval("\$fun_string = $match[1];");
		$URL  = str_replace($match[0], $fun_string, $URL );

	}


	if($key == 0) {

		$Navigation = "<a href='{$URL}' >{$var[Name]}</a>";
	
	} else {
		$Navigation .= "&nbsp;&gt;&nbsp;<a href='{$URL}' >{$var[Name]}</a>";
	
	}


}

$this->NodeInfo = $tmpNodeInfo;


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