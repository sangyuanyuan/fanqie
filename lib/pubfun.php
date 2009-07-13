<?php
/*
 * public function
 */
if (!function_exists('linux_path')){
	function linux_path($path){
		return str_replace("\\","/",$path);
	} 
}

define(LIB_PATH, linux_path(dirname(__FILE__)) .'/');

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
function redirect($url, $type='js')
{
  if($type == 'js'){
	 echo "<script LANGUAGE=\"Javascript\">"; 
	 echo "location.href='$url';"; 
	 echo "</script>"; 		
  }elseif($type== 'header'){
  	header("Location: " . $url); 
  }
  
}

function get_current_url()
{
	return  "http://" .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI];
}

function get_microtime(){ 
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

//work only with jquery frame work
function paginate($url="",$ajax_dom=null,$page_var="page")
{
	$pageindextoken = empty($page_var) ? "page" : $page_var;
	$record_count_token = $pageindextoken . "_record_count";	

	$pagecounttoken = $pageindextoken . "_count";

	global $$pagecounttoken;
	global $$record_count_token;
	$pageindex = isset($_REQUEST[$pageindextoken]) ? $_REQUEST[$pageindextoken] : 1;
	$pagecount = isset($_REQUEST[$pagecounttoken]) ? $_REQUEST[$pagecounttoken] : $$pagecounttoken;
	
	
	if ($url == "") {
		parse_str($_SERVER['QUERY_STRING'], $params);
		unset($params[$pageindextoken]);
		$url = $_SERVER['PHP_SELF'] ."?";
		foreach ($params as $k => $v) {
			$url .= "&" .$k . "=" . $v;
		}
	}
	
	
	if ($pagecount <= 1) return;
	if (!strpos($url,'?'))
	{
		$url .= '?';
	}
	
	$pagefirst = $url . "&$pageindextoken=1";
	$pagenext = $url ."&$pageindextoken=" .($pageindex + 1);
	$pageprev = $url ."&$pageindextoken=" .($pageindex-1);
	$pagelast = $url ."&$pageindextoken=" .($pagecount);
	if ($pageindex == 1 || $pageindex ==null || $pageindex == "")
	{?>
	  <span><a class="paginate_link" href="<?php echo $pagenext; ?>">[下页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pagelast; ?>">[尾页]</a></span>
	<?php	
	}
	if ($pageindex < $pagecount && $pageindex > 1 )
	{?>
	  <span><a class="paginate_link" href="<?php echo $pagefirst; ?>">[首页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pageprev; ?>">[上页]</a></span>			
	  <span><a class="paginate_link" href="<?php echo $pagenext; ?>">[下页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pagelast; ?>">[尾页]</a></span>		
	 <?php
	}
	if ($pageindex == $pagecount)
	{?>
	  <span><a class="paginate_link" href="<?php echo $pagefirst; ?>">[首页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pageprev; ?>">[上页]</a></span>		
	<?php	
	}
	?>共找到<?php echo $$record_count_token; ?>条记录　
  当前第<select name="pageselect" id="pageselect" onChange="jumppage('<?php echo $url ."&" .$page_var ."="; ?>',this.options[this.options.selectedIndex].value);">
	<?php	
	//产生所有页面链接
	for($i=1;$i<=$pagecount;$i++)
	{  
		
	?>
		<option <?php if($pageindex== $i) echo 'selected="selected"';?> value="<?php echo $i;?>"><?php echo $i;?></option>
	 <?php	
	}
	?>
	</select>页　共<?php echo $pagecount;?>页
	<script>
			function jumppage(urlprex,pageindex)
			{
				var surl=urlprex+pageindex;
				window.location.href=surl;
			} 
	</script>
	
	<?php
	if(!empty($ajax_dom)){
		?>
		<script>
			$(".paginate_link").click(function(e){
				e.preventDefault();
				$("#<?php echo $ajax_dom;?>").load($(this).attr('href'));
			});
		</script>
		<?php
	}
}


function strfck($str)
{
	$str=str_replace('\"','"',$str);
	$str=str_replace('"font-size','"mso-bidi-font-size',$str);
	$str=str_replace('FONT-SIZE','mso-bidi-font-size',$str);
	return $str;
}

//获取FCK字符串内容
function get_fck_content($str,$symbol='fck_pageindex')
{
	$ies = '<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>';	
	$ffs = '<div style="page-break-after: always; "><span style="DISPLAY:none">&nbsp;</span></div>';		   
	$contents = split($ies,$str);
	if (count($contents) < 0 ) {
		$contents = split($ffs,$str);
	}
	$index = isset($_REQUEST[$symbol]) ? $_REQUEST[$symbol] : 1;
	return strfck($contents[$index-1]);
}


//copy a direction’s all files to another direction 
function copy_dir($source, $destination, $child=1){ 
//用法： 
// copy_dir("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录 
// copy_dir("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录 
//参数说明： 
// $source:源目录名 
// $destination:目的目录名 
// $child:复制时，是不是包含的子目录 
	if(!is_dir($source)){ 
		debug_info("Error:the $source is not a direction!"); 
		return false; 
	} 
	if(!is_dir($destination)){ 
		mkdir($destination,0777); 
	} 
	
	
	$handle=dir($source); 
	while($entry=$handle->read()) { 
		if(($entry!=".")&&($entry!="..")){ 
			if(is_dir($source."/".$entry)){ 
				if($child) 
					copy_dir($source."/".$entry,$destination."/".$entry,$child); 
			} 
			else{ 
		
				copy($source."/".$entry,$destination."/".$entry); 
			} 		
		} 
	} 
	
	return true; 
} 

function search_content($key,$table_name='smg_news',$conditions=null,$page_count = 0, $order=''){
	$table = new table_class($table_name);
	$keys = explode(' ',$key);
	$c = array();
	foreach ($keys as $v) {
		array_push($c, "title like '%$v%'");
		array_push($c, "keywords like '%$v%'");
		array_push($c, "description like '%$v%'");
		if($table_name == 'smg_news'){
			array_push($c, "tags like '%$v%'");
			array_push($c, "short_title like '%$v%'");
			array_push($c, "content like '%$v%'");
		}
	}
	$c = implode(' OR ' ,$c);
	if($conditions){
		$c = $conditions . ' and (' .$c .')';
	}
	
	$sql = 'select * from ' . $table_name ." where 1=1 and " .$c;
	if ($order){
		$sql = $sql . ' order  by ' .$order;
	}
	$db = get_db();
	if($page_count > 0){
		return $db->paginate($sql);	
	}else{
		return $db->query($sql);
	}
	
	/*
	switch ($table_name) {
		case 'smg_news':			
			foreach ($keys as $v) {
				array_push($c, "title like '%$v%'");
				array_push($c, "short_title like '%$v%'");
				array_push($c, "description like '%$v%'");
				array_push($c, "content like '%$v%'");
			}
		break;
		case 'smg_images':
			foreach ($keys as $v) {
				array_push($c, "title like '%$v%'");
				array_push($c, "description like '%$v%'");
			}
			break;
		case 'smg_video':
			foreach ($keys as $v) {
				array_push($c, "title like '%$v%'");
				array_push($c, "description like '%$v%'");
			}
			break;
		default:
			;
		break;
	}
	*/
}


?>