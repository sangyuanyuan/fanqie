<?php

$I_publish_url = $this->_tpl_vars['PUBLISH_URL'];
$I_IndexID = $this->_tpl_vars['IndexID'];

$I_download_url = $this->_tpl_vars['Download'];
$I_download_url = str_replace("\r\n", "\n",  $I_download_url);
$I_download_url = str_replace("\r", "\n",  $I_download_url);

$I_download_urls = explode("\n", $I_download_url);
$i = 1;

if(!empty($this->_tpl_vars['LocalUpload'])) {
	echo  "<FONT face=Webdings  color=#ff8c00>8</FONT><a href='".$I_publish_url."download.php?id=".$I_IndexID."&url=local' target=_blank>本地下载</a><br>";
}
foreach($I_download_urls  as  $key=>$var){
	if(empty($var)) continue;

	echo  "<FONT face=Webdings  color=#ff8c00>8</FONT><a href='".$I_publish_url."download.php?id=".$I_IndexID."&url=".$key."' target=_blank>下载地址".$i."</a><br>";
	$i++;
}
					
				

?>