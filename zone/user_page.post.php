<?php
include '../frame.php';
if(!is_ajax()) die();
switch ($_GET['type']) {
	case 'sort':
		if(is_array($_GET['user_model_id'])){
			$len = count($_GET['user_model_id']);
			$db = get_db();
			for($i=0; $i < $len; $i++){
				$db->execute("update smg_user_page set pos_name='{$_GET['pos_name']}', pos_priority=" .($i +1) ." where id={$_GET['user_model_id'][$i]}");
			}
		}
		break;
	case 'delete':
		$tmp = explode('_',$_GET['id']);
		end($tmp);
		$id =  current($tmp);
		$db = get_db();
		if(intval($id) > 0){
			$db->execute("delete from smg_user_page where id={$id}");
		}
		break;
	default:
		;
	break;
}
