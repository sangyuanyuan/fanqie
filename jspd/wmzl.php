<html>
<head>
<title>�����Ļ� ����֪ʶ ������ʵ������</title>
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
<body leftmargin="0" marginwidth="0">
<!-- ImageReady Slices (����-ge.psd) -->
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
	font-family: "����";
	font-size: 12px;
	line-height: 15px;
	color: #FFFFFF;
	text-decoration: none;
}
.link1 {
	font-family: "����";
	font-size: 12px;
	line-height: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
<? 
require_once('../inc/department.inc.php');
include('inc/topbar.inc.php');

?>

<!-- #EndLibraryItem --><table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="261" height="1064">
          <? include("inc/leftbar.inc.php");?>
          </td>
            </tr>
            <tr>
              <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
              </tr>
            </table></td>
            <td valign="top" width="680" height="1062" align="left" valign="middle"><table width="692" height="1054" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
                <td height="25">&nbsp;&nbsp;<a href="/jspd" class="wz">��ʵƵ����ҳ</a> &gt; �����ɷ�</td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top">
                <table width="95%" border="0" cellpadding="0" cellspacing="0" class="wz">
                  <? 
               		  $newslist=load_module('pos_wmzl_center1',6); 
              	 ?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg"><span style="color:red; font-size:14px; font-weight:bold;">��<? echo $newslist->categoryname;?></span></td>
                    <td align="center" background="images/tt-bg.jpg">�����</td>
                    <td align="center" background="images/tt-bg.jpg">����ʱ��</td>
                  </tr>
                  <? for($i=0;$i<$newslist->itemcount;$i++)
                  {?>
                  <tr> 
                    <td align="left"><a href="news.php?id=<? echo $newslist->items[$i]->id;?>"><? echo $newslist->items[$i]->title;?></a></td>
                    <td align="center"><? echo $newslist->items[$i]->clickcount;?></td>
                    <td align="center"><? echo $newslist->items[$i]->pubdate;?></td>
                  </tr>              
                  <tr>
                    <td height="22">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <? }?>
                   <tr>
                    <td height="30">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="center"><a href="<? echo $newslist->getmorelink("newslist.php");?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                  </tr>
                  <tr>
                  	<td height="30">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <!--�������ʿ�ʼ-->
                  <? 
                 $newslist=load_module('pos_wmzl_center2',6); 
                 ?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg"><span style="color:red; font-size:14px; font-weight:bold;">��<? echo $newslist->categoryname;?></span></td>
                    <td align="center" background="images/tt-bg.jpg">�����</td>
                    <td align="center" background="images/tt-bg.jpg">����ʱ��</td>
                  </tr>
                  <? for($i=0;$i<$newslist->itemcount;$i++)
                  {?>
                  <tr>
                  
                    <td align="left"><a href="news.php?id=<? echo $newslist->items[$i]->id;?>"><? echo $newslist->items[$i]->shorttitle;?></a></td>
                    <td align="center"><? echo $newslist->items[$i]->clickcount;?></td>
                    <td align="center"><? echo $newslist->items[$i]->pubdate;?></td>
                  </tr>  
                  <tr>
                    <td height="22">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>            
                  <? }?>
                   <tr>
                    <td height="30">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><a href="<? echo $newslist->getmorelink("newslist.php");?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                  </tr>
                  <tr>
                  	<td height="30">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
               <!-- ־Ը�����ж���ʼ -->
              <? 
                 $newslist=load_module('pos_wmzl_center3',6); 
                 ?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg"><span style="color:red; font-size:14px; font-weight:bold;">��<? echo $newslist->categoryname;?></span></td>
                    <td align="center" background="images/tt-bg.jpg">�����</td>
                    <td align="center" background="images/tt-bg.jpg">����ʱ��</td>
                  </tr>
                  <? for($i=0;$i<$newslist->itemcount;$i++)
                  {?>
                  <tr>
                  
                    <td align="left"><a href="news.php?id=<? echo $newslist->items[$i]->id;?>"><? echo $newslist->items[$i]->title;?></a></td>
                    <td align="center"><? echo $newslist->items[$i]->clickcount;?></td>
                    <td align="center"><? echo $newslist->items[$i]->pubdate;?></td>
                  </tr>
                  <tr>
                    <td height="22">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>           
                  <? }?>
                   <tr>
                    <td height="30">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><a href="<? echo $newslist->getmorelink("newslist.php");?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                  </tr>
            </table></td>
        </tr>
        <tr>
          <td height="101" colspan="2" align="center" valign="middle" background="images/di.jpg" class="nr-d">|<A href="https://172.27.203.81:8080" target="_blank" class="whi" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://172.27.203.81:8080');return(false);"> ��Ϊ��ҳ</A>|<A href="mailto:dc@smg.cn" class="whi"> ��ϵ����</A> |<br>
            �Ϻ��Ĺ����Ŵ�ý����  ��ʵƵ�� ��Ȩ���� <br>
            Copyright 2009 SMG DOCUMENTARY CHANNEL All Rights Reserved<br>
            ���� 1024X768 ���Ч�����</td>
        </tr>
    </table></td></tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>