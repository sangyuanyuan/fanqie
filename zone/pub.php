<?php
	function echo_dialog_question($item,$index){
		if(!$item) return;
		echo "<div class=\"question_list\"><span class=\"question_index\"><b>$index.</b></span><span class=\"question_writer\"><b>{$item->writer}: </b></span>{$item->content}";
		echo '  <span class="question_time">' .$item->create_time .'</span>';
		echo ' <a href="#">评论</a> <span class="span_a" onclick="answer_question('.$item->id.');">回复</span> <span class="span_a" onclick="delete_question(' .$item->id .')">删除</span>';
		echo "</div>";
	}
	
	function echo_dialog_answer($item,$index){
		echo "<div class=\"answer_question\"><span class=\"answer_question_index\"><b>$index.问题:</b></span>{$item->qcontent}<span class=\"question_time\"> $writer {$item->qcreate_time}</span></div>";
		echo "<div class=\"answer_answer\">{$item->content}  <span class=\"question_time\">$item->create_time</span>";
		echo ' <span class="span_a" onclick="edit_answer(' .$item->qid.','.$item->id .')">编辑</span>';
		echo ' <span class="span_a" onclick="delete_answer(' .$item->id .')">删除</span>';
		echo '</div>';
	}
?>