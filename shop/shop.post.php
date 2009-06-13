<? 
include('../inc/db.inc.php');
require_once('../libraries/tableobject_class.php');
if($_POST['type']=='insert')
{
	$extension=explode(".",$_FILES['upfile']['name']);
	if(strtolower($extension[(count($extension)-1)])!="")
	{	
		$error=0;
		$extension=explode(".",$_FILES['upfile']['name']);
		if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1"; }
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK){$error="1"; }
		if($_FILES['upfile']['size']>=1048576){$error="1"; }
		if($error<>"0")
		{	
			echo '<script language=javascript>alert("图片太大！")</script>';
			echo '<script language=javascript>alert("上传失败1！")</script>';
			exit;
		}
		
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK)
		{
			echo '<script language=javascript>alert("上传失败2！")</script>';
			exit;
		}
		
		$uploaddirall='../upload/shop/';
		
		if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
		elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
		else{$ext=".png";}
		$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
		$savename = '/upload/shop/'.$uploadfilenameall;	
		$upfilepathnameall=$uploaddirall.$uploadfilenameall;
	
		if(!move_uploaded_file($_FILES['upfile']['tmp_name'],$upfilepathnameall))
		{
			echo '<script language=javascript>alert("上传失败3！")</script>';
			exit;
		}
	}
	ConnectDB();
		$StrSql='insert into smg_shopdp (name,username,shopurl,createtime) values ("'.$_POST['dpname'].'","'.$_POST['creater'].'","'.$upfilepathnameall.'",now())';
		$Record = mysql_query($StrSql) or die ("insert error");
	CloseDB();
	
	echo '<script language=javascript>alert("提交成功！")</script>';
	echo '<script language=javascript>window.location.href="/shop/shoplist.php";</script>';
	exit;
}

if($_POST['type']=='update')
{
	$extension=explode(".",$_FILES['upfile']['name']);
	if(strtolower($extension[(count($extension)-1)])!="")
	{	
		$error=0;
		$extension=explode(".",$_FILES['upfile']['name']);
		if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1"; }
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK){$error="1"; }
		if($_FILES['upfile']['size']>=1048576){$error="1"; }
		if($error<>"0")
		{	
			echo '<script language=javascript>alert("图片太大！")</script>';
			echo '<script language=javascript>alert("上传失败1！")</script>';
			exit;
		}
		
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK)
		{
			echo '<script language=javascript>alert("上传失败2！")</script>';
			exit;
		}
		
		$uploaddirall='../upload/shop/';
		
		if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
		elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
		else{$ext=".png";}
		$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
		$savename = '/upload/shop/'.$uploadfilenameall;	
		$upfilepathnameall=$uploaddirall.$uploadfilenameall;
	
		if(!move_uploaded_file($_FILES['upfile']['tmp_name'],$upfilepathnameall))
		{
			echo '<script language=javascript>alert("上传失败3！")</script>';
			exit;
		}
	}
	ConnectDB();
	  if(!empty($upfilepathnameall))
	  {
			$StrSql="update  smg_shopdp set name='".$_POST['dpname']."',shopurl='".$upfilepathnameall."', remark='" .$_POST['content'] ."' where id=" .$_POST['shopid'] ;
		}else
		{
			$StrSql="update  smg_shopdp set name='".$_POST['dpname']."', remark='" .$_POST['content'] ."' where id=" .$_POST['shopid'] ;
		}
		$Record = mysql_query($StrSql) or die ("update error". mysql_error());
	CloseDB();
	
	echo '<script language=javascript>alert("更新成功！")</script>';
	echo '<script language=javascript>window.location.href="/shop/splist.php?id='.$_POST['shopid'] .'";</script>';
	exit;
}

function genRandomString($len)
{    
	$chars = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k","l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v","w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G","H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R","S", "T", "U", "V", "W", "X", "Y", "Z");
  $charsLen = count($chars) - 1; 
	shuffle($chars);   
	$output = "";    
	for ($i=0; $i<$len; $i++)     
	{         
		$output .= $chars[mt_rand(0, $charsLen)];     
	}   
	return $output;  
}
?>