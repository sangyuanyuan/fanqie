<input type="hidden" id="tg_id" name="tg_id" value="<? echo $_POST['tgid'];?>">
<?php
  require_once "../frame.php";
  use_jquery_ui();
  $cookie=(isset($_COOKIE['smg_username'])) ? $_COOKIE['smg_username'] : 0;
  $commenter=$_POST['comment']['commenter'];
  $vowels = array("~", "!", "@", "#", "$", "%", "^", "&", "*", "(",")");
  $commenter=str_replace($vowels,"",$commenter);
  if($commenter=="小番茄"||$commenter=="番茄小编")
  {
  		if($cookie!="01004660"&&$cookie!="01004645")
  		{?>
		<script>
			$(document).ready(function() {
	  			alert("特殊名字仅番茄网管理员才能使用！");
				var val = $("#tg_id").attr("value");
				window.location.href="/shop/spinfo.php?id="+val;
			});	
		</script>
<? exit;	
  	}
  }
  $menu = new table_class('smg_shop_comment');
  $menu->find($_POST['comment']['id']);
  $menu->update_attributes($_POST['comment']);
  $menu->save();
  redirect('/shop/spinfo.php?id='.$_POST['tgid']);
?>
