<?php
/*说明文档：
<CMS::LIST:list ..> 调用标签开始
...
..
.
</CMS>调用标签结束

LIST:函数名称LIST,合法的调用函数名称必须以大写CMS_作为前缀
List:函数返回数组

参数传递:
---------------------
type:调用类型
	 node - 节点调用
	 new - 最新调用
	 hot - 最热调用
	 comment - 最热评论

NodeID:节点ID
Num:调用数量
OrderBy:排序方式
----------------------

－－－－－－－－－－－－－－－－－
<LOOP $List var=var key=key>:开始循环显示
...
..
.
</LOOP>:结束循环显示

$List:必须是之前在<CMS::LIST:list ..>处定义的List
var=var:数组值
key=key:数组key

通过[$var.数组值]来调用数组内容
－－－－－－－－－－－－－－－－－

使用方法:
var $tpl;
CMS::TPL_PULL_Parser($tpl);
echo $tpl;

*/

function CMS_Parser(&$content) {
	return CMS::TPL_PULL_Parser($content);
}
class CMS {

	public static function TPL_PULL_Parser(&$tpl_source)
	{

		$patt = "/<CMS::([\S]+):([\S]+)[\s]+(.*)>(.*)<\/CMS>/siU";
		if (preg_match_all($patt, $tpl_source, $match)) 
		{
			foreach($match[0] as $key=>$var) {
				$params = CMS::TPL_PULL_Parser_parseParameter(trim($match[3][$key])); // Get the Parameter
				
				/*
				$match[1][0]:函数名称
				$match[2][0]:函数返回数组名称
				$match[3][0]:参数
				$match[4][0]:显示逻辑+HTML
				*/
				$html = CMS::TPL_PULL_Parser_parseHtml($match[4][$key]);
				$params['where'] = CMS::parse_where($html);
				//$html = CMS::parse_var_format($html);

				//print_r($params);exit;
				$paramesStr = CMS::vars_export($params) ;
				$paramesStr = CMS::parse_params_var($paramesStr);
				$replace ="<?php\r\n global \$PageInfo,\$params; \r\n \$params = $paramesStr;\r\n\$this->_tpl_vars['{$match[2][$key]}'] = CMS_{$match[1][$key]}(\$params); \r\n    \$this->_tpl_vars['PageInfo'] = &\$PageInfo;  \r\n?>".$html;

				$tpl_source = str_replace($match[0][$key],$replace,$tpl_source);
			}
			//print_r($match);exit;
		} 

		$tpl_source = CMS::parse_ssi($tpl_source);
		$tpl_source = CMS::parse_cms($tpl_source);
		$tpl_source = CMS::parse_block($tpl_source);

		//for 3.0
		$tpl_source = CMS::TPL_PULL_Parser_cmsware3($tpl_source);
		//CMS::parse_tag($tpl_source);

		return $tpl_source;
		
	}

	public static function TPL_PULL_Parser_cmsware3 (&$tpl_source)
	{
		$patt = "/<CMS[\s]+([^\n]*)[\/]>/is";
		if (preg_match_all($patt, $tpl_source, $match)) 
		{
			foreach($match[0] as $key=>$var) {
				$params = CMS::TPL_PULL_Parser_parseParameter_cmsware3(trim($match[1][$key])); // Get the Parameter
				$include_tpl = "";
				
				/*
				$match[1][0]:函数名称
				$match[2][0]:函数返回数组名称
				$match[3][0]:参数
				$match[4][0]:显示逻辑+HTML
				*/

				if(isset($params['tpl'])) {
					 
					$include_tpl = "\r\n<include file=\"".$params['tpl']."\" />\r\n";
					unset($params['tpl']);
				}
				//print_r($params);exit;
				$paramesStr = CMS::vars_export($params) ;

				$replace ="<?php\r\n global \$PageInfo,\$params; \r\n \$params = $paramesStr;\r\n\$this->_tpl_vars['{$params['return']}'] = CMS_{$params['action']}(\$params); \r\n    \$this->_tpl_vars['PageInfo'] = &\$PageInfo;  \r\n?>".$include_tpl;

				$tpl_source = str_replace($match[0][$key],$replace,$tpl_source);
			}
			//print_r($match);exit;
		} 

		return $tpl_source;
		
	} 
	
