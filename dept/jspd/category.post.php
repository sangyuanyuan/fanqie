<?php 
	require_once('../../frame.php');
	$category = new table_class('smg_jspd_jmcategory');
	$cid=$_POST['lmid'];
	if($_POST['type']!="del")
	{
		if($cid!=""){
			$category->find($cid);
		}
		
		$category->update_attributes($_POST['lm'],false);
		$category->save();
		alert('操作成功！');
		redirect('category_list.php');
	}
	else
	{
		$db=get_db();
		$db->execute('delete from smg_jspd_jmcategory where id='.$_POST['id']);
	}
?>