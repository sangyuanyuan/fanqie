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
     	</div>
  
        <div id="context">
			<?php
				$sql = "select a.*,b.nick_name from smg_birthday_gift a left join smg_user b on a.reciever = b.name order by id desc";
				$records = $db->paginate($sql,9);
				$count = count($records);
				for($i=0;$i<$count;$i++){
					$nick_name = $records[$i]->nick_name ? $records[$i]->nick_name : $records[$i]->reciever;
			?>
			<div class=box style="float:left;display:inline">
				<div class=gift  style="float:left;display:inline"></div>
				<div class=info  style="float:left;display:inline">
					<div class=giver><?php echo $records[$i]->sender; ?></div>
					赠送 <b><?php echo $nick_name;?></b>&nbsp;<font color=#FF0000 style="font-weight:bolder;">生日礼物</font>
				</div>
				<div class=picture  style="float:left;display:inline"><a href="<?php echo $records[$i]->gift_src;?>" target=_blank><img src="<?php echo $records[$i]->gift_src;?>" border=0 width=55 height=55></a></div>
				<div class=info  style="float:left;display:inline">一份</div>
				<div class=message style="float:left;display:inline"><?php echo $records[$i]->message; ?>　　　　　<?php echo substr($records[$i]->created_at, 0, 16); ?>
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
