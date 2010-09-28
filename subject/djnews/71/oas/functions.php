<?php
function oas_parse_incoming()
{
	global $_GET, $_POST, $HTTP_CLIENT_IP, $REQUEST_METHOD, $REMOTE_ADDR, $HTTP_PROXY_USER, $HTTP_X_FORWARDED_FOR;
	$return = array();
	reset($_GET); //把传入的参数数组指针重置到第一个元素
	reset($_POST);
	
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$return[$k][ oas_clean_key($k2) ] = oas_clean_value($v2);
				}
			}
			else
			{
				$return[$k] = oas_clean_value($v);
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
					$return[$k][ oas_clean_key($k2) ] = oas_clean_value($v2);
				}
			}
			else
			{
				$return[$k] = oas_clean_value($v);
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
	
	$return['IP_ADDRESS'] = oas_select_var( $addrs );
											 
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

function oas_clean_key($key) {

	if ($key == "")
	{
		return "";
	}
	$key = preg_replace( "/\.\./"           , ""  , $key );
	$key = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $key );
	$key = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $key );
	return $key;
}

function oas_clean_value($val) {

	if ($val == "")
	{
		return "";
	}
	
	if ( get_magic_quotes_gpc() )
	{
		$val = stripslashes($val);
	}
	return $val;
}

/*-------------------------------------------------------------------------*/
// Variable chooser             
/*-------------------------------------------------------------------------*/

function oas_select_var($array) {
	
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

function oas__addslashes($string) {
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

function passport_encode($array) {
	$arrayenc = array();
	foreach($array as $key => $val) {
		$arrayenc[] = $key.'='.urlencode($val);
	}
	return implode('&', $arrayenc);
}

function passport_encrypt($txt, $key) {
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));
	$ctr = 0;
	$tmp = '';

	for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(passport_key($tmp, $key));
}

function passport_decrypt($txt, $key) {
	$txt = passport_key(base64_decode($txt), $key);
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
		$md5 = $txt[$i];
		$tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

function passport_key($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
}

function StrCodeCWPS($string,$action='ENCODE'){
		global $SYS_ENV;
		$key	= substr(md5($_SERVER["HTTP_USER_AGENT"].$SYS_ENV['passport_key']),8,18);
		$string	= $action == 'ENCODE' ? $string : base64_decode($string);
		$len	= strlen($key);
		$code	= '';
		for($i=0; $i<strlen($string); $i++){
			$k		= $i % $len;
			$code  .= $string[$i] ^ $key[$k];
		}
		$code = $action == 'DECODE' ? $code : base64_encode($code);
		return $code;
}
?>