<?php
   require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-投票结果显示</title>
</head>
<body>
<? require_once('../inc/top.inc.html');
	$db = get_db();
	$voteitem=$db->query("select * from smg_vote_item where vote_id=".$_REQUEST['vote_id']);
	$count=$db->query("select count(*) as num from smg_vote_item_record where vote_id=".$_REQUEST['vote_id']);
	$allcount=count($count);

//echo "select * from " .$_REQUEST['tablepre'] ."vote_item where vote_id=" .$_REQUEST['vote_id'] ." order by priority asc";

?>
<div id=ibody>
<div>总共<span style="color:#FF0000;"><?php echo $allcount;?></span>人参加</div>
<table  border="0" bgcolor="#CCCCCC" cellspacing=1>
	<tr bgcolor="#CCCCCC" >
		<td colspan="4" align="center">
			<?php echo $vote->title;?>
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
			票数
		</td>
	</tr>
  <?php
    for($i=0;$i<count($voteitem);$i++)
    {
    	$vote=$db->query("select count(*) as value from where item_id=".$voteitem[$i]->id);
  ?>
	<tr>
		<td bgcolor="#FFFFFF">
			<?php echo $i+1;?>
		</td>
		<td  bgcolor="#FFFFFF">
			<?php echo $voteitem[$i]->title;?>
		</td>
		<td bgcolor="#FFFFFF" align=left>
			<?php 
				$count = $vote[0]->value;
				$count = ($allcount >0) ? ($count/$allcount) : 0;
				echo sprintf("%.2f",$count * 100) .'%';?>
				<div style="background:url('/images/votebg.gif') repeat-x; height:9px;width:<?php echo ceil($count * 100)*3;?>px;"></div>
		</td>
	  <td bgcolor="#FFFFFF">
	  	<?php echo $voteitems[$i]->itemvalue;?>
	  </td>
	</tr>
	<?php	
	}
	?>
</table>
<div style="text-align:left; float:left; display:inline;">
	<? for($i=0;$i<count($comments);$i++){?>
    <div class=content7>
    	<div class=name><a href="#"><?php echo $comments[$i]->commenter; ?></a></div>	
    	<div class=time><?php echo $comments[$i]->createtime; ?></div>	
    	<div class=context><?php echo strfck($comments[$i]->content); ?></div>	
    </div>
  <?php }?>
  <div class="pageurl">
     <?php 
        echo paginate("vote_show.php?id=" .$_REQUEST['vote_id']);   
     ?>
   </div>
</div>
<?
  echo '</div>';
?>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>