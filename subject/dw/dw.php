<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0053)http://bbs.ifeng.com/zhuanti/200905/duanwu/index.html -->
<HTML><HEAD><TITLE>端午节专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<META content=2009端午节 name=description 分享：粽香豆浓，端午情长>
<META content="" name=keywords>
<META http-equiv=refresh content=null>
<LINK href="dw2_files/2007sanmod.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.5730.13" name=GENERATOR>
<STYLE type=text/css>.STYLE3 {
	FONT-WEIGHT: bold; FONT-SIZE: 14px
}
.STYLE7 {
	COLOR: #336633
}
.STYLE10 {
	COLOR: #cc6666
}
.STYLE11 {
	COLOR: #0000ff
}
.STYLE12 {
	COLOR: #9900cc
}
.STYLE13 {
	COLOR: #ff0000
}
.STYLE14 {
	COLOR: #993333
}
</STYLE>
</HEAD>
<BODY >
<? 
		require_once('../libraries/sqlrecordsmanager.php');
		require_once('../inc/pubfun.inc.php');
		require_once('../modules/mod_vote/mod_class_define.php');
		$pageindex = isset($_REQUEST['pageindex']) ? $_REQUEST['pageindex'] : 1;
		$sqlmanager = new SqlRecordsManager();		
		$newslist = $sqlmanager->GetRecords('select * from smg_dw_comment order by createtime desc');	
?>
	
<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
  <TR>
    <TD width=630 height=1></TD></TR></TBODY></TABLE>

