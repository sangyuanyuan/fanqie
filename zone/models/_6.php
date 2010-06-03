<div style="float:left; width:290px;text-align: center; padding-top:5px;padding-bottom: 5px;">
<?php 
	$db = get_db();
	$video=$db->query("select * from smg_video where category_id=150 and is_adopt=1 order by priority asc,created_at desc limit 1");						
	
	if($db->record_count==1)
	{
	?>
	<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=170   width=286   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT> 
		<PARAM   NAME= "URL"   VALUE= "<?php echo $video[0]->online_url; ?>"> 
		<PARAM   NAME= "playCount"   VALUE= "1"> 
		<PARAM   NAME= "autoStart"   VALUE= "true"> 
		<PARAM   NAME= "invokeURLs"   VALUE= "false">
		<PARAM   NAME= "uiMode"   VALUE= "Full">
		<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
		<embed src="<?php echo $video[0]->online_url; ?>" align="baseline" border="0" width="286" height="170" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
	</OBJECT>
	<?php }else{ 
		$news = $db->query('select title,target_url from smg_news v left join smg_category c on v.category_id=c.id where c.category_type="news" and c.name="高清预告" and v.is_adopt=1 order by v.priority asc,created_at desc');
	?>
	<embed src="<?php echo $news[0]->target_url; ?>" quality="high" width="286" height="170" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>
	<?php } ?>
</div>