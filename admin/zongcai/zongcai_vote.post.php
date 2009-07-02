<?php
    require_once "../../frame.php";
	if($_POST['type']=='clear'){
		$db = get_db();
		$sql = 'delete from smg_zongcai_vote_item where item_id in (select id from smg_zongcai_item where program_type="'.$_POST['name'].'")';
		$db -> execute($sql);
		$sql = 'update smg_zongcai_item set state=0 where id in( select item_id from smg_zongcai_vote_item) and program_type="'.$_POST['name'].'"';
		echo $sql;
		$db -> execute($sql);
		close_db();
		
	}else{
		$zongcai_vote = new table_class('smg_zongcai_vote');
		$zongcai_vote->find($_POST['id']);
		$zongcai_vote->start_time = $_POST['start_time'];
		$zongcai_vote->end_time = $_POST['end_time'];
		$zongcai_vote->save();
		echo $zongcai_vote->id;
	}
	
?>