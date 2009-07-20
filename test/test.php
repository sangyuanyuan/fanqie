
<?php
	
	require "../frame.php";	
	use_jquery();
	var_dump($_COOKIE);
	require "../lib/smg_vote_class.php";
	$vote = new smg_vote_class();
	$vote->find(355);
	$vote->display();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
		<?php js_include_tag('pubfun');?>
	</head>
	<?php 

	?>
	<body>
		<form action="test.post.php" method="post">
			<input type="text" name="test[1][]">
			<input type="text" name="test[1][]">
			<input type="text" name="test[1][]">
			<input type="submit" value="submit">
		</form>
		<a href="#" id="test">test</a>
	</body>
</html>
<script>
	
function str_length(str){
	return   str.replace(/[^\x00-\xff]/g,"**").length;
}

$(function(){
	$('#test').bind('click',{'fuck':'fuck'},function(e){
		e.preventDefault();
		alert(e.data.fuck);
		//window.location.href = "?tags=" + $('input:first').val();
	});
});
</script>
