<?
require_once('../frame.php');
parse_str($_SERVER['QUERY_STRING']);
$db=get_db();
$sql="";
if($key1<>""){$sql=' and u.name like "%'.$key1.'%" ';}
$strsql='select s.*,u.loginname ,u.nickname from smg_leader_role s left join smg_user_real u on s.user_id=u.id where 1=1'.$sql.' order by createtime desc';
$rows=$db->paginate($strsql,20);
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php css_include_tag('admin');
		use_jquery();
		js_include_once_tag('admin');?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="5" width="795">搜索　<input id=newskey1 type="text" value="<? echo $key1?>">
			<input id=newskey2 type="hidden">
			<input type="button" value="搜索" style="border:1px solid #0000ff; height:21px" id="searchinput">
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="5">用户名　<input id=loginname size="50" type="text">　选择权限　<select id="rights" name="rights"><option value="查看">查看</option><option value="管理员">管理员</option></select>　<input type="button" value="添加" id="addleaderuser" style="border:1px solid #0000ff; height:21px"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td width="240">用户名</td><td width="260">昵称</td><td width="50">权限</td><td width="165">创建时间</td><td width="130">操作</td>
		</tr>
		<? for($i=0;$i<count($rows);$i++){?>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" >
			<td><? echo $rows[$i]->loginname;?></td>
			<td><? echo $rows[$i]->nickname;?></td>
			<td><? echo $rows[$i]->rights;?></td>
			<td><? echo $rows[$i]->createtime;?></td>
			<td><span style="cursor:pointer" id="delleaderuser" name="<?php echo $rows[$i]->id;?>">删除</span></td>
		</tr>
		<? }?>
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;" align="center">
			<td colspan="5" width="800" class="pages">
				<?php paginate('');?>
			</td>
		</tr>
	</table>
	<input id=deptid value="<? echo $id?>" type="hidden">
</body>
</html>