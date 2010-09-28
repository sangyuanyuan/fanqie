<?php

Class Operator extends iData {

	

	/**
     * Method:	Ìí¼Ó
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->operator))
			return true;
		else return false;
	
	}

	/**
     * Method:	¸üÐÂ
	 * @param int $OpID
	 * @return boolean
     */
	function update($OpID)
	{
		global $table;
 		$where="where OpID=".$OpID;
		if($this->dataUpdate($table->operator,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: É¾³ý
	 * @param int $OpID
	 * @return boolean
     */		
	function del($OpID)
	{
		global $table;
		$which="OpID";
		
		if($this->dataDel($table->operator,$which,$OpID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($OpID)
	{
		global $table,$db;
		$sql  ="SELECT o.*,r.*,p.*  FROM $table->operator o left join $table->resource r ON r.RID=o.RID left join $table->privilege p ON p.PID=o.PID where OpID='$OpID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->operator ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  o.*,r.*,p.*  FROM $table->operator o left join $table->resource r ON r.RID=o.RID left join $table->privilege p ON p.PID=o.PID Limit $start, $offset";
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
		 
		$sql  ="SELECT  o.*,r.*,p.*  FROM $table->operator o left join $table->resource r ON r.RID=o.RID left join $table->privilege p ON p.PID=o.PID ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}
}
?>