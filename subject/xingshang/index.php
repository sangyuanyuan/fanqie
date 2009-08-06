<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>星尚专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<META content=星尚 name=description 星尚>
<META content="" name=keywords>
<META http-equiv=refresh content=null>
<LINK href="dw2_files/2007sanmod.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.5730.13" name=GENERATOR>
<STYLE type=text/css>
.STYLE3 {
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
</HEAD>
<BODY style="background:url('beijing.jpg');">
	
<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
  	
  <TR>
    <TD width=630 height=1></TD></TR></TBODY></TABLE>

<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG height=140 src="logo.gif" width=770></TD>
    </TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <TBODY>
  <TR>
    <TD vAlign=top width=25% bgColor=#e9f2d9>
      <TABLE width="100%" border=0>
        <TBODY>
       
        <TR>
          <TD height=81>
            <TABLE width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                  	<? $news=$db->query('select n.id,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星尚简介" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc, n.last_edited_at desc limit 1');
                  		$photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星尚简介" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc,n.created_at desc limit 1');
                  	?>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>星尚简介<a style="color:#F2E275;" target="_blank" href="http://www.enjoyoung.cn/ecms/enjoyoung/">更多</a></div></TD></TR>
                    <TR>
                      <TD>
                      <a target="_blank" href="http://www.enjoyoung.cn/ecms/enjoyoung/"><img border=0 width="210" height="80" src="<? echo $photo[0]->src;?>"></a>
						<div id=s_left>
							<a target="_blank" href="xs.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->description;?></a>
						</div>	
                      </TD></TR></TBODY></TABLE></TD></TR>
             <TR>
                <TD>
                	<? 
                	$news=$db->query('select n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星光璀璨" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc, n.last_edited_at desc limit 3');
                	$photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星光璀璨" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc,n.created_at desc limit 1');
                	?>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                     <TD><div class=title1>星光璀璨<a style="color:#F2E275;" target="_blank" href="xslist.php?id=<?php echo $news[0]->cid;?>">更多</a></div></TD></TR>
                    <TR>
                      <TD height=50>
                      	
                      	<div style="width:50px; float:left; display:inline;"><a target="_blank" href="xslist.php?id=<?php echo $news[0]->id;?>"><img width=50 height=60 border=0 src="<? echo $photo[0]->src;?>"></a></div>
                      	<div style="width:150px; float:left; display:inline;">
                      		<? for($i=0;$i<count($news);$i++){?>
                      		<div style="width:150px; height:20px; line-height:20px; overflow:hidden; float:left; display:inline;">
                      			<a target="_blank" href="xs.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a>
                      		</div>
                      		<? }?>
                      	</div>
                      </TD></TR></TBODY></TABLE></TD></TR> 
              
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>星尚互动</div></TD></TR>
                    	<TR>
                    		<? $newslist = $db->query('select * from smg_comment where resource_type="xingshang" order by created_at desc');?>
                      <TD height=200 ><marquee height="200" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
							<? for($i=0; $i<count($newslist); $i++){?>
							<div style="width:100%; margin-bottom:10px; overflow:hidden; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<? echo $newslist[$i]->comment;?></div>
							<? }?>
				</marquee></TD></TR>
                      <TD>
                      	<div id=s_right>
						<div class="title"><span style="font-size:14px; color:red;">星尚祝语</span></div>
						<form name="commentform" method="post" action="/pub/pub.post.php">
						<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
						<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
						<input type="hidden" name="type" value="comment">
						<input type="hidden" id="resource_type" name="post[resource_type]" value="xingshang">
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
          	<? $news=$db->query('select n.description,n.photo_src,n.id,n.title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="大展星途" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc, n.last_edited_at desc limit 7');?>
            <TABLE height=210 width="100%" border=0>
              <TBODY>
              <TR>
                <TD height=27 colSpan=2 class=index_title>大展星途<a target="_blank" href="xslist.php?id=<?php echo $news[0]->cid;?>">更多</a></TD></TR>
              <TR>
                <TD width="20%" height=153>
                  <DIV align=left>
                  	<? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><A href="xs.php?id=<?php echo $news[$i]->id;?>" target=_blank><IMG border=0 height=140 src="<? echo $news[$i]->photo_src;?>" width=150 border=0 style="margin-left:5px;"></A><? break;}}?>
                  	</DIV></TD>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR>
                      <TD height=85>
                      	<DIV align=left style="width:100%; height:20px; line-height:20px; font-size:16px; text-align:center; font-weight:bold; overflow:hidden; float:left; display:inline;"><a target="_blank" href="xs.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->title;?></div>
                      	<DIV align=left style="width:100%; line-height:20px; font-size:12px; text-indent:24px; overflow:hidden; float:left; display:inline;"><a target="_blank" href="xs.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->description;?></a></div>
                        <? for($i=1;$i<count($news);$i++){?>
                        	<DIV align=left style="width:100%; height:20px; line-height:20px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="xs.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
      <tr>
      	<td>
      		<table height=86 width=100% border=0>
      			<? $video=$db->query('select n.id,n.title,n.photo_url,n.video_url,c.id as cid from smg_video n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="video" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星光点点" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc, n.created_at desc limit 6');?>
      			<tbody>
      				<tr>
      					<TD colSpan=2 class=index_title>星光点点</TD>
      				</tr>
      				<tr>
      					<td colspan=2 height="86">
				      <div id=demo style="overflow:hidden;height:90px;width:512px;">
				      	<table cellpadding="0" cellspacing="0" border="0">
									<tr><td id="demo1" valign="top" align="center">
									<table cellpadding="2" cellspacing="0" border="0">
									<tr align="center">
									<? for($i=0;$i<count($video);$i++){?>
										<td><a target="_blank" href="/show/list.php?id=<?php echo $video[0]->cid;?>"><img border=0 height="86" src="<? echo $video[$i]->photo_url;?>" ></a></td>
									<? }?>
									</tr>
									</table>
									</td>
									<td id="demo2" valign="top"></td>
									</tr>
									</table>
									</div>
									<script>
									var speed=20 //速度数值越大速度越慢
									demo2.innerHTML=demo1.innerHTML
									function Marquee(){
									if(demo2.offsetWidth-demo.scrollLeft<=0)
									demo.scrollLeft-=demo1.offsetWidth
									else{
									demo.scrollLeft++
									}
									}
									var MyMar=setInterval(Marquee,speed)
									demo.onmouseover=function() {clearInterval(MyMar)}
									demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
									</script>
								</td>
      				</tr>
      			</tbody>
      		</table>
      	</td>
      </tr>
     <TR>
          <TD>
          	<? 
          		$news=$db->query('select n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="聚焦星尚" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc, n.last_edited_at desc limit 12');
          		$photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="聚焦星尚" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc,n.created_at desc limit 1');
          	?>
            <TABLE height=68 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=index_title>聚焦星尚<a style="color:#F2E275;" target="_blank" href="xslist.php?id=<?php echo $news[0]->cid;?>">更多</a></TD></TR>
              <TR>
                <TD>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD height=17>
                        <TABLE width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="20%" height=120>
                              <DIV align=left><a target="_blank" href="xslist.php?id=<?php echo $photo[0]->cid;?>"><IMG height=120  src="<? echo $photo[0]->src;?>" width=150 border=0></a></DIV></TD>
                            <TD class=STYLE3 width="40%">
                            	<? for($i=0;$i< 6;$i++){?>
                              <DIV align=left style="width:100%; height:20px; line-height:20px;  overflow:hidden; float:left; display:inline;"><A style="font-size:12px; font-weight:normal;" href="xs.php?id=<? echo $news[$i]->id;?>" target=_blank><? echo $news[$i]->title;?></A></DIV><? }?>
                             </TD>
                             <TD class=STYLE3 width="40%">
                            	<? for($i=6;$i<12;$i++){?>
                              <DIV align=left style="width:100%; height:20px; line-height:20px;  overflow:hidden; float:left; display:inline;"><A style="font-size:12px; font-weight:normal;" href="xs.php?id=<? echo $news[$i]->id;?>" target=_blank><? echo $news[$i]->title;?></A></DIV><? }?>
                             </TD>
                            </TR>
                          </TBODY></TABLE></TD>
                     </TR>
               </TBODY></TABLE></TD></TR> 
   		<? $news=$db->query('select n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="我们的星尚" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc, n.last_edited_at desc limit 6');
   			$photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="我们的星尚" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc,n.created_at desc limit 8');
   		?>
     <TR>
          <TD height=226 class=index_title>我们的星尚<a style="color:#F2E275;" target="_blank" style="margin-left:280px;" href="xslist.php?id=<?php echo $news[0]->cid;?>">更多</a></TD></TR>
            <TABLE width="100%" border=0>
              <TBODY>
              	<tr>
              		<td colspan=4></td>
              	</tr>
              	<tr>
              		<? for($i=0; $i< 4;$i++){?>
              			<td width="25%" height=100><a target="_blank" href="xslist.php?id=<?php echo $photo[$i]->cid; ?>"><img border=0 width=120 height=100 src="<? echo $photo[$i]->src;?>"></a></td>
              		<? }?>
              	</tr>
              	<tr>
              		<? for($i=4; $i< 8;$i++){?>
              			<td width="25%" height=100><a target="_blank" href="xslist.php?id=<?php echo $photo[$i]->cid; ?>"><img border=0 width=120 height=100 src="<? echo $photo[$i]->src;?>"></a></td>
              		<? }?>
              	</tr>
              <TR>
                <TD colspan=2>
                  <? for($i=0;$i<3;$i++){?>
                		<div style="width:100%;height:20px; line-height:20px; overflow:hidden; text-align:left; float:left; display:inline;"><a target="_blank" style="font-weight:bold;" href="xs.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
                		<? }?></TD>
                <td colspan=2>
                	<? for($i=3;$i<6;$i++){?>
                		<div style="width:100%;height:20px; line-height:20px; overflow:hidden; text-align:left; float:left; display:inline;"><a target="_blank" style="font-weight:bold;" href="xs.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
                		<? }?></td>
               </TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY>
               </TABLE>
               <? $photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星尚精品" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by n.priority asc,n.created_at desc limit 8');?>
<TABLE align=center valign=top width=778 border=0>
        <TBODY>
        <TR> <td  class=index_title1>星尚精品</td></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>
        <TBODY>
        <TR>
          <TD height=150 bgColor=#ffffcc>
          	<div id=demo3 style="overflow:hidden;height:129px;width:770px;">
				      	<table cellpadding="0" cellspacing="0" border="0">
									<tr><td id="demo4" valign="top" align="center">
									<table cellpadding="2" cellspacing="0" border="0">
									<tr align="center">
									<? for($i=0;$i<count($photo);$i++){?>
										<td><a target="_blank" href="http://www.enjoyoung.cn/ecms/enjoyoung/"><img border=0 height="129" src="<? echo $photo[$i]->src;?>" ></a></td>
									<? }?>
									</tr>
									</table>
									</td>
									<td id="demo5" valign="top"></td>
									</tr>
									</table>
									</div>
									<script>
									var speed1=20 //速度数值越大速度越慢
									demo5.innerHTML=demo4.innerHTML
									function Marquee1(){
									if(demo5.offsetWidth-demo3.scrollLeft<=0)
									demo3.scrollLeft-=demo4.offsetWidth
									else{
									demo3.scrollLeft++
									}
									}
									var MyMar1=setInterval(Marquee1,speed1)
									demo3.onmouseover=function() {clearInterval(MyMar1)}
									demo3.onmouseout=function() {MyMar1=setInterval(Marquee1,speed1)}
									</script></TD>
      </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <!--mark (  enorth_down ) parse begin-->
<STYLE type=text/css>
TD {
	FONT-SIZE: 12px
}
</STYLE>

</TABLE>
<div id="mm">
</div>
	
</BODY></HTML>
