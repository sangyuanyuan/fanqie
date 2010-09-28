<?php
	require_once('../frame.php');
	$db = get_db();
	$key = $_REQUEST['key'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-寿星查询</title>
	<? 	
		css_include_tag('server_calendar','top','bottom');
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
			<div id="menu2"><a href="friend_list.php">我的好友</a></div>
     		<div id="menu2"><a href="calendar.php">日历</a></div>
			<div id="menu2"><a href="today.php">今日寿星</a></div>			
			<div id="menu2"><a href="send_gift_list.php">送礼列表</a></div>
			<div id="menu2"><a href="birthday_top.php">寿星排行</a></div>
			<div id="menu1">寿星查询</div>		
     	</div>
  
        <div id="context">
        	<div style="margin-top:20px; float:left; display:inline;">
			<form action="birthday.post.php" method="post">
				请输入要查询的姓名或工号<input name=search type="text" value="<?php echo $key;?>">
				<button type="submit" style="padding-top:10px;">开始查找</button>
			</form>
			</div>
			<?php if($key!=''){?>
			<div id="send_gift_day">
				<div id="left_div">
				<?php 
				$birthday = $db->query("select a.nickname,a.loginname,b.name from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where (a.nickname like '%".$key."%' or a.loginname='".$key."') and state=3 and hide_birthday!=1 and birthday_short!='' order by a.org_id");
				if(count($birthday)>0){
				foreach ($birthday as $v) {?>
					<div class="list_item" nickname="<?php echo $v->nickname;?>" loginname="<?php echo $v->loginname;?>">
						<b><a title="点击进入礼物列表" href="send_gift_list_detail.php?reciever=<?php echo $v->loginname;?>"><?php echo "$v->nickname";?></a></b> [<span style="color:#AED5A2"><?php echo $v->name;?></span>]<a href="gift_shop.php?nickname=<?php echo urlencode($v->nickname);?>&loginname=<?php echo $v->loginname;?>"><img src="/images/server/gift.gif" border=0 title="送他/她礼物" class="send_gift_img"></a>
					</div>
				<?php }}else{
					echo "查无此人！";
				}
				?>
				</div>		
			</div>
			<?php } ?>
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
