<?php
  require_once('../libraries/tableobject_class.php');
  require_once('../inc/pubfun.inc.php');
  $comment = new TableObject('smg_subject_comment');
  $comment->commenter = $_REQUEST['commenter'];
  $comment->content = $_REQUEST['comment'];
  $comment->createtime = Date('Y-m-d H:i:s');
  $comment->ip = getenv('REMOTE_ADDR');
  //print_r($comment);
  if (!$comment->Insert('id'))
  die(mysql_error());
  
  //backurl();
  redirecturl("/subject/subject.php");
?>