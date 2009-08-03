<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>纪实频道科学发展观</title>
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
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
.ttt {	font-family: "宋体";
	font-size: 15px;
	line-height: 22px;
	font-weight: bold;
	color: #EC4717;
	text-decoration: none;
}
.nr {
	font-family: "宋体";
	font-size: 14px;
	line-height: 22px;
	font-weight: bold;
	color: #F45D14;
	text-decoration: none;
}
.ntt {
	font-family: "宋体";
	font-size: 13px;
	line-height: 20px;
	color: #333333;
	text-decoration: none;
}
-->
</style></head>
<? 
include('../inc/db.inc.php');	
$newsid = $_REQUEST['id'];
ConnectDB();
$strsql='update smg_news set clickcount=clickcount+1 where id='.$newsid;
$Record = mysql_query($strsql) or die ("update error");
CloseDB();
require_once('../inc/department.inc.php');?>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="146" align="center"><table width="777" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td><img src="images/fz-top.jpg" width="777" height="116" /></td>
      </tr>
      <tr>
        <td height="100" bgcolor="#FFE6B0"><table width="759" height="140" border="0" cellpadding="0" cellspacing="0">
         <tr>
         	<? $news=getnews();?>
                <td width="695" height="792" align="center" valign="top"><DIV class="btd" id="content2">
                  <table width="650" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" class="btd"><? echo $news->title;?></td>
                    </tr>
                    <tr>
                      <td><DIV style="text-align:center;" class="wz" id="div2"> 浏览次数：<? echo $news->clickcount;?> 时间： <? echo $news->pubdate;?></DIV>
                        <DIV id="div3" style="font-size:12px; text-align:left; float:left; display:inline;">
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
                    <td height="30" align="right" class="wz"><a href="/news/newslist.php?id=66"> 更多新闻</a></td>
                  </tr>
                 
                  <? 
                  	$comments=getcomments('','news',5);
										for($i=0;$i<$comments->itemcount;$i++){?>
											 <tr>
                    <td bgcolor="#FFDC93" style="border:1px solid #666666;" class="wz">
                    
                    <? echo  '<div style="margin-left:10px; color:blue; float:left; display:inline;">'.$comments->items[$i]->commenter .'</div><div style="margin-right:10px; float:right; display:inline">'.$comments->items[$i]->createtime .'</div><br>';
                    echo  '<span style="margin-left:10px; color:#000000;">'.$comments->items[$i]->content.'</span>';?>
                  </td></tr><tr><td height=5 ></td></tr><? }?>
                    <? $comments->showpages();?>
                   
                   
                  <tr>
                    <td bgcolor="#FFDC93" height="38" class="btt">发表评论</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFDC93"><form name="commentform" method="post" action="">
                    	用户：<input type="text" value="" id="commenter" name="commenter"><br>
                      评论：<textarea id="commentcontent" name="comment" cols="60" rows="5"></textarea>
                    </form>                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="submit" name="Submit" onclick="return PostComment('news','commenter','commentcontent',<? echo $news->id;?>);" value="发表">
                      <input type="submit" name="Submit2" value="取消">
                    </form>                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg" class="btt"><strong>☆</strong>更多关于纪实频道新闻</td>
                  </tr>
                  <tr>
                    <td>
                    	<? 
                    		$more=getrelatednews();
                    		for($i=0;$i<5;$i++)
                    		{
                    	?>
                    	<div class="wz">·<a href="/news/news.php?id=<? echo $more[$i]->id;?>" target="_blank"><? echo $more[$i]->title;?></a> <? echo $more[$i]->pubdate;?> </div>
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
          <td height="101" colspan="2" align="center" valign="middle" background="images/di.jpg" class="nr-d">|<A href="https://172.27.203.81:8080" target="_blank" class="whi" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://172.27.203.81:8080');return(false);"> 设为主页</A>|<A href="mailto:dc@smg.cn" class="whi"> 联系我们</A> |<br>
            上海文广新闻传媒集团  纪实频道 版权所有 <br>
            Copyright 2009 SMG DOCUMENTARY CHANNEL All Rights Reserved<br>
            建议 1024X768 浏览效果最佳</td>
        </tr>
    </table></td></tr>
</table>
</body>
</html>
