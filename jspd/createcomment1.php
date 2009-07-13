<?php
  require_once('../libraries/tableobject_class.php');
  require_once('../inc/pubfun.inc.php');
  $comment = new TableObject('smg_dept_comment');
  	$comment->commenter = iconv("utf-8","gbk",$_POST['commenter']);
  	$comment->content = iconv("utf-8","gbk",$_POST['comment']);
  	$comment->createtime = date('Y-m-d H:i:s');
  	$comment->ip = getenv('REMOTE_ADDR');
  	$comment->dept_id = $_POST['dept_id'];
  	$comment->title = iconv("utf-8","gbk",$_POST['title']);
  if (!$comment->Insert('id'))
  die(mysql_error());
  echo (iconv("gbk","utf-8",'发表成功!'));
  CloseDB();
 	redirecturl("/jspd/yhdjs.php");
 ?>