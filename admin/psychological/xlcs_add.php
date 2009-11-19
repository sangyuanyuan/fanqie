<?php
	require_once('../../frame.php');
	$project_id = $_REQUEST['id'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin','thickbox');
		use_jquery();
		validate_form("xlcs_add");
		js_include_once_tag('total','thickbox','My97DatePicker/WdatePicker.js');
	?>
</head>
<body style="background:#E1F0F7">
	<form id="xlcs_add" name="xlcs_add" action="xlcs.post.php" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　添加题目</td>
		</tr>
		<tr class="tr3">
			<td width="100">题　目</td>
			<td align="left"><input type="text" name="xlcs[title]" class="required"></td>
		</tr>
		<tr class="tr3">
			<td width="100">优先级</td>
			<td align="left"><input type="text" name="xlcs[priority]"></td>
		</tr>
		<tr class="tr3">
			<td width="100">内　容</td>
			<td align="left"><?php show_fckeditor('xlcs[content]','Admin',true,"256"); ?></td>
		</tr>
		<?php for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>选　项</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" class="required"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Title',false,"160","","300"); ?></div><a class="thickbox" title="测试结果" href="xlcs_result.php?height=270&width=350&id=<?php echo $i;?>">测试结果</a>　<input type="hidden" id="item<?php echo $i;?>child_id" name="item<?php echo $i;?>[child_id]"><span id="td_xlcs<?php echo $i;?>"><a id="child<?php echo $i;?>" class="thickbox" title="关联下一题" href="xlcs_child.php?height=500&width=600&id=<?php echo $i;?>">关联下一题</a></span>
			<?php if($i==1){?>
			<button type="button"  id="add_item">继续添加</button>
			<?php }?>
		　	</td>
		</tr>
		<?php
				}
		?>
		<input type="hidden" name="item_num" id="num" value="2">
		<tr class="tr3">
			<td colspan="2" width="795" align="center"><button type="button" id="sub">发布题目</button></td>
		</tr>
		<input type="hidden" name="xlcs[is_adopt]" value="0">
		<input type="hidden" name="xlcs[project_id]" value="<?php echo $project_id;?>">
		<input type="hidden" name="xlcs[created_at]" value="<?php echo date("y-m-d");?>">
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
			$(this).parent().parent().next().after('<tr class="tr3" ><td>选　项</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><div style="display:none;"><?php show_fckeditor("item'+num+'[content]","Title",false,"160","","300"); ?></div><a class="thickbox" id="csresult'+num+'" title="测试结果" href="xlcs_result.php?height=255&width=320&id='+num+'">测试结果</a>　<input type="hidden" id="item'+num+'child_id" name="item'+num+'[child_id]"><span id="td_xlcs'+num+'"><a class="thickbox" id="glnext'+num+'" title="关联下一题" href="xlcs_child.php?height=500&width=600&id='+num+'">关联下一题</a></span>　<a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
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
</script>