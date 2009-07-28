<?php
   require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-投票结果显示</title>
	<?php css_include_tag('top','bottom'); ?>
</head>
<body>
<?php require_once('../inc/top.inc.html');
	$db = get_db();
	$vote = new table_class('smg_vote');
	$vote->find($_REQUEST['vote_id']);
	$vote_name = $vote->name;
	if($vote->vote_type != 'more_vote'){
		$sql = "select sum(vote_count) from smg_vote_item where vote_id={$vote->id}";
		$db->query($sql);
		$name[] = $vote->name;		
		$total_count[] = $db->field_by_index(0);
		$vote_items[] = $db->query('select * from smg_vote_item where vote_id=' .$vote->id);
		$len[] = $db->record_count;
	}else{
		$vote_tmp = $db->query('select sub_vote_id from smg_vote_item where vote_id =' .$vote->id);
		foreach ($vote_tmp as $v) {
			$vote->find($v->field_by_index(0));
			$sql = "select sum(vote_count) from smg_vote_item where vote_id={$vote->id}";
			$db->query($sql);
			$name[] = $vote->name;		
			$total_count[] = $db->field_by_index(0);
			$vote_items[] = $db->query('select * from smg_vote_item where vote_id=' .$vote->id);
			$len[] = $db->record_count;
		}
	}
	$vote_len = count($name);
?>
<div id=ibody style="width:995px; margin:0 auto; text-align:center; margin-top:10px; line-height:20px; display:inline">
<div style="width:995px; margin:0 auto; text-align:center; margin-top:10px; line-height:20px;"><b><?php echo $vote_name;?></b>投票结果:<span style="color:#FF0000;"></span></div>
<?php 
   for($j=0;$j < $vote_len; $j++){
?>
<table align="center"  border="0" bgcolor="#CCCCCC" cellspacing=1>
	<tr bgcolor="#CCCCCC" >
		<td colspan="4" align="center">
			<?php echo $name[$j];?>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" width=20>
			&nbsp
		</td>
		<td bgcolor="#FFFFFF">
			选项
		</td bgcolor="#FFFFFF">
		<td bgcolor="#FFFFFF" width=300>
			比例
		</td>
		<td bgcolor="#FFFFFF">
			票数(共<?php echo $total_count[$j];?>票)
		</td>
	</tr>
  <?php
    for($i=0;$i<$len[$j];$i++)
    {
  ?>
	<tr align="center">
		<td bgcolor="#FFFFFF">
			<?php echo $i+1;?>
		</td>
		<td  bgcolor="#FFFFFF">
			<?php echo $vote_items[$j][$i]->title;?>
		</td>
		<td bgcolor="#FFFFFF" align=left>
			<?php 
				$count = ($total_count[$j] >0) ? ($vote_items[$j][$i]->vote_count /$total_count[$j]) : 0;
				echo sprintf("%.2f",$count * 100) .'%';?>
				<div style="background:url('/images/votebg.gif') repeat-x; height:9px;width:<?php echo ceil($count * 100)*3;?>px;"></div>
		</td>
	  <td bgcolor="#FFFFFF">
	  	<?php echo $vote_items[$j][$i]->vote_count;?>
	  </td>
	</tr>
	<?php	
	}
	?>
</table>
<?php
   }
   ?>
</div>

<? require_once('../inc/bottom.inc.php');?>

</body>
</html>