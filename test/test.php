<?php
	require "../frame.php";
	require_once "../fckeditor/fckeditor.php";
	require_once "../lib/upload_file_class.php";
	require_once "../lib/table_class";
	$oupload = new upload_file_class();
	$oupload->save_dir = '/upload/';
	$oupload->handle('file');	
	#echo phpinfo();
	#var_dump($_FILES);
	$menu = new acitive_record();
	$menu->update_attributes($_POST['menu']);
	$menu->save();
	$ret = $db->query();
	$ret[0]->name;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
	</head>
	<body>
		<a href="/test/test.php">test</a>
		<?php 
			use_jquery();
			$db = get_db();
			

			echo "<br>";
		?>
		<div id="page">
			<?php paginate('/test/test.php','page');?>
		</div>
		<form enctype="multipart/form-data" action="test.php" method='post'>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 1024*1024*4;?>">
			file1 :<input type="file" name="file[]">
			file2 :<input type="file" name="file[]">
			menu_name: <input type="text" name="menu['name']">
			menu_name: <input type="text" name="menu['url']">
			<input type="submit" value="submit">
		</form>
		<?php #echo phpinfo();?>
	</body>
</html>