<input type="hidden" id="tgid" name="tgid" value="<? echo $_POST['tg_id'];?>">
<?
	require_once "../frame.php";
	use_jquery_ui();
	$db=get_db();
	$StrSql='insert into smg_shop_signup(tg_id,name,spname,num,phone,address,createtime,remark) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'")';
	echo $StrSql;
	$db->execute($StrSql);
?>
	<script>
		$(document).ready(function() {
			alert("提交成功！");
			var val = $("#tgid").attr("value");
			window.location.href="/shop/spdg.php?id="+val;
		});	
	</script>
<?
	exit;
?>