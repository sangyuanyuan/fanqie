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
	font-size:12px;
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
include('../inc/db.inc.php');	
$newsid = $_REQUEST['id'];
ConnectDB();
$strsql='update smg_news set clickcount=clickcount+1 where id='.$newsid;
$Record = mysql_query($strsql) or die ("update error");
CloseDB();
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
            <td width="680" height="1062" align="left" valign="top"><table width="695" height="965" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
              	<? 
              		$news=getnews();
              		if($news->newstype==3)//url����������
								  {
								  	redirecturl($news->linkurl);
								  	CloseDB();
								  	exit;
								  }
								  //�ļ�����
								  if($news->newstype==2)
								  {
								   	redirecturl($news->filepath ."/" .$news->filename);
								  	CloseDB();
								  	exit; 	
								  }
								  
              	?>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">��ʵƵ����ҳ</a> &gt; <? echo $news->categoryname;?> </td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              
              <tr>
                <td width="695" height="792" align="center" valign="top"><DIV class="btd" id="content2">
                  <table width="650" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" class="btd"><? echo $news->title;?></td>
                    </tr>
                    <tr>
                      <td><DIV style="text-align:center;" class="wz" id="div2"> ���������<? echo $news->clickcount;?> ʱ�䣺 <? echo $news->pubdate;?></DIV>
                        <DIV id="div3">
                         <? echo getfckcontent($news->content);
                         		
                         ?>
                        </DIV><div style="text-align:center;"><? print_fck_pages($news->content);?></div></td>
                    </tr>
                  </table>
                </DIV>
                  <DIV id="content3"></DIV>
                  <DIV id="content4"></DIV></td>
              </tr>
              <tr>
                <td width="695" height="63" align="center"><table width="650" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="right" class="wz"><a href="/news/newslist.php?id=66"> ��������</a></td>
                  </tr>
                 
                  <? 
                  	$comments=getcomments('','news',5);
										for($i=0;$i<$comments->itemcount;$i++){?>
											 <tr>
                    <td style="border:1px solid #666666;" class="wz">
                    
                    <? echo  '<div style="margin-left:10px; color:blue; float:left; display:inline;">'.$comments->items[$i]->commenter .'</div><div style="margin-right:10px; float:right; display:inline">'.$comments->items[$i]->createtime .'</div><br>';
                    echo  '<span style="margin-left:10px; color:#000000;">'.$comments->items[$i]->content.'</span>';?>
                  </td></tr><tr><td height=5 ></td></tr><? }?>
                    <? $comments->showpages();?>
                   
                   
                  <tr>
                    <td height="38" background="images/tt-bg.jpg" class="btt"><strong>��</strong>��������</td>
                  </tr>
                  <tr>
                    <td><form name="commentform" method="post" action="">
                    	�û���<input type="text" value="" id="commenter" name="commenter"><br>
                      ���ۣ�<textarea id="commentcontent" name="comment" cols="60" rows="5"></textarea>
                    </form>                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="submit" name="Submit" onclick="return PostComment('news','commenter','commentcontent',<? echo $news->id;?>);" value="����">
                      <input type="submit" name="Submit2" value="ȡ��">
                    </form>                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg" class="btt"><strong>��</strong>������ڼ�ʵƵ������</td>
                  </tr>
                  <tr>
                    <td>
                    	<? 
                    		$more=getrelatednews();
                    		for($i=0;$i<5;$i++)
                    		{
                    	?>
                    	<div class="wz">��<a href="/news/news.php?id=<? echo $more[$i]->id;?>" target="_blank"><? echo $more[$i]->title;?></a> <? echo $more[$i]->pubdate;?> </div>
                    	<? }?>
                      </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="30" align="left">&nbsp;</td>
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