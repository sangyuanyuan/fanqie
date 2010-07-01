<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<? 	
		css_include_tag('index');
  ?>
</head>

<body>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="463" height="290" id="FLVPlayer">
	 <param name="movie" value="/flash/mediaplayer.swf" />
	 <param name="salign" value="lt" />
	 <param name="quality" value="high" />
	 <param name= "autoStart" value= "true"> 
	 <param name="wmode" value="opaque" />
	 <param name="scale" value="noscale" />
	 <param name="allowfullscreen" value="true" />
	 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=290&displaywidth=463&autostart=false" />
	 <embed src="/flash/mediaplayer.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=290&displaywidth=463&autostart=false" quality="high" scale="noscale" width="463" height="290" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</body>
</html>