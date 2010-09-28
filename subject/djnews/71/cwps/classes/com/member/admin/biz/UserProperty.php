<?php

Class UserProperty extends iData {

	function getAllFieldsInfo()
	{
		global $table,$db,$FIELDS_INFO;
		if(!empty($FIELDS_INFO)) return $FIELDS_INFO; 
		
 		$sql  ="SELECT * FROM $table->user_fields  Order By FieldOrder";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
 			$data[] = $result->fields;
			$result->MoveNext();
		}
		$FIELDS_INFO = $data;
 		return $data;
	}

	function getAllUserAccessFieldsInfo()
	{
		global $table,$db;
 		
 		$sql  ="SELECT * FROM $table->user_fields where FieldAccess=1 Order By FieldOrder";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
 			$data[] = $result->fields;
			$result->MoveNext();
		}
  		return $data;
	}


	/**
     * Method:	添加新的字段内容模型表
	 * @param int $TableID
	 * @param array $data
	 * @return boolean
     */
	function addField($data)
	{
		global $table, $db_config, $db;
		if($data[FieldSize] != '' && $data[FieldType] != 'text' && $data[FieldType] != 'mediumtext' && $data[FieldType] != 'longtext' && $data[FieldType] != 'contentlink') $length = "({$data[FieldSize]})";

		

		$sql = "ALTER TABLE $table->user_extra ADD `{$data[FieldName]}` {$data[FieldType]} $length  NOT NULL";
		if($db->query($sql)) {

			$this->flushData();
			$this->addData($data);

			if($this->_add_field())	return true;
			else return false;

		} else 
			return false;

	}

	/**
     * Method:	添加字段信息到content_fields 表
	 * @param void
	 * @return boolean
     */
	function _add_field()
	{
		global $table;
		if($this->dataInsert($table->user_fields))
			return true;
		else return false;
	
	}

	/**
     * Method:	更新content_fields 表中的字段信息
	 * @param int $FieldID
	 * @return boolean
     */
	function _edit_field($FieldID)
	{
		global $table;
 		$where="where FieldID=".$FieldID;
		if($this->dataUpdate($table->user_fields,$where))
			return true;
		else return false;
	
	}

	/**
     * Method:	编辑新的字段内容模型表
	 * @param int $FieldID
	 * @param array $data
	 * @return boolean
	 *
     */
	function editField($FieldID, $data)
	{
		global $table, $db_config, $db;
		$fieldInfo = $this->getFieldInfo($FieldID);

		if($data[FieldSize] != '' && $data[FieldType] != 'text' && $data[FieldType] != 'mediumtext' && $data[FieldType] != 'longtext' && $data[FieldType] != 'contentlink') $length = "({$data[FieldSize]})";


		 
		$sql = "ALTER TABLE $table->user_extra CHANGE `{$fieldInfo[FieldName]}` `{$data[FieldName]}` {$data[FieldType]} $length  NOT NULL";
		 
 		if($db->query($sql)) {

			$this->flushData();
			$this->addData($data);

			if($this->_edit_field($FieldID))	return true;
			else return false;

		} else 
			return false;

	}

	/**
     * Method:获得某个字段的信息
	 * @param int $FieldID
	 * @return array
     */	
	function getFieldInfo($FieldID)
	{
		global $table,$db;
		$sql  ="SELECT * FROM $table->user_fields where FieldID=$FieldID";
		
		$data  = $db->getRow($sql);
		
		return $data;
	}

	/**
     * Method: 删除字段@内容模型表
	 * @param int $FieldID
	 * @return boolean
     */		
	function delField($FieldID)
	{
		global $table,$db,$db_config;
		$info = $this->getFieldInfo($FieldID);
 		
		$sql = "ALTER TABLE $table->user_extra DROP `{$info[FieldName]}`";

		if($db->query($sql)) {
			if($this->_del_data($FieldID)) return true;
			else return false;
		} else return false;
	
	}

	/**
     * Method: 删除字段记录@content_fields内容表字段集
	 * @param int $FieldID
	 * @return boolean
     */		
	function _del_data($FieldID)
	{
		global $table;
		$which="FieldID";
		
		if($this->dataDel($table->user_fields,$which,$FieldID,$method="="))
			return true;
		else return false;
	
	}
	
	/**
     * Method: 对字段集进行排序
	 * @param int $TableID, array $Fields
	 * @return boolean
     */			
	function orderField($Fields)
	{
		foreach($Fields as $key=>$var) {
			$this->flushData();
			$this->addData('FieldOrder',$key);
			if($this->_edit_field($var))
				$return = true;
			else
				$return = false;

		}
		return $return;
	}
 
	function isFieldNameExists($FieldName, $FieldID = 0)
	{
		global $table,$db;
		$sql  ="SELECT FieldID FROM $table->user_field  where  FieldName='$FieldName' AND FieldID!='$FieldID' ";
 		$result = $db->getRow($sql);
		if(empty($result[FieldID])) {
			return false;
		} else return true;
	}

}
?>