<?php
require_once 'common.php';
require_once INCLUDE_PATH.'admin/TplVarsAdmin.class.php';
 
$TPL->enableMark = false;
switch($IN['o']) {
	case 'functions.js':
 		$TPL->display("../common/functions.js");
		break;
	case 'style.css':
 		$TPL->display("../common/style.css");
		break;
	case 'editor__edit_source.js':
  		$TPL->assign("PUBLISH_URL", TplVarsAdmin::getValue('PUBLISH_URL'));
 		$TPL->display("../common/editor/edit_source.js");
		break;
	case 'editor__html.js':
  		$TPL->assign("PUBLISH_URL", TplVarsAdmin::getValue('PUBLISH_URL'));
 		$TPL->display("../common/editor/html.js");
		break;

	case 'picker_url_content':
   		$TPL->assign_by_ref("IN", $IN);
		$TPL->display("../common/url_content.html");

 		break;
	case 'editor__page.html':
  		$TPL->assign("PUBLISH_URL", TplVarsAdmin::getValue('PUBLISH_URL'));
 		$TPL->display("../common/editor/page.html");
 		break;

	case 'editor__color.htm':
  		$TPL->assign("PUBLISH_URL", TplVarsAdmin::getValue('PUBLISH_URL'));
 		$TPL->display("../common/editor/color.htm");
 		break;
	case 'editor__table.html':
  		$TPL->assign("PUBLISH_URL", TplVarsAdmin::getValue('PUBLISH_URL'));
 		$TPL->display("../common/editor/table.html");
 		break;


 

}
 
?>
