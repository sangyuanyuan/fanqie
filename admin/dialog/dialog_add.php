<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$title = $_REQUEST['title'];
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<script language="javascript" type="text/javascript" src="/javascript/My97DatePicker/WdatePicker.js"></script>
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
			<td width="695" align="left"><?php if($title!=''){show_fckeditor('title','Title',true,"80",$title);}else{show_fckeditor('title','Title',true,"80");}?></td>
		</tr>
		<tr class="tr3">
			<td width="100">开始时间</td>
			<td width="695" align="left">　<input type="text" size="20"  name=post[start_time] id=start_time  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
		</tr>
		<tr class="tr3">
			<td width="100">结束时间</td>
			<td width="695" align="left">　<input type="text" size="20"  name=post[end_time] id=end_time onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
		</tr>
		<tr class="tr3">
			<td width="100">上传图片</td>
			<td width="695" align="left">　<input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file" class="required"></td>
		</tr>
		<tr class="tr3">
			<td width="100">上传视频</td>
			<td width="695" align="left">　<input type="hidden" name="MAX_FILE_SIZE" value="5000000000"><input name="video" id="video" type="file">(请上传视频，并且不要大于500M)</td>
		</tr>
		<tr class="tr3">
			<td width="100">对话者工号</td>
			<td width="695" align="left">　<input type="text" size="50" name=leader_id1 class="required"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="learder_image1" id="learder_image1" type="file">
				<span style="cursor:pointer" id="add_leader">继续添加</span>
				<span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="check_user" id="leader">检查对话者工号</span>
				<span id=show_leaders></span>
			</td>
		</tr>
		<tr class="tr3">
			<td width="100">主持人工号</td>
			<td width="695" align="left">　<input type="text" size="50" name=post[master_ids] class="required">(请用","分隔开主持人工号,比如:001,002)</td>
		</tr>
		<tr class="tr3">
			<td width="100"><span style="cursor:pointer; color:#0033CC; text-decoration:underline" id="master">检查主持人工号</span></td>
			<td width="695" align="left">　<span id=show_masters></span></td>
		</tr>

		<tr class="tr3">
			<td>内　容</td><td align="left">　<?php show_fckeditor('content','Admin',true,"250");?></td>
		</tr>

		<tr bclass="tr3">
			<td colspan="2" width="795" align="center"><button type="submit" id="submit">发布对话</button></td>
		</tr>	
	</table>
	<input type="hidden" name=post[create_time] value="<?php echo date("y-m-d")?>">
	<input type="hidden" name=learder_count id=learder_count value="1">
	<input type="hidden" name=post[is_adopt] value="0">
	<?php if($id!=''){?>
	<input type="hidden" name=collection value="<?php echo $id;?>">
	<?php }?>
</form>
</body>
</html>

<script>
	var num = 1;
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
	
	$(".check_user").click(function(){
		$.post("dialog.post.php",{'type':'check_user','id':$(this).prev().prev().prev().prev().attr('value')},function(data){
			$("#show_leaders").html(data);
		})
	});
	
	$("#master").click(function(){
		$.post("dialog.post.php",{'type':'check_user','id':$(this).parent().parent().prev().children().children().attr('value')},function(data){
			$("#show_masters").html(data);
		})
	})
	
	$("#add_leader").click(function(){
		num++;
		$("#learder_count").attr('value',num);
		$(this).parent().parent().after('<tr class="tr3"><td width="100">对话者工号</td><td width="695" align="left">　<input type="text" size="50" name=leader_id'+num+' class="required"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="learder_image'+num+'" id="learder_image'+num+'" type="file"><span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="check_user" id="leader">检查对话者工号</span></td></tr>');
		$(".check_user").click(function(){
			$.post("dialog.post.php",{'type':'check_user','id':$(this).prev().prev().prev().attr('value')},function(data){
				$("#show_leaders").html(data);
			})
		});
	});
</script>