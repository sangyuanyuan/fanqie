<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0053)http://bbs.ifeng.com/zhuanti/200905/duanwu/index.html -->
<HTML><HEAD><TITLE>�����ר��</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<META content=2009����� name=description �������㶹Ũ�������鳤>
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
                      <TD><div class=title1>�����б�</div></TD></TR>
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
                     <TD><div class=title1>ף��</div></TD></TR>
                    <TR>
                      <TD height=146><marquee height="200" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
											<? for($i=0; $i<count($newslist); $i++){?>
											<div style="width:200px; margin-bottom:10px; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->commenter;?></span>˵��<? echo $newslist[$i]->content;?></div>
											<? }?>
				</marquee></TD></TR></TBODY></TABLE></TD></TR> 
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>˵˵��Ķ�����Ե</div></TD></TR>
                    <TR>
                      <TD>
                      	<div id=s_right>
													<div class="title">�����ף��</div>
													<form name="commentform" method="post" action="/dw/createcomment.php">
													<div id=subject_comment>�ǳƣ�<input type="text" name="commenter" id="commenter"/><br /><div id=comment>���ݣ�</div><textarea id="commentcontent" name="comment"></textarea></div>
													<button id=btn onclick="javascript:commentform.submit();">������</button>
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
                <TD colSpan=2 class=index_title>����ڴ�˵</TD></TR>
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
                        target=_blank>����������</A></P></TD>
                      <TD class=STYLE3 width="50%">
                        <DIV align=center><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_blank>�����Ĵ�˵</A></DIV></TD></TR>
                    <TR>
                      <TD height=85>
                        <DIV align=left><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_blank>&nbsp;&nbsp;&nbsp;&nbsp;ũ�����³��壬���й����Ĵ�ͳ���ա�������ڣ������л�������ϵĴ�ͳ����֮һ������Ҳ�ƶ��壬���������⣬����ڻ�������ƣ��磺���սڡ�����ڣ����½ڡ�ԡ���ڡ�Ů���ڣ����нڡ�������ʫ�˽ڡ����յȵ�</A>��</DIV></TD>
                      <TD>
                        <DIV align=left><A 
                        href="http://172.27.203.81:8080/news/news.php?id=15356" 
                        target=_parent>&nbsp;&nbsp;&nbsp;&nbsp;���ڶ���ڵ�������˵�����࣬����ڵı��֮�࣬���˵���˶��������Դ����������磺������ԭ˵������������˵ 
                        ������ܶ�˵����������������˵�����¶�������˵����������ͼ�ڼ�˵�ȵȡ�</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
     <TR>
          <TD>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>����ڵ�ϰ��</TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD colSpan=2 height=17>
                        <DIV 
                        align=left>&nbsp;&nbsp;&nbsp;&nbsp;����ڵ�ϰ�ף������ǳ�������ô�򵥡��ҹ����أ��ڶ������һ�춼���ŷḻ��ʵĽ�����������Ʈ�����Ҷ����ɫ�����ۣ���ɫ�İ��ݣ���ʵ�˿�ߣ����޵ĵ��ֺ�«�����׷���ɫ�������ͬ���Ķ������⡪���������������</DIV></TD></TR>
                    <TR>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15363" 
                              target=_blank><IMG height=121 alt=������ 
                              src="dw2_files/sailongzhou.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15363" 
                              target=_blank>������</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15363"
                              target=_blank>�ഫ��Դ�ڹ�ʱ���������᲻���ͳ���ԭͶ����ȥ������˻���׷�����ȡ�֮��ÿ���������ջ������Լ���֮���軮������ɢ����֮�㣬������Ե���ԭ���塣</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15368" 
                              target=_blank><IMG height=121 alt=������ 
                              src="dw2_files/chizongzi.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15368" 
                              target=_blank>������</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15368" 
                              target=_blank>ǧ��������ÿ�����³����ҼҶ�Ҫ��Ŵ�ס�ϴ��Ҷ�������ӣ��仨ɫƷ�ָ�Ϊ���ࡣ�������������ʡ��ձ��������������</A></DIV></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15373" 
                              target=_blank><IMG height=121 alt=����Ҷ���ѡ���ظ�� 
                              src="dw2_files/guaaiye.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15373" 
                              target=_blank>����Ҷ���ѡ���ظ��</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15373" 
                              target=_blank>����˵������������������尬�����ڶ���ڣ����ǰѲ尬��������Ϊ��Ҫ����֮һ���ҼҶ���ɨͥ���������ѡ�����������ü���������С�</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15370"
                              target=_blank><IMG height=121 alt=�����ҡ��Һɰ� 
                              src="dw2_files/xiangnang.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15370" 
                              target=_blank>�����ҡ��Һɰ�</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="http://172.27.203.81:8080/news/news.php?id=15370" 
                              target=_blank>�����С�������ң���˵�б�а����֮�⣬ʵ�������ڽ�ͷ��׺װ�Ρ�����������ɰ���ۻơ���ҩ�������˿������������...</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR> 
   		<!--<TR>
          <TD>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>���ѻ����� 
                  </TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3676998" 
                        target=_blank>�����</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1822358" 
                        target=_blank>�������</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3679013" 
                        target=_blank>��Ʈ������Ӻ���ɫ�� </A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1888780" 
                        target=_blank>��Ȫɽ��</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3678814" 
                        target=_blank>̾����</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1839290" 
                        target=_blank>ܲ��</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3682400" 
                        target=_blank>������ڣ��������ͬ��</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1970178" 
                        target=_blank>����С��Ա</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3682935" 
                        target=_blank>����ڸл�</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1342066" 
                        target=_blank>liujijing</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3681478" 
                        target=_blank>����˼</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1241558" 
                        target=_blank>��໷���İ�</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3664832" 
                        target=_blank>��������</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1957319" 
                        target=_blank>����</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3680492" 
                        target=_blank>�����ʫ��ѡ</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1822358" 
                        target=_blank>�������</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3589315" 
                        target=_blank>����ڵİ�������</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=254965" 
                        target=_blank>�껨ʯ</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3498582" 
                        target=_blank>��Ҷ�ϵĶ���</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1759561" 
                        target=_blank>wxctw88</A></DIV></TD></TR>
                    <TR>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3493470" 
                        target=_blank>����Ķ����</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1761330" 
                        target=_blank>ok������</A></DIV></TD>
                      <TD class=STYLE3 width="35%">
                        <DIV align=left>��<A 
                        href="http://bbs.ifeng.com/viewthread.php?tid=3244769" 
                        target=_blank>�߾����������˼��</A></DIV></TD>
                      <TD width="15%">
                        <DIV align=left>����<A 
                        href="http://bbs.ifeng.com/space.php?action=viewpro&amp;uid=1140930" 
                      target=_blank>��������</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>   -->
     <TR>
          <TD height=226 class=index_title>������Ũ</TD></TR>
            <TABLE height=257 width="100%" border=0>
              <TBODY>
              <TR>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15357" 
                  target=_blank><IMG height=200 alt=���ӵ���������֪���� 
                  src="dw2_files/qingnong1.jpg" 
                  width=160 border=1></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15360" 
                  target=_blank><IMG height=200 alt="�������ӵİ���" 
                  src="dw2_files/qingnong2.jpg" 
                  width=160 border=1></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15375" 
                  target=_blank><IMG height=200 alt=����ڣ��������������ϰ�� 
                  src="dw2_files/qingnong3.jpg" 
                  width=160 border=1></A></DIV></TD>
              <!--  <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://bbs.ifeng.com/viewthread.php?tid=3679836" 
                  target=_blank><IMG height=200 alt=��������и� 
                  src="dw2_files/qingnong4.jpg" 
                  width=160 border=1></A></DIV></TD>--></TR>
              <TR>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15357" 
                  target=_blank>���ӵ���������֪����</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15360" 
                  target=_blank>�������ӵİ���</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://172.27.203.81:8080/news/news.php?id=15375" 
                  target=_blank>����ڣ��������������ϰ��</A></DIV></TD>
          <!--      <TD height=20>
                  <DIV align=center><A 
                  href="http://bbs.ifeng.com/viewthread.php?tid=3679836" 
                  target=_blank>��������и�</A></DIV></TD>--></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

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
