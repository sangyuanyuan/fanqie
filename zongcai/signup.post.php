<?
include('../inc/db.inc.php');
require_once('../libraries/tableobject_class.php');
session_start();
if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
{
	$extension=explode(".",$_FILES['upfile']['name']);
	if(strtolower($extension[(count($extension)-1)])!="")
	{	
		$error=0;
		$extension=explode(".",$_FILES['upfile']['name']);
		if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1"; }
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK){$error="1"; }
		if($_FILES['upfile']['size']>=104857600){$error="1"; }
		if($error<>"0")
		{	
			echo '<script language=javascript>alert("上传失败1！")</script>';
			exit;
		}
		
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK)
		{
			echo '<script language=javascript>alert("上传失败2！")</script>';
			exit;
		}
		
		$uploaddirall='../upload/subject/';
		
		if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
		elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
		else{$ext=".png";}
		$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
		$savename = '/upload/subject/' .$uploadfilenameall;	
		$upfilepathnameall=$uploaddirall.$uploadfilenameall;
	
		if(!move_uploaded_file($_FILES['upfile']['tmp_name'],$upfilepathnameall))
		{
			echo '<script language=javascript>alert("上传失败3！")</script>';
			exit;
		}
	}
	
	
	ConnectDB();
	if ($_REQUEST['type'] == 'edit') {
		$item = new TableObject('smg_subject_item');
		$item->FieldsValueByField('id',$_REQUEST['id']);
		$item->name = $_REQUEST['name'];
		$item->programtype = $_REQUEST['programtype'];
		$item->author = $_REQUEST['author'];
		$item->mobile = $_REQUEST['mobile'];
		$item->broadcastname = $_REQUEST['broadcastname'];
		$item->programlength = $_REQUEST['programlength'];
		$item->broadcastunit = $_REQUEST['broadcastunit'];
		$item->broadcastdate = $_REQUEST['broadcastdate'];
		$item->reason = $_REQUEST['reason'];
		$item->progress = $_REQUEST['progress'];
		$item->effect = $_REQUEST['effect'];
		$item->uploader = $_REQUEST['uploader'];
		$item->url = $_REQUEST['url'];
		
		if (isset($savename)) {
			
			$item->photourl =$savename;
		}
		$item->UpdateTable();
		echo $item;
	}
	else 
	{
		$StrSql='insert into smg_subject_item (name,programtype,author,mobile,broadcastname,programlength,broadcastunit,broadcastdate,reason,progress,effect,uploader,createtime,url,photourl) values("'.$_POST['name'].'","'.$_POST['programtype'].'","'.$_POST['author'].'","'.$_POST['mobile'].'","'.$_POST['broadcastname'].'","'.$_POST['programlength'].'","'.$_POST['broadcastunit'].'","'.$_POST['broadcastdate'].'","'.$_POST['reason'].'","'.$_POST['progress'].'","'.$_POST['effect'].'","'.$_POST['uploader'].'",now(),"'.$_POST['url'].'","'.$savename.'")';
		$Record = mysql_query($StrSql) or die ("insert error");
	}
	CloseDB();
	
	echo '<script language=javascript>alert("提交成功！")</script>';
	echo '<script language=javascript>window.location.href="/subject/subject.php";</script>';
	exit;
	
	
	function genRandomString($len)
	{    
		$chars = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k","l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v","w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G","H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R","S", "T", "U", "V", "W", "X", "Y", "Z");
	    $charsLen = count($chars) - 1; 
		shuffle($chars);   
		$output = "";    
		for ($i=0; $i<$len; $i++)     
		{         $output .= $chars[mt_rand(0, $charsLen)];     }   
		return $output;  
	}
}
else
{
	die('请从网站入口提交！');	
}

?>