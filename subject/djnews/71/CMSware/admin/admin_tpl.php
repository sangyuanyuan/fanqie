<?php
//$Id: admin_tpl.php,v 1.8 2006/06/20 14:52:42 Administrator Exp $

require_once 'common.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";


$psn = new psn_admin();

if(isset($IN['targetNodeID']))	$_SESSION['targetNodeID'] = $IN['targetNodeID'];
if(isset($IN['IndexID']))	$_SESSION['IndexID'] = $IN['IndexID'];

//if(!isset($IN[NodeID])) $IN[NodeID] = $_SESSION['targetNodeID'];


switch($IN[o]) {
	case 'tree':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}

		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
		//debug($psn->listFile());
			
		if($IN[extra] == 'updir') {
			
			$path = pathinfo($IN[PATH]);
			if($path[dirname] == "\\") $path[dirname]='';
			$fileList = $psn->listFile($path[dirname]);
			$IN[PATH] = $path[dirname];
			//debug($path);
		
		}else {
			$fileList = $psn->listFile($IN[PATH]);
		
		}
		$length = 0;
		foreach($fileList as $key=>$var) {
			if($var['name'] == 'ROOT' || $var['name'] == 'CVS') unset($fileList[$key]);

			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		
		$TPL->assign('fileList', $fileList);
		//debug($fileList);
		$TPL->display('tree_tpl.html');

		break;

	case 'dir_select':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
			
		$fileList = $psn->listFile($IN[PATH]);
		
		
		$length = 0;
		foreach($fileList as $key=>$var) {
			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		
		$TPL->assign('fileList', $fileList);
		$TPL->display('tree_dir_select.html');

		break;
	case 'dir_select_xml':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
		//debug($psn->listFile());
			
		$fileList = $psn->listFile($IN[PATH]);
		
		
		$length = 0;
		foreach($fileList as $key=>$var) {
			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('fileList', $fileList);
		//debug($fileList);

		header("Content-Type: text/xml; charset=gb2312\n");
		$now = gmdate('D, d M Y H:i:s') . ' GMT';
		header('Expires: ' . $now);
		$TPL->display('dir_select_xml.xml');
		break;
	case 'tpl_xml':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
		//debug($psn->listFile());
			
		if($IN[extra] == 'updir') {
			
			$path = pathinfo($IN[PATH]);
			if($path[dirname] == "\\") $path[dirname]='';
			$fileList = $psn->listFile($path[dirname]);
			$IN[PATH] = $path[dirname];
			//debug($path);
		
		}else {
			$fileList = $psn->listFile($IN[PATH]);
		
		}
		$length = 0;
		foreach($fileList as $key=>$var) {

			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('DirList', $fileList);
		//debug($fileList);

		header("Content-Type: text/xml; charset=gb2312\n");
		$now = gmdate('D, d M Y H:i:s') . ' GMT';
		header('Expires: ' . $now);
		$TPL->display('tpl_xml.xml');
		break;
	case 'list':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];

		if(strtoupper($IN['PATH']) == '/ROOT') {
			$IN['PATH'] = '';
		}
		$psn->connect($psnInfo[PSN]);
		//debug($psn->listFile());
			
		if($IN[extra] == 'updir') {
			
			$path = pathinfo($IN[PATH]);
			if($path[dirname] == "\\") $path[dirname]='';
			$fileList = $psn->listFile($path[dirname]);
			$IN[PATH] = $path[dirname];
			//debug($path);
		
		}else {
			$fileList = $psn->listFile($IN[PATH]);
		
		}
		$length = 0;
		foreach($fileList as $key=>$var) {
			if($var['name'] == 'ROOT' || $var['name'] == 'CVS') unset($fileList[$key]);

			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('fileList', $fileList);
		//debug($fileList);
		$TPL->display('tpl_fileList.html');
		break;
	case 'del':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		//debug($IN);
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
			
		if(!empty($IN[multi]) && !empty($IN[pData]) ) {
			foreach($IN[pData] as $var) {
					$result = $psn->delFile($IN[PATH],$var);				
			}
			$psn->close();
			if($result)
				showmessage('psn_delFile_ok', $referer);
			else
				showmessage('psn_delFile_fail', $referer);

		} else {
			
			if($psn->delFile($IN[PATH],$IN[targetFile])) {
				$psn->close();
				exit('1');
			} else {
				$psn->close();
				exit('0');
			
			}
			
		}

		break;
	case 'editor_frameset':
		$TPL->assign('targetFile', $IN[targetFile]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('o', $IN[extra]);
		$TPL->assign('TCID', $IN[TCID]);
		$TPL->assign('TID', $IN[TID]);
		$TPL->assign('NodeID', $IN[NodeID]);
		$TPL->display('tpl_editor_frameset.html');
		break;
	case 'editor_header':
		$TPL->assign('targetFile', $IN[targetFile]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('NodeID', $IN[NodeID]);
		$TPL->assign('TCID', $IN[TCID]);
		$TPL->assign('TID', $IN[TID]);
		$TPL->assign('o', $IN[extra]);
		$TPL->display('tpl_editor_header.html');
		$diableDebug = true;
		break;
	case 'view':
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
		$content = $psn->read($IN[PATH],$IN[targetFile]);
		$psn->close();
		echo $content;
		break;
	case 'edit':
		require_once INCLUDE_PATH."admin/publishAdmin.class.php";
		require_once INCLUDE_PATH."admin/content_table_admin.class.php";
		require_once INCLUDE_PATH."admin/tplAdmin.class.php";
		require_once INCLUDE_PATH."admin/site_admin.class.php";
		require_once INCLUDE_PATH."cms.class.php";
		require_once INCLUDE_PATH."cms.func.php";
		require_once INCLUDE_PATH.'encoding/encoding.inc.php';
		require_once INCLUDE_PATH."admin/psn_admin.class.php";
		require_once INCLUDE_PATH."admin/plugin.class.php";
		require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
		require_once INCLUDE_PATH."admin/task.class.php";
		require_once INCLUDE_PATH.'image.class.php';

		if(empty($IN[NodeID]) && empty($IN[TCID])) {
			//PATH=/cw_news&targetFile=content.htm
			if(!empty($IN['targetFile'])) {
				$tempFileName = substr($IN['sId'], 15) .substr(md5($IN['targetFile']), 15).".tmp";
			} else {
				showmessage('', $referer);
			}
			//echo $tempFileName;
		} elseif(!empty($IN[TID]) && !empty($IN[TCID])) {
			$tempFileName = $IN['sId'].$IN[TCID]."o".$IN[TID].".tmp";
		
		} else {
			$Plugin = new Plugin();

			$publish = new publishAdmin();
			$psn = new psn_admin();
			$publish->NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			$NodeInfo = &$publish->NodeInfo;
			$tempFileName = substr($IN['sId'], 15) .substr(md5($NodeInfo[IndexTpl]), 15).".tmp";
		
		}





		//$tempFileName = substr($IN['sId'], 15) .substr(md5($publish->NodeInfo[IndexTpl]), 15).".tmp";
		$psnInfo[PSN] = 'file::'.CACHE_DIR."tmp";
		$psn->connect($psnInfo[PSN]);

		if($psn->fileExists($tempFileName)) {
			
			//Get the editing temporary template file	 
			$content = $psn->read('', $tempFileName);
			$psn->close();
			
		} else {
			$psn->connect('file::'.$SYS_ENV['templatePath']);
			if(empty($IN[NodeID])&& empty($IN[TID])) {
				//Get the original template file
				$content = $psn->read($IN[PATH],$IN['targetFile']);
			
			} elseif(!empty($IN[TID]) && !empty($IN[TCID])) {
				$content = $psn->read('', 'ROOT/'.$IN['TCID']."/".$IN['TID'].".tpl");
		
			} else {
				//Get the original template file
				$content = $psn->read($IN[PATH],$publish->NodeInfo[IndexTpl]);
			
			}
			$psn->close();


			$psn->connect($psnInfo[PSN]);
			$psn->isLog = false;
			$psn->put('/'.$tempFileName, $content);
			$psn->close();


		}
		$contentLength = strlen($content);
		$content = htmlspecialchars($content);



		include MODULES_DIR.'tpl_editor.php' ;
		break;
	case 'edit_submit':
		require_once INCLUDE_PATH."admin/psn_admin.class.php";
		require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
		$psn = new psn_admin();
		$cate_tpl = new cate_tpl_admin();
		
		$psnInfo[PSN] = 'file::'.CACHE_DIR."tmp";
		$psn->connect($psnInfo[PSN]);
		if(!empty($IN[NodeID])) {
			$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			$tempFileName = substr($IN['sId'], 15) .substr(md5($NodeInfo[IndexTpl]), 15).".tmp";
			$psn->delFile($path, $tempFileName);
		} elseif(!empty($IN[TID]) && !empty($IN[TCID])) {
			$tempFileName = $IN['sId'].$IN[TCID]."o".$IN[TID].".tmp";
		//	$psn->delFile($path, $tempFileName);
			//$IN['PATH'] = "/ROOT/".	$IN['TCID']	;
			//$IN[targetFile] = $IN['TID'].".html"	;
			$psn->isLog = false;
			if($psn->put('/'.$tempFileName, $IN[content])) {
					echo "<script>\n
 						
						alert(\"{$_LANG_ADMIN['tpl_edit_ok']}\");\n
						parent.window.close();\n			
						</script>\n";		
 			} else
				showmessage('tpl_edit_fail', $referer);	
			
			exit;

		} else {
			if(!empty($IN['targetFile'])) {
				$tempFileName = substr($IN['sId'], 15) .substr(md5($IN['targetFile']), 15).".tmp";
				$psn->delFile($path, $tempFileName);
			}		
		}

 		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}


		$psn->close();
	
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
		$psn->connect($psnInfo[PSN]);
		$psn->isLog = false;
		if($psn->put($IN[PATH].'/'.$IN[targetFile], $IN[content])) {
			showmessage('tpl_editFile_ok', $referer);
		
		} else {
			showmessage('tpl_editFile_fail', $referer);
		
		}

		$psn->close();

		break;
	case 'updateTmpSubmit':
		require_once INCLUDE_PATH."admin/psn_admin.class.php";
		$psn = new psn_admin();

		if(empty($IN[NodeID]) && empty($IN[TCID])) {
			if(!empty($IN['targetFile'])) {
				$tempFileName = substr($IN['sId'], 15) .substr(md5($IN['targetFile']), 15).".tmp";
 			} else {
				$tempFileName = $IN['sId'].".tmp";
			}		

		} elseif(!empty($IN[TCID])) {
			$tempFileName = $IN['sId'].$IN[TCID]."o".$IN[TID].".tmp";
	
		} else {
			$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			$tempFileName = substr($IN['sId'], 15) .substr(md5($NodeInfo[IndexTpl]), 15).".tmp";
		
		}
		$psnInfo[PSN] = 'file::'.CACHE_DIR."tmp";
		$psn->connect($psnInfo[PSN]);
		$psn->isLog = false;
		$psn->put('/'.$tempFileName, $IN[updateContent]);
		header("Location: $referer");
		
		
		$psn->close();
		break;
	case 'add':
		require_once INCLUDE_PATH."admin/publishAdmin.class.php";
		require_once INCLUDE_PATH."admin/content_table_admin.class.php";
		require_once INCLUDE_PATH."admin/tplAdmin.class.php";
		require_once INCLUDE_PATH."admin/site_admin.class.php";
		require_once INCLUDE_PATH."cms.class.php";
		require_once INCLUDE_PATH."cms.func.php";
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
			$tempFileName = $IN['sId'].".tmp";
			if($psn->fileExists($tempFileName)) {
				
				//Get the editing temporary template file	 
				$content = $psn->read($IN[PATH], $tempFileName);
				$psn->close();
				
			} else {
				 
 				$content =  "";

				$psn->connect($psnInfo[PSN]);
				$psn->isLog = false;
				$psn->put($IN[PATH].'/'.$tempFileName, $content);
				$psn->close();
			}		

		} elseif(!empty($IN[TCID])) {
			$tempFileName = $IN['sId'].$IN[TCID]."o".$IN[TID].".tmp";
			if($psn->fileExists($tempFileName)) {
				
				//Get the editing temporary template file	 
				$content = $psn->read('', $tempFileName);
				$psn->close();
				
			} else {
				 
 				$content =  "";

				$psn->connect($psnInfo[PSN]);
				$psn->isLog = false;
				$psn->put('/'.$tempFileName, $content);
				$psn->close();
			}		
		
		}else {
			$publish->NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			$tempFileName = substr($IN['sId'], 15) .substr(md5($NodeInfo[IndexTpl]), 15).".tmp";

			if($psn->fileExists($tempFileName)) {
				
				//Get the editing temporary template file	 
				$content = $psn->read($IN[PATH], $tempFileName);
				$psn->close();
				
			} else {
				 
				//Get the original template file
				$psn->connect('file::'.$SYS_ENV['templatePath']);
				$content = $psn->read($IN[PATH],$publish->NodeInfo[IndexTpl]);
				$psn->close();

				$psn->connect($psnInfo[PSN]);
				$psn->isLog = false;
				$psn->put($IN[PATH].'/'.$tempFileName, $content);
				$psn->close();
			}		
		}


		$contentLength = strlen($content);
		$content = htmlspecialchars($content);



		include MODULES_DIR.'tpl_editor.php' ;
		break;
	case 'add_submit':
		if(!empty($IN[TCID])) {//分类模板保存
			$psnInfo[PSN] = 'file::'.CACHE_DIR."tmp";
			$tempFileName = $IN['sId'].$IN[TCID]."o".$IN[TID].".tmp";

			$psn->connect($psnInfo[PSN]);
			$psn->isLog = false;
			if($psn->put('/'.$tempFileName, $IN[content])) {

					echo "<script>\n
						parent.window.opener.clientform.mode_upload.value = 0;\n
						parent.window.opener.clientform.upload.disabled = true;\n
						alert(\"{$_LANG_ADMIN['tpl_add_ok']}\");\n
						parent.window.close();\n			
						</script>\n";		
 			} else
				showmessage('tpl_add_fail', $referer);		

		} else { //
			if(!$sys->canAccess('canTpl')) {
				goback('access_deny_module_tpl');

			}
			$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
			$psn->connect($psnInfo[PSN]);

			if(isDeniedExtensions($IN['targetFile'], true)) showmessage('tpl_add_fail_denied_extensions', $referer);	

			$psn->isLog = false;
			if($psn->put($IN[PATH].'/'.$IN['targetFile'], $IN[content])) {
					echo "<script>\n
						parent.window.opener.location = parent.window.opener.location;				
						</script>\n";		
					showmessage('tpl_add_ok', $referer);
			}
			else
				showmessage('tpl_add_fail', $referer);		
		}

		break;
	case 'isFileExists':
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
		if($psn->fileExists($IN[PATH].'/'.$IN['targetFile'])) 
			exit('2');

		break;
	case 'mkdir':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);

		if($psn->mkdir($IN[PATH].'/'.$IN['dirname'], 777))
			echo '1';
		else
			echo '0';
		$psn->close();
		exit;
		break;
	case 'deldir':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);

		if($psn->rmdir($IN[PATH].'/'.$IN['dirname']))
			echo '1';
		else
			echo '0';
		$psn->close();
		exit;
		break;

	case 'upload':
		$TPL->assign('targetFile', $IN[targetFile]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('TCID', $IN[TCID]);
		$TPL->display('tpl_upload.html');
		$diableDebug = true;
		break;
	case 'upload_submit':
		$psn->isLog = false;
		if(!empty($IN[TCID])) {
			$psnInfo[PSN] = 'file::'.CACHE_DIR."tmp";
			$psn->connect($psnInfo[PSN]);
			require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
			$tpl_cate = new tpl_cate_admin();
			$CateInfo = $tpl_cate->getCateInfo($IN[TCID]);
			
			if($psn->upload($_FILES['uploadFile']['tmp_name'], "/".$IN['sId'].".upload")) {
				echo "<script>\n
						window.opener.tplInputByUpload.innerHTML = \"<B>{$_FILES['uploadFile']['name']}</B>\";\n	window.opener.clientform.mode_upload.value = 1;\n
						window.opener.clientform.editor.disabled = true;\n
						alert(\"{$_LANG_ADMIN['tpl_upload_ok']}\");\n
						window.close();\n
						</script>\n";
				exit;
  			} else {
				halt('tpl_upload_fail');
			}
			
			
		} else {
			if(!$sys->canAccess('canTpl')) {
				goback('access_deny_module_tpl');

			}
			
			preg_match("/(.*)\.([a-zA-Z0-9]+)/is", $_FILES['uploadFile']['name'], $match);
 			if($match[2] != 'html' && $match[2] != 'htm' && $match[2] != 'tpl' && $match[2] != 'wml' && $match[2] != 'xml') {
				///unlink($_FILES['uploadFile']['tmp_name']);
				goback('upload_tpl_suffix_invalid');
			
			}

			$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
			$psn->connect($psnInfo[PSN]);
			if($psn->upload($_FILES['uploadFile']['tmp_name'], $IN[PATH].'/'.$_FILES['uploadFile']['name'])) {
				echo "<script>\n
						window.opener.location = parent.window.opener.location;				
						alert(\"{$_LANG_ADMIN['tpl_upload_ok']}\");\n
						window.onload = window.close();\n
						</script>\n";
				exit;
 			} else {
				halt('tpl_upload_fail');
			}
		
		}
		break;
	case 'changefilename':
	case 'changedirname':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		preg_match("/(.*)\.([a-zA-Z0-9]+)/is", $IN['newFile'], $match);
 		if($match[2] != 'html' && $match[2] != 'htm' && $match[2] != 'tpl' && $match[2] != 'wml' && $match[2] != 'xml') {
			echo '0';exit;
			
		}

		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
		$psn->connect($psnInfo[PSN]);
		if($psn->renameFile($IN[PATH].'/'.$IN['targetFile'], $IN[PATH].'/'.$IN['newFile']))
			echo '1';
		else
			echo '0';
		$psn->close();
		exit;
		break;

	case 'move':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
		$psn->connect($psnInfo[PSN]);
		if($psn->move($IN[PATH].'/'.$IN['targetFile'], $IN[targetPATH].'/'.$IN['targetFile']))
			echo '1';
		else
			echo '0';
		$psn->close();
		exit;
		break;

	case 'copy':
		if(!$sys->canAccess('canTpl')) {
			goback('access_deny_module_tpl');

		}
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
		$psn->connect($psnInfo[PSN]);
		//echo $IN[PATH].'/'.$IN['targetFile'] .'-------'. $IN[targetPATH].'/'.$IN['targetFile'];
		if($psn->cp($IN[PATH].'/'.$IN['targetFile'], $IN[targetPATH].'/'.$IN['targetFile']))
			echo '1';
		else
			echo '0';
		$psn->close();
		exit;
		break;




}

?>