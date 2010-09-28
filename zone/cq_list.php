<?php 
	require "../frame.php";
	$question_id = $_REQUEST['question_id'];
	$comment = new table_class('smg_comment');
	$comment = $comment->paginate('all',array('conditions' => "resource_type='dialog_question' and resource_id={$question_id}",'order' => 'id DESC'),5);
?>	
<?php
if($comment){
	$len = count($comment);
	for($i=0;$i<$len;$i++){
?>
<div class="q_comment_item">
	<div class="comment_list_time" style="text-align:left;"> <?php echo $comment[$i]->nick_name . ' ' .$comment[$i]->created_at;  ?></div>
	<div style="text-indent:5px;"><?php echo $comment[$i]->comment; ?></div>
</div>
<?php 
	}
	paginate('cq_list.php?question_id=' .$question_id,'q_comment_list');
} ?>