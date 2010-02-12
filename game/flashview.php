<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<? css_include_tag('smg','top','bottom');
	?>
</head>
<body>
<? 
	include('../inc/top.inc.html');
	$db = get_db();
	$strsql='select * from smg_game order by num desc,created_at desc';
	$percount = 30;
	$record=$db->paginate($strsql,$percount);
	$page = $_REQUEST['page'] ? $_REQUEST['page'] - 1 : 0;
?>
<div id=bodys>
<div id=n_left style="width:998px;">
 	<div id=content4 >
   <table bgcolor="#33CC66"  border="1" bordercolor="#FFFFFF" width="980"  >
		<tr align="center" style="font-weight:bold">
			<td align="center">排名</td>
			<td align="center">姓名</td>
			<td align="center">积分</td>
			<td align="center">时间</td>
			
		</tr>	
		<? 
			for($i=0;$i<count($record);$i++){
		?>
		<tr align="center">
			<td><?php echo $page * $percount + 1 + $i; ?></td>
			<td align="center"><? echo ShowStr($record[$i]->name);?></td>		
			<td align="center"><? echo ShowStr($record[$i]->num);?></td>
			<td align="center"><? echo ShowStr($record[$i]->created_at);?></td>
		</tr>				
		<?	
		}
		?>
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;" align="center">
			<td colspan="5"  class="pages">
				<?php paginate(''); ?>
			</td>
		</tr>
	
	</table>

 </div>

 
</div>
<? include('../inc/bottom.inc.html');
?>	
</body>
</html>
<?
function ShowStr($str)
{
	if($str==""){return "　";}
	else return $str;

}

?>