<?php

Class Resource extends iData {

	

	/**
     * Method:	Ìí¼Ó
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->resource))
			return true;
		else return false;
	
	}

	/**
     * Method:	¸üÐÂ
	 * @param int $RID
	 * @return boolean
     */
	function update($RID)
	{
		global $table;
 		$where="where RID=".$RID;
		if($this->dataUpdate($table->resource,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: É¾³ý
	 * @param int $RID
	 * @return boolean
     */		
	function del($RID)
	{
		global $table;
		$which="RID";
		
		if($this->dataDel($table->resource,$which,$RID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($RID)
	{
		global $table,$db;
		$sql  ="SELECT * FROM  $table->resource where RID='$RID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->resource ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  *  FROM $table->resource  Limit $start, $offset";
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
		 
		$sql  ="SELECT  *  FROM $table->resource ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}
}
?>