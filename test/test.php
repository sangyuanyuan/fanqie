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
		<?php 
	var_dump($_COOKIE);
?>
		<form id="test_form" action="/login/login.post.php" method="post">
			name:<input type="text" name="login_text" id="name" class="required">
			password:<input type="password" name="password_text">
			<input type="submit" value="submit">
		</form>
	</body>
</html>
