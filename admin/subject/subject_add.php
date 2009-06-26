<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>添加专题</title>
		<?php
			require_once('../../frame.php');
			css_include_tag("subject.css","contextmenu/jquery.contextmenu","thickbox");			
			use_jquery();

			js_include_tag('tooltip','jquery.contextmenu','subject_add','thickbox');
		?>
	</head>
	<body>
		<div id="top_info">
			
		</div>
		<div id="layout" class="bder">
			<div id="lt_top" class="bder subject_pos">top<a href="#" title="one">a</a></div>
			<div id="lt_left" class="bder subject_pos">left<a href="#" title="two" title"what" id="bs">b</a></div>
			<div id="lt_center" class="bder subject_pos">center</div>
			<div id="lt_right" class="bder subject_pos">right</div>
			<div style="clear:both"></div>
			<div id="lt_bottom" class="bder subject_pos">bottom</div>
		</div>
	</body>
</html>
<script>
	$(function(){
		//$("#lt_top").bstip();
		//$("#bs").bstip();
		$('#layout').contextMenu(menu1);
		$('.subject_pos').contextMenu(menu1);
	});
</script>