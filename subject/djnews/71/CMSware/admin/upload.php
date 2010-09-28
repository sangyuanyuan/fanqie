<?php 
//
// +----------------------------------------------------------------------
// | iZz Project Name:		DMsys 2.0
// +----------------------------------------------------------------------
// | Copyright (c) 2000-2003 iZz Studio
// +----------------------------------------------------------------------
// | Note:
// | 
// | 
// | 
// +----------------------------------------------------------------------
// | Authors: iZz Studio (xshArp,Binzy,iCer,jFox,Ali,Hawking)
// +----------------------------------------------------------------------
// | Site: http://www.justdn.org
// | Bulletin Borad: http://bbs.justdn.org
// | email: webmaster@justdn.com
// +----------------------------------------------------------------------
//
// $Id: filename.php,v 1.00 2003/03/16  12:27  Beijing Time Zone 
//

/**
*
*/
require_once 'common.php';
include_once SETTING_DIR ."cms.ini.php";
require_once INCLUDE_PATH.'encoding/encoding.inc.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."admin/task.class.php";
require_once INCLUDE_PATH.'image.class.php';
require_once INCLUDE_PATH.'admin/upload.class.php';
require_once INCLUDE_PATH.'admin/TplVarsAdmin.class.php';

//$db->setDebug(1);


