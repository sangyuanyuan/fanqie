<?php
function get_file_path($class_path) {
	
	if(strpos($class_path, ".") !== false) { //namespace path
		$filename = str_replace('.', DIRECTORY_SEPARATOR, $class_path);
		$filename = CLASS_PATH.DIRECTORY_SEPARATOR.$filename;

	} else $filename = $class_path;

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext == '') { $filename .= '.php'; }

    // 首先搜索当前目录
    if (is_readable($filename)) { return realpath($filename); }
    if (is_array($GLOBALS['CLASS_PATH'])) {
        foreach ($GLOBALS['CLASS_PATH'] as $classdir) {
            $path = $classdir . DIRECTORY_SEPARATOR . $filename;
            if (is_readable($path)) {
                return realpath($path);
            }
        }
    }
    return false;
}


/**
 * 载入指定类的定义文件
 *
 * 关于类的命名规则请参考 @see get_file_path 。
 *
 * 用法：
 * <code>
 * load_class('FLEA_Helper_Pager');
 * $pager =& new FLEA_Helper_Pager(...);
 * </code>
 *
 * @param string $className
 *
 * @return boolean
 */
function load_class($class_path) {
	$className = str_replace(".", "_", $class_path);
	
	if (class_exists($className)) { return true; }

    $filename = get_file_path($class_path);
    if ($filename) {
        require_once($filename);
        if (class_exists($className)) { return true; }
		else {
			$className = array_pop(explode('.',$class_path));
			if (class_exists($className)) { return true; }
		}
    }

    // 文件中没有指定类的定义
	trigger_error("$filename not exists, $className not found", E_USER_ERROR);
	return false;
}

/**
 * 返回指定对象的唯一实例
 *
 * 该函数是一个通用的单子设计模式实现。当使用同样的类名称作为参数时，
 * get_singleton() 会返回该类的同一个实例。
 *
 * 在 PHP 中，大多数情况下，提供服务的对象（例如数据库访问、业务逻辑）都只需要
 * 唯一的一个实例。使用该函数，可以不用自己为指定的类实现单子设计模式，提高了
 * 开发效率。
 *
 * 注意：如果类的构造函数要求提供参数，那么不能用 get_singleton() 来获取该类的实例。
 *
 * 用法：
 * <code>
 * $obj =& get_singleton('MY_OBJ');
 * $obj2 =& get_singleton('MY_OBJ');
 * // 此时 $obj 和 $obj2 实际上指向同一个对象的实例
 * </code>
 *
 * @param string $className
 *
 * @return object
 */
function & get_singleton($class_path) {
    static $objs = array();
	
	$className = str_replace(".", "_", $class_path);

    if (isset($objs[$className])) { return $objs[$className]; }
    if (!class_exists($className)) { load_class($class_path); }
	
    if (!class_exists($className)) { 
		$className = array_pop(explode('.',$class_path));
	}

	$objs[$className] = new $className();
    

    return $objs[$className];
}

function writeCache($filename,$cacheData)
{	
	$CacheFileHeader = "<?php\n//Passport cache file, DO NOT modify me!\n//Created on " ;
	$CacheFileFooter = "\n?" . ">";
	$cacheData = $CacheFileHeader.date("F j, Y, H:i")."\n\n".$cacheData.$CacheFileFooter;
	$handle = fopen($filename,'w');
	@flock($handle,3);  //这里可以改为 读写均锁?。
	fwrite($handle,$cacheData);
	return fclose($handle);
}
//15位
function makeGUID()	
{
	$num1 = mt_rand(10000, 99999);
	$num2 = time();
	$str = $num1.$num2;
	return $str;
}

function import($package)
{
 	$package_class_path = str_replace('.', '/', $package);
	$package_class_path = CLS_PATH.$package_class_path.".php";
	if(file_exists($package_class_path)) require_once $package_class_path;
	else die("Fatal Errors: $package_class_path does not exists!");
}

