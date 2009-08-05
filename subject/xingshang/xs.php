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
<script language="javascript" src="/js/smg.js"></script>
<script language="javascript">
	var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);	
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
</HEAD>
<BODY style="background:url('beijing.jpg');">

<? 
		require_once('../libraries/sqlrecordsmanager.php');
		require_once('../inc/pubfun.inc.php');
		require_once('../modules/mod_vote/mod_class_define.php');
		
		$sqlmanager = new SqlRecordsManager();		
?>
	
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
                  	<? $news=$sqlmanager->GetRecords('select * from smg_news where isadopt=1 and main_cate_id=104 order by priority asc,pubdate desc',1,1);
                  		$photo=$sqlmanager->GetRecords('select * from smg_photo where isadopt=1 and main_cate_id=39 order by priority asc,createtime desc',1,1);
                  	?>
                    <TBODY>
                    <TR>
                      <TD><div class=title1>星尚简介<a target="_blank" href="http://www.enjoyoung.cn/ecms/enjoyoung/">更多</a></div></TD></TR>
                    <TR>
                      <TD>
                      <a target="_blank" href="xs.php?id=<? echo $news[0]->id;?>"><img border=0 width="210" height="80" src="<? echo $photo[0]->photourl;?>"></a>
											<div id=s_left>
												<a target="_blank" href="xs.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->description;?></a>
											</div>	
                      </TD></TR></TBODY></TABLE></TD></TR>
             <TR>
                <TD>
                	<? $news=$sqlmanager->GetRecords('select * from smg_news where isadopt=1 and main_cate_id=101 order by priority asc,pubdate desc',1,5)?>
                  <TABLE width="100%" border=0>
                    <TBODY>
                    <TR>
                     <TD><div class=title1>星光璀璨<a target="_blank" href="xslist.php?id=101">更多</a></div></TD></TR>
                    <TR>
                      <TD height=50>
                      	
                      	<div style="width:50px; float:left; display:inline;"><a target="_blank" href="xslist.php?id=101"><img width=50 height=60 border=0 src="<? echo $photo[0]->photourl;?>"></a></div>
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
                    	<? $news=$sqlmanager->GetRecords('select * from smg_news where isadopt=1 and main_cate_id=102 order by priority asc,pubdate desc',1,5)?>
                    <TR>
                      <TD><div class=title1>星尚互动<a target="_blank" href="xslist.php?id=102">更多</a></div></TD></TR>
                    	<TR>
                    		<? $newslist = $sqlmanager->GetRecords('select * from smg_xingshang_comment order by createtime desc');?>
                      <TD height=200 ><marquee height="200" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
											<? for($i=0; $i<count($newslist); $i++){?>
											<div style="width:100%; margin-bottom:10px; overflow:hidden; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->commenter;?></span>说：<? echo $newslist[$i]->content;?></div>
											<? }?>
				</marquee></TD></TR>
                      <TD>
                      	<div id=s_right>
													<div class="title"><span style="font-size:14px; color:red;">星尚祝语</span></div>
													<form name="commentform" method="post" action="/xingshang/createcomment.php">
													<div id=subject_comment>昵称：<input type="text" name="commenter" id="commenter"/><br /><div id=comment>内容：</div><textarea id="commentcontent" name="comment"></textarea></div>
													<button id=btn onclick="javascript:commentform.submit();">发　表</button>
													</form>
													</div>
                      	</TD></TR></TBODY></TABLE></TD></TR> 
            </TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    <TD vAlign=top  width=75% bgColor=#ffffcc>
      <TABLE border=0>
        <TBODY>
        <TR>
          <TD>
          	<? 
          		$id=$_REQUEST['id'];
          		$news=$sqlmanager->GetRecords('select * from smg_news where id='.$id.' order by priority asc,pubdate desc',1,1);
          		if($news[0]->newstype==3)//url链接类新闻
						  {
						  	redirecturl($news[0]->linkurl);
						  	CloseDB();
						  	exit;
						  }
						  //文件新闻
						  if($news[0]->newstype==2)
						  {
						  	//echo $news->newstpe;
						   	redirecturl($news[0]->filepath ."/" .$news[0]->filename);
						  	CloseDB();
						  	exit; 	
						  }
          	?>
            <TABLE border=0>
              <TBODY>
              <TR>
                <TD colSpan=2 class=index_title><? echo $news[0]->title;?></TD></TR>
              <TR>
                <TD width="80%">
                  <TABLE width="100%" border=0 align=left valign=center>
                    <TBODY>
                    <TR align=left>
                      <TD align=left>
                        	<div style="margin-top:5px;"><?php echo getfckcontent($news[0]->content);?></div></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
      </TBODY></TABLE></TD></TR></TBODY>
               </TABLE>
               </TD></TR></TBODY></TABLE>
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
