<?php
  require_once('../../frame.php');
  $id = $_REQUEST['id'];
  $news = new table_class('smg_news');
  $news->find($id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时尚传媒内网</title>
<?php 
	js_include_once_tag('total');
?>
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
<script>
	total("时尚传媒新闻","news");	
</script>
<body >
<table width="980" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="images/xstitle.gif" width="941" height="95" /></td>
  </tr>
</table>
<?php
  $news->click_count = $news->click_count+1;
  $news->save();
  
  if($news->news_type==2){
		redirect($news->file_name);
  }elseif($news->news_type==3){
		redirect($news->target_url);
  }
 ?>
<div id="bg" style="width:941px; height:560px; margin-left:19px; color:#ffffff; background:url(images/newslist.gif) no-repeat; float:left; display:inline;" >	
	<div style="width:800px; height:40px; margin-top:20px; font-size:18px; font-weight:bold; color:#ffffff; margin-left:80px;  float:left; display:inline;"><? echo $news->title;?></div>
	<div style="width:900px; height:460px; margin-left:25px; overflow:hidden; float:left; display:inline;">
		<!--<div style="width:900px; height:20px; font-size:16px; font-weight:bold; text-align:center; float:left; display:inline;"><? echo $news->title;?></div>-->
		<div style="width:900px; height:20px; font-size:12px; font-weight:bold; text-align:center; float:left; display:inline;">来源：<?php echo get_dept_info($news->dept_id)->name; ?>  浏览次数：<?php echo $news->click_count;?>  时间： <?php echo $news->created_at;?></div>
		<div style="width:900px; font-size:12px; font-weight:bold; text-align:center; float:left; display:inline;"><?php echo get_fck_content($news->content); ?></div>
		<div style="width:900px; height:20px; font-size:12px; font-weight:bold; text-align:center; float:left; display:inline;"><?php print_fck_pages($news->content,'news.php?id='.$id); ?></div>
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