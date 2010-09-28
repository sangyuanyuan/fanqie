<?php
   require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-总裁奖投票结果显示</title>
	<?php 
		css_include_tag('top','bottom'); 
		js_include_once_tag('total');
	?>
</head>
<script>
	total("总裁奖投票结果显示","news");	
</script>
<body style="line-height:0;">
<?php require_once('../inc/top.inc.html');
	$db = get_db();
	$vote_id = $_REQUEST['vote_id'];
	$vote_type = $_REQUEST['type'];
	
	$sql = 'select t1.name,t1.id,t1.mobile from smg_zongcai_item t1 join smg_zongcai_vote_item t2 on t1.id=t2.item_id where t1.program_type="'.$vote_type.'" and t2.vote_id='.$vote_id;
	$item = $db->query($sql);
	$count = count($item);
	for($j=0;$j<$count;$j++){
		$item[$j]->mobile = 0;
	}
	
	$sql = 'select item_id from smg_zongcai_vote_record where type="'.$vote_type.'" and vote_id='.$vote_id;
	$record = $db->query($sql);
	$total_count = count($record);
	
	for($i=0;$i<$total_count;$i++){
		for($j=0;$j<$count;$j++){
			if($item[$j]->id==$record[$i]->item_id){
				$item[$j]->mobile = $item[$j]->mobile+1;
			}
		}
	}
	
	switch($vote_type){
	     case "tv_recommend":
	        $name = '电视推荐节目投票';
	        break;
	    case "tv_self":
	         $name = '电视自荐节目投票';
	        break;
	    case "broadcast_recommend":
	         $name = '广播推荐节目投票';
	        break;
		case "broadcast_self":
	         $name = '广播自荐节目投票';
	        break;
	}
	
	
?>
<div id=ibody style="width:995px; margin:0 auto; text-align:center; margin-top:10px; line-height:20px; display:inline">
<div style="width:995px; margin:0 auto; text-align:center; margin-top:10px; line-height:20px;"><b><?php echo $vote_name;?></b>投票结果<span style="color:#FF0000;"></span></div>
<div style="width:995px; margin:0 auto">
<table align="center"  border="0" bgcolor="#CCCCCC" cellspacing=1>
	<tr bgcolor="#CCCCCC" >
		<td colspan="4" align="center">
			<?php echo $name; ?>
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
			票数(共<?php echo $total_count;?>票)
		</td>
	</tr>
  <?php
    for($i=0;$i<$count;$i++)
    {
  ?>
	<tr align="center">
		<td bgcolor="#FFFFFF">
			<?php echo $i+1;?>
		</td>
		<td  bgcolor="#FFFFFF">
			<?php echo $item[$i]->name;?>
		</td>
		<td bgcolor="#FFFFFF" align=left>
			<?php 
				$count1 = ($total_count >0) ? ($item[$i]->mobile /$total_count) : 0;
				echo sprintf("%.2f",$count1 * 100) .'%';?>
				<div style="background:url('/images/votebg.gif') repeat-x; height:9px;width:<?php echo ceil($count1 * 100)*3;?>px;"></div>
		</td>
	  <td bgcolor="#FFFFFF">
	  	<?php echo $item[$i]->mobile;?>
	  </td>
	</tr>
	<?php
	}
	?>
</table>
</div>
</div>

<? require_once('../inc/bottom.inc.php');?>

</body>
</html>