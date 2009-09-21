<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin','jquery_ui');
		use_jquery_ui();
		validate_form("category_form");
	?>
</head>
<body>
	<?php
		$rating_value = new table_class("smg_rating_value");
		$rating_value->find($id);
	?>
	<table width="795" border="0" id="list">
	<form id="category_form" method="post" action="upload2.post.php">
		<tr class=tr3>
			<td>选择日期：</td>
			<td align="left"><input type="text" value="<?php echo $rating_value->date;?>" class="date_jquery required" name="date"></td>
		</tr>
		<tr class=tr3>
			<td>输入值：</td>
			<td align="left"><input type="text" value="<?php echo $rating_value->value;?>" class="required" size="50" name=value></td>
		</tr>
		<tr class=tr3>
			<td>输入差值：</td>
			<td align="left"><input type="text" value="<?php echo $rating_value->value2;?>" class="required" size="50" name=value2></td>
		</tr>
		<tr class=tr3>
			<td>选择比较：</td>
			<td align="left">
				<select name="value3">
					<option value="up" <?php if($rating_value->value2=="up"){?>selected="seleccted"<?php } ?>>上升</option>
					<option value="down" <?php if($rating_value->value2=="down"){?>selected="seleccted"<?php } ?>>下降</option>
					<option value="equal" <?php if($rating_value->value2=="equal"){?>selected="seleccted"<?php } ?>>持平</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="item_id" value="<?php echo $rating_value->item_id;?>">
	</form>
	</table>
</body>
</html>

<script>
	$(".date_jquery").datepicker(
			{
				monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dateFormat: 'yy-mm-dd'
			}
		);
</script>