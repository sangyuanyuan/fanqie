<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>传媒集团内网-对外事务</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #003366;
}
A{
text-decoration:none;
}
.border_orange {
	border: 1px solid #fd7521;
}
.left_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.mtitle {
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
body,td,th {
	font-size: 12px;
	color: #003366;
}
ul {
	list-style-position: inside;
	list-style-type: square;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 10px;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 10px;
	font-size: 12px;
	line-height: 140%;
}
.right_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.STYLE2 {color: #CCCCCC}
.STYLE3 {color: #FFFFFF}
.STYLE5 {font-size: 18px; font-weight: bold; color: #990000; }
-->
</style>
</head>

<body>
	<?
		if(!isset($_REQUEST['id'])) die('非法新闻类型！');
		$newsid = $_REQUEST['id'];
	?>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="22" background="/images/dwsw/topbg.gif"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style=color:white;font-size:12px>
      <tr>
        <td width="402">&nbsp;</td>
        <td width="498" align="right">date:2008.11.18</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/images/dwsw/title.jpg" width="950" height="135" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<?php
		$records = show_content('smg_link','link','对外事务部','indextop');
		$count = count($records);
	?>
    <td width="683" height="34" align="center" background="/images/dwsw/menu.gif"><span class="STYLE3"><? for($i=0;$i<$count;$i++){?><a style="color:#ffffff; text-decoration:none;" href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a>     &nbsp;|　<? }?> </span></td>
    <td width="183" background="/images/dwsw/menu.gif">
	    <label>
	      <input type="text" name="search" id="search" />
	    </label>
    </td>
    <td width="84" background="/images/dwsw/menu.gif"><input type="image" name="imageField" id="imageField" OnClick="searchnews('search')" src="/images/dwsw/search.gif" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="/images/dwsw/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><img src="/images/dwsw/spacer.gif" width="1" height="1" />
      <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
        	<?php
				$news = new table_class('smg_news');
				$news->find($newsid);
				$news->click_count = $news->click_count+1;
				$news->save();
	        ?>
          <td><div align="center"><span class="STYLE5"><? echo $news->title;?></span><br><br>
          来源：<? echo get_dept_info($news->dept_id)->name;?> 浏览次数：<? echo $news->click_count;?> 时间： <? echo $news->created_at;?></div></td>
        </tr>
        <tr>
          <td style="font-size:14px;">
            <div style="line-height:25px;"><? echo $news->content;?></div>
            </td></tr>
      </table></td>
    <td width="8" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
    
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="/images/dwsw/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td align="center" bgcolor="001c58"><span class="STYLE2">上海文广新闻传媒集团 版权所有</span></td>
  </tr>
</table>
</body>
</html>