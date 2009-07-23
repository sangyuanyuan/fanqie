<?php
    require_once "../frame.php";
	
	if($_POST['type']=='name'){
		$result = name($_POST['boy_name'], $_POST['girl_name']);
		echo $result;
	}elseif($_POST['type']=='star'){
		$result = star($_POST['boy'], $_POST['girl']);
		echo $result;
	}elseif($_POST['type']=='lunar'){
		$result = lunar($_POST['boy'], $_POST['girl']);
		echo $result;
	}elseif($_POST['type']=='blood'){
		$result = blood($_POST['boy'], $_POST['girl']);
		echo $result;
	}elseif($_POST['type']=='marry'){
		$man = new table_class('smg_marry');
		$woman = new table_class('smg_marry');
		$man -> find($_POST['boy_id']);
		$woman ->find($_POST['girl_id']);
		
		$comment = new table_class('smg_marry_comment');
		$comment->nick_name = $_POST['nick_name'];
		$comment->comment = $_POST['comment'];
		$comment->boy_name = $man->name;
		$comment->girl_name = $woman->name;
		$comment->boy_photo = $man->photo;
		$comment->girl_photo = $woman->photo;
		$comment->n_sorce = name($man->name, $woman->name,2);
		$comment->s_sorce = star($man->star, $woman->star);
		$comment->b_sorce = blood($man->blood, $woman->blood);
		$comment->x_sorce = lunar($man->zodiac, $woman->zodiac);
		$comment->created_at = date("Y-m-d H:i:s");
		$comment->save();
	}
	
	
	function name($name1='',$name2='',$type=1){
		$db = get_db();
		$num1 = 0;
		$num2 = 0;
		if(ord(substr($name1, 0, 1))>122){
			$count = strlen($name1);
			for($i=0;$i<$count;$i=$i+3){
				$sql = 'select number from smg_wedding_chinese where chinese like "%'.substr($name1, $i, 3).'%"';
				$record = $db->query($sql);
				$num1 = $num1+$record[0]->number;
			}
		}else{
			$num1 = strlen($name1);
		}
		if(ord(substr($name2, 0, 1))>122){
			$count = strlen($name2);
			for($i=0;$i<$count;$i=$i+3){
				$sql = 'select number from smg_wedding_chinese where chinese like "%'.substr($name2, $i, 3).'%"';
				$record = $db->query($sql);
				$num2 = $num2+$record[0]->number;
			}
		}else{
			$num2 = strlen($name2);
		}
		$num = $num1+$num2;
		
		$sql = 'select content,score from smg_wedding_name where id='.$num;
		$record = $db->query($sql);
		if($type==1){
			return $record[0]->content;
		}else{
			return $record[0]->score;
		}
		close_db();
	}
	
	function star($name1='',$name2=''){
		$db = get_db();
		$sql = 'select score from smg_wedding_constellation where constellation1="'.$name1.'" and constellation2="'.$name2.'" or constellation2="'.$name1.'" and constellation1="'.$name2.'"';
		$record = $db->query($sql);
		return $record[0]->score;
		close_db();
	}
	
	function lunar($name1='',$name2=''){
		$db = get_db();
		$sql = 'select score from smg_wedding_zodiac where zodiac1="'.$name1.'" and zodiac2="'.$name2.'" or zodiac2="'.$name1.'" and zodiac1="'.$name2.'"';
		$record = $db->query($sql);
		return $record[0]->score;
		close_db();
	}
	
	function blood($name1='',$name2=''){
		$db = get_db();
		$sql = 'select score from smg_wedding_blood where blood1="'.$name1.'" and blood2="'.$name2.'" or blood2="'.$name1.'" and blood1="'.$name2.'"';
		$record = $db->query($sql);
		return $record[0]->score;
		close_db();
	}
?>