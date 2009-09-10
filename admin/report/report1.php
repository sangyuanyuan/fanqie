<?
parse_str($_SERVER['QUERY_STRING']);
require_once('../../frame.php');
$db=get_db();
$start=$_REQUEST['start'];
$end=$_REQUEST['end'];
if($start==""){$start=date('Y-m-d').' 00:00:00';}else{$start=$_REQUEST['start'].' 00:00:00';}
if($end==""){$end=date('Y-m-d').' 23:59:59';}else{$end=$_REQUEST['end'].' 23:59:59';}
$clickcount=$db->query("select sum(count) as totalcount from smg_total where platform<>'' and datetime>='".$start."' and datetime<='".$end."'");
$clickcount1=$db->query("select sum(count) as totalcount from smg_total where platform<>'' and datetime>='".$start."' and datetime<='".$end."' group by platform");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php css_include_tag('admin');
	use_jquery();
		js_include_once_tag('My97DatePicker/WdatePicker.js');?>
</head>
<body style="background:#E1F0F7">
<div style="margin:20px 0 0 20px">
	开始：<input type="text" id="starttime"  value="<? echo $_REQUEST['start'];?>" onfocus="WdatePicker()" style="width:150px"/>　　
	结束：<input type="text" id="endtime"   value="<? echo $_REQUEST['end'];?>"  onfocus="WdatePicker()"  style="width:150px"/>　　
	<a href="#" onClick="cx()" style="color:#0033FF">确定</a><br />
</div>
	<table border=1 style="margin-top:15px; background:#ffffff; " width="100%">
		<tr align="center"><td><?php echo $start;?></td><td><?php echo $end; ?></td></tr>
		<tr height="20" align="center">
			<td width="40%">平台</td><td width="40%">点击量</td>
		</tr>
		<tr height="20" align="center" style="color:red; font-weight:blod;">
			<td>网站</td><td>　<?php echo $clickcount[0]->totalcount; ?></td>
		</tr>
		<tr height="20" align="center">
			<td>新闻</td><td>　<?php echo $clickcount1[0]->totalcount; ?></td>
		</tr>
		<tr height="20" align="center">
			<td>服务</td><td>　<?php echo $clickcount1[2]->totalcount; ?></td>
		</tr>
		<tr height="20" align="center">
			<td>展示</td><td>　<?php echo $clickcount1[3]->totalcount; ?></td>
		</tr>
		<tr height="20" align="center">
			<td>交流</td><td>　<?php echo $clickcount1[5]->totalcount; ?></td>
		</tr>
		<tr height="20" align="center">
			<td>其他</td><td>　<?php echo $clickcount1[1]->totalcount; ?></td>
		</tr>
	</table>
</body>
</html>
<script language="javascript">
	function cx()
	{
		var start=$("#starttime").attr('value');
		var end=$("#endtime").attr('value');
		window.location.href="?start="+start+"&end="+end;
	}
</script>