<?php
Class iData
{

var $insData;	//array to store data from form or database
var $checkpass = true;	//if pass the data check
var $errinfo;	//array to store error message
var $db_insert_id;
var $db_debug = false;


//-------------------------------------------------
//   构造函数
//-------------------------------------------------
function iData(){
	$this->checkpass = true;
}

//-------------------------------------------------
//   获取数组信息
//-------------------------------------------------
function getForm($tmpArray){
	foreach($tmpArray as $key=>$val)
	{
		$this->insData[$key] = $val;
//		echo "$key -- $val \n<br>";
	}
//exit;
}

function filterData($IN)
{
	if(!is_array($IN)) return false;

	foreach($IN as $key=>$var) {
		$header = substr($key, 0, 5);
		if($header == 'data_') {
			$field = substr($key, 5);
			if(is_array($var)) {
				$tmp_var = "";
				foreach($var as $var_key=>$value) {
					if(empty($var_key)) $tmp_var = $value;
					else  $tmp_var .= ",".$value;
				}

				$var = $tmp_var;
			}
			$this->addData($field, $var);
		} else
			continue;
	}
}
//-------------------------------------------------
//   显示数组信息
//-------------------------------------------------
function debugData(){
	foreach($this->insData as $key=>$val)
	{
		
		echo "$key -- $val \n<br>";
	}
	exit;
}





//-------------------------------------------------
//   return the InsData
//-------------------------------------------------
Function getData($key = NULL ){
	if(!empty($key))
		return $this->insData[$key];
	else
		return $this->insData;
}

//-------------------------------------------------
//   数组中添加数据
//-------------------------------------------------
Function addData($data,$val = NULL){
	global $db;
	if(is_array($data)) {
		foreach($data as $key=>$var) {
			if(is_array($var)) continue;
			$this->insData[$key] = $db->escape_string($var);
		
		}

	} else {
		if(is_array($val)) continue;
		$this->insData[$data] = $db->escape_string($val);
	
	}
}

//-------------------------------------------------
//   数组中删除数据
//-------------------------------------------------
Function delData($key){
	unset($this->insData[$key]);
}

//-------------------------------------------------
//   清空数组
//-------------------------------------------------
Function flushData(){
	unset($this->insData);
}

//-------------------------------------------------
//   数组中改变数据
//-------------------------------------------------
Function chgData($key,$val){
	$this->insData[$key] = $val;
}

//-------------------------------------------------
//   数组信息插入数据库
//-------------------------------------------------
Function dataInsert($Table)	//insert article data to database
{
	If(!$this->checkpass){
		//echo 'fuckyou';
		return 0;	//error,data check not pass
	}Else{
		global $db;
//-------------------------------------------------
//   构建SQL语句
//-------------------------------------------------
		$insData_Num = Count($this->insData); 
		$Foreach_I = 0;
		$query = "Insert into ".$Table." \n(\n";
		$query_key = "";
		$query_val = "";
		foreach($this->insData as $key=>$val){
			if(strlen($val)>0){
				if($Foreach_I == 0){
					$query_key .= '`'.$key.'`';
					$query_val .= "'".$this->ensql($val)."'";
				}else{
					$query_key .= ",\n".'`'.$key.'`';
					$query_val .= ",\n'".$this->ensql($val)."'";
				}
				$Foreach_I = $Foreach_I + 1;
			}
	}
	$query .=$query_key."\n) \nValues \n(\n".$query_val."\n)";
//-------------------------------------------------
//   SQL语句执行
 //echo $query;
//   exit;
//-------------------------------------------------
	if($result = $db->query($query)){
		//echo $query;
		$this->db_insert_id=$db->Insert_ID();
		Return true;
	}else{
	    			$result=$db->errormsg();
					$db->errorinfo[] = "<P>数据库错误:数据更新失败。MySQL_ERRNO:".$result[code].".&nbsp;&nbsp;MySQL_ERROR:".$result[message]."</P>";
					$db->report = $query;
	     			Return false;
		}
	}
}

Function dataUpdate($table,$where)
{
	If (!$this->checkpass)
		{
			return 0;	//error,data check not pass
		}
	Else
		{
//-------------------------------------------------
//   构建SQL语句
//-------------------------------------------------
	 		global $db;
     		$Foreach_I = 0;  
     		$query = "update ".$table." set ";
     		$query_key = "";
     		$query_val = "";
     foreach($this->insData as $key=>$val)
		{
              		if(strlen($val)>=0)  //为空则不插入,否则出错
						{
			  				if($Foreach_I == 0)
								{
                     				$query_key = '`'.$key.'`';
                     				$query_val = "='".$this->ensql($val)."'";
									$query .= $query_key.$query_val;
               					}
							else
								{
                     				$query_key = ",".'`'.$key.'`';
                     				$query_val = "='".$this->ensql($val)."'";
									$query .= $query_key.$query_val;
               					}
           	 				$Foreach_I = $Foreach_I + 1;
						}
     			}
			$query .= " $where";
//-------------------------------------------------
//   SQL语句执行
 // echo $query;
//  exit;
//-------------------------------------------------
     		if($db->query($query))
				{
         			Return true;
		        }
	 		else
	 			{	
	    			$result=$db->errormsg();
					$db->errorinfo[] = "<P>数据库错误:数据更新失败。MySQL_ERRNO:".$result[code].".&nbsp;&nbsp;MySQL_ERROR:".$result[message]."</P>";
					$db->report = $query;
	     			Return false;
   				}
		}
}



Function dataReplace($Table)	//insert article data to database
{
	global $db;
	If(!$this->checkpass){
		//echo 'fuckyou';
		return 0;	//error,data check not pass
	}Else{
		global $db;
//-------------------------------------------------
//   构建SQL语句
//-------------------------------------------------
		$insData_Num = Count($this->insData); 
		$Foreach_I = 0;
		$query = "Replace into ".$Table." \n(\n";
		$query_key = "";
		$query_val = "";
		foreach($this->insData as $key=>$val){
			if(strlen($val)>0){
				if($Foreach_I == 0){
					$query_key .= '`'.$key.'`';
					$query_val .= "'".$this->ensql($val)."'";
				}else{
					$query_key .= ",\n".'`'.$key.'`';
					$query_val .= ",\n'".$this->ensql($val)."'";
				}
				$Foreach_I = $Foreach_I + 1;
			}
	}
	$query .=$query_key."\n) \nValues \n(\n".$query_val."\n)";
//-------------------------------------------------
//   SQL语句执行
 //echo $query;
//   exit;
//-------------------------------------------------
	if($result = $db->query($query)){
		//echo $query;
		$db_insert_id=$db->Insert_ID();
		Return true;
	}else{
	    			$result=$db->errormsg();
					$db->errorinfo[] = "<P>数据库错误:数据更新失败。MySQL_ERRNO:".$result[code].".&nbsp;&nbsp;MySQL_ERROR:".$result[message]."</P>";
					$db->report = $query;
	     			Return false;
		}
	}
}


//)))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))
Function dataDel($table,$which,$id,$method="=")
{
	If (!$this->checkpass)
		{
			return 0;	//error,data check not pass
		}
	Else
		{
//-------------------------------------------------
//   构建SQL语句
//-------------------------------------------------
	 		global $db;
     		$query = "Delete From ".$table." where ".$which.$method.$id;
			
     		if($db->query($query))
				{
         			Return true;
		        }
	 		else
	 			{
	    			
	    			$result=$db->errormsg();
					$db->errorinfo[] = "<P>数据库错误:数据更新失败。MySQL_ERRNO:".$result[code].".&nbsp;&nbsp;MySQL_ERROR:".$result[message]."</P>";
					$db->report = $query;
	     			Return false;
   				}
		}
}

//(((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((
//)))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))
Function dataExists($table,$method,$field,$var)
{
	
//-------------------------------------------------
//   构建SQL语句
//-------------------------------------------------
	 		global $db;
     		$query = "select COUNT(*) as nr From ".$table." where ".$field.$method.$var;
			$result=$db->Execute($query);
			
     		if($result)
				{
         			Return true;
		        }
	 		else
	 			{
	    			Return false;
   				}
		
}

//(((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((

function ensql($string) {
	
	
	return $string;
}


//这里还有一堆方法用于检测输入的数据是否合法，到时加入，先写一个
function chkTel($strPhoneNumber)	//Check Telphone number
	{
		If (strspn($strPhoneNumber,"0123456789-"))
			{
				$errinfo[] = "Telphone number input error.";
				$checkpass = False;
			}
	}

function chkStrIsNull($chkStr,$strName)	//Check Telphone number
	{
		If (!strLen($chkStr)>0)
			{
				$this->errinfo[] = $strName."不能为空.";
				$this->checkpass = False;
			}
	}

}
?>