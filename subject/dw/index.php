<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0053)http://bbs.ifeng.com/zhuanti/200905/duanwu/index.html -->
<HTML><HEAD><TITLE>端午节专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
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
<script language="javascript" src="/js/smg.js"></script>
<script language="javascript">
	var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);	
</script>
<script language="JavaScript" type="text/javascript">
lastScrollY=0;
function heartBeat(){ 
var diffY;
if (document.documentElement && document.documentElement.scrollTop)
	diffY = document.documentElement.scrollTop;
else if (document.body)
	diffY = document.body.scrollTop
else
    {/*Netscape stuff*/}
	
//alert(diffY);
percent=.1*(diffY-lastScrollY); 
if(percent>0)percent=Math.ceil(percent); 
else percent=Math.floor(percent); 
document.getElementById("lovexin12").style.top=parseInt(document.getElementById
("lovexin12").style.top)+percent+"px";
document.getElementById("lovexin14").style.top=parseInt(document.getElementById
("lovexin12").style.top)+percent+"px";
lastScrollY=lastScrollY+percent; 
//alert(lastScrollY);
}
suspendcode12="<DIV id=\"lovexin12\" style='left:2px;POSITION:absolute;TOP:120px;'><img src='left.jpg'></div>"
suspendcode14="<DIV id=\"lovexin14\" style='right:2px;POSITION:absolute;TOP:120px;'><img src='right.jpg'></div>"
document.write(suspendcode12); 
document.write(suspendcode14); 
window.setInterval("heartBeat()",1);
</script>
<style type="text/css">
<!--
#lovexin12,#lovexin14{
   width:116px;
   height:271px;
}
html,body{
  }
#mm{
  }
-->
</style>
</head>

</HEAD>
<BODY >

