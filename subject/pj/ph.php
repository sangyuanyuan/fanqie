<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=uft-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -评奖排行</title>
	<?php css_include_tag('smg','top','bottom');?>
	
</head>
<body>
<?
  $id=$_REQUEST['id'];
  $sql1=' and (created_at >="2009-01-01 00:00:00" and created_at<="2009-03-31 23:59:59" )';
  $sql2=' and (created_at >="2009-01-01 00:00:00" and created_at<="2009-03-31 23:59:59" )';	
	include('../../inc/top.inc.html');
	if($id==1)
	{
		$strsql='select *,(n1+v1+p1) as a1,(n2+v2+p2) as a2  from (select a.name,ifnull(b.allcounts,0) as n1,ifnull(c.counts,0) as n2,ifnull(p1allcounts,0) as p1,ifnull(p2counts,0) as p2,ifnull(v1allcounts,0) as v1,ifnull(v2counts,0) as v2 from smg_dept a left join
		(select count(dept_id) as allcounts,dept_id from smg_news where is_recommend=1  '.$sql.'  group by dept_id) b on a.id=b.dept_id left join  (select count(dept_id) as counts,dept_id from smg_news where is_adopt=1  '.$sql.' group by dept_id) c on b.dept_id = c.dept_id
		left join (select count(dept_id) as p1allcounts,dept_id from smg_images where is_recommend=1  '.$sql2.'  group by dept_id) p1 on a.id=p1.dept_id left join  (select count(dept_id) as p2counts,dept_id from smg_images where is_adopt=1 '.$sql2.'  group by dept_id) p2 on p1.dept_id = p2.dept_id
		left join (select count(dept_id) as v1allcounts,dept_id from smg_video where is_recommend=1  '.$sql2.'  group by dept_id) v1 on a.id=v1.dept_id left join  (select count(dept_id) as v2counts,dept_id from smg_video where is_adopt=1  '.$sql2.' group by dept_id) v2 on v1.dept_id = v2.dept_id
		order by b.allcounts desc) tb order by a1 desc';
		$clickcount=$db->paginate($strsql,20);	
	}
	else{
		$strsql='select * from smg_dept order by clickcount2 desc';
		$fwcount=$db->paginate($strsql,20);
	}
	 
?>
<div id=bodys>
 <div id=n_left style="width:995px; margin-top:10px;">

<div style="width:450px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">排行榜：</span><br>
	<? if($id==1){ ?>
	<div style="width:400px; margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $clickcount[$i]->name;?></div>
	<div style="margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $clickcount[$i]->a1;?></div>
	<? } else{?>
		<div style="width:400px; margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $fwcount[$i]->name;?></div>
		<div style="margin-top:5px; <? if($i< 3 && $pageindex==1){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $fwcount[$i]->clickcount2;?></div>
	<? }?>
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