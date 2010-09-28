<?php
if(PHP_VERSION_5) {
	include_once(dirname(__FILE__)."/functions.php5.php");
} else {
	include_once(dirname(__FILE__)."/functions.php4.php");
}

//===================={{{

$GLOBALS['CLASS_PATH'] = array();
if(defined("ROOT_PATH"))  $GLOBALS['CLASS_PATH'][] = ROOT_PATH."lib/";
if(defined("CLS_PATH"))  $GLOBALS['CLASS_PATH'][] = CLS_PATH;

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
		$filename = str_replace('.', DIRECTORY_SEPARATOR, $class_path);
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if ($ext == '') { $filename .= '.php'; }
		
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
	
	$objs[$className] = new $className();
    

    return $objs[$className];
}

//function import($class_path) {
//	return load_class($class_path);
//}
function import($package)
{
 	$package_class_path = str_replace('.', DS, $package);
	$package_class_path = CLS_PATH.$package_class_path.".php";
	if(file_exists($package_class_path)) require_once $package_class_path;
	else die("Fatal Errors: $package_class_path does not exists!");
}

function logger($_msg, $_level = 'INFO') 
{
	$debuginfo = debug_backtrace();
	$file = pathinfo($debuginfo[0]['file']);
	
	if(is_array($_msg)) {
		$_msg = "Array ".var_export($_msg, TRUE);
	} elseif(is_bool($_msg)) {
		$_msg = $_msg ? "Boolean TRUE" : "Boolean FALSE";
	} elseif(is_int($_msg)) {
		$_msg = "INT ".$_msg ;
	}
	
	switch($_level) {
		case "error":
			echo "ERROR [{$file['basename']}:{$debuginfo[0]['line']}] ".$_msg."\n";
			break;
		case "INFO":
		case "info":
		default:
			echo "INFO [{$file['basename']}:{$debuginfo[0]['line']}] ".$_msg."\n";
			break;
	}
}
//====================}}}


function CreationUser($_userid, $field="uName")
{
		global $table,$db;

		$sql  ="SELECT $field FROM $table->user  WHERE uId='$_userid'  ";
		$result = $db->getRow($sql);
		if($field == '*')
			return $result;
		else 
			return $result[$field];
}

function load_lang($_string_path)
{
	return include($_string_path);
}


function add_next_page_link($_content, $_mode = 0)
{
 	$pageNav = $GLOBALS['_CMS']['ContentPageNav'];
	$pagenum =  $GLOBALS['_CMS']['CurrentPage']+1;
	$counter = 0;

	foreach($pageNav as $key=>$var) {
		if($counter == $pagenum) { //取得下一页地址
			$url = $var['URL'];
		} 
		$counter++ ;
	}

	if(empty($url)) { // 取得下一篇文章地址

		$params = array ( 
				'action' => "LIST",
				'return' => "List",
				'nodeid' => $GLOBALS['_CMS']['NodeID'],
				'num' => "1",
				'where' => "i.PublishDate < ".$GLOBALS['_CMS']['PublishDate']." ",
		); 
 
		$List = CMS_LIST($params); 
		if(!empty($List )) {
			foreach ($List as  $key=>$var) {
				$url = $var["URL"];
			}
		
		}
 
		if(empty($url)) {//取不到下一篇
			$firstPage = array_shift($pageNav);
			$url = $firstPage['URL'];	
		}

	}

	if($_mode == 1) {
		$pattern = "/<img.*src=.*([^\"'].*)[\"']?[\s].*>/isU";
		@preg_match_all($pattern, $_content, $out);
		
		foreach($out[0] as $key=>$var) {
			$_content = str_replace($var, "<a href=\"".$url."\">".$var."</a>", $_content);
		}
 	
	} else {
		$_content = "<a href=\"".$url."\">".$_content."</a>";
	}
     


	return $_content;
}

?>