<?php
	require_once('../frame.php');
	$date = $_REQUEST['date'] ? $_REQUEST['date'] : date('Y-m-d');
	$today = substr($date, 5);
	$_COOKIE['smg']
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-生日日历</title>
	<? 	
		css_include_tag('server_calendar','top','bottom','thickbox');
		use_jquery();
		js_include_tag('total.js');
  ?>
	
</head>
<script>
	total("生日","server");
</script>
<body>
<? require_once('../inc/top.inc.html');
	js_include_tag('service/calendar','thickbox');
	$db = get_db();
	$birthday = $db->query("select a.nickname,a.loginname,b.name from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where birthday_short='$today' and hide_birthday!=1  order by a.org_id");
//	echo "select a.nickname,a.loginname,b.name from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where birthday_short='$today' order by a.org_id";
?>
<div id=ibody>
	<div class="l">
    		<div id="title"></div>
     	  <div id="menu">
     	  	<div id="menu2"><a href="birthday.php">我的生日</a></div>	
    	  	<div id="menu2"><a href="calendar.php">日历</a></div>
     	  	<div id="menu1">今日寿星</div>	
			<div id="menu2"><a href="send_gift_list.php">送礼列表</a></div>
     	  	<div id=date>TODAY <?php echo $date;?></div>
     	  </div>        
        <div id="context">
        	<div id="send_gift_day">

			<div id="left_div">
			<?php 
			foreach ($birthday as $v) {?>
				<div class="list_item" nickname="<?php echo $v->nickname;?>" loginname="<?php echo $v->loginname;?>">
					<b><?php echo "$v->nickname";?></b> [<span style="color:#AED5A2"><?php echo $v->name;?></span>]<a href="gift_shop.php?nickname=<?php echo urlencode($v->nickname);?>&loginname=<?php echo $v->loginname;?>"><img src="/images/server/gift.gif" border=0 title="送他/她礼物" class="send_gift_img"></a>
				</div>
			<?php }
			?>
			</div>		
		</div>	
        </div>
        
  </div>
  <div class="r"></div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

