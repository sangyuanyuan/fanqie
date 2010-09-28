<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css1.css" type="text/css" />
<title>内容页面</title>
<script language="javascript" src="/js/smg.js"></script>
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
</head>

<body onload="MM_preloadImages('pic2/btn_1_1.png','pic2/btn_2_1.png','pic2/btn_3_1.png')">
<div  class="main">
<?		
$newsid = $_REQUEST['id'];
$db=get_db();
$strsql='update smg_news set click_count=click_count+1 where id='.$newsid;
$db->execute($strsql);
$strsql='SELECT * FROM smg_comment s where resource_id='.$newsid.' order by created_at desc';
$rows=$db->paginate($strsql,'5');

?>
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
    	<? 
      		$news=$db->query('select * from smg_news where id='.$newsid);
      	  if($news[0]->news_type==3)//url链接类新闻
		  {
		  	redirect($news[0]->target_url);
		  	CloseDB();
		  	exit;
		  }
				  //文件新闻
		  if($news[0]->news_type==2)
		  {
		   	redirect($news[0]->file_name);
		  	CloseDB();
		  	exit; 	
		  }
				  
      ?>
    	<div style="width:760px; margin-left:100px;">
    		<div style="width:760px; margin-top:10px; text-align:center; font-size:25px; font-weight:bold; float:left; display:inline;"><?php echo delhtml($news[0]->title); ?></div>
    		<div style="width:760px; margin-top:5px; text-align:center; float:left; display:inline;"><?php if($news[0]->publisher_id!=""&&$record[0]->categoryname=="我要报料"){?>作者：<?php echo $news[0]->publisher_id;} ?>　浏览次数：<span style="color:#C2130E"><?php echo $news[0]->click_count;?></span>　时间：<?php echo $news[0]->created_at;?></div>
        <div style="width:760px; margin-top:5px; font-size:13px; line-height:130%; float:left; display:inline;"><? echo get_fck_content($news[0]->content);?></div>
        	 <? for($i=0;$i<count($rows);$i++){?>
  			<div style="width:760px; height:20px; margin-top:10px; margin-left:50px; line-height:15px; color:#000000;  text-align:right; border-bottom:1px dashed #000000; float:left; display:inline;"><? echo $rows[$i]->created_at;?>　　<? echo $rows[$i]->nick_name;?></div>
  			<div style="width:760px; margin-top:10px; margin-left:100px; line-height:15px; border-bottom:2px solid #000000; color:#000000; float:left; display:inline;"><? echo $rows[$i]->comment;?></div>
  		<? }?>
  			
  		</div>
  		<div style="width:960px; height:33px; padding-top:5px; padding-left:10px; margin-top:10px;  font-size:12px; font-weight:bold; line-height:15px; color:#ffffff; background:url(pic/lyb_bg.jpg) repeat-x; float:left; display:inline;">发表评论</div>
  			<form name="commentform" method="post" action="/pub/pub.post.php">
	  			<div style="width:920px; margin-left:40px; padding-top:5px; padding-left:10px; margin-top:10px;  font-size:12px; font-weight:bold; line-height:15px; float:left; display:inline;">
	  				<table>
	  					<tr>	
	  						<td>用　户：</td>
	  						<td align="left"><input type="text" id="commenter" name="post[nick_name]" ></td>
	  					</tr>
	  					<tr>
	  						<td>内　容：</td>
	  						<td><TEXTAREA name="post[comment]" cols="30" rows="8" id="commentcontent"></TEXTAREA></td>
	  					</tr>
	  					<tr>
	  						<td><input type="hidden" name="post[resource_id]" value="<?php echo $newsid; ?>">
							<input type="hidden" id="resource_type" name="post[resource_type]" value="news">
							<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
							<input type="hidden" name="type" value="comment">
							</td>
	  						<td align="right"><BUTTON type="submit">提交</BUTTON></td>
	  					</tr>
	  				</table>
	  			</div>
  			</form>
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