	public static function vars_export($params) 
	{	
		$return = "array ( \r\n";
		foreach($params as $key=>$var) {
			$return .= "	'{$key}' => \"{$var}\",\r\n";
		
		}
		$return .= " ); \r\n";

		return $return;
	}
	public static function parse_cms(&$contents)
	{
		$patt = "/<CMS::([\S]+):([\S]+)[\s]+(.*)>/siU";
		if (preg_match_all($patt, $contents, $match)) {
			foreach($match[0] as $key=>$var) {
				$params = CMS::TPL_PULL_Parser_parseParameter(trim($match[3][$key])); // Get the Parameter
				$paramesStr = var_export($params, true) ;
				$paramesStr = CMS::parse_params_var($paramesStr);
				$replace ="<?php\n global \$PageInfo,\$params; \n \$params = $paramesStr;\n\$this->_tpl_vars['{$match[2][$key]}'] = CMS_{$match[1][$key]}(\$params); \n    \$this->_tpl_vars['PageInfo'] = &\$PageInfo;  \n?>".$html;

				$contents = str_replace($match[0][$key],$replace,$contents);

			}
		}

		$search = array (
						"'</cms>'si",   
          
					);                    
		$replace = array (
						"",
					);				
		$contents = preg_replace ($search, $replace, $contents);	

		return $contents;
	}	

	public static function parse_params_var($paramesStr)
	{
		$search = array (
						"/\'\{(.*)\}\'/si",   
          
					);                    
		$replace = array (
						"\"{\\1}\"",
					);				
		$paramesStr = preg_replace ($search, $replace, $paramesStr);	
		//$paramesStr = str_replace("'{", '"{', $paramesStr);
		//$paramesStr = str_replace("}'", '}"', $paramesStr);
		return $paramesStr;
	}



	public static function TPL_PULL_Parser_parseHtml($html) {
		//CMS::parse_if($html);
		//CMS::parse_loop($html);
		//CMS::parse_tag($html);
		return $html;

		
	}
	public static function parse_block(&$contents)
	{

		if(preg_match_all("/\[cms-block-container:(.*)\]/isU", $contents, $match)) { 
			foreach($match[0] as $key=>$var) {
				$replace= "<?php \r\n ";
				$replace .= "\$type='".$match[1][$key]."';\r\n";
				$replace .= "\$tplmark= isset(\$tplmark) ? \$tplmark : basename(\$this->template_name);\r\n";
 				$replace .= "include(INCLUDE_PATH.\"block.php\");\r\n";
				$replace .= "?>\n";
				$contents = str_replace($match[0][$key], $replace, $contents);
			}	
		}

		return $contents;

	}

	public static function parse_block__bak(&$contents)
	{

		if(isset($PHP_SELF))
			$_SERVER["PHP_SELF"] = $PHP_SELF;
		$info = pathinfo($_SERVER["PHP_SELF"]);

		if($_SERVER["SERVER_PORT"] != 80) {
			$CMSWARE_URL = 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].str_replace("\\","/", dirname($info["dirname"]))."/";
		} else {
			$CMSWARE_URL = 'http://'.$_SERVER["SERVER_NAME"].str_replace("\\","/", dirname($info["dirname"]))."/";

		}

		if(preg_match_all("/\[cms-block-container:(.*)\]/isU", $contents, $match)) { 
			foreach($match[0] as $key=>$var) {
				$replace= "<?php include(\"".$CMSWARE_URL."admin/block.php?sId=\".\$GLOBALS[IN][sId].\"&NodeID=\".\$GLOBALS[IN][NodeID].\"&type=".$match[1][$key]."&tpl=\".basename(\$this->template_name)); ?>";
				$contents = str_replace($match[0][$key], $replace, $contents);
			}	
		}

