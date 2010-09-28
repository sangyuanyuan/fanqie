<?
parse_str($_SERVER['QUERY_STRING']);
include('../../frame.php');
$db=get_db();


$sql="";
if($key1<>""&&$key4==""){$sql=' where title like "%'.$key1.'%" ';}
if($key1<>""&&$key4<>""){$sql=' where title like "%'.$key1.'%" and isadopt='.$key4.' ';}
if($key1==""&&$key4<>""){$sql=' where isadopt='.$key4.' ';}


$strsql='select * from smg_tg  '.$sql.' order by priority asc, createtime desc';
$rows=$db->paginate($strsql,20);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -团购后台</title>
	<?php css_include_tag('admin','top','bottom');
		use_jquery();
		js_include_once_tag('admin','admin_pub');?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="6" width="795">　　　<a href="tginsert.php" style="color:#0000FF">发布团购</a>　　　　　　
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
			<td width="55">删/退</td><td width="225">标题</td><td width="130">开始时间</td><td width="130">结束时间</td><td width="100">团购情况</td><td width="210">操作</td>
		</tr>
		<? for($i=0;$i<count($rows);$i++){?>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" >
			<td><input style="width:12px;" type="checkbox" name="<?php echo $var_name;?>" value="<?php echo $record[$i]->id;?>"></td>
			<td><a style="color:#000000; text-decoration:none" target="_blank" href="/fqtg/fqtg.php?id=<? echo $rows[$i]->id;?>"><? echo $rows[$i]->title;?></td>
			<td><? echo $rows[$i]->starttime;?></td>
			<td><? echo $rows[$i]->endtime;?></td>
			<td><a href="tglist.php?id=<? echo $rows[$i]->id;?>" style="color:#000000">查看</a></td>
			<td><? if($rows[$i]->isadopt=="1"){?><span class="tgcan" style="color:#FF0000;cursor:pointer">撤消</span><input type="hidden" value="<?php echo $rows[$i]->id;?>"><? }?>
				<? if($rows[$i]->isadopt=="0"){?><span class="tgpub" style="color:#0000FF;cursor:pointer">发布</span><input type="hidden" value="<?php echo $rows[$i]->id;?>"><? }?>
				 <a href="tgupdate.php?id=<? echo $rows[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				 <span style="cursor:pointer" class="tgdel">删除</span><input type="hidden" value="<?php echo $rows[$i]->id;?>">
				<input type="text" class="priority"  name="<?php echo $rows[$i]->id;?>"  value="<?php if('100'!=$rows[$i]->priority){echo $rows[$i]->priority;};?>" style="width:40px;">
			</td>
		</tr>
		<?  }?>
		<tr class="tr3">
			<td colspan=6><button id="select_all">全选</button><button id="button_delete">删除/退回</button><?php paginate();?><button id=clear_priority>清空优先级</button><button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_tg">
	</table>
</body>
</html>