<?php

Class Privilege extends iData {

	

	/**
     * Method:	���
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->privilege))
			return true;
		else return false;
	
	}

	/**
     * Method:	����
	 * @param int $PID
	 * @return boolean
     */
	function update($PID)
	{
		global $table;
 		$where="where PID=".$PID;
		if($this->dataUpdate($table->privilege,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: ɾ��
	 * @param int $PID
	 * @return boolean
     */		
	function del($PID)
	{
		global $table;
		$which="PID";
		
		if($this->dataDel($table->privilege,$which,$PID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($PID)
	{
		global $table,$db;
		$sql  ="SELECT * FROM  $table->privilege where PID='$PID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->privilege ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->privilege  Limit $start, $offset";
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
		 
		$sql  ="SELECT  *  FROM $table->privilege ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}
}
?>