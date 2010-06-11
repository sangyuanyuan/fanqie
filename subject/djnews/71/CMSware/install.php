<?php
/**
* Copyright (C) 1999-2006 Sagatec Technology Ltd (CMSware). All rights reserved.
* This source file is part of the CMSware Content Management System.
* 
* This is NOT a freeware,use is subject to license terms
* For pricing of this licence please contact us via e-mail to market@cmsware.com.
* Further contact information is available at http://www.cmsware.com/.
* 
* $Id: install.php,v 1.38 2006/08/15 15:24:42 Administrator Exp $
* 
* CMSware Main Configuration File
*  
* 最后修改：easyT,2007.12.4
*/

define ('DEBUG_MODE','2');
define ('Error_Display','html');
set_magic_quotes_runtime(0);

$phpVersion = substr(phpversion(), 0 ,1);

if($phpVersion == 5) 	define("PHP_VERSION_5", true);
else	define("PHP_VERSION_5", false);

define('INCLUDE_PATH','./include/');
define('KTPL_DIR', INCLUDE_PATH.'lib/kTemplate/');
define('KDB_DIR',INCLUDE_PATH.'lib/kDB/');
define('SYS_PATH', './');
define('ROOT_PATH', './');
define('CACHE_DIR','./sysdata/');
define('LIB_PATH', INCLUDE_PATH.'lib/');
define('LANG_PATH', ROOT_PATH.'language/');

require_once LIB_PATH."file.class.php";


require_once SYS_PATH."config.php";
require_once KTPL_DIR . 'kTemplate.class.php';
require_once INCLUDE_PATH."data.class.php";
require_once INCLUDE_PATH."functions.php";
require_once INCLUDE_PATH."file.class.php";
//require_once INCLUDE_PATH."Error.php";
//require_once INCLUDE_PATH."exception.class.php";
require_once INCLUDE_PATH."Error.php";
define('ADMIN_DIR','./'.ADMIN_NAME.'/');

$SYS_CONFIG['language'] = empty($SYS_CONFIG['language']) ? 'chinese_gb' : $SYS_CONFIG['language'];
require_once LANG_PATH.$SYS_CONFIG['language'].'/charset.inc.php';

header('Content-Type: text/html; charset='.CHARSET);
if ( file_exists(CACHE_DIR.'install.lock') )
{
	echo "警告!安装功能已被禁止，请删除CMSware系统目录中的'".CACHE_DIR."install.lock'文件和CWPS目录中/tmp/install.lock文件以继续安装.";
	exit();
}
$charset = CHARSET;
new Error();

require_once KDB_DIR.'kDB.php';
$version = 'CMSware 2.8.5 ';

require_once SYS_PATH."license.php";
if (strpos($License['Product-name'],'Plus') !== FALSE) {
	$version = $version . 'Plus ';
} elseif (strpos($License['Product-name'],'Pro') !== FALSE) {
	$version = $version . 'Pro ';
} elseif (strpos($License['Product-name'],'Free') !== FALSE) {
	$version = $version . 'Free ';
} else {
	$version = $version . 'ST ';
}

if(isset($PHP_SELF))
	$_SERVER["PHP_SELF"] = $PHP_SELF;
$info = pathinfo($_SERVER["PHP_SELF"]);
$info["dirname"] = $info["dirname"]=="\\" ? "" : $info["dirname"] ;
if ($info["dirname"]=='/') $info["dirname"]='';

$at_tmp = pathinfo($info["dirname"]);
$at_tmp["dirname"] = $at_tmp["dirname"]=="\\" ? "" : $at_tmp["dirname"] ; 
if ($at_tmp["dirname"]=='/') $at_tmp["dirname"]='';
$cmsware_install_dir = $at_tmp['basename'];
if (empty($cmsware_install_dir)) $cmsware_install_dir='.';

if($_SERVER["SERVER_PORT"] != 80) {
	$CMSWARE_ADMIN_URL = 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$info["dirname"]."/";
	$CMSWARE_ADMIN_HOST = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
	$CMSWARE_PUB_URL = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$at_tmp["dirname"]."/";
} else {
	$CMSWARE_ADMIN_URL = 'http://'.$_SERVER["SERVER_NAME"].$info["dirname"]."/";
	$CMSWARE_ADMIN_HOST = $_SERVER["SERVER_NAME"];
	$CMSWARE_PUB_URL = 'http://'.$_SERVER["SERVER_NAME"].$at_tmp["dirname"]."/";
}
 //$db->setDebug(1);
//from ipb

$IN = parse_incoming();

$TPL = new kTemplate();
$TPL->template_dir = SYS_PATH.'skin/install/';
$TPL->compile_dir = SYS_PATH.'sysdata/templates_c/';
$TPL->cache_dir = SYS_PATH.'sysdata/cache/';
$TPL->assign('version', $version);
//global variable  manipulation END


if($SYS_CONFIG['ftp_mode']===1) {
	$SYS_CONFIG['ftp_cms_admin_path'] = File::_ftp_realpath($SYS_CONFIG['ftp_cms_admin_path'], "../");
}


function dir_writeable($dir) {
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/%%test.test", 'w')) {
			@fclose($fp);
			@unlink("$dir/%%test.test");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}

