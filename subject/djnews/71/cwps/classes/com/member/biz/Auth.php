<?php
define("CLS_Auth_OK", 0);
define("CLS_Auth_USER_STOPPED", 1);
define("CLS_Auth_USERNAMEORPASSWORD_ERROR", 2);

class Auth {
	var $session = array();
	var $errorCode = 0;

	function Auth() 
	{
		global $SYS_ENV;

		$this->cookie_name_sid = $SYS_ENV['passport']['CookiePre'].'sid';
		$this->cookie_name_userid = $SYS_ENV['passport']['CookiePre'].'userid';
		$this->cookie_name_password = $SYS_ENV['passport']['CookiePre'].'password';

		//按照GET,POST,COOKIE的顺序读取sid
		$this->sId = isset($_GET['sId']) ? $_GET['sId'] : (isset($_POST['sId']) ? $_POST['sId'] : $_COOKIE[$this->cookie_name_sid]); 

 		$this->UserID = kAddslashes($_COOKIE[$this->cookie_name_userid]);
		$this->Password = kAddslashes($_COOKIE[$this->cookie_name_password]);

		$this->OnlineHold = &$SYS_ENV['passport']['OnlineHold'];
		$this->Ip = $GLOBALS['IN']['IP_ADDRESS'];
		$this->cookiepath = &$SYS_ENV['passport']['CookiePath'];
		$this->cookiedomain = &$SYS_ENV['passport']['CookieDomain'];
		$this->CheckIP = &$SYS_ENV['passport']['CheckIP'];
		$this->timestamp = time();
		$this->init(); //modity by easyT,2007.11.29,去掉原来的注释，每次初始类时进行获取一次用户id和组id
	}


	function init()                     //获取用户的id和组id .
	{
		global $db, $table;
		
		$this->clearRubbishSession(5000);	//调用清除过期的session记录，如果过期记录不到1000条就不清除，add by easyt 2006.8.29

		if(!empty($this->sId)) {         //如用户id存在
			if(!empty($this->UserID)) {
				//whether member sid
				$check_ip_sql = $this->CheckIP ? " AND s.Ip='{$this->Ip}'" : "" ;
				$result = $db->getRow("SELECT s.*,u.*,g.GroupName,ue.* FROM $table->sessions s, $table->user u,$table->user_extra ue, $table->group g WHERE s.UserID=u.UserID AND ue.UserID=u.UserID AND s.GroupID=g.GroupID AND s.sId='{$this->sId}' ".$check_ip_sql);
				

			} else {
				//maybe a guest sid
				$check_ip_sql = $this->CheckIP ? " AND Ip='{$this->Ip}'" : "" ;
				$result = $db->getRow("SELECT * FROM $table->sessions WHERE sId='{$this->sId}'".$check_ip_sql);
			}

        	if(empty($result['sId'])) { 
				//sid not valid, maybe the session expired, now we check whether the cookies is valid

				$this->clearCookies();

			} else { // valid session

				
				$this->session = $result;
				$this->session['SessionData'] = unserialize($result['SessionData']);
				$this->session['OWNED-OPERATORS'] = &$this->session['SessionData']['OWNED-OPERATORS'];

				
				$this->activeSession();
				return true;
			}
		} else {
 			if(!empty($this->UserID)) {
				$sql = "SELECT u.*,ue.*,g.* FROM $table->user u,$table->user_extra ue,$table->group g WHERE u.UserID='".$db->escape_string($this->UserID)."' AND u.UserID=ue.UserID AND u.Password='".$db->escape_string($this->Password)."' AND u.GroupID=g.GroupID ";
				
				if($result = $db->getRow($sql)) { //cookies valid
					$this->registerSession($result, 1);
					return true;
				} else {
					$this->clearCookies();
					return $this->makeGuestSession();
				}
			} else {
				return $this->makeGuestSession();
			}
		}
	}

	/**
	 * 为Guest用户生成一个session
	 *
	 */
	function makeGuestSession()
	{
		$result['UserName'] = 'Guest';
		$result['UserID'] = '0';
		$result['GroupID'] = 1;
		return $this->registerSession($result);

	}

	function makeSessionKey()
	{
		list($usec, $sec) = explode(" ",microtime()); 
		return md5(((float)$usec + (float)$sec).mt_rand(0,100));
	
	}

