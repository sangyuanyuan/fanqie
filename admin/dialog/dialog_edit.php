<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$dialog = new table_class('smg_dialog');
	$dialog->find($id);
	$dialog_leader = new table_class('smg_dialog_leader');
	$records = $dialog_leader->find('all',array('conditions' => 'dialog_id='.$id));
	$count = count($records);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf8">
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
			<td width="695" align="left"><?php show_fckeditor('title','Title',true,'80',$dialog->title);?></td>
		</tr>
		<tr class="tr3">
			<td width="100">开始时间</td>
			<td width="695" align="left">　<input type="text" size="20"  name=post[start_time] id=start_time  value="<?php echo $dialog->start_time;?>" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
		</tr>
		<tr class="tr3">
			<td width="100">结束时间</td>
			<td width="695" align="left">　<input type="text" size="20"  name=post[end_time] id=end_time value="<?php echo $dialog->end_time;?>" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
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
			<td width="100">对话者工号</td>
			<td width="695" align="left">　<input type="text" size="50" name=leader_id1 class="required" value="<?php echo $records[0]->leader_id;?>"><?php if($records[0]->photo_src!=''){?><a href="<?php echo $records[0]->photo_src;?>" target="_blank" title="点击查看大图"><img src="<?php echo $records[0]->photo_src;?>" width="50" height="50" border="0"></a><?php }?><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="learder_image1" id="learder_image1" type="file">
				<span style="cursor:pointer" id="add_leader">继续添加</span>
				<span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="check_user<?php if($records[0]->photo_src!='')echo '1';?>" id="leader">检查对话者工号</span>
				<span id=show_leaders></span>
				<input type="hidden" name="dialog_leader_id1" value="<?php echo $records[0]->id;?>">
			</td>
		</tr>
		<?php 
			if($count>1){
				for($i=2;$i<=$count;$i++){
		?>
		<tr class="tr3" id="<?php echo $records[$i-1]->id;?>">
			<td width="100">对话者工号</td>
			<td width="695" align="left">　<input type="text" size="50" name="leader_id<?php echo $i;?>" class="required" value="<?php echo $records[$i-1]->leader_id;?>"><?php if($records[$i-1]->photo_src!=''){?><a href="<?php echo $records[$i-1]->photo_src;?>" target="_blank" title="点击查看大图"><img src="<?php echo $records[$i-1]->photo_src;?>" width="50" height="50" border="0"></a><?php }?><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="learder_image<?php echo $i;?>" id="learder_image<?php echo $i;?>" type="file">
				<span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="check_user<?php if($records[$i-1]->photo_src=='')echo '2';?>">检查对话者工号</span>
				<input type="hidden" name="dialog_leader_id<?php echo $i?>" value="<?php echo $records[$i-1]->id;?>">
				<span style="cursor:pointer; color:#0033CC; text-decoration:underline" class="del_leader" name="<?php echo $records[$i-1]->id;?>">删除</span>
			</td>
		</tr>
		<?php
				}
		?>
		
		<?php }?>
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
	<input type="hidden" name=learder_count id=learder_count value="<?php echo $count;?>">
	<input type="hidden" name="id" value="<?php echo $id;?>">
</form>
</body>
</html>

<script>
	var num = $("#learder_count").attr('value');
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
	
	$(".check_user1").click(function(){
		$.post("dialog.post.php",{'type':'check_user','id':$(this).prev().prev().prev().prev().prev().attr('value')},function(data){
			$("#show_leaders").html(data);
		})
	});
	
	$(".check_user1").click(function(){
		$.post("dialog.post.php",{'type':'check_user','id':$(this).prev().prev().prev().attr('value')},function(data){
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
	
	$(".del_leader").click(function(){
			if(!window.confirm("确定要删除吗"))
			{
				return false;
			}
			else
			{	num--;
				$("#learder_count").attr('value',num);
				$.post("dialog.post.php",{'del_id':$(this).attr('name'),'type':'del_leader'},function(data){
					$("#"+data).remove();
				});
			}
	});
</script>