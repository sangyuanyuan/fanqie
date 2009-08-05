<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css2.css" type="text/css" />
<title>你我同话</title>
<?php use_jquery();?>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

</head>

<body >
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
  	  	<?php
			$db = get_db();
			$sql = 'select * from smg_comment where resource_type="nwth" order by created_at desc';
			$record = $db->paginate($sql,10);
			$count = count($record);
			for($i=0;$i<$count;$i++){
		?>
  			<div style="width:680px; height:20px; margin-top:10px; margin-left:110px; line-height:15px; color:#ffffff; text-align:right; border-bottom:1px dashed #ffffff; float:left; display:inline;"><? echo $record[$i]->created_at;?>　　<? echo  $record[$i]->nick_name;?></div>
  			<div style="width:680px; margin-top:10px; margin-left:110px; line-height:15px; border-bottom:2px solid #ffffff; color:#ffffff; float:left; display:inline;"><? echo  $record[$i]->comment;?></div>
  		<? }?>
		<div style="width:900px; height:30px; text-align:center; float:left; display:inline;"><?php paginate();?></div>
			<form action="/pub/pub.post.php" method="post">
  			<div style="width:680px; height:33px; padding-top:5px; padding-left:10px; margin-top:10px; margin-left:110px; font-size:12px; font-weight:bold; line-height:15px; color:#ffffff; background:url(pic/lyb_bg.jpg) repeat-x; float:left; display:inline;">给我们留言</div>
  			<div style="width:680px; padding-top:5px; padding-left:10px; margin-top:10px; margin-left:110px; font-size:12px; font-weight:bold; line-height:15px; color:#ffffff; text-align:center; float:left; display:inline;">
				<table>
					<tr>
						<td>发件人：</td>
						<td align="left"><input type="text" id="commenter" name="post[nick_name]" ></td>
					</tr>
  					<tr>
  						<td>内　容：</td>
						<td><TEXTAREA id="commentcontent" name="post[comment]" cols="30" rows="8" ></TEXTAREA></td></tr><tr><td><input type="hidden" id="titleid" name="titleid"></td>
						<input type="hidden" name="post[resource_type]" value="nwth">
						<input type="hidden" name="type" value="comment">
						<td align="right"><BUTTON id="submit" type="submit" >提交</BUTTON></td>
					</tr>
				</table>
			</div>
			</form>
  	</div>
    <div class="siteinfo">
    </div>

</div>

</body>
</html>

<script>
	$(function(){
		$("#submit").click(function(){
			if($("#commentcontent").val()==""){
				alert('评论内容不能为空！');
				return false;
			}
		});
	});
</script>