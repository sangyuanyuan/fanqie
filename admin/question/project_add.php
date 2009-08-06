<?php
	require_once('../../frame.php');
	$category = new table_class("smg_category");
	$category_menu = $category->find("all",array('conditions' => "category_type='problem'","order" => "priority"));
	$count = count($category_menu);
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
		validate_form("project_add");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="project_add" action="project.post.php" enctype="multipart/form-data" method="post">
		<table width="795" border="0" style="font-size:12px;">
			<tr class="tr1">
				<td colspan="2" width="795">　　添加项目</td>
			</tr>
			<tr class="tr3">
				<td width="100">项目名称</td>
				<td width="695" align="left"><input type="text" name="post[name]" class="required" ></td>
			</tr>
			<tr class="tr3">
				<td width="100">添加图片</td>
				<td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file"></td>
			</tr>
			<tr class=tr3>
				<td>所属类别</td>
				<td align="left">
					<select  name="post[category_id]">
						<?php for($i=0;$i<$count;$i++){?>
						<option value="<?php echo $category_menu[$i]->id;?>"><?php echo $category_menu[$i]->name;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr class="tr3">
				<td>开始时间</td>
				<td align="left" ><input type="text" name="start_time" id="start"   class="date_jquery">若不填则发布就可参加
				</td>
			</tr>	
			<tr class="tr3">
				<td>结束时间</td>
				<td align="left" ><input type="text" name="end_time" id="end"  class="date_jquery">若不填则长期有效
				</td>
			</tr>
			<tr class="tr3">
				<td>答题时限</td>
				<td align="left" ><input type="text" name="post[limit_time]"  class="number">若无时限则不需要输入/单位秒</td>
			</tr>
			<tr class="tr3">
				<td>单题分值</td>
				<td align="left" ><input type="text" name="post[point]"  class="number">若不输入则每题10分</td>
			</tr>
			<tr class="tr3">
				<td>题目类型</td>
				<td align="left" >
					<select id="problemtype" name="post[type]">
						<option value="check">选择题</option>
						<option value="judge">是非题</option>
					</select>
				</td>
			</tr>
			<tr bgcolor="#f9f9f9" height="30px;">
				<td colspan="2" width="795" align="center"><button type="submit" id="submit">发布项目</button></td>
			</tr>
		</table>
		<input type="hidden" name="ts" id="ts">
		<input type="hidden" name="post[create_time]"  value="<?php echo date("y-m-d")?>">
		<input type="hidden" name="post[is_adopt]"  value="0">
	</form>
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
	//日历框函数
	
</script>