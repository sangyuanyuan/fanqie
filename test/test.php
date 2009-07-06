
<?php
	require "../frame.php";	
	use_jquery();
	#$cate = new smg_category_class();
	#$cate->echo_jsdata();
	$category = new table_class('smg_category');
	$category->id = 30;
	$param = array('name' => '总裁奖12345','description' => '');
	$category->update_attributes($param);
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
			<select name="1" id="a">
				<option>1</option>
				<option>2</option>
			</select>
			<select name="2" id="2" class="cate">
				<option>2</option>
			</select>
			<div>hide me</div>
		</form>
		<a href="#" id="test">test</a>
	</body>
</html>
<script>
	//var a = new Array(1,2);
	$('#test').click(function(e){
		
		$('select:last').after('<select class="cate"><option >test</option></select>');
	});
	$('#a').change(function(){
		$('#a ~ .cate').remove();
	});
</script>
