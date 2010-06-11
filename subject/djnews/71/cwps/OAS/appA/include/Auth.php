<?php
class Auth {
	var $session = array();
	var $sId;
	var $fromCWPS = false; //�����Ƿ���Դ��CWPS
	function Auth()
	{
		session_start();
		$this->session = &$_SESSION;
		
	}

	function init()
	{	
		global $SYS_ENV;
		$this->cookie_name_sid = $SYS_ENV['CookiePre'].'sid';
 		$this->sId = isset($_GET['sId']) ? $_GET['sId'] : (isset($_POST['sId']) ? $_POST['sId'] : $_COOKIE[$this->cookie_name_sid]); 
		$this->Ip = $GLOBALS['IN']['IP_ADDRESS'];

		if(substr($this->sId, 0, 6) == 'CWPS::') {
			$this->sId = substr($this->sId, 6);
			$this->fromCWPS = true;
		}
  
		if(!$this->isLogin()) {
			$this->tryLogin($this->sId, $this->Ip);
		}
	}

	function isLogin()
	{
		if (empty($this->session['UserID'])) {
			return false;
		} else return true;

	}

	function ActiveCWPSSession($activeTime)
	{
		global $SYS_ENV;
		
		if((time() - $this->session['SessionActiveTime']) < $activeTime) return true; //��ʱ$activeTimeִ��ActiveCWPSSession
		
  
		$oas = new SoapOAS($SYS_ENV['CWPS_Address']); //��ʼ��OAS�ͻ���
		$oas->setTransactionAccessKey($SYS_ENV['TransactionAccessKey']); //����CWPS��������

		$oas->doLog = true; //�Ƿ��SOAP���ݰ����м�¼
		$oas->logFile = "oas.log.".date("Y-m-d").".txt"; //log�ļ���


		$oas->setTransactionID(time()); //����������ϢID
		$Action = "ActiveSession";	
		$params = array( 
			"sId"=> $this->sId,
 			); //���ݸ��ӿڵĲ���

		$return = $oas->call($Action, $params); //ִ�е���

		
		if($return === false) { //ִ�з�������,������...
			return false;
		} else { //ִ�гɹ���$return�������ص�����
			
			$this->session['SessionActiveTime'] = time();
			//print_r($return);
			return true;
		}	
	}

	function tryLogin($sId, $ip)
	{
		global $SYS_ENV;

		if(empty($sId)) return false;

 
		$oas = new SoapOAS($SYS_ENV['CWPS_Address']); //��ʼ��OAS�ͻ���
		$oas->setTransactionAccessKey($SYS_ENV['TransactionAccessKey']); //����CWPS��������

		$oas->doLog = true; //�Ƿ��SOAP���ݰ����м�¼
		$oas->logFile = "oas.log.".date("Y-m-d").".txt"; //log�ļ���


		$oas->setTransactionID(time()); //����������ϢID
		$Action = "QueryUserSession";	
		$params = array( 
			"sId"=> $sId,
 			"Ip"=> $ip,
			); //���ݸ��ӿڵĲ���

		$return = $oas->call($Action, $params); //ִ�е���

		
		if($return === false) { //ִ�з�������,������...
			return false;
		} else { //ִ�гɹ���$return�������ص�����
			$this->session = $return;
			$this->session['SessionActiveTime'] = time();
			//print_r($return);
			return true;
		}


	}

	function login()
	{
		global $SYS_ENV, $PageInterface;
		$this->goCWPS($PageInterface['Login']) ;
 	}

	function logout($referer = "")
	{
		global $SYS_ENV, $PageInterface;
		session_destroy();

		$this->goCWPS($PageInterface['Logout'], $referer) ;
		 
	
	}

	function isLoginCWPS()
	{
		 
		global $SYS_ENV, $PageInterface;
		$this->goCWPS($PageInterface['IsLogin']) ;
	
	}

	function goCWPS($url, $referer='') 
	{
		if(empty($referer)) {
			$port = $_SERVER['SERVER_PORT']==80 ? "" : $_SERVER['SERVER_PORT'];
			$referer = "http://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
		
		}

		$pos = strpos($url, '?');
		if ($pos === false) {
			$url = $url."?&referer=OAS::".urlencode($referer);
		} else 	$url = $url."&referer=OAS::".urlencode($referer);



 		header("Location: $url");
		exit;
	
	}
}

?>