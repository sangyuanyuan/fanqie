<?php

require_once(dir_name(__FILE__) ."/table_class.php");
require_once(dir_name(__FILE__) ."/iamge_handler_class.php");

class smg_iamges_class extends table_class
{
	private $thumb_names = array();
	function __construct(){
		parent::__construct('smg_images');
	}
    
	private function __get(){
		
	}
}

?>