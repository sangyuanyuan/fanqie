<?
require_once('../../frame.php');
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: filename=fgl.xls');
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
    <td nowrap><b>发稿量</b></td>
</tr>
<?php

    for($i=0;$i<count($fgl);$i++){
echo '<tr align="center">';
        echo'<td nowrap>'.$fgl[$i]->name.'</td>';
        echo'<td nowrap>'.$fgl[$i]->a1.'</td>';
echo '</tr>';
    }
?>
</table>
</body>
</html>
