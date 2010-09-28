<?php
define('PLUGINS_PATH', '../plugins/'.PLUGIN.'/');
require_once PLUGINS_PATH.'include/access.class.php';
require_once PLUGINS_PATH.'plugin.config.php';
$Access =  new Access(BBS_NAME);
require_once(PLUGINS_PATH.'include/setting.class.php');
$PLUGIN_SETTING = PluginSetting::getInfo();
$TPL->assign('Member', $Access->bbs->session);
switch ($IN['o']) {
	case 'display' :
		if(!$Access->canAccess($NodeID,'ReadComment')) {//验证评论查看权限
			$TPL->assign('deny_code', $Access->deny_code);
			$TPL->display($PLUGIN_SETTING['DenyTpl']);
			exit;
		} 
 		$offset = &$Setting['CommentPageOffset'];


		$TPL->caching = &$Setting['CommentCache'];
		$TPL->cache_lifetime = '10000000000000000';  
		$TPL->assign_by_ref("kTPL_Caching", $TPL->caching );
		$cache_id = $Page.$Id;
		

		if($TPL->caching && $TPL->is_cached($tpl, $cache_id)) {
				$TPL->run_cache($tpl, $cache_id);
		} else {
			require_once INCLUDE_PATH."data.class.php";
			require_once INCLUDE_PATH."data.remote.class.php";
			//require_once INCLUDE_PATH."functions.php";


			require_once INCLUDE_PATH.'image.class.php';
			require_once INCLUDE_PATH."file.class.php";
			if (!extension_loaded('ftp')) {
				require_once INCLUDE_PATH."ftp.class.php";
			}
			require_once INCLUDE_PATH."Error.php";
			require_once INCLUDE_PATH."exception.class.php";
			require_once INCLUDE_PATH."admin/psn_admin.class.php";
			require_once INCLUDE_PATH."admin/dsn_admin.class.php";
			include_once SETTING_DIR."cms.ini.php";
		//$db->setDebug(1);
			include_once(CACHE_DIR.'Cache_SYS_ENV.php');
			include_once(CACHE_DIR.'Cache_PSN.php');
			include_once(CACHE_DIR.'Cache_CateList.php');


			require_once INCLUDE_PATH."admin/publishAdmin.class.php";
			require_once INCLUDE_PATH."admin/content_table_admin.class.php";
			require_once INCLUDE_PATH."admin/tplAdmin.class.php";
			require_once INCLUDE_PATH."admin/psn_admin.class.php";
			require_once INCLUDE_PATH."admin/site_admin.class.php";
			require_once INCLUDE_PATH."admin/dsn_admin.class.php";
			require_once INCLUDE_PATH."cms.class.php";
			require_once INCLUDE_PATH."cms.func.php";

			$sc = &$BeanFactory->getBean('SettingCache');
			$commentSetting = $sc->load('plugin_base_comment');
			
			// {{{ add 2006-01-14
			if($commentSetting['enableCommentApprove'] == 1) {
				$where = " IndexID=$Id AND Approved=1 ";
 			} else {
				$where = " IndexID=$Id ";
 			}
			// }}}


			$result= $db->Execute("SELECT COUNT(*) as nr  FROM $table_comment where $where ");
			
			$num=((int)$result->fields[nr]);
				//echo $num;
				
			$pagenum=ceil($num/$offset);
			$currentpage=$Page;
			$start=($currentpage-1)*$offset;



				
			$sql="SELECT * FROM $table_comment where $where Order by CommentID DESC LIMIT $start,$offset";
				
			$recordSet=$db->Execute($sql);
				
			while(!$recordSet->EOF) {	
							
					if($Setting['IpHidden']) {
						$pattern = "/^([0-9]+).([0-9]+).([0-9]+).([0-9]+)$/";
						$replacement = "\\1.\\2.\\3.*";
						$recordSet->fields[Ip] = preg_replace($pattern, $replacement, $recordSet->fields[Ip] );
					
					}
					
					$_izz[]=$recordSet->fields;
					$recordSet->MoveNext();
					
			}
			$recordSet->Close(); 
					
			
			$result= $db->getRow("SELECT i.NodeID,i.URL,i.IndexID,i.PublishDate,i.Type,i.Sort,i.Pink,c.* FROM $table->content_index i,$table_content c  where i.IndexID=$Id AND i.ContentID =c.ContentID");
			
			$TPL->assign_by_ref("CommentList",$_izz);
			$TPL->assign("CountNum",$num);
			$TPL->assign_by_ref("Publish",$result);
			
			$TPL->assign("NodeId",$NodeId);
			$TPL->assign("Id",$Id);
			$TPL->assign("Page",comment_display_page($pagenum,$Page,$PHP_SELF."?o=display&amp;id=$Id"));
			$TPL->registerPreFilter('CMS_Parser');
			if($TPL->caching) {
				$TPL->run_cache($tpl, $cache_id);
			} else {
				$TPL->display($tpl);

			}
		
		}
	$db->Close(); 
		break;
	case 'post' :
		if($PUBLISH_CONFIG['comment_validcode']) {
			session_start();
			if(empty($_SESSION['sessionValid']) || empty($IN['validCode'])) { //如果没有通过validCode.php注册$_SESSION['sessionValid']
				goback("comment.validcode.error");
			} elseif(!function_exists('ImagePNG')) { //或者GD库未安装，则自动跳过验证码验证
					
			} elseif($IN['validCode'] == $_SESSION['ValidateCode']) { //验证码输入正确
					
			} else {//验证码不正确，提示
				goback("comment.validcode.error");

			}	
		}

		if(!$Access->canAccess($NodeID,'PostComment')) {//验证评论发布权限
			$TPL->assign('deny_code', $Access->deny_code);
			$TPL->display($PLUGIN_SETTING['DenyTpl']);
			exit;
		} 
		
		$table_count = $db_config['table_pre'].'plugin_base_count';

		if ($IN['content'] != '') {
			
			$sc = &$BeanFactory->getBean('SettingCache');
			$commentSetting = $sc->load('plugin_base_comment');
			
			//{{{ 评论发表功能改进 2006-1-10
			if($commentSetting['enableComment'] != 1) 				goback("comment.disabled");


			$content = trim(addslashes(htmlspecialchars($IN['content'])));
			$IN['username'] = empty($IN['username']) ? $_LANG_ADMIN['guest'] : trim($IN['username']);

			if(strlen($content) > $commentSetting['contentMaxLength'])
				goback("comment.length.overflow", array($commentSetting['contentMaxLength']));
			

			if(strlen($content) <= $commentSetting['contentMinLength'] ) 
				goback("comment.length.less", array($commentSetting['contentMinLength']));

			if(!empty($IN['username']) && strlen($IN['username']) > $commentSetting['usernameMaxLength'])
				goback("comment.username.length.overflow", array($commentSetting['usernameMaxLength']));

			//关键字过滤
			if(!empty($commentSetting['filterMode'])) {
				$bannedWords = explode(',', $commentSetting['filterWords']);
				$content_todo = str_replace(' ', '', $IN['content']);
				$username_todo = str_replace(' ', '', $IN['username']);
				foreach($bannedWords as $var) {
					$posA = strpos($content_todo, $var);
					$posB = strpos($username_todo, $var);
					if($posA === false && $posB === false) continue;
					else {
						if($commentSetting['filterMode'] == 1) goback("comment.badwords", array($var));
						else {
							$replace = str_repeat($commentSetting['replaceWord'], ceil(strlen($var)/2));
							$IN['content'] = str_replace($var, $replace, $IN['content']);
							$IN['username'] = str_replace($var, $replace, $IN['username']);
						}
				
					}
				
				}
			
			}

			//}}}
			
			//`CommentID` , `IndexID` , `ContentID` , `NodeID` , `Author` , `CreationDate` , `Ip` , `Comment`
			$time = time();
			$ip = $IN["IP_ADDRESS"];
		
			$IN['username'] = $db->escape_string($IN['username']);
			$content = $db->escape_string($content);

			$sql = "SELECT ContentID,NodeID From $table_count WHERE IndexID='$Id'";
			$result = $db->getRow($sql);

			$add = $db->query("INSERT INTO $table_comment (  `IndexID` , `ContentID` , `NodeID` , `Author` , `CreationDate` , `Ip` , `Comment` ) 
						VALUES (
							 '$Id' , '{$result[ContentID]}' , '{$result[NodeID]}' , '{$IN['username']}' , '$time' , '$ip' , '$content'
						)");
			$db->query("UPDATE $table_count SET `CommentNum`=CommentNum+1 where IndexID='$Id'");
			if ($add) {
				$result= $db->Execute("SELECT COUNT(*) as nr  FROM $table_comment where IndexID=$Id");
				
				$num=((int)$result->fields[nr]);
				for($i=1;$i<=$num;$i++) {
					$TPL->clear_cache($tpl, $i.$Id);
				}

				include_once("js.config.php");
				$cacheId = "comment".$Id."000";
				$tplname = &$templateKeys["comment"];
				$TPL->clear_cache($tplname, $cacheId );
				
 				if($commentSetting['enableCommentApprove'] == 0) echo $_LANG_ADMIN['post_ok'];
				else echo $_LANG_ADMIN['post_ok_approve'];
				
				
				echo "<meta http-equiv=\"refresh\" content=\"2;url=comment.php?o=display&amp;id=$Id\">";
				
			}
		} else {
			goback("comment_null");
		}

		break;

}
?>