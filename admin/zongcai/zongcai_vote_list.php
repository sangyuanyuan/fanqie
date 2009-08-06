<?php
	require_once('../../frame.php');
	$zongcai_vote = new table_class('smg_zongcai_vote');
	$vote_record = $zongcai_vote->find('all',array('order' => 'id desc'));
	$id = $vote_record[0]->id;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<script language="javascript" type="text/javascript" src="/javascript/My97DatePicker/WdatePicker.js"></script>
	<?php
		css_include_tag('admin');
		use_jquery();
		js_include_tag('admin_pub');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr2">
			<td width="175">类别名称</td><td width="70">优先级</td><td>名称</td><td width="256">操作</td>
		</tr>
		<?php
			$db = get_db();
			$sql = 'select * from smg_zongcai_item where id in(select item_id from smg_zongcai_vote_item where vote_id = '.$id.') order by program_type,priority,create_time desc';
			//echo $sql;
			$record = $db->query($sql);
			$i = 0;
		?>
		<tr class=tr3>
			<td><img style="cursor:pointer" name="broadcast_recommend" src="/images/admin/plus.gif">广播推荐节目</td>
			<td></td>
			<td></td>
			<td><span style="cursor:pointer" class="clear" name="broadcast_recommend">清空</span></td>
		</tr>
		<?php
			while($record[$i]->program_type=="broadcast_recommend"){		
		?>
			<tr class="tr3 broadcast_recommend" style="display:none;" id=<?php echo $record[$i]->id;?>>
				<td></tds>
				<td><input type="text" class="priority" name="<?php echo $record[$i]->id;?>" value="<?php if($record[$i]->priority!=100){echo $record[$i]->priority;}?>" style="width:30px;"></td>
				<td><?php echo $record[$i]->name;?></td>
				<td>
					<?php if($record[$i]->state=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
					<?php if($record[$i]->state=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
					<span style="cursor:pointer" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
					<a href="zongcai_item_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
				</td>
			</tr>
		<?php
				$i++;
			}
		?>
		<tr class=tr3>
			<td><img style="cursor:pointer" name="broadcast_self" src="/images/admin/plus.gif">广播自荐节目</td>
			<td></td>
			<td></td>
			<td><span style="cursor:pointer" class="clear" name="broadcast_self">清空</span></td>
		</tr>
		<?php
			while($record[$i]->program_type=="broadcast_self"){			
		?>
			<tr class="tr3 broadcast_self" style="display:none;" id=<?php echo $record[$i]->id;?>>
				<td></tds>
				<td><input type="text" class="priority" name="<?php echo $record[$i]->id;?>" value="<?php if($record[$i]->priority!=100){echo $record[$i]->priority;}?>" style="width:30px;"></td>
				<td><?php echo $record[$i]->name;?></td>
				<td>
					<?php if($record[$i]->state=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
					<?php if($record[$i]->state=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
					<span style="cursor:pointer" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
					<a href="zongcai_item_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
				</td>
			</tr>
		<?php
				$i++;
			}
		?>
		<tr class=tr3>
			<td><img style="cursor:pointer" name="tv_recommend" src="/images/admin/plus.gif">电视推荐节目</td>
			<td></td>
			<td></td>
			<td><span style="cursor:pointer" class="clear" name="tv_recommend">清空</span></td>
		</tr>
		<?php
			while($record[$i]->program_type=="tv_recommend"){			
		?>
			<tr class="tr3 tv_recommend" style="display:none;" id=<?php echo $record[$i]->id;?>>
				<td></tds>
				<td><input type="text" class="priority" name="<?php echo $record[$i]->id;?>" value="<?php if($record[$i]->priority!=100){echo $record[$i]->priority;}?>" style="width:30px;"></td>
				<td><?php echo $record[$i]->name;?></td>
				<td>
					<?php if($record[$i]->state=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
					<?php if($record[$i]->state=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
					<span style="cursor:pointer" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
					<a href="zongcai_item_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
				</td>
			</tr>
		<?php
				$i++;
			}
		?>
		<tr class=tr3>
			<td><img style="cursor:pointer" name="tv_self" src="/images/admin/plus.gif">电视自荐节目</td>
			<td></td>
			<td></td>
			<td><span style="cursor:pointer" class="clear" name="tv_self">清空</span></td>
		</tr>
		<?php
			while($record[$i]->program_type=="tv_self"){			
		?>
			<tr class="tr3 tv_self" style="display:none;" id=<?php echo $record[$i]->id;?> >
				<td></tds>
				<td><input type="text" class="priority" name="<?php echo $record[$i]->id;?>" value="<?php if($record[$i]->priority!=100){echo $record[$i]->priority;}?>" style="width:30px;"></td>
				<td><?php echo $record[$i]->name;?></td>
				<td>
					<?php if($record[$i]->state=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
					<?php if($record[$i]->state=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
					<span style="cursor:pointer" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
					<a href="zongcai_item_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
				</td>
			</tr>
		<?php 
				$i++;
			}
		?>
	</table>
	<table width="795" border="0">
		<tr class=tr2>
			<td width="175">编辑当前投票</td>
			<td width=70>开始时间</td>
			<td ><input type="text" size="20"  name=start_time id=start_time value="<?php echo $vote_record[0]->start_time;?>" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
			<td width=70>结束时间</td>
			<td ><input type="text" size="20"  name=end_time id=end_time value="<?php echo $vote_record[0]->end_time;?>" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
			<td width=50><button name="submit" id="submit1">发布</button></td>
			<input type="hidden" id="id" value="<?php echo $vote_record[0]->id;?>">
		</tr>
		<tr class=tr2>
			<td width="175">发布一个新投票</td>
			<td width=70>开始时间</td>
			<td ><input type="text" size="20"  name=start_time2 id=start_time2  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time2\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
			<td width=70>结束时间</td>
			<td ><input type="text" size="20"  name=end_time2 id=end_time2 onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time2\')||\'2020-10-01 12:00:00\'}'})" class="Wdate" ></td>
			<td width=50><button name="submit" id="submit2">发布</button></td>
		</tr>
	</table>
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?> <button id="edit_priority">编辑优先级</button> <button id="clear_priority">清空优先级</button></td>
		</tr>
	</table>
	<input type="hidden" id="db_talbe" value="smg_zongcai_item">
</body>
</html>
<?php close_db();?>
<script>
	$("#submit1").click(function(){
		$.post("zongcai_vote.post.php",{'id':$("#id").attr('value'),'start_time':$("#start_time").attr('value'),'end_time':$("#end_time").attr('value')},function(data){
			window.location.reload();
		});
	});
	
	$("#submit2").click(function(){
		$.post("zongcai_vote.post.php",{'start_time':$("#start_time2").attr('value'),'end_time':$("#end_time2").attr('value')},function(data){
			window.location.reload();
		});
	});
	
	$("tr td img").click(function(){
		var name = $(this).attr('name');
		if($(this).parent().parent().next().is(':hidden')){
			$(this).attr('src','/images/admin/moners.gif');
			$("."+name).show();
		}else{
			$(this).attr('src','/images/admin/plus.gif');
			$("."+name).hide();
		}
	});
	
	$(".clear").click(function(){
		$.post("zongcai_vote.post.php",{'type':'clear','name':$(this).attr('name')},function(data){
			window.location.reload();
		});
	});
</script>
