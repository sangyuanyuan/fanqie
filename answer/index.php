<?php require_once('../frame.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('top.css','bottom.css');
		js_include_tag('total');
	?>
</head>
<body>
<?php
	require_once('../inc/top.inc.php');
?>
<div id=bodys>
 <div id=n_left style="width:995px; margin-top:10px;">
 	<div id=content2 style="width:955px;">深入学习科学发展观试题汇总<br><span style=" font-size:14px; color:#000000;">（出自番茄网深入科学发展观历届三分钟答题）</span><br>三分钟答题竞赛汇总</div>
	<div class=threetime id="gz" style="width:990px;"> 
		<br>答题规则：<br><br>
	1、	点击“开始答题”按钮，开始答题<br><br>
	2、	答题限制时间为3分钟，超过时限提交的问卷无效<br><br>
	3、	答题完毕后，系统将显示您的得分；获得60分以上的问卷视为及格，请按提示输入您的联系电话（短号码），我们将抽取部分员工给予奖品<br><br>
	4、	部门积分按以下规则累计：满分问卷部门加5分，优秀问卷（80分以上含）部门加3分，及格问卷（60分-70分）部门加1分<br><br>
	<br><br>

<div style="width:998px; text-align:center; float:left; display:inline;"><img style="cursor:pointer;" onclick="show()" src="/images/pic/start.jpg"><input type="hidden" name="userid" id="userid" value="<?php echo $cookieuserid; ?>"></div>
<div style="width:450px; margin-top:30px; margin-bottom:10px; padding:10px;float:left;display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">个人排行榜：</span><br>
	<? 
		$person=$sqlmanager->GetRecords("select * from smg_threetime  where issue=102 order by score desc,createtime desc");
		for($i=0; $i< 10; $i++)
		{
	?>
	<div style="width:400px; <? if($i< 3){?>color:red; font-weight:bold;<? }?>float:left; display:inline;"><? echo $person[$i]->username;?></div>
	<div style="<? if($i< 3){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $person[$i]->score;?></div>
	<? }?>
	<br><a style="margin-right:10px; float:right;" href="threetimeph1.php?type=person">更多</a>
</div>
<div style="width:450px; margin-top:30px; margin-bottom:10px; padding:10px;float:left;display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">部门排行榜：</span><br>
	<? 
		$deptscore=$sqlmanager->GetRecords('select d.name,sum(deptscore) as dscore from smg_threetime t left join smg_dept d on t.deptid=d.id where issue=102 group by t.deptid order by dscore desc,t.createtime desc');
		for($i=0; $i< 10; $i++)
		{
		?>
		<div style="width:400px; <? if($i< 3){?>color:red; font-weight:bold;<? }?>float:left; display:inline;"><? echo $deptscore[$i]->name;?></div>
		<div style="<? if($i< 3){?>color:red; font-weight:bold;<? }?> margin-right:10px;float:right; display:inline;"><? echo $deptscore[$i]->dscore;?></div>
		<? }?>
		<br><a style="margin-right:10px; float:right;" href="threetimeph1.php?type=dept">更多</a>
</div>

<div style="width:450px; margin-top:30px; margin-bottom:10px; padding:10px;float:left;display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">部门参与人数：</span><br>
	<? 
		$deptpeo=$sqlmanager->GetRecords('select d.name,count(*) as peonum from smg_threetime t left join smg_dept d on t.deptid=d.id where issue=102 group by t.deptid order by peonum desc,t.createtime desc');
		for($i=0; $i< 10; $i++)
		{
		?>
		<div style="width:400px; <? if($i< 3){?>color:red; font-weight:bold;<? }?>float:left; display:inline;"><? echo $deptpeo[$i]->name;?></div>
		<div style="<? if($i< 3){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $deptpeo[$i]->peonum;?></div>
		<? }?>
		<br><a style="margin-right:10px; float:right;" href="threetimeph1.php?type=person2">更多</a>
</div>
</div>
</div>
 </div>

</div>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>
