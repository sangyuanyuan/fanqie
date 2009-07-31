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
		<div id="gift_box" style="border-top:1px solid #666666;padding-top:5px;margin-top:5px;">
			<?php
			include "gift_category.php";
			
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
			var src = $('input:checked').prev().prev().prev().attr('src');

			$.post('send_gift.post.php',{'gift[reciever]':'<?php echo $_REQUEST["loginname"];?>','gift[sender]':sender,'gift[message]':tcontent,'gift[gift_src]':src},function(data){
				alert(data);
				$('#tcontent').val('');
			});
		});
		
		$('#cancel').click(function(){
			if($('#retdiv').length <= 0){
				tb_remove();
				return false;
			}
			$('#retdiv').load('send_gift_day.php',{'date':'<?php echo $_REQUEST["date"];?>','hide_retdiv':true});
		});
	});
</script>
<?php 
if($_REQUEST['hide_retdiv']){
  	echo "</div>";
  }
  ?>