function is_safe_mode() {
	//return true;
	$dir = "./sysdata/%%install/";
	@mkdir($dir, 0777);

	if(is_dir($dir)) {
		if($fp = @fopen("$dir/%%test.test", 'w')) {
			@fclose($fp);
			@unlink("$dir/%%test.test");
			@rmdir($dir);
			$safe_mode = 0;

		} else {
			$safe_mode = 1;
		}
	} else {
		$safe_mode = 1;
		
	}

	return $safe_mode;

}
function mysql5x_varchar($s) {
	//return "varchar(".(floor($s/2)).")";
	return "varchar(".$s.")";
}
function runquery($sql) {
	global $db,$output,$db_config, $CMSWARE_ADMIN_URL,$CMSWARE_ADMIN_HOST,$CMSWARE_PUB_URL;
	$sql = str_replace("{cmsware_admin}", $CMSWARE_ADMIN_URL, $sql);
	$sql = str_replace("{cmsware_admin_host}", $CMSWARE_ADMIN_HOST, $sql);
	$sql = str_replace("{cmsware_pub}", $CMSWARE_PUB_URL, $sql);
	
	
	// check mysql version first.
	$serverVersion = mysql_get_server_info(); 
	$mysql_version = explode('.', $serverVersion); 
	
	
	//compatible for MySQL 5.x
	if($mysql_version[0] > 4) {
		$sql = str_replace("''", 'NULL', $sql);
		$sql = str_replace("NOT NULL default ''", 'default NULL', $sql);
		$sql = str_replace("NOT NULL", '', $sql);
		//$sql = preg_replace("/varchar\(([0-9]+)\)/ise", "mysql5x_varchar(\\1)", $sql);
		//$sql = str_replace("varchar(250)", 'varchar(500)', $sql);

	}


	if (($mysql_version[0] == 4 && $mysql_version[1] > 0) || $mysql_version[0] > 4)  {
		
		if($db_config['db_charset'] == 'gb2312') $db_config['db_charset'] = 'gbk';  //如果数据库配置为gb2312，自动换成gbk
		
		mysql_query("SET NAMES '".$db_config['db_charset']."' ");	


	}



	$ret = array();
	$num = 0;
	foreach(explode(";\r\n", trim($sql)) as $query) {
		$queries = explode("\r\n", trim($query));
		//print_r($queries);
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == '#' ? NULL : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		//echo $query;
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);

				if (($mysql_version[0] == 4 && $mysql_version[1] > 0) || $mysql_version[0] > 4)  {
					$query .=" DEFAULT CHARSET=".$db_config['db_charset']." ";
				}

				$output.='建立数据表 '.$name.' ... <font color="#0000EE">成功</font><br>';
			}
			$pattern = "/ALTER TABLE[\s]+`([^`]*)`[\s]+(DROP|ADD|CHANGE)[\s]+[^`]+`([^`]*)`/isU";
			preg_match($pattern, $query, $matches);
			/** 
				Array
				(
					[0] => ALTER TABLE `cmsware_collection_category`  ADD COLUMN `IndexNodeID`
					[1] => cmsware_collection_category
					[2] => ADD
					[3] => IndexNodeID
				)

			 */
			//print_r($matches);
			if(!empty($matches[0])) {

				
				$exists = mysql_field_exists($matches[1], $matches[3]);
				//echo "----------".$exists."----------";
				$action = strtoupper($matches[2]);
				if($action == 'ADD' && !$exists){
					$Que = mysql_query($query);
				} elseif($action == 'DROP' && $exists) {
 					$Que = mysql_query($query);
					//echo $query."\n";

				} elseif($action == 'CHANGE' && $exists) {
					$Que = mysql_query($query);
					//echo $query."\n";

				} else continue;
			} else {
				$Que = mysql_query($query);
 			}

			if(!$Que) {
				halt1('MySQL Query Error', $query);
			}

		}
	}
	return $Que;
}

function mysql_field_exists($table, $fieldname)
{
	global $db_config;
 	$fields = mysql_list_fields($db_config['db_name'],$table);
	 
	$columns = mysql_num_fields($fields);
	
	$return = false;
	for ($i = 0; $i < $columns; $i++) {

		$field_name = mysql_field_name($fields, $i);
		if($field_name == $fieldname) 	{
			$return = true;
			break;
		}

	}	
	return $return;
}

function halt1($message = '', $sql = '') {
	$timestamp = time();
	$errmsg = '';

	$dberror = mysql_error();
	$dberrno = mysql_errno();
	if($message) {
		$errmsg = "<b>SYS info</b>: $message\n\n";
	}
	$errmsg .= "<b>Time</b>: ".gmdate("Y-n-j g:ia", $timestamp + ($GLOBALS["timeoffset"] * 3600))."\n";
	$errmsg .= "<b>Script</b>: ".$GLOBALS[PHP_SELF]."\n\n";
	if($sql) {
		$errmsg .= "<b>SQL</b>: ".htmlspecialchars($sql)."\n";
	}
	$errmsg .= "<b>Error</b>:  $dberror\n";
	$errmsg .= "<b>Errno.</b>:  $dberrno";

	echo "</table></table></table></table></table>\n";
	echo "<p style=\"font-family: Verdana, Tahoma; font-size: 11px; background: #FFFFFF;\">";
	echo nl2br($errmsg);

	echo '</p>';
}

$_writeable = true;

function unwriteable($msg)
{	global $_writeable;
	$_writeable = false;
	print("<B>".$msg."</B>  不可写。<br/>");
}

if(!dir_writeable('./sysdata/templates_c')) {
	printf("<b>安装错误：</b>目录./sysdata/templates_c不可写,安装前请设置以下目录为可写：<br>");
	printf("<UL>");
	printf("<LI>./sysdata</li>");	
	printf("<LI>./sysdata/templates_c</li>");	
	printf("<LI>./sysdata/sysinfo</li>");	
	printf("<LI>./sysdata/automini</li>");	
	printf("<LI>./templatesv");	
	printf("<LI>./backup</li>");	
	printf("<LI>./resource</li>");	
	printf("<LI>./www</li>");	
	printf("</UL>");
	exit;
}

if(!is_writeable(ROOT_PATH.'config.php')) {
	die("<b>安装错误：</b>系统配置文件 config.php 不可写");
}

if(!is_writable(ROOT_PATH."setting/cms.ini.php"))  unwriteable("/setting/cms.ini.php");
if(!is_writable(ROOT_PATH."setting/crawler.ini.php")) unwriteable("/setting/crawler.ini.php");
if(!is_writable(ROOT_PATH."backup")) unwriteable("/backup/");
if(!is_writable(ROOT_PATH."resource")) unwriteable("/resource/");
if(!is_writable(ROOT_PATH."sysdata")) unwriteable("/sysdata/");
if(!is_writable(ROOT_PATH."sysdata/automini")) unwriteable("/sysdata/automini/");
if(!is_writable(ROOT_PATH."sysdata/cache")) unwriteable("/sysdata/cache/");
if(!is_writable(ROOT_PATH."sysdata/sysinfo")) unwriteable("/sysdata/sysinfo/");
if(!is_writable(ROOT_PATH."sysdata/templates_c")) unwriteable("/sysdata/templates_c/");
if(!is_writable(ROOT_PATH."sysdata/tmp")) unwriteable("/sysdata/tmp/");
if(!is_writable(ROOT_PATH."publish/tmp") && is_dir(ROOT_PATH."publish/tmp")) unwriteable("/publish/tmp/");

if ( file_exists("../cwps") ) { //如果有../cwps目录就检查一下相关目录是否可写
	if ( !is_writable( "../cwps/config.php" ) )	    unwriteable( "../cwps/config.php" );
	if ( !is_writable( "../cwps/tmp" ) )	    unwriteable( "../cwps/tmp" );
	if ( !is_writable( "../cwps/tmp/templates_c" ) )	    unwriteable( "../cwps/tmp/templates_c" );
	if ( !is_writable( "../cwps/tmp/cache" ) )	    unwriteable( "../cwps/tmp/cache" );
}

if(!$_writeable) die("请设置以上目录/文件为可写。");


//如果是IIS服务器环境，并且检测到demo_iis的模板目录，就提示换成使用iis的模板
if( isset( $_SERVER['SERVER_SOFTWARE'] ) && preg_match("/Microsoft-IIS/i",$_SERVER['SERVER_SOFTWARE']) && is_dir(ROOT_PATH.'templates/demo_iis')){
	die("检测到你的服务器环境是IIS不支持PATHINFO静态化动态URL功能， 请删除或改名现在的{cmsware}templates/demo目录， 然后把{cmsware}templates/demo_iis目录改名为demo， 然后再继续回到这里重新安装");
}

