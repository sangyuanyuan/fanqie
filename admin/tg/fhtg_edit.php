<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$project = new table_class('smg_fhtg');
	$record = $project->find('all',array('conditions' => 'id='.$id));
	$db=get_db();
	//$question_item = new table_class('smg_fhtg_item');
	$records = $db->query('select * from smg_fhtg_item where fhtg_id='.$id);
	$count = count($records);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin','thickbox','jquery_ui');
		use_jquery_ui();
		validate_form("fhtg_add");
		js_include_once_tag('total','thickbox','My97DatePicker/WdatePicker.js');
	?>
</head>
<body style="background:#E1F0F7">
	<form id="fhtg_add" name="fhtg_add" action="fhtg.post.php" enctype="multipart/form-data" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　复合团购编辑</td>
		</tr>
		<tr class="tr3">
			<td width="100">名　称</td>
			<td align="left"><input type="text" name="fhtg[title]" class="required" value="<?php echo $record[0]->title; ?>"></td>
		</tr>
		<tr class="tr3">
			<td width="100">优先级</td>
			<td align="left"><input type="text" name="fhtg[priority]" value="<?php echo $record[0]->priority; ?>"></td>
		</tr>
		<tr class="tr3">
			<td>开始时间</td>
			<td align="left" ><input type="text" name="start_at" id="start"  class="date_jquery" value="<?php if(substr($record[0]->start_at,0,10)!='0000-00-00'){echo substr($record[0]->start_time,0,10);}?>">
			</td>
		</tr>	
		<tr class="tr3">
			<td>结束时间</td>
			<td align="left" ><input type="text" name="end_at" id="end"  class="date_jquery" value="<?php if(substr($record[0]->end_at,0,10)!='0000-00-00'){echo substr($record[0]->end_at,0,10);}?>">
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"><input name="image" id="image" type="file">(请上传200x160大小的图片，格式支持jpg、gif、png) <input type="hidden" name="MAX_FILE_SIZE1" value="150000"></td>
		</tr>
		<tr class="tr3">
			<td width="100">内　容</td>
			<td align="left"><?php show_fckeditor('fhtg[content]','Admin',true,"256",$records[0]->content); ?></td>
		</tr>
		<?php for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>商　品</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" class="required" value="<?php echo $records[$i-1]->name;?>"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Title',false,"160","","300"); ?></div><input type="hidden" id="item<?php echo $i;?>maxnum" name="item<?php echo $i;?>[maxnum]" value="<?php echo $records[$i-1]->maxnum;?>" /><a class="thickbox" title="团购内容" href="fhtg_result.php?height=330&width=645&id=<?php echo $i;?>&tgid=<?php echo $records[$i-1]->id;?>">团购内容</a>
			<input type="hidden" name="item<?php echo $i;?>_id" value="<?php echo $records[$i-1]->id;?>">
			<?php if($i==1){?>
			<button type="button"  id="add_item">继续添加</button>
			<?php }?>
		　	</td>
		</tr>
		<?php
				}if($count > 2){for($i=3;$i<=$count;$i++){
		?>
		<tr class="tr3" >
			<td>商　品</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" value="<?php echo $records[$i-1]->name;?>" class="required"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Title',false,"160",$records[$i-1]->content,"300"); ?></div><input type="hidden" id="item<?php echo $i;?>maxnum" name="item<?php echo $i;?>[maxnum]" value="<?php echo $records[$i-1]->maxnum;?>" /><a class="thickbox" title="团购内容" href="fhtg_result.php?height=330&width=645&id=<?php echo $i;?>&tgid=<?php echo $records[$i-1]->id;?>">团购内容</a>　
			  <a class="del_item"  name="<?php echo $records[$i-1]->id;?>" style="cursor:pointer;">删除</a>
			 <input type="hidden" name="item<?php echo $i;?>_id" value="<?php echo $records[$i-1]->id;?>">
		　	</td>
		</tr>
		<?php 
				}}
		?>
		<input type="hidden" name="item_num" id="num" value="2">
		<tr class="tr3">
			<td colspan="2" width="795" align="center"><button type="button" id="sub">发布复合团购</button></td>
		</tr>
		<input type="hidden" name="fhtg[is_adopt]" value="0">
		<input type="hidden" name="fhtg[created_at]" value="<?php echo date("y-m-d");?>">
	</table>
	</form>
</body>
</html>

<script>
	$(function(){
		var flag = false;
		var num = 2;
		$("#add_item").click(function(){
			num++;
			$(this).parent().parent().next().after('<tr class="tr3" ><td>商　品</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><div style="display:none;"><?php show_fckeditor("item'+num+'[content]","Title",false,"160","","300"); ?></div><input type="hidden" id="item'+num+'maxnum" name="item'+num+'[maxnum]" /><a class="thickbox" id="csresult'+num+'" title="团购内容" href="fhtg_result.php?height=330&width=645&id='+num+'">团购内容</a>　<a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
			tb_init('#csresult'+num,'#glnext'+num);
			$("#num").attr('value',num);
			$(".del_item").click(function(){
				$(this).parent().parent().remove();
				num--;
				$("#num").attr('value',num);
			});
		});
		$("#sub").click(function(){
			$("#xlcs_add").submit();
		});
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
</script>