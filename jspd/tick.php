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
	include("inc/topbar.inc.php");
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
            <td valign="top" width="680" height="1062" align="left" valign="middle"><table width="692" height="1049" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr valign="top">
              	<? 
                	$votelist=load_module('pos_indexleft3',4);            
                ?>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">��ʵƵ����ҳ</a> &gt; <? echo $votelist->categoryname;?> </td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="wz">
                  <tr>
                    <td width="52%" height="38" background="images/tt-bg.jpg" class="wz"><strong class="btt"> &nbsp;�����ͶƱ</strong></td>
                    <td width="48%" align="center" background="images/tt-bg.jpg" class="wz">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><table width="225" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                      	<? $vote=getvote($votelist->items[0]->id);?>
                        <td class="gry"><strong><? echo  $vote->vote->title;?></strong>
                            <?                  	
                            	$vote->display(false);
                            ?>                           
                        </td>
                      </tr>
                    </table></td>
                    <td align="center"><table width="225" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                      	<? $vote=getvote($votelist->items[1]->id);?>
                        <td class="gry"><strong><? echo  $vote->vote->title;?></strong>
                            <?                  	
                            	$vote->display(false);
                            ?>
                         </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="30">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><table width="225" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <? $vote=getvote($votelist->items[2]->id);?>
                        <td class="gry"><strong><? echo  $vote->vote->title;?></strong>
                            <?                  	
                            	$vote->display(false);
                            ?>
                         </td>
                      </tr>
                    </table></td>
                    <td align="center"><table width="225" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <? $vote=getvote($votelist->items[3]->id);?>
                        <td class="gry"><strong><? echo  $vote->vote->title;?></strong>
                            <?                  	
                            	$vote->display(false);
                            ?>
                         </td>
                      </tr>
                    </table></td>
                  </tr>         
                </table></td>
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