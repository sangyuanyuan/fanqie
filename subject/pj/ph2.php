<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php css_include_tag('smg','top','bottom'); ?>   
</head>
<body>
<?
  $id=$_REQUEST['id'];
  $sql1=' and (created_at >="2009-02-01 00:00:00" and created_at<="2009-02-28 23:59:59" )';
  $sql2=' and (created_at >="2009-02-01 00:00:00" and created_at<="2009-02-28 23:59:59" )';	
	include('../../inc/top.inc.html');
	if($id==1)
	{
		$strsql1='select *,(n1+v1+p1) as a1,(n2+v2+p2) as a2  from (select a.name,ifnull(b.allcounts,0) as n1,ifnull(c.counts,0) as n2,ifnull(p1allcounts,0) as p1,ifnull(p2counts,0) as p2,ifnull(v1allcounts,0) as v1,ifnull(v2counts,0) as v2 from smg_dept a left join
		(select count(dept_id) as allcounts,dept_id from smg_news where is_recommend=1  '.$sql1.'  group by dept_id) b on a.id=b.dept_id left join  (select count(dept_id) as counts,dept_id from smg_news where is_adopt=1  '.$sql1.' group by dept_id) c on b.dept_id = c.dept_id
		left join (select count(dept_id) as p1allcounts,dept_id from smg_images where is_recommend=1  '.$sql2.'  group by dept_id) p1 on a.id=p1.dept_id left join  (select count(dept_id) as p2counts,dept_id from smg_images where is_adopt=1 '.$sql2.'  group by dept_id) p2 on p1.dept_id = p2.dept_id
		left join (select count(dept_id) as v1allcounts,dept_id from smg_video where is_recommend=1  '.$sql2.'  group by dept_id) v1 on a.id=v1.dept_id left join  (select count(dept_id) as v2counts,dept_id from smg_video where is_adopt=1  '.$sql2.' group by dept_id) v2 on v1.dept_id = v2.dept_id
		order by b.allcounts desc) tb order by a1 desc';
		$click_count=$db->paginate($strsql1,20);	
	}
	else{
		$sql11=' and (n.created_at >="2009-02-01 00:00:00" and n.created_at<="2009-02-28 23:59:59" )';
		$sql12=' and (n.created_at >="2009-02-01 00:00:00" and n.created_at<="2009-02-28 23:59:59" )';
		$strsql="select a.*,sum(countnum) as num from (select d.name,sum(n.clickcount) as countnum from smg_dept d left join smg_news n on d.id=n.dept_id and d.id<>47 and is_recommend=1 ".$sql11." group by n.dept_id union select d.name,sum(n.clickcount) as countnum from smg_dept d left join smg_video n on d.id=n.dept_id and d.id<>47 and is_recommend=1 ".$sql12." group by n.dept_id) as a group by name order by num desc";
		$fwcount=$db->paginate($strsql,20);
	}
	 
?>
<div id=bodys>
 <div id=n_left style="width:995px; margin-top:10px; padding-top:10px;">
 	<? if($id==1){?>
 	<a href="ph1.php?id=1">一月发稿量排行榜</a> <a href="ph2.php?id=1">二月发稿量排行榜</a> <a href="ph3.php?id=1">三月发稿量排行榜</a>
 	<? }else{?>
 		<a href="ph1.php?id=2">一月点击量排行榜</a> <a href="ph2.php?id=2">二月点击量排行榜</a> <a href="ph3.php?id=2">三月点击量排行榜</a>
 	<? }?>
<div style="width:450px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<? if($id==1){ ?><span style="width:450px; font-size:20px; font-weight:bold; text-align:center; line-height:25px; float:left;">一季度发稿量排行榜</span><br><br><span style="color:red; font-size:16px; font-weight:bold;">排行榜：</span><br><? } else{?>
	<span style="width:450px; font-size:20px; font-weight:bold; text-align:center; line-height:25px; float:left;">一季度点击量排行榜</span><br><br><span style="color:red; font-size:16px; font-weight:bold;">排行榜：</span><br>
	<? }?>
	<? if($id==1){ 
		
	for($i=0;$i<count($clickcount);$i++){
		?>
	
	<div style="width:400px; margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $click_count[$i]->name;?></div>
	<div style="width:50px; margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> float:right; display:inline;"><? echo $click_count[$i]->a1;?></div>
	<?} } else{
		for($i=0;$i<count($fwcount);$i++){
		?>
		<div style="width:400px; margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $fwcount[$i]->name;?></div>
		<div style="width:50px; margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> float:right; display:inline;"><? echo $fwcount[$i]->num;?></div>
	<? }}?>
	<div class="pageurl">
         <?php 
	          echo paginate("");   
         ?>
   </div>
</div>
</div>
<? include('../../inc/bottom.inc.html');
?>	
</body>
</html> 