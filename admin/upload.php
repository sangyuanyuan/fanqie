<?
require_once('../frame.php');
$db=get_db();
if($_POST['uptype']=="tginsert")
{
	$error="0";	
	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	$error="0";
	$extension=explode(".",$_FILES['upfile1']['name']);

	if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1";}
	if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK){$error="1";}
	if($_FILES['upfile1']['size']>=150000){$error="1";}

	if($error<>"0")
	{	
		echo '<script language=javascript>alert("图片太大请压缩到150K以内再上传！")</script>';
		redirect('/admin/tg/tginsert.php');
		exit;
	}

	if($error=="0")
	{
		if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK||$_FILES['upfile']['error']!=UPLOAD_ERR_OK)
		{
			echo '<script language=javascript>alert("上传失败2！")</script>';
			redirect('/admin/tg/tginsert.php');
			exit;
		}
	
		$uploaddirall='../upload/photo/';
	
		if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
		elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
		else{$ext=".png";}

		$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
		$upfilepathnameall=$uploaddirall.$uploadfilenameall;
		if(move_uploaded_file($_FILES['upfile1']['tmp_name'],$upfilepathnameall))
		{
			if($_POST['maxnum']!="")
			{
				$StrSql='insert into smg_tg (title,content,starttime,endtime,priority,createtime,isadopt,issendfq,maxnum,photourl,price,marketprice) values ("'.$_POST['title'].'","'.$_POST['content'].'","'.$_POST['starttime'].'","'.$_POST['endtime'].'",'.$priority.',now(),0,'.$_POST['sendfq'].','.$_POST['maxnum'].',"/upload/photo/'.$uploadfilenameall.'","'.$_POST['price'].'","'.$_POST['marketprice'].'")';
			}
			else
			{
				$StrSql='insert into smg_tg (title,content,starttime,endtime,priority,createtime,isadopt,issendfq,photourl,price,marketprice) values ("'.$_POST['title'].'","'.$_POST['content'].'","'.$_POST['starttime'].'","'.$_POST['endtime'].'",'.$priority.',now(),0,'.$_POST['sendfq'].',"/upload/photo/'.$uploadfilenameall.'","'.$_POST['price'].'","'.$_POST['marketprice'].'")';
			}
			$Record = $db->execute($StrSql);
		}
		else
		{
			echo '<script language=javascript>alert("上传失败！")</script>';
			redirect('/admin/tg/tginsert.php');
			exit;
		}
	}
	echo '<script language=javascript>window.location.href="tg/tg.php";</script>';
	
}

if($_POST['uptype']=="tgupdate")
{
	$error="0";
	

	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	if($_FILES['upfile']['name']!=""){
		$error="0";
		$extension=explode(".",$_FILES['upfile']['name']);
	
		if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1";echo '<script language=javascript>alert("上传失败1！")</script>';}
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK){$error="1";}
		if($_FILES['upfile']['size']>=150000){$error="1";}
	
		if($error<>"0")
		{	
			echo '<script language=javascript>alert("图片太大请压缩到150K以内再上传！")</script>';
			redirect('/admin/tg/tgupdate.php?id='.$_POST['tgid']);
			exit;
		}
	
		if($error=="0")
		{
			if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK||$_FILES['upfile']['error']!=UPLOAD_ERR_OK)
			{
				echo '<script language=javascript>alert("上传失败2！")</script>';
				redirect('/admin/tg/tgupdate.php?id='.$_POST['tgid']);
				exit;
			}
		
			$uploaddirall='../upload/photo/';
		
			if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
			elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
			else{$ext=".png";}
	
			$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
			$upfilepathnameall=$uploaddirall.$uploadfilenameall;
			if(move_uploaded_file($_FILES['upfile']['tmp_name'],$upfilepathnameall))
			{
				if($_POST['maxnum']!="")
				{
					$strsql='update smg_tg set title="'.$_POST['title'].'",content="'.$_POST['content'].'",priority="'.$priority.'",starttime="'.$_POST['starttime'].'",endtime="'.$_POST['endtime'].'",maxnum="'.$_POST['maxnum'].'",photourl="/upload/photo/'.$uploadfilenameall.'",issendfq='.$_POST['sendfq'].',price="'.$_POST['price'].'",marketprice="'.$_POST['marketprice'].'" where id='.$_POST['tgid'];
				}else{
					$strsql='update smg_tg set title="'.$_POST['title'].'",content="'.$_POST['content'].'",priority="'.$priority.'",starttime="'.$_POST['starttime'].'",endtime="'.$_POST['endtime'].'",photourl="/upload/photo/'.$uploadfilenameall.'",maxnum=null,issendfq='.$_POST['sendfq'].',price="'.$_POST['price'].'",marketprice="'.$_POST['marketprice'].'" where id='.$_POST['tgid'];
				}
				$Record = $db->execute($strsql);
			}else
			{
				echo '<script language=javascript>alert("上传失败！")</script>';
				redirect('/admin/tg/tgupdate.php?id='.$_POST['tgid']);
				exit;
			}
		}
	}else{
		if($_POST['maxnum']!="")
		{
			$strsql='update smg_tg set title="'.$_POST['title'].'",content="'.$_POST['content'].'",priority="'.$priority.'",starttime="'.$_POST['starttime'].'",endtime="'.$_POST['endtime'].'",maxnum="'.$_POST['maxnum'].'",issendfq='.$_POST['sendfq'].',price="'.$_POST['price'].'",marketprice="'.$_POST['marketprice'].'" where id='.$_POST['tgid'];
		}else{
			$strsql='update smg_tg set title="'.$_POST['title'].'",content="'.$_POST['content'].'",priority="'.$priority.'",starttime="'.$_POST['starttime'].'",endtime="'.$_POST['endtime'].'",maxnum=null,issendfq='.$_POST['sendfq'].',price="'.$_POST['price'].'",marketprice="'.$_POST['marketprice'].'" where id='.$_POST['tgid'];
		}
		$Record = $db->execute($strsql);
			
	}

	echo '<script language=javascript>window.location.href="tg/tg.php";</script>';
}


