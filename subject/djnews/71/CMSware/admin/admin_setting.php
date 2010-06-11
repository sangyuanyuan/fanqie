<?php
//$Id: admin_setting.php,v 1.16 2006/08/02 15:09:22 Administrator Exp $

require_once 'common.php';


if(!$sys->isAdmin() && $IN[o] != 'clear_cache_submit' && $IN[o] !='viewInfo') {
	goback('access_deny_module_setting');

}

require_once INCLUDE_PATH."admin/groupAdmin.class.php";
require_once INCLUDE_PATH."admin/userAdmin.class.php";
require_once INCLUDE_PATH."admin/userextraAdmin.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";


$psn = new psn_admin();

switch($IN[o]) {
	case 'viewInfo':
		require_once INCLUDE_PATH."admin/content_table_admin.class.php";
		require_once INCLUDE_PATH.'admin/TplVarsAdmin.class.php';
		$tpl_vars = new TplVarsAdmin();
		$TPL->assign('tplVars', $tpl_vars->getAll());
		$TPL->assign('tableInfo', content_table_admin::getAllTable());
		$TPL->assign('psnInfo',psn_admin::getAllPSN());
		$TPL->assign('NODE_LIST', $NODE_LIST);
		$TPL->display('view_cms_info.html');
		$diableDebug = true;
		break;
	case "viewErrorInfo":
		$filename = "error.".date("Ymd").".log.php";
		if(is_writable(SYS_PATH."sysdata/logs")) {
			$filename = SYS_PATH."sysdata/logs/".$filename;
		} else {
			$filename = SYS_PATH."sysdata/".$filename;
		}
		if(file_exists($filename)) {
			$output = file_get_contents($filename);
			$output = str_replace("<?php exit('Access Denied!'); ?>\n", "", $output);
			$TPL->assign_by_ref('output', $output);
		}
		
		$TPL->display('view_cms_error_info.html');
		$diableDebug = true;
		
		break;
	case 'editor_frameset':
		$TPL->assign('o', $IN[extra]);
		$TPL->display('func_editor_frameset.html');
		break;
	case 'editor_header':
		$TPL->assign('o', $IN[extra]);
		$TPL->display('func_editor_header.html');
		$diableDebug = true;
		break;

	case 'crawler_func':
		$psnInfo[PSN] = 'file::'.SETTING_DIR;


		$psn->connect($psnInfo[PSN]);
		$content = $psn->read('', "crawler.ini.php");
		$psn->close();
		include MODULES_DIR.'func_editor.php' ;
		break;
	case 'crawler_func_submit':
		$psnInfo[PSN] = 'file::'.SETTING_DIR;


		$psn->connect($psnInfo[PSN]);
		$psn->isLog = false;
		if($psn->put("crawler.ini.php", $IN[content])) {
				showmessage('crawler_func_edit_ok', $referer);
		
		} else {
				showmessage('crawler_func_edit_fail', $referer);
		
		}

		$psn->close();
		break;
	case 'cms_func':
		$psnInfo[PSN] = 'file::'.SETTING_DIR;


		$psn->connect($psnInfo[PSN]);
		$content = $psn->read('', "cms.ini.php");
		$psn->close();
		include MODULES_DIR.'func_editor.php' ;
		break;
	case 'cms_func_submit':
		$psnInfo[PSN] = 'file::'.SETTING_DIR;


		$psn->connect($psnInfo[PSN]);
		$psn->isLog = false;
		if($psn->put("cms.ini.php", $IN[content])) {
				showmessage('cms_func_edit_ok', $referer);
		
		} else {
				showmessage('cms_func_edit_fail', $referer);
		
		}

		$psn->close();
		break;
	case 'clear_cache':
		$TPL->display('admin_clear_cache.html');
		break;
	case 'clear_cache_submit':
		if(!empty($IN[target]['compile_tpl'])) {
			clearDir($TPL->compile_dir,'index.html;.htaccess') ;
		}

		if(!empty($IN[target]['sys_cache'])) {
			@unlink(CACHE_DIR.'Cache_SYS_ENV.php');
			@unlink(CACHE_DIR.'Cache_PSN.php');
			@unlink(CACHE_DIR.'Cache_CateList.php');
 			@unlink(CACHE_DIR.'Cache_ContentModel.php');
		}

		if(!empty($IN[target]['node_cache'])) {
			clearDir(SYS_PATH.'sysdata/sysinfo/','index.html;.htaccess') ;
		}

		if(!empty($IN[target]['cache_dir'])) {
			clearDir($TPL->cache_dir,'index.html;.htaccess') ;
		}

		if(!empty($IN[target]['automini_dir'])) {
			clearDir(SYS_PATH.'sysdata/automini','index.html;.htaccess') ;
		}

		if(!empty($IN[target]['tpl_dir'])) {
			clearDir(SYS_PATH.'sysdata/tmp','index.html;.htaccess') ;
		}
		if(strpos($referer,"o=sys::view&extra=admin_sys")) {
			$referer = "index.php?sId=".$IN[sId]."&o=sys::view&extra=workarea";
		}
		showmessage('clear_cache', $referer);
		break;
	case 'edit':
		$TPL->assign('sInfo', $SYS_ENV);
		$TPL->assign('language', LANG::getLangList());
		$TPL->display('admin_setting.html');
		break;

	case 'edit_submit':
		$insertdata= new iData();


		$insertdata->flushData();
		$insertdata->addData('varValue',$IN['AutoPageLen']);
		$where="where varName='AutoPageLen'";
		$insertdata->dataUpdate($table->sys,$where); 

		//enable_gzip
		$insertdata->flushData();
		$insertdata->addData('varValue', "0");
		$where="where varName='enable_gzip'";
		$insertdata->dataUpdate($table->sys,$where);  
		
		//sessionTimeout
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[sessionTimeout]);
		$where="where varName='sessionTimeout'";
		$insertdata->dataUpdate($table->sys,$where);  

		//ContentPageNum
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[ContentPageNum]);
		$where="where varName='ContentPageNum'";
		$insertdata->dataUpdate($table->sys,$where);  
		
		//SearchPageNum
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[SearchPageNum]);
		$where="where varName='SearchPageNum'";
		$insertdata->dataUpdate($table->sys,$where);  

		//CollectionPageNum
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[CollectionPageNum]);
		$where="where varName='CollectionPageNum'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[admin_templatepath]);
		$where="where varName='templatePath'";
		$insertdata->dataUpdate($table->sys,$where); //网站模板根目录

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[admin_sysname]);
		$where="where varName='sysname'";
		$insertdata->dataUpdate($table->sys,$where); //iWPC安装URL

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[DisplayPublishCount]);
		$where="where varName='DisplayPublishCount'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[DisplayNodeID]);
		$where="where varName='DisplayNodeID'";
		$insertdata->dataUpdate($table->sys,$where); //iWPC安装URL


		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[admin_backup]);
		$where="where varName='backupPath'";
		$insertdata->dataUpdate($table->sys,$where); //数据备份存储目录
		
		/*$insertdata->flushData();
		$insertdata->addData('varValue',$IN[admin_uploadPath]);
		$where="where varName='uploadPath'";
		$insertdata->dataUpdate($table->sys,$where); //上传文件存储目录
	
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[admin_uploadUrl]);
		$where="where varName='uploadUrl'";
		$insertdata->dataUpdate($table->sys,$where); //上传文件存储目录URL*/

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[smtp_host]);
		$where="where varName='smtp_host'";
		$insertdata->dataUpdate($table->sys,$where); //smtp邮件服务器地址
	
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[smtp_username]);
		$where="where varName='smtp_username'";
		$insertdata->dataUpdate($table->sys,$where); //邮件服务器账号

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[smtp_password]);
		$where="where varName='smtp_password'";
		$insertdata->dataUpdate($table->sys,$where); //邮件服务器账户密码
	
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[smtp_auth]);
		$where="where varName='smtp_auth'";
		$insertdata->dataUpdate($table->sys,$where); //邮件服务器是否需要验证
	
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[upImgType]);
		$where="where varName='upImgType'";
		$insertdata->dataUpdate($table->sys,$where); //上传图片类型限制

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[upImgSize]);
		$where="where varName='upImgSize'";
		$insertdata->dataUpdate($table->sys,$where); //上传图片大小限制
	
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[upFlashSize]);
		$where="where varName='upFlashSize'";
		$insertdata->dataUpdate($table->sys,$where); //上传Flash大小限制

		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[upAttachType]);
		$where="where varName='upAttachType'";
		$insertdata->dataUpdate($table->sys,$where); //上传附件类型限制
	
		$insertdata->flushData();
		$insertdata->addData('varValue',$IN[upAttachSize]);
		$where="where varName='upAttachSize'";
		$insertdata->dataUpdate($table->sys,$where); //上传附件大小限制
	
		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[taskTimeout]);
		$where="where varName='tasktimeout'";
		$insertdata->dataUpdate($table->sys,$where); //自动更新任务执行时间

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[openTask]);
		$where="where varName='openTask'";
		$insertdata->dataUpdate($table->sys,$where); //开启自动更新任务

		/*$insertdata->flushData();
		$insertdata->addData('varValue', $IN[sitename]);
		$where="where varName='sitename'";
		$insertdata->dataUpdate($table->sys,$where); //网站名称*/
	
		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[is_safe_mode]);
		$where="where varName='is_safe_mode'";
		$insertdata->dataUpdate($table->sys,$where); //PHP限制模式

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ftp_server]);
		$where="where varName='ftp_server'";
		$insertdata->dataUpdate($table->sys,$where); //FTP服务器地址
		
		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ftp_server_port]);
		$where="where varName='ftp_server_port'";
		$insertdata->dataUpdate($table->sys,$where); //FTP服务器端口

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ftp_user_name]);
		$where="where varName='ftp_user_name'";
		$insertdata->dataUpdate($table->sys,$where); //FTP服务器账户
		
		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ftp_user_pass]);
		$where="where varName='ftp_user_pass'";
		$insertdata->dataUpdate($table->sys,$where); //FTP服务器账户密码
	
		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ftp_cms_admin_path]);
		$where="where varName='ftp_cms_admin_path'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[localImgIgnoreURL]);
		$where="where varName='localImgIgnoreURL'";
		$insertdata->dataUpdate($table->sys,$where);  

	/*	$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ResourcePath]);
		$where="where varName='ResourcePath'";
		$insertdata->dataUpdate($table->sys,$where);  
	*/
		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[language]);
		$where="where varName='language'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[isLogLogin]);
		$where="where varName='isLogLogin'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[isLogAdmin]);
		$where="where varName='isLogAdmin'";
		$insertdata->dataUpdate($table->sys,$where);  


		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[LoginTryTime]);
		$where="where varName='LoginTryTime'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[LoginTryCount]);
		$where="where varName='LoginTryCount'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[WaterMarkPosition]);
		$where="where varName='WaterMarkPosition'";
		$insertdata->dataUpdate($table->sys,$where);  


		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[WaterMarkImgPath]);
		$where="where varName='WaterMarkImgPath'";
		$insertdata->dataUpdate($table->sys,$where);  


		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[EnableWaterMark]);
		$where="where varName='EnableWaterMark'";
		$insertdata->dataUpdate($table->sys,$where);  



		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[EnableEditorWaterMark]);
		$where="where varName='EnableEditorWaterMark'";
		$insertdata->dataUpdate($table->sys,$where);  


		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[EnableCLWaterMark]);
		$where="where varName='EnableCLWaterMark'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ContentViewMode]);
		$where="where varName='ContentViewMode'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[CollectionViewMode]);
		$where="where varName='CollectionViewMode'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[ContributionViewMode]);
		$where="where varName='ContributionViewMode'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[DefaultResourcePSN]);
		$where="where varName='DefaultResourcePSN'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[DefaultResourcePSNURL]);
		$where="where varName='DefaultResourcePSNURL'";
		$insertdata->dataUpdate($table->sys,$where);  


		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[DefaultContentPSN]);
		$where="where varName='DefaultContentPSN'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[DefaultContentPSNURL]);
		$where="where varName='DefaultContentPSNURL'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[DialogFitXP]);
		$where="where varName='DialogFitXP'";
		$insertdata->dataUpdate($table->sys,$where);  

		$insertdata->flushData();
		$insertdata->addData('varValue', $IN[AutoRefreshTree]);
		$where="where varName='AutoRefreshTree'";
		$insertdata->dataUpdate($table->sys,$where);  


		$cache = new CacheData();
		$cache->makeCache('sys');
		showmessage('edit_setting', $referer);

}

include('./modules/footer.php');



?>