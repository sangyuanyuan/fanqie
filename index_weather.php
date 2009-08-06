<?
	require_once('frame.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<? 	
		use_jquery();
	  js_include_once_tag('weather');
  ?>
	
</head>
<body style="margin:0; background:#CD3301">
	<div id="weather_content" style="font-size:12px; margin-left:-24px; color:#ffffff; background:#CD3301; float:left; display:inline"></div>
	<script language="javascript">
		weather.init("weather_content");
	</script>
</body>
</html>

