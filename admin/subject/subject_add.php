<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>添加专题</title>
		<?php
			require_once('../../frame.php');
			css_include_tag("subject.css","contextmenu/jquery.contextmenu","thickbox");			
			use_jquery_ui();

			js_include_tag('tooltip','jquery.contextmenu','subject_add','thickbox');
		?>
	</head>
	<body>
		<form method="post" name="add_subject" action="subject.post.php">
			<div id="top_info">
				<p>
					<label for="subject_name">专题名称:</label><input type="text" name="subject[name]" id="subject_name">					
				</p>
				<p>
					<label for="subject_identity">专题标识:</label><input type="text" name="subject[identity]" id="subject_identity">					
				</p>
				<p>
					<label>专题模板:</label>
					<select name="subject[templet_name]" id="templet_type">
						<option value="templet1" selected="selected">专题模板1</option>
						<option value="templet2" >专题模板2</option>
						<option value="templet3" >专题模板3</option>	
					</select>					
				</p>
				<p>
					<input type="hidden" name="operation_type" value="add">
					<input type="submit" value="提交">					
				</p>
			</div>
			<div id="layout" class="bder">
				<div id="lt_top" class="bder subject_pos">top</div>
				<div id="lt_left" class="bder subject_pos">left</div>
				<div id="lt_center" class="bder subject_pos">center</div>
				<div id="lt_right" class="bder subject_pos">right</div>
				<div style="clear:both"></div>
				<div id="lt_bottom" class="bder subject_pos">bottom</div>
			</div>
		</form>
	</body>
</html>
<script>

</script>