function kAddslashes($string, $force = 0) 
{
	if(!get_magic_quotes_gpc() || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = kaddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}


/*
function raiseMsg($msg)
{
	global $_SYS_MSG,$_LANG_ADMIN;
	if(preg_match("/^[0-9A-Za-z]+\.[0-9A-Za-z]+/isU", $msg)) {
		$_SYS_MSG[] = $_LANG_ADMIN[$msg];
	} else {
		$_SYS_MSG[] = $msg;
	}
}
*/
function showMsg($show_message, $url_forward = '', $delay= 1)
{
		global $TPL,$_LANG_ADMIN,$_SYS_MSG;
		if(empty($url_forward)) $url_forward = $GLOBALS['referer'];

		if(preg_match("/^[0-9A-Za-z]+\.[0-9A-Za-z]+/isU", $show_message)) {
			$show_message =  $_LANG_ADMIN[$show_message];	
 		} 

		if(!empty($_SYS_MSG)) {
			foreach($_SYS_MSG as $var) {
				$show_message.="<br/>".$var;
			}
		}


		$TPL->assign('show_message', $show_message);	
		$TPL->assign('delay',$delay);		
		$TPL->assign('url_forward',$url_forward);		
		$TPL->display('error.html');
		exit;
}

function getFileContent($filename)
{
	return file_get_contents($filename);
}

function parse_incoming()
{
	global $_GET, $_POST, $HTTP_CLIENT_IP, $REQUEST_METHOD, $REMOTE_ADDR, $HTTP_PROXY_USER, $HTTP_X_FORWARDED_FOR;
	$return = array();
	reset($_GET);
	reset($_POST);
	
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$return[$k][ clean_key($k2) ] = clean_value($v2);
				}
			}
			else
			{
				$return[$k] = clean_value($v);
			}
		}
	}
	
	// Overwrite GET data with post data
	
	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if ( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					$return[$k][ clean_key($k2) ] = clean_value($v2);
				}
			}
			else
			{
				$return[$k] = clean_value($v);
			}
		}
	}
	
	//----------------------------------------
	// Sort out the accessing IP
	// (Thanks to Cosmos and schickb)
	//----------------------------------------
	
	$addrs = array();
	
	foreach( array_reverse( explode( ',', $HTTP_X_FORWARDED_FOR ) ) as $x_f )
	{
		$x_f = trim($x_f);
		
		if ( preg_match( '/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f ) )
		{
			$addrs[] = $x_f;
		}
	}
	
	$addrs[] = $_SERVER['REMOTE_ADDR'];
	$addrs[] = $HTTP_PROXY_USER;
	$addrs[] = $REMOTE_ADDR;
	//header("Content-type: text/plain"); print_r($addrs); print $_SERVER['HTTP_X_FORWARDED_FOR']; exit();
	
	$return['IP_ADDRESS'] = select_var( $addrs );
											 
	// Make sure we take a valid IP address
	
	$return['IP_ADDRESS'] = preg_replace( "/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})/", "\\1.\\2.\\3.\\4", $return['IP_ADDRESS'] );
	
	$return['request_method'] = ( $_SERVER['REQUEST_METHOD'] != "" ) ? strtolower($_SERVER['REQUEST_METHOD']) : strtolower($REQUEST_METHOD);
	$data = explode(';',$return[op]);
	foreach($data as $key=>$var) {
		$data1 = explode('::', $var);
		$return["{$data1[0]}"] = $data1[1];
	}
		//debug($return);

	return $return;
}

/*-------------------------------------------------------------------------*/
// Key Cleaner - ensures no funny business with form elements             
/*-------------------------------------------------------------------------*/

function clean_key($key) {

	if ($key == "")
	{
		return "";
	}
	$key = preg_replace( "/\.\./"           , ""  , $key );
	$key = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $key );
	$key = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $key );
	return $key;
}

