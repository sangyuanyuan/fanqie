<?php
	require_once('../frame.php');
	$db = get_db();
	$sql = 'select * from smg_zhibo_ctrl';
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
				　直播控制
			</td>
		</tr>
		<tr class=tr2>
			<td><select id="zhibo">
				<option value="0"  <? if($record[0]->state==0){ echo "selected=selected";}?>>关闭直播</option>
				<option value="1"  <? if($record[0]->state==1){ echo "selected=selected";}?>>开启直播</option>
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
				$.post("/admin/zhibo.post.php",{'zhibo':$('#zhibo').attr('value')},function(data){
					alert("提交成功!");
				});

		});
})


</script>
