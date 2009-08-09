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
<?php js_include_once_tag('total'); ?>
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
<script>
	total("专题-星尚","other");
</script>
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
                  	<? $news=$db->query('select n.id,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星尚简介" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by i.priority asc, n.created_at desc limit 1');
                  		$photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星尚简介" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by i.priority asc,n.created_at desc limit 1');
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
                	<?php
                	$news=$db->query('select n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星光璀璨" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by i.priority asc, n.created_at desc limit 3');
                	$photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星光璀璨" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by i.priority asc,n.created_at desc limit 1');
                	?>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                     <TD><div class=title1>星光璀璨<a style="color:#F2E275;" target="_blank" href="xslist.php?id=<?php $news[0]->id;?>">更多</a></div></TD></TR>
                    <TR>
                      <TD height=50>
                      	
                      	<div style="width:50px; float:left; display:inline;"><a target="_blank" href="xslist.php?id=<?php $news[0]->id;?>"><img width=50 height=60 border=0 src="<? echo $photo[0]->src;?>"></a></div>
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
          	<? 
          		$id=$_REQUEST['id'];
          		$news=$db->query('select n.id,n.title,n.created_at,c.name as cname from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.id='.$id.' inner join smg_subject s on c.subject_id=s.id and s.identity="xingshang" order by i.priority asc, n.created_at desc');
				alert('select n.id,n.title,n.created_at,c.name as cname from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.id='.$id.' inner join smg_subject s on c.subject_id=s.id and s.identity="xingshang" order by i.priority asc, n.created_at desc');
          	?>
            <TABLE height=210 width="100%" border=0>
              <TBODY>
              <TR>
                <TD colSpan=2 class=index_title><? echo $news[0]->cname;?></TD></TR>
              <TR>
                <TD width="100%">
                  <TABLE width="100%" border=0 align=left>
                    <TBODY>
                    <TR>
                      <TD>
                        	<? for($i=0;$i<count($news);$i++){?>
                        	<DIV align=left style="width:100%; height:20px; line-height:20px; overflow:hidden; float:left; display:inline;"><a target="_blank" href="xs.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
      </TBODY></TABLE></TD></TR></TBODY>
               </TABLE>
               <? $photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="星尚精品" inner join smg_subject s on c.subject_id=s.id and s.name="星尚专题" order by i.priority asc,n.created_at desc limit 8');?>
<TABLE align=center valign=top width=778 border=0>
        <TBODY>
        <TR> <td  class=index_title1>星尚精品</td></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>
        <TBODY>
        <TR>
          <TD bgColor=#ffffcc>
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
									var speed=20 //速度数值越大速度越慢
									demo5.innerHTML=demo4.innerHTML
									function Marquee(){
									if(demo5.offsetWidth-demo3.scrollLeft<=0)
									demo3.scrollLeft-=demo4.offsetWidth
									else{
									demo3.scrollLeft++
									}
									}
									var MyMar=setInterval(Marquee,speed)
									demo3.onmouseover=function() {clearInterval(MyMar)}
									demo3.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
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
