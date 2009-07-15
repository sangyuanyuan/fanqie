<?php
	function echo_dialog_question($item,$index){
		if(!$item) return;
		echo "<div class=\"question_list\"><span class=\"question_index\"><b>$index.</b></span><span class=\"question_writer\"><b>{$item->writer}: </b></span>{$item->content}";
		echo '  <span class="question_time">' .$item->create_time .'</span>';
		echo ' <a href="#">评论</a> <span class="span_a" onclick="delete_question(event,' .$item->id .')">删除</a>';
		echo "</div>";
	}
?>