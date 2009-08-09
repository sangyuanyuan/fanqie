<?php
	include "../frame.php";
	use_jquery();
?>
<a href="#" id="test">test</a>
<script>
	$(function(){
		$('#test').click(function(e){
			e.preventDefault();
			alert('ok');
		});
		$('#test').click();
	});
</script>