//debug($IN);
if ($IN[o] == 'select' && isset($IN[NodeID])) {
	
	$Limit = 24;
	
		
	if($IN[Page] == '' )
		$currentpage = 1;
	else
		$currentpage = intval($IN[Page]);

	$info = array(
		'NodeID' => $IN[NodeID],
		'relateDir' => '.',
		'mode' => $IN[mode],
		'mode_cate_type' => 'img',
		'file_view_ext' => $SYS_ENV[upImgType],
		'limit' => '0,10',
		'savePath' => $SYS_ENV[ResourcePath],
	);
	$view = new FTP($info);

	$num = $view->recordNum();

	$pagenum=ceil($num/$Limit);
	
	$start=($currentpage-1)*$Limit;

	$view->setLimit($start,$Limit);
	
	$imgData = $view->listFile();
	$pagelist = pagelist($pagenum,$currentpage,"upload.php?o=select&cId=$IN[NodeID]&mode={$IN[mode]}",'#000000') ;
	$TPL->assign('NodeID',$IN[NodeID]);
	$TPL->assign('pagelist',$pagelist);
	$TPL->assign('imgData',$imgData);
	$TPL->display('select_img.html');
} elseif ($IN[o] == 'display' && isset($IN[NodeID])) {
	$TPL->assign('NodeID',$IN[NodeID]);
	
	switch($IN[type]) {

	case 'img':
		if ($IN[mode] == 'single') $TPL->display('upload_img_single.html');
		elseif ($IN[mode] == 'multi') $TPL->display('upload_img_multi.html');
		elseif ($IN[mode] == 'one') $TPL->display('upload_img_one.html');
		else $TPL->display('upload_img_single.html');
		
		break;
	case 'attach':
		$TPL->display('upload_attach_picker.html');
		break;
	case 'flash':
		$TPL->display('upload_flash.html');
		break;
	case 'img_picker':
		$TPL->display('upload_img_picker.html');
		break;
	}

} elseif($IN[o] == 'upload' && isset($_FILES['uploadFile']) && isset($IN[NodeID])) {
	switch($IN[type]) {
		case 'img':
			if ($IN[mode] == 'single') {
			
				$params = array(
					'POST_File' =>$_FILES['uploadFile'],
					'uploadType' => 'img',
					'NodeID' => $IN[NodeID],
					'changeName' => $IN[changeName],
					'rootPath'=> $SYS_ENV[ResourcePath],

				);
				$upload = new Upload($params);
				$show_message=$_LANG_ADMIN[upload_topic]."\\n";
				foreach($upload->sysInfo as $var) {
					$show_message.='\n'.$var;
				}
				
				$errmsg.="<script>"
				."parent.add('".$upload->saveFile[0]."',parent.document.form.mdoc);"
				."alert('".$show_message."');"
				."parent.document.all.preview_img.src='".$upload->saveFile[0]."';"
				."parent.document.all.preview_img.style.display='';"
				."</script>";
				$TPL->assign("msg", $errmsg);
				$TPL->display("upload_complete.html");
				exit;
			} elseif ($IN[mode] == 'multi') {
				$params = array(
					'POST_File' =>$_FILES['uploadFile'],
					'uploadType' => 'img',
					'NodeID' => $IN[NodeID],
					'makeMini' => $IN[makeMini],
					'miniWidth' => $IN[width],
					'miniHeight' => $IN[height],
					'changeName' => $IN[changeName],
					'rootPath'=> $SYS_ENV[ResourcePath],
				);

				$upload = new Upload($params);
				$show_message=$_LANG_ADMIN[upload_topic]."\\n";
				foreach($upload->sysInfo as $var) {
					$show_message.='\n'.$var;
				}
				foreach($upload->saveFile as $key=>$var) {
					
					if($key == 0) {
						$img_url = $var;
					} else {
						$img_url .= '##'.$var;
					}
				}

				foreach($upload->saveMiniFile as $key=>$var) {
					
					if($key == 0) {
						$img_url_s = $var;
					} else {
						$img_url_s .= '##'.$var;
					}
				}

				$errmsg.="<script>parent.document.form.img_url.value='".$img_url."';"
				."parent.document.form.img_url_s.value='".$img_url_s."';"
				."parent.document.all.submit_change.innerHTML='<input type=button  name=yes value=\'".$_LANG_ADMIN['insert_img']."\' onclick=\"return insertImg();\"> ';"
				."alert('".$show_message."');"
				."</script>";
				
			

				$TPL->assign("msg", $errmsg);
				$TPL->display("upload_complete.html");
				exit;
			} elseif ($IN[mode] == 'one') {

				$params = array(
					'POST_File' =>$_FILES['uploadFile'],
					'uploadType' => 'img',
					'NodeID' => $IN[NodeID],
					'changeName' => $IN[changeName],
					'rootPath'=> $SYS_ENV[ResourcePath],
					'makeMini' => $IN[makeMini],
					'miniWidth' => $IN[width],
					'miniHeight' => $IN[height],

				);
				$upload = new Upload($params);
				$show_message="UPLOAD !\\n";
				foreach($upload->sysInfo as $var) {
					$show_message.='\n'.$var;
				}
				
				$errmsg.="<script>";

				//mkHTML
				//img_title
				//img_intro

				if($IN['mkHTML'] == '1' && $IN[makeMini] == '1') {
					require_once INCLUDE_PATH."admin/publishAdmin.class.php";
					require_once INCLUDE_PATH."admin/content_table_admin.class.php";
					require_once INCLUDE_PATH."admin/tplAdmin.class.php";
					require_once INCLUDE_PATH."admin/psn_admin.class.php";
					require_once INCLUDE_PATH."cms.class.php";
					require_once INCLUDE_PATH."cms.func.php";
					require_once SETTING_DIR."upload.ini.php";
					$publish = new publishAdmin();
					$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);

					$time = time();
					$publish->addData('CreationDate', $time);
					$publish->addData('ModifiedDate', $time);
					//$publish->addData('State', 1);
					$publish->addData('CreationUserID', $sys->session[sUId]);
					$publish->addData('LastModifiedUserID', $sys->session[sUId]);
					$publish->addData($ImageInfoFieldName['Title'], $IN['img_title']);
					$publish->addData($ImageInfoFieldName['Intro'], $IN['img_intro']);
					$publish->addData($ImageInfoFieldName['ImageHTML'], "<img src='{$upload->saveFile[0]}' border=0>");
					$publish->addData($ImageInfoFieldName['ImageURL'], $upload->saveFile[0]);

						//$publish->debugData();
					if($publish->imageContentAdd($NodeInfo[NodeID], $time)) {
						$returnIndexID = $publish->db_insert_id;
						$show_message.="Convert main image {$upload->saveFile[0]} into HTML successfully.";
						$errmsg.="parent.setSonIndexID('".$returnIndexID."');";
						
					}

				}

				if($IN[makeMini] == '1' && $IN['mkHTML'] != '1') {
					$errmsg.="parent.img_url.value='".$upload->saveMiniFile[0]."';";
					$errmsg.="parent.img_link.value='".$upload->saveFile[0]."';";
				} elseif($IN[makeMini] == '1' && $IN['mkHTML'] == '1') {
					$errmsg.="parent.img_url.value='".$upload->saveMiniFile[0]."';";

					//format : cmsware://publish.link.cw?IndexID=456&NodeID=3
					$errmsg.="parent.img_link.value='cmsware://publish/url.cw?IndexID=".$returnIndexID."';";
				
				} else {
					$errmsg.="parent.img_url.value='".$upload->saveFile[0]."';";
					$errmsg.="parent.img_link.value='".$upload->saveFile[0]."';";
				
				}
				$errmsg.="alert('".$show_message."');";
				
				$errmsg.="</script>";
				
				$TPL->assign("msg", $errmsg);
				$TPL->display("upload_complete.html");
				exit;
			} elseif($IN[mode] == 'picker') {
				 
				$params = array(
					'POST_File' =>$_FILES['uploadFile'],
					'uploadType' => 'img',
					'NodeID' => $IN['NodeID'],
					'changeName' => $IN[changeName],
					'rootPath'=> $SYS_ENV[ResourcePath],

				);
				$upload = new Upload($params);
				$show_message=$_LANG_ADMIN[upload_topic]."\\n";
				foreach($upload->sysInfo as $var) {
					$show_message.='\n'.$var;
				}
				
				$errmsg.="<script>"
				."alert('".$show_message."');"
				."parent.returnImg('".$upload->saveFile[0]."');"
				."</script>";
		
				$TPL->assign("msg", $errmsg);
				$TPL->display("upload_complete.html");
				exit;
			
			}

			//$upload->report();
			break;
		case 'attach':
			$params = array(
					'rootPath'=> $SYS_ENV[ResourcePath],
					'POST_File' =>$_FILES['uploadFile'],
					'uploadType' => 'attach',
					'NodeID' => $IN[NodeID],
					'changeName' => 1,
				);
		//['tmp_name'][$key]
			$upload = new Upload($params);
			$show_message=$_LANG_ADMIN[upload_topic]."\\n";
				foreach($upload->sysInfo as $var) {
					$show_message.='\n'.$var;
			}
			
			$src_name = $_FILES['uploadFile']['name'][0];
			$arr = explode('.', $_FILES['uploadFile']['name'][0]);
			$suffix = array_pop($arr);
			$publish_url = TplVarsAdmin::getValue('PUBLISH_URL');
			$errmsg.="<script>"
			."alert('".$show_message."');"
			."parent.returnInfo('".$upload->saveFile[0]."', '".$src_name."','".$suffix."','".$publish_url."');"
			."</script>";
		
				$TPL->assign("msg", $errmsg);
				$TPL->display("upload_complete.html");
				exit;
			break;
		case 'flash':
			$params = array(
					'rootPath'=> $SYS_ENV[ResourcePath],
					'POST_File' =>$_FILES['uploadFile'],
					'uploadType' => 'flash',
					'NodeID' => $IN[NodeID],
					'changeName' => $IN[changeName],
				);
			$upload = new Upload($params);
			$show_message=$_LANG_ADMIN[upload_topic]."\\n";
				foreach($upload->sysInfo as $var) {
					$show_message.='\n'.$var;
			}
				
			$errmsg.="<script>"
			."alert('".$show_message."');"
			."parent.returnInfo('".$upload->saveFile[0]."');"
			."</script>";

		
				$TPL->assign("msg", $errmsg);
				$TPL->display("upload_complete.html");
				exit;
			break;
	}
}
?> 