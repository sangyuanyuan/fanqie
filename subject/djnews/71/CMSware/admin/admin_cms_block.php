<?php
require_once 'common.php';
require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."admin/tplAdmin.class.php";
require_once INCLUDE_PATH."admin/site_admin.class.php";
require_once INCLUDE_PATH."cms.class.php";
require_once INCLUDE_PATH."cms.func.php";
require_once SETTING_DIR."cms.ini.php";
require_once INCLUDE_PATH.'encoding/encoding.inc.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."admin/task.class.php";
require_once INCLUDE_PATH.'image.class.php';
$Plugin = new Plugin();

$publish = new publishAdmin();
$psn = new psn_admin();
$psnInfo[PSN] = 'file::'.CACHE_DIR."tmp";
$psn->connect($psnInfo[PSN]);

if(empty($IN[NodeID]) && empty($IN[TCID])) {
	$IN[NodeID] = empty($IN[NodeID]) ? $_SESSION['targetNodeID'] : $IN[NodeID];
	$IN[IndexID] = empty($IN[IndexID]) ? $_SESSION['IndexID'] : $IN[IndexID];
	if(!empty($IN['targetFile'])) { 
		$tempFileName = substr($IN['sId'], 15) .substr(md5($IN['targetFile']), 15).".tmp";
		if($psn->fileExists($tempFileName)) {
			
			//Get the editing temporary template file	 
			$content_src = $psn->read('', $tempFileName);
			$psn->close();
			$content = $publish->fetchIndex($IN[NodeID], CACHE_DIR."tmp/", $tempFileName);

		} else {
			 
			//Get the original template file
			$psn->connect('file::'.$SYS_ENV['templatePath']);
			$content_src = $psn->read($IN['PATH'],$IN['targetFile']);
			$psn->close();


			$psn->connect($psnInfo[PSN]);
			$psn->isLog = false;
			$psn->put('/'.$tempFileName, $content_src);
			$psn->close();

			$content = $publish->fetchIndex($IN[NodeID], CACHE_DIR."tmp/", $tempFileName);

		}
	} else {
		$tempFileName = $IN['sId'].".tmp";
		if($psn->fileExists($tempFileName)) {
			
			//Get the editing temporary template file	 
			$content_src = $psn->read('', $tempFileName);
			$psn->close();
			$content = $publish->fetchIndex($IN[NodeID], CACHE_DIR."tmp/", $tempFileName);

		} else {
			 
			//Get the original template file
			 
			$content_src = "";
			 


			$psn->connect($psnInfo[PSN]);
			$psn->isLog = false;
			$psn->put('/'.$tempFileName, $content_src);
			$psn->close();

			$content = "";

		}
	
	}




} elseif(!empty($IN[TCID])) {
	$IN[NodeID] = empty($IN[NodeID]) ? $_SESSION['targetNodeID'] : $IN[NodeID];
	$IN[IndexID] = empty($IN[IndexID]) ? $_SESSION['IndexID'] : $IN[IndexID];
	$tempFileName = $IN['sId'].$IN[TCID]."o".$IN[TID].".tmp";
	if($psn->fileExists($tempFileName)) {
			
			//Get the editing temporary template file	 
			$content_src = $psn->read('', $tempFileName);
			$psn->close();
			$content = $publish->fetchIndex($IN[NodeID], CACHE_DIR."tmp/", $tempFileName);

	} else {
			 
			//Get the original template file
			 
			$content_src = "";
			 


			$psn->connect($psnInfo[PSN]);
			$psn->isLog = false;
			$psn->put('/'.$tempFileName, $content_src);
			$psn->close();

			$content = "";

	}


} else {
	$publish->NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
	$tempFileName = substr($IN['sId'], 15) .substr(md5($publish->NodeInfo[IndexTpl]), 15).".tmp";
	if($psn->fileExists($tempFileName)) {
		
		//Get the editing temporary template file	 
		$content_src = $psn->read('', $tempFileName);
		$psn->close();
		$content = $publish->fetchIndex($IN[NodeID], CACHE_DIR."tmp/", $tempFileName);

	} else {
		 
		//Get the original template file
		$psn->connect('file::'.$SYS_ENV['templatePath']);
		$content_src = $psn->read($IN[PATH],$publish->NodeInfo[IndexTpl]);
		$psn->close();


		$psn->connect($psnInfo[PSN]);
		$psn->isLog = false;
		$psn->put('/'.$tempFileName, $content_src);
		$psn->close();

		$content = $publish->fetchIndex($IN[NodeID], CACHE_DIR."tmp/", $tempFileName);

	}

}







