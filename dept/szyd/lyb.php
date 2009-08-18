<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css2.css" type="text/css" />
<title>新闻列表</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

</head>

<body >
<? 
$dept_cate_id=$_REQUEST['id'];
$db=get_db();
$strsql='SELECT * FROM smg_comment where resource_type="lyb" order by created_at desc';
$rows=$db->paginate($strsql);

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
  <div class="submain" style="background:#029EC6;">
  	<div class="sub_l">
    		<div class="btn"><a href="lyb.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','pic2/btn_ys_on_03.jpg',1)"><img src="pic2/btn_ys_03.jpg" name="Image1" width="134" height="28" border="0" id="Image1" /></a></div>
        <div class="btn1"><a href="mailto:zhgl@51dab.cn" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','pic2/btn_ys_on_06.jpg',1)"><img src="pic2/btn_ys_06.jpg" name="Image2" width="134" height="28" border="0" id="Image2" /></a></div>
    </div>
    <div class="sub_right">
  	  <? for($i=0;$i<count($rows);$i++){?>
  			<div style="width:680px; height:20px; margin-top:10px; margin-left:50px; line-height:15px; color:#ffffff; text-align:right; border-bottom:1px dashed #ffffff; float:left; display:inline;"><? echo $rows[$i]->created_at;?>　　<? echo $rows[$i]->nick_name;?></div>
  			<div style="width:680px; margin-top:10px; margin-left:50px; line-height:15px; border-bottom:2px solid #ffffff; color:#ffffff; float:left; display:inline;"><? echo $rows[$i]->content;?></div>
  		<? }?>
  			<div style="width:680px; height:33px; padding-top:5px; padding-left:10px; margin-top:10px; margin-left:50px; font-size:12px; font-weight:bold; line-height:15px; color:#ffffff; background:url(pic/lyb_bg.jpg) repeat-x; float:left; display:inline;">给我们留言</div>
  			<div style="width:680px; margin-left:40px; padding-top:5px; padding-left:10px; margin-top:10px;  font-size:12px; font-weight:bold; line-height:15px; color:#ffffff; float:left; display:inline;"><table><tr><td>发件人：</td><td align="left"><input type="text" id="writer" name="post[nick_name]" ></td></tr>
  			<tr><td>内　容：</td>
			<td><TEXTAREA name="post[comment]" cols="30" rows="8" id="lettercontent"></TEXTAREA></td></tr>
			<tr><td><input type="hidden" id="resource_type" name="post[resource_type]" value="lyb">
			<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
			<input type="hidden" name="type" value="comment">
			</td>
			<td align="right">
				<BUTTON type="submit">提交</BUTTON></td></tr></table></div>
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