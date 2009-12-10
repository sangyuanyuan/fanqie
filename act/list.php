
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -献血报名情况</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<?php require_once('../frame.php');
		css_include_tag('news_news_list','top','bottom');
		use_jquery();
		js_include_once_tag('total'); ?>
	<script>
		total("献血报名情况","news");
	</script>
</head>
<body>
	<? 
		$cookie=(isset($_COOKIE['smg_userid'])) ? $_COOKIE['smg_userid'] : 0;
		$db=get_db();
		$dept=$db->paginate('select a.name as realname,d.name from smg_activities_signup a left join smg_dept d on a.dept_id=d.id order by a.id',20);
		require_once('../inc/top.inc.html');
	?>
	
	<div id=bodys>
		<div style="width:150px; height:22px; margin-left:350px; margin-bottom:10px; line-height:22px; font-size:18px; font-weight:bold; text-align:center; float:left; display:inline;">姓名</div><div style="width:495px; height:22px; margin-bottom:10px; line-height:22px; font-size:18px; font-weight:bold; text-align:left; float:right; display:inline;">部门</div>
		<?php for($i=0;$i<count($dept);$i++){ ?>
			<div style="width:150px; height:20px; margin-left:350px; margin-top:5px; line-height:20px; text-align:center; float:left; display:inline;"><?php echo $dept[$i]->realname; ?></div><div style="width:495px; height:20px; margin-top:5px; line-height:20px; text-align:left; float:right; display:inline;"><?php echo $dept[$i]->name; ?></div>
		<?php } ?>
		<div style="width:980px; height:20px; text-align:center; float:left; display:inline;"><?php paginate('');?></div>
	</div>
	<?php require_once('../inc/bottom.inc.php'); ?>
</body>
</html>