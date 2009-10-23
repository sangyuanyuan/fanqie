<?php
    require_once('../frame.php');
	
	//var_dump($_POST);
	$comment = new table_class('smg_comment');
	if($_POST['name']!=''){
		$comment->nick_name = $_POST['name'];
	}else{
		$comment->nick_name = '匿名用户';
	}
	
	$comment->comment = $_POST['comment'];
	$comment->resource_type = 'zone_video';
	$comment->resource_id = 0;
	$comment->created_at = date("Y-m-d H:i:s");
	$comment->ip = $_SERVER['REMOTE_ADDR'];
	$comment->save();
	$db = get_db();
?>
<marquee height="150" width="170" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
<?php
	$db = get_db();
	$sql = "select nick_name,comment from smg_comment where resource_type='zone_video' order by created_at desc";
	$record = $db->query($sql);
	$count = count($record);
	close_db();
	for($i=0;$i<$count;$i++){
?>
<div class="comment_box"><?php echo $record[$i]->nick_name."说：".$record[$i]->comment;?></div>
<?php
	}
?>
</marquee>