function cms_block_parse(&$content, $output) {
	$pattern = "/".preg_quote("<!---{CMS-BLOCK}--->","/")."(.*)".preg_quote("<!---{/CMS-BLOCK}--->","/")."/isU";
	//echo $pattern;
	if(preg_match_all($pattern,$content,$matches)) {
		foreach($matches[0] as $key=>$var)  {
			//$id = md5($matches[1][$key]).$key;

			$replace = "<div oncontextmenu=\"showContextMenu('{$output[$key]['id']}');\" style=\"cursor: hand;\"   onmouseout=\"mouseout(this);\" onmouseover=\"mouseover(this);\" title='点击操作此区块' onclick=\"javascript:showContextMenu('{$output[$key]['id']}');\">".$matches[1][$key]."</div>";//showPopupText('d".$id."');
			$content = str_replace($matches[0][$key], $replace, $content);
			//$output[$key] = array('id'=>$id, 'data'=>'');
		}
	}
	//return $output;
}

function cms_block_parse_src(&$content) {
	$pattern = "/".preg_quote("<!---{CMS-BLOCK}--->","/")."(.*)".preg_quote("<!---{/CMS-BLOCK}--->","/")."/isU";
 	if(preg_match_all($pattern,$content,$matches)) {
		foreach($matches[0] as $key=>$var)  {
			$id = md5($matches[1][$key]).$key;

			$output[$key]['id'] = $id ;
			$output[$key]['data'] = cms_block_highlight($matches[1][$key]);
		}
	}
	return $output;
}


function cms_block_get_by_id(&$content, $id) {
	$pattern = "/".preg_quote("<!---{CMS-BLOCK}--->","/")."(.*)".preg_quote("<!---{/CMS-BLOCK}--->","/")."/isU";
	//echo $pattern;
	if(preg_match_all($pattern,$content,$matches)) {
		foreach($matches[0] as $key=>$var)  {
 			if($id == md5($matches[1][$key]).$key) return $matches[1][$key];
 			
		}
	}
	return false;
}

function cms_block_update_by_id(&$content, $id, $updatedata) {
	$pattern = "/".preg_quote("<!---{CMS-BLOCK}--->","/")."(.*)".preg_quote("<!---{/CMS-BLOCK}--->","/")."/isU";
	if(preg_match_all($pattern,$content,$matches, PREG_OFFSET_CAPTURE)) {
		foreach($matches[0] as $key=>$var)  {
 			if($id == md5($matches[1][$key][0]).$key) {				
				$start = substr($content, 0, $matches[1][$key][1]);
				$middle = $updatedata;
				$end = substr($content, $matches[1][$key][1] + strlen($matches[1][$key][0]));
				$content = $start . $middle . $end;
				return $content;
			}
			 
 			
		}
	}
	return $content;
}
function format_cms_tag($string) {//&quot;LIST&quot;
   $string = preg_replace( "/([a-zA-Z0-9]*)(=&quot;.*&quot;)/isU" , "<B>\\1</B>\\2", $string );                  //</CMS> tags
	  
	return $string;
}

function font_format_start($color) {
	return "<FONT color=$color>";
}
function font_format_end() {
	return "</FONT>";
}

