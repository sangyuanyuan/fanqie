<?php 
	require "../../frame.php";
	judge_role('admin');
	$db=get_db();
	if($_POST['subtype']=="add")
	{
		$news = new table_class('smg_admin_subject');
		$news->update_attributes($_POST['news'],false);
		$news->created_at = date("Y-m-d H:i:s");
		$news->save();
		alert('添加成功！');
	}
	else if($_POST['subtype']=="edit")
	{
		
		$subject=$db->query("select * from smg_admin_subject where id=".$_POST['subid']);
		$str="";
		if($subject[0]->title!=$_POST['news']['title'])
		{
			$str.="标题,";
		}
		if($subject[0]->description!=$_POST['news']['description'])
		{
			$str.="简短描述,";
		}
		if($subject[0]->remark!=$_POST['news']['remark'])
		{
			$str.="备注,";
		}
		if($subject[0]->state!=$_POST['news']['state'])
		{
			$str.="状态,";	
		}
		$db->execute('insert into smg_admin_subject_record (subject_id,user_id,type,content,created_at) values ('.$_POST['subid'].',"'.$_POST['czname'].'","更新",'.$str.',now())');
		echo 'insert into smg_admin_subject_record (subject_id,user_id,type,content,created_at) values ('.$_POST['subid'].',"'.$_POST['czname'].'","更新",'.$str.',now())';
		$news = new table_class('smg_admin_subject');
		$news->find($_POST['subid']);
		$news->update_attributes($_POST['news'],false);
		if($news->save())
		{
			alert('更新成功！');
		}
	}
	else if($_POST['subtype']=="del")
	{
		alert('insert into smg_admin_subject_record (subject_id,user_id,type,content,created_at) values ('.$_POST['subid'].',"'.$_POST['czname'].'","删除","",now())');
		$db->execute('insert into smg_admin_subject_record (subject_id,user_id,type,content,created_at) values ('.$_POST['subid'].',"'.$_POST['czname'].'","删除","",now())');
		$db->execute('update smg_admin_subject set is_del=1 where id='.$_POST['subid']);
		return "OK";
	}
	redirect('index.php');
?>