<?php
define ('DEBUG_MODE','2');
define ('Error_Display','html');
set_magic_quotes_runtime(0);

$version = 'CWPS 1.6';

$phpVersion = substr(phpversion(), 0 ,1);

if($phpVersion == 5) 	define("PHP_VERSION_5", true);
else	define("PHP_VERSION_5", false);


define("DS", "/");
define("ROOT_PATH", dirname(__FILE__) . DS);
define('INCLUDE_PATH', ROOT_PATH .'include'.DS);
define('LIB_PATH', ROOT_PATH .'lib'.DS);
define('CLS_PATH', ROOT_PATH .'classes'.DS);
define('STRUTS_DIR', LIB_PATH.'kStruts'.DS);
define('TMP_DIR', ROOT_PATH .'tmp'.DS);
define('LANG_PATH', ROOT_PATH .'language'.DS);

//****
define('KTPL_DIR', LIB_PATH .'kTemplate'.DS);
define('KDB_DIR', LIB_PATH .'kDB'.DS);
//define('KTPL_DIR', '../../include/lib/kTemplate'.DS);
//define('KDB_DIR', '../../include/lib/kDB'.DS);
//****//

define('IN_SYS', true);

require_once LIB_PATH."file.class.php";


require_once "config.php";
require_once KTPL_DIR . 'kTemplate.class.php';
require_once LIB_PATH . 'file.class.php';
require_once LIB_PATH . 'data.class.php';
require_once LIB_PATH . "Error.class.php";
require_once INCLUDE_PATH."functions.php";
require_once LIB_PATH."file.class.php";

$Error = new Error($SYS_ENV['errorReports']);

$SYS_ENV['language'] = empty($SYS_ENV['language']) ? 'chinese_gb' : $SYS_ENV['language'];
require_once LANG_PATH.$SYS_ENV['language'].'/charset.inc.php';

header('Content-Type: text/html; charset='.CHARSET);
if ( file_exists(TMP_DIR.'install.lock') )
{
	echo "警告!安装功能已被禁止，请删除系统目录中的'".TMP_DIR."install.lock'文件以继续安装.";
	exit();
}
$charset = CHARSET;

require_once KDB_DIR.'kDB.php';


 //$db->setDebug(1);
//from ipb
$IN = parse_incoming();

$TPL = new kTemplate();
$TPL->template_dir = ROOT_PATH.'templates/install/';
$TPL->compile_dir = TMP_DIR.'templates_c/';
$TPL->cache_dir = TMP_DIR.'cache/';
$TPL->assign('version', $version);
//global variable  manipulation END


