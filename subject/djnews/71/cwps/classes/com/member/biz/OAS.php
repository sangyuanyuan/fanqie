<?php
function findFowardOAS($url, $sId='')
{
	$sId = empty($sId) ? "&sId=CWPS::" : "&sId=CWPS::".$sId;
	$pos = strpos($url, 'OAS::');
	if ($pos === false) {
		return false;
	} else {
		$url = substr($url, 5);
		$pos = strpos($url, '?');
		if ($pos === false) {
			$url = $url."?".$sId;
		} else 	$url = $url.$sId;

		return $url;
	}

}

function findFowardAdminOAS($url, $sId='')
{
	$pos = strpos($url, 'OAS::');
	if ($pos === false) {
		return false;
	} else {
		$url = substr($url, 5);
		$pos = strpos($url, '?');
		if ($pos === false) {
			$url = $url."?&cwps_adminsid=CWPS::".$sId;
		} else 	$url = $url."&cwps_adminsid=CWPS::".$sId;

		return $url;
	}

}
?>