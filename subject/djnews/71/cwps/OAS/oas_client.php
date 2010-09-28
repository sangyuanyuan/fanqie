<?php
require_once("SoapOAS.class.php");

$CWPS_Address = "http://passport/soap.php"; //CWPS地址
$TransactionAccessKey = "abc"; //CWPS访问密码

$oas = new SoapOAS($CWPS_Address); //初始化OAS客户端
$oas->setTransferEncrypt(true); //设置是否启用传输数据加密，true为加密，false为不加密，默认为不加密。
$oas->setOASID("22");//设置OASID
//$oas->setPublicEncryptKey("123@cwps"); //设置数据加密公锁,留空则不进行加密
$oas->setTransactionAccessKey($TransactionAccessKey); //设置CWPS访问密码

$oas->setLog(true); //是否对SOAP数据包进行记录
$oas->setLogFile("oas.log.".date("Y-m-d").".txt"); //log文件名


/*
调用CWPS的用户登陆操作接口，登陆成功系统将返回登陆的SESSION ID
*/
$oas->setTransactionID(time()); //设置事务消息ID

$Action = "Login"; //调用CWPS的SOAP接口名，该接口必须在CWPS上使用Register进行注册
$params = array( 
			"UserName"=>"hawking",
			"Password"=>"a",
			"Ip"=>"127.0.0.1",
			); //传递给接口的参数

$oas->setDataEncode(false); //默认所有params数据都进行base64编码
						 //设为false的话，开发人员需要自行处理OAS端与CWPS端的数据编码与解码

$return = $oas->call($Action, $params); //执行调用

if($return === false) { //执行发生错误,错误处理...
	echo  "Error Code:".$oas->getErrorCode()."<HR>";
	print_r($oas->getResponse());
} else { //执行成功，$return包含返回的数据
	echo "OK!";
	print_r($return);
}



/*
  调用CWPS的会员金币操作接口，扣除用户10单位金币

*/
$oas->setTransactionID(time());  
$Action = "updateMoney";
$params = array( 
			"UserID"=>"12",
			"Operator"=>"-",
			"Money"=>"10",
			);  
$return = $oas->call($Action, $params);  
if($return === false) {  
	echo  "Error Code:".$oas->getErrorCode()."<HR>";
	print_r($oas->getResponse());
} else {  
	echo "OK!";
	print_r($return);
}



		$oas->setTransactionID(time()); //设置事务消息ID
		$Action = "ActiveSession";	
		$params = array( 
			"sId"=> "8a1814b918e49d7ab8b50be06755bc0c",
 			); //传递给接口的参数

		$return = $oas->call($Action, $params); //执行调用
	print_r($return);

		$Action = "QueryUserSession";	
		$params = array( 
			"sId"=> "8a1814b918e49d7ab8b50be06755bc0c",
 			"Ip"=> "127.0.0.1",
			); //传递给接口的参数

		$return = $oas->call($Action, $params); //执行调用
	print_r($return);

?>