function clean_value($val) {

	if ($val == "")
	{
		return "";
	}
	
	/*$val = str_replace( "&#032;", " ", $val );
	
	if ( $ibforums->vars['strip_space_chr'] )
	{
		$val = str_replace( chr(0xCA), "", $val );  //Remove sneaky spaces
	}
	*/
	/*
	$val = str_replace( "&"            , "&amp;"         , $val );
	$val = str_replace( "<!--"         , "&#60;&#33;--"  , $val );
	$val = str_replace( "-->"          , "--&#62;"       , $val );
	$val = preg_replace( "/<script/i"  , "&#60;script"   , $val );
	$val = str_replace( ">"            , "&gt;"          , $val );
	$val = str_replace( "<"            , "&lt;"          , $val );
	$val = str_replace( "\""           , "&quot;"        , $val );
	$val = preg_replace( "/\n/"        , "<br>"          , $val ); // Convert literal newlines
	$val = preg_replace( "/\\\$/"      , "&#036;"        , $val );
	$val = preg_replace( "/\r/"        , ""              , $val ); // Remove literal carriage returns
	$val = str_replace( "!"            , "&#33;"         , $val );
	$val = str_replace( "'"            , "&#39;"         , $val ); // IMPORTANT: It helps to increase sql query safety.*/
	
	// Ensure unicode chars are OK
	
	/*if ( $this->allow_unicode )
	{
		$val = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $val );
	}
	*/
	// Strip slashes if not already done so.
	
	if ( get_magic_quotes_gpc() )
	{
		$val = stripslashes($val);
	}
	
	// Swop user inputted backslashes
	
//	$val = preg_replace( "/\\\(?!&amp;#|\?#)/", "&#092;", $val ); 
	
	return $val;
}

/*-------------------------------------------------------------------------*/
// Variable chooser             
/*-------------------------------------------------------------------------*/

function select_var($array) {
	
	if ( !is_array($array) ) return -1;
	
	ksort($array);
	
	
	$chosen = -1;  // Ensure that we return zero if nothing else is available
	
	foreach ($array as $k => $v)
	{
		if (isset($v))
		{
			$chosen = $v;
			break;
		}
	}
	
	return $chosen;
}

function _addslashes($string) {
	if(!$GLOBALS['magic_quotes_gpc']) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = _addslashes($val);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}

