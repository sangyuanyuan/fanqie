<?php
function parse_incoming()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_CLIENT_IP, $REQUEST_METHOD, $REMOTE_ADDR, $HTTP_PROXY_USER, $HTTP_X_FORWARDED_FOR;
	$return = array();
	
	if( is_array($HTTP_GET_VARS) )
	{
		while( list($k, $v) = each($HTTP_GET_VARS) )
		{
			if( is_array($HTTP_GET_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_GET_VARS[$k]) )
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
	
	if( is_array($HTTP_POST_VARS) )
	{
		while( list($k, $v) = each($HTTP_POST_VARS) )
		{
			if ( is_array($HTTP_POST_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_POST_VARS[$k]) )
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
 
?>