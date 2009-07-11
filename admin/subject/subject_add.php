<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>添加专题</title>
		<?php
			require_once('../../frame.php');
			#css_include_tag("subject.css","contextmenu/jquery.contextmenu","thickbox");			
			use_jquery();
			validate_form('form_add_subject');
			#js_include_tag('tooltip','jquery.contextmenu','admin/subject_add','thickbox');
		?>
	</head>
	<body>
		<form method="post" name="add_subject" id="form_add_subject" action="subject.post.php">
			<div id="top_info">
				<p>
					<label for="subject_name">专题名称:</label><input type="text" name="subject[name]" id="subject_name" class="requiered">					
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
					<label for="description">描述</label>
					<textarea name="subject[description]"></textarea>
				<p>
					<input type="submit" value="提交">					
				</p>
			</div>			
		</form>
	</body>
</html>
<script>

</script>