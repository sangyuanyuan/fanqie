<?
parse_str($_SERVER['QUERY_STRING']);
include('../../frame.php');
$db=get_db();
$sql="";
if($key1<>""){$sql=' and a.name like "%'.$key1.'%" ';}
if($id==""){$id=$key4;}

$strsql='select * from smg_tg_signup a where a.tg_id='.$id.$sql;
$rows=$db->paginate($strsql,20);

$total='select sum(num) as total from smg_tg_signup where tg_id='.$id;
$count=$db->query($total);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -团购后台</title>
	<?php css_include_tag('admin','top','bottom');
		use_jquery();
		js_include_once_tag('admin'); ?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="5" width="795">　　　　
			搜索　<input id=newskey1 type="text" value="<? echo $key1?>" >
				  <input id=newskey2 type="hidden">
				  <input id=newskey3 type="hidden">
			<select id=newskey4 style="width:100px">
				<option value="">发布状况</option>
				<option value="1" <? if($key4=="1"){?>selected="selected"<? }?>>已发布</option>
				<option value="0" <? if($key4=="0"){?>selected="selected"<? }?>>未发布</option>
			</select>
			<input id="searchinput" type="button" value="搜索" style="border:1px solid #0000ff; height:21px" >
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>姓名</td><td>部门</td><td>订购商品名称</td><td>订购数量</td><td>联系方式</td><td>订购时间</td><td>送货地址</td><td>备注</td><td>操作</td>
		</tr>
		<? for($i=0;$i<count($rows);$i++){?>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" >
			<td><? echo $rows[$i]->name;?></td>
			<td><? echo $rows[$i]->deptname;?></td>
			<td><? echo $rows[$i]->spname;?></td>
			<td><? echo $rows[$i]->num;?></td>
			<td><? echo $rows[$i]->phone;?></td>
			<td><? echo $rows[$i]->createtime;?></td>
			<td><? echo $rows[$i]->address;?></td>
			<td><? echo $rows[$i]->remark;?></td>
			<td><span style="color:blue; text-decoration:underline;" name="<? echo $rows['id'];?>">删除</span></td>
		</tr>
		<? }?>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" >
			<td colspan=2>总订购量</td>
			<td colspan=7><? echo $count[0]->total;?></td>
		</tr>	
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;" align="center">
			<td colspan="9" width="800" class="pages">
				<?php paginate(); ?>
			</td>
		</tr>
	
	</table>
</body>
</html>