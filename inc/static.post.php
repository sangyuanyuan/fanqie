<? $full_path='http://'.$_SERVER['HTTP_HOST'].'/inc/top.inc.php';
	$fcontent="";
	$fp= fopen($full_path,'r');
	while(!feof($fp))
	{
  		$fcontent=$fcontent.fgets($fp,4096);
	}
	fclose($fp);
	$fcontent=StrChar($fcontent);
	$filename='../../inc/top.inc.php';
	$handle=fopen($filename,"wt");
	fwrite($handle,$fcontent);
	fclose($handle);
?>