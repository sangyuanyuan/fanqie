<?
parse_str($_SERVER['QUERY_STRING']);
require_once('../../frame.php');
use_jquery();
$shop = new table_class("smg_shop");
$shop_record = $shop->find("all",array('conditions' => 'id='.$id));

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin');
		validate_form("shop_edit");
		js_include_once_tag('My97DatePicker/WdatePicker.js');
		js_include_tag('admin_pub');
	?>
</head>
<body style="background:#E1F0F7">
	<form name="shop_edit" id="uploadfiles" enctype="multipart/form-data" action="shop.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　修改商品</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">标　题</td><td width="695" align="left">　<input type="text" size="50" name=shop[title] id=title value="<? echo $shop_record[0]->title;?>" class="required"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;"  style="font-size:12px">
			<td>优先级</td><td align="left">　<input type="text" size="10" name=shop[priority] id=priority value="<? if($rows['priority']=="100"){ echo "";}else{ echo $rows['priority'];}?>">(1-100)</td>
		</tr>
		<tr align="left" bgcolor="#f9f9f9" height="25px;"  style="font-size:12px">
			<td align="left">是否送到番茄网</td><td>　<input type="checkbox" id="sendfq" name="sendfq" <? if($shop_record[0]->issendfq==1){?>checked="checked"<? }?>><input type="hidden" id="issendfq" name="shop[issendfq]" value="1"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">最大数</td><td width="695" align="left">　<input type="text" size="50" name=shop[maxnum] id=maxnum value="<? echo $shop_record[0]->maxnum;?>"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-size:12px">
			<td width="100">开始时间</td><td width="695" align="left">　<input type="text" id="starttime"   name="shop[starttime]"  value="<? echo $shop_record[0]->starttime;?>"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{\'2020-10-01 12:00:00\'}'})" class="Wdate required" style="width:150px"/></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px; " style="font-size:12px">
			<td width="100">结束时间</td><td width="695" align="left">　<input type="text" id="endtime"  class="required" name="shop[endtime]"  value="<? echo $shop_record[0]->endtime;?>"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'starttime\')}',maxDate:'2020-10-01 12:00:00'})" class="Wdate required" style="width:150px"/>
</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"> <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> <input name="upfile1" id="upfile1" type="file" value="<? echo $rows['photourl'];?>">(请上传200x160大小的图片，格式支持jpg、gif、png) <input type="hidden" name="MAX_FILE_SIZE1" value="2097152"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1 style="font-size:12px">
			<td>内　容</td><td align="left"><?php show_fckeditor('shop[content]','Admin',true,"280",$shop_record[0]->content,"98%");?></td>
		</tr>
		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><button type="submit" id="submit" >发布商品</button></td>
		</tr>	
	</table>
			<input type="hidden" name="type" id="type" value="edit">
			<input type="hidden" name=tgid id=tgid value="<? echo $id?>">
			
	</form>
</body>
</html>
