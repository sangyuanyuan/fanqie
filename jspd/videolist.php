<html>
<head>
<title>传承文化 传播知识 传达真实的力量</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script language="javascript" src="/js/smg.js"></script>
<script>
var dept_id = RequestCookies("smg_dept","");
AddSiteClickcount(dept_id);	
</script>
<style type="text/css">
<!--
@import url("nw.css");
body {
	background-color: #014380;
}
.addr {	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
<? 
	include("inc/topbar.inc.php");
	require_once('../inc/department.inc.php');

?>

<!-- #EndLibraryItem -->
<table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="261" height="1064">
          <? include("inc/leftbar.inc.php");?>
          </td>
            </tr>
            <tr>
              <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
              </tr>
            </table></td>
            <td width="680" height="1062" align="left" valign="top"><table width="692" height="1049" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
              <? 
              	$videolist=load_module('pos_index_right1',5); 
              ?>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">纪实频道首页</a> &gt; <? echo $videolist->categoryname; ?></td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="wz">
                  <tr>
 					 <td width="51%" height="38" align="center" background="images/tt-bg.jpg" class="wz"><strong><? echo $videolist->categoryname;?></strong></td>
                    <td width="7%" align="center" background="images/tt-bg.jpg" class="wz"><strong>浏览量</strong></td>
                    <td width="17%" align="center" background="images/tt-bg.jpg" class="wz"><strong>发布时间</strong></td>
                  </tr>
                  <? 
                  for($i=0;$i<$videolist->itemcount;$i++){?>
                  <tr>
                    <td height="30"><a href="video.php?id=<? echo $videolist->items[$i]->id;?>" title="<? echo $videolist->items[$i]->title;?>">·<? echo $videolist->items[$i]->title;?></a></td>  
                    <td align="center"><? echo $videolist->items[$i]->clickcount;?></td>
                    <td align="center"><? echo $videolist->items[$i]->createtime;?></td>
                  </tr>
                  <? }?>
                  
                </table></td>
              </tr>
              <tr>
                <td width="680" height="63" align="center">
                <? 
                	$videolist->showpages();
                ?>
                </td>
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