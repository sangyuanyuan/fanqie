<?php
function smsg($msg,$referer="",$delay='3'){
	global $_PUBAPI;
	if (empty($referer)) $referer=$_PUBAPI['DefaultReferer'];
	if (empty($referer)) $referer=$_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="refresh" content="<?php echo $delay; ?>;URL=<?php echo $referer; ?>" />
<title><?php echo $_PUBAPI['SiteName']; ?></title>
<style type="text/css">
<!--
body {
	margin: 0px;
}
#msg {
	border: 1px dashed #333333;
}
h1 {
	font-family: "宋体", Arial;
	color: #333333;
	font-size: 12px;
	line-height: 16px;
	font-style: normal;
	font-weight: normal;
} 
h1 a {
	color: #333333;
	text-decoration: none;
}
h1 a:hover {
	color: #0000FF;
	text-decoration: underline;
}
-->
</style>
</head>
<body>
<table width="300px" align="center" cellpadding="0" cellspacing="0" id="msg">
<tr><td><br />
<table width="100%" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle"><h1><?php echo $msg; ?></h1></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><h1><a href="<?php echo $referer; ?>">如果您的浏览器不支持跳转，请点此处</a></h1></td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
<?php die(); }
function gback($msg){
	global $_PUBAPI;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $_PUBAPI['SiteName']; ?></title>
<script language="javascript">
alert("<?php echo $msg; ?>");
history.go(-1);
</script>
</head>
</html>
<?php die(); } ?>