function CMSware_mkDir($directory,$mode = 0777)
{
	global $SYS_ENV;
	/*
	$SYS_ENV['is_safe_mode'] 
	$SYS_ENV['ftp_server']
	$SYS_ENV['ftp_server_port']
	$SYS_ENV['ftp_user_name']
	$SYS_ENV['ftp_user_pass']
	$SYS_ENV['ftp_iwpc_admin_path']
	**/
	if(@opendir($directory))
		return true;
	if ($SYS_ENV['is_safe_mode'] == '1') {
		if (function_exists('ftp_connect')) {
			$mode = decoct($mode);
			//echo $mode;
			if (strlen($mode) == 4)
				$mode = substr($mode,1);
			$conn_id = @ftp_connect($SYS_ENV['ftp_server'],$SYS_ENV['ftp_server_port']); 
			
			// login with username and password		
			$login_result = @ftp_login($conn_id, $SYS_ENV['ftp_user_name'], $SYS_ENV['ftp_user_pass']); 
			
			if ((!$conn_id) || (!$login_result)) { 
				echo "<font color=red>FTP connection has failed!</font><br>Attempted to connect to $ftp_server for user $ftp_user_name.<br>";
				echo "Please reset you FTP accounts correctly in your iWPC system setting."; 
				exit; 
			} else {
				// connected!
				
				ftp_chdir($conn_id,$SYS_ENV['ftp_cms_admin_path']);
				
				$dirinfo =pathinfo($directory);
				if(!ftp_chdir($conn_id,$dirinfo["dirname"])) {
					$pathInfo = explode("/",$dirinfo["dirname"]);
					$basedir="";
					foreach($pathInfo as $var) {
						if ($var == ".") {
							$basedir=$basedir."./";
							$begin = false;
						} elseif ($var == "..") {
							$basedir=$basedir."../";
							$begin = false;
						} else {
							if (!$begin) {
								$var = $var;
								$begin = true;
							} else
								$var = '/'.$var;
							if (CMSware_mkDir($basedir.$var,octdec($mode))) {
								//echo "Repair ${basedir}${var} OK<br>";
								$repair = true;
								$basedir = $basedir.$var;
							} else {
								//echo "Repair ${basedir}${var} Fail<br>";
								$repair = false;	
							}
						}
					}
					
				}

				if(ftp_mkdir($conn_id,$dirinfo["basename"])) {
					ftp_site($conn_id,"CHMOD ".$mode." ".$dirinfo["basename"]);
					//echo ftp_pwd($conn_id); 
					@ftp_close($conn_id);
					return true;
				} else {
					@ftp_close($conn_id);
					return false;
				}

				 

				
				
			}

		} else {
			echo 'You PHP may running in the safe mode,iWPC try to use ftp to creat directory .<br> but the FTP module can not found,Please contact to you web administrator to install it' ;
			return false;
		}
	} else {
		if (@mkdir($directory,$mode)) {
			return true;
		} else {
			//try to repair the path
			
			$pathInfo = explode("/",$directory);
			$basedir="";
			foreach($pathInfo as $var) {
				if ($var == ".") {
					$basedir=$basedir."./";
					$begin = false;
				} elseif ($var == "..") {
					$basedir=$basedir."../";
					$begin = false;
				} else {
					if (!$begin) {
						$var = $var;
						$begin = true;
					} else
						$var = '/'.$var;
					if (CMSware_mkDir($basedir.$var,$mode)) {
						//echo "Repair ${basedir}${var} <br>";
						$repair = true;
						$basedir = $basedir.$var;
					} else {
						$repair = false;	
					}
				}
			}
			return $repair;
		}
			
	}
}

 
function delDir($dirname) 
{	
	
	if($dir=dir($dirname)) {
		$dir->rewind();
		while($file=$dir->read()) {
			
			if($file=='' || $file =='.' || $file =='..')
				continue;
			elseif(is_dir($dirname."/".$file)) {
				$filename[] = delDir($dirname."/".$file);
			}else {
				$filename[]=$dirname."/".$file;
				@unlink($dirname."/".$file);	
			}
					
		}
		$dir->close();
		rmdir($dirname);
		return $filename;
	
	}

}
 
 
function writeFile($Path2Out,$buffer){
		$buffer=str_replace('\n',"",trim($buffer));
		//$buffer=str_replace('',"",trim($buffer));
		$ifile = new iFile;
		$ifile -> OpenFile($Path2Out,0,w);
		if($ifile -> WriteFile(stripslashes($buffer)))
		//if($ifile -> WriteFile($buffer))
			$returnvar=true;
		else $returnvar=false;
		unset ($ifile);
		return $returnvar;
}

function getFile($Path2Get) {
		$ifile = new iFile;
		$ifile -> OpenFile($Path2Get,0,r);
		if($data=$ifile -> getFileData()){
			unset ($ifile);	
			return $data;
		}else {
			unset ($ifile);	
			return false;
		}
}

function strip($str)
{
	return preg_replace('!\s+!', '', $str);
}

function CsubStr($str,$start,$len) { 
		$strlen=strlen($str); 
		$clen=0; 
		$i=0;
		if($len >= $strlen)
			return $str; 
		else {
			while($i<$strlen) {
				if ($clen>=$start+$len) 
					break; 
				if(ord(substr($str,$i,1))>0xa0) 
				{ 
					if ($clen>=$start) 
					$tmpstr.=substr($str,$i,2); 
					$i++; 
				} 
				else 
				{ 
					if(ord(substr($str,($i+1),1))>0xa0) {
						if ($clen>=$start) 
						$tmpstr.=substr($str,$i,1); 
						//$i++;
					} else {
						if ($clen>=$start) 
						$tmpstr.=substr($str,$i,2); 
						$i++;
					}
					
				} 
				$i++;
				$clen++;
			}
			return $tmpstr.'...'; 
		}
		
}



