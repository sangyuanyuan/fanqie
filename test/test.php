
<?php
	
	require "../frame.php";	
	use_jquery();
	$vote = new smg_vote_class();
	$a[1]='a';
	$a[3]='b';
	echo date('Y-m-d',strtotime('1 month')) .';' . date('Y-m-d',strtotime('-1 month'));;
	#echo date('t');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
		<?php js_include_tag('pubfun');
			
		?>
		<div>
			<input id="test" type="text" disabled="false">
		</div>
		<link href="test.css" rel="stylesheet" type="text/css">
	</head>
	<?php 


	?>
	<body>		
	</body>
</html>
<script>
	
function str_length(str){
	return   str.replace(/[^\x00-\xff]/g,"**").length;
}

$(function(){
	$('#test').attr('disabled',false);
});
</script>
