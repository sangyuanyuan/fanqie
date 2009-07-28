<?php
if($_REQUEST['hide_retdiv']){
  	echo "<div id=retdiv>";
  }
?>
<div id=sendname><?php echo "赠送礼物给{$_REQUEST['nickname']}";?></div>
<div id="msg_box">
	您的大名<input type="text" id="name">	
	<div>
		您的祝福<textarea id="tcontent"></textarea><button id="submit">发送</button><button id="cancel">取消</button>
	</div>
</div>
<div id="right_div">
		<div id="gift_box">
			<?php
			if ($handle = opendir('../images/server/gifts')) {
			    while (false !== ($file = readdir($handle))) {
			        if ($file != "." && $file != "..") {
			            echo "<div class=\"gift\"><img src=\"/images/server/gifts/$file\" border=0>　　<input type=\"radio\" name=\"gift\"></div>";
			        }
			    }
			    closedir($handle);
			}
			?>
		</div>
	</div>
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
			if($('input:checked').length <= 0){
				alert('请选择礼物');
				return false;
			}
			var src = $('input:checked').prev().attr('src');
			$.post('send_gift.post.php',{'gift[reciever]':'<?php echo $_REQUEST["loginname"];?>','gift[sender]':sender,'gift[message]':tcontent,'gift[gift_src]':src},function(data){
				alert(data);
				$('#tcontent').val('');
			});
		});
		
		$('#cancel').click(function(){
			$('#retdiv').load('send_gift_day.php',{'date':'<?php echo $_REQUEST["date"];?>','hide_retdiv':true});
		});
	});
</script>
<?php 
if($_REQUEST['hide_retdiv']){
  	echo "</div>";
  }
  ?>