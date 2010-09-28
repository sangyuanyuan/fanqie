<?php
	require_once('frame.php');

   $db = get_db();
	$sql = "select * from smg_org_dept";
	$record = $db->query($sql);
	
	for($i=0;$i<count($record);$i++){
		$record2[0] = $record[$i];
		while($record2[0]->orgid!=$record2[0]->parentid){
			$sql = "select * from smg_org_dept where orgid='".$record2[0]->parentid."'";
			$record2 = $db->query($sql);
		}
		$sql = "update  smg_org_dept set center_id='".$record2[0]->parentid."' where id=".$record[$i]->id;
		echo $sql;
		echo "</br>";
		$db->execute($sql);
	}
?>