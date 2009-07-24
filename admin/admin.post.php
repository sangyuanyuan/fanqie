<?
include('../frame.php');
$PostDiv="abderraf123123";
$db=get_db();




if ($_POST["tgcan"]<>"")
{
	$PostStr = $_POST["tgcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_tg set isadopt=0 where id='.$PostStr; 
	$Record = $db->execute($StrSql);
	echo $Strsql;
}

if ($_POST["tgpub"]<>"")
{
	$PostStr = $_POST["tgpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_tg set isadopt=1 where id='.$PostStr; 
	$Record = $db->execute($StrSql);
	echo "OK";

}



if ($_POST["tgdel"]<>"")
{
	$PostStr = $_POST["tgdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_tg where id='.$PostStr; 
	$Record = $db->execute($StrSql);
	echo "OK";
}



if ($_POST["deltg"]<>"")
{
	$PostStr = $_POST["deltg"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_tg_signup where id='.$PostStr; 
	$Record = $db->execute($strsql);
	echo "OK";

}




function replacestr($content)//XML导入时特殊字符转换
{
	$content=str_replace("","",$content);
	$content=str_replace("","",$content);
	$content=str_replace("","",$content);
	return $content;
}


if ($_POST["leaderuseradd"]<>"")
{
	$PostStr = $_POST["leaderuseradd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($loginname,$rights) = split ($PostDiv, $PostStr);
	$strsql='select * from smg_user where loginname="'.$loginname.'"';
	$Record1 = mysql_query($strsql) or die ("select error");
	$rows=mysql_fetch_array($Record1);
	$strsql='insert into smg_role (user_id,rights,createtime) values ("'.$rows['id'].'","'.$rights.'",now())';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}

if ($_POST["leaderuserdel"]<>"")
{
	$PostStr = $_POST["leaderuserdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	$strsql='delete from smg_role where id='.$PostStr;
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}

if ($_POST["shopdel"]<>"")
{
	$PostStr = $_POST["shopdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_shop where id='.$PostStr; 
	$Record = $db->execute($StrSql);
	$StrSql='delete from smg_shop_signup where tg_id='.$PostStr; 
	$Record = $db->execute($StrSql);
	$StrSql='delete from smg_shop_comment where tg_id='.$PostStr; 
	$Record = $db->execute($StrSql);
	echo "OK";
}

if ($_POST["shopcan"]<>"")
{
	
	$PostStr = $_POST["shopcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_shop set isadopt=0 where id='.$PostStr; 
	$Record = $db->execute($StrSql);
	echo "OK";

}


if ($_POST["shoppub"]<>"")
{
	$PostStr = $_POST["shoppub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_shop set isadopt=1 where id='.$PostStr; 
	$Record = $db->execute($StrSql);
	echo "OK";

}


if ($_POST["problemdel"]<>"")
{
	$PostStr = $_POST["problemdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_problem where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	$StrSql='delete from smg_question where problemid='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error2");
	$StrSql='delete from smg_questionitem where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["questiondel"]<>"")
{
	$PostStr = $_POST["questiondel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_question where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error2");
	$StrSql='delete from smg_questionitem where questionid='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["problemcan"]<>"")
{
	
	$PostStr = $_POST["problemcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_problem set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["problempub"]<>"")
{
	$PostStr = $_POST["problempub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_problem set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

?>