if($_POST['uptype']=="shopinsert")
{
	$error="0";	

	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	$error="0";
	$extension=explode(".",$_FILES['upfile1']['name']);

	if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1";}
	if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK){$error="1";}
	if($_FILES['upfile1']['size']>=150000){$error="1";}

	if($error<>"0")
	{	
		echo '<script language=javascript>alert("图片大大超过了150K！")</script>';
		echo '<script language=javascript>alert("上传失败1！")</script>';
		exit;
	}

	if($error=="0")
	{
		if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK||$_FILES['upfile']['error']!=UPLOAD_ERR_OK)
		{
			echo '<script language=javascript>alert("上传失败2！")</script>';
			exit;
		}
	
		$uploaddirall='../upload/photo/';
	
		if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
		elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
		else{$ext=".png";}

		$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
		$upfilepathnameall=$uploaddirall.$uploadfilenameall;
		if(move_uploaded_file($_FILES['upfile1']['tmp_name'],$upfilepathnameall))
		{
			if($_POST['maxnum']!="")
			{
				$StrSql='insert into smg_shop (title,content,starttime,endtime,priority,createtime,isadopt,issendfq,maxnum,photourl,shopdpid) values ("'.$_POST['title'].'","'.$_POST['content'].'","'.$_POST['starttime'].'","'.$_POST['endtime'].'","'.$priority.'",now(),0,'.$_POST['sendfq'].','.$_POST['maxnum'].',"/upload/photo/'.$uploadfilenameall.'",'.$_POST['shopid'].')';
			}
			else
			{
				$StrSql='insert into smg_shop (title,content,starttime,endtime,priority,createtime,isadopt,issendfq,photourl,shopdpid) values ("'.$_POST['title'].'","'.$_POST['content'].'","'.$_POST['starttime'].'","'.$_POST['endtime'].'","'.$priority.'",now(),0,'.$_POST['sendfq'].',"/upload/photo/'.$uploadfilenameall.'",'.$_POST['shopid'].')';
			}
			$Record = mysql_query($StrSql) or die ("insert error");
		}
		else
		{
			echo '<script language=javascript>alert("上传失败！")</script>';
			exit;
		}
	}

	echo '<script language=javascript>window.location.href="shop/shopindex.php";</script>';
	
}

if($_POST['uptype']=="shopupdate")
{
	$error="0";	

	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	$error="0";
	$extension=explode(".",$_FILES['upfile1']['name']);

	if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1";}
	if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK){$error="1";}
	if($_FILES['upfile1']['size']>=150000){$error="1";}

	if($error<>"0")
	{	
		echo '<script language=javascript>alert("图片大小超过了150K！")</script>';
		echo '<script language=javascript>alert("上传失败1！")</script>';
		exit;
	}

	if($error=="0")
	{
		if($_FILES['upfile1']['error']!=UPLOAD_ERR_OK||$_FILES['upfile']['error']!=UPLOAD_ERR_OK)
		{
			echo '<script language=javascript>alert("上传失败2！")</script>';
			exit;
		}
	
		$uploaddirall='../upload/photo/';
	
		if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
		elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
		else{$ext=".png";}

		$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
		$upfilepathnameall=$uploaddirall.$uploadfilenameall;
		if(move_uploaded_file($_FILES['upfile1']['tmp_name'],$upfilepathnameall))
		{
			if($_POST['maxnum']!="")
			{
				$strsql='update smg_shop set title="'.$_POST['title'].'",content="'.$_POST['content'].'",priority="'.$priority.'",starttime="'.$_POST['starttime'].'",endtime="'.$_POST['endtime'].'",issendfq='.$_POST['sendfq'].',photourl="/upload/photo/'.$uploadfilenameall.'",maxnum='.$_POST['maxnum'].' where id='.$_POST['tgid'];
			}
			else
			{
				$strsql='update smg_shop set title="'.$_POST['title'].'",content="'.$_POST['content'].'",priority="'.$priority.'",starttime="'.$_POST['starttime'].'",endtime="'.$_POST['endtime'].'",issendfq='.$_POST['sendfq'].',photourl="/upload/photo/'.$uploadfilenameall.'" where id='.$_POST['tgid'];
			}
			$Record = mysql_query($strsql) or die ("insert error");
		}
		else
		{
			echo '<script language=javascript>alert("上传失败！")</script>';
			exit;
		}
	}


	echo '<script language=javascript>window.location.href="shop/shopindex.php";</script>';
}

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

?>