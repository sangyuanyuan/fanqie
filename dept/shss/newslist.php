<?php
	 require_once('../../frame.php');
	 $id = $_REQUEST['id'];
	 $name = dept_category_name_by_id($id);
	 $sql = 'select * from smg_news where dept_category_id='.$id.' and is_dept_adopt=1 order by dept_priority,created_at desc';
	 $db = get_db();
	 $record = $db->paginate($sql,25);
	 $count = count($record);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时尚传媒内网</title>
<style type="text/css">
<!--
body {
	background-image: url();
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #171717;
}
body,td,th {
	font-size: 12px;
}
a{
	text-decoration:none;
	color:#ffffff;
}
-->
</style></head>
<body >
<table width="980" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="images/xstitle.gif" width="941" height="95" /></td>
  </tr>
</table>
<div id="bg" style="width:941px; height:560px; margin-left:19px; background:url(images/newslist.gif) no-repeat;" >
	<div style="width:800px; height:40px; margin-top:20px; font-size:18px; font-weight:bold; color:#ffffff; margin-left:80px;  float:left; display:inline;"><? echo $name;?></div>
	<? for($i=0;$i<$count;$i++){?>
		<div style="width:900px; height:20px; margin-left:25px; float:left; display:inline;"><a target="_blank" href="news.php?id=<? echo $record[$i]->id;?>"><? echo $record[$i]->title;?></a></div>
	<? }?>
		<div style="width:941px; color:#ffffff; margin-left:25px; float:left; display:inline;">
		<?php paginate();?>
		</div>
</div>

<table width="980" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" height="106"><img src="images/bottom.gif" width="941" height="129" /></td>
  </tr>
</table>
</body>
</html>