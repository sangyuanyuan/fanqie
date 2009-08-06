<?php require_once("../../frame.php");
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0053)http://bbs.ifeng.com/zhuanti/200905/duanwu/index.html -->
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
	width:135px; height:121px; line-height:20px; overflow:hidden; float:left; display:inline;
}
.style8 a{
	font-size:12px;
}
</STYLE>


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
		$sql1=' and (n.created_at >="2009-01-01 00:00:00" and n.created_at<="2009-03-31 23:59:59" )';
		$sql2=' and (n.created_at >="2009-01-01 00:00:00" and n.created_at<="2009-03-31 23:59:59" )';	
		$newslist = $db->query('select * from smg_comment where resource_type="pj" order by created_at desc');
		$strsql="select a.*,sum(countnum) as num from (select d.name,sum(n.click_count) as countnum from smg_dept d left join smg_news n on d.id=n.dept_id and is_recommend=1 ".$sql1." group by n.dept_id union select d.name,sum(n.click_count) as countnum from smg_dept d left join smg_video n on d.id=n.dept_id and is_recommend=1 ".$sql2." group by n.dept_id) as a group by name order by num desc";
		$fwcount=$db->query($strsql);
?>
	
<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
  	
  <TR>
    <TD width=630 height=1></TD></TR></TBODY></TABLE>

