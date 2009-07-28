<?php
  include "../frame.php";
  $db = get_db();
  $date = $_REQUEST['date'];
  $birthday = $db->query("select a.nickname,a.loginname,b.name from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where birthday_short='$date' order by a.org_id");
  if(!$_REQUEST['hide_retdiv']){
  	echo "<div id=retdiv>";
  }
?>
<div id="send_gift_day">
	<div id=dates><?php echo $date ;?></div>
	<div id="left_div">
		<?php 
		foreach ($birthday as $v) {?>
			<div class="list_item" nickname="<?php echo $v->nickname;?>" loginname="<?php echo $v->loginname;?>">
				<b><?php echo "$v->nickname";?></b> [<span style="color:#AED5A2"><?php echo $v->name;?></span>]<a href="#"><img src="/images/server/gift.gif" border=0 title="送他/她礼物" class="send_gift_img"></a>
			</div>
		<?php }
		?>
	</div>
	
</div>
<script>
	$(function(){
		$('.send_gift_img').click(function(e){
			e.preventDefault();
			var ep = $(this).parent().parent();
			$('#retdiv').load('send_gift.php',{'date':'<?php echo $date;?>','nickname':$(ep).attr('nickname'),'loginname':$(ep).attr('loginname')});
		});
	});
</script>
<?php 
if(!$_REQUEST['hide_retdiv']){
  	echo "</div>";
  }
  ?>