//---------------------------------------------------------
if($IN[o] == 'init') {
	$TPL->display('installshow.html'); 
	exit;
}
if(!isset($IN[step]))
	$IN[step]= 0 ;

switch ($IN[step]) {
	case '0':
		if(is_safe_mode() && !file_exists(CACHE_DIR.".ftp")) {
			$error_msg = <<<EOT
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<title>CMSware 安装向导</title>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<meta http-equiv="Content-Type" content="text/html; charset={$charset}">
<META NAME="Description" CONTENT="">
</HEAD>

<style type="text/css">
td{FONT-FAMILY: "Verdana", "仿宋体";  font-size: 12px} 

tr{FONT-FAMILY: "Verdana", "仿宋体"; font-size: 12px} 



.button{
	height:18;
	background-color:#FFFFFF;
	border: 1 solid #CCCCCC;
	font-family:"sans-serif";
	font-size: 12px;
}
.fixline {
	border: 1px dotted #999999;
}
.subbutton {
	font-family: "Arial", "Helvetica", "sans-serif";
	font-size: 12px;
	background-color: #C6D8F0;
	border-top-width: 1.5px;
	border-right-width: 1.5px;
	border-bottom-width: 1.5px;
	border-left-width: 1.5px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #FFFFFF;
	height: 22px;
	padding-top: 3px;
	width: 66px;
}

a {FONT-FAMILY: "Verdana", "宋体"; TEXT-DECORATION: none;FONT-SIZE: 12px; color: #000000} 

a:hover {COLOR: #000000; TEXT-DECORATION: underline;FONT-SIZE:12px;} 
#description { font-family:  "sans-serif";color:#000000; font-size:12px }
</style>
<script type="text/javascript" src="html/images/helptip.js"></script>
<link type="text/css" rel="StyleSheet" href="html/images/helptip.css" />
<script  type="text/javascript" language="javascript" src="html/title_fade.js"></script>
<script src="html/functions.js" type="text/javascript" language="javascript"></script>
<body bgcolor="" TOPMARGIN="0" LEFTMARGIN="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80%" height="70" bgcolor="#2D66B5"><img src="html/images/install.gif" ></td>
    <td><table width="100%" height="70" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#2E68B8">&nbsp;</td>
          <td bgcolor="#4D86D2">&nbsp;</td>
          <td bgcolor="#739FDB">&nbsp;</td>
          <td bgcolor="#9ABAE4">&nbsp;</td>
          <td bgcolor="#C6D8F0">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40">
	</td>
  </tr>
</table>
<table width="80%" border="0" align="center" cellpadding="8" cellspacing="0" class="fixline">
   <form action="?step=ftp_mode" method="post">
 <tr> 
    <td>
	<H2><FONT COLOR="#FF0000">警告！你的系统运行在安全限制模式。</FONT><A HREF="?step=phpinfo" target="_blank">&lt;?PHP信息查看?&gt;</A></H2>
	<p><B>安全限制模式</B> 并不一定和服务器php配置文件php.ini的safe_mode=on有关.<br>主要原因可能是Apache的运行User/Group和你FTP上传的文件的User/Group不符合,导致php创建的目录php本身无法具备写权限.<br>（比如Apache运行的User和Group为nobody,而你用ftp上传的文件的User/Group可能是ftpusername,就可能导致此问题.请使用chown命令将上传的php文件设置为nobody的用户和组）,如下命令:<ul><li>  chown -R nobody:nobody    &nbsp;[你的cmsware目录] </li></ul>如果你使用的是php运行环境限制比较多的虚拟主机，可能无法使用chown命令，这时候需要使用CMSware的FTP模式来运行 ,如果你的空间支持FTP模块，请按下列提示设置你的ftp帐号，即可正常使用CMSware.</p>

	 <p><strong>CMS管理目录相对FTP根目录的路径: </strong>这个的设置要特别注意,不然会导致无法使用CMSware,看准了是CMSware管理目录,也就是admin目录相对FTP根目录的路径。<br/><br/>比如你登陆ftp后显示的目录结构如下 <br/><strong>/cgi-bin </strong><br/><strong>/other </strong><br/><strong>/www </strong><br/>你的CMSware管理目录位于 <strong>/www/cms/admin </strong><br/>则设置你的CMS管理目录相对FTP根目录的路径为 <strong>/www/cms/admin </strong> </p>
	<!--{{{ FTP Setting -->
	 <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="center" bgcolor="#ececec"> <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#2E68B8">
                <tr> 
                  <td colspan="2" bgcolor="#2E68B8" ><font color="#FFFFFF">&nbsp;<B>FTP帐号设置</B>（你的系统运行在安全限制模式，建议改用FTP模式运行CMSware）：</font></td>
                </tr>
                <tr> 
                  <td bgcolor="#ececec" width="28%">FTP服务器地址:</td>
                  <td bgcolor="#ececec"><input name="ftp_host" type="text" class="button" id="ftp_host" value="{$_SERVER["HTTP_HOST"]}">&nbsp;&nbsp;端口号:<input name="ftp_port" type="text" class="button" id="ftp_port" value="21" size=6></td>
                 </tr>
                <tr> 
                  <td bgcolor="#ececec">FTP用户名:</td>
                  <td bgcolor="#ececec"><input name="ftp_username" type="text" class="button" id="ftp_username" value=""></td>
                 </tr>
                <tr> 
                  <td bgcolor="#ececec">FTP密码:</td>
                  <td bgcolor="#ececec"><input name="ftp_password" type="password" class="button" id="ftp_password" value=""></td>
                 </tr>
                <tr> 
                  <td bgcolor="#ececec"> CMS管理目录相对FTP根目录的路径:</td>
                  <td bgcolor="#ececec"><input name="ftp_cms_admin_path" type="text" class="button" id="ftp_cms_admin_path" value="">
                   </td>
                 </tr>
               
              </table></td>
          </tr>
        </table>
	 <!--FTP Setting }}}-->
 </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"  > 
       
      <input name="Submit" type="submit" class="subbutton" value=" 继 续 " >
    </td>
	
  </tr>
 </form>
	  </table>
</body>
</html>
EOT;
			 echo $error_msg;
		} else {
		$TPL->display('install.html');
		
		}
	//default:
		break;
	case 'phpinfo':
		phpinfo();
		break;
	case 'ftp_mode':
		if($config_handle = fopen('./install/config.ini','r')) {//生成config.php
			$config_php = fread ($config_handle, filesize ('./install/config.ini'));
			$config_php = str_replace('[ftp_mode]', 1, $config_php);
			$config_php = str_replace('[ftp_host]', $IN['ftp_host'], $config_php);
			$config_php = str_replace('[ftp_port]', $IN['ftp_port'], $config_php);
			$config_php = str_replace('[ftp_username]', $IN['ftp_username'],$config_php);
			$config_php = str_replace('[ftp_password]', $IN['ftp_password'],$config_php);
			$config_php = str_replace('[ftp_cms_admin_path]', $IN['ftp_cms_admin_path'],$config_php);
 
 			$config_php = str_replace('[cmsware_db_host]', $db_config['db_host'], $config_php);
			$config_php = str_replace('[cmsware_db_user]', $db_config['db_user'],$config_php);
			$config_php = str_replace('[cmsware_db_password]', $db_config['db_password'],$config_php);
			$config_php = str_replace('[cmsware_db_name]', $db_config['db_name'],$config_php);
			$config_php = str_replace('[cmsware_db_table_pre]', $db_config['table_pre'],$config_php);
			$config_php = str_replace('[cmsware_db_charset]', $db_config['db_charset'],$config_php);

			$enable_validcode = extension_loaded('gd') ? 1 : 0;
			$config_php = str_replace('[enable_validcode]', $enable_validcode,$config_php);

			$handle = fopen('config.php','w');
			@flock($handle,3);  
			fwrite($handle,$config_php);
			fclose($handle);
			
			$handle = fopen(CACHE_DIR.'.ftp','w');
			@flock($handle,3);  
			fwrite($handle,'1');
			fclose($handle);


		} else {
			die("Unable to read ./install/config.ini");
		}
		header("Location: install.php ");
		break;
	case '1':
 			
			$operation="<td bgcolor=\"#ececec\">".PHP_OS."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>√</FONT></td>";
			$webserver="<td bgcolor=\"#ececec\">".$_SERVER['SERVER_SOFTWARE']."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>√</FONT></td>";
			$php="<td bgcolor=\"#ececec\">".phpversion()."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>√</FONT></td>";
			
			if (extension_loaded('ftp')) {
				$ftp = "<td bgcolor=\"#ececec\">PHP FTP module</td><td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>√</FONT></td>";
			} else
				$ftp = "<td bgcolor=\"#ececec\"></td><td bgcolor=\"#ececec\"><FONT  COLOR=#FF0000>×</FONT></td>";

			if (extension_loaded('gd')) {
				if(function_exists('gd_info'))	$gd_info = gd_info();
				$gd = "<td bgcolor=\"#ececec\">".$gd_info["GD Version"]."</td><td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>√</FONT></td>";
			} else
				$gd = "<td bgcolor=\"#ececec\">".$gd_info["GD Version"]."</td><td bgcolor=\"#ececec\"><FONT  COLOR=#FF0000>×</FONT></td>";

 
			

 
			

			if(@ini_get(file_uploads)) {
				$max_size = @ini_get(upload_max_filesize);
				$upload="<td bgcolor=\"#ececec\">最大允许 ".$max_size."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>√</FONT></td>";
			} else {
				$upload="<td bgcolor=\"#ececec\">不允许上传附件</td>
						<td bgcolor=\"#ececec\"><font color=red><FONT  COLOR=#FF0000>×</FONT></font></td>";
				
			}

			if(is_writable('config.php')) {
				$config_writable = 1 ;
			} else {
				$config_writable = 0 ;
				
			}
			$TPL->assign('operation',$operation);
			$TPL->assign('webserver',$webserver);
			$TPL->assign('php',$php);
			$TPL->assign('mysql',$mysql);
			$TPL->assign('zend',$zend);
			$TPL->assign('gd',$gd);
			$TPL->assign('ftp',$ftp);
			$TPL->assign('save_path',$save_path);
			$TPL->assign('safe_mode', $safe_mode);
			
			$TPL->assign('templatespath',$templatespath);
			$TPL->assign('Resourcepath',$Resourcepath);
			$TPL->assign('smartypath',$TPLpath);
			$TPL->assign('backuppath',$backuppath);
			$TPL->assign('installpath',$installpath);

			$TPL->assign('upload',$upload);
			
			$TPL->display('install1.html');
			break;
 	case 'installtype':  //选择安装类型
  			$TPL->display('install_type.html');
			break;
 	case '2':  //填写数据库参数
 			$TPL->assign('installType',$IN['installType']);
 			$TPL->assign('installCWPS',$IN['installCWPS']);
			$TPL->assign('db_host',$db_config[db_host]);
			$TPL->assign('db_user',$db_config[db_user]);
			$TPL->assign('db_password',$db_config[db_password]);
			$TPL->assign('db_name',$db_config[db_name]);
			$TPL->assign('db_charset',$db_config[db_charset]); //add by easyt
			$TPL->assign('sys_language',$SYS_CONFIG['language']); //add by easyt
			$TPL->assign('table_header',$db_config[table_pre]);
			$TPL->display('install2.html');
			break;

 	case '3': //建立数据库，创建配置文件

 			$TPL->assign('installType',$IN['installType']);
 			$TPL->assign('installCWPS',$IN['installCWPS']);
			$db = new kDB($db_config['db_driver']);
			$db_config['db_driver']   = 'db';	//db,adodb,mdb
			$db_config['db_type']     = 'mysql';
			$db_config['db_host']     = $IN[database_host];	
			$db_config['db_user']     = $IN[database_user];	
			$db_config['db_password'] = $IN[database_password];	
			$db_config['db_name']     = $IN[database_name];	
			$db_config['table_pre']     = $IN[database_header];
			$db_config['db_charset']     = $db_config['db_charset'];
			$db_config['table_content_pre']     = 'content';	
			$db_config['table_contribution_pre']     = 'contribution';	
			$db_config['table_collection_pre']     = 'collection';	
			$server_host = $_SERVER["HTTP_HOST"];
			
			if($IN['installType'] == 'typical') {
				if( isset( $_SERVER['SERVER_SOFTWARE'] ) && preg_match("/Microsoft-IIS/i",$_SERVER['SERVER_SOFTWARE']) && file_exists(SYS_PATH.'install/typical_install_iis.sql')){
					$sql_file = "./install/typical_install_iis.sql";	//如果是IIS服务器环境，就换成使用iis的sql脚本
				} else {
					$sql_file = "./install/typical_install.sql";
				}
			} else {
				$sql_file = "./install/base.sql";
		
			}

			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {

				if(mysql_select_db($db_config['db_name'])) {
					if($sql_handle = fopen($sql_file,'r')) { //读取SQL，预备执行sql
						$table_header = $db_config['table_pre'];
						
						$sql_query = fread ($sql_handle, filesize ($sql_file));
						fclose ($sql_handle);
						//eval ("\$sql_query = \"$sql_query\";");
 						$sql_query = str_replace('{$table_header}', $table_header, $sql_query);

						//echo $sql_query;exit;					
					} else  {
						
						die("Unable to read  $sql_file ");
					}
					
					if(!$IN['overwrite'] == 1) {
						$sysExit = false;	
						$sql = "SHOW TABLES  FROM {$IN[database_name]}";
						$recordSet= mysql_query($sql);
						$pattern="/^{$IN[database_header]}.+/is";
						if($recordSet) {
							while($row = mysql_fetch_array($recordSet, MYSQL_BOTH)) {
								if(preg_match($pattern, $row[0])) {
									$sysExit=true;	
									break;
								}
							}						
						}

						if($sysExit){
							echo "<script>\n if(confirm(\" 系统检测到你已经安装了CMSware,\\n继续安装将覆盖掉已安装的内容(包括CMSware和CWPS)，是否继续? \")){window.location=\"install.php?overwrite=1&step=3&database_host={$IN[database_host]}&database_name={$IN[database_name]}&database_header={$IN[database_header]}&database_user={$IN[database_user]}&database_password={$IN[database_password]}&installType={$IN[installType]}&installCWPS={$IN[installCWPS]}\";
								}else {
									history.go(-1);
								}</script>\n";
							exit;
						}
					
					}


					if(runquery($sql_query)){
						if($config_handle = fopen('./install/config.ini','r')) {//生成config.php
							$config_php = fread ($config_handle, filesize('./install/config.ini'));
							$config_php = str_replace('[cmsware_db_host]', $db_config['db_host'], $config_php);
							$config_php = str_replace('[cmsware_db_user]', $db_config['db_user'],$config_php);
							$config_php = str_replace('[cmsware_db_password]', $db_config['db_password'],$config_php);
							$config_php = str_replace('[cmsware_db_name]', $db_config['db_name'],$config_php);
							$config_php = str_replace('[cmsware_db_table_pre]', $db_config['table_pre'],$config_php);
							$config_php = str_replace('[cmsware_db_charset]', $db_config['db_charset'],$config_php);

							$config_php = str_replace('[ftp_mode]', $SYS_CONFIG['ftp_mode'], $config_php);
							$config_php = str_replace('[ftp_host]', $SYS_CONFIG['ftp_host'], $config_php);
							$config_php = str_replace('[ftp_port]', $SYS_CONFIG['ftp_port'], $config_php);
							$config_php = str_replace('[ftp_username]', $SYS_CONFIG['ftp_username'],$config_php);
							$config_php = str_replace('[ftp_password]', $SYS_CONFIG['ftp_password'],$config_php);
							$config_php = str_replace('[ftp_cms_admin_path]', $SYS_CONFIG['ftp_cms_admin_path'],$config_php);
							
							$enable_validcode = extension_loaded('gd') ? 1 : 0;
							$config_php = str_replace('[enable_validcode]', $enable_validcode,$config_php);


							$handle = fopen('config.php','w');
							@flock($handle,3);  
							fwrite($handle,$config_php);
							fclose($handle);
						} else {
							die("Unable to read ./install/config.ini");
						}
						
						if ($IN['installCWPS']=="1") { //如果选择了同时安装CWPS 就进行安装
							$cwps_install_sql_file = "../cwps/install/base.sql"; //安装CWPS
							if ( $sql_query_handle = fopen( $cwps_install_sql_file,'r' ) )
							{
								$sql_query = fread($sql_query_handle, filesize($cwps_install_sql_file));
								$sql_query = str_replace( "{\$table_header}", $db_config['table_pre']."cwps_", $sql_query );
								$sql_query = str_replace( "{CWPSPassword}", md5( $_SERVER['REMOTE_ADDR'].date( "Y-m-d" ) ), $sql_query );
								$sql_query = str_replace( "{ServerIP}", $_SERVER['SERVER_ADDR'] , $sql_query );
								if ( runquery( $sql_query ) && ( $config_handle = fopen("../cwps/install/config.ini",'r') ) )
								{
									$config_php = fread($config_handle, filesize('../cwps/install/config.ini'));
									$config_php = str_replace( "[cmsware_db_host]", $db_config['db_host'], $config_php );
									$config_php = str_replace( "[cmsware_db_user]", $db_config['db_user'], $config_php );
									$config_php = str_replace( "[cmsware_db_password]", $db_config['db_password'], $config_php );
									$config_php = str_replace( "[cmsware_db_name]", $db_config['db_name'], $config_php );
									$config_php = str_replace( "[cmsware_db_table_pre]", $db_config['table_pre']."cwps_", $config_php );
									$config_php = str_replace( "[cmsware_db_charset]", $db_config['db_charset'], $config_php );
									$enable_validcode = extension_loaded( "gd" ) ? 1 : 0;
									$config_php = str_replace( "[enable_validcode]", $enable_validcode, $config_php );
									$config_php = str_replace( "[sys_url]", $CMSWARE_PUB_URL."cwps", $config_php );
									$config_php = str_replace( "[html_url]", $CMSWARE_PUB_URL."cwps/html", $config_php );
									$config_php = str_replace( "[base_dir]", str_replace( "\\", "\\\\", realpath( "../cwps/" ) ), $config_php );
									$handle = fopen('../cwps/config.php','w');
									@flock($handle,3);  
									fwrite($handle,$config_php);
									fclose($handle);
									$handle = fopen('../cwps/tmp/install.lock','w');
									@flock($handle,3);  
									fwrite($handle,'Install locked!');
									fclose($handle);
								}
							}
							else
							{
								exit( "Unable to read  {$cwps_install_sql_file} " );
							}
						}

						
						$TPL->assign('output',$output);
						$TPL->display('install3.html');
					}else {
						$TPL->assign('errmsg','错误！数据表建立失败');
						$TPL->display('installmsg.html');
					}				
				} elseif($IN[autoCreateDB] == '1') {
					if(mysql_query("CREATE  DATABASE `".$db_config['db_name']."`")) {
						$output.='自动创建数据库 <b>'.$db_config['db_name'].'</b> ... <font color="#0000EE">成功 </font><br>';
						if(mysql_select_db($db_config['db_name'])) {
						
							//**************************************************
							if($sql_handle = fopen($sql_file,'r')) { //读取SQL，预备执行sql
								$table_header = $db_config['table_pre'];
								$sql_query = fread ($sql_handle, filesize ($sql_file));
								fclose ($sql_handle);
							//	eval ("\$sql_query = \"$sql_query\";");
 								$sql_query = str_replace('{$table_header}', $table_header, $sql_query);

								//echo $sql_query;exit;					
							} else  {
								
								die("Unable to read $sql_file ");
							}




							if($output.=runquery($sql_query)){
								if($config_handle = fopen('./install/config.ini','r')) {//生成config.php
									$config_php = fread ($config_handle, filesize ('./install/config.ini'));
									$config_php = str_replace('[cmsware_db_host]', $db_config['db_host'], $config_php);
									$config_php = str_replace('[cmsware_db_user]', $db_config['db_user'],$config_php);
									$config_php = str_replace('[cmsware_db_password]', $db_config['db_password'],$config_php);
									$config_php = str_replace('[cmsware_db_name]', $db_config['db_name'],$config_php);
									$config_php = str_replace('[cmsware_db_table_pre]', $db_config['table_pre'],$config_php);
									$config_php = str_replace('[cmsware_db_charset]', $db_config['db_charset'],$config_php);

									$config_php = str_replace('[ftp_mode]', $SYS_CONFIG['ftp_mode'], $config_php);
									$config_php = str_replace('[ftp_host]', $SYS_CONFIG['ftp_host'], $config_php);
									$config_php = str_replace('[ftp_port]', $SYS_CONFIG['ftp_port'], $config_php);
									$config_php = str_replace('[ftp_username]', $SYS_CONFIG['ftp_username'],$config_php);
									$config_php = str_replace('[ftp_password]', $SYS_CONFIG['ftp_password'],$config_php);
									$config_php = str_replace('[ftp_cms_admin_path]', $SYS_CONFIG['ftp_cms_admin_path'],$config_php);

									$enable_validcode = extension_loaded('gd') ? 1 : 0;
									$config_php = str_replace('[enable_validcode]', $enable_validcode,$config_php);

									$handle = fopen('config.php','w');
									@flock($handle,3);  
									fwrite($handle,$config_php);
									fclose($handle);							
								} else {
									die("Unable to read ./install/config.ini");
								}
								if ($IN['installCWPS']=="1") { //如果选择了同时安装CWPS 就进行安装
									$cwps_install_sql_file = "../cwps/install/base.sql"; //安装CWPS
									if ( $sql_query_handle = fopen( $cwps_install_sql_file,'r' ) )
									{
										$sql_query = fread($sql_query_handle, filesize($cwps_install_sql_file));
										$sql_query = str_replace( "{\$table_header}", $db_config['table_pre']."cwps_", $sql_query );
										$sql_query = str_replace( "{CWPSPassword}", md5( $_SERVER['REMOTE_ADDR'].date( "Y-m-d" ) ), $sql_query );
										$sql_query = str_replace( "{ServerIP}", $_SERVER['SERVER_ADDR'] , $sql_query );
										if ( runquery( $sql_query ) && ( $config_handle = fopen("../cwps/install/config.ini",'r') ) )
										{
											$config_php = fread($config_handle, filesize('../cwps/install/config.ini'));
											$config_php = str_replace( "[cmsware_db_host]", $db_config['db_host'], $config_php );
											$config_php = str_replace( "[cmsware_db_user]", $db_config['db_user'], $config_php );
											$config_php = str_replace( "[cmsware_db_password]", $db_config['db_password'], $config_php );
											$config_php = str_replace( "[cmsware_db_name]", $db_config['db_name'], $config_php );
											$config_php = str_replace( "[cmsware_db_table_pre]", $db_config['table_pre']."cwps_", $config_php );
											$config_php = str_replace( "[cmsware_db_charset]", $db_config['db_charset'], $config_php );
											$enable_validcode = extension_loaded( "gd" ) ? 1 : 0;
											$config_php = str_replace( "[enable_validcode]", $enable_validcode, $config_php );
											$config_php = str_replace( "[sys_url]", $CMSWARE_PUB_URL."cwps", $config_php );
											$config_php = str_replace( "[html_url]", $CMSWARE_PUB_URL."cwps/html", $config_php );
											$config_php = str_replace( "[base_dir]", str_replace( "\\", "\\\\", realpath( "../cwps/" ) ), $config_php );
											$handle = fopen('../cwps/config.php','w');
											@flock($handle,3);  
											fwrite($handle,$config_php);
											fclose($handle);
										}
									}
									else
									{
										exit( "Unable to read  {$cwps_install_sql_file} " );
									}
								}

								$TPL->assign('output',$output);
								$TPL->display('install3.html');
							}else {
								$TPL->assign('errmsg','错误！数据表建立失败');
								$TPL->display('installmsg.html');
							}	
							//**************************************************
						}
					
					} else {

						$TPL->assign('errmsg',"Create Database <b>{$new_db_name}</b> Failed! May be Your MySQL account have not the Create Database privilege,please contact to your administrator<br>无法创建数据库 <b>{$new_db_name}</b>,可能你的MySQL账号没有创建数据库的权限，请联系管理员！ ");
						$TPL->display('installmsg.html');

					}

					
				
				} else {
					$TPL->assign('errmsg',"错误！无法连接数据库{$db_config['db_name']},请返回重新设置你的数据库连接参数");
					$TPL->display('installmsg.html');
					exit;	
				}		
			}
 		break;
			

	case '4'://建立管理员
 			$TPL->assign('installType',$IN['installType']);
 			$TPL->assign('installCWPS',$IN['installCWPS']);
			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {
			mysql_query("SET NAMES '".$db_config['db_charset']."' ");
				if(mysql_select_db($db_config['db_name'])) {
					$user_pass=md5($IN[password]);
					$sql="INSERT INTO {$db_config['table_pre']}user VALUES (NULL, 1, '{$IN[root]}', '{$user_pass}', '{$IN[root]}', 0, 0, 0, 0, 0, 0);\r\n";
					$sqlcwpsok = false;
					if ($IN['installCWPS']=="1") { //如果选择了同时安装CWPS 就进行同时创建cwps管理员
						$sqlcwps = "INSERT INTO {$db_config['table_pre']}cwps_user VALUES ('1', 2, '{$IN[root]}', '{$user_pass}', '', '', 'admin@admin.com', '{$IN[root]}', 0, '0000-00-00', '', '', 1, ".time( ).", NULL, ',,', 6, ',,', ',,');\r\n";
						$sqlcwps2 ="INSERT INTO {$db_config['table_pre']}cwps_user_extra values(1,'-','0');\r\n";
						if (mysql_query($sqlcwps) and mysql_query($sqlcwps2)) { 
							$sqlcwpsok = true; //CWPS管理员创建成功
						}
					}

					if(mysql_query($sql) and $sqlcwpsok) {
						//修改CMSwareOAS插件的设置值
						$sqlcwps = "UPDATE `{$db_config['table_pre']}plugin_oas_setting` SET `value`='{$CMSWARE_PUB_URL}cwps/soap.php' WHERE `key`='CWPS_Address';";
						mysql_query($sqlcwps);
						$sqlcwps = "UPDATE `{$db_config['table_pre']}plugin_oas_setting` SET `value`='".md5($_SERVER['REMOTE_ADDR'].date( "Y-m-d" ))."' WHERE `key`='CWPS_TransactionAccessKey';";
						mysql_query($sqlcwps);
						$sqlcwps = "UPDATE `{$db_config['table_pre']}plugin_oas_setting` SET `value`='{$CMSWARE_PUB_URL}cwps' WHERE `key`='CWPS_RootURL';";
						mysql_query($sqlcwps);
						$sqlcwps = "UPDATE `{$db_config['table_pre']}plugin_oas_setting` SET `value`='{$CMSWARE_ADMIN_URL}oas' WHERE `key`='OAS_RootURL';";
						mysql_query($sqlcwps);
						$sqlcwps = "UPDATE `{$db_config['table_pre']}plugin_oas_setting` SET `value`='{$IN[root]}' WHERE `key`='CWPS_AdminUserName';";
						mysql_query($sqlcwps);
						$sqlcwps = "UPDATE `{$db_config['table_pre']}plugin_oas_setting` SET `value`='{$IN[password]}' WHERE `key`='CWPS_AdminPassword';";
						mysql_query($sqlcwps);

						$TPL->assign('URL', substr($CMSWARE_PUB_URL,0,-1));
						$TPL->assign('output','管理员建立成功！');
						$TPL->display('install4.html');
					}else {
						$TPL->assign('errmsg','管理员建立失败'.mysql_error());
						$TPL->display('installmsg.html');
					}				
				}

			
			} 
 		break;

	case '5'://建立psn
			$TPL->assign('installType',$IN['installType']);
 			$TPL->assign('installCWPS',$IN['installCWPS']);
 			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {
			mysql_query("SET NAMES '".$db_config['db_charset']."' ");
				if(mysql_select_db($db_config['db_name'])) {
					$sql="INSERT INTO {$db_config['table_pre']}psn VALUES (NULL, '{$IN[Name]}', 'relate::{$IN[PATH]}', '{$IN[URL]}', ' ',' ');";				

					if(mysql_query($sql)) {
						$sql = "INSERT INTO `{$db_config['table_pre']}tpl_vars` VALUES (1, '前台动态程序URL', 'PUBLISH_URL', '{$CMSWARE_PUB_URL}publish/', 1, '');";
						mysql_query($sql);
						$sql = "INSERT INTO `{$db_config['table_pre']}tpl_vars` VALUES (2, 'PublishAPI接口URL', 'PUBLISHAPI_URL', '{$CMSWARE_PUB_URL}publishapi/', 1, NULL);";
						mysql_query($sql);
						$sql = "INSERT INTO `{$db_config['table_pre']}tpl_vars` VALUES (3, '网站名称', 'SITE_NAME', '{$IN[Name]}', 1, NULL);";
						mysql_query($sql);
						$sql = "INSERT INTO `{$db_config['table_pre']}tpl_vars` VALUES (4, '网站首页URL', 'SITE_URL', '{$CMSWARE_PUB_URL}', 1, '');";
						mysql_query($sql);
						$sql = "INSERT INTO `{$db_config['table_pre']}tpl_vars` VALUES (5, '模板资源URL', 'SKIN_URL', '{$CMSWARE_PUB_URL}skin/', 1, NULL);";
						mysql_query($sql);
						$sql = "INSERT INTO `{$db_config['table_pre']}tpl_vars` VALUES (6, 'OAS的URL', 'OAS_URL', '{$CMSWARE_PUB_URL}oas/', 1, '');";
						mysql_query($sql);
					
						if($config_handle = fopen('./install/publish.config.ini','r')) { //生成publish配置
							$config_php = fread ($config_handle, filesize ('./install/publish.config.ini'));
							$config_php = str_replace('[cmsware_publish_root_path]','../'.$cmsware_install_dir.'/', $config_php);
							$handle = fopen('../publish/config.php','w');
							@flock($handle,3);  
							fwrite($handle,$config_php);
							fclose($handle);							
						} else {
							die("Unable to read ./install/publish.config.ini");
						}
						
						if($config_handle = fopen('./install/publishapi.config.ini','r')) {	//生成publishapi配置
							$config_php = fread ($config_handle, filesize ('./install/publishapi.config.ini'));
							$config_php = str_replace('[cmsware_publishapi_root_path]','../'.$cmsware_install_dir.'/', $config_php);
							$config_php = str_replace('[cmsware_publishapi_name]',$IN[Name], $config_php);
							$handle = fopen('../publishapi/config.ini.php','w');
							@flock($handle,3);  
							fwrite($handle,$config_php);
							fclose($handle);							
						} else {
							die("Unable to read ./install/publishapi.config.ini");
						}
						$oas_main_domain = '';
						
						$TPL->assign('oas_cwps_url',$CMSWARE_PUB_URL.'cwps/');
						$TPL->assign('oas_oas_url',$CMSWARE_PUB_URL.'oas/');
						$TPL->assign('oas_oasid','22');
						$TPL->assign('oas_transactionaccessKey',md5( $_SERVER['REMOTE_ADDR'].date( "Y-m-d" ) ));
						$TPL->assign('oas_main_domain',$oas_main_domain);
						$TPL->assign('output','网站发布PSN建立成功！');
						$TPL->display('install5.html');	

					}else {
						$TPL->assign('errmsg','网站发布PSN建立失败'.mysql_error());
						$TPL->display('installmsg.html');
					}				
				}

			
			}
 		break;

	case '6'://建立OAS配置
		$TPL->assign('installType',$IN['installType']);
		$TPL->assign('installCWPS',$IN['installCWPS']);
		if($config_handle = fopen('./install/oas.config.ini','r')) { //生成oas配置
		
			$config_php = fread ($config_handle, filesize ('./install/oas.config.ini'));
			
			$config_php = str_replace('[oas_cwps_url]', $IN['oas_cwps_url'], $config_php);
			$config_php = str_replace('[oas_oas_url]', $IN['oas_oas_url'], $config_php);
			$config_php = str_replace('[oas_oasid]', $IN['oas_oasid'], $config_php);
			$config_php = str_replace('[oas_charset]', $db_config['db_charset'], $config_php);
			$config_php = str_replace('[oas_transactionaccessKey]', $IN['oas_transactionaccessKey'], $config_php);
			$config_php = str_replace('[oas_main_domain]', $IN['oas_main_domain'], $config_php);
			
			$handle = fopen('../oas/oas.config.php','w');
			@flock($handle,3);  
			fwrite($handle,$config_php);
			fclose($handle);							
		} else {
			die("Unable to read ./install/oas.config.ini");
		}
		
		if($IN['installType'] == 'typical') {					 

			if(file_exists(CACHE_DIR."Cache_SYS_ENV.php")) unlink(CACHE_DIR.'Cache_SYS_ENV.php');
			if(file_exists(CACHE_DIR."Cache_PSN.php")) unlink(CACHE_DIR.'Cache_PSN.php');
			if(file_exists(CACHE_DIR."Cache_CateList.php")) unlink(CACHE_DIR.'Cache_CateList.php');
			if(file_exists(CACHE_DIR.".ftp")) unlink(CACHE_DIR.".ftp");
			$TPL->assign('output',"<font color=red>恭喜</font>，思维系统安装完毕！<br /><br />如果你安装了CWPS，请进入CWPS后台({$CMSWARE_PUB_URL}cwps/index.php)设置相应oas的IP等设置");
			$TPL->display('install_end.html');
	
		} else {
			$TPL->assign('output','OAS配置成功！');
			$TPL->display('install6.html');						
		}
		
		break;


	case '7':  //建立内容模型,建立全文检索插件
 			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {
				if(mysql_select_db($db_config['db_name'])) {
					if($IN[Model_News] == '1') {//安装新闻模型
						if($sql_handle = fopen('./install/model_news.sql','r')) { 
							$table_header = $db_config['table_pre'];
							$sql_query = fread ($sql_handle, filesize ('./install/model_news.sql'));
							fclose ($sql_handle);
							//eval ("\$sql_query = \"$sql_query\";");				
 							$sql_query = str_replace('{$table_header}', $table_header, $sql_query);
						} else						
							die("Unable to read ./install/model_news.sql");


						if($output.=runquery($sql_query))
							$output.="创建新闻系统模型... <font color=#0000EE>成功</font><br>";
					}

					if($IN[Model_Download] == '1') {//安装下载模型
						if($sql_handle = fopen('./install/model_download.sql','r')) { 
							$table_header = $db_config['table_pre'];
							$sql_query = fread ($sql_handle, filesize ('./install/model_download.sql'));
							fclose ($sql_handle);
							//eval ("\$sql_query = \"$sql_query\";");				
	 						$sql_query = str_replace('{$table_header}', $table_header, $sql_query);
						} else						
							die("Unable to read ./install/model_download.sql");


						if($output.=runquery($sql_query))
							$output.="创建下载系统模型... <font color=#0000EE>成功</font><br>";
					}
					if($IN[Plugin_bbsInterface] == '1') {//安装会员接口插件
						if($sql_handle = fopen('./install/plugin_bbsi.sql','r')) { 
							$table_header = $db_config['table_pre'];
							$sql_query = fread ($sql_handle, filesize ('./install/plugin_bbsi.sql'));
							fclose ($sql_handle);
							//eval ("\$sql_query = \"$sql_query\";");				
 							$sql_query = str_replace('{$table_header}', $table_header, $sql_query);
						} else						
							die("Unable to read ./install/plugin_bbsi.sql");


						if($output.=runquery($sql_query))
							$output.="添加会员接口插件... <font color=#0000EE>成功</font><br>";
					}

					if($IN[Plugin_FullText] == '1') {//安装全文检索插件
						if($sql_handle = fopen('./install/plugin_fulltext.sql','r')) { 
							$table_header = $db_config['table_pre'];
							$sql_query = fread ($sql_handle, filesize ('./install/plugin_fulltext.sql'));
							fclose ($sql_handle);
							//eval ("\$sql_query = \"$sql_query\";");				
	 						$sql_query = str_replace('{$table_header}', $table_header, $sql_query);
						} else						
							die("Unable to read ./install/plugin_fulltext.sql");


						if($output.=runquery($sql_query))
							$output.="添加全文检索插件... <font color=#0000EE>成功</font><br>";
					}

					$TPL->assign('output',$output);
					$TPL->display('install7.html');
					
		
				
				} else
					die("无法选择表");


			
			} else
				die("无法连接数据库");


	
 		break;


	case '8'://建立采集分类
 			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {
				if(mysql_select_db($db_config['db_name'])) {
					if($IN[Collection] == '1') {
						if($sql_handle = fopen('./install/collection.sql','r')) { 
							$table_header = $db_config['table_pre'];
							$sql_query = fread ($sql_handle, filesize ('./install/collection.sql'));
							fclose ($sql_handle);
							$sql_query = str_replace('{$table_header}',$table_header, $sql_query );				
						} else						
							die("Unable to read ./install/collection.sql");


						if($output=runquery($sql_query))
							$output="创建采集演示分类... <font color=#0000EE>成功</font><br>";
					
					}


					$TPL->assign('output',$output);
					$TPL->display('install8.html');
					
		
				
				} else
					die("无法选择表");


			
			} else
				die("无法连接数据库");


	
 		break;
		
		
	case '9'://完成安装
		
		if(file_exists(CACHE_DIR."Cache_SYS_ENV.php")) unlink(CACHE_DIR.'Cache_SYS_ENV.php');
		if(file_exists(CACHE_DIR."Cache_PSN.php")) unlink(CACHE_DIR.'Cache_PSN.php');
		if(file_exists(CACHE_DIR."Cache_CateList.php")) unlink(CACHE_DIR.'Cache_CateList.php');
		if(file_exists(CACHE_DIR.".ftp")) unlink(CACHE_DIR.".ftp");
		$TPL->assign('output',"<font color=red>恭喜</font>，思维CMSware系统安装完毕！<br /><br />如果你安装了CWPS，请进入CWPS后台设置相应cmswareoas的IP");
		$TPL->display('install_end.html');

		break;

		
	case "end":
		if(!empty($IN['delInstaller'])) {
			if(file_exists(SYS_PATH."install.php")) unlink(SYS_PATH."install.php");
			if(file_exists(SYS_PATH."update.php"))  unlink(SYS_PATH."update.php");
		}

			//写cmsware安装锁定文件install.lock
			$handle = fopen('./sysdata/install.lock','w');
			@flock($handle,3);  
			fwrite($handle,'lock the cmsware installer');
			fclose($handle);
			//写首次登录判断文件.install
            $handle = fopen( "./sysdata/.install", "w" );
            @flock( $handle, 3 );
            fwrite( $handle, "First Login cmsware!" );
            fclose( $handle );
			if($IN['installCWPS']==1) {
			//写cwps安装锁定文件
				$handle = fopen('../cwps/tmp/install.lock','w');
				@flock($handle,3);  
				fwrite($handle,'cwps Install locked!');
				fclose($handle);
				if(file_exists("../cwps/tmp/cache.SoapAction.php"))  @unlink("../cwps/tmp/cache.SoapAction.php"); //删除cwps旧缓存文件
				if(file_exists("../cwps/tmp/cache.SoapOAS.php"))  @unlink("../cwps/tmp/cache.SoapOAS.php"); //删除cwps旧缓存文件
				if(file_exists("../cwps/tmp/config.Setting.php"))  @unlink("../cwps/tmp/config.Setting.php"); //删除cwps旧缓存文件
			}

		header("Location: ./index.php");

	default:
		
		$TPL->display('install.html');
		break;
}

?>
<br>
<div align=center><font id='description'>Powered by <a href="http://www.cmsware.com" target="_blank" id='description'><?=$version?></a> <BR> &nbsp; Copyright &copy; <a href="http://www.lonmo.com" target=\"_blank\" id='description'>Lonmo Technology Ltd</a> 2002-<?=date('Y')?> ,All rights reserved.</font> </div>