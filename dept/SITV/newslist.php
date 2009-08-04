<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>传媒集团内网-SITV</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFF;
	background-image: url();
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
	color: #FFF;
}
body,td,th {
	font-size: 12px;
	color: #003366;
}
A{
	color:#003366;
	text-decoration:none;
}
A:visited{
	color:#003366;
	text-decoration:none;
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
.STYLE3 {
	color: #333
}
.date {
	color: #FFF;
	font-family: "Arial Black", Gadget, sans-serif;
}
.tableborder {
	border: 1px solid #CCC;
	font-size: 16px;
}
-->
</style>
</head>

<body>
	<?php
		if(!isset($_REQUEST['id'])) die('非法新闻类型！');
		$listid = $_REQUEST['id'];
		$db = get_db();
		$sql = 'select * from smg_news where dept_category_id='.$listid.' and is_dept_adopt=1 order by dept_priority,created_at desc';
		$newslist = $db->query($sql);
	?>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="22" background="images/topbg.gif"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style=color:white;font-size:12px>
      <tr>
        <td width="402">&nbsp;</td>
        <td width="498" align="right" class="date"><?php echo strftime("%Y年").strftime("%m月").strftime("%d日");?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/021209SITV.jpg" width="950" height="137" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<?php
		$records = show_content('smg_link','link','文广互动','头部链接');
		$count = count($records);
	?>
    <td height="34" align="center" background="images/menu.gif"><span class="STYLE3"><? for($i=0;$i<$count;$i++){?><a style="text-decoration:none;" href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<? }?></span></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="950"  align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td style="border:1px solid #bbbbbb;" width="257" valign="top" bgcolor="#EBEBEB">
    	<table width="250" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td align="center"><table width="250" border="1" cellpadding="5">
          </table></td>
        </tr>
      </table>
      <table width="250" cellspacing="0" cellpadding="0">
        <tr>
        	<?php
		  		$records = show_content('smg_video','video','文广互动','index_video','1');
				$count = count($records);
		 	?>
          <td><span style="margin-left:5px; float:left; display:inline;"><? show_video_player(250,190,$records[0]->photo_url,$records[0]->video_url);?></span></td>
        </tr>
        <tr><td height=10 ></td></tr>
      </table>
      <table width="250"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','公司简介','1');
             ?>
          <td height="26" background="images/blue_titlebg.gif" class="left_title">公司简介</td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;"><ul>
            <li><a href="content.php?id=<? echo $records[0]->id;?>"><? echo $records[0]->description;?></a></li>    
          </ul>
            <p align="right"></p>
          </td>
        </tr>
      </table>
      <table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','关于我们','6');
					$count = count($records);
             ?>
          <td height="26" background="images/blue_titlebg.gif" class="left_title">关于我们</td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;">
          	<ul>
          <? for($i=0;$i<$count;$i++){?>
            <li><a href="content.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title;?></a></li>
            <? }?>
          </ul>
          </td>
        </tr>
    </table>
    <table width="250" border="0" align="center" cellspacing="0" cellpadding="0">
        <tr>
        	 <?php
				$records = show_content('smg_link','link','文广互动','我们的链接','8');
				$count = count($records);
            ?>
          <td height="25" background="images/right_titlebg.gif" class="right_title">我们的链接</td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;"><ul>
          	<? for($i=0;$i<$count;$i++){?>
              <li><a href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a></li>
              <? }?>
          </ul>
          <p>&nbsp;</p></td>
        </tr>
      </table>
      <table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="26" background="images/blue_titlebg.gif" class="left_title">访问统计</td>
        </tr>
        <tr>
          <td>
          	<? //$report=getcategoryreport();?>
          	<ul>
          		<? //for($i=0;$i< $report->itemcount;$i++){?>
            <div><div style="float:left; display:inline;"><? //echo $report->items[$i]->name;?></div><div style="float:right; display:inline;"><? //echo $report->items[$i]->clickcount;?></div></div><br>
            <? //}?>
          </ul><br>
          <span style="margin-left:20px;"><input type="text" name="search" id="search" />　<button style="width:63px; height:23px; border:none; background:url('images/search.gif')" OnClick="searchnews('search')"></button></span>
          <p align="right">&nbsp;</p></td>
        </tr>
    </table></td>
    <td width="5" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td valign="top">
      <table width="100%" border="0" cellpadding="15" cellspacing="0">
        <tr>
          <td height="800" valign="top" class="tableborder">
          	<?php
			$db = get_db();
			$link_id = dept_category_id_by_name('我们的链接','文广互动','link');
          	if($listid!=$link_id)
          	{
          		$newslist = $db->query('select * from smg_news where is_dept_adopt=1 and dept_category_id='.$listid.'  order by dept_priority asc , created_at desc');
          	}
          	else
          	{
          		$newslist = $db->query('select * from smg_link where category_id='.$listid.' order by priority asc');
          	}
          	for($i=0;$i< count($newslist);$i++){?>
          	<ul>
              <li>
                <!-- <span>(12/03 09:43)</span> -->
                <? if($listid!=$link_id){?>
                <a href="content.php?id=<? echo $newslist[$i]->id;?>" target="_blank"><? echo $newslist[$i]->title;?></a>
                <? }else{?>
                	<a href="<? echo $newslist[$i]->link;?>" target="_blank"><? echo $newslist[$i]->name;?></a>
                <? }?>
              </li>
            </ul>
            <? }?>
            </td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="10" cellspacing="0" background="images/bottom.gif">
  <tr>
    <td align="center" bgcolor="001c58"><span class="STYLE2">上海文广新闻传媒集团 版权所有</span></td>
  </tr>
</table>
<script language="javascript" src="/js/smg.js"></script>
	<script language="JavaScript" type="text/javascript" >
		var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);
</script>
<script language="JavaScript" type="text/javascript" src="http://172.27.203.80:8080/pphlogger.js"></script> 
<noscript><img alt="" src="http://172.27.203.80:8080/pphlogger/pphlogger.php?id=yang&st=img"></noscript>
</body>
</html>