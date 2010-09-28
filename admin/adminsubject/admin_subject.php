<?php
	require_once('../../frame.php');
	$role = judge_role();
	$id = $_REQUEST['id'];
	$type = $_REQUEST['type'];
	$cookie=$_COOKIE['smg_user_nickname'];
	$db=get_db();
	if($id!="")
	{
		$subject=$db->query('select * from smg_admin_subject where id='.$id);
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-添加新闻</title>
	<?php 
		css_include_tag('admin');
		use_jquery();
		validate_form("news_add");
		js_include_tag('total');
		
	?>
	<script>
			total("后台","other");
	</script>
</head>
<body style="background:#E1F0F7">
	<form id="adminsubject" enctype="multipart/form-data" action="subject.post.php" method="post"> 
	<table width="795" border="0">
		<tr class=tr1>
			<td colspan="6" width="795">　　<?php if($type=="add"){ ?>添加<?php }else if($type=="edit"){ ?>更新<?php } ?>选题</td>
		</tr>
		<tr class=tr3>
			<td width="130">标题</td><td width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50",$subject[0]->title,300);?><span id="max_len"></span></td>
		</tr>
		<tr class=tr3>
			<td width="130">优先级</td><td width="695" align="left"><input type="text" name="news[priority]" value="<?php if($subject[0]->priority!=""){echo $subject[0]->priority;}else{echo 100;} ?>"></td>
		</tr>
		<tr class=tr3>
			<td>状　态</td>
			<td align="left">
				<select id=news[state]>
					<option value=0>未采集</option>
					<option value=1>已采集</option>
					<option value=2>不可采</option>
					<option value=3>已发布</option>
				</select>
			</td>
		</tr>
		<tr id=newsshow1  class="normal_news tr3">
			<td height=100>简短描述</td><td><?php show_fckeditor('news[description]','Admin',true,"100",$subject[0]->description);?></td>
		</tr>
		<tr id=newsshow1  class="normal_news tr3">
			<td height=100>备　注</td><td><?php show_fckeditor('news[remark]','Admin',true,"100",$subject[0]->remark);?></td>
		</tr>
		<?php if($type=="edit"){ ?>
		<tr class=tr3>
			<td width="130">操作员</td><td width="695" align="left"><input type="text" name="czname" value="admin"></td>
		</tr>
		<?php } ?>
		<tr class=tr3>
			<input type="hidden" name="subid" value="<?php echo $id; ?>">
			<input type="hidden" name="subtype" value="<?php echo $type; ?>">
			<input type="hidden" name="news[user_id]" value="<?php if($type=="edit"){ echo $subject[0]->user_id;}else{echo $cookie;} ?>">
			<td colspan="2" width="795" align="center"><?php if($type=="edit"||$type=="add"){ ?><input id="submit" type="submit" value="提交选题"><?php } ?></td>
		</tr>	
	</table>
		
	</form>
</body>
</html>
