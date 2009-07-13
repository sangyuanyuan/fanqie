<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$dialog = new table_class('smg_dialog');
	$dialog->find($id);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('admin','jquery_ui');
		use_jquery_ui();
		validate_form("dialog_add");
	?>
</head>
<body style="background:#E1F0F7">
<form id="dialog_add" method="post" enctype="multipart/form-data" action="dialog.post.php">
	<table width="795" border="0">
		<tr class="tr1">
			<td colspan="2" width="795">　　添加对话</td>
		</tr>
		<tr class="tr3">
			<td width="100">标　题</td>
			<td width="695" align="left"><?php show_fckeditor('title','Title',true,'80',$dialog->title);?></td>
		</tr>
		<tr class="tr3">
			<td width="100">开始时间</td>
			<td width="695" align="left">　<input type="text" name=post[start_time] class="date_jquery required" value="<?php echo substr($dialog->start_time,0,10);?>"></td>
		</tr>
		<tr class="tr3">
			<td width="100">结束时间</td>
			<td width="695" align="left">　<input type="text" name=post[end_time] class="date_jquery required" value="<?php echo substr($dialog->end_time,0,10);?>"></td>
		</tr>
		<tr class="tr3">
			<td width="100">上传图片</td>
			<td width="695" align="left">　<?php if($dialog->photo_url!=''){?><a href="<?php echo $dialog->photo_url;?>" target="_blank" title="点击查看大图"><img src="<?php echo $dialog->photo_url;?>" width="68" height="50" border="0" style="margin-right:10px;"></a><?php }?><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file"></td>
		</tr>
		<tr class="tr3">
			<td width="100">上传视频</td>
			<td width="695" align="left">　<?php if($dialog->video_url!=''){?><a href="<?php echo $dialog->video_url;?>" target="_blank">点击查看视频</a><?php }?><input type="hidden" name="MAX_FILE_SIZE" value="5000000000"> <input name="video" id="video" type="file">(请上传视频，并且不要大于500M)</td>
		</tr>
		<tr class="tr3">
			<td width="100">领导工号</td>
			<td width="695" align="left">　<input type="text" size="50" name=post[leader_ids] value="<?php echo $dialog->leader_ids?>" class="required">(请用","分隔开领导工号,比如:001,002)</td>
		</tr>
		<tr class="tr3">
			<td width="100"><span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="check_user" id="leader">检查领导工号</span></td>
			<td width="695" align="left">　<span id=show_leaders></span></td>
		</tr>
		<tr class="tr3">
			<td width="100">主持人工号</td>
			<td width="695" align="left">　<input type="text" size="50" name=post[master_ids] value="<?php echo $dialog->master_ids?>" class="required">(请用","分隔开主持人工号,比如:001,002)</td>
		</tr>
		<tr class="tr3">
			<td width="100"><span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="check_user" id="master">检查主持人工号</span></td>
			<td width="695" align="left">　<span id=show_masters></span></td>
		</tr>

		<tr class="tr3">
			<td>内　容</td><td align="left">　<textarea cols="80" rows="8" name=post[content] class="required"><?php echo $dialog->content?></textarea></td>
		</tr>

		<tr bclass="tr3">
			<td colspan="2" width="795" align="center"><button type="submit" id="submit">发布对话</button></td>
		</tr>	
	</table>
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name=post[is_adopt] value="0">
</form>
</body>
</html>

<script>
	$("#submit").click(function(){
		var oEditor = FCKeditorAPI.GetInstance('title') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入标题！");
			return false;
		}
	});
	
	$(".date_jquery").datepicker(
		{
			monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
			dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			dayNamesMin:["日","一","二","三","四","五","六"],
			dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			dateFormat: 'yy-mm-dd'
		}
	);
	
	$("#leader").click(function(){
		$.post("dialog.post.php",{'type':'check_user','id':$(this).parent().parent().prev().children().children().attr('value')},function(data){
			$("#show_leaders").html(data);
		})
	});
	
	$("#master").click(function(){
		$.post("dialog.post.php",{'type':'check_user','id':$(this).parent().parent().prev().children().children().attr('value')},function(data){
			$("#show_masters").html(data);
		})
	})
</script>