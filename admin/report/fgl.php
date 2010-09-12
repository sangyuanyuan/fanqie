<?
parse_str($_SERVER['QUERY_STRING']);
require_once('../../frame.php');
$db=get_db();
$start=$_REQUEST['start'];
$end=$_REQUEST['end'];
if($start==""){$start=date('Y-m-d').' 00:00:00';}else{$start=$_REQUEST['start'].' 00:00:00';}
if($end==""){$end=date('Y-m-d').' 23:59:59';}else{$end=$_REQUEST['end'].' 23:59:59';}
$sql1=' and (created_at between "'.$start.'" and "'.$end.'")';
$fgl=$db->query('select s.name,s.a1 from (select *,(n1+v1+p1) as a1,(n2+v2+p2) as a2  from (select a.name,ifnull(b.allcounts,0) as n1,ifnull(c.counts,0) as n2,ifnull(p1allcounts,0) as p1,ifnull(p2counts,0) as p2,ifnull(v1allcounts,0) as v1,ifnull(v2counts,0) as v2 from smg_dept a left join
(select count(dept_id) as allcounts,dept_id from smg_news where is_recommend=1 '.$sql1.' group by dept_id) b on a.id=b.dept_id left join  (select count(dept_id) as counts,dept_id from smg_news where is_adopt=1 '.$sql1.' group by dept_id) c on b.dept_id = c.dept_id
left join (select count(dept_id) as p1allcounts,dept_id from smg_images where is_recommend=1 '.$sql1.' group by dept_id) p1 on a.id=p1.dept_id left join  (select count(dept_id) as p2counts,dept_id from smg_images where is_adopt=1 '.$sql1.' group by dept_id) p2 on p1.dept_id = p2.dept_id
left join (select count(dept_id) as v1allcounts,dept_id from smg_video where is_recommend=1 '.$sql1.' group by dept_id) v1 on a.id=v1.dept_id left join  (select count(dept_id) as v2counts,dept_id from smg_video where is_adopt=1 '.$sql1.' group by dept_id) v2 on v1.dept_id = v2.dept_id
order by b.allcounts desc) tb order by a1 desc) s');
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
	<a href="#" onClick="cx()" style="color:#0033FF">确定</a>　　<a href="fglxls.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>">生成XLS文件</a><br />
</div>
	<table border=1 style="margin-top:15px; background:#ffffff; " width="100%">
		<tr align="center"><td><?php echo $start;?></td><td><?php echo $end; ?></td></tr>
		<tr height="20" align="center">
			<td width="40%">部门</td><td width="40%">发稿量</td>
		</tr>
		<?php for($i=0;$i<count($fgl);$i++){ ?>
		<tr height="20" align="center">
			<td><?php echo $fgl[$i]->name; ?></td>
			<td><?php echo $fgl[$i]->a1; ?></td>
		</tr>
		<?php } ?>
		
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