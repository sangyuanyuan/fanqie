<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>添加专题</title>
		<?php
			require_once('../../frame.php');
			css_include_tag("subject.css","contextmenu/jquery.contextmenu");			
			use_jquery();
			js_include_tag('tooltip','jquery.contextmenu','subject_add');
		?>
	</head>
	<body>
		<div id="top_info">
			
		</div>
		<div id="layout" class="bder">
			<div id="lt_top" class="bder">top<a href="#" title="one">a</a></div>
			<div id="lt_left" class="bder">left<a href="#" title="two" title"what" id="bs">b</a></div>
			<div id="lt_center" class="bder">center</div>
			<div id="lt_right" class="bder">right</div>
			<div id="lt_bottom" class="bder">bottom</div>
		</div>
	</body>
</html>
<script>
	$(function(){
		//$("#lt_top").bstip();
		//$("#bs").bstip();
		$('#layout').contextMenu(menu1);
		$('#lt_top').contextMenu(menu1);
	});
</script>