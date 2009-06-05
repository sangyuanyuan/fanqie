<?php
	require "../frame.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
	</head>
	<body>
		<?php 
			js_include_once_tag('jquery-1.3.2.min');
			$db = get_db();	
			$total_count = 0;
			$ret = $db->paginate('select * from users where id <100',5);
			
			echo "<br>";

		?>
		<div id="page">
			<?php paginate('/test/test.php','page');?>
		</div>
	
	</body>
</html>