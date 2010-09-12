<?
require_once('../../frame.php');
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: filename=djl.xls');
parse_str($_SERVER['QUERY_STRING']);
require_once('../../frame.php');
$db=get_db();
$start=$_REQUEST['start'];
$end=$_REQUEST['end'];
if($start==""){$start=date('Y-m-d').' 00:00:00';}else{$start=$_REQUEST['start'].' 00:00:00';}
if($end==""){$end=date('Y-m-d').' 23:59:59';}else{$end=$_REQUEST['end'].' 23:59:59';}
$sql11=' and (n.created_at between "'.$start.'" and "'.$end.'")';
$fgl=$db->query("select a.name,sum(countnum) as num from (select d.name,t.click_count as countnum from smg_dept d left join (select sum(n.click_count) as click_count,dept_id,n.created_at from smg_news n where n.is_recommend=1 ".$sql11." group by n.dept_id) t on d.id = t.dept_id union select d.name,t.click_count as countnum from smg_dept d left join (select sum(n.click_count) as click_count,dept_id,n.created_at from smg_news n where n.is_recommend=1 ".$sql11." group by n.dept_id) t on d.id=t.dept_id union select d.name,t.click_count as countnum from smg_dept d left join (select sum(n.click_count) as click_count,dept_id,n.created_at from smg_images n where n.is_recommend=1 ".$sql11." group by n.dept_id) t on d.id=t.dept_id) as a group by name order by num desc");
?>
<html>
<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<!--这一句很重要的，否侧生成的excel文件的内容中，中文是乱码的，当然前提是你的数据库也是utf8编码的-->

<title>PHP output Excel Example</title>

</head>

<body>
<table width="100%" border="1" align="center" cellspacing="1" cellpadding="1">
<tr align="center">
    <td nowrap><b>部门</b></td>
    <td nowrap><b>点击量</b></td>
</tr>
<?php

    for($i=0;$i<count($fgl);$i++){
echo '<tr align="center">';
        echo'<td nowrap>'.$fgl[$i]->name.'</td>';
        if($fgl[$i]->num!=""){
        echo'<td nowrap>'.$fgl[$i]->num.'</td>';
      	}
      	else
      	{
      		echo'<td nowrap>0</td>';	
      	}
echo '</tr>';
    }
?>
</table>
</body>
</html>
