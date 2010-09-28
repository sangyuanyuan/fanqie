<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-生日日历</title>
	<? 	
	 	include "../frame.php";
		css_include_tag('server_calendar','top','bottom','thickbox');
		use_jquery();
		js_include_tag('total.js');
		$send_type = $_REQUEST['send_type'] ? $_REQUEST['send_type'] : 0;
  ?>
	
</head>
<script>
	total("生日","server");
</script>
<body>
<? require_once('../inc/top.inc.html');
	js_include_tag('service/calendar','thickbox');
	$db = get_db();
	$gift_ids = $_REQUEST['gift_ids'];
	if(!$gift_ids){
		alert('系统错误');
		redirect('calendar.php');
		exit;
	}
	$gifts = $db->query("select * from smg_gift where id in ($gift_ids)");
?>
<div id=ibody>
	<div class="l">
    		<div id="title"></div>
			<div id=sendname><?php echo "赠送礼物给{$_SESSION['smg_gift_nickname']}";?></div>
			<div id="msg_box">
				　您的大名<input type="text" id="name" value="<?php echo $_COOKIE['smg_user_nickname'];?>">	
				<div>
					　您的祝福<textarea id="tcontent"></textarea><button id="submit" style="width:100px; height:25px; line-height:13px;">发送祝福</button>
				</div>
			</div>
			<div id="right_div">				
					<div id="gift_box" style="padding-top:5px;margin-top:5px;">
						<?php
						foreach ($gifts as $v) {
							echo "<div class=\"gift_item\" style='margin-left:10px; float:left; display:inline;'><img src=\"{$v->img_src}\" width=105px  height=60px>{$v->name} </div> ";
						}
						
						?>
					</div>
				</div>
</div>
  <div class="r"></div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>				
<script>
	$(function(){
		$('#submit').click(function(){
			var sender = $('#name').val();
			if(sender == ''){
				alert('请填写您的大名!');
				return false;
			}
			var tcontent = $('#tcontent').val();
			if(tcontent == ''){
				alert('请填写您的祝福!');
				return false;
			}					
			var send_type = <?php echo $send_type;?>;
			$.post('send_gift.post.php',{'gift_ids':'<?php echo $_REQUEST["gift_ids"];?>','gift[sender]':sender,'gift[message]':tcontent,'gift[send_type]':send_type},function(data){
				alert('恭喜您，赠送礼物成功！');
				window.location.href = 'today.php';
			});
		});		
	});
</script>
<?php 
if($_REQUEST['hide_retdiv']){
  	echo "</div>";
  }
  ?>