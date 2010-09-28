<?php
class LoginForm extends ActionForm {
	/**
 	 * @access  public
	 * @return object ActionErrors
	 */
	function  &validate(&$mapping, &$IN) 
	{
		global $SYS_ENV;
		$errors =& new ActionErrors();

		if(empty($this->bean['UserName']) || empty($this->bean['Password'])) {
			$errors->add(ActionErrors_GLOBAL_ERROR, 'login.username_password.null' );		
			return $errors;
		}

		$login_ip = $IN['IP_ADDRESS'];
		if(!empty($SYS_ENV['admin']['AllowLoginIP'])) {
			$allow_login_ips = explode(",", $SYS_ENV['admin']['AllowLoginIP']);
			if(!in_array($login_ip, $allow_login_ips)) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.ipdenied", array($login_ip));
			} 
		}



		if($SYS_ENV['enable_admin_validcode'] == 1) {
			session_start();
			//print_r($_SESSION);
			if(empty($_SESSION['sessionValid'])) { //���û��ͨ��validCode.phpע��$_SESSION['sessionValid']
				$errors->add(ActionErrors_GLOBAL_ERROR, 'login.sessionValid.null' );		
				
			} elseif(!function_exists('ImagePNG')) { //����GD��δ��װ�����Զ�������֤����֤
					
			} elseif($this->bean['validCode'] != $_SESSION['ValidateCode']) { //��֤�����벻��ȷ
				$errors->add(ActionErrors_GLOBAL_ERROR, 'login.validCode.error' );				
				
			}  		
		}


		
		return $errors;
		
	}
}
?>