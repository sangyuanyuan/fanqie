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
<? require_once('../inc/department.inc.php');?>
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
          	<? $newslist = load_module('pos_kxfzqy',1);?>
            <td width="256" rowspan="2" align="center"><img src="images/kf-p2.jpg" width="200" height="150" /></td>
            <td width="21" rowspan="2">&nbsp;</td>
            <td width="482" height="35" class="ttt"><? echo $newslist->categoryname;?>　　　　　　　　<a style="font-size:12px; color:#f45d14;" href="/jspd/">返回频道首页</a></td>
          </tr>
          <tr>
            <td height="35" align="left" valign="top"><span class="ttt"><? echo $newslist->items[0]->content;?></span></td>
          </tr>
        </table></td>
      </tr>
       <tr>
        <td height="190" align="left" bgcolor="#FFDC93" class="nr">
        <ol>
		     	<li>您认为，目前制约纪实频道发展的主要问题有哪些？</li> 
					<li>在“推进传媒创新”方面，您有什么好的建议？ </li>
					<li>近几年，集团相继推出的人力资源管理综合改革，如“双通道”、绩效考核、培训等方面，</li>
					<li>您认为频道在执行中还有哪些方面需要完善？</li> 
					<li>您希望频道在员工个人发展方面提供哪些条件与平台？ </li>
					<li>您还有什么具体困难希望频道予以解决？</li><br>
      			您还有什么意见与建议？
      	</ol>
      <? $newslist = load_module('pos_kxfzg',6);?>
      <tr>
        <td align="left" bgcolor="#FFDC93" class="nr"><ol>
        	<? for($i=0;$i< $newslist->itemcount;$i++){?>
          <li style="color:#0000ff;"><a target="_blank" href="kxfzg.php?id=<? echo $newslist->items[$i]->id;?>"><? echo $newslist->items[$i]->title;?></a></li>
          <? }?>
        </ol></td>
      </tr>
      <? 
      	$deptcomment=getdeptcomments("0");
      	for($i=0;$i<count($deptcomment)&&$i< 5;$i++)
      	{
      ?>
      <tr bgcolor="#FFDC93">
        <td  class="grr"><span  style="color:blue;"><? echo $deptcomment[$i]->title;?></span><br><? echo $deptcomment[$i]->commenter; echo $deptcomment[$i]->content;?></td>
      </tr>
      <tr><td height="10"></td></tr>
      <? }?>
                   
                   
                  <tr>
                    <td align="left" bgcolor="#FFDC93" height="38" class="btt">&nbsp;发表建议</td>
                  </tr>
                  <tr align="left">
                    <td bgcolor="#FFDC93"><form name="commentform" method="post" action="">
                    	&nbsp;&nbsp;标题：<input type="text" value="" id="lettertitle" name="title"><br>
                    	&nbsp;&nbsp;用户：<input type="text" value="" id="commenter" name="commenter"><br>
                      &nbsp;&nbsp;建议：<textarea id="commentcontent" name="comment" cols="60" rows="5"></textarea>
                    </form>                    </td>
                  </tr>
                  <tr align="left">
                    <td bgcolor="#FFDC93">
                      　　　　　<input type="submit" name="Submit" onclick="return PostComment(PostDeptComment('lettertitle','writer','lettercontent','0','',''));" value="建议">
                      <input type="submit" name="Submit2" value="取消">
                    </form>                    </td>
                  </tr>
      <tr>
        <td align="center" bgcolor="#FFE6B0"><table width="95%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="55" align="center" bgcolor="#F35913"><span class="ntt">上海文广新闻传媒集团  纪实频道 版权所有<br />
建议 1024X768 浏览效果最佳</span>　编辑信箱:dc@smg.sh.cn</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
