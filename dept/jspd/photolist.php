<?php
require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	js_include_once_tag('total');
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>传承文化 传播知识 传达真实的力量</title>
<style type="text/css">
<!--
@import url("nw.css");
body {
	background-color: #014380;
	margin-top: 0px;
}
.addr {	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
</head>
<script>
	total("纪实频道图票列表","news");	
</script>
<body leftmargin="0" marginwidth="0">
<!-- ImageReady Slices (内网-ge.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="204" align="center"><!-- #BeginLibraryItem "/Library/top.lbi" -->
<style type="text/css">
<!--
@import url("../top.css");
.add {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
}
.ss {
	font-family: "宋体";
	font-size: 12px;
	line-height: 15px;
	color: #FFFFFF;
	text-decoration: none;
}
.link1 {
	font-family: "宋体";
	font-size: 12px;
	line-height: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
<?php
include('inc/topbar.inc.php');
?>

<!-- #EndLibraryItem --><table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" width="261" height="1064">
          <? include("inc/leftbar.inc.php");?>
          </td>
            </tr>
            <tr>
              <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
              </tr>
            </table></td>
            <td width="680" height="1062" align="left" valign="top"><table width="692" height="1054" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">纪实频道首页</a> &gt; 纪实达人</td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top">
                <table width="95%" border="0" cellpadding="0" cellspacing="0" class="wz">
                  <?php
               		  $records = show_content('smg_news','news','纪实频道','圈内资深','3');
					  $count = count($records);
              	  ?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg"><span style="color:red; font-size:14px; font-weight:bold;">☆圈内资深</span></td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                    <td align="center" background="images/tt-bg.jpg">&nbsp;</td>
                    <td align="center" background="images/tt-bg.jpg">&nbsp;</td>
                  </tr>
                  <? for($i=0;$i<$count;$i++)
                  {?>
                  <tr valign="middle"> 
                    <td height="30"><img src="<? echo $records[$i]->photo_src;?>" width="80" height="80"></td>
                    <td align="left"><div style="width:390px; height:85px; font-weight:12px; overflow:hidden;"><a target="blank" href="news.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title; echo $records[$i]->description;?></a></div></td>
                    <td align="left"><? echo $records[$i]->click_count;?></td>
                    <td align="left"><? echo $records[$i]->created_at;?></td>
                  </tr>              
                  <tr>
                    <td height="22">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <? }?>
                   <tr>
                    <td height="30">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left"><a href="newslist.php?id=<?php echo dept_category_id_by_name('圈内资深','纪实频道','news');?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                  </tr>
                  <tr>
                  	<td height="30">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <!--小编手记开始-->
                   <?php
               		  $records = show_content('smg_news','news','纪实频道','小编手记','3');
					  $count = count($records);
              	  ?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg"><span style="color:red; font-size:14px; font-weight:bold;">☆小编手记</span></td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                  </tr>
                  <? for($i=0;$i<$count;$i++)
                  {?>
                  <tr valign="middle"> 
                    <td height="30"><img src="<? echo $records[$i]->photo_src;?>" width="80" height="80"></td>
                    <td align="left"><div style="width:390px; height:85px; font-weight:12px; overflow:hidden;"><a target="blank" href="news.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title; echo $records[$i]->description;?></a></div></td>
                    <td align="left"><? echo $records[$i]->click_count;?></td>
                    <td align="left"><? echo $records[$i]->created_at;?></td>
                  </tr>                
                  <? }?>
                   <tr>
                    <td height="30">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left"><a href="newslist.php?id=<?php echo dept_category_id_by_name('小编手记','纪实频道','news');?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                  </tr>
                  <tr>
                  	<td height="30">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr>
               <!-- MY SHOW开始 -->
             	  <?php
               		  $records = show_content('smg_news','news','纪实频道','My Show','3');
					  $count = count($records);
              	  ?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg"><span style="color:red; font-size:14px; font-weight:bold;">☆My Show</span></td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                    <td align="left" background="images/tt-bg.jpg">&nbsp;</td>
                  </tr>
                  <? for($i=0;$i<$count;$i++)
                  {?>
                  <tr valign="middle"> 
                    <td height="30"><img src="<? echo $records[$i]->photo_src;?>" width="80" height="80"></td>
                    <td align="left"><div style="width:390px; height:85px; font-weight:12px; overflow:hidden;"><a target="blank" href="news.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title; echo $records[$i]->description;?></a></div></td>
                    <td align="left"><? echo $records[$i]->click_count;?></td>
                    <td align="left"><? echo $records[$i]->created_at;?></td>
                  </tr>              
                  <? }?>
                   <tr>
                    <td height="30">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left"><a href="newslist.php?id=<?php echo dept_category_id_by_name('My Show','纪实频道','news');?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                  </tr>
            </table></td>
        </tr>
        <tr>
          <td height="101" colspan="2" align="center" valign="middle" background="images/di.jpg" class="nr-d">|<A href="https://172.27.203.81:8080" target="_blank" class="whi" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://172.27.203.81:8080');return(false);"> 设为主页</A>|<A href="mailto:dc@smg.cn" class="whi"> 联系我们</A> |<br>
            上海文广新闻传媒集团  纪实频道 版权所有 <br>
            Copyright 2009 SMG DOCUMENTARY CHANNEL All Rights Reserved<br>
            建议 1024X768 浏览效果最佳</td>
        </tr>
    </table></td></tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>