
<?php
	
	require "../frame.php";	
	use_jquery();
	$vote = new smg_vote_class();
	$a[1]='a';
	$a[3]='b';
	echo $a[1];
	#echo date('t');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
		<?php js_include_tag('pubfun');
			
		?>
		<link href="test.css" rel="stylesheet" type="text/css">
	</head>
	<?php 
	$vote->find(355);
	$vote->display();
	$vote->find(350);
	#$vote->display(array('submit_src' => '/images/btn/btn1.jpg','show_sub_title' => false));

	?>
	<body>		
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
	$(window).unload(function(){
		alert('unload');
	});
});
</script>
