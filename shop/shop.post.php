<? 
require_once '../frame.php';
require_once "../lib/upload_file_class.php";
$upload=new upload_file_class();

if($_POST['type']=='insert')
{
	$upload->save_dir = "/upload/photo/";
	$upload->max_file_size = 1048576;
	$pic=$upload->handle('upfile','filter_pic');
	$pic="/upload/photo/".$pic;
	$db=get_db();
	$StrSql='insert into smg_shopdp (name,username,shopurl,createtime) values ("'.$_POST['dpname'].'","'.$_POST['creater'].'","'.$pic.'",now())';
	$db->execute($StrSql);
?>
<script>
	$(document).ready(function() {
		alert("提交成功！");
		window.location.href="/shop/shoplist.php";
	});	
</script>
<?
	exit;
}

if($_POST['type']=='update')
{
	$upload->save_dir = "/upload/photo/";
	$upload->max_file_size = 1048576;
	$pic=$upload->handle('upfile','filter_pic');
	$pic="/upload/photo/".$pic;
	  if(!empty($pic))
	  {
			$StrSql="update  smg_shopdp set name='".$_POST['dpname']."',shopurl='".$pic."', remark='" .$_POST['content'] ."' where id=" .$_POST['shopid'] ;
		}else
		{
			$StrSql="update  smg_shopdp set name='".$_POST['dpname']."', remark='" .$_POST['content'] ."' where id=" .$_POST['shopid'] ;
		}
		$db=get_db();
		$db->execute($StrSql);
?>
<script>
	$(document).ready(function() {
		alert("更新成功！");
		window.location.href="/shop/shoplist.php";
	});
</script>
<?
	exit;
}

?>