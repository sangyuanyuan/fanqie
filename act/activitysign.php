<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -报名</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="activity.js"></script>
	<?php require_once('../frame.php');
		session_start();
		setsession($_SERVER['HTTP_HOST']);
		use_jquery();
		js_include_once_tag('total');
				
	?>
	<script>
		total("报名","news");
	</script>
</head>
<body>
	<? 
		$cookie=(isset($_COOKIE['smg_userid'])) ? $_COOKIE['smg_userid'] : 0;
		$db=get_db();
		$dept=$db->query('select * from smg_dept order by id');
	?>
	<div id=bodys>
		<div id=activity_body>
			<div id=activity_title>请填写以下信息： </div>
			
			<div id=activitycontent>
				<form name="uploadfiles" id="uploadfiles" enctype="multipart/form-data" action="activity.post.php" method="post">	
				<table align="center">
					<tr>
						<td></td><td><input id="activities_id" name="activities_id" type="hidden" value="<?php echo $_REQUEST['id']; ?>"></td>
					</tr>
					<tr>
						<td>工号：</td>
						<td align="left"><input id="name" name="name" type="text" /></td>
					</tr>
					<tr>
						<td>部门：</td>
						<td align="left"><select id=dept_id name="dept_id">

					<option value="7" >总编室</option>
					<?php
						for($i=0;$i<count($dept);$i++){
							if($dept[$i]->id!='7'){
					?>
						<option value="<?php echo $dept[$i]->id;?>" ><?php echo $dept[$i]->name;?></option>
					<?php } }?>
				</select></td>
					</tr>
					<tr>
						<td>性别：</td>
						<td align="left"><input id="sex" name="sex" type="radio" checked="true"  value="1"/>男<input id="sex" name="sex" type="radio" value="0" />女</td>
					</tr>
					<tr>
						<td>联系电话：</td>
						<td align="left"><input id="phone" name="phone" type="text" />(请留长号码)</td>
					</tr>
					<tr>
						<td align="left"><input id="xb" name="xb" type="hidden" /><input type="hidden" id="userid" name="userid" value="<? echo $cookie;?>"></td>
					</tr>
					<tr><td></td><td><!--<button OnClick="signuppost()">提　交</button>--></td><td  align="center"><a href="list.php?id=<?php echo $_REQUEST['id']; ?>">查看报名情况</a></td></tr>
					<tr></tr>
				</table>
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>