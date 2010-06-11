<?php
require_once 'common.php';
//require_once INCLUDE_PATH."admin/site_admin.class.php";

require_once INCLUDE_PATH."admin/psn_admin.class.php";

$psn = new psn_admin();

//$site = new site_admin();
switch($IN[o]) {
	case 'psn_picker':
		if(!empty($IN[psn])) {
			
			$patt = "/{PSN-URL:([0-9]+)}([\S]+)/is";
			preg_match ($patt, $IN[psn] ,$matches);
			//debug($matches);
			$psnInfo = $psn->getPSNInfo( $matches[1]);

			$TPL->assign('PSNID', $matches[1]); //have default psn
			
			$path = pathinfo($matches[2]);
			if($path[dirname] == "\\") $path[dirname]='';

			$TPL->assign('psn_path', $path[dirname]); //have default psn
			$TPL->assign('default_name', $path[basename]); //have default psn

		}
		//echo $matches[2];
		$TPL->assign('psnInfo', $psnInfo);
		$TPL->assign('psnList', $psn->getAllPSN());
		$TPL->display('select_psn_picker.html');
		break;
	case 'psn':
		if(!empty($IN[psn])) {
			
			$patt = "/{PSN:([0-9]+)}([\S]+)/is";
			preg_match ($patt, $IN[psn] ,$matches);
			//debug($matches);

			$TPL->assign('PSNID', $matches[1]); //have default psn
			
			$path = pathinfo($matches[2]);
			if($path[dirname] == "\\") $path[dirname]='';

			$TPL->assign('psn_path', $path[dirname]); //have default psn
			$TPL->assign('default_name', $path[basename]); //have default psn

		}

		$psnList = $psn->getAllPSNByPermission();
		$TPL->assign_by_ref('psnList', $psnList);
		$TPL->display('select_psn.html');
		break;
	case 'psn_list_file':

		$psnInfo = $psn->getPSNInfo($IN[PSNID]);
		//debug($psnInfo);

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
		$TPL->assign('default_name', $IN[default_name]);
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('width', $length*7 + 20);
		$TPL->assign('fileList', $fileList);
		$TPL->display('select_psn_fileList.html');
		break;
	case 'psn_picker_list_file':

		$psnInfo = $psn->getPSNInfo($IN[PSNID]);
		//debug($psnInfo);

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
		$TPL->assign('default_name', $IN[default_name]);
		$TPL->assign('PSN-URL', $psnInfo[URL]);
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('width', $length*7 + 20);
		$TPL->assign('fileList', $fileList);
		$TPL->display('select_psn_picker_fileList.html');
		break;
	case 'psn_mkdir':
		
		$psnInfo = $psn->getPSNInfo($IN[PSNID]);
		//debug($IN);

		$psn->connect($psnInfo[PSN]);
		//debug($psn->listFile());

		if($psn->mkdir($IN[PATH].'/'.$IN['dirname'], 777))
			$TPL->assign('message', 1); //messageID:1  - mkdir ok
		else
			$TPL->assign('message', 2); //messageID:2  - mkdir fail
		$psn->close();

		$psn->connect($psnInfo[PSN]);

		$fileList = $psn->listFile($IN[PATH]);
		
		$length = 0;
		foreach($fileList as $key=>$var) {
			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		$TPL->assign('default_name', $IN['dirname']);
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('width', $length*7 + 20);
		$TPL->assign('fileList', $fileList);
		$TPL->display('select_psn_fileList.html');
		break;
	case 'tpl':
		if(!empty($IN[tpl])) {
 			if(preg_match("/\{TID:([0-9]+)\}/isU", $IN[tpl], $matches)) {
				require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
 				$cate_tpl = new cate_tpl_admin();
 				$TID = $matches[1];
				$TInfo = $cate_tpl->getInfo($TID);

				$TCID = $TInfo[TCID];
				$TPL->assign('TCID', $TCID);
				$TPL->assign('TID', $TID);
 			} else {
				$path = pathinfo($IN[tpl]);
				if($path[dirname] == "\\") $path[dirname]='/';

				$TPL->assign('default_name', $path[basename]); //have default psn
				$TPL->assign('tpl_path', $path[dirname]); //have default psn
			
			}

		}
		$TPL->display('select_tpl.html');
		break;
	case 'tpl_list_file':
		//$psnInfo = $psn->getPSNInfo($IN[PSNID]);
		//debug($psnInfo);
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
			if($var['name'] == 'ROOT_NODE' || $var['name'] == 'CVS' || $var['name'] == 'ROOT') unset($fileList[$key]);
			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;
			 
		}
		//echo $length;
		$psn->close();

		$TPL->assign('default_name', $IN[default_name]);
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('width', $length*7 + 20);
		$TPL->assign('fileList', $fileList);
		$TPL->display('select_tpl_fileList.html');
		break;
	case 'cate_tpl_list_file':
		require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
		require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
		$cate_tpl = new cate_tpl_admin();
		$tpl_cate = new tpl_cate_admin();

		$CateInfo = $tpl_cate->getCateInfo($IN[TCID]);

		$cateList = $tpl_cate->getAll($IN[TCID]);
		$fileList = $cate_tpl->getAll($IN[TCID]);		
		$length = 0;
		if(!empty($fileList)) {
			foreach($fileList as $key=>$var) {
				$filelength = strlen($var[TplName]);
				if($filelength > $length ) $length  = $filelength;
				 
			}
		
		}

		if(!empty($cateList)) {
			foreach($cateList as $key=>$var) {
				$filelength = strlen($var[CateName]);
				if($filelength > $length ) $length  = $filelength;
				 
			}
		}
		$TPL->assign_by_ref('cateList', $cateList);
		$TPL->assign_by_ref('fileList', $fileList);
		$TPL->assign_by_ref('CateInfo', $CateInfo);

		$TPL->assign('width', $length*7 + 20);
		$TPL->assign('fileList', $fileList);
		$TPL->assign('cateList', $cateList);
		$TPL->display('select_cate_tpl_fileList.html');
		break;
	case 'tpl_mkdir':
		
		//$psnInfo = $psn->getPSNInfo($IN[PSNID]);
		//debug($IN);
		$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];


		$psn->connect($psnInfo[PSN]);
		//debug($psn->listFile());

		if($psn->mkdir($IN[PATH].'/'.$IN['dirname'], 777))
			$TPL->assign('message', 1); //messageID:1  - mkdir ok
		else
			$TPL->assign('message', 2); //messageID:2  - mkdir fail

		$fileList = $psn->listFile($IN[PATH]);
		
		$length = 0;
		foreach($fileList as $key=>$var) {
			$filelength = strlen($var[name]);
			if($filelength > $length ) $length  = $filelength;

		}
		$psn->close();
		$TPL->assign('default_name', $IN['dirname']);
		$TPL->assign('PSNID', $IN[PSNID]);
		$TPL->assign('PATH', $IN[PATH]);
		$TPL->assign('width', $length*7 + 20);
		$TPL->assign('fileList', $fileList);
		$TPL->display('select_tpl_fileList.html');
		break;
	case 'targetNodeWindow':
		$TPL->display('select_node.html');
		break;
	case 'targetDirWindow':
		$TPL->display('select_dir.html');
		break;
	case 'targetCateWindow':
		$TPL->display('select_collection_cate.html');
		break;
	case 'targetTplCateWindow':
		$TPL->display('select_tpl_cate.html');
		break;
	//case 'targetNodeList':
	//	header;
	//	break;
	//case 'targetNodeList':
	//	header;
	//	break;
}

?>