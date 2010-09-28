function goplay(url)
{
 var n="\n";
 var ss='<html><head><title>播放窗口</title></head><body topmargin="0" leftmargin="0">'+n
+'<object classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" id="WindowsMediaPlayer1" width="100%"height="100%">'+n
+' <param name="URL" value="'+url+'">'+n
+' <param name="rate" value="1">'+n
+' <param name="balance" value="0">'+n
+' <param name="currentPosition" value="0">'+n
+' <param name="defaultFrame" value>'+n
+' <param name="playCount" value="1">'+n
+' <param name="autoStart" value="-1">'+n
+' <param name="currentMarker" value="0">'+n
+' <param name="invokeURLs" value="-1">'+n
+' <param name="baseURL" value>'+n
+' <param name="volume" value="50">'+n
+' <param name="mute" value="0">'+n
+' <param name="uiMode" value="full">'+n
+' <param name="stretchToFit" value="0">'+n
+' <param name="windowlessVideo" value="0">'+n
+' <param name="enabled" value="-1">'+n
+' <param name="enableContextMenu" value="-1">'+n
+' <param name="fullScreen" value="0">'+n
+' <param name="SAMIStyle" value>'+n
+' <param name="SAMILang" value>'+n
+' <param name="SAMIFilename" value>'+n
+' <param name="captioningID" value>'+n
+' <param name="enableErrorDialogs" value="0">'+n
+' <param name="_cx" value="6350">'+n
+' <param name="_cy" value="6482">'+n
+'</object></body></html>';
 var wop = window.open("","iecn","width=320,height=320,resizable=yes");
 wop.document.write(ss);
 wop.document.close();
 wop.focus();
}