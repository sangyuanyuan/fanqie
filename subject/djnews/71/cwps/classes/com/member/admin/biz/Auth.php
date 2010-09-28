<?php
define("CLS_Auth_OK", 0);
define("CLS_Auth_USER_STOPPED", 1);
define("CLS_Auth_USERNAMEORPASSWORD_ERROR", 2);
define("CLS_Auth_NOT_Administrator_ERROR", 3);

class Auth {
	var $session = array();
	var $errorCode = 0;

	function Auth() 
	{
		global $SYS_ENV;

 
		//按照GET,POST,COOKIE的顺序读取sid
		$this->sId = isset($_GET['sId']) ? $_GET['sId'] : $_POST['sId'] ;

		$this->OnlineHold = &$SYS_ENV['passport']['AdminSessionHold'];
		$this->Ip = $GLOBALS['IN']['IP_ADDRESS'];
 		$this->timestamp = time();
		//$this->init();
	}


	function init()                     //获取用户的id和组id .
	{
		global $db, $table;
 
		if(!empty($this->sId)) {         //如用户id存在
 			$result = $db->getRow("SELECT * FROM $table->admin_sessions WHERE sId='{$this->sId}'");
			if(!empty($result['sId'])) { // valid session
				if(!empty($result['IpSecurity']) && $result['Ip']!=$this->Ip) {
					return false;
				} else {
					$this->session = $result;
					$this->activeSession();
					return true;				
				}
			} else { 
				//sid not valid, maybe the session expired, now we check whether the cookies is valid
				return false;
			}
		} else {
 			 return false;
		}
	}


	function makeSessionKey()
	{
		list($usec, $sec) = explode(" ",microtime()); 
		return md5(((float)$usec + (float)$sec).mt_rand(0,100));
	
	}

	function activeSession()
	{
		global $db,$table;
		$sql = "UPDATE $table->admin_sessions SET RunningTime='".time()."' WHERE  sId='".$this->sId."'";
		if($db->query($sql)) return true;
		else return false;
	}

	function registerSession($result, $IpSecurity = 0)
	{
		global $table,$db;
		
		$this->session = $result;
		$this->sId = $this->makeSessionKey();
		$time = time();
				
		$sql = "INSERT INTO $table->admin_sessions (`sId`, `UserName`, `UserID`, `LogInTime`, `RunningTime`, `Ip`, `IpSecurity`) VALUES ('{$this->sId}', '{$result['UserName']}', '{$result['UserID']}', '$time', '$time', '{$this->Ip}', '{$IpSecurity}')";

		if($db->query($sql))	{
 			return true;
		} else return false;
	}

	function clearRubbishSession()
	{
		global $db,$table;

		$cut_off_stamp = $this->timestamp - $this->OnlineHold  ;

		$db->query("DELETE FROM $table->admin_sessions WHERE RunningTime < $cut_off_stamp");

	}
	
	function isLogin() 
	{
		if (empty($this->session['UserID'])) {
			return false;
		} else return true;
	}
	

 
	function getLoginInfo()
	{
		if($this->isLogin()) return $this->session;
		else return false;

	}

	
	function login($username, $password, $IpSecurity = 0)
	{
		global $db,$table;
		
		$password = md5($password);
		$sql = "SELECT u.*, g.*, r.RoleBaseUID FROM $table->user u , $table->group g, $table->role r   WHERE u.UserName='".$db->escape_string($username)."' and u.Password='$password' AND g.GroupID=u.GroupID AND g.RoleID=r.RoleID ";		
		$result = $db->getRow($sql);
		//print_r($result);
		if(!empty($result['UserID'])) {
			if($result['Status'] != 1) {
				$this->errorCode = CLS_Auth_USER_STOPPED;				 
				return false;
			} elseif($result['RoleBaseUID'] != 'Administrator') {
				$this->errorCode = CLS_Auth_NOT_Administrator_ERROR;				 
				return false;
			}
			$this->registerSession($result, $IpSecurity);
 			return true;
		} else	{
			$this->errorCode = CLS_Auth_USERNAMEORPASSWORD_ERROR;
			return false;
		}

	}
	function logout()
	{
		global $db,$table;
 		$sql = "DELETE FROM $table->admin_sessions WHERE sId = '".$this->sId."' AND Ip ='".$this->Ip."'";
 		if($db->query($sql))	return true;
		else return false;

	}
 
}


?>