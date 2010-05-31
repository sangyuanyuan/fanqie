<?php
	include_once(dirname(__FILE__)."/../lib/xspace_api.php");
	function &get_baby_album($uid){
		global $bloger;
		if(!is_object($bloger)){
			 $bloger = Bloger::find($uid);
			 if($bloger){
			 	return $bloger->baby_album;
			 }
		}
		
	}