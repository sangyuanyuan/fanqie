<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0053)http://bbs.ifeng.com/zhuanti/200905/duanwu/index.html -->
<HTML><HEAD><TITLE>元宵节专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<META http-equiv=refresh content=null>
<LINK href="dw2_files/2007sanmod.css" type=text/css rel=stylesheet>
	<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("专题-元宵专题","server");
</script>
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
   width:83px;
   height:400px;
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
	$newslist = $db->query('select * from smg_comment where resource_type="yx" order by created_at desc');	
?>
	
<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
  	
  <TR>
    <TD width=630 height=1></TD></TR></TBODY></TABLE>

<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG
      src="dw2_files/yx.gif" width=770></TD>
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
                      <? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="新闻列表" inner join smg_subject s on c.subject_id=s.id and s.name="元宵专题" order by i.priority asc, n.created_at desc limit 20');?>
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
                     <TD><div class=title1>猜灯谜送礼品</div></TD></TR>
                    <TR>
                      <TD height=50>
                      	<div style="width:200px; ">猜灯谜有礼</div>
                      	<button id=btn1 onclick="window.location.href='/answer/pro_answer.php?id=48';" style="margin-left:10px;">点击猜灯谜</button>
                      	<button id=btn2 onclick="window.location.href='yxph.php';" style="margin-left:10px;">查看排行</button>
                      </TD></TR></TBODY></TABLE></TD></TR> 
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    	
                    <TR>
                      <TD><div class=title1>说说你的元宵情缘</div></TD></TR>
                    <TR>
                    	<TR>
                      <TD height=146><marquee height="200" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
											<? for($i=0; $i<count($newslist); $i++){?>
											<div style="width:200px; margin-bottom:10px; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<? echo $newslist[$i]->comment;?></div>
											<? }?>
				</marquee></TD></TR>
                      <TD>
                      	<div id=s_right>
							<div class="title">元宵节祝福</div>
							<form name="commentform" method="post" action="/pub/pub.post.php">
								<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
								<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
								<input type="hidden" name="type" value="comment">
								<input type="hidden" id="resource_type" name="post[resource_type]" value="yx">
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
                <TD colSpan=2 class=index_title>元宵节传说</TD></TR>
              <TR>
                <TD width="20%" height=153>
                  <DIV align=left><A 
                  href="/news/news/news.php?id=42145" 
                  target=_blank><IMG height=140 
                  src="dw2_files/yx1.jpg" 
                  width=150 border=0 style="margin-left:5px; "></A></DIV></TD>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR>
                      <TD width="50%">
                        <P class=STYLE3 align=center><A 
                        href="/news/news/news.php?id=42145" 
                        target=_blank>名称与来历</A></P></TD>
                      <TD class=STYLE3 width="50%">
                        <DIV align=center><A 
                        href="/news/news.php?id=42145" 
                        target=_blank>美丽的传说</A></DIV></TD></TR>
                    <TR>
                      <TD height=85>
                        <DIV align=left><A 
                        href="/news/news/news.php?id=42145" 
                        target=_blank>&nbsp;&nbsp;&nbsp;&nbsp;元宵节是中国的传统节日，早在2000多年前的西汉就有了，元宵赏灯始于东汉明帝时期，明帝提倡佛教，听说佛教有正月十五日僧人观佛舍利，点灯敬佛的做法，就命令这一天夜晚在皇宫和寺庙里点灯敬佛，令士族庶民都挂灯。以后这种佛教礼仪节日逐渐形成民间盛大的节日。  </A></DIV></TD>
                      <TD>
                        <DIV align=left><A 
                        href="/news/news/news.php?id=42145" 
                        target=_parent>&nbsp;&nbsp;&nbsp;&nbsp;在汉文帝时，已下令将正月十五定为元宵节。汉武帝时，“太一神”的祭祀活动定在正月十五。（太一：主宰宇宙一切之神）。司马迁创建“太初历”时，就已将元宵节确定为重大节日。</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
     <TR>
          <TD>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>元宵节的习俗</TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD colSpan=2 height=17>
                        <DIV 
                        align=left>&nbsp;&nbsp;&nbsp;&nbsp;元宵节是中国的传统节日，所以全国各地都过，大部分地区的习俗是差不多的，但各地也还是有自己的特点。</DIV></TD></TR>
                    <TR>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=42146" 
                              target=_blank><IMG height=121 alt=观 灯 
                              src="dw2_files/gd.jpg" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=42146" 
                              target=_blank>观 灯</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=42146"
                              target=_blank>元宵放灯的习俗，在唐代发展成为盛况空前的灯市，当时的京城长安已是拥有百万人口的世界最大都市，社会富庶。在皇帝的亲自倡导下，元宵灯节办得越来越豪华。</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=42147" 
                              target=_blank><IMG height=121 alt=吃元宵 
                              src="dw2_files/cyx.jpg" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=42147" 
                              target=_blank>吃元宵</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=42147" 
                              target=_blank>元宵即"汤圆"以白糖、玫瑰、芝麻、豆沙、黄桂、核桃仁、果仁、枣泥等为馅，用糯米粉包成圆形，可荤可素，风味各异。</A></DIV></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news/news.php?id=42148" 
                              target=_blank><IMG height=121 alt=浪漫的节日
                              src="dw2_files/yxqrj.jpg" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news/news.php?id=42148" 
                              target=_blank>浪漫的节日</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=42148" 
                              target=_blank>元宵节也是一个浪漫的节日，传统社会的年轻女孩不允许出外自由活动，但是过节却可以结伴出来游玩，元宵节赏花灯正好是一个交谊的机会，未婚男女借着赏花灯也顺便可以为自己物色对象。</A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=42150"
                              target=_blank><IMG height=121 alt=耍狮子
                              src="dw2_files/ssz.jpg" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A 
                              href="/news/news.php?id=42150" 
                              target=_blank>耍狮子</A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV align=left><A 
                              href="/news/news.php?id=42150" 
                              target=_blank>“耍狮子”始于魏晋，盛于唐，舞法上有文武之分，文舞表现狮子的温驯，有抖毛、打滚等动作，武狮表现狮子的凶猛，有腾跃、蹬高、滚彩球等动作。</A></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR> 
     <TR>
          <TD height=226 class=index_title>宵香情浓</TD></TR>
            <TABLE height=257 width="100%" border=0>
              <TBODY>
              <TR>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="/news/news/news.php?id=42145" 
                  target=_blank><IMG height=200 alt=元宵的由来，你知道吗？ 
                  src="dw2_files/yxyl.jpg" 
                  width=160 border=0></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="/news/news/news.php?id=42154" 
                  target=_blank><IMG height=200 alt="元宵的几种做法" 
                  src="dw2_files/yxzf.jpg" 
                  width=160 border=0></A></DIV></TD>
                <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://meishi.enjoyoung.cn/users/55998/blogs/posts/1529" 
                  target=_blank><IMG height=200 alt=人气美食带您吃元宵！ 
                  src="dw2_files/rqms.jpg" 
                  width=160 border=0></A></DIV></TD>
              <!--  <TD width="25%" height=200>
                  <DIV align=center><A 
                  href="http://bbs.ifeng.com/viewthread.php?tid=3679836" 
                  target=_blank><IMG height=200 alt=庆阳香包有感 
                  src="dw2_files/qingnong4.jpg" 
                  width=160 border=0></A></DIV></TD>--></TR>
              <TR>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news/news.php?id=42145" 
                  target=_blank>元宵的由来，你知道吗？</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news/news.php?id=42154" 
                  target=_blank>元宵的几种做法</A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="http://meishi.enjoyoung.cn/users/55998/blogs/posts/1529" 
                  target=_blank>人气美食带您吃元宵！</A></DIV></TD>
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
