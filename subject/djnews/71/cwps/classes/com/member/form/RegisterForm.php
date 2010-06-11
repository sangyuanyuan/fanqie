<?php
class RegisterForm extends ActionForm {
	/**
 	 * @access  public
	 * @return object ActionErrors
	 */
	function  &validate(&$mapping, &$IN) 
	{
		$errors = new ActionErrors();


		if($this->bean['Password'] != $this->bean['Password2']) {
			$errors->add(ActionErrors_GLOBAL_ERROR, 'register.password.password2notmatch' );		
		}
		
		return $errors;
		
	}
}
?>