<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="css1.css" type="text/css" />
<title>�����б�</title>
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
include('../inc/db.inc.php');
ConnectDB();
$dept_cate_id=$_REQUEST['id'];
$page=$_REQUEST['page'];
$strsql='SELECT * FROM smg_news s where isdeptadopt=1 and dept_id=46 and dept_cate_id='.$dept_cate_id;
$record=mysql_query($strsql) or die ("select error1");
$record_num=mysql_num_rows($record);

	
	$page_size=30;
	$rs_num=$record_num;
	if( $rs_num>0 ){
   		if( $rs_num < $page_size ){ $page_count = 1; }               
   		if( $rs_num % $page_size ){                                  
       		$page_count = (int)($rs_num / $page_size) + 1;           
   		}else{
       		$page_count = $rs_num / $page_size;                      
  		}
	}
	else{
   		$page_count = 0;
	}

	if ($page=="")  {$page=1;}
	if ($page>$page_count)  {$page=$page_count;}
	if ($page==0)  {$page=1;}
	if ($page<0)  {$page=1;}
$strsql='SELECT * FROM smg_news s where isdeptadopt=1 and dept_id=46 and dept_cate_id='.$dept_cate_id.' order by pubdate desc limit '.($page-1)*$page_size.','.($page_size+($page-1)*$page_size);
$record=mysql_query($strsql) or die ("select error2");
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
        <div class="btn"><a href="newslist1.php?id=145" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','pic2/btn_jx_on_03.jpg',1)"><img src="pic2/btn_jx_03.jpg" name="Image1" width="134" height="28" border="0" id="Image1" /></a></div>
        <div class="btn1"><a href="newslist1.php?id=146" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','pic2/btn_jx_on_06.jpg',1)"><img src="pic2/btn_jx_06.jpg" name="Image2" width="134" height="28" border="0" id="Image2" /></a></div>
        <div class="btn1"><a href="newslist1.php?id=147" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','pic2/btn_jx_on_08.jpg'',1)"><img src="pic2/btn_jx_08.jpg" name="Image3" width="134" height="28" border="0" id="Image3" /></a></div>
        <div class="btn1"><a href="newslist1.php?id=148" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','pic2/btn_jx_on_10.jpg'',1)"><img src="pic2/btn_jx_10.jpg" name="Image4" width="134" height="28" border="0" id="Image4" /></a></div>
       </div>
        <div class="sub_right">
        <? while($rows=mysql_fetch_array($record)){?>
	  			<div style="width:500px; height:20px; line-height:20px; padding:5px; float:left; display:inline;"><a style="text-decoration:none;" href="news.php?id=<? echo $rows['id'];?>"><? echo $rows['shorttitle'];?></a></div>
			  	<? }?><br><br>
			  	<a href="?page=1">��ҳ</a> 
						<a href="?id=<? echo $dept_cate_id?>&page=<? echo $page-1?>">��һҳ</a> 
						<a href="?id=<? echo $dept_cate_id?>&page=<? echo $page+1?>">��һҳ</a> 
						<a href="?id=<? echo $dept_cate_id?>&page=<? echo $page_count?>">ĩҳ</a> 
						��<? echo $rs_num?>����¼ 
						��<? echo $page?>ҳ/��<? echo $page_count?>ҳ
						<select id=newyearpage onChange="newyearpage()">
							<? for($i=1;$i<=$page_count;$i++){?>
							<option <? if($page==$i){?>selected="selected"<? }?> value="<? echo $i;?>">��<? echo $i;?>ҳ</option>
							<? }?>
						</select>
						<input type="hidden" id=page value=<? echo $page;?>>
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