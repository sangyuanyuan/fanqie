
<?php
	
	require "../frame.php";	
	require "../lib/smg_vote_class.php";
	echo urlencode('是');
	echo urldecode($_REQUEST['tags']);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
		<?php js_include_tag('pubfun');?>
	</head>
	<?php 
	echo iconv('gbk','utf-8',$_REQUEST['tags']);
	?>
	<body>
		<form action="test.post.php" method="post">
			<input type="text" name="test[1][]">
			<input type="text" name="test[1][]">
			<input type="text" name="test[1][]">
			<input type="submit" value="submit">
		</form>
		<a href="?tags=是">test</a>
	</body>
</html>
<script>
	
function str_length(str){
	return   str.replace(/[^\x00-\xff]/g,"**").length;
}
</script>
