<?php
	require_once('../../frame.php');
	$db=get_db();
	$id=$_REQUEST['id'];
	if($id!="")
	{
		$lmname=$db->query('select * from smg_jspd_jmcategory where id='.$id);
	}
?>
<form enctype="multipart/form-data" action="category.post.php" method="post"> 
<table>
<tr>
<td>栏目名称：</td>
<td><input type="text" name="lm[name]" value="<?php echo $lmname[0]->name; ?>"><input type="hidden" name="lmid" value="<?php echo $id; ?>"></td>
</tr>
<tr><td></td><td height=30><input type="submit" value="提交"></td></tr>
</table>
</form>