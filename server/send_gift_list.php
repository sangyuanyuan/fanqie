<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-礼物列表</title>
	<? 	
		css_include_tag('server_birthday','top','bottom');
		use_jquery();
		js_include_tag('total.js');
  ?>
	
</head>
<script>
	total("生日","server");
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div class="l">
    	<div id="title"></div>
     	<div id="menu">
			<div id="menu2"><a href="birthday.php">我的生日</a></div>	
     		<div id="menu2"><a href="calendar.php">日历</a></div>
			<div id="menu2"><a href="today.php">今日寿星</a></div>			
			<div id="menu1">送礼列表</div>
			<div id="menu2"><a href="birthday_top.php">寿星排行</a></div>	
			<div id="menu2"><a href="birthday_search.php">寿星查询</a></div>	
     	</div>
  
        <div id="context">
			<?php
				$sql = "select sender,reciever,created_at,send_type,count(*) as icount ,b.nick_name from smg_birthday_gift a left join smg_user b on a.reciever = b.name group by sender,reciever,created_at, send_type order by a.id desc";
				$records = $db->paginate($sql,9);
				$count = count($records);
				for($i=0;$i<$count;$i++){
					$nick_name = $records[$i]->nick_name ? $records[$i]->nick_name : $records[$i]->reciever;
					$sender = urlencode($records[$i]->sender);
					$reciever = urlencode($records[$i]->reciever);					
					$url = "send_gift_list_detail.php?sender={$sender}&reciever={$reciever}&send_date={$records[$i]->created_at}&send_type={$records[$i]->send_type}";
					$send_type_string = $records[$i]->send_type == 1 ? '回赠' : '赠送';
			?>
			<div class=box style="float:left;display:inline">
				<div class=gift  style="float:left;display:inline"></div>
				<a>
				<div class=info  style="float:left;display:inline">
					<div class=giver><?php echo $records[$i]->sender; ?></div>
					<?php echo $send_type_string ;?> <b><?php echo $nick_name;?></b>&nbsp;<font color=#FF0000 style="font-weight:bolder;">生日礼物</font>
				</div>
				
				<div class=info  style="float:left;display:inline"><?php echo $records[$i]->icount;?> 份</div>
				<div class=message style="float:left;display:inline">　　　　　<?php echo substr($records[$i]->created_at, 0, 16); ?>
				 (<a href="<?php echo $url;?>" target="_blank">查看详细</a>)
				</div>
			</div>
			<?php } ?>
     		<div id=paginate><?php paginate();?></div>
        </div>
        
  </div>
  <div class="r"></div>
</div>
<?php
	close_db();
	require_once('../inc/bottom.inc.php');
?>

</body>
</html>

<script>
	$(function(){		
	});
</script>
