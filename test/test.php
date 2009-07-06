
<?php
	require "../frame.php";	
	use_jquery();
	$cate = new smg_category_class();
	$cate->echo_jsdata();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
	</head>
	<body>
<img src="/upload/images/ViZZxhqVQK.jpg" width=20 height=20 border=0>
		<?php 

?>
		<form id="test_form" action="/login/login.post.php" method="post">
			name:<input type="text" name="login_text" id="name" class="required">
			password:<input type="password" name="password_text">
			<input type="submit" value="submit">
			<input type="checkbox" name="checkbox" id="checkbox">
			<input type="hidden" name="hidden" value="a">
		</form>
		<a href="#" id="test">test</a>
	</body>
</html>
<script>
	//var a = new Array(1,2);
	$('#test').click(function(e){
		
		alert($('#checkbox').attr('checked'));
	});

</script>
