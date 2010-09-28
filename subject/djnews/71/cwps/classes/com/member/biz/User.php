<?php

Class User extends iData {
	
	function add()
	{
		global $table;
		$this->addData("RegisterDate", time());
 		if($this->dataInsert($table->user))
			return true;
		else return false;
	
	}

	function addExtra()
	{
		global $table;
  		if($this->dataInsert($table->user_extra))
			return true;
		else return false;
	
	}

	function updateExtra($UserID)
	{
		global $table;
		$where="where UserID=".$UserID;
		if($this->dataUpdate($table->user_extra,$where))
			return true;
		else return false;
	
	}


	function update($UserID)
	{
		global $table;
		$where="where UserID=".$UserID;
		if($this->dataUpdate($table->user,$where))
			return true;
		else return false;
	
	}


	function del($UserID)
	{
		global $table;
		$which="UserID";
		
		if($this->dataDel($table->user,$which,$UserID,$method="=")) {
			return $this->delExtra($UserID);
		} else return false;
	
	}

	function delExtra($UserID)
	{
		global $table;
		$which="UserID";
		
		if($this->dataDel($table->user_extra,$which,$UserID,$method="="))
			return true;
		else return false;
	
	}

 
	function isUserNameExists($UserName, $UserID = 0)
	{
		global $table,$db;

		$sql  ="SELECT UserID FROM $table->user  where  UserName='$UserName' AND UserID!='$UserID' ";
		//echo $sql;exit;
		$result = $db->getRow($sql);
		if(empty($result[UserID])) {
			return false;
		} else return true;
	}


	function getUsersInfoByUserIDs($UserIDs)
	{
		global $table,$db;
		$sql  ="SELECT u.*, g.* FROM $table->user u , $table->group g where g.GroupID=u.GroupID  AND u.UserID IN($UserIDs)";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}

	function getUsersInfoByUserNames($UserNames)
	{
		global $table,$db;

		$Users = explode(",", $UserNames);
		 
		foreach($Users as $key=>$var) {
			if(empty($key)) {
				$sqllike = " u.UserName='$var' ";
			} else {
				$sqllike .= " OR u.UserName='$var' ";
			
			}
		}

		$sql  ="SELECT u.*, g.GroupName FROM $table->user u , $table->group g where g.GroupID=u.GroupID  AND ( $sqllike )";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	
	}

	function searchUserNum($keyword)
	{
		global $table,$db;
		//UserName Email QQ BBSName UserNote ChineseName FromWhere
		//UserName like '%$keyword%' OR Email like '%$keyword%' OR QQ like '%$keyword%' OR BBSName like '%$keyword%' OR UserNote like '%$keyword%' OR ChineseName like '%$keyword%' OR FromWhere like '%$keyword%'
		$sql  ="SELECT Count(*) as nr FROM  $table->user where UserName like '%$keyword%' OR Email like '%$keyword%'   OR Description like '%$keyword%' OR NickName like '%$keyword%' ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function searchUserLimit($keyword, $start, $offset, $orderby = "u.RegisterDate DESC")
	{
		global $table,$db;
		if(empty($orderby)) {
			$orderby = "u.RegisterDate DESC";
		}
		$sql  ="SELECT  u.*, g.GroupName  FROM $table->user u LEFT JOIN $table->group g ON g.GroupID=u.GroupID WHERE (u.UserName like '%$keyword%' OR u.Email like '%$keyword%'   OR u.Description like '%$keyword%' OR u.NickName like '%$keyword%' ) Order by $orderby Limit $start, $offset";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	}

	function getAllGroup()
	{
		global $table,$db;
		$sql  ="SELECT * FROM   $table->group order by OrderBy ASC";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	}

	
	function getUserNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->user ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getUserLimit($start, $offset)
	{
		global $table,$db;
		$sql  ="SELECT  u.*, g.GroupName  FROM $table->user u  LEFT JOIN  $table->group g ON g.GroupID=u.GroupID  Order by u.RegisterDate DESC Limit $start, $offset";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	}

	function getUserInfo($UserID)
	{
		global $table,$db;
		
 

		$sql  ="SELECT u.*,g.GroupName,e.* FROM $table->user u , $table->group g, $table->user_extra e where g.GroupID=u.GroupID AND e.UserID=u.UserID AND u.UserID='$UserID' ";
		$result = $db->getRow($sql);
			
		return $result;
	}


	function getUserInfoByUserName($UserName)
	{
		global $table,$db;

		$sql  ="SELECT u.*, g.GroupName,e.* FROM $table->user u , $table->group g, $table->user_extra e where g.GroupID=u.GroupID AND e.UserID=u.UserID  AND u.UserName='$UserName' ";
		$result = $db->getRow($sql);
			
		return $result;
	} 
	
	function activeUser($UserID)
	{
		$this->flushData();
		$this->addData("Status", 1);
		if($this->update($UserID)) {
			$uInfo = $this->getUserInfo($UserID);

			/*if(empty($uInfo[Password])) {
				if($this->setAccountPassByMail($UserID, "new_account.txt")) {
					raiseMsg("user.add.newAccountSendMail.ok");
				} else raiseMsg("user.add.newAccountSendMail.fail");
				
			} else {
				if($this->setAccountPassByMail($UserID, "active_account.txt")) {
						raiseMsg("user.active.activeAccountSendMail.ok");
				} else raiseMsg("user.active.activeAccountSendMail.fail");
				
			}
			*/

			
			return true;
		} else return false;
	}

	function stopUser($UserID)
	{
		$this->flushData();
		$this->addData("Status", 0);
		if($this->update($UserID)) {
			/*if($this->setAccountPassByMail($UserID, "stop_account.txt")) {
					raiseMsg("user.stop.stopAccountSendMail.ok");
			} else raiseMsg("user.stop.stopAccountSendMail.fail");
			*/
			return true;
		} else return false;
	}

	function makeRandomPassword()
	{
		$num1 = mt_rand(1000, 1000000);
		$num2 = time();
		$str = substr(md5($num1.$num2), 2, 10);
		return $str;
	}
	
	function setAccountPassByMail($UserID, $mailTplName)
	{
		global $SYS_ENV,$table;
		require_once LIB_PATH.'phpmailer/class.phpmailer.php';
		$uInfo = $this->getUserInfo($UserID);
		if($uInfo['Email'] == '') return false;
		$mail = new PHPMailer();
		if($SYS_ENV['Mail']['Mode'] == 'SMTP') {
			$mail->IsSMTP();                                      // set mailer to use SMTP
			$mail->Host = $SYS_ENV['Mail']['SMTP_Host'];          // specify main and backup server
			$mail->SMTPAuth = $SYS_ENV['Mail']['SMTP_Auth'];     // turn on SMTP authentication
			$mail->Username = $SYS_ENV['Mail']['SMTP_Username'] ; // SMTP username
			$mail->Password = $SYS_ENV['Mail']['SMTP_Password']  ;// SMTP password
		
		}
		$mail->SetLanguage("en", LIB_PATH."phpmailer/language/");

		$mail->From = $SYS_ENV['Mail']['From'];
		$mail->FromName = $SYS_ENV['Mail']['FromName'];
		$mail->AddReplyTo($SYS_ENV['Mail']['Reply'], $SYS_ENV['Mail']['ReplyName']);
		$mail->WordWrap = 80;                                 // set word wrap to 50 characters		
		$RandomPass = $this->makeRandomPassword();
		$mailTpl = getFileContent($mailTplName);
		foreach($uInfo as $key=>$var) {
			if($key == 'ProductType') {
				$mailTpl = str_replace("{".$key."}", $ProductType[$var], $mailTpl);
			} else {
				$mailTpl = str_replace("{".$key."}", $var, $mailTpl);		
			}
		}
 		$mailTpl = str_replace("{password}", $RandomPass, $mailTpl);
		$mailTpl = str_replace("{date}", date("Y-m-d"), $mailTpl);

		if(preg_match("/<title>(.*)<\/title>.*<body>(.*)<\/body>/isU", $mailTpl, $matches)) {
			$mail->Subject = $matches[1];
			$mail->Body    = $matches[2];
			//$mail->AltBody = $matches2];
			
		}

		
		$mail->AddAddress($uInfo['Email'], $uInfo['UserName']);
		if($SYS_ENV['Mail']['CopyMode'] == 2 && !empty($SYS_ENV['Mail']['CopyTo'])) {
			foreach($SYS_ENV['Mail']['CopyTo'] as $var) {
				$mail->AddAddress($var);
			}
		
		}
		$result = $mail->Send();
		if($result) {
			if($SYS_ENV['Mail']['CopyMode'] == 1 && !empty($SYS_ENV['Mail']['CopyTo'])) {
				$mail->Subject = "[COPY]".$mail->Subject;
				$mail->ClearAddresses();
				foreach($SYS_ENV['Mail']['CopyTo'] as $var) {
					$mail->AddAddress($var);
				}
				$mail->Send();
			}

			$this->flushData();
			$this->addData("Password", md5($RandomPass));
			$this->update($UserID);
			return true;

			
		} else {
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   return false;
		
		}


	}


	function NoticeByMail($UserID, $mailTplName)
	{
		global $SYS_ENV,$table;
		require_once LIB_PATH.'phpmailer/class.phpmailer.php';
		$uInfo = $this->getUserInfo($UserID);
		$mail = new PHPMailer();
		if($SYS_ENV['Mail']['Mode'] == 'SMTP') {
			$mail->IsSMTP();                                      // set mailer to use SMTP
			$mail->Host = $SYS_ENV['Mail']['SMTP_Host'];          // specify main and backup server
			$mail->SMTPAuth = $SYS_ENV['Mail']['SMTP_Auth'];     // turn on SMTP authentication
			$mail->Username = $SYS_ENV['Mail']['SMTP_Username'] ; // SMTP username
			$mail->Password = $SYS_ENV['Mail']['SMTP_Password']  ;// SMTP password
		
		}
		$mail->SetLanguage("en", LIB_PATH."phpmailer/language/");

		$mail->From = $SYS_ENV['Mail']['From'];
		$mail->FromName = $SYS_ENV['Mail']['FromName'];
		$mail->AddReplyTo($SYS_ENV['Mail']['Reply'], $SYS_ENV['Mail']['ReplyName']);
		$mail->WordWrap = 80;                                 // set word wrap to 50 characters
		//$mail->IsHTML(true);                                  // set email format to HTML
		
		$mailTpl = getFileContent($mailTplName);
		foreach($uInfo as $key=>$var) {
			if($key == 'ProductType') {
				$mailTpl = str_replace("{".$key."}", $ProductType[$var], $mailTpl);
			} else {
				$mailTpl = str_replace("{".$key."}", $var, $mailTpl);		
			}
		}
		$mailTpl = str_replace("{date}", date("Y-m-d"), $mailTpl);

		if(preg_match("/<title>(.*)<\/title>.*<body>(.*)<\/body>/isU", $mailTpl, $matches)) {
			$mail->Subject = $matches[1];
			$mail->Body    = $matches[2];
			//$mail->AltBody = $matches2];
			
		}


		$mail->AddAddress($uInfo['Email'], $uInfo['UserName']);
		if($SYS_ENV['Mail']['CopyMode'] == 2 && !empty($SYS_ENV['Mail']['CopyTo'])) {
			foreach($SYS_ENV['Mail']['CopyTo'] as $var) {
				$mail->AddAddress($var);
			}
		
		}
		$result = $mail->Send();
		if($result) {
			if($SYS_ENV['Mail']['CopyMode'] == 1 && !empty($SYS_ENV['Mail']['CopyTo'])) {
				$mail->Subject = "[COPY]".$mail->Subject;
				$mail->ClearAddresses();
				foreach($SYS_ENV['Mail']['CopyTo'] as $var) {
					$mail->AddAddress($var);
				}
				$mail->Send();
			}
			return true;			
		} else {
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   return false;
		
		}

	}

	function sendMail($Addresses, $Title, $Content)
	{
		global $SYS_ENV,$table;
		if(empty($Addresses)) return true;
		require_once LIB_PATH.'phpmailer/class.phpmailer.php';
		$mail = new PHPMailer();
		if($SYS_ENV['Mail']['Mode'] == 'SMTP') {
			$mail->IsSMTP();                                      // set mailer to use SMTP
			$mail->Host = $SYS_ENV['Mail']['SMTP_Host'];          // specify main and backup server
			$mail->SMTPAuth = $SYS_ENV['Mail']['SMTP_Auth'];     // turn on SMTP authentication
			$mail->Username = $SYS_ENV['Mail']['SMTP_Username'] ; // SMTP username
			$mail->Password = $SYS_ENV['Mail']['SMTP_Password']  ;// SMTP password
		
		}
		$mail->SetLanguage("en", LIB_PATH."phpmailer/language/");

		$mail->From = $SYS_ENV['Mail']['From'];
		$mail->FromName = $SYS_ENV['Mail']['FromName'];
		$mail->AddReplyTo($SYS_ENV['Mail']['Reply'], $SYS_ENV['Mail']['ReplyName']);
		$mail->WordWrap = 80;                                 // set word wrap to 50 characters
		//$mail->IsHTML(true);                                  // set email format to HTML
		$Content = str_replace("{date}", date("Y-m-d"), $Content);

		$mail->Subject = $Title;
		$mail->Body    = $Content;

		if(is_array($Addresses)) {
			foreach($Addresses as $var) {
				$mail->AddAddress($var);
				raiseMsg($var);
			}		
		} else {
			$mail->AddAddress($Addresses);		
		}

		if($SYS_ENV['Mail']['CopyMode'] == 2 && !empty($SYS_ENV['Mail']['CopyTo'])) {
			foreach($SYS_ENV['Mail']['CopyTo'] as $var) {
				$mail->AddAddress($var);
				raiseMsg($var);
			}
		
		}
		$result = $mail->Send();
		if($result) {
			if($SYS_ENV['Mail']['CopyMode'] == 1 && !empty($SYS_ENV['Mail']['CopyTo'])) {
				$mail->Subject = "[COPY]".$mail->Subject;
				$mail->ClearAddresses();
				foreach($SYS_ENV['Mail']['CopyTo'] as $var) {
					$mail->AddAddress($var);
					raiseMsg($var);
				}
				$mail->Send();
			}
			return true;			
		} else {
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;

		   return false;
		
		}	
	}



}
?>