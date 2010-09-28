<?php

Class SoapAdmin extends iData {

	var $SoapActionFileName="cache.SoapAction.php";

	/**
     * Method:	Ìí¼Ó
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->soap))
			return true;
		else return false;
	
	}

	/**
     * Method:	¸üÐÂ
	 * @param int $SoapID
	 * @return boolean
     */
	function update($SoapID)
	{
		global $table;
 		$where="where SoapID='".$SoapID."'";
		if($this->dataUpdate($table->soap,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: É¾³ý
	 * @param int $SoapID
	 * @return boolean
     */		
	function del($SoapID)
	{
		global $table;
		$which="SoapID";
		
		if($this->dataDel($table->soap,$which,$SoapID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($SoapID)
	{
		global $table,$db;
		$sql  ="SELECT * FROM  $table->soap where SoapID='$SoapID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->soap ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->soap  Limit $start, $offset";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	}

	function getUnRegSoapIDs()
	{
		$RegSoapIDs = $this->getAllRegSoapIDs();

		$dir=dir(SOAP_INTERFACE_PATH);
		$dir->rewind();
		while($file=$dir->read()) {
			if($file=="." || $file=="..") {
				continue;
			} elseif(is_dir(SOAP_INTERFACE_PATH. '/' . $file)) {
				continue;
			} else {
				if(substr($file, 0, 5) == 'SOAP_') {
					$soapid = substr($file, 5, -4);
					if(!in_array($soapid, $RegSoapIDs)) $return[] = $soapid;
				}
			}
		}
 		$dir->close();
		if(empty($return)) $return = false;
		return $return;
	}

	function getAllRegSoapIDs()
	{
		global $table,$db;
		$data = array();
		$sql  ="SELECT  SoapID  FROM $table->soap ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields['SoapID'];
			$result->MoveNext();
		}
		
		return $data;
	
	}

	function getAll()
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->soap ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}

	function loadSoapAction()
	{
		if($this->isSoapActionExists()) {
			include(TMP_DIR.$this->SoapActionFileName);
		} else {
			$this->makeSoapAction();
			include(TMP_DIR.$this->SoapActionFileName);
 		}
		
		return $SOAP_Action;		

	}

	function makeSoapAction()
	{
		$SOAP_Action = $this->getAllRegSoapIDs();
		$results = var_export ($SOAP_Action, true);
		$results = '$SOAP_Action = '.$results.";";
		writeCache(TMP_DIR.$this->SoapActionFileName, $results);
	}

	function isSoapActionExists()
	{
		if(file_exists(TMP_DIR.$this->SoapActionFileName)) return true;
		else return false;
	}
}
?>