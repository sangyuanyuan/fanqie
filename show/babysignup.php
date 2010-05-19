<?php require_once('../frame.php');
$db=get_db();
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网宝宝秀</title>
		<?php 
	css_include_tag('top','bottom');
	use_jquery();
	js_include_tag('total');
	?>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="baby.js"></script>
	<script>
		total("宝宝秀","show");	
	</script>
</head>
<body>
	<? 
		$dept=$db->query('select * from smg_dept where id not in (47,51) order by id;');
	?>
	<div id=bodys>
		<div id=activity_body>
			<div id=activity_title>请填写以下信息： </div>
			
			<div id=activitycontent>
				<form name="signup" id="uploadfiles" enctype="multipart/form-data" action="babysignup.post.php" method="post">	
				<table width=100% align="center">
					<tr>
						<td width=20%>宝宝姓名：</td>
						<td align="left"><input id="name" name="baby[babyname]" type="text" /><input id="utype" name="utype" type="hidden" value="babyvote"></td>
					</tr>
					<tr>
						<td>爸爸或妈妈工号：</td>
						<td align="left"><input id="parent_id" name="baby[parent_id]" type="text" /></td>
					</tr>
					<tr>
						<td>部门：</td>
						<td align="left">
							<select id="deptid" name="baby[deptid]">
								<? for($i=0;$i<count($dept);$i++){?>
									<option value=<? echo $dept[$i]->id;?><? if($dept[$i]->id==7){?> selected="selected"<? }?>><? echo $dept[$i]->name;?></option>
								<? }?>
							</select>
						</td>
						
					</tr>
					<tr>
						<td>宝宝参选照片：</td>
						<td align="left"><input name="photourl" type="file"><br>（照片请上传450*300或等比例放大缩小尺寸照片，以免造成网页呈现变形）</td>
					</tr>
					<tr>
						<td>参评简介：</td>
						<td align="left"><textarea name="post[content]" maxlength="20"></textarea>(只显示20个字)</td>
					</tr>
					<tr><td></td><td><button style="margin-right:10px;" OnClick="signuppost()">提　交</button><button type="reset">重　置</button></td></tr>
				</table>
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>