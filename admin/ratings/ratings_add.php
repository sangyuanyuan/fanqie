<?php
	require_once('../../frame.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		validate_form("category_form");
	?>
</head>
<body>
	<table width="795" border="0" id="list">
	<form id="category_form" method="post" action="ratings.post.php">
		<tr class=tr1>
			<td colspan="2">　添加项目</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="name" class="required"></td>
		</tr>
		<tr class=tr3>
			<td width=150>所属频道：</td>
			<td width=645 align="left">
				<select name="dept_id">
					<option value=0>
						不是节目
					</option>
					<option value=12>
						上海东方卫视
					</option>
					<option value=21>
						上海电视台电视剧频道
					</option>
					<option value=22>
						上海电视台生活时尚频道
					</option>
					<option value=19>
						上海电视台新闻综合频道
					</option>
					<option value=16>
						上海东方电视台娱乐频道
					</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td width=150>是否是节目：</td>
			<td width=645 align="left"><input type="checkbox" name="check"></td>
		</tr>
		<tr class=tr3>
			<td width=150>是否显示到首页：</td>
			<td width=645 align="left"><input type="checkbox" name="check1"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
	</form>
	</table>
</body>
</html>
