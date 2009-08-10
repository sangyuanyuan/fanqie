<?php 
	require_once('../frame.php');
	$type= $_REQUEST['type'];
	$page = $_REQUEST['page']
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer/index');
		js_include_tag('total');
	?>
</head>
<script>
	total("答题排名更多","server");	
</script>
<body>
<?php
	require_once('../inc/top.inc.php');
?>
<div id=bodys style="width:995px; margin:0 auto; margin-top:10px; line-height:20px;">
 <div id=n_left style="width:995px; margin-top:10px;">
 	<div id=content2 style="width:998px;">传媒集团深入学习实践科学发展观活动<br>三分钟答题竞赛</div>
	<? if($type=="person"){?>
<div style="width:600px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">个人排行榜：</span><br>
	<?php
		$db = get_db();
		$sql = "select * from smg_question_record  where r_type='btjd' order by point desc,created_at";
		$record = $db->paginate($sql,20);
		for($i=0; $i<count($record); $i++)
		{
	?>
	<div style="width:400px; margin-top:5px; <?php if($i<3&&$page==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $record[$i]->nick_name;?></div>
	<div style="margin-top:5px; <? if($i< 3&&$page==1){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $record[$i]->point;?></div>
	<? }?>
	<div class="pageurl">
        <?php paginate();?>
   </div>
</div>
<? }else if($type=="dept"){?>
<div style="width:600px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">部门排行榜：</span><br>
	<?php
		$db = get_db();
		$sql = 'select d.name,sum(dept_score) as dscore from smg_question_record t left join smg_dept d on t.dept_id=d.id where t.r_type="btjd" group by t.dept_id order by dscore desc,t.created_at desc';
		$record = $db->paginate($sql,20);
		for($i=0; $i<count($record); $i++)
		{
	?>
	<div style="width:400px; margin-top:5px; <?php if($i<3&&$page==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $record[$i]->name;?></div>
	<div style="margin-top:5px; <? if($i< 3&&$page==1){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $record[$i]->dscore;?></div>
	<? }?>
	<div class="pageurl">
        <?php paginate();?>
   </div>
</div>
<? }else if($type=="dept_person"){?>
<div style="width:600px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">部门参与人数：</span><br>
	<?php
		$db = get_db();
		$sql = 'select d.name,count(*) as peonum from smg_question_record t left join smg_dept d on t.dept_id=d.id where t.r_type="btjd" group by t.dept_id order by peonum desc,t.created_at desc';
		$record = $db->paginate($sql,20);
		for($i=0; $i<count($record); $i++)
		{
	?>
	<div style="width:400px; margin-top:5px; <?php if($i<3&&$page==1){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $record[$i]->name;?></div>
	<div style="margin-top:5px; <? if($i< 3&&$page==1){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $record[$i]->peonum;?></div>
	<? }?>
	<div class="pageurl">
        <?php paginate();?>
   </div>
</div>
<? }?>

</div>

<? include('../inc/bottom.inc.html');
?>	
</body>
</html>