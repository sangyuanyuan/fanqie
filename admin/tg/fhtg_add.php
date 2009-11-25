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
		validate_form("fhtg_add");
		js_include_once_tag('total','thickbox','My97DatePicker/WdatePicker.js');
	?>
</head>
<body style="background:#E1F0F7">
	<form id="fhtg_add" name="fhtg_add" action="fhtg.post.php" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　添加题目</td>
		</tr>
		<tr class="tr3">
			<td width="100">名　称</td>
			<td align="left"><input type="text" name="fhtg[title]" class="required"></td>
		</tr>
		<tr class="tr3">
			<td width="100">优先级</td>
			<td align="left"><input type="text" name="fhtg[priority]"></td>
		</tr>
		<tr class="tr3">
			<td>开始时间</td>
			<td align="left" ><input type="text" name="start_at" id="start"  class="date_jquery">若不填则发布就可参加
			</td>
		</tr>	
		<tr class="tr3">
			<td>结束时间</td>
			<td align="left" ><input type="text" name="end_at" id="end"  class="date_jquery">若不填则长期有效
			</td>
		</tr>
		<tr class="tr3">
			<td width="100">内　容</td>
			<td align="left"><?php show_fckeditor('fhtg[content]','Admin',true,"256"); ?></td>
		</tr>
		<?php for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>选　项</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" class="required"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Title',false,"160","","300"); ?></div><a class="thickbox" title="复合团购内容" href="xlcs_result.php?height=270&width=350&id=<?php echo $i;?>">复合团购内容</a>
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
			$(this).parent().parent().next().after('<tr class="tr3" ><td>选　项</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><div style="display:none;"><?php show_fckeditor("item'+num+'[content]","Title",false,"160","","300"); ?></div><a class="thickbox" id="csresult'+num+'" title="测试结果" href="xlcs_result.php?height=270&width=350&id='+num+'">测试结果</a>　<input type="hidden" id="item'+num+'child_id" name="item'+num+'[child_id]"><span id="td_xlcs'+num+'"><a class="thickbox" id="glnext'+num+'" title="关联下一题" href="xlcs_child.php?height=500&width=600&id='+num+'">关联下一题</a></span>　<a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
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