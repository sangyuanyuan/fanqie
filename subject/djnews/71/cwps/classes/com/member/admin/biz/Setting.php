<?php

Class Setting{

	var $SettingFileName="config.Setting.php";
	var $Setting = array();

	function Setting()
	{
		$this->Setting = $this->loadSetting();
	
	}

	function flushData()
	{
		$this->Setting = array();
	}

	function addData($key, $value)
	{
		$this->Setting[$key] = $value; 
	}

	function getInfo()
	{
		return $this->loadSetting();
	}

 	function loadSetting()
	{
		if($this->isSettingExists()) {
			include(TMP_DIR.$this->SettingFileName);
		} else {
			$this->makeSetting();
			include(TMP_DIR.$this->SettingFileName);
 		}
		
		return $Setting;		

	}

	function makeSetting()
	{
		$Setting = $this->Setting;
		$results = var_export ($Setting, true);
		$results = '$Setting = '.$results.";";
		unset($Setting);
 		return writeCache(TMP_DIR.$this->SettingFileName, $results);

	}

	function isSettingExists()
	{
		if(file_exists(TMP_DIR.$this->SettingFileName)) return true;
		else return false;
	}
}
?>