function html2txt($document)
{
$search = array ("'<script[^>]*?" . ">.*?</script>'si",  // 去掉 javascript
                 "'<[\/\!]*?[^<>]*?" . ">'si",           // 去掉 HTML 标记
                 "'([\r\n])[\s]+'",                 // 去掉空白字符
                 "'&(quot|#34);'i",                 // 替换 HTML 实体
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // 作为 PHP 代码运行

$replace = array ("",
                  "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169),
                  "chr(\\1)");

$text = preg_replace ($search, $replace, $document);
return $text;
}

 

function cwps_encrypt($txt, $key) {
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));
	$ctr = 0;
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(cwps_key($tmp, $key));
}

function cwps_decrypt($txt, $key) {
	$txt = cwps_key(base64_decode($txt), $key);
	$tmp = '';
	for ($i = 0;$i < strlen($txt); $i++) {
		$md5 = $txt[$i];
		$tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

function cwps_key($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
}


function pagelist($pagenum,$currentpage,$sendVar) 
{
	$matches = '';
    if ( false !== strpos($sendVar, "Page") ) preg_match("/(.*)([&]+Page=.+)/isU", $sendVar, $matches);
    if ($matches) $sendVar = $matches[1];
	$page    = '';
	$pagenum = intval($pagenum);
	$currentpage = intval($currentpage);
	if($pagenum <= 0)
		return false;

	$header = floor($currentpage/10);
	$start = $header*10;
	if($start==0) {
		$start =1;
	}

	for($i= $start;$i<=$start + 9;$i++){

		$link = $sendVar."&Page=".$i;

		if($currentpage==$i){
			$page.= "<font color=\"#FF0000\">[".$i."]</font>&nbsp;&nbsp;";
		}else{

			$page.= "<a href='".$link."'>[".$i."]</a>&nbsp;&nbsp;";
		}
		if($i==$pagenum) break;

	}

	if ($currentpage < $pagenum) {
		$link1= $sendVar."&Page=".($currentpage+1);
		$page= $page."&nbsp;&nbsp;<b><a href='".$link1."' >&gt;</a></b>";
	}

	if($currentpage > 1) {
		if(($currentpage-1) <= 0)
			$link1 = $sendVar;
		else
			$link1= $sendVar."&Page=".($currentpage-1);
		$page= "<b><a href='".$link1."' >&lt;</a></b>&nbsp;&nbsp;".$page;
	}

	if((($currentpage+9)) <= $pagenum && (($currentpage-9) <= 0)) {
		$i =  $start + 9;
		$link = $sendVar."&Page=".$i;
		$page= $page."&nbsp;&nbsp;<b><a href='".$link."' >&gt;&gt;</a></b>";
	}elseif(($currentpage-9) >= 0 && ($currentpage+9) >= $pagenum) {
		$i =  $start - 9;
		if($i <= 0)
			$i='';
		$link =  $sendVar."&Page=".$i;
		$page= "<b><a href='".$link."' >&lt;&lt;</a></b>&nbsp;&nbsp;".$page;

	}elseif((($currentpage-9) > 0) && (($currentpage+9) < $pagenum)) {
		$i =  $start - 9;
		if($i <= 0)
			$i='';

		$link = $sendVar."&Page=".$i;
		$i =  $start + 10;
		$link1 = $sendVar."&Page=".$i;


		$page= "<b><a href='".$link."' >&lt;&lt;</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >&gt;&gt;&gt;&gt;</a></b>";

	}
return $page;

}
?>