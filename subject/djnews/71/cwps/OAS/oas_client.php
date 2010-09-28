<?php
require_once("SoapOAS.class.php");

$CWPS_Address = "http://passport/soap.php"; //CWPS��ַ
$TransactionAccessKey = "abc"; //CWPS��������

$oas = new SoapOAS($CWPS_Address); //��ʼ��OAS�ͻ���
$oas->setTransferEncrypt(true); //�����Ƿ����ô������ݼ��ܣ�trueΪ���ܣ�falseΪ�����ܣ�Ĭ��Ϊ�����ܡ�
$oas->setOASID("22");//����OASID
//$oas->setPublicEncryptKey("123@cwps"); //�������ݼ��ܹ���,�����򲻽��м���
$oas->setTransactionAccessKey($TransactionAccessKey); //����CWPS��������

$oas->setLog(true); //�Ƿ��SOAP���ݰ����м�¼
$oas->setLogFile("oas.log.".date("Y-m-d").".txt"); //log�ļ���


/*
����CWPS���û���½�����ӿڣ���½�ɹ�ϵͳ�����ص�½��SESSION ID
*/
$oas->setTransactionID(time()); //����������ϢID

$Action = "Login"; //����CWPS��SOAP�ӿ������ýӿڱ�����CWPS��ʹ��Register����ע��
$params = array( 
			"UserName"=>"hawking",
			"Password"=>"a",
			"Ip"=>"127.0.0.1",
			); //���ݸ��ӿڵĲ���

$oas->setDataEncode(false); //Ĭ������params���ݶ�����base64����
						 //��Ϊfalse�Ļ���������Ա��Ҫ���д���OAS����CWPS�˵����ݱ��������

$return = $oas->call($Action, $params); //ִ�е���

if($return === false) { //ִ�з�������,������...
	echo  "Error Code:".$oas->getErrorCode()."<HR>";
	print_r($oas->getResponse());
} else { //ִ�гɹ���$return�������ص�����
	echo "OK!";
	print_r($return);
}



/*
  ����CWPS�Ļ�Ա��Ҳ����ӿڣ��۳��û�10��λ���

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



		$oas->setTransactionID(time()); //����������ϢID
		$Action = "ActiveSession";	
		$params = array( 
			"sId"=> "8a1814b918e49d7ab8b50be06755bc0c",
 			); //���ݸ��ӿڵĲ���

		$return = $oas->call($Action, $params); //ִ�е���
	print_r($return);

		$Action = "QueryUserSession";	
		$params = array( 
			"sId"=> "8a1814b918e49d7ab8b50be06755bc0c",
 			"Ip"=> "127.0.0.1",
			); //���ݸ��ӿڵĲ���

		$return = $oas->call($Action, $params); //ִ�е���
	print_r($return);

?>