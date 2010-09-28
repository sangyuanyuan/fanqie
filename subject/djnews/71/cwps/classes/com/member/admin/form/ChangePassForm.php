<?php
class ChangePassForm extends ActionForm {
	/**
 	 * @access  public
	 * @return object ActionErrors
	 */
	function  &validate(&$mapping, &$IN) 
	{
		$errors = new ActionErrors();


		if($this->bean['NewPassword'] != $this->bean['NewPassword2']) {
			$errors->add(ActionErrors_GLOBAL_ERROR, 'login.changePass.newpass_not_match' );		
		}
		
		return $errors;
		
	}
}
?>