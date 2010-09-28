<? 
	require_once('../../frame.php');
	require_once "../../fckeditor/fckeditor.php";
	$cookie=(isset($_COOKIE['smg_username']))? $_COOKIE['smg_username'] : '';
	$db=get_db();
	$sql="select * from smg_shopdp where username='".$cookie."'";
	$news = $db->query($sql);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('admin');
		validate_form("shop_add");
		js_include_once_tag('My97DatePicker/WdatePicker.js');
	?>
</head>
<body style="background:#E1F0F7">
	<form name="shop_add" id="uploadfiles" enctype="multipart/form-data" action="shop.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　添加商品</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">标　题</td><td width="695" align="left">　<input type="text" size="50" name=shop[title] id=title class="required"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;"  style="font-size:12px">
			<td>优先级</td><td align="left">　<input type="text" size="10" name=shop[priority] id=priority>(1-100)</td>
		</tr>
		<tr align="left" bgcolor="#f9f9f9" height="25px;"  style="font-size:12px">
			<td align="left">是否送到番茄网</td><td>　<input type="checkbox" id="sendfq" name="sendfq"><input type="hidden" id="issendfq" name="shop[issendfq]" value="1"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">最大数</td><td width="695" align="left">　<input type="text" size="50" name=shop[maxnum] id=maxnum>（选填）</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">开始时间</td><td width="695" align="left">　<input type="text" id="starttime"  name="shop[starttime]"  value=""  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{\'2020-10-01 12:00:00\'}'})" class="Wdate required" style="width:150px"/></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px; " style="font-size:12px">
			<td width="100">结束时间</td><td width="695" align="left">　<input type="text" id="endtime"  name="shop[endtime]"  value=""  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'starttime\')}',maxDate:'2020-10-01 12:00:00'})" class="Wdate required" style="width:150px"/>
</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"> <input type="hidden" name="MAX_FILE_SIZE" value="2097152">　<input name="upfile1" id="upfile1" type="file">(请上传200x160大小的图片，格式支持jpg、gif、png) <input type="hidden" name="MAX_FILE_SIZE1" value="2097152"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1 style="font-size:12px">
			<td>内　容</td><td align="left"> <?php show_fckeditor('shop[content]','Admin',true,"280","","98%");?></td>
		</tr>
		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><button id="submit" type="submit">发布商品</button></td>
		</tr>	
	</table>
			<input type="hidden" name="shop[shopdpid]" value="<? echo $news[0]->id;?>">
	</form>
</body>
</html>
<script>
	$(document).ready(function() {
	$("#sendfq").click(function() {
		var sendfq=$("#sendfq").attr("checked");
		if(sendfq==true)
		{
			$("#issendfq").attr("value","1");
		}
		else
		{
			$("#issendfq").attr("value","0");
		}
	});
});

</script>