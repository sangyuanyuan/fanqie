<?php
	require_once('../../frame.php');
	$db = get_db();
	$sql = 'select * from smg_news_show ';
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
				　新闻排序
			</td>
		</tr>
		<tr class=tr2>
			<td><select id="days">
				<option value="0"  <? if($record[0]->days==0){ echo "selected=selected";}?>>按优先级排序</option>
				<option value="7"  <? if($record[0]->days==7){ echo "selected=selected";}?>>按点击量排序　一周</option>
				<option value="30" <? if($record[0]->days==30){ echo "selected=selected";}?>>按点击量排序　一月</option>
				<option value="90" <? if($record[0]->days==90){ echo "selected=selected";}?>>按点击量排序　三月</option>
				<option value="180" <? if($record[0]->days==180){ echo "selected=selected";}?>>按点击量排序　半年</option>
				<option value="365" <? if($record[0]->days==365){ echo "selected=selected";}?>>按点击量排序　一年</option>
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
				$.post("/admin/news/show.post.php",{'days':$('#days').attr('value')},function(data){
					alert("提交成功");
				});

		});
		

		
})


</script>
