<?php

Class OAS extends iData {

	var $SoapOASFileName = "cache.SoapOAS.php";

	/**
     * Method:	Ìí¼Ó
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->oas))
			return true;
		else return false;
	
	}

	/**
     * Method:	¸üÐÂ
	 * @param int $OASID
	 * @return boolean
     */
	function update($OASID)
	{
		global $table;
 		$where="where OASID=".$OASID;
		if($this->dataUpdate($table->oas,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: É¾³ý
	 * @param int $OASID
	 * @return boolean
     */		
	function del($OASID)
	{
		global $table;
		$which="OASID";
		
		if($this->dataDel($table->oas,$which,$OASID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($OASID)
	{
		global $table,$db;
		$sql  ="SELECT * FROM  $table->oas where OASID='$OASID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->oas ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->oas  Limit $start, $offset";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	}

	function getAll()
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->oas ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}

 
	function loadSoapOAS()
	{
		if($this->isSoapOASExists()) {
			include(TMP_DIR.$this->SoapOASFileName);
		} else {
			$this->makeSoapOAS();
			include(TMP_DIR.$this->SoapOASFileName);
 		}
		
		return $SoapOAS;		

	}

	function makeSoapOAS()
	{
		global $table,$db;
		
		$SoapOAS = array();
		$sql  ="SELECT  *  FROM $table->oas ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
 			$OASID = $result->fields['OASID'];
			$OASUID = $result->fields['OASUID'];
			$result->fields['CWPSPassword'] = empty($result->fields['CWPSPassword']) ? "" : $result->fields['CWPSPassword'];
			$SoapOAS[$OASID] = array("IP"=> $result->fields['IP'], "CWPSPassword"=>$result->fields['CWPSPassword']);

			if(!empty($OASUID)) {
				$SoapOAS[$OASUID] = array("IP"=> $result->fields['IP'], "CWPSPassword"=>$result->fields['CWPSPassword']);
			}
			$result->MoveNext();
		}
		
		$results = var_export ($SoapOAS, true);
		$results = '$SoapOAS = '.$results.";";
		writeCache(TMP_DIR.$this->SoapOASFileName, $results);
	}

	function isSoapOASExists()
	{
		if(file_exists(TMP_DIR.$this->SoapOASFileName)) return true;
		else return false;
	}

}
?>