<?php
	require_once('../../frame.php');
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
		js_include_once_tag('total','thickbox');
	?>
</head>
<body style="background:#E1F0F7">
	<form id="fhtg_add" name="fhtg_add" action="fhtg.post.php" enctype="multipart/form-data" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　添加复合团购</td>
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
			<td>是否在首页显示</td><td align="left">　<input type="checkbox" name=is_show id=is_show></td>
		</tr>
		<tr class="tr3">
			<td>开始时间</td>
			<td align="left" ><input type="text" name="start_at" id="start"  class="date_jquery">
			</td>
		</tr>	
		<tr class="tr3">
			<td>结束时间</td>
			<td align="left" ><input type="text" name="end_at" id="end"  class="date_jquery">
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"><input name="image" id="image" type="file">(请上传200x160大小的图片，格式支持jpg、gif、png) <input type="hidden" name="MAX_FILE_SIZE1" value="150000"></td>
		</tr>
		<tr class="tr3">
			<td width="100">内　容</td>
			<td align="left"><?php show_fckeditor('fhtg[content]','Admin',true,"256"); ?></td>
		</tr>
		<?php for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>商　品</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" class="required"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Admin',false,"160"); ?></div><input type="hidden" id="item<?php echo $i;?>maxnum" name="item<?php echo $i;?>[maxnum]" /><a class="thickbox" title="团购内容" href="fhtg_result.php?height=330&width=645&id=<?php echo $i;?>">团购内容</a>
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
			<td colspan="2" width="795" align="center"><button type="submit" id="sub">发布复合团购</button></td>
		</tr>
		<input type="hidden" name="fhtg[is_adopt]" value="0">
		<input type="hidden" id="show_index" name="fhtg[show_index]" value="0">
		<input type="hidden" name="fhtg[created_at]" value="<?php echo date("Y-m-d");?>">
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
			$(this).parent().parent().next().after('<tr class="tr3" ><td>商　品</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><div style="display:none;"><?php show_fckeditor("item'+num+'[content]","Admin",false,"160"); ?></div><input type="hidden" id="item'+num+'maxnum" name="item'+num+'[maxnum]" /><a class="thickbox" id="csresult'+num+'" title="团购内容" href="fhtg_result.php?height=330&width=645&id='+num+'">团购内容</a>　<a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
			tb_init('#csresult'+num);
			$("#num").attr('value',num);
			$(".del_item").click(function(){
				$(this).parent().parent().remove();
				num--;
				$("#num").attr('value',num);
			});
		});
		$('#is_show').change(function(){
			if($(this).attr('checked'))
			{
				$('#show_index').val(1);
			}
			else
			{
				$('#show_index').val(0);
			}
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