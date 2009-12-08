<?
parse_str($_SERVER['QUERY_STRING']);
require_once('../../frame.php');

$db=get_db();
$sql="";
if($key1<>""){$sql=' and a.name like "%'.$key1.'%" ';}
if($id==""){$id=$key4;}

$strsql='select a.* from smg_activities_signup a where 1=1'.$sql;
$record=$db->query($strsql) or die ("select error1");
$record_num=count($record);

	
	$page_size=20;
	$rs_num=$record_num;
	if( $rs_num>0 ){
   		if( $rs_num < $page_size ){ $page_count = 1; }               
   		if( $rs_num % $page_size ){                                  
       		$page_count = (int)($rs_num / $page_size) + 1;           
   		}else{
       		$page_count = $rs_num / $page_size;                      
  		}
	}
	else{
   		$page_count = 0;
	}

	if ($page=="")  {$page=1;}
	if ($page>$page_count)  {$page=$page_count;}
	if ($page==0)  {$page=1;}
	if ($page<0)  {$page=1;}


$strsql='select a.*,d.name as dname from smg_activities_signup a left join smg_dept d on a.dept_id=d.id where 1=1'.$sql.' order by a.createtime desc limit '.($page-1)*$page_size.','.$page_size;
$record=$db->query($strsql) or die ("select error2");


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php use_jquery();
css_include_tag('admin');
js_include_tag('admin','total'); ?>
	<script>
		total("后台","other");	
	</script>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="8" width="795">　　　搜索　<input id=newskey1 type="text" value="<? echo $key1?>" onKeyPress="newskeypress()">
			<input id=newskey2 type="hidden"><input id=newskey3 type="hidden"><input id=newskey4 type="hidden" value="<? echo $id?>">
			<input type="button" value="搜索" style="border:1px solid #0000ff; height:21px" onClick="newskey()">
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>工号</td><td>姓名</td><td>部门</td><td>性别</td><td>年龄</td><td>手机号</td><td>报名时间</td><td>操作</td>
		</tr>
		<? for($i=0;$i<count($record);$i++){?>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" >
			<td><? echo $record[$i]->loginname;?></td>
			<td><? echo $record[$i]->name;?></td>
			<td><? echo $record[$i]->dname;?></td>
			<td><? if($record[$i]->sex==1){echo '男';}else if($record[$i]->sex==0){echo '女';}?></td>
			<td><? echo $record[$i]->age;?></td>
			<td><? echo $record[$i]->mobile;?></td>
			<td><? echo $record[$i]->createtime;?></td>
			<td><button class="delactivitier" param="<? echo $record[$i]->id;?>">删除</button></td>
		</tr>
		<? }?>
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;" align="center">
			<td colspan="8" width="800" class="pages">
				<a href="?key1=<? echo $key1?>&key2=<? echo $key2?>&key3=<? echo $key3?>&key4=<? echo $id?>&page=1">首页</a> 
				<a href="?key1=<? echo $key1?>&key2=<? echo $key2?>&key3=<? echo $key3?>&key4=<? echo $id?>&page=<? echo $page-1?>">上一页</a> 
				<a href="?key1=<? echo $key1?>&key2=<? echo $key2?>&key3=<? echo $key3?>&key4=<? echo $id?>&page=<? echo $page+1?>">下一页</a> 
				<a href="?key1=<? echo $key1?>&key2=<? echo $key2?>&key3=<? echo $key3?>&key4=<? echo $id?>&page=<? echo $page_count?>">末页</a> 
				共<? echo $rs_num?>条记录 
				第<? echo $page?>页/共<? echo $page_count?>页
				<select id=newspage onChange="newspage()">
					<? for($i=1;$i<=$page_count;$i++){?>
					<option <? if($page==$i){?>selected="selected"<? }?> value="<? echo $i;?>">第<? echo $i;?>页</option>
					<? }?>
				</select>
			</td>
		</tr>
	
	</table>
</body>
</html>