if($SYS_ENV['ftp_mode']===1) {
	$SYS_ENV['ftp_cms_admin_path'] = File::_ftp_realpath($SYS_ENV['ftp_cms_admin_path'], "../");
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
	$dir = "./%%install/";
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
	global $db,$output,$CMSWARE_ADMIN_URL,$CMSWARE_ADMIN_HOST,$db_config;
	$sql = str_replace("{cmsware_admin}", $CMSWARE_ADMIN_URL, $sql);
	$sql = str_replace("{cmsware_admin_host}", $CMSWARE_ADMIN_HOST, $sql);
	
	
	
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

		if($db_config['db_charset'] == 'gb2312') $db_config['db_charset'] = 'gbk';

		
	}


	if (($mysql_version[0] == 4 && $mysql_version[1] > 0) || $mysql_version[0] > 4)  {
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

if(!dir_writeable('./tmp/templates_c')) {
	printf("<b>安装错误：</b>目录./tmp/templates_c不可写,安装前请设置以下目录为可写：<br>");
	printf("<UL>");
	printf("<LI>/tmp");	
	printf("<LI>/tmp/templates_c");	
	printf("<LI>/tmp/cache");	
	printf("</UL>");
	exit;
}

if(!is_writeable(ROOT_PATH.'config.php')) {
	die("<b>安装错误：</b>系统配置文件 config.php 不可写");
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
 
		$TPL->display('install.html');
 		break;
 
	case '1':
 			
			$operation="<td bgcolor=\"#ececec\">".PHP_OS."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>ok</FONT></td>";
			$webserver="<td bgcolor=\"#ececec\">".$_SERVER['SERVER_SOFTWARE']."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>ok</FONT></td>";
			$php="<td bgcolor=\"#ececec\">".phpversion()."</td>
						<td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>ok</FONT></td>";
			
			if (extension_loaded('ftp')) {
				$ftp = "<td bgcolor=\"#ececec\">PHP FTP module</td><td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>ok</FONT></td>";
			} else
				$ftp = "<td bgcolor=\"#ececec\"></td><td bgcolor=\"#ececec\"><FONT  COLOR=#FF0000>fail</FONT></td>";

			if (extension_loaded('gd')) {
				if(function_exists('gd_info'))	$gd_info = gd_info();
				$gd = "<td bgcolor=\"#ececec\">".$gd_info["GD Version"]."</td><td bgcolor=\"#ececec\"><FONT size=1 COLOR=#009900>ok</FONT></td>";
			} else
				$gd = "<td bgcolor=\"#ececec\">".$gd_info["GD Version"]."</td><td bgcolor=\"#ececec\"><FONT  COLOR=#FF0000>fail</FONT></td>";

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

 	case '2':
 			$TPL->assign('installType',$IN['installType']);
			$TPL->assign('db_host',$db_config[db_host]);
			$TPL->assign('db_user',$db_config[db_user]);
			$TPL->assign('db_password',$db_config[db_password]);
			$TPL->assign('db_name',$db_config[db_name]);
			$TPL->assign('table_header',$db_config[table_pre]);

			
			$info = pathinfo($_SERVER["PHP_SELF"]);

			if ($info["dirname"]=="\\") $info["dirname"]='';
			if ($info["dirname"]=='/') $info["dirname"]='';

			if($_SERVER["SERVER_PORT"] != 80) {
				$CMSWARE_ADMIN_URL = 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$info["dirname"];
				$CMSWARE_ADMIN_HOST = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
			} else {
				$CMSWARE_ADMIN_URL = 'http://'.$_SERVER["SERVER_NAME"].$info["dirname"];
				$CMSWARE_ADMIN_HOST = $_SERVER["SERVER_NAME"];

			}
			

			$TPL->assign('URL', $CMSWARE_ADMIN_URL);

			$TPL->display('install2.html');
			break;
 	case '3':

 			$TPL->assign('installType',$IN['installType']);
			$db = new kDB($db_config['db_driver']);
			$db_config['db_driver']   = 'db';	//db,adodb,mdb
			$db_config['db_type']     = 'mysql';
			$db_config['db_host']     = $IN[database_host];	
			$db_config['db_user']     = $IN[database_user];	
			$db_config['db_password'] = $IN[database_password];	
			$db_config['db_name']     = $IN[database_name];	
			$db_config['table_pre']     = $IN[database_header];
			$db_config['db_charset']     = $db_config['db_charset'];

			$server_host = $_SERVER["HTTP_HOST"];
			
			$sql_file = "./install/base.sql";

			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {

				if(mysql_select_db($db_config['db_name'])) {
					if($sql_handle = fopen($sql_file,'r')) { //读取SQL，预备执行sql
						$table_header = $db_config['table_pre'];
						
						$sql_query = fread ($sql_handle, filesize ($sql_file));
						fclose ($sql_handle);
						//eval ("\$sql_query = \"$sql_query\";");
 						$sql_query = str_replace('{$table_header}', $table_header, $sql_query);
	                    $sql_query = str_replace( "{CWPSPassword}", md5( $_SERVER['REMOTE_ADDR'].date( "Y-m-d" ) ), $sql_query );
	                    $sql_query = str_replace( "{ServerIP}", $_SERVER['SERVER_ADDR'], $sql_query );

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
							echo "<script>\n						if(confirm(\" 系统检测到你已经安装了CWPS,\\n继续安装将覆盖掉已安装的内容，是否继续? \")){window.location=\"install.php?overwrite=1&step=3&database_host={$IN[database_host]}&database_name={$IN[database_name]}&database_header={$IN[database_header]}&database_user={$IN[database_user]}&database_password={$IN[database_password]}&installType={$IN[installType]}&config_sys_url=".urlencode($IN['config_sys_url'])."&config_html_url=".urlencode($IN['config_html_url'])."\";
								}else {
									history.go(-1);
								}</script>\n";
							exit;
						}
					
					}

			if(isset($PHP_SELF))
				$_SERVER["PHP_SELF"] = $PHP_SELF;
			
			$info = pathinfo($_SERVER["PHP_SELF"]);


 			if($info["dirname"] == "\\") $info["dirname"]="";
			if ($info["dirname"]=='/') $info["dirname"]='';


			if($_SERVER["SERVER_PORT"] != 80) {
				$URL = 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$info["dirname"];
			} else
				$URL = 'http://'.$_SERVER["SERVER_NAME"].$info["dirname"];


					if(runquery($sql_query)){
						if($config_handle = fopen('./install/config.ini','r')) {//生成config.php
							$config_php = fread ($config_handle, filesize ('./install/config.ini'));
							$config_php = str_replace('[cmsware_db_host]', $db_config['db_host'], $config_php);
							$config_php = str_replace('[cmsware_db_user]', $db_config['db_user'],$config_php);
							$config_php = str_replace('[cmsware_db_password]', $db_config['db_password'],$config_php);
							$config_php = str_replace('[cmsware_db_name]', $db_config['db_name'],$config_php);
							$config_php = str_replace('[cmsware_db_table_pre]', $db_config['table_pre'],$config_php);
							$config_php = str_replace('[cmsware_db_charset]', $db_config['db_charset'],$config_php);

 							
							$enable_validcode = extension_loaded('gd') ? 1 : 0;
							$config_php = str_replace('[enable_validcode]', $enable_validcode,$config_php);

							$config_php = str_replace('[sys_url]', $IN['config_sys_url'],$config_php);
							$config_php = str_replace('[html_url]', $IN['config_html_url'],$config_php);
							$config_php = str_replace('[base_dir]', str_replace("\\", "\\\\", dirname(__FILE__)), $config_php);



							$handle = fopen('config.php','w');
							@flock($handle,3);  
							fwrite($handle,$config_php);
							fclose($handle);							
						} else {
							die("Unable to read ./install/config.ini");
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
			                    $sql_query = str_replace( "{CWPSPassword}", md5( $_SERVER['REMOTE_ADDR'].date( "Y-m-d" ) ), $sql_query );
			                    $sql_query = str_replace( "{ServerIP}", $_SERVER['SERVER_ADDR'], $sql_query );

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

 
									$enable_validcode = extension_loaded('gd') ? 1 : 0;
									$config_php = str_replace('[enable_validcode]', $enable_validcode,$config_php);
									
									$config_php = str_replace('[sys_url]', $IN['config_sys_url'],$config_php);
									$config_php = str_replace('[html_url]', $IN['config_html_url'],$config_php);
									$config_php = str_replace('[base_dir]', str_replace("\\", "\\\\", dirname(__FILE__)), $config_php);

									$handle = fopen('config.php','w');
									@flock($handle,3);  
									fwrite($handle,$config_php);
									fclose($handle);							
								} else {
									die("Unable to read ./install/config.ini");
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
			if(mysql_connect($db_config['db_host'], $db_config['db_user'], $db_config['db_password'])) {
				if(mysql_select_db($db_config['db_name'])) {
					$user_pass=md5($IN[password]);
					$sql="INSERT INTO {$db_config['table_pre']}user  VALUES ('1', 2, '{$IN[root]}', '{$user_pass}', '', '', '{$IN[email]}', '{$IN[root]}', 0, '0000-00-00', '', 'I am Hawking :)', 1, 0, NULL, ',,', 6, ',,', ',,');\r\nINSERT INTO {$db_config['table_pre']}user_extra values(1,'','');\r\n";
					
					if(runquery($sql)) {
						$handle = fopen(TMP_DIR.'install.lock','w');
						@flock($handle,3);  //这里可以改为 读写均锁?。
						fwrite($handle,'lock the installer');
						@unlink(ROOT_PATH."index.html");
						$TPL->assign('output',"<font color=red>恭喜你</font>，成功安装{$version}！");
						$TPL->display('install_end.html');	
					}else {
						$TPL->assign('errmsg','管理员建立失败'.mysql_error());
						$TPL->display('installmsg.html');
					}				
				}

			
			}

	
 		break;
 
 
	
	default:
		
		$TPL->display('install.html');
		break;
}

?>
<br>
<div align=center><font id='description'>Powered by <a href="http://www.cmsware.com" target="_blank" id='description'><?=$version?></a> <BR> &nbsp; Copyright &copy; <a href="http://www.cmsware.com" target=\"_blank\" id='description'>CMSware</a> 1999-<?=date('Y')?> ,All rights reserved.</font> </div>