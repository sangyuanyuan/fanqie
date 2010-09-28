<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css2.css" type="text/css" />
<link rel="stylesheet" href="css.css" type="text/css" />
<title>新闻列表</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="szyd.js" type="text/javascript"></script>
</head>

<body >
<? 
$dept_cate_id=$_REQUEST['id'];
$db=get_db();
$strsql='SELECT * FROM smg_news s where is_dept_adopt=1 and dept_id=46 and dept_category_id='.$dept_cate_id." order by created_at desc";
$rows=$db->query($strsql,10);
?>
<div  class="main">
	<div class="top">
	 
    </div>
  <div class="nav">
    <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','971','height','64','src','nav','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','nav' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="971" height="64">
        <param name="movie" value="nav.swf" />
        <param name="quality" value="high" />
        <embed src="nav.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="971" height="64"></embed>
      </object>
</noscript>
  </div>
  <div class="submain">
  	<div style="width:220px; float:left; display:inline;">
  	<div style="width:206px; height:48px; margin-top:16px; margin-left:11px; background-image:url(pic/search.png); padding-left:10px; float:left; display:inline;">
      <input name="search" id="search" type="text" style="margin-top:10px;"> <img id="dept_search"  style="margin-top:2px; display:inline;" src="pic/searchbutton.gif">
   	</div>
	
	</div>
   	<div style="width:490px; margin-top:10px; margin-left:10px; float:left; display:inline;">
	  	<? for($i=0;$i<count($rows);$i++){?>
	  			<div style="width:500px; height:20px; line-height:20px; padding:5px; float:left; display:inline;"><a style="text-decoration:none;" href="news.php?id=<? echo $rows[$i]->id;?>"><? echo $rows[$i]->short_title;?></a></div>
	  	<? }?><br><br>
	  	<?php paginate('');?>
  	</div>
  	<div style="width:210px; height:114px; margin-top:16px; float:right; display:inline;">
       <div  class="share_top">特快专递</div>
       <div  class="r_border">
       	<form id="addform" name="addform" action="szyd.post.php" method="post">
		      <table width="212" border="0" cellspacing="0" cellpadding="0">
		        <tr>
		          <td align="center">发件人：</td><td><input style="width:130px; height:12px;" type="text" id="from" name="from"></td>
		        </tr>
		        <tr>
		          <td align="center">标　题：</td><td><input style="width:130px; height:12px;" type="text" id="subject" name="subject"></td>
		        </tr>
		        <tr>
		          <td align="center">内　容：</td><td><textarea style="width:130px;"  id="message" name="message" rows="2"></textarea></td>
		        </tr>
		        <input type="hidden" id="target_url" name="target_url" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
		        <tr>
		          <td></td><td><input type="button" onclick="checkform()" value="发送"></td>
		        </tr>	 
		      </table>
		     </form>
      </div>
  	 </div>
  </div>
  <div class="siteinfo">
  </div>

</div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>
<script>
	$(function(){
		$("#dept_search").click(function(){
			window.location.href='/search/?key='+encodeURI($("#search").val())+'&search_type=smg_news';
		})
	});
</script>