function cms_block_highlight( $txt) {
	 $txt = nl2br( str_replace(array(' ','	'), array('&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;'), htmlspecialchars($txt)) );

    $txt = preg_replace( "/(&lt;cms)(.+?)(\/&gt;)/ie" , "font_format_start('#FF3333').'\\1'.format_cms_tag('\\2').'\\3'.font_format_end()", $txt );             //<CMS action="NODELIST" return="List">  tags
    $txt = preg_replace( "#&lt;/CMS&gt;#Us" , "<FONT color=#ff0000>\\0</FONT>", $txt );                  //</CMS> tags
    $txt = preg_replace( "#(&lt;loop)(.+?)(&gt;)#ie" , "font_format_start('#FF3333').'\\1'.format_cms_tag('\\2').'\\3'.font_format_end()", $txt );              //<loop $List name="List" var="var" key="key" >  tags
    $txt = preg_replace( "#&lt;/Loop&gt;#i" , "<FONT color=#FF3333>&lt;/loop&gt;</FONT>", $txt );        //</loop> tags
    $txt = preg_replace( "#\[\\$(.+?)\]#i" , "<FONT color=#000000><B>\\0</B></FONT>", $txt );                   //[$var.URL] tags
    $txt = preg_replace( "#\[@(.+?)\]#i" , "<FONT color=#000000><B>\\0</B></FONT>", $txt );                     //[@date('Y-m-d H:i:s', $var.PublishDate)] tags
    $txt = preg_replace( "/(&lt;if)(.+?)(&gt;)/iUe" , "font_format_start('#FF3333').'\\1'.format_cms_tag('\\2').'\\3'.font_format_end()", $txt );             // <if>
    $txt = preg_replace( "#&lt;\/if&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );                // </if>
     $txt = preg_replace( "/(&lt;elseif)(.+?)(&gt;)/iUe" , "font_format_start('#FF3333').'\\1'.format_cms_tag('\\2').'\\3'.font_format_end()", $txt );             // <if>
   $txt = preg_replace( "#&lt;else(.*?)&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );           // <else>
    $txt = preg_replace( "#&lt;include:(.+?)&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );          //<include: file="/cmsware/header.html"> tags
    $txt = preg_replace( "#&lt;get:(.+?)&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );          //<get: file="header.html"> tags
    $txt = preg_replace( "#&lt;var(.+?)&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );          //<var name="hello" value="world" /> tags
    $txt = preg_replace( "/(&lt;op)(.+?)(\/&gt;)/ie" , "font_format_start('#FF3333').'\\1'.format_cms_tag('\\2').'\\3'.font_format_end()", $txt  );          //<op exp="$abc='3'" /> tags
    $txt = preg_replace( "#&lt;debug(.+?)&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );          //<debug name="List" /> tags
    $txt = preg_replace( "#&lt;:(.+?)&gt;#i" , "<FONT color=#FF3333>\\0</FONT>", $txt );            //<where: c.Photo!=''> tags
    $txt = preg_replace( "#&lt;!--(.+?)-&gt;#s" , "<FONT color=#339900>\\0</FONT>", $txt );              //<!--test-> tags
    $txt = preg_replace( "#\[\*(.+?)\]#" , "<FONT color=#6699CC>\\0</FONT>", $txt );                     //[*cmsware.page.PageList]  tags
    $txt = preg_replace( "#&lt;\?(.+?)\?&gt;#is" , "<FONT color=#FF9999>\\0</FONT>", $txt );             //php tags
    $txt = preg_replace( "#&lt;php&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );             //<php>
    $txt = preg_replace( "#&lt;\/php&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );             //</php>
	//以下这句必须在最后，因是标签中的标签套色
    $txt = preg_replace( "#{\\$(.+?)}#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );                     //{$NodeInfo.NodeID} tags
    $txt = preg_replace( "#&lt;header:(.+?)&gt;#is" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<debug 
    $txt = preg_replace( "/&lt;A(.*)&gt;/isU" , "<FONT color=#3300FF>\\0</FONT>", $txt );          //<debug 
    $txt = preg_replace( "#&lt;\/a&gt;#is" , "<FONT color=#3300FF>\\0</FONT>", $txt );          //<debug 
    $txt = preg_replace( "/&lt;img(.*)&gt;/isU" , "<FONT color=#8B158E>\\0</FONT>", $txt );          //<debug 
  //  $txt = preg_replace( "/&lt;font(.*)&gt;/isU" , "<FONT color=#336600>\\0</FONT>", $txt );          //<debug 
   //  $txt = preg_replace( "#&lt;\/font&gt;#is" , "<FONT color=#336600>\\0</FONT>", $txt );          //<debug 
   return $txt;

}

function cms_block_syntax_check(&$str)
{
	//<font style="BACKGROUND-COLOR: #ffff00">aaaa</font>
	global $include_loop_error,  $include_if_error;
 	
	preg_match_all("/&lt;loop&nbsp;(.*)&gt;/isU", $str, $matches);
	$loop_start_num = count($matches[0]);

	preg_match_all("#&lt;/Loop&gt;#isU", $str, $matches);
	$loop_end_num = count($matches[0]);

	
	if($loop_start_num !=$loop_end_num) {
		$include_loop_error = true;
		$str = preg_replace("/&lt;loop&nbsp;(.*)&gt;/isU" , "<div style=\"width:100%;BACKGROUND-COLOR:  #ffff00\">\\0</div>", $str );                  //</CMS> tags
		$str = preg_replace("#&lt;/Loop&gt;#isU" , "<div style=\"width:100%;BACKGROUND-COLOR:  #ffff00\">\\0</div>", $str );                  //</CMS> tags
	
	}


	preg_match_all("/&lt;if&nbsp;(.*)&gt;/isU", $str, $matches);
	$if_start_num = count($matches[0]);

	preg_match_all("#&lt;/if&gt;#isU", $str, $matches);
	$if_end_num = count($matches[0]);

	
	if($if_start_num !=$if_end_num) {
		$include_if_error = true;
		$str = preg_replace("/&lt;if&nbsp;(.*)&gt;/isU" , "<div style=\"width:100%;BACKGROUND-COLOR:  #ffff00\">\\0</div>", $str );                  //</CMS> tags
		$str = preg_replace("#&lt;/if&gt;#isU" , "<div style=\"width:100%;BACKGROUND-COLOR:  #ffff00\">\\0</div>", $str );                  //</CMS> tags
	
	}


	$old_syntax_search = array(
		"'&lt;/CMS&gt;'is",
		"'&lt;cms::(.*)&gt;'isU",
		 
	
	);

	$old_syntax_replace = array(
		"<div style=\"width:100%;BACKGROUND-COLOR:#FFFF99\">\\0</div>",
		"<div style=\"width:100%;BACKGROUND-COLOR: #FFFF99\">\\0</div>",
		
	
	);

	$str = preg_replace($old_syntax_search , $old_syntax_replace, $str );                  //</CMS> tags
	return $str;
}


if($IN['o'] == 'edit') {
	$include_cms_tag = false;
	$patternArray = array(
		"/&lt;cms(.+?)\/&gt;/i",
		"/(&lt;loop)(.+?)(&gt;)/i", 
		"#\[\\$(.+?)\]#i",
		"#\[@(.+?)\]#i" ,
		"#&lt;if(.+?)&gt;#i" ,
		"#&lt;include:(.+?)&gt;#i" ,
		"#&lt;get:(.+?)&gt;#i" ,
		"#&lt;var(.+?)&gt;#i" ,
		"#&lt;op(.+?)&gt;#i" , 
		"#&lt;debug(.+?)&gt;#i" ,
		"#&lt;:(.+?)&gt;#i" ,
		"#&lt;php&gt;#i" ,
		"#{\\$(.+?)}#i",
		"#&lt;header:(.+?)&gt;#is",
		 
	);

	
	$block_data = cms_block_get_by_id($content_src, $IN['id']);
	$block_data = htmlspecialchars($block_data);
	
	foreach($patternArray as $var) {
		if(preg_match($var, $block_data))  {
			$include_cms_tag = true;
			break;
		}
	}
 
	$TPL->assign_by_ref('include_cms_tag', $include_cms_tag);
	$TPL->assign_by_ref('NodeID', $IN['NodeID']);
	$TPL->assign_by_ref('id', $IN['id']);
	$TPL->assign_by_ref('block_data', $block_data);
	$TPL->display("admin_cms_block_data.html");
	
} elseif($IN['o'] == 'edit_submit') {
	 

	$update_content = cms_block_update_by_id($content_src, $IN['id'], $IN['SaveContent']);
	//echo $update_content;exit;
	$psn->connect($psnInfo[PSN]);
	$psn->isLog = false;
	$psn->put('/'.$tempFileName, $update_content);
	$psn->close();

    print "成功地update";
echo "<script>\n
						parent.window.opener.refreshWorkArea();	
						window.close();
						</script>\n";	

} elseif($IN['o'] == 'previewSrc') {
	$include_if_error = false;
	$include_loop_error = false;
	if(empty($IN['previewContent'])) {
		$previewContent = $content_src;
	} else {
		$previewContent = $IN['previewContent'];
	
	}

	$previewContent = cms_block_highlight($previewContent);
	$previewContent = cms_block_syntax_check($previewContent);
	$TPL->assign('include_if_error', $include_if_error);
	$TPL->assign('include_loop_error', $include_loop_error);
	$TPL->assign('NodeID', $IN['NodeID']);
	$TPL->assign_by_ref('content', $previewContent);
	$TPL->display("admin_cms_block_preview_src.html");

} else {


	$highlight = cms_block_parse_src($content_src ); 
	cms_block_parse($content,$highlight); 
	 
	$TPL->assign('NodeID', $IN['NodeID']);
	$TPL->assign_by_ref('blockSrc', $highlight);
	$TPL->assign_by_ref('content', $content);
	$TPL->display("admin_cms_block.html");
}
?> 
