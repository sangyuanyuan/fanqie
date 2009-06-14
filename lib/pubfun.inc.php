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


function   aweek($gdate=" ",$first=0){ 
  if(!$gdate)   $gdate   =   date( "Y-m-d "); 
  $w   =   date( "w ",   strtotime($gdate));//取得一周的第几天,星期天开始0-6 
  $dn   =   $w   ?   $w   -   $first   :   6;//要减去的天数 
  $st   =   date( "Y-m-d ",   strtotime( "$gdate   - ".$dn. "   days ")); 
  $data=everyday($st); 
  return  $data;//返回开始和结束日期 
} 

function getTimeOfWeek($year,$week,$dir=0)
{
  $wday=4-date('w',mktime(0,0,0,1,4,$year))+1;
  return strtotime(sprintf("+%d weeks",$week-($dir?0:1)),mktime(0,0,0,1,$wday,$year))-($dir?1:0);
}

function everyday($rq)
{
		for($i=0;$i<7;$i++)
		{
			$date[]=date("Y-m-d",strtotime("$rq +".$i." days"));
		}
		return $date;
}


Function cut_str($str,$start,$len) //设置3个参数 
{ 
$strlen=strlen($str); // 获取字符长度
$clen=0; 
for($i=0;$i<$strlen;$i++,$clen++) 
{ 
  if ($clen>=$start+$len) //当大于截取字符数，则跳出循环
   break; 
  if(ord(substr($str,$i,1))>0xa0) //ord 本函数返回字符的 ASCII (美国国家标准交换码) 序数值。本函数和chr()函数相反。
  { //0xa0 代表 十进制 160,0xa0表示汉字的开始
   if ($clen>=$start)  //判断截取位置
    $tmpstr.=substr($str,$i,2);   //中文截取两个字符
   $i++; 
  } 
   else 
  { 
   if ($clen>=$start) 
    $tmpstr.=substr($str,$i,1);   //非中文截取一个字符
  } 
} 
return $tmpstr; 
} 
Function showShort($str,$len) 
{ 
$tempstr = cSubStr($str,0,$len); 
if ($str<>$tempstr) 
  $tempstr .= "..."; //要以什么结尾,修改这里就可以.
return $tempstr; 
}

function delhtml($str){   //清除HTML标签
$st=-1; //开始
$et=-1; //结束
$stmp=array();
$stmp[]="&nbsp;";
$len=strlen($str);
for($i=0;$i<$len;$i++){
   $ss=substr($str,$i,1);
   if(ord($ss)==60){ //ord("<")==60
    $st=$i;
   }
   if(ord($ss)==62){ //ord(">")==62
    $et=$i;
    if($st!=-1){
     $stmp[]=substr($str,$st,$et-$st+1);
    }
   }
}
$str=str_replace($stmp,"",$str);
return $str;
}

?>