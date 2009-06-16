<?php
	require "../frame.php";

	#$ret = $db->query();
	#$ret[0]->name;
	validate_form('test_form');
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
	</head>
	<body>
		<form id="test_form">
			name:<input type="text" name="name" id="name" class="required">
			<input type="submit" value="submit">
		</form>
	</body>
</html>