<?php
  require_once('../frame.php');
  if(date('Y-m-d')!="2010-09-18"){
	  session_start();
		if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
		{
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
			$comment->ip = getenv('HTTP_X_FORWARDED_FOR');
			$comment->save();
			$_SESSION["url"]="";
		}
		else
		{
			die('请从网站入口进入提交！');	
		}
	}
	else
	{
		alert('对不起今天关闭一切提交！');	
	}
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
<div class="comment_box"><span style="color:#FFFF00"><?php echo $record[$i]->nick_name?>说:</span><?php echo $record[$i]->comment;?></div>
<?php
	}
?>
</marquee>


