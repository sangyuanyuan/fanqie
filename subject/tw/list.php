<?
  require_once('../../frame.php');
  $db = get_db();
  $id=$_REQUEST['id'];
  if($id=="")
  {
  	die();
  }
  if($id==)
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>smg</title>
	    <link href="css/smg.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="ibody">
		<div id="iibody">
			 <? require_once('inc/top.inc.php');?>
			 			<div id="left">
			 			<?php for($i=0;$i<20;$i++){ ?>
			 				<div class=list_content>
			 					<div class="content_d"></div>
			 					<div class=content></div>
			 				</div>
			 			<?php } ?>
			 			</div>
			 <? require_once('inc/right.inc.php');
			  require_once('inc/bottom.inc.php');?>
		</div>
	</div>
</body>