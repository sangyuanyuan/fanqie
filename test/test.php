
<?php
	
	require "../frame.php";	
	$new = new table_class('smg_news');
	var_dump($_COOKIE);
	
	#$db->paginate('select * from smg_category');

	write_to_file('d:\tmp.txt', 'dfadsfsadfsdfdsfsd'. chr(13) .chr(10).'123123\r\n');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
		<?php js_include_tag('pubfun');?>
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
			
			<div>hide me</div>
		</form>
		<a href="#" id="test">test</a>
		<textarea id="fck1"></textarea>
		<div id="div1" style="overflow-y:auto;; overflow-x:hidden; width:50px; height:50px;">
			sadfl;asdf
			sadfl;asdf
			sadfl;asdf
			sadfl;asdf
			<p>
				<div id="div2" style="width:150px;">
					abc;
				</div>
			</p>
			
		</div>
	</body>
</html>
<script>
	
function str_length(str){
	return   str.replace(/[^\x00-\xff]/g,"**").length;
}
</script>
