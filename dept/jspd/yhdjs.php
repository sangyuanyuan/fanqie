<?php
	 require_once('../../frame.php');
?>
<html>
<head>
<title>传承文化 传播知识 传达真实的力量</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php use_jquery();?>
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
            <td valign="top" width="680" height="1062" align="left" valign="middle"><table width="695" height="1052" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">纪实频道首页</a> &gt; 有话大家说 </td>
              </tr>
              <tr>
                <td height="20" align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="20%" align="center"><a href="mailto:yingqiming@stv.sh.cn"><img src="images/ld-y.jpg" alt="给应启明写邮件" width="122" height="155" border="0"></a></td>
                    <td width="20%" align="center"><a href="mailto:xueyafei@stv.sh.cn"><img src="images/ld-x.jpg" alt="给薛亚非写邮件" width="122" height="155" border="0"></a></td>
                    <td width="20%" align="center"><a href="mailto:chenqi@stv.sh.cn"><img src="images/ld-c.jpg" alt="给陈琪写邮件" width="122" height="155" border="0"></a></td>
                    <td width="20%" align="center"><a href="mailto:wqs1121@sina.com.cn"><img src="images/ld-w.jpg" alt="给汪求实写邮件" width="122" height="155" border="0"></a></td>
                    <td width="20%" align="center"><a href="mailto:whyfriday@yahoo.com.cn"><img src="images/ld-g.jpg" alt="给干超写邮件" width="122" height="155" border="0"></a></td>
                  </tr>
                  <tr>
                    <td height="40" align="center" class="grr"><input name="radiobutton" type="radio" onclick="sayto('应启明')" value="radiobutton" >
                      纪实频道 总监 <br>
                      应启明</td>
                    <td align="center"><span class="grr">
                      <input type="radio" name="radiobutton" onclick="sayto('薛亚非')" value="radiobutton">
                      纪实频道
                      总支书记<br>
                    	薛亚非</span></td>
                    <td align="center"><span class="grr">
                      <input type="radio" name="radiobutton" onclick="sayto('陈琪')" value="radiobutton">
                      纪实频道 副总监 <br>
											陈琪 </span></td>
                    <td align="center"><span class="grr">
                      <input type="radio" name="radiobutton" onclick="sayto('汪求实')" value="radiobutton">
                      纪实频道 副总监 <br> 
                      汪求实</span>
                    	</td>
                    <td align="center"><span class="grr">
                      <input type="radio" name="radiobutton" onclick="sayto('干超')" value="radiobutton">
                      纪实频道 副总监 <br>
											干超</span></td>
                  </tr>
                	<tr>
                		<td height="40" align="center" class="grr"><input name="radiobutton" type="radio" onclick="sayto('所有人')" value="radiobutton" >
                			所有人
                	</tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="680" align="center" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="53%" height="38" background="images/tt-bg.jpg"><span class="btt"><strong class="btt">&nbsp;☆</strong>给领导留言</span></td>
                    <td width="47%" rowspan="4" valign="top">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="38" background="images/tt-bg.jpg" class="wz"><strong>最近留言：</strong></td>
                     <?php
					    $comment = new table_class('smg_comment');
	                  	$records = $comment->paginate('all',array('conditions' => 'resource_type="yhdjs"','order' => 'created_at desc'),10);
						$count = count($records);
						for($i=0;$i<$count;$i++){
					  ?>
                      <tr>
                        <td class="grr"><span style="color:blue;"><? echo $records[$i]->title;?></span><br><? echo $records[$i]->nick_name; echo $records[$i]->comment;?></td>
                      </tr>
                      <tr><td height="10"></td></tr>
                      <? }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td>
                    <form method="post" action="/pub/pub.post.php">
                      <DIV class="wz">昵称：
                          <INPUT  id="commenter" name="post[nick_name]">
                      </DIV>
                      <DIV class="wz">标题：
                          <INPUT id="title" name="post[title]">
                      </DIV>
                      <DIV id="content2">
                        <DIV class="wz" id="left">内容：</DIV>
                        <span class="wz">
                        <TEXTAREA id="commentcontent" name="post[comment]" cols="40" rows="6" id="lettercontent"></TEXTAREA>
                        </span></DIV>
                      <DIV>
                        <span class="wz">
						<input type="hidden" name="post[resource_type]" value="yhdjs">
						<input type="hidden" name="type" value="comment">
                        <BUTTON type="submit">提交</BUTTON>
                        </span></DIV>
					  </form>
					  </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td width="680" height="63" align="center">&nbsp;</td>
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
<script>
function sayto(leader)
{
	$("#commentcontent").attr('value','对'+leader+'说:');
}
</script>