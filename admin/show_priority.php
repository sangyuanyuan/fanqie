<?php
	require "../frame.php";
	$db = get_db();
	$sql = 'select * from smg_image_show ';
	$record=$db -> query($sql);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		use_jquery();
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class=tr1>
			<td>
				　首页排序
			</td>
		</tr>
		<tr class=tr2>
			<td><select id="name">
				<option value="mrzx"  <? if($record[0]->name=="mrzx"){ echo "selected=selected";}?>>每日之星</option>
				<option value="spxw"  <? if($record[0]->name=="spxw"){ echo "selected=selected";}?>>视频新闻</option>
				<option value="fqgg" <? if($record[0]->name=="fqgg"){ echo "selected=selected";}?>>番茄广告</option>
				</select></td>
		</tr>	
		<tr class=tr3>
			<td>
				<input type="button" id=submit value="提交">
			</td>
		</tr>	
		
	</table>
</body>
</html>

<script>
	
$(function(){
		$("#submit").click(function(){
				$.post("/admin/show_priority.post.php",{'name':$('#name').attr('value')},function(data){
					alert("提交成功");
				});

		});
		

		
})


</script>