	function activeSession()
	{
		global $db,$table;
		//$result = $db->getRow("select sId from $table->sessions WHERE  sId='".$this->sId."'");    //comment by easyT, 在调用这个函数之前已经查过了确认了session记录了，这里没必要再查一次
		$result = &$this->session;	//直接引用前面已经赋值好的session
		if(empty($result['sId'])) {
			return false;
		} else {
			$sql = "UPDATE $table->sessions SET RunningTime='".time()."' WHERE  sId='".$this->sId."'";
			if($db->query($sql)) return true;
			else return false;
		
		}
	}

	function registerSession($result, $_isCookieLogin = 0)
	{
		global $table,$db;
		$time = time();
		

		//session exists
		//Comment by easyT, 2006.9.4 , 这里没必要关联查用户表，只查session表就够了，提高效率
		//$resultSession = $db->getRow("SELECT s.*,u.*,ue.*,g.GroupName FROM $table->sessions s, $table->user u, $table->user_extra ue,$table->group g WHERE s.UserID=u.UserID AND u.UserID=ue.UserID AND s.GroupID=g.GroupID AND s.UserID='".$result['UserID']."' AND s.Ip='{$this->Ip}'");
		$resultSession = $db->getRow("SELECT s.* FROM $table->sessions s WHERE s.UserID='".$result['UserID']."' AND s.Ip='{$this->Ip}'");
		if(!empty($resultSession['sId'])) {
			$this->sId = $resultSession['sId'];
			$this->session = $resultSession;
			$this->session['sId'] = $this->sId;
			$this->session['SessionData'] = unserialize($resultSession['SessionData']);
			$this->session['OWNED-OPERATORS'] = &$this->session['SessionData']['OWNED-OPERATORS'];
			setcookie($this->cookie_name_sid, $this->sId, $this->timestamp + $this->OnlineHold, $this->cookiepath,  $this->cookiedomain);
			return true;
		}

		$SessionData['OWNED-OPERATORS'] = $this->getUserOperators($result);
		 
		
		//guest session,update to user session
		$resultSession = $db->getRow("SELECT * FROM $table->sessions  where sId='".$this->sId."' AND Ip='{$this->Ip}'");
		if(!empty($resultSession['sId'])) {

			$sql = "update $table->sessions set `UserName`='{$result['UserName']}', `UserID`='{$result['UserID']}', `GroupID`='{$result['GroupID']}', `LogInTime`='$time', `RunningTime`='$time', SessionData='".serialize($SessionData)."', `IsCookieLogin`='{$_isCookieLogin}' where sId='".$this->sId."' AND Ip='{$this->Ip}'";

			if($db->query($sql))	{
				$this->session = array_merge($resultSession, $result);
				setcookie($this->cookie_name_sid, $this->sId, $this->timestamp + $this->OnlineHold, $this->cookiepath,  $this->cookiedomain);
				return true;
			}
			
		}

		$this->sId = $this->makeSessionKey();
		$this->session = $result;
		$this->session['sId'] = $this->sId;
		$this->session['OWNED-OPERATORS'] = $SessionData['OWNED-OPERATORS'];

				
		$sql = "INSERT INTO $table->sessions (`sId`, `UserName`, `UserID`, `GroupID`, `LogInTime`, `RunningTime`, `Ip`, `SessionData`, `IsCookieLogin`) VALUES ('{$this->sId}', '{$result['UserName']}', '{$result['UserID']}', '{$result['GroupID']}', '$time', '$time', '{$this->Ip}', '".serialize($SessionData)."', '{$_isCookieLogin}')";

		if($db->query($sql))	{
			setcookie($this->cookie_name_sid, $this->sId, $this->timestamp + $this->OnlineHold, $this->cookiepath,  $this->cookiedomain);
			return true;
		} else return false;
	}

	function clearRubbishSession($maxcounts)
	{	//清除过期的session记录，参数为数字，指定超过多少条后才清除一次
		global $db,$table;
		
//		if (empty($maxcounts)) $maxcounts=5000;  //如果没有传入最大条数，默认1000条清除一次
		$cut_off_stamp = $this->timestamp - $this->OnlineHold  ;

//		$counts = $db->query("SELECT COUNT(sid) as total FROM $table->sessions WHERE RunningTime < $cut_off_stamp"); 
//		if ($counts['total'] >= $maxcounts) {	//如果过期记录超过了指定条数就清除一次
			$db->query("DELETE FROM $table->sessions WHERE RunningTime < $cut_off_stamp");
//		}
	}
	
	function setCookies(&$session, $expiredTime = 3600)
	{
		if(!empty($expiredTime)) {
			$expiredTime = $this->timestamp + $expiredTime;
		}
		setcookie($this->cookie_name_userid, $session[UserID], $expiredTime, $this->cookiepath,  $this->cookiedomain);
		setcookie($this->cookie_name_password, $session[Password], $expiredTime,  $this->cookiepath,  $this->cookiedomain);
	}

