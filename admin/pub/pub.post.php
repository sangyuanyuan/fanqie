<?php
  require_once('../../frame.php');
	$post = new table_class($_POST['db_table']);
	if("del"==$_POST['post_type'])
	{
		if($_POST['db_table']=='smg_zongcai_item'){
			$post -> delete($_POST['del_id']);
			$db = get_db();
			$sql = 'delete from smg_zongcai_vote_item where item_id='.$_POST['del_id'];
			$db -> execute($sql);
			close_db();
			echo $_POST['del_id'];
		}else{
			$post -> delete($_POST['del_id']);
			echo $_POST['del_id'];
		}
	}elseif("return"==$_POST['post_type'])
	{
		if($_POST['return_id']!='')$post -> find($_POST['return_id']);
		$post->is_recommend = 2;
		$post->is_adopt = 0;
		$post -> save();
		echo $_POST['return_id'];
		
	}	
	elseif("edit"==$_POST['post_type'])
	{
		if($_POST['id']!='')$post -> find($_POST['id']);
		$post -> update_attributes($_POST['post']);
		redirect($_POST['url']);
		
	}
	elseif("edit_priority"==$_POST['post_type'])
	{
		echo "1";
		$id_str=explode("|",$_POST['id_str']); 
		$priority_str=explode("|",$_POST['priority_str']); 
		$id_str_num=sizeof($id_str)-1;
		if($_POST['is_dept_list']=='true'){
			$priority = 'dept_priority';
		}else{
			$priority = 'priority';
		}
		for($i=$id_str_num-1;$i>=0;$i--)
		{
			if($priority_str[$i]==""){$priority_str[$i]="100";}
			$db = get_db();
			$sql="update ".$_POST['db_table']." set ".$priority."=".$priority_str[$i]." where id=".$id_str[$i];
			$db->execute($sql);
		}
		echo "2";
	}
	
	elseif("revocation"==$_POST['type'])
	{
		if($_POST['id']!='')$post->find($_POST['id']);
		if($_POST['db_table']=='smg_zongcai_item'){
			$post->update_attribute("state","0");
			$db = get_db();
			$sql = 'delete from smg_zongcai_vote_item where item_id='.$_POST['id'];
			$db -> execute($sql);
			close_db();
		}else{
			if($_POST['is_dept_list']=='true'){
				$post->update_attribute("is_dept_adopt","0");
			}else{
				$post->update_attribute("is_adopt","0");
			}
		}
	}
	elseif("publish"==$_POST['type'])
	{
		if($_POST['id']!='')$post->find($_POST['id']);
		if($_POST['db_table']=='smg_zongcai_item'){
			$post->update_attribute("state","1");
			$db = get_db();
			$sql = 'insert into smg_zongcai_vote_item (vote_id,item_id) values ((select id from smg_zongcai_vote order by id desc limit 1),'.$_POST['id'].')';
			$db -> execute($sql);
			close_db();
		}else{
			if($_POST['is_dept_list']=='true'){
				$post->update_attribute("is_dept_adopt","1");
			}else{
				$post->update_attribute("is_adopt","1");
				$db = get_db();
				$phone=$db->query("select phone from smg_news where id=".$_POST['id']);
				
				if($phone[0]->phone!="")
				{
					$url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone=".$phone[0]->phone."&content=" .urlencode(iconv('utf-8','gbk','感谢您的报料，您的稿件已经在番茄网“网友报料”栏目发布，欢迎查阅！')) ."&sign=1";
					$fp = fopen($url,'r') ;
					fclose($fp);
				}
			}
		}
		

		
	}elseif("comment"==$_POST['type'])
	{
		$comment = new table_class('smg_comment');
		$comment -> update_attributes($_POST['post'],false);
		$comment->user_id = $_COOKIE['smg_userid'];
		$comment->created_at = date("Y-m-d H:i:s");
		$comment ->save();
	}
	
?>