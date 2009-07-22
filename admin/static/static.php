<? 
parse_str($_SERVER['QUERY_STRING']);
?>
<body style="background:#E1F0F7">
<?

function StrChar($str)
{	
	$str=str_replace(Chr(13).Chr(10),Chr(10),$str);
	return $str;
}


if($type=="index")
{
	$full_path='http://'.$_SERVER['HTTP_HOST'].'/index.php';
	$fcontent="";
	$fp= fopen($full_path,'r');
	while(!feof($fp))
	{
  		$fcontent=$fcontent.fgets($fp,4096);
	}
	fclose($fp);
	$fcontent=StrChar($fcontent);
	$filename='../../index.html';
	$handle=fopen($filename,"wt");
	fwrite($handle,$fcontent);
	fclose($handle);
  echo "首页静态执行成功<br>";

}

if($type=="top")
{
	$full_path='http://'.$_SERVER['HTTP_HOST'].'/inc/top.inc.php';
	$fcontent="";
	$fp= fopen($full_path,'r');
	while(!feof($fp))
	{
  		$fcontent=$fcontent.fgets($fp,4096);
	}
	fclose($fp);
	$fcontent=StrChar($fcontent);
	$filename='../../inc/top.inc.html';
	$handle=fopen($filename,"wt");
	fwrite($handle,$fcontent);
	fclose($handle);
  echo "顶部静态执行成功<br>";

}

if($type=="bottom")
{
	$full_path='http://'.$_SERVER['HTTP_HOST'].'/inc/bottom.inc.php';
	$fcontent="";
	$fp= fopen($full_path,'r');
	while(!feof($fp))
	{
  		$fcontent=$fcontent.fgets($fp,4096);
	}
	fclose($fp);
	$fcontent=StrChar($fcontent);
	$filename='../../inc/bottom.inc.html';
	$handle=fopen($filename,"wt");
	fwrite($handle,$fcontent);
	fclose($handle);
  echo "底部静态执行成功<br>";

}


if($type=="report")
{
	$full_path='http://172.27.203.88/rd/datacsmselect.asp';
	$fcontent="";
	$fp= fopen($full_path,'r');
	while(!feof($fp))
	{
  		$fcontent=$fcontent.fgets($fp,4096);
	}
	fclose($fp);
	$fcontent=StrChar($fcontent);
	
	$fcontent=str_replace('<li style="font-size:12px">','<li style="display:none">',$fcontent);
	$filename='../../index_report.html';
	$handle=fopen($filename,"wt");
	
	$fcontent='<meta http-equiv=Content-Type content="text/html; charset=gbk">'.$fcontent;
	fwrite($handle,$fcontent);
	fclose($handle);
  echo "收视率报表静态执行成功<br>";

}




?>
</body>