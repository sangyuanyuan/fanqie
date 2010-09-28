<?php 
if($SYS_DEBUG && !$diableDebug) {
	$totaltime = $debugger->endTimer();
	$gzip = empty($SYS_ENV['enable_gzip']) ? '' : ', Gzip enabled';
	printf("<center><span  class=\"process\" > Processed in %f second(s), %d queries, %d cached %s</span></center>",$totaltime, $db->getTotalQueryNum(), $db->getTotalCacheNum(),$gzip);

	if(!empty($db->errorinfo)) {
		foreach($db->errorinfo as $var) {
			echo $var.'<br>';
		}
	
	}
	echo $db->report;

	if($db->debug) {
		echo "<B>Total Query Time:</B> ".$db->getTotalQueryTime();
		echo "<TABLE border=1>";
		foreach($db->getQueryLog() as $var) {
			printf("<TR><TD class=\"process\" align=left>%f</TD><TD align=left class=\"process\" ><B>%s</B>%s</TD></TR>",$var['time'],$var['cache'],$var['query']);
		}
		echo "</TABLE>";
		echo "<B>Total Run Time:</B> ".$totaltime;
		echo "<TABLE border=1>";
		foreach($debugger->node as $key=>$var) {
			printf("<TR><TD class=\"process\" align=left>%f</TD><TD align=left class=\"process\" >%s</TD></TR>",$var['time'],$debugger->node[$key-1]['name'].'->'.$var['name']);

 		}
		echo "</TABLE>";
	}
/*
$filename = "debug_log.txt";
if ($handle = fopen($filename, 'a')) {
	fwrite($handle, "\n\nDB:  ".$db->getTotalQueryTime()."      Total:  ".$totaltime);
	fclose($handle);
}

*/

}
?>