<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>
  <TBODY>
  <TR>
    <TD><IMG height=140
      src="dw2_files/dw2.jpg" width=770></TD>
    </TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <TBODY>
  <TR>
    <TD vAlign=top width=25% bgColor=#e9f2d9 s>
      <TABLE width="100%" border=0>
        <TBODY>
       
        <TR>
          <TD height=81>
            <TABLE width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>新闻列表</div></TD></TR>
                    <TR>
                      <TD>
                      <? $news=$sqlmanager->GetRecords('select * from smg_news where main_cate_id=96 and isadopt=1 order by pubdate desc',1,20);?>
											<div id=s_left>
											<? for($i=0; $i<count($news); $i++){?>
										<a target="_blank" href="/news/news-<? echo $news[$i]->main_cate_id;?>.php?id=<? echo $news[$i]->id?>"><? echo $news[$i]->shorttitle;?></a>
											<? }?>
											</div>	
                      </TD></TR></TBODY></TABLE></TD></TR>
             <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                     <TD><div class=title1>祝福</div></TD></TR>
                    <TR>
                      <TD height=146><marquee height="200" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
											<? for($i=0; $i<count($newslist); $i++){?>
											<div style="width:200px; margin-bottom:10px; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->commenter;?></span>说：<? echo $newslist[$i]->content;?></div>
											<? }?>
				</marquee></TD></TR></TBODY></TABLE></TD></TR> 
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>说说你的端午情缘</div></TD></TR>
                    <TR>
                      <TD>
                      	<div id=s_right>
													<div class="title">端午节祝福</div>
													<form name="commentform" method="post" action="/dw/createcomment.php">
													<div id=subject_comment>昵称：<input type="text" name="commenter" id="commenter"/><br /><div id=comment>内容：</div><textarea id="commentcontent" name="comment"></textarea></div>
													<button id=btn onclick="javascript:commentform.submit();">发　表</button>
													</form>
													</div>
                      	</TD></TR></TBODY></TABLE></TD></TR> 
            </TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    <TD vAlign=top align=middle width=75% bgColor=#ffffcc>
      <TABLE width="100%" border=0>
        <TBODY>
        <TR>
          <TD height=86>
            <TABLE height=210 width="100%" border=0>
              <TBODY>
              <TR>
                <TD colSpan=2 class=index_title>端午节传说</TD></TR>
              <TR>
                <TD width="20%" height=153>
                  <DIV align=left><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15356" 
                  target=_blank><IMG height=140 
                  src="dw2_files/duanwu1.jpg" 
                  width=150 border=1 style="margin-left:5px; "></A></DIV></TD>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR>
                      <TD width="50%">
                        <P class=STYLE3 align=center><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_blank>名称与来历</A></P></TD>
                      <TD class=STYLE3 width="50%">
                        <DIV align=center><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_blank>美丽的传说</A></DIV></TD></TR>
                    <TR>
                      <TD height=85>
                        <DIV align=left><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_blank>&nbsp;&nbsp;&nbsp;&nbsp;农历五月初五，是中国民间的传统节日——端午节，它是中华民族古老的传统节日之一。端午也称端五，端阳。此外，端午节还有许多别称，如：午日节、重五节，五月节、浴兰节、女儿节，天中节、地腊、诗人节、龙日等等</A>。</DIV></TD>
                      <TD>
                        <DIV align=left><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_parent>&nbsp;&nbsp;&nbsp;&nbsp;关于端午节的由来，说法甚多，端午节的别称之多，间接说明了端午节俗起源的歧出。诸如：纪念屈原说；纪念伍子胥说 
                        ；纪念曹娥说；起于三代夏至节说；恶月恶日驱避说，吴月民族图腾祭说等等。</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
     <TR>
          <TD>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>端午节的习俗</TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD colSpan=2 height=17>
                        <DIV 
                        align=left>&nbsp;&nbsp;&nbsp;&nbsp;端午节的习俗，不仅是吃粽子这么简单。我国各地，在端午节这一天都有着丰富多彩的节庆活动。不仅有飘香的粽叶，金色的龙舟，绿色的艾草，五彩的丝线，鲜艳的倒灾葫芦……纷繁的色彩描绘着同样的端午主题——健康，怀念，龙。</DIV></TD></TR>
                    <TR>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15363" 
                              target=_blank><IMG height=121 alt=赛龙舟 
                              src="dw2_files/sailongzhou.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15363" 
                              target=_blank>赛龙舟</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15363"
                              target=_blank>相传起源于古时楚国人因舍不得贤臣屈原投江死去，许多人划船追赶拯救。之后每年五月五日划龙舟以纪念之。借划龙舟驱散江中之鱼，以免鱼吃掉屈原身体。</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15368" 
                              target=_blank><IMG height=121 alt=吃粽子 
                              src="dw2_files/chizongzi.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15368" 
                              target=_blank>吃粽子</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15368" 
                              target=_blank>千百年来，每年五月初，家家都要浸糯米、洗粽叶、包粽子，其花色品种更为繁多。而且流传到朝鲜、日本及东南亚诸国。</A></DIV></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15373" 
                              target=_blank><IMG height=121 alt=悬艾叶菖蒲、钟馗像 
                              src="dw2_files/guaaiye.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15373" 
                              target=_blank>悬艾叶菖蒲、钟馗像</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15373" 
                              target=_blank>民谚说：“清明插柳，端午插艾”。在端午节，人们把插艾和菖蒲作为重要内容之一。家家都洒扫庭除，以菖蒲、艾条插于门眉，悬于堂中。</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15370"
                              target=_blank><IMG height=121 alt=佩香囊、挂荷包 
                              src="dw2_files/xiangnang.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15370" 
                              target=_blank>佩香囊、挂荷包</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15370" 
                              target=_blank>端午节小孩佩香囊，传说有避邪驱瘟之意，实际是用于襟头点缀装饰。香囊内有朱砂、雄黄、香药，外包以丝布，清香四溢...</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR> 
   		<!--<TR>
          <TD>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>网友话端午 
                  </TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3676998" 
                        target=_blank>香包情</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1822358" 
                        target=_blank>独享独行</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3679013" 
                        target=_blank>那飘香的粽子和五色线 </A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1888780" 
                        target=_blank>温泉山人</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3678814" 
                        target=_blank>叹屈子</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1839290" 
                        target=_blank>懿公</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3682400" 
                        target=_blank>端午过节，如何普天同庆</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1970178" 
                        target=_blank>公社小社员</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3682935" 
                        target=_blank>端午节感怀</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1342066" 
                        target=_blank>liujijing</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3681478" 
                        target=_blank>端午思</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1241558" 
                        target=_blank>艰苦环境的爱</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3664832" 
                        target=_blank>端午往事</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1957319" 
                        target=_blank>珍蜜</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3680492" 
                        target=_blank>端午节诗词选</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1822358" 
                        target=_blank>独享独行</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3589315" 
                        target=_blank>端午节的艾和菖蒲</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=254965" 
                        target=_blank>雨花石</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3498582" 
                        target=_blank>艾叶上的端午</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1759561" 
                        target=_blank>wxctw88</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3493470" 
                        target=_blank>今年的端午节</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1761330" 
                        target=_blank>ok大橡树</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>·<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3244769" 
                        target=_blank>七绝．亦书端午思楚</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>——<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1140930" 
                      target=_blank>岸柳晓风</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>   -->
     <TR>
          <TD height=226 class=index_title>粽香情浓</TD></TR>
            <TABLE height=257 width="100%" border=0>
              <TBODY>
              <TR>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15357" 
                  target=_blank><IMG height=200 alt=粽子的由来，你知道吗？ 
                  src="dw2_files/qingnong1.jpg" 
                  width=160 border=1></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15360" 
                  target=_blank><IMG height=200 alt="六种粽子的包法" 
                  src="dw2_files/qingnong2.jpg" 
                  width=160 border=1></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15375" 
                  target=_blank><IMG height=200 alt=端午节：世界各国的粽子习俗 
                  src="dw2_files/qingnong3.jpg" 
                  width=160 border=1></A></DIV></TD>
              <!--  <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://bbs.ifeng.com/viewthread.php?tid=3679836" 
                  target=_blank><IMG height=200 alt=庆阳香包有感 
                  src="dw2_files/qingnong4.jpg" 
                  width=160 border=1></A></DIV></TD>--></TR>
              <TR>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15357" 
                  target=_blank>粽子的由来，你知道吗？</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15360" 
                  target=_blank>六种粽子的包法</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15375" 
                  target=_blank>端午节：世界各国的粽子习俗</A></DIV></TD>
          <!--      <TD height=20>
                  <DIV align=center><A 
                  href="http://bbs.ifeng.com/viewthread.php?tid=3679836" 
                  target=_blank>庆阳香包有感</A></DIV></TD>--></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

      <TABLE cellSpacing=0 cellPadding=0 width=1000 align=center border=0>
        <TBODY>
        <TR></TR></TBODY>
      <TABLE width=1000 border=0>
        <TBODY>
        <TR></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>
        <TBODY>
        <TR>
          <TD><IMG height=129 
            src="dw2_files/foot_01.jpg" width=268 
            border=0></TD>
          <TD><IMG height=129 
            src="dw2_files/foot_02.jpg" 
width=266></TD>
          <TD><IMG height=129 
            src="dw2_files/foot_03.jpg" 
        width=236></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><!--mark (  enorth_down ) parse begin-->
<STYLE type=text/css>TD {
	FONT-SIZE: 12px
}
</STYLE>
</TABLE>

<SCRIPT language=javascript 
src="dw2_files/sta_collection.js"></SCRIPT>
</BODY></HTML>
