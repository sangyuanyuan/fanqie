<?php require_once("../frame.php");
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -领导详细</title>
	<?php 
	css_include_tag('smg','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
</head>
<body>
	<? 
	include('../inc/top.inc.html');
	$deptid= (isset($_REQUEST['id']))? $_REQUEST['id'] : 37;
	?>
	<div id=bodys>
		<div id=l_left>
			<?php
			$depts = $db->query('select * from smg_dept order by priority asc');
			 
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
					$deptleaders = $db->query('select * from smg_leader where dept_id=' .$deptid .' order by priority asc');
					for($i=0;$i<2 && $i<count($deptleaders);$i++){?>
					<div class=context>
						<div class=pic><img width=84 height=113 border=0 src="<?php echo $deptleaders[$i]->photourl;?>" /></div>
						<div class=name><?php echo $deptleaders[$i]->name;?></a></div>
						<div class=identity><?php echo $deptleaders[$i]->description;?></div>		
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
		</div>
	</div>
	<? include('../inc/bottom.inc.html');?>
</body>
</html>