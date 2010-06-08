<?php 
	require "../frame.php";
	
	$pop = new table_class('smg_pop_task');
	$pop->update_attributes($_POST['pop'],false);
	$pop->created_at = date("Y-m-d H:i:s");
	$pop->content = str_replace("'",'\"',$pop->content); 
	$pop->content = str_replace("<a",'<a target="_blank"',$pop->content); 
	$pop->save();
	$db=get_db();
	$full_path='http://'.$_SERVER['HTTP_HOST'].'/pop/pop_content.php';
	$fcontent="";
	$fp= fopen($full_path,'r');
	while(!feof($fp))
	{
  		$fcontent=$fcontent.fgets($fp,4096);
	}
	fclose($fp);
	$id=$db->query('select id from smg_pop_task order by id desc');
	$db->execute("update smg_pop_task set content='".$fcontent."' where id=".$id[0]->id);
	$db->execute('insert into smg_pop_task_bak(pop_type,created_at,height,width,content)(select pop_type,created_at,height,width,content from smg_pop_task order by id desc limit 1)');
	$db->execute("delete from smg_pop_task where created_at <= 'dateadd(d,-2,now)' & '23:59:59'");
	$db->execute("delete from smg_pop_history where created_at <= 'dateadd(d,-2,now)' & '23:59:59'");
	alert('发布成功！等待审核');
	redirect('index.php');
?>