<?php
	require_once('../../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_babyshowindex','top','bottom');
		use_jquery();
	  js_include_once_tag('total');
  ?>
	
</head>
<script>
total("首页","other");
</script>
<body>
<div id="ibody">
	<div id="ileft_t">
		<div id=pic>
			<a href=""><img src="/images/baby/1.jpg"></a>	
		</div>
		<div id=content>
			<?php for($i=0;$i<11;$i++){ ?>
			<div class=context><a target="_blank" href=""></a></div>
			<?php } ?>
		</div>
	</div>
	<div id=login>
		<div id=username><input type="text" id=login_text name=login_text ></div>
		<div id=password><input type="password" id=password_text name=password_text></div>
		<div id=logins>
			<div id=sub></div>
			<div id=reg></div>
		</div>
	</div>
	
</div>
</body>
</html>