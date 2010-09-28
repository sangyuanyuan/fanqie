<?php
  require_once('../libraries/tableobject_class.php');
  require_once('../inc/pubfun.inc.php');
  $comment = new TableObject('smg_news_comment');
  $comment->commenter = $_REQUEST['commenter'];
  $comment->content = $_REQUEST['comment'];
  $comment->createtime = Date('Y-m-d H:i:s');
  $comment->news_id = $_REQUEST['newsid'];
  $comment->ip = getenv('REMOTE_ADDR');
  $comment->clickcount =0;
  //print_r($comment);
  if (!$comment->Insert('id'))
  die(mysql_error());
  redirecturl("/jspd/news.php?id=" .$comment->news_id);
  CloseDB();
?>