<TABLE bgColor=#e9f2d9 cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD valign="top" >
    	<div style="width:748px; height:80px; padding-left:18px; padding-top:120px; background:url('logo.jpg')"></div></TD>
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
                      <TD><div class=title1>评选规则</div></TD></TR>
                    <TR>
                      <TD>
                      	<div id=s_left>
	                      <? 
						  	$video=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="评选规则" inner join smg_subject s on c.subject_id=s.id and s.name="明星果农" order by n.priority asc, n.last_edited_at desc limit 4');
						  ?>
						  <? for($i=0;$i<count($video);$i++){?>
						  <a target="_blank" href="/news/news.php?id=<? echo $video[$i]->id;?>"><? echo $video[$i]->title;?></a>
						  <? }?>
							</div>	
                      </TD></TR></TBODY></TABLE></TD></TR>
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    	
                    <TR>
                      <TD><div class=title1>网友留言</div></TD></TR>
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
						<div id=subject_comment>昵称：<input type="text" name="commenter" id="commenter"/><br />
						<div id=comment>内容：</div><textarea id="commentcontent" name="comment"></textarea></div>
						<input type="hidden" name="type" value="comment">
						<input type="hidden" id="resource_type" name="post[resource_type]" value="pj">
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
          	<? $news = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="最新简讯" inner join smg_subject s on c.subject_id=s.id and s.name="明星果农" order by n.priority asc, n.last_edited_at desc limit 8');?>
            <TABLE height=210 width="100%" border=0>
              <TBODY>
              <TR>
                <TD colSpan=2 class=index_title>最新简讯　　　<a target="_blank" href="/news/news_list.php?type=pj&id=<?php echo $news[0]->cid;?>">更多</a></TD></TR>
              <TR>
                <TD width="20%" height=153>
                	
                  <DIV ><? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><IMG height=140 src="<? echo $news[$i]->photo_src;?>" width=150 border=0 style="margin-left:5px; "><? break;}}?></DIV></TD>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR align=left>
                      <TD width="50%">
                      	<? for($i=0;$i<4;$i++){?>
                        	<P class=STYLE3><A href="/news/news.php?id=<? echo $news[$i]->id;?>" target=_blank><? echo $news[$i]->short_title;?></A></P>
						<? }?>
					  </TD>
                      <TD valign=top class=STYLE3 width="50%">
                        <DIV align=left>
                        	<? for($i=4;$i<8;$i++){?>
								<P class=STYLE3><A href="/news/news.php?id=<? echo $news[$i]->id;?>" target=_blank><? echo $news[$i]->short_title;?></A></P>
							<? }?>
						</DIV></TD></TR>
           			</TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
     <TR>
          <TD>
          	<? $news = $db->query('select n.photo_src,n.content,n.id,n.short_title,n.description,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星级番茄果农" inner join smg_subject s on c.subject_id=s.id and s.name="明星果农" order by n.priority asc, n.last_edited_at desc limit 9');?>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>星级番茄果农　　　<a target="_blank" href="/news/news_list.php?type=pj&id=<?php echo $news[0]->cid;?>">更多</a></TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD height=17>
                        <TABLE width="100%" border=0 >
                          <TBODY>
                          <TR>
                            <TD width="52%" rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[0]->id;?>" 
                              target=_blank><IMG height=106  
                              src="<? echo $news[0]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[0]->id?>" 
                              target=_blank><? echo delhtml($news[0]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A  style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[0]->id?>"
                              target=_blank><? echo delhtml($news[0]->content);?></A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[1]->id;?>" 
                              target=_blank><IMG height=106  
                              src="<? echo $news[1]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[1]->id;?>" 
                              target=_blank><? echo delhtml($news[1]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[1]->id;?>" 
                              target=_blank><? echo delhtml($news[1]->content);?></A></DIV></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[2]->id;?>" 
                              target=_blank><IMG height=106 
                              src="<? echo $news[2]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[2]->id;?>" 
                              target=_blank><? echo delhtml($news[2]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[2]->id;?>" 
                              target=_blank><? echo delhtml($news[2]->content);?></A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[3]->id;?>"
                              target=_blank><IMG height=106  
                              src="<? echo $news[3]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[3]->id;?>" 
                              target=_blank><? echo delhtml($news[3]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left>
                              	<A style="font-size:12px;" href="/news/news.php?id=<? echo $news[3]->id;?>" target=_blank>
									<? echo delhtml($news[3]->content);?>
								</A>
							 </DIV>
							 </TD>
						 </TR>
						 </TBODY>
						</TABLE>
					 </TD>
					 </TR>
					  <TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[4]->id;?>" 
                              target=_blank><IMG height=106 
                              src="<? echo $news[4]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[4]->id;?>" 
                              target=_blank><? echo delhtml($news[4]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[4]->id;?>" 
                              target=_blank><? echo delhtml($news[4]->content);?></A></DIV></TD></TR></TBODY></TABLE></TD>
                      <TD width="45%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[5]->id;?>"
                              target=_blank><IMG height=106  
                              src="<? echo $news[5]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[5]->id;?>" 
                              target=_blank><? echo delhtml($news[5]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left>
                              	<A style="font-size:12px;" href="/news/news.php?id=<? echo $news[5]->id;?>" target=_blank>
									<? echo delhtml($news[5]->content);?>
								</A>
							 </DIV>
							 </TD>
						 </TR>
						 </TBODY>
						</TABLE>
					 </TD>
					 </TR>
					<TR>
                      <TD width="55%">
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="52%" height=121 rowSpan=2>
                              <DIV align=center><A 
                              href="/news/news.php?id=<? echo $news[6]->id;?>" 
                              target=_blank><IMG height=106 
                              src="<? echo $news[6]->photo_src;?>" 
                              width=106 border=0></A></DIV><br><img src="xunzhang.gif"></TD>
                            <TD class=STYLE3 width="48%">
                              <DIV align=left><A style="color:#010156; font-weight:bold;"
                              href="/news/news.php?id=<? echo $news[6]->id;?>" 
                              target=_blank><? echo delhtml($news[6]->description);?></A></DIV></TD></TR>
                          <TR>
                            <TD>
                              <DIV class=style8 align=left><A style="font-size:12px;"
                              href="/news/news.php?id=<? echo $news[6]->id;?>" 
                              target=_blank><? echo delhtml($news[6]->content);?></A></DIV></TD></TR></TBODY></TABLE></TD>
                     
					 </TR>
					 </TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR> 
   		
     <TR>
          <TD ><div style="padding-top:5px;" class=index_title>番茄果农排行　　　<a target="_blank" href="/news/newslist.php?id=115"></a></div></TD></TR>
 			<? 
			$strsql1='select *,(n1+v1+p1) as a1,(n2+v2+p2) as a2  from (select a.name,ifnull(b.allcounts,0) as n1,ifnull(c.counts,0) as n2,ifnull(p1allcounts,0) as p1,ifnull(p2counts,0) as p2,ifnull(v1allcounts,0) as v1,ifnull(v2counts,0) as v2 from smg_dept a left join
(select count(dept_id) as allcounts,dept_id from smg_news n where is_recommend=1  '.$sql.'  group by dept_id) b on a.id=b.dept_id left join  (select count(dept_id) as counts,dept_id from smg_news n where is_adopt=1  '.$sql.' group by dept_id) c on b.dept_id = c.dept_id
left join (select count(dept_id) as p1allcounts,dept_id from smg_images n where is_recommend=1  '.$sql2.'  group by dept_id) p1 on a.id=p1.dept_id left join  (select count(dept_id) as p2counts,dept_id from smg_images n where is_adopt=1 '.$sql2.'  group by dept_id) p2 on p1.dept_id = p2.dept_id
left join (select count(dept_id) as v1allcounts,dept_id from smg_video n where is_recommend=1  '.$sql2.'  group by dept_id) v1 on a.id=v1.dept_id left join  (select count(dept_id) as v2counts,dept_id from smg_video n where is_adopt=1  '.$sql2.' group by dept_id) v2 on v1.dept_id = v2.dept_id
order by b.allcounts desc) tb order by a1 desc';
$clickcount=$db->query($strsql1);
?>
			   <TABLE style="margin-left:10px;" width="90%" border=0>
	              <TBODY align="left">
		              <TR valign="top">
		                <td>
		                	<table >
		                		<tr>
		                			<td colspan=2>
		                				<b>第一季度发稿量排行榜：</b>
									</td>
								</tr>
								<? for($i=0;$i<5;$i++){?>
								<tr>
		                			<td>
		                				<? echo $clickcount[$i]->name;?>
									</td>
									<td>
										<? echo $clickcount[$i]->a1;?>
									</td>
								</tr>
								<? }?>
								<tr><td colspan=2 align="right"><a href="ph.php?id=1">更多</a></td></tr>
							</table>
						</td>
					  </TR>
					  <TR  valign="top">
					  	<td>
					  		<table >
		                		<tr>
		                			<td colspan=2>
		                				<b>第一季度点击量排行榜：</b>
									</td>
								</tr>
								<? for($i=0;$i<5; $i++){?>
								<tr>
		                			<td>
		                				<? echo $fwcount[$i]->name;?>
									</td>
									<td>
										<? echo $fwcount[$i]->num;?>
									</td>
								</tr>
								<? }?>
								<tr><td colspan=2 align="right"><a href="ph.php?id=2">更多</a></td></tr>
							</table>
					  	</td>
					  </TR>


              	  </TBODY>
				 </TABLE></TD></TR></TBODY></TABLE>

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
	FONT-SIZE: 12px
}
</STYLE>

</TABLE>
<div id="mm">
</div>
<SCRIPT language=javascript 
src="dw2_files/sta_collection.js"></SCRIPT>
	
</BODY></HTML>