		return $contents;

		
	}

	public static function parse_ssi(&$contents)
	{
		$patt = "/\<\!--\[(.*)\]--\>/siU";
		if (preg_match_all($patt, $contents, $match)) {
			//debug($match);
			foreach($match[0] as $key=>$var) {
				$replace = "<?php\n CMSware::cms_".$match[1][$key]."?>";
				$contents = str_replace($match[0][$key], $replace, $contents);
			}
		} 
		
		return $contents;
	}

	public static function parse_tag(&$contents)
	{
		// 函数预处理
		$patt = "/".preg_quote('[')."@([\S^(]+)\(([^)]+)\)".preg_quote(']')."/siU";

		if (preg_match_all($patt, $contents, $matches)) 
		{	
			foreach($matches[1] as $key=>$var) {

				$contents = str_replace($matches[0][$key], CMS::parse_tag_func_format($var, $matches[2][$key] ),  $contents);

			}
		} 
		//直接显示
		$patt = "/\[\\$([a-zA-Z0-9_\.]+)\]/siU";
		if (preg_match_all($patt, $contents, $matches)) 
		{	
			foreach($matches[1] as $key=>$var) {

				$contents = str_replace($matches[0][$key], CMS::parse_tag_format_var_display($var),  $contents);

			}

		} 


	}

	public static function parse_tag_format_var_display($string) 
	{
		$header = "<?php echo \$";

		if(strpos($string, '.')) {
			$data = explode('.',$string);
			
			
			$string = '';
			foreach($data as $key=>$var) {
				if($key == 0)
					$string = $var;
				else
					$string .= "['".$var."']";
			}

			$string = $header.$string.";?>";
		} else {
			$string = $header.$string.";?>";
		}

		return $string;
	
	}

	public static function parse_tag_format_var($string) 
	{
		$header = "\$";

		if(strpos($string, '.')) {
			$data = explode('.',$string);
			
			
			$string = '';
			foreach($data as $key=>$var) {
				if($key == 0)
					$string = $var;
				else
					$string .= "['".$var."']";
			}

			$string = $header.$string;
		} else {
			$string = $header.$string;
		}

		return $string;
	
	}

	public static function parse_var_format($string)
	{
		$patt = "/\\$([a-zA-Z0-9_\.]+)/si";
		if (preg_match_all($patt, $string, $matches)) 
		{	
			foreach($matches[1] as $key=>$var) {

				$string = str_replace($matches[0][$key], CMS::parse_tag_format_var($var), $string);

			}

		} 	

		return $string;
	}
	public static function parse_tag_func_format($funName,$params) 
	{
		$header = "<?php echo ";
		$patt = "/\\$([a-zA-Z0-9_\.]+)/si";
		if (preg_match_all($patt, $params, $matches)) 
		{	
			foreach($matches[1] as $key=>$var) {

				$params = str_replace($matches[0][$key], CMS::parse_tag_format_var($var),  $params);

			}

		} 


		
		$string = $header.$funName.'('.$params.");?>";


		return $string;
	}

	public static function parse_if(&$contents)
	{
		$search = array (
						"'<if[\s]+([^\n]+)>'si",   
						"'<elseif[\s]+([^\n]+)>'si",            
						"'<else>'siU",            
						"'</if>'siU",            
					);                    
		$replace = array (
						"<?php if( \\1 ): ?>",
						"<?php elseif( \\1 ): ?>",
						"<?php else: ?>",
						"<?php endif;?>",
					);				
		$contents = preg_replace ($search, $replace, $contents);	
	}

	public static function parse_where(&$contents)
	{
		$patt = "/\<where:(.*)\>/siU";
		if (preg_match($patt, $contents, $match)) {
			$contents = str_replace($match[0], '', $contents);
			
		} 
		
		return $match[1];
	}

	public static function parse_loop(&$contents)
	{
		$search = array (
						"'<loop[\s]+([\S]+)[\s]+var=([a-zA-Z0-9_]+)[\s]*>'siU",				 
						"'<loop[\s]+([\S]+)[\s]+key=([a-zA-Z0-9_]+)[\s]+var=([a-zA-Z0-9_]+)[\s]*>'siU",  
						"'<loop[\s]+([\S]+)[\s]+var=([a-zA-Z0-9_]+)[\s]+key=([a-zA-Z0-9_]+)[\s]*>'siU",
						"'</loop>'siU",         
					);                    

		$replace = array (
						"<?php if(!empty(\\1)): \n foreach (\\1 as  \$\\2): ?>",
						"<?php if(!empty(\\1)): \n foreach (\\1 as  \$\\2=>\$\\3): ?>",
						"<?php if(!empty(\\1)): \n foreach (\\1 as  \$\\3=>\$\\2): ?>",
						"<?php endforeach; endif;?>",
					);

		$contents = preg_replace ($search, $replace,$contents);
	}

	public static function TPL_PULL_Parser_parseParameter($Parameter) {

		//$Parameter = strtolower($Parameter);
		// Table="1" NodeID='2' query="select * from cmsware_content_table where TableID='1'"

 		$pattern = "/([a-zA-Z0-9_]+)=[\"]([^\"]+)[\"]/isU";
		if(preg_match_all($pattern, $Parameter, $matches)) {
 			foreach($matches[0] as $key=>$var) {
				$output[strtolower($matches[1][$key])] = $matches[2][$key];
		
			}
		}
 		return $output;
	}

	public static function TPL_PULL_Parser_parseParameter_cmsware3($Parameter) {

		//$Parameter = strtolower($Parameter);
		// Table="1" NodeID='2' query="select * from cmsware_content_table where TableID='1'"

 		$pattern = "/([a-zA-Z0-9_]+)=[\"]([^\"]+)[\"]/isU";
		if(preg_match_all($pattern, $Parameter, $matches)) {
 			foreach($matches[0] as $key=>$var) {
				$output[strtolower($matches[1][$key])] = $matches[2][$key];
		
			}
		}
 		return $output;
	}

}


?>