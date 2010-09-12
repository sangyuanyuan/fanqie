<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$item = new table_class('smg_report_item');
	$item->find($id);
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
			<td width=645 align="left"><input type="text" name="name" value="<?php echo $item->name;?>" class="required"></td>
		</tr>
		<tr class=tr3>
			<td width=150>所属频道：</td>
			<td width=645 align="left">
				<select name="dept_id">
					<option value=0 <?php if($item->dept_id==0){?>selected="selected"<?php }?>>
						不是节目
					</option>
					<option value=12 <?php if($item->dept_id==12){?>selected="selected"<?php }?>>
						上海东方卫视
					</option>
					<option value=21 <?php if($item->dept_id==21){?>selected="selected"<?php }?>>
						上海电视台电视剧频道
					</option>
					<option value=22 <?php if($item->dept_id==22){?>selected="selected"<?php }?>>
						上海电视台生活时尚频道
					</option>
					<option value=19 <?php if($item->dept_id==19){?>selected="selected"<?php }?>>
						上海电视台新闻综合频道
					</option>
					<option value=16 <?php if($item->dept_id==16){?>selected="selected"<?php }?>>
						上海东方电视台娱乐频道
					</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td width=150>是否是节目：</td>
			<td width=645 align="left"><input type="checkbox" <?php if($item->is_dept==1){?>checked="checked"<?php }?> name="check"></td>
		</tr>
		<tr class=tr3>
			<td width=150>是否显示到首页：</td>
			<td width=645 align="left"><input type="checkbox" name="check1" <?php if($item->is_show==1){?>checked="checked"<?php }?>></td>
		</tr>
		<tr class=tr3>
			<td width=150>内　　容：</td>
			<td width=645 align="left"><?php show_fckeditor('ratings[content]','Admin',true,"265",$item->content);?></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $id;?>">
	</form>
	</table>
</body>
</html>
