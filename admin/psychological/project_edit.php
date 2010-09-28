<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$project = new table_class('smg_xlcs_subject');
	$record = $project->find('all',array('conditions' => 'id='.$id));
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
		validate_form("project_edit");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="project_edit" action="project.post.php" method="post"> 
		<table width="795" border="0" style="font-size:12px;">
			<tr class="tr1">
				<td colspan="2" width="795">　　编辑项目</td>
			</tr>
			<tr class="tr3">
				<td width="100">项目名称</td>
				<td width="695" align="left"><input type="text" name="post[title]" value="<?php echo $record[0]->title;?>" class="required"></td>
			</tr>
			<tr class="tr3">
				<td>开始时间</td>
				<td align="left" ><input type="text" name="post[startd_at]" id="start"  class="date_jquery" value="<?php if(substr($record[0]->start_at,0,10)!='0000-00-00'){echo substr($record[0]->start_time,0,10);}?>" >若不填则发布就可参加
				</td>
			</tr>	
			<tr class="tr3">
				<td>结束时间</td>
				<td align="left" ><input type="text" name="post[end_at]" id="end"  class="date_jquery" value="<?php if(substr($record[0]->end_at,0,10)!='0000-00-00'){echo substr($record[0]->end_time,0,10);}?>">若不填则长期有效
				</td>
			</tr>			
			<tr bgcolor="#f9f9f9" height="30px;">
				<input type="hidden" name="ts" id="ts">
				<td colspan="2" width="795" align="center"><button type="submit" id="submit">发布项目</button></td>
			</tr>	
		</table>
		<input type="hidden" name="post[created_at]"  value="<?php echo $record[0]->created_at;?>">
		<input type="hidden" name="post[is_adopt]"  value="0">
		<input type="hidden" name="id"  value="<?php echo $id;?>">
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