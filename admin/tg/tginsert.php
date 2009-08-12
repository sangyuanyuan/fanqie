<?
parse_str($_SERVER['QUERY_STRING']);
include('../../frame.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php css_include_tag('admin','top','bottom');
		use_jquery();
		js_include_once_tag('admin','My97DatePicker/WdatePicker.js'); ?>
</head>
<body style="background:#E1F0F7">
	<form name="uploadfiles" id="uploadfiles" enctype="multipart/form-data" action="../upload.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　添加团购</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">标　题</td><td width="695" align="left"><input type="text" size="50" name=title id=title></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;"  style="font-size:12px">
			<td>优先级</td><td align="left"><input type="text" size="10" name=priority id=priority>(1-100)</td>
		</tr>
		<tr align="left" bgcolor="#f9f9f9" height="25px;"  style="font-size:12px">
			<td align="left">是否送到番茄网</td><td><input type="checkbox" id="issendfq" name="issendfq" onclick="tgcheck()" checked="checked"><input type="hidden" id="sendfq" name="sendfq" value="1"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">市场价格</td><td width="695" align="left"><input type="text" size="50" name=marketprice id=marketprice>元</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">价格</td><td width="695" align="left"><input type="text" size="50" name=price id=price>元</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">最大数</td><td width="695" align="left"><input type="text" size="50" name=maxnum id=maxnum></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">开始时间</td><td width="695" align="left"><input type="text" id="starttime"  name="starttime"  value=""  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{\'2020-10-01 12:00:00\'}'})" class="Wdate" style="width:150px"/></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px; " style="font-size:12px">
			<td width="100">结束时间</td><td width="695" align="left"><input type="text" id="endtime"  name="endtime"  value=""  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'starttime\')}',maxDate:'2020-10-01 12:00:00'})" class="Wdate" style="width:150px"/>
</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"><input name="upfile1" id="upfile1" type="file">(请上传200x160大小的图片，格式支持jpg、gif、png) <input type="hidden" name="MAX_FILE_SIZE1" value="2097152"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1 style="font-size:12px">
			<td>内　容</td><td align="left"><?php show_fckeditor('content','Admin',true,"280","","98%");?></td>
		</tr>
		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><button type="button" id="tg">发布团购</button></td>
		</tr>	
	</table>
			<input type="hidden" name="uptype" value="tginsert">
	</form>
</body>
</html>
