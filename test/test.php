<?php
	require "../frame.php";
	require "../lib/image_handler_class.php";
	require "../lib/smg_images_class.php";

	
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
			$image = new smg_images_class();
			$image->find(1);
			#var_dump($ret);
			$image->create_thumb('middle',50);
			echo $image->small;
			#print_r(count($image->thumb));
			echo "<br>";
		?>
		<div id="page">
			<?php paginate('/test/test.php','page');?>
		</div>
		<form enctype="multipart/form-data" action="test.php" method='post'>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 1024*1024*4;?>">
			file1 :<input type="file" name="file[]">
			file1 :<input type="file" name="file[]">
			menu_name: <input type="text" name="menu[name]" value="<?php echo $menu->name;?>">
			menu_name: <input type="text" name="menu[href]" value="<?php echo $menu->href;?>">
			parent_id: <input type="text" name="menu[parent_id]" value="<?php echo $menu->parent_id;?>">
			<input type="hidden" name="menu[id]" value="1">
			<input type="submit" value="submit">
		</form>
		<?php #echo phpinfo();?>
	</body>
</html>