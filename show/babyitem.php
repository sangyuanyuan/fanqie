<?php require_once('../frame.php');
	$db=get_db();
	$cookie=$_COOKIE['smg_username'];
	if($cookie=="")
	{
		alert('请登陆后再进行操作！');
		redirect('/login/login.php');
	}else
	{
		$baby=$db->query('select * from smg_baby_vote where parent_id='.$cookie);
		if(count($baby)==0)
		{
			alert('请先报名参加宝宝秀，再上传宝宝其他照片！');
			redirect('babysignup.php');
		}	
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-宝宝秀</title>
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
	<div id=bodys>
		<div id=activity_body>
			<div id=activity_title>请填写以下信息： </div>
			
			<div id=activitycontent>
				<form name="signup" id="uploadfiles" enctype="multipart/form-data" action="babysignup.post.php" method="post">	
				<table align="center" style="margin-top:50px;">
					<tr>
						<td width=20%>宝宝照片：</td>
						<td align="left"><input name="photourl" id="upfile1" type="file"><input id="utype" name="utype" type="hidden" value="babyitem"></td>
					</tr>
					<tr>
						<td>照片简介：</td>
						<td align="left"><textarea name="baby[content]" maxlength="20"></textarea>(只显示20个字)<input type="hidden" id="babyid" name="baby[babyid]" value="<?php echo $baby[0]->id; ?>"><input type="hidden" id="babyitemid" name="baby[id]" value="<?php echo $_REQUEST['id']; ?>"></td>
					</tr>
					<tr><td></td><td><button style="margin-right:10px;" OnClick="signuppost1()">提　交</button><button type="reset">重　置</button></td></tr>
				</table>
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>