<?php
	function echo_dialog_question($item,$index,$dialog_id){
		if(!$item) return;
		$master_ids = get_master_ids($dialog_id);
		echo "<div class=\"question_list{$item->is_master}\"><span class=\"question_index\"><b>$index.</b></span><span class=\"question_writer\"><b>{$item->writer}: </b></span>{$item->content}";
		echo '  <span class="question_time">' .$item->create_time .'</span>';
		#echo ' <a href="comment_question.php?height=310&width=661&question_id='.$item->id .'" title="评论问题" class="comment_href">评论</a>';
		echo ' <a href="#" onclick="show_comment_box(' .$item->id .')">评论</a>';
		if(in_array($_COOKIE['smg_username'], $master_ids)){
			echo ' <span class="span_a" onclick="answer_question('.$item->id.');">回复</span> <span class="span_a" onclick="delete_question(' .$item->id .')">删除</span>';
		}
		echo "</div>";
	}
	
	function echo_dialog_answer($item,$index,$dialog_id){
		$master_ids = get_master_ids($dialog_id);
		echo "<div class=\"answer_question\"><span class=\"answer_question_index\"><b>$index.问题:</b></span>{$item->qcontent} <span class=\"question_time\"> {$item->writer} {$item->qcreate_time}</span></div>";
		echo "<div class=\"answer_answer\"><span style=\"color:red;\"></span>{$item->content}  <span class=\"question_time\">$item->create_time</span>";
		if(in_array($_COOKIE['smg_username'], $master_ids)){
			echo ' <span class="span_a" onclick="edit_answer(' .$item->qid.','.$item->id .')">编辑</span>';
			echo ' <span class="span_a" onclick="delete_answer(' .$item->id .')">删除</span>';
		}
		echo '</div>';
	}
	
	function echo_dialog_comment($item){
		$str = "<div class=\"comment_list_item\"><span class=\"comment_list_writer\">{$item->nick_name}:</span>";
		$str .= "<span class=\"comment_list_content\">";
		if($item->reserve){
			$str .= "<div class=\"comment_question\"><span style=\"color:#EFEFEF;\"><b>问题:</b></span>{$item->reserve}</div>";
		}		
		$str .="{$item->comment}</span><div class=\"comment_list_time\">{$item->created_at}</div></div>";
		echo $str;
	}
	
	function get_master_ids($dialog_id){
		global $g_master_ids;
		
		if($g_master_ids){
			return $g_master_ids;
		}
		$g_dialog = new table_class('smg_dialog');		
		$g_dialog = $g_dialog->find($dialog_id);			
		$g_master_ids = explode(',',$g_dialog->master_ids);
		$db = get_db();
		$db->query('select leader_id from smg_dialog_leader where dialog_id=' .$dialog_id);
		if($db->record_count > 0){
			$db->move_first();
			do{
				$g_master_ids[] = $db->field_by_name('leader_id');
			}while($db->move_next());
		}
		return $g_master_ids;
		
	}
?>