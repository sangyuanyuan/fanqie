<?php
  require_once('../libraries/tableobject_class.php');
  require_once('../inc/pubfun.inc.php');
  $comment = new TableObject('smg_dept_comment');
  $comment->commenter = $_REQUEST['commenter'];
  $comment->content = $_REQUEST['comment'];
  $comment->dept_id = 1;
  $comment->title = $_REQUEST['title'];
  $comment->createtime = Date('Y-m-d H:i:s');
  $comment->ip = getenv('REMOTE_ADDR');
  //print_r($comment);
  if (!$comment->Insert('id'))
  die(mysql_error());
  redirecturl("/fwb/lyb.php");
?>