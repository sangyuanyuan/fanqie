<?php
  require_once('../libraries/tableobject_class.php');
  require_once('../inc/pubfun.inc.php');
  $cookie=(isset($_COOKIE['smg_username'])) ? $_COOKIE['smg_username'] : 0;
  $commenter=$_REQUEST['commenter'];
  $vowels = array("~", "!", "@", "#", "$", "%", "^", "&", "*", "(",")");
  $commenter=str_replace($vowels,"",$commenter);
  if($commenter=="С����"||$commenter=="����С��")
  {
  		if($cookie!="01004660"&&$cookie!="01004645")
  		{
  			echo '<script language=javascript>alert("�������ֽ�����������Ա����ʹ�ã�")</script>';
				echo '<script language=javascript>window.location.href="/news/news.php?id='.$_REQUEST['newsid'].';</script>';
				exit;	
  		}
  }
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
  redirecturl("/szyd/news.php?id=" .$comment->news_id);
  CloseDB();
?>