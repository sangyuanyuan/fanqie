<?php
	require_once('../../frame.php');
    $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>专题模板2</title>
	<?php
		css_include_tag('subject_templete/templet2');
	?>
</head>
<body>
	<div id=bodys>
		<?php include('top.inc.php');?>
		<div id=top>
			<div id=left>
				<div id=l1></div>
				<div id=l2>
					<div class=title></div>
				</div>
				<div id=l3>
					<div class=title></div>
				</div>
			</div>
			<div id=center>
				<div id=c1></div>
				<div id=c2></div>
			</div>
		</div>
		<? //include('inc/djbottom.inc.php');?>
	</div>
</body>
</html>