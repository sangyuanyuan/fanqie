<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css1.css" type="text/css" />
<title>新闻列表</title>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="Scripts/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<? 
$dept_cate_id=$_REQUEST['id'];
$db=get_db();
$strsql='SELECT * FROM smg_news s where is_dept_adopt=1 and dept_id=46 and dept_category_id='.$dept_cate_id." order by created_at desc";
$rows=$db->paginate($strsql,10);

?>
<body onload="MM_preloadImages('pic2/btn_1_1.png','pic2/btn_2_1.png','pic2/btn_3_1.png')">
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
    	<div class="sub_l">
        <div class="btn"><a href="newslist2.php?id=<?php echo dept_category_id_by_name('精彩回眸','上海文广数字移动传播有限公司','news');?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','pic2/btn_ly_on_03.jpg',1)"><img src="pic2/btn_ly_03.jpg" name="Image1" width="134" height="28" border="0" id="Image1" /></a></div>
        <div class="btn1"><a href="photolist.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','pic2/btn_ly_on_06.jpg',1)"><img src="pic2/btn_ly_06.jpg" name="Image2" width="134" height="28" border="0" id="Image2" /></a></div>
        <div class="btn1"><a href="videolist.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','pic2/btn_ly_on_08.jpg'',1)"><img src="pic2/btn_ly_08.jpg" name="Image3" width="134" height="28" border="0" id="Image3" /></a></div>
       </div>
        <div class="sub_right">
        <? for($i=0;$i<count($rows);$i++){?>
	  			<div style="width:500px; height:20px; line-height:20px; padding:5px; float:left; display:inline;"><a style="text-decoration:none;" href="news.php?id=<? echo $rows[$i]->id;?>"><? echo $rows[$i]->short_title;?></a></div>
		<? }?><br><br>
		<?php paginate(''); ?>
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
