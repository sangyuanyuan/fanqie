<?php
	require_once('../frame.php');
	$user_id = $_COOKIE['smg_username'];
	$db = get_db();
	$sql = 'select hide_birthday from smg_user_real where loginname="'.$user_id.'"';
	$record = $db->query($sql);
	$state = $record[0]->hide_birthday;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-生日</title>
	<? 	
		css_include_tag('server_birthday','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div class="l">
    	<div id="title"></div>
     	<div id="menu">
			<div id="menu1">我的生日</div>	
     	  	<div id="menu2">日历</div>
			<div id="contrl" value='<?php echo $state ?>' name="<?php echo $user_id;?>"><?php if($state==0){echo '屏蔽我的生日';}else{echo '开启我的生日';} ?></div>
     	  	<div id=date>TODAY <?php echo date("Y-m-d") ?></div>
     	</div>
  
        <div id="context">
			<?php
				$sql = 'select * from smg_birthday_gift where reciever="'.$user_id.'"';
				$records = $db->paginate($sql,9);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
			<div class=box>
				<div class=gift></div>
				<div class=info>
					<div class=giver><?php echo $records[$i]->sender; ?></div>
					赠送我&nbsp;<font color=#FF0000 style="font-weight:bolder;">生日礼物</font>
				</div>
				<div class=picture><img src="<?php echo $records[$i]->gift_src;?>" border=0 width=55 height=55></div>
				<div class=info>一份</div>
				<div class=message><?php echo $records[$i]->message; ?></div>
				<div class=date><?php echo substr($records[$i]->created_at, 0, 16); ?></div>
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
		$("#contrl").click(function(){
			if($(this).val()==0){
				$.post("birthday.post.php",{'id':$(this).attr('name'),'value':'1','type':'contrl'},function(data){
					if(data==''){
						alert('屏蔽成功！');
						window.location.reload();
					}else{
						alert(data);
					}
				});
			}else{
				$.post("birthday.post.php",{'id':$(this).attr('name'),'value':'0','type':'contrl'},function(data){
					if(data==''){
						alert('开启成功！');
						window.location.reload();
					}else{
						alert(data);
					}
				});
			}
		});
	});
</script>
