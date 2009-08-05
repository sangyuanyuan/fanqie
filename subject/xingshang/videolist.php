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
<script language="javascript" src="shss.js"></script>
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
    <TD vAlign=center bgColor=#e9f2d9>
    	<? 
    		$id=$_REQUEST['id'];
    	$video=$sqlmanager->GetRecords('select * from smg_video where isadopt=1 and main_cate_id='.$id.' order by priority asc,createtime desc');
    		for($i=0;$i<count($video);$i++){
    	?>
    	<div style="width:115px; height:170px; margin-top:10px; padding-bottom:10px; margin-left:32px;  float:left; display:inline;"><a target="_blank" href="/video/video.php?id=<? echo $video[$i]->id;?>"><img border=0 width=115 height=115 src="<? echo $video[$i]->photourl;?>"><br><? echo $video[$i]->title;?></a></div>
    	<? }?>
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
