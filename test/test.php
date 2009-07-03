
<?php
	require "../frame.php";	
	#require_role();
	$_category = new smg_category_class();
	foreach ($_category->items as $v) {
		echo $v->name;
	}
	echo intval('a');
	echo category_id_by_name('test2');
	#$ret = $db->query();
	#$ret[0]->name;
	validate_form('test_form');
	copy_dir('../subject_templet/templet1','../subject/templet1',true);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
	</head>
	<body>

		<?php 

?>
		<form id="test_form" action="/login/login.post.php" method="post">
			name:<input type="text" name="login_text" id="name" class="required">
			password:<input type="password" name="password_text">
			<input type="submit" value="submit">
			<input type="hidden" name="hidden" value="a">
		</form>
		<a href="#" id="test">test</a>
	</body>
</html>
<script>
	//var a = new Array(1,2);
	$('#test').click(function(e){
		var a = $('input').serialize();
		alert(a);
	});

</script>
