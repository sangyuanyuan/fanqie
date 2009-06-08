<?php
	require "../frame.php";
	require_once "../fckeditor/fckeditor.php";
	require_once "../lib/upload_file_class.php";
	$oupload = new upload_file_class();
	$oupload->handle('file');	
	#var_dump($oupload);
	var_dump($_FILES);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
	</head>
	<body>
		<?php 
			use_jquery();
			$db = get_db();	
			$total_count = 0;
			$ret = $db->paginate('select * from users where id <100',5);
			$a1 = array ('a1','a2');
			$b1 = array('b1','b2');
			$a1 = array_merge($a1, $b1);
			var_dump($a1);
			echo "<br>";
		?>
		<div id="page">
			<?php paginate('/test/test.php','page');?>
		</div>
		<form enctype="multipart/form-data" action="test.php" method='post'>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 1024*1024*4;?>">
			file1 :<input type="file" name="file">

			<input type="submit" value="submit">
		</form>
		<?php #echo phpinfo();?>
	</body>
</html>