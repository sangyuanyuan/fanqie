<?php
if(!isset($_SESSION))	$_SESSION = array();

$__SESSION_Started = false;

function _session_start()
{
	global $db,$_SESSION,$IN, $__SESSION_Started;
	$__SESSION_Started = true;
}

function _session_register($_key, $_var=NULL)
{
	global $db,$_SESSION,$_SESSION_KEY,$IN,$__SESSION_Started;
	$_SESSION[$_key] = $_var;
}

function _session_store()
{
	global $db,$_SESSION,$table,$sys;		
	$SessionData = serialize($_SESSION);	
	if(isset($db)) {
		$sql = "update $table->admin_sessions set sData='".$db->escape_string($SessionData)."' where sId='{$sys->sId}' " ;
 		$db->query($sql);
		$db->close();
	}
}

register_shutdown_function('_session_store');
?>