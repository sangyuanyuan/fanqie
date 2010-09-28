<?php

Class Chat extends iData {
	
	function add()
	{
		global $table;
		$this->addData("TIME", time());
 		if($this->dataInsert($table->chatMsg))
			return true;
		else return false;
	
	}

	function update($UserID)
	{
		global $table;
		$where="where UserID=".$UserID;
		if($this->dataUpdate($table->chatMsg,$where))
			return true;
		else return false;
	
	}


	function del($UserID)
	{
		global $table;
		$which="UserID";
		
		if($this->dataDel($table->chatMsg,$which,$UserID,$method="="))
			return true;
		else return false;
	
	}

	function getOnlineListByNewMsg()
	{
		$return[] = array("UserName"=>"��һ��������","UserID"=>10388, "Gender"=>1, "Description"=>"Ʈ��", "Signal"=>1);
		$return[] = array("UserName"=>"����ˢ��","UserID"=>10389, "Gender"=>1, "Description"=>"˧�ѵ�������", "Signal"=>1);
		return $return;
	}

	function getOnlineListBySysAssign()
	{
		$return[] = array("UserName"=>"����һ��","UserID"=>10390, "Gender"=>1, "Description"=>"Ʈ��", "Signal"=>0);
		$return[] = array("UserName"=>"��а","UserID"=>10391, "Gender"=>1, "Description"=>"˧�ѵ�������", "Signal"=>1);
 
		return $return;

	}

	function getOnlineListByMyFriends()
	{
		$return[] = array("UserName"=>"Ų����ɭ��","UserID"=>10392, "Gender"=>1, "Description"=>"Ʈ��", "Signal"=>0);
		$return[] = array("UserName"=>"�������","UserID"=>10392, "Gender"=>1, "Description"=>"˧�ѵ�������", "Signal"=>0);
		return $return;

	}

	function getChatMsg($UserID, $TargetUserID)
	{
		$return[] = array("UserName"=>"�������","UserID"=>10392, "Content"=>"˧�ѵ�������", "Mode"=>1, "Time"=>time());
		$return[] = array("UserName"=>"�������","UserID"=>10392, "Content"=>"��ã�", "Mode"=>0, "Time"=>time());
		return $return;
	
	} 

 	
	function getUserNum()
	{
		global $table,$db;
		$sql  ="SELECT Count(*) as nr FROM  $table->chatMsg ";
		$result = $db->getRow($sql);
		
		return $result[nr];
	}

	function getUserLimit($start, $offset)
	{
		global $table,$db;
		$sql  ="SELECT  u.*, g.*  FROM $table->chatMsg u , $table->group g where g.GroupID=u.GroupID  Order by u.RegisterDate DESC Limit $start, $offset";
		$result = $db->Execute($sql);
		while(!$result->EOF) {
			$data[] = $result->fields;
			$result->MoveNext();
		}
		
		return $data;
	}

	function getUserInfo($UserID)
	{
		global $table,$db;

		$sql  ="SELECT * FROM $table->chatMsg u , $table->group g where g.GroupID=u.GroupID  AND u.UserID='$UserID' ";
		$result = $db->getRow($sql);
			
		return $result;
	}

 



}
?>