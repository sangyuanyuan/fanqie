<?php
require_once('../frame.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海广播电视台、上海东方传媒（集团）有限公司期许</title>
<style><!--@import url(inc/style.css);--></style>
<?php
	css_include_tag('thickbox');
  use_jquery();
	js_include_once_tag('total','thickbox');
?>
<script>
	total("地震祝福","other");
</script>
</head>
<body>
<div id="header">
</div>
<div id="main">
	<div id="btnqf" ><a class="thickbox" href="comment.php?height=255&width=320">我要祈福</a></div>
	<?php $db=get_db();$comment=$db->query('select * from smg_comment where resource_type="zf" order by created_at desc'); ?>
	<div id="gd"><marquee height="35" width="980" scrollamount="6" onmouseover=this.stop() onmouseout=this.start()><?php for($i=0;$i<count($comment);$i++){ echo $comment[$i]->nick_name.':'.$comment[$i]->comment.'　'; }?></marquee-</div>
</div>
</body>
</html>
