<?
parse_str($_SERVER['QUERY_STRING']);
require_once('../../frame.php');
use_jquery();
$db=get_db();
$cookie= (isset($_COOKIE['smg_username'])) ? $_COOKIE['smg_username'] : '';
if($cookie=="")
{?>
	<script>
		$(document).ready(function() {
			alert("请登录以后再操作!");
			window.location.href="/login/login.php";
		});
	</script>
<?
	exit;
}
$strsql='select * from smg_shop where shopdpid=(select id from smg_shopdp where username="'.$cookie.'") order by createtime desc';
$rows=$db->paginate($strsql,20);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		validate_form("shop_edit");
		js_include_once_tag('My97DatePicker/WdatePicker.js');
		js_include_tag('admin');
	?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25" style="font-weight:bold;">
			<td colspan="5" width="795">　　　<a href="shopinsert.php?id=<? echo $shopid;?>" style="color:#0000FF">发布商品</a>　　　　　　
			
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25" style="font-weight:bold; ">
			<td width="225">标题</td><td width="130">开始时间</td><td width="130">结束时间</td><td width="100">购买情况</td><td width="210">操作</td>
		</tr>
		<? for($i=0;$i<count($rows);$i++){?>
		<tr align="center" bgcolor="#f9f9f9" height="22" style="font-size:12px;" >
			<td><a style="color:#000000; text-decoration:none" target="_blank" href="/shop/splist.php"><? echo $rows[$i]->title;?></td>
			<td><? echo $rows[$i]->starttime;?></td>
			<td><? echo $rows[$i]->endtime;?></td>
			<td><a href="shoplist.php?id=<? echo $rows[$i]->id;?>" style="color:#000000">查看</a></td>
			<td><? if($rows[$i]->isadopt==1){?><span style="color:#FF0000;cursor:pointer" class="shopcan" name="<? echo $rows[$i]->id;?>">撤消</span><? }?>
				<? if($rows[$i]->isadopt==0){?><span style="color:#0000FF;cursor:pointer" class="shoppub" name="<? echo $rows[$i]->id;?>">发布</span><? }?>
				 <a href="shopupdate.php?id=<? echo $rows[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				 <span style="cursor:pointer" class="shopdel" name="<? echo $rows[$i]->id;?>">删除</span> 
			</td>
		</tr>
		<?  }?>
		<tr bgcolor="#f9f9f9" height="25" style="font-weight:bold; " align="center">
			<td colspan="5" width="800" class="pages">
				<?php paginate(""); ?>
			</td>
		</tr>
	
	</table>
</body>
</html>