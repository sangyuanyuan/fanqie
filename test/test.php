<?php
	require "../frame.php";
	require_once "../fckeditor/fckeditor.php";
	require_once "../lib/upload_file_class.php";
	require_once "../lib/table_class.php";
	$oupload = new upload_file_class();
	$oupload->save_dir = '/upload/';
	$oupload->handle('file','filter_pic');	
	#echo phpinfo();
	#var_dump($_FILES);
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		var_dump($_POST);
		$menu = new table_class('smg_admin_menu');
		$menu->find($_POST['menu']['id']);
		#var_dump($menu);

		$menu->update_attributes($_POST['menu']);
		#var_dump($_POST['menu']);
		echo '<br>';
		#var_dump($menu);
		$menu->save();
	}else{
		
	}
	
	#$ret = $db->query();
	#$ret[0]->name;
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
			file1 :<input type="file" name="file">
			menu_name: <input type="text" name="menu[name]" value="<?php echo $menu->name;?>">
			menu_name: <input type="text" name="menu[href]" value="<?php echo $menu->href;?>">
			parent_id: <input type="text" name="menu[parent_id]" value="<?php echo $menu->parent_id;?>">
			<input type="hidden" name="menu[id]" value="1">
			<input type="submit" value="submit">
		</form>
		<?php #echo phpinfo();?>
	</body>
</html>