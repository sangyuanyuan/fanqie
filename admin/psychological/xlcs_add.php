<?php
	require_once('../../frame.php');
	$project_id = $_REQUEST['id'];
	$project_type = $_REQUEST['type'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin','thickbox');
		use_jquery();
		validate_form("question_add");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="xlcs_add"  action="xlcs.post.php" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　添加题目</td>
		</tr>
		<tr class="tr3">
			<td width="100">题　目</td>
			<td align="left"><input type="text" name="xlcs[title]" class="required"></td>
		</tr>	
		<?php for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>选项</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" class="required"><a class="thickbox" param="<?php echo $i;?>" title="测试结果" href="xlcs_result.php?height=255&width=320">测试结果</a>　<a class="thickbox" title="关联下一题" param="<?php echo $i;?>" href="xlcs_child.php?height=600&width=400">关联下一题</a>
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
		<div style="display:none"><?php show_fckeditor('hidden_flower_comment','Admin',true,"200"); ?></div>
		<input type="hidden" name="xlcs[problem_id]" value="<?php echo $project_id;?>">
		<input type="hidden" name="xlcs[create_time]" value="<?php echo date("y-m-d");?>">
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
			$(this).parent().parent().next().after('<tr class="tr3" ><td>选项</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><a class="thickbox" title="测试结果" href="xlcs_result.php?height=255&width=320">测试结果</a>　<a class="thickbox" title="测试结果" href="xlcs_child.php?height=600&width=400">关联下一题</a><a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
			$("#num").attr('value',num);
			$(".del_item").click(function(){
				$(this).parent().parent().remove();
				num--;
				$("#num").attr('value',num);
			});
		});
		$(".thickbox")
		
	});	
</script>