<?		
	$newslist = $db->query('select * from smg_comment where resource_type="dw" order by created_at desc');	
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
                      <? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="新闻列表" inner join smg_subject s on c.subject_id=s.id and s.name="端午专题" order by n.priority asc, n.last_edited_at desc limit 20');?>
						<div id=s_left>
						<? for($i=0; $i<count($news); $i++){
								if($i==0){	?>
						<a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id?>" style="color:red; font-weight:bold;"><? echo $news[$i]->short_title;?></a>
						<?php }else{?>
							<a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id?>"><? echo $news[$i]->short_title;?></a>
						<?} }?>
						</div>	
                      </TD></TR></TBODY></TABLE></TD></TR>
             <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                     <TD><div class=title1>答题送礼品</div></TD></TR>
                    <TR>
                      <TD height=50>
                      	<div style="width:200px; ">答题有礼</div>
                      	<button id=btn1 onclick="window.location.href='/answer/pro_answer.php?id=16';" style="margin-left:10px;">点击答题</button>
                      	<button id=btn2 onclick="window.location.href='dwph.php';" style="margin-left:10px;">查看排行</button>
                      </TD></TR></TBODY></TABLE></TD></TR> 
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    	
                    <TR>
                      <TD><div class=title1>说说你的端午情缘</div></TD></TR>
                    <TR>
                    	<TR>
                      <TD height=146><marquee height="200" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
											<? for($i=0; $i<count($newslist); $i++){?>
											<div style="width:200px; margin-bottom:10px; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<? echo $newslist[$i]->comment;?></div>
											<? }?>
				</marquee></TD></TR>
                      <TD>
                      	<div id=s_right>
							<div class="title">端午节祝福</div>
							<form name="commentform" method="post" action="/pub/pub.post.php">
								<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
								<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
								<input type="hidden" name="type" value="comment">
								<input type="hidden" id="resource_type" name="post[resource_type]" value="dw">
								<button id=btn type="submit">发　表</button>
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
                  href="/news/news.php?id=15356" 
                  target=_blank><IMG height=140 
                  src="dw2_files/duanwu1.jpg" 
                  width=150 border=1 style="margin-left:5px; "></A></DIV></TD>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR>
                      <TD width="50%">
                        <P class=STYLE3 align=center><A 
                        href="/news/news.php?id=15355" 
                        target=_blank>名称与来历</A></P></TD>
                      <TD class=STYLE3 width="50%">
                        <DIV align=center><A 
                        href="/news/news.php?id=15356" 
                        target=_blank>美丽的传说</A></DIV></TD></TR>
                    <TR>
                      <TD height=85>
                        <DIV align=left><A 
                        href="/news/news.php?id=15355" 
                        target=_blank>&nbsp;&nbsp;&nbsp;&nbsp;农历五月初五，是中国民间的传统节日——端午节，它是中华民族古老的传统节日之一。端午也称端五，端阳。此外，端午节还有许多别称，如：午日节、重五节，五月节、浴兰节、女儿节，天中节、地腊、诗人节、龙日等等</A>。</DIV></TD>
                      <TD>
                        <DIV align=left><A 
                        href="/news/news.php?id=15356" 
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
                              href="/news/news.php?id=15363" 
                              target=_blank><IMG height=121 alt=赛龙舟 
                              src="dw2_files/sailongzhou.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=15363" 
                              target=_blank>赛龙舟</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=15363"
                              target=_blank>相传起源于古时楚国人因舍不得贤臣屈原投江死去，许多人划船追赶拯救。之后每年五月五日划龙舟以纪念之。借划龙舟驱散江中之鱼，以免鱼吃掉屈原身体。</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=15368" 
                              target=_blank><IMG height=121 alt=吃粽子 
                              src="dw2_files/chizongzi.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=15368" 
                              target=_blank>吃粽子</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=15368" 
                              target=_blank>千百年来，每年五月初，家家都要浸糯米、洗粽叶、包粽子，其花色品种更为繁多。而且流传到朝鲜、日本及东南亚诸国。</A></DIV></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=15373" 
                              target=_blank><IMG height=121 alt=悬艾叶菖蒲、钟馗像 
                              src="dw2_files/guaaiye.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=15373" 
                              target=_blank>悬艾叶菖蒲、钟馗像</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=15373" 
                              target=_blank>民谚说：“清明插柳，端午插艾”。在端午节，人们把插艾和菖蒲作为重要内容之一。家家都洒扫庭除，以菖蒲、艾条插于门眉，悬于堂中。</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=15370"
                              target=_blank><IMG height=121 alt=佩香囊、挂荷包 
                              src="dw2_files/xiangnang.jpg" 
                              width=106 border=1></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=15370" 
                              target=_blank>佩香囊、挂荷包</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=15370" 
                              target=_blank>端午节小孩佩香囊，传说有避邪驱瘟之意，实际是用于襟头点缀装饰。香囊内有朱砂、雄黄、香药，外包以丝布，清香四溢...</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR> 
     <TR>
          <TD height=226 class=index_title>粽香情浓</TD></TR>
            <TABLE height=257 width="100%" border=0>
              <TBODY>
              <TR>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="/news/news.php?id=15357" 
                  target=_blank><IMG height=200 alt=粽子的由来，你知道吗？ 
                  src="dw2_files/qingnong1.jpg" 
                  width=160 border=1></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="/news/news.php?id=15360" 
                  target=_blank><IMG height=200 alt="六种粽子的包法" 
                  src="dw2_files/qingnong2.jpg" 
                  width=160 border=1></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://meishi.enjoyoung.cn/home/dragon_boat/" 
                  target=_blank><IMG height=200 alt=人气美食带您吃粽子！ 
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
                  href="/news/news.php?id=15357" 
                  target=_blank>粽子的由来，你知道吗？</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=15360" 
                  target=_blank>六种粽子的包法</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://meishi.enjoyoung.cn/home/dragon_boat/" 
                  target=_blank>人气美食带您吃粽子！</A></DIV></TD>
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
<div id="mm">
</div>
<SCRIPT language=javascript 
src="dw2_files/sta_collection.js"></SCRIPT>
	
</BODY></HTML>
