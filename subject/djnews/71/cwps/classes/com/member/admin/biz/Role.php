<?php

Class Role extends iData {

	

	/**
     * Method:	Ìí¼Ó
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->role))
			return true;
		else return false;
	
	}

	/**
     * Method:	¸üÐÂ
	 * @param int $RoleID
	 * @return boolean
     */
	function update($RoleID)
	{
		global $table;
 		$where="where RoleID=".$RoleID;
		if($this->dataUpdate($table->role,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: É¾³ý
	 * @param int $RoleID
	 * @return boolean
     */		
	function del($RoleID)
	{
		global $table;
		$which="RoleID";
		
		if($this->dataDel($table->role,$which,$RoleID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($RoleID)
	{
		global $table,$db;
		$sql  ="SELECT * FROM  $table->role where RoleID='$RoleID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->role ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->role  Limit $start, $offset";
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
		 
		$sql  ="SELECT  *  FROM $table->role ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}
}
?>