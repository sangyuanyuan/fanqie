
<body style="margin:0px; background:#f3f3f3; font-size:12px;"><form method="post" enctype="multipart/form-data" action="upload.post.php" name="upload_form" id="upload_form" target="upload_frame">
					自定义：<input name="upfile" id="upfile" type="file">　<input id="tijiao" style="height:20px;" type="submit" value="上传">(建议图片大小50×50)
</form></body>
<? 
	$error="0";
	$extension=explode(".",$_FILES['upfile']['name']);
	if(isset($_FILES['upfile']['name']))
	{
		if(strtolower($extension[(count($extension)-1)])!="jpg"&&strtolower($extension[(count($extension)-1)])!="gif"&&strtolower($extension[(count($extension)-1)])!="png"){$error="1";}
		if($_FILES['upfile']['error']!=UPLOAD_ERR_OK){$error="1";}
		if($_FILES['upfile']['size']>=524288){$error="1";}
	
		if($error<>"0")
		{	
			echo '<script language=javascript>alert("图片过大，请压缩到500K以内再上传！")</script>';
			exit;
		}
	
		if($error=="0")
		{
	
			if($_FILES['upfile']['error']!=UPLOAD_ERR_OK||$_FILES['upfile']['error']!=UPLOAD_ERR_OK)
			{
				echo '<script language=javascript>alert("上传失败2！")</script>';
				exit;
			}
		
			$uploaddirall='hehun_images/baby/';
		
			if(strtolower($extension[(count($extension)-1)])=="jpg"){$ext=".jpg";}
			elseif(strtolower($extension[(count($extension)-1)])=="gif"){$ext=".gif";}
			else{$ext=".png";}
	
			$uploadfilenameall=date('Ymd').genRandomString(6).$ext;
			$upfilepathnameall=$uploaddirall.$uploadfilenameall;
				
			if(move_uploaded_file($_FILES['upfile']['tmp_name'],$upfilepathnameall))
			{
				echo "<script>window.parent.test('$upfilepathnameall');</script>";
			}
		
		}
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