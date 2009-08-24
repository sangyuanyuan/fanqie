<?php
require_once('../../frame.php');
$dept_cate_id=$_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>传承文化 传播知识 传达真实的力量</title>
<?php 
	js_include_once_tag('total');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<script>
	total("纪实频道新闻列表","news");	
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (内网-ge.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
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
	include("inc/topbar.inc.php");
?>

<!-- #EndLibraryItem -->
<table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="261" height="1064" valign="top">
          <? include("inc/leftbar.inc.php");?>
          </td>
            </tr>
            <tr>
              <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
              </tr>
            </table></td>
            <td valign="top" width="680" height="1062" align="left" valign="top"><table width="692" height="1049" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">纪实频道首页</a> &gt; <?php echo dept_category_name_by_id($dept_cate_id);?></td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="wz">
                  <tr>
 					 <td width="51%" height="38" align="center" background="images/tt-bg.jpg" class="wz"><strong><? echo dept_category_name_by_id($dept_cate_id);?></strong></td>
                    <td width="7%" align="center" background="images/tt-bg.jpg" class="wz"><strong>浏览量</strong></td>
                    <td width="17%" align="center" background="images/tt-bg.jpg" class="wz"><strong>发布时间</strong></td>
                  </tr>
                  <?php
				  	$db = get_db();
					$strsql='SELECT * FROM smg_news s where is_dept_adopt=1 and dept_category_id='.$dept_cate_id;
					$record=$db->paginate($strsql,30);
					$count  = count($record);
				  	for($i=0;$i<$count;$i++){
				  ?>
                  <tr>
                    <td height="30"><a href="news.php?id=<?php echo $record[$i]->id;?>" title="<?php echo $record[$i]->title;?>">・<?php echo $record[$i]->short_title;?></a></td>  
                    <td align="center"><? echo $record[$i]->click_count;?></td>
                    <td align="center"><? echo $record[$i]->last_edited_at;?></td>
                  </tr>
                  <? }?>
                </table></td>
              </tr>
              <tr>
                <td width="680" height="63" align="center">
                	<?php paginate();?>
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