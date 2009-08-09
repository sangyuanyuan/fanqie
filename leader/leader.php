<?php require_once("../frame.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -领导详细</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="../js/smg.js"></script>
</head>
<body>
	<? 
	include('../inc/top.inc.html');
	
	require_once('../libraries/sqlrecordsmanager.php');
	
	
	$deptid= (isset($_REQUEST['id']))? $_REQUEST['id'] : 37;
	
	$sqlmanager = new SqlRecordsManager();
	?>
	<div id=bodys>
		<div id=l_left>
			<?php
			$depts = $sqlmanager->GetRecords('select * from smg_dept order by priority asc');
			 
			for($i=0;$i<count($depts);$i++)
			{
				if ($depts[$i]->id == $deptid)
				{
					//取得当前的部门
					$dept = $depts[$i];					
				}
				?>
				<a href="/leader/leader.php?id=<?php echo $depts[$i]->id;?>" class="<?php if($depts[$i]->id == $deptid) echo 'checked'; else echo 'unchecked';?>"><?php echo $depts[$i]->name;?> </a>
		<?php }?>
		</div>
		<div id=l_center>
			<div id=part1>
				<div class=title>领导在线</div>
				<div class=content>
					<? 
					//获得部门领导
					$deptleaders = $sqlmanager->GetRecords('select * from smg_leader where dept_id=' .$dept->id .' order by priority asc');
					for($i=0;$i<2 && $i<count($deptleaders);$i++){?>
					<div class=context>
						<div class=pic><a href="/leader/writeletter.php?leaderid=<?php echo $deptleaders[$i]->id;?>" target="_blank"><img width=84 height=113 border=0 src="<?php echo $deptleaders[$i]->photourl;?>" /></a></div>
						<div class=name><a href="/leader/writeletter.php?leaderid=<?php echo $deptleaders[$i]->id;?>" target="_blank"><?php echo $deptleaders[$i]->name;?></a></div>
						<div class=identity><a href="/leader/writeletter.php?leaderid=<?php echo $deptleaders[$i]->id;?>" target="_blank"><?php echo $deptleaders[$i]->description;?></a></div>		
					</div>
					<? }?>
				</div>
				<div class=content>
					<? for($i=2;$i<count($deptleaders);$i++){?>
					<div class=context>
						<div class=pic><a href="/leader/writeletter.php?leaderid=<?php echo $deptleaders[$i]->id;?>" target="_blank"><img width=84 height=113 border=0 src="<?php echo $deptleaders[$i]->photourl;?>" /></a></div>
						<div class=name><a href="/leader/writeletter.php?leaderid=<?php echo $deptleaders[$i]->id;?>" target="_blank"><?php echo $deptleaders[$i]->name;?></a></div>
						<div class=identity><a href="/leader/writeletter.php?leaderid=<?php echo $deptleaders[$i]->id;?>" target="_blank"><?php echo $deptleaders[$i]->description;?></a></div>		
					</div>
					<? }?>
				</div>
			</div>
			<div id=part2>
				<div class=title>部门介绍</div>
				<div class=content><?php echo $dept->description;?></div>
			</div>
			<div id=part3>
				<div class=title>领导活动<a href="/leader/leaderactlist.php" style="color:#000;">更多>></a></div>
					<? 
					$leaderactivitys = $sqlmanager->GetRecords('select a.*,b.name from smg_leader_activity a left join smg_leader b on a.leader_id = b.id order by createtime desc',1,5);
					for($i=0;$i<count($leaderactivitys);$i++){?>
					<div class=content>
						<a href="/leader/showleaderact.php?id=<?php echo $leaderactivitys[$i]->id;?>"><?php echo $leaderactivitys[$i]->content;?></a><div class=name><?php echo $leaderactivitys[$i]->name;?></div><div class=time><?php echo $leaderactivitys[$i]->createtime;?></div>	
					</div>
					<? }?>
			</div>
			<div id=part4>
				<div class=title>最近来信<a href="/leader/letterlist.php" target="_blank" style="color:#000;">更多>></a></div>
				<? 
				$letters = $sqlmanager->GetRecords('select * from smg_letter where isprivate = 0 order by priority asc',1,5);
				for($i=0;$i<count($letters);$i++){?>
				<div class=content><a href="/leader/viewletter.php?id=<?php echo $letters[$i]->id;?>"><?php echo $letters[$i]->content;?></a><div class=name><?php echo $letters[$i]->writer;?></div><div class=time><?php echo $letters[$i]->createtime;?></div></div>
				<? }?>
			</div>
		</div>
		<div id=l_right>
			<div class=title>信箱须知</div>
			<div id=top>为了集团更好发展，为了集团更美好的明天，欢迎各位同仁积极建言献策。</div>
			<? for($i=1;$i<=4;$i++){?>
			<div class=bottom><div class=bt>功能：</div>是SMG员工向集团领导提出意见或建议的重要渠道，更有效地实现领导和员工们的双向沟通。</div>
			<? }?>
		</div>
	</div>
	<? include('../inc/bottom.inc.html');?>
</body>
</html>