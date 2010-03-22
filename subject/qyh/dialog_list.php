<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG - 三项教育 - 群英汇</title>
	<?php css_include_tag('qyh_dialog','qyh_top','qyh_bottom','qyh_right');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("专题-群英汇","other");
</script>
</head>
<body>
	<div id=ibody>	
		<?php include('inc/top.inc.php');?>
		<div id=qyh_dialog>
			<div id=ileft>
				<div id=l_b>
					<div id=title>对话实录</div>
					<?php for($i=0;$i<4;$i++){ ?>
					<div class=content>
						<div class=c_l></div>
						<div class=c_r>
							<div class=c_r_title>网友提问网友提问网友提问网友提问网友提问网友提问网友提问网友提问?</div>
							<div class=c_r_content>嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答嘉宾回答</div>
						</div>	
					</div>
					<div class=l_dash></div>
					<?php } ?>
				</div>
			</div>
			<?php $rightstyle="list"; ?>
			<div id=iright><?php include('inc/right.inc.php'); ?></div>
		</div>
		<?php include('inc/bottom.inc.php');?>
	</div>
</body>
</html>

