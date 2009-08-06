<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML><HEAD><TITLE>日全食专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<META content="" name=keywords>
<META http-equiv=refresh content=null>
<LINK href="dw2_files/2007sanmod.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.5730.13" name=GENERATOR>
<STYLE type=text/css>
.STYLE3 {
	FONT-WEIGHT: normal; FONT-SIZE: 12px
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
.style8{
	width:135px; height:76px; line-height:20px; overflow:hidden; float:left; display:inline;
}
.style8 a{
	font-size:12px;
}
</STYLE>
<script language="JavaScript">
var startTime = new Date();
var EndTime=new Date('2009/07/22 07:30:00');
function GetRTime(){
	var NowTime = new Date();
	var nMS =EndTime - NowTime.getTime();
	var nD =Math.floor(nMS/(1000 * 60 * 60 * 24));
	var nH=Math.floor(nMS/(1000*60*60)) % 24;
	var nM=Math.floor(nMS/(1000*60)) % 60;
	var nS=Math.floor(nMS/1000) % 60;
	document.getElementById("RemainD").innerHTML="0";
	document.getElementById("RemainH").innerHTML="0";
	document.getElementById("RemainM").innerHTML="0";
	document.getElementById("RemainS").innerHTML="0";
	if(nD==0&&nH==0&&nM==0&&nS==0)
	{
		window.location.href="#";
	}
	else
	{
		setTimeout("GetRTime()",1000);
	}
}
window.onload=GetRTime;

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
		require_once('../../frame.php');
		$db = get_db();		
		$newslist = $db->query('select * from smg_comment where resource_type="sunmoon" order by created_at desc');	
?>
	
<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
  	
  <TR>
    <TD width=630 height=1></TD></TR></TBODY></TABLE>

<TABLE bgColor=#e9f2d9 cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD valign="top" >
    	<div style="width:748px; height:80px; padding-left:18px; padding-top:120px; background:url('sunmoon.jpg')"><strong style="font-size:20px; color:red; font-weight:bold;" id="RemainD"></strong><strong style="margin-left:40px; font-size:20px; color:red; font-weight:bold;" id="RemainH"></strong><strong style="margin-left:40px; font-size:20px; color:red; font-weight:bold;" id="RemainM"></strong><strong style="margin-left:30px; font-size:20px; color:red; font-weight:bold;" id="RemainS"></strong></div></TD>
    </TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <TBODY>
  <TR>
    <TD vAlign=top width=25% bgColor=#e9f2d9 >
      <TABLE width="100%" border=0>
        <TBODY>
       
        <TR>
          <TD>
            <TABLE width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>节目抢先看</div></TD></TR>
                    <TR>
                      <TD>
                      	<div id=s_left>
	                      <? 
						  	$video=$db->query('select n.id,n.title,n.photo_url,n.video_url from smg_video n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="video" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="节目抢先看" order by n.priority asc, n.created_at desc limit 4');
						  	show_video_player(200,150,$video[0]->photo_url,$video[0]->video_url);
						  ?>
						  <? for($i=0;$i<count($video);$i++){?>
						  <a target="_blank" href="/show/video.php?id=<? echo $video[$i]->id;?>"><? echo $video[$i]->title;?></a>
						  <? }?>
							</div>	
                      </TD></TR></TBODY></TABLE></TD></TR>
             <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                     <TD><div class=title1>答题赢观测镜</div></TD></TR>
                    <TR>
                      <TD height=50>
                      	<div style="width:200px; color:red;">快来参与答题赢观测镜！只要您答对5道选择题，就能获得电视新闻中心和番茄网特别制作的日全食观测镜一副，数量有限，快来参加！答案在《节目抢先看》视频短片中找哦！</div>
                      	<button id=btn1 style="margin-left:10px;">点击答题</button>
                      	<button id=btn2 onclick="window.location.href='dwph.php';" style="margin-left:10px;">查看排行</button>
                      </TD></TR></TBODY></TABLE></TD></TR> 
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    	
                    <TR>
                      <TD><div class=title1>留言赢观测镜</div></TD></TR>
                    <TR>
                    	<TR>
                      <TD><marquee height="150" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
						<? for($i=0; $i<count($newslist); $i++){?>
						<div style="width:200px; margin-bottom:10px; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->commenter;?></span>说：<? echo $newslist[$i]->content;?></div>
						<? }?>
				</marquee></TD></TR>
                      <TD>
                      	<div id=s_right>
						<div class="title">留言</div>
						<form name="commentform" method="post" action="/pub/pub.post.php">
						<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br /><div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
						<input type="hidden" id="resource_type" name="post[resource_type]" value="sunmoon">
						<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
						<input type="hidden" name="type" value="comment">
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
              	<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="新闻及时报" inner join smg_subject s on c.subject_id=s.id and s.name="日全食专题" order by n.priority asc, n.last_edited_at desc limit 8');?>
                <TD colSpan=2 class=index_title>新闻及时报　　　<a target="_blank" href="/news/news_list.php?type=sunmoon&id=<?php echo $news[0]->cid; ?>">更多</a></TD></TR>
              <TR>
                <TD width="20%" height=153>
                	
                  <DIV ><? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><IMG height=140 src="<? echo $news[$i]->photo_src;?>" width=150 border=0 style="margin-left:5px; "><? break;}}?></DIV></TD>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR align=left>
                      <TD width="50%">
                      	<? for($i=0;$i<4;$i++){?>
                        	<P class=STYLE3><A target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>" target="_blank"><? echo $news[$i]->short_title;?></A></P>
						<? }?>
					  </TD>
                      <TD valign=top class=STYLE3 width="50%">
                        <DIV align=left>
                        	<? for($i=4;$i<8;$i++){?>
								<P class=STYLE3><A target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>" target="_blank"><? echo $news[$i]->short_title;?></A></P>
							<? }?>
						</DIV></TD></TR>
           			</TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
     <TR>
          <TD>
          	<?php $news = $db->query('select n.description,n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="日食全揭秘" inner join smg_subject s on c.subject_id=s.id and s.name="日全食专题" order by n.priority asc, n.last_edited_at desc limit 4');?>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>日食全揭秘　　　<a target="_blank" href="/news/news_list.php?type=sunmmon&id=<?php echo $news[0]->cid; ?>">更多</a></TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[0]->id;?>" 
                              target="_blank"><IMG height=106  
                              src="<? echo $news[0]->photo_src;?>" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[0]->id?>" 
                              target="_blank"><? echo $news[0]->short_title;?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A  style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[0]->id?>"
                              target="_blank"><? echo $news[0]->description;?></A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[1]->id;?>" 
                              target="_blank"><IMG height=106  
                              src="<? echo $news[1]->photo_src;?>" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[1]->id;?>" 
                              target="_blank"><? echo $news[1]->short_title;?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[1]->id;?>" 
                              target="_blank"><? echo $news[1]->description;?></A></DIV></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[2]->id;?>" 
                              target="_blank"><IMG height=106 
                              src="<? echo $news[2]->photo_src;?>" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[2]->id;?>" 
                              target="_blank"><? echo $news[2]->short_title;?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[2]->id;?>" 
                              target="_blank"><? echo $news[2]->description;?></A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[3]->id;?>"
                              target="_blank"><IMG height=106  
                              src="<? echo $news[3]->photo_src;?>" 
                              width=106 border=0></A></DIV></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[3]->id;?>" 
                              target="_blank"><? echo $news[3]->short_title;?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left>
                              	<A style="font-size:12px;" href="/news/news.php?id=<? echo $news[3]->id;?>" target="_blank">
									<? echo $news[3]->description;?>
								</A>
							 </DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR> 
   		
     <TR>
     	<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="感受日全食" inner join smg_subject s on c.subject_id=s.id and s.name="日全食专题" order by n.priority asc, n.last_edited_at desc limit 6');?>
          <TD ><div style="padding-top:5px;" class=index_title>感受日全食　　　<a target="_blank" href="/news/news_list.php?type=sunmoon&id=<?php echo $news[0]->cid; ?>">更多</a></div></TD></TR>
            <TABLE width="100%" border=0>
              <TBODY>
              <TR valign="top">
                <TD width="25%" height=100>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[0]->id;?>" 
                  target="_blank"><IMG height=100  
                  src="<? echo $news[0]->photo_src;?>" 
                  width=160 border=0></A></DIV></TD>
                <TD width="25%" height=100>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[1]->id;?>" 
                  target="_blank"><IMG height=100  
                  src="<? echo $news[1]->photo_src;?>" 
                  width=160 border=0></A></DIV></TD>
                <TD width="25%" height=100>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[2]->id;?>" 
                  target="_blank"><IMG height=100  
                  src="<? echo $news[2]->photo_src;?>" 
                  width=160 border=0></A></DIV></TD></TR>
              <TR valign="top">
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[0]->id;?>" 
                  target="_blank"><? echo $news[0]->short_title;?></A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[1]->id;?>" 
                  target="_blank"><? echo $news[1]->short_title;?></A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[2]->id;?>" 
                  target="_blank"><? echo $news[2]->short_title;?></A></DIV></TD></TR>
				 <TR valign="top">
                <TD width="25%" height=100>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[3]->id;?>" 
                  target="_blank"><IMG height=100  
                  src="<? echo $news[3]->photo_src;?>" 
                  width=160 border=0></A></DIV></TD>
                <TD width="25%" height=100>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[4]->id;?>" 
                  target="_blank"><IMG height=100  
                  src="<? echo $news[4]->photo_src;?>" 
                  width=160 border=0></A></DIV></TD>
                <TD width="25%" height=100>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[5]->id;?>" 
                  target="_blank"><IMG height=100  
                  src="<? echo $news[5]->photo_src;?>" 
                  width=160 border=0></A></DIV></TD></TR>
              <TR valign="top">
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[3]->id;?>" 
                  target="_blank"><? echo $news[3]->short_title;?></A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[4]->id;?>" 
                  target="_blank"><? echo $news[4]->short_title;?></A></DIV></TD>
                <TD height=20>
                  <DIV align=center><A 
                  href="/news/news.php?id=<? echo $news[5]->id;?>" 
                  target="_blank"><? echo $news[5]->short_title;?></A></DIV></TD></TR>		  
		</TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

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
            src="botton.jpg" width=770 
            border=0></TD>
</TR></TBODY></TABLE></TD></TR></TBODY></TABLE><!--mark (  enorth_down ) parse begin-->
<STYLE type=text/css>TD {
	FONT-SIZE: 12px;
}
</STYLE>

</TABLE>
<div id="mm">
</div>
<SCRIPT language=javascript 
src="dw2_files/sta_collection.js"></SCRIPT>
	
</BODY></HTML>