	function clearCookies() 
	{
		setcookie($this->cookie_name_sid, '', $this->timestamp - 86400 * 365, $this->cookiepath,  $this->cookiedomain);
		setcookie($this->cookie_name_userid, '', $this->timestamp - 86400 * 365, $this->cookiepath,  $this->cookiedomain);
		setcookie($this->cookie_name_password, '', $this->timestamp - 86400 * 365,  $this->cookiepath,  $this->cookiedomain);
	}

	function isLogin() 
	{
		if (empty($this->session['UserID'])) {
			return false;
		} else return true;
	}
	

	function isAdmin()
	{
		if($this->session['Role'] == 'admin') return true;
		else return false;
	}

	function getLoginInfo()
	{
		if($this->isLogin()) return $this->session;
		else return false;

	}

	function getUserOperators($UserInfo)
	{
		global $db,$table;
		if(empty($UserInfo['UserID'])) return false;
		//print_r($UserInfo); exit;
		$GroupIDs = array();
		$RoleIDs = array();
		$OpIDs = array();

		$OpIDs = array_merge(explode(',', $UserInfo['OpIDs']), $OpIDs);

		$RoleIDs[] = $UserInfo['RoleID'];
		$RoleIDs = array_merge(explode(',', $UserInfo['SubRoleIDs']), $RoleIDs);

		$GroupIDs[] = $UserInfo['GroupID'];
		
		$GroupIDs = array_merge(explode(',', $UserInfo['SubGroupIDs']), $GroupIDs);

		import("com.member.admin.biz.Group");
		import("com.member.admin.biz.Role");
		import("com.member.admin.biz.Operator");
		$group = new Group();
		$role = new Role();
		$operator = new Operator();
		//process Group
		foreach($GroupIDs as $var) {
			if(empty($var)) continue;
			
			$GroupInfo = $group->getInfo($var);
			array_push($RoleIDs, $GroupInfo['RoleID']);
			$RoleIDs = array_merge(explode(',', $GroupInfo['SubRoleIDs']), $RoleIDs);
			
			$OpIDs = array_merge(explode(',', $GroupInfo['OpIDs']), $OpIDs);



		}





		unset($group);
		unset($GroupInfo);
		//process Role
		foreach($RoleIDs as $var) {
			if(empty($var)) continue;
			
			$RoleInfo = $role->getInfo($var);			
			$OpIDs = array_merge(explode(',', $RoleInfo['OpIDs']), $OpIDs);
		}
		unset($role);
		unset($RoleInfo);

		$return = array();

		foreach($OpIDs as $var) {
			if(empty($var)) continue;
			
			$OpInfo = $operator->getInfo($var);		
			array_push($return, $OpInfo['PrivilegeUID'].'-'.$OpInfo['ResourceUID']);
		}
		$return = array_unique($return);
		//print_r($return); exit;
		
		return  $return;

	
	}
	
	function login($username, $password, $expiredTime= 3600)
	{
		global $db,$table;
		
		$password = md5($password);
		$sql = "SELECT *  FROM $table->user  WHERE UserName='".$db->escape_string($username)."' and Password='$password' ";		
		$result = $db->getRow($sql);
 
		if(!empty($result['UserID'])) {
			if($result['Status'] != 1) {
				$this->errorCode = CLS_Auth_USER_STOPPED;				 
				return false;
			}
			$this->registerSession($result);
			$this->setCookies($this->session, $expiredTime);
			return true;
		} else	{
			$this->errorCode = CLS_Auth_USERNAMEORPASSWORD_ERROR;
			return false;
		}

	}
	function logout()
	{
		global $db,$table;
		$this->clearCookies() ;	
		$sql = "DELETE FROM $table->sessions WHERE sId = '".$this->sId."' AND Ip ='".$this->Ip."'";
		if($db->query($sql))	return true;
		else return false;

	}
	
	function changePassword($password, $newpassword) 
	{
		global $db,$table;

		$password = md5($password);
		$sql = "SELECT * FROM $table->user WHERE  UserID='".$this->session[UserID]."' and  Password='$password'";
		
		$result = $db->getRow($sql);
		
		$newpassword = md5($newpassword);
		if($result['UserID'] != '') {
			$sql = "UPDATE $table->user SET Password='$newpassword' WHERE   UserID='".$this->session[UserID]."' and  Password='$password'";
			if($db->query($sql))	return true;
			else return false;

		} else	return false;
		
	}

}


?>