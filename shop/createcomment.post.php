<?php
  require_once "../frame.php";
  use_jquery_ui();
  $cookie=(isset($_COOKIE['smg_username'])) ? $_COOKIE['smg_username'] : 0;
  $commenter=$_POST['commenter'];
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
				window.location.href="/shop/spinfo.php?id=val";
			});	
		</script>
<? exit;	
  	}
  }
  $sql="insert into smg_shop_comment(commenter,content,createtime,ip,tg_id) value ('".$_REQUEST['commenter']."','".$_REQUEST['content']."','".Date('Y-m-d H:i:s')."','".getenv('REMOTE_ADDR')."',".$_REQUEST['tgid'].")";
  echo $sql;
  $db->execute($sql);
  get_current_url();
?>
<input type="hidden" id="tg_id" name="tg_id" value="<? echo $_REQUEST['tgid'];?>">