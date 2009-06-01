<?php
/*
 * public function
 */
function linux_path($path){
	return str_replace("\\","/",$path);
} 
define(LIB_PATH, linux_path(dirname(__FILE__)) .'/');
function get_config($var,$path=''){
	if(empty($path)){$path = LIB_PATH .'../config/config.php';}
	require_once($path);
	return $$var;
}
function debug_info($msg,$type='php') {
	if(get_config('debug_tag') === false){
		return;
	};
	if($type == 'php'){
		echo '<font style="color:red;">' .$msg .'</font>';
	}else
	{
		alert($msg);
	}
}
	
define("ROOT_PATH", "/");
function redirect($url)
{
  echo "<script LANGUAGE=\"Javascript\">"; 
  echo "location.href='$url';"; 
  echo "</script>"; 	
}
function getmicrotime(){ 
   list($usec, $sec) = explode(" ",microtime()); 
   return ((float)$usec + (float)$sec); 
} 
function alert($msg)
{
  echo "<script LANGUAGE=\"Javascript\">"; 
  echo "alert('" .$msg ."');"; 
  echo "</script>"; 		
}

function _get_js_file($js){
	if (strtolower($js) == "default") {
		return ROOT_PATH ."javascript/jquery.js";		
	}else {		
		$ljs = strtolower($js);
		if (strpos($ljs, "http://") !== false || strpos($ljs,"www.") !== false) {	
			return $js;		
		}else {
			if (substr($ljs,-3) == ".js"){$js = substr_replace($js,"",-3);}			
			return  ROOT_PATH ."javascript/" .$js .".js";			
		}		
	}	
}

function js_include_tag($js){
	if (func_num_args()>1) {
		foreach (func_get_args() as $v){
			js_include_tag($v);
		}
		return ;
	}
	$js = _get_js_file($js);
	echo '<script type="text/javascript" language="javascript" src="' .$js .'"></script>';		
}

#only include once
function js_include_once_tag($js){
	global $loaded_js;
	if (empty($loaded_js)){
		$loaded_js = array();
	}
	if (func_num_args()>1) {
		foreach (func_get_args() as $v){
			js_include_once_tag($v);
		}
		return ;
	}
	$js_name = _get_js_file($js);
	if (in_array($js_name,$loaded_js,false)) {
		return ;
	}else {
		$loaded_js[] = $js_name;
		js_include_tag($js);
	}
}

function css_include_tag($filename){
	if (func_num_args()>1) {
		foreach (func_get_args() as $v){
			css_include_tag($v);
		}
		return ;
	}
	$css_name = _get_css_file($filename);	
	echo '<link href="' .$css_name .'" rel="stylesheet" type="text/css">';	
}

function _get_css_file($filename){
	$ljs = strtolower($filename);
	if (strpos($ljs, "http://") !== false || strpos($ljs,"www.") !== false) {	
		return $ljs;				
	}else {
		if (substr($ljs,-4) == ".css"){$filename = substr_replace($filename,"",-4);}			
		$ljs = ROOT_PATH ."css/" .$filename .".css";			
	}
	return $ljs;
}

function css_include_once_tag($filename){
	global $loaded_css;
	if (empty($loaded_css)){
		$loaded_css = array();
	}
	if (func_num_args()>1) {
		foreach (func_get_args() as $v){
			css_include_once_tag($v);
		}
		return ;
	}
	$f = _get_css_file($filename);
	if (in_array($f,$loaded_css,false)) {	
		return ;	
	}else {
		$loaded_css[] = $f;
		css_include_tag($filename);
	}
}


function rand_str($len=10){
  	$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWZYZ";
  	$ret = "";
  	for($i=0;$i < $len; $i++){
  		$ret .= $str{mt_rand(0,61)};
  	}
  	return $ret;
  }

function is_ajax(){
	return strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=="xmlhttprequest" ? true : false;
}

?>