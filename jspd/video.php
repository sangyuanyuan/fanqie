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
require_once("../inc/department.inc.php");
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
            <td width="695" height="1062" align="left" valign="top"><table width="692" height="1062" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
              <? 
              	$videoid=$_REQUEST['id'];
              	$videolist=load_module('pos_index_right1',5); 
              	$video=getvideo($videoid);
              ?>
                <td height="25">&nbsp;<a href="index.php" class="wz">��ʵƵ����ҳ</a> &gt; <? echo $videolist->categoryname;?></td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top"><table width="670" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="391" height="39" background="images/tt-bg.jpg" class="btt">&nbsp;<strong>��</strong>������Ƶ</td>
                    <td width="279" rowspan="9" align="center" valign="top" class="btt">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="btt"><strong>��</strong>������Ƶ</td>
                        <td height="39" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="wz">&nbsp;</td>
                      </tr>
                      <? 
                      
                      for($i=0;$i<$videolist->itemcount;$i++)
                      {
                      ?>
                      <tr>
                        <td width="38%" align="center"><img src="<? echo $videolist->items[$i]->photourl;?>" width="80" height="80"></td>
                        <td width="62%" class="wz"><a href="video.php?id=<? echo $videolist->items[$i]->id;?>"><? echo $videolist->items[$i]->title;?></a></td>
                      </tr>
                      <? }?>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right"><a href="<? echo $videolist->getmorelink('videolist.php');?>"><img border="0" src="images/more.jpg" width="86" height="33"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                      <table width="90%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <? $newslist=load_module('pos_indexsftj',4);?>
                          <td align="center" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="btt"><strong>��</strong><? echo $newslist->categoryname;?></td>
                          <td height="39" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="wz"></td>
                        </tr>
                         <? for($i=0;$i<$newslist->itemcount;$i++){?>
                        <tr>
                          <td width="38%" align="center"><img src="<? echo $newslist->items[$i]->photourl;?>" width="80" height="80"></td>
                          <td width="62%" class="wz"><a href="news.php?id=<? echo $newslist->items[$i]->id;?>"><span class="m-m"><? echo $newslist->items[$i]->title;?></span></a><br>
                            <span style="height:40px; overflow:hidden;"><? echo $newslist->items[$i]->description;?></span></td>
                           
                        </tr>
                         <? }?>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right"><a href="<? echo $newslist->getmorelink();?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td valign="top">
                    	<? 
                    		ShowMediaPlay(387,260,$video->photourl,$video->videourl);
                    	?>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"><DIV id="upload"><span class="btt">��Ƶ����</span><br>
                        <span class="wz">�ϴ��� <? echo $video->createtime;?></span></DIV>
                      <DIV class="wz" id="channel"><? echo  $video->title;?></DIV>
                      <DIV class="wz" id="comment"><? echo $video->description;?> </DIV>
                      <DIV class="wz">��ǩ��<? echo $video->keywords;?></DIV>
                      <DIV class="wz">���ţ�<? echo $video->clickcount;?></DIV>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td height="36" background="images/tt-bg.jpg" class="btt">&nbsp;<strong>��</strong>�������</td>
                    </tr>
                  <tr>
                  <? 
                  	$comments=getcomments('',5);
                  ?>
                    <td class="wz"><? for($i=0;$i<$comments->itemcount;$i++)
                    {?>
                    ��<? 
                    echo  $comments->items[$i]->content .'(������:'. $comments->items[$i]->commenter .' '. $comments->items[$i]->createtime .')<br>';
                    }
                    $comments->showpages();
                    ?>
                    </td>
                    </tr>
                  <tr>
                    <td class="wz">&nbsp;</td>
                    </tr>
                  <tr>
                    <td height="36" background="images/tt-bg.jpg" class="wz"><span class="btt">&nbsp;<strong>��</strong>��������</span></td>
                    </tr>
                  <tr>
                    <td height="46" class="wz">�û���
                      <INPUT id="commenter" name="commenter">
                      <TEXTAREA name="comment" cols="50" rows="5" id="commentcontent"></TEXTAREA>
                      <br>
                      <BUTTON id="btn" onClick="return PostComment('video','commenter','commentcontent',<? echo $video->id;?>);">�ύ</BUTTON>
                      <INPUT type="hidden" value="329" name="videoid"></td>
                    </tr>
                </table>
                <br></td>
              </tr>
              <tr>
                <td width="680" height="78" align="center">&nbsp;</td>
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