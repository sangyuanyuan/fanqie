<?php

Class Group extends iData {

	

	/**
     * Method:	Ìí¼Ó
	 * @param void
	 * @return boolean
     */
	function add()
	{
		global $table;
		if($this->dataInsert($table->group))
			return true;
		else return false;
	
	}

	/**
     * Method:	¸üÐÂ
	 * @param int $GroupID
	 * @return boolean
     */
	function update($GroupID)
	{
		global $table;
 		$where="where GroupID=".$GroupID;
		if($this->dataUpdate($table->group,$where))
			return true;
		else return false;
	
	}

 

	/**
     * Method: É¾³ý
	 * @param int $GroupID
	 * @return boolean
     */		
	function del($GroupID)
	{
		global $table;
		$which="GroupID";
		
		if($this->dataDel($table->group,$which,$GroupID,$method="="))
			return true;
		else return false;
	
	}

	function getInfo($GroupID)
	{
		global $table,$db;
		$sql  ="SELECT g.*,r.*  FROM $table->group g left join $table->role r ON r.RoleID=g.RoleID where GroupID='$GroupID'";
		$result = $db->getRow($sql);
		
		return $result;
		
	}
	
	function getRecordNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->group ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getRecordLimit($start, $offset)
	{
		global $table,$db;
		 
		$sql  ="SELECT  g.*,r.*  FROM $table->group g left join $table->role r ON r.RoleID=g.RoleID  Limit $start, $offset";
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
		 
		$sql  ="SELECT  *  FROM $table->group ";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	
	}
}
?>