<?php
	require_once('frame.php');
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
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="235" height="182" id="FLVPlayer">
 <param name="movie" value="/flash/mediaplayer.swf" />
 <param name="salign" value="lt" />
 <param name="quality" value="high" />
 <PARAM   NAME= "autoStart"   VALUE= "true"> 
 <param name="wmode" value="opaque" />
 <param name="scale" value="noscale" />
 <param name="allowfullscreen" value="true" />
 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" />
 <embed src="/flash/mediaplayer.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" quality="high" scale="noscale" width="235" height="182" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

<!--<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=245   width=235   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT> 
				<PARAM   NAME= "URL"   VALUE= "mms://172.27.202.23:5765/broadcast"> 
				<PARAM   NAME= "playCount"   VALUE= "1"> 
				<PARAM   NAME= "autoStart"   VALUE= "true"> 
				<PARAM   NAME= "invokeURLs"   VALUE= "false">
				<PARAM   NAME= "uiMode"   VALUE= "Full">
				<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
				<embed src="mms://172.27.202.23:5765/broadcast" align="baseline" border="0" width="288" height="230" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
			</OBJECT>
-->
</body>
</html>