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

		
		if($SYS_ENV['enable_validcode'] == 1) {
			session_start();

			if(empty($_SESSION['sessionValid'])) { //如果没有通过validCode.php注册$_SESSION['sessionValid']
				$errors->add(ActionErrors_GLOBAL_ERROR, 'login.sessionValid.null' );		
				
			} elseif(!function_exists('ImagePNG')) { //或者GD库未安装，则自动跳过验证码验证
					
			} elseif($this->bean['validCode'] != $_SESSION['ValidateCode']) { //验证码输入不正确
				$errors->add(ActionErrors_GLOBAL_ERROR, 'login.validCode.error' );				
				
			}  
		}	
		return $errors;
		
	}
}
?>