<?php
	require_once('../frame.php');
	$ip=getenv('HTTP_X_FORWARDED_FOR');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
	 	if($_POST['type']=='comment'){
	 		$comment = new table_class('smg_comment');
			$comment ->update_attributes($_POST['post'],false);
			if($_POST['resource_type']!="firstjiang")
			{
				$table_change = array('<p>'=>'');
				$table_change += array('</p>'=>'');
				$comment->comment = strtr($comment->comment,$table_change);
			}
			$comment->created_at = date("Y-m-d H:i:s");
			if($comment->nick_name==''){
				$comment->nick_name = '匿名用户';
			}
			$comment->ip=$ip;
			$comment -> save();
			$_SESSION['url']="";
			redirect($_SERVER['HTTP_REFERER']);		
	 	}elseif($_POST['type']=='flower'){
	 		if($_POST['sendtype']!='wxh')
	 		{
			 	if($_POST['db_table']!=''){
			 		$table = new table_class($_POST['db_table']);
					$table->find($_POST['id']);
					$table->update_attribute('flower',$table->flower+1);
			 	}
			}
		 	$ip=getenv('REMOTE_ADDR');
			$type = 'flower';
			$file_type = $_POST['digg_type'];
			$diggtoid = $_POST['id'];
			$sql="insert into smg_digg(ip,type,diggtoid,file_type) values('".$ip."','".$type."',".$diggtoid.",'".$file_type."')";
			$db = get_db();
			$db->execute($sql);
	 	}elseif($_POST['type']=='tomato'){
		 	$table = new table_class($_POST['db_table']);
			$table->find($_POST['id']);
			$table->update_attribute('tomato',$table->tomato+1);
		 	$ip=getenv('REMOTE_ADDR');
			$type = 'tomato';
			$file_type = $_POST['digg_type'];
			$diggtoid = $_POST['id'];
			$sql="insert into smg_digg(ip,type,diggtoid,file_type) values('".$ip."','".$type."',".$diggtoid.",'".$file_type."')";
			$db = get_db();
			$db->execute($sql);
	 	}elseif($_POST['type']=='star'){
	 		$table = new table_class('smg_star_point');
			$table->type = $_POST['r_type'];
			$table->resource_id = $_POST['id'];
			$table->point = $_POST['value'];
			$table->save();
	 	}elseif($_POST['type']=='cream')
	 	{
	 		$table = new table_class('smg_news');
			$table->find($_POST['id']);
			$table->update_attribute('cream',$table->cream+1);
	 	}
	}
	else
	{
		die('请从正常入口进入提交页面！');	
	}
?>