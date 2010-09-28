<? 
	require_once('../frame.php');
	$db=get_db();
	$commment=$db->query('select * from smg_comment where resource_type="zf" order by created_at desc');
	echo count($commment);
?>