<?php
	 require_once('../../frame.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta http-equiv=Content-Language content=zh-CN>
<title>传媒集团内网-SITV</title>
<script language="javascript" src="sitv.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFF;
	background-image: url();
}
.border_orange {
	border: 1px solid #fd7521;
}
.left_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.mtitle {
	font-size: 12px;
	font-weight: bold;
	color: #FFF;
}
body,td,th {
	font-size: 12px;
	color: #003366;
}
A{
	color:#003366;
	text-decoration:none;
}
A:visited{
	color:#003366;
	text-decoration:none;
}
ul {
	list-style-position: inside;
	list-style-type: square;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 10px;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 10px;
	font-size: 12px;
	line-height: 140%;
}
.right_title {
	padding-left: 30px;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.STYLE2 {color: #CCCCCC}
.STYLE3 {
	color: #333
}
.date {
	color: #FFF;
	font-family: "Arial Black", Gadget, sans-serif;
}
-->
</style>
</head>

<body>
<table  width="950"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="22" background="images/topbg.gif"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style=color:white;font-size:12px>
      <tr>
        <td width="402">&nbsp;</td>
        <td width="498" align="right" class="date"><? echo strftime("%Y年").strftime("%m月").strftime("%d日");?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/021209SITV.jpg" width="950" height="137" /></td>
  </tr>
</table>
<table style="border:1px solid #bbbbbb;" width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<?php
		$records = show_content('smg_link','link','文广互动','头部链接');
		$count = count($records);
	?>
    <td height="34" align="center" background="images/menu.gif">
    	<span class="STYLE3">
    		<? for($i=0;$i<$count;$i++){?>
    			<a  href="<? echo $records[$i]->link;?>">
    				<? echo $records[$i]->name;?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    		<? }?>
    	</span>
    </td>
  </tr>
</table>
<table width="950"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="950"  align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td style="border:1px solid #bbbbbb;" width="257" valign="top" bgcolor="#EBEBEB">
    	<table width="250" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td align="center"><table width="250" border="1" cellpadding="5">
          </table></td>
        </tr>
      </table>
      <table width="250" cellspacing="0" cellpadding="0">
        <tr>
        	<?php
		  		$records = show_content('smg_video','video','文广互动','index_video','1');
				$count = count($records);
		 	?>
          <td><span style="margin-left:5px; float:left; display:inline;"><? show_video_player(250,190,$records[0]->photo_url,$records[0]->video_url);?></span></td>
        </tr>
        <tr><td height=10 ></td></tr>
      </table>
      <table width="250"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','公司简介','1');
             ?>
          <td height="26" background="images/blue_titlebg.gif" class="left_title">公司简介</td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;"><ul>
            <li><a href="content.php?id=<? echo $records[0]->id;?>"><? echo $records[0]->description;?></a></li>    
          </ul>
            <p align="right"></p>
          </td>
        </tr>
      </table>
      <table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','关于我们','6');
					$count = count($records);
             ?>
          <td height="26" background="images/blue_titlebg.gif" class="left_title">关于我们</td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;">
          	<ul>
          <? for($i=0;$i<$count;$i++){?>
            <li><a href="content.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title;?></a></li>
            <? }?>
          </ul>
          </td>
        </tr>
    </table>
    <table width="250" border="0" align="center" cellspacing="0" cellpadding="0">
        <tr>
        	 <?php
				$records = show_content('smg_link','link','文广互动','我们的链接','8');
				$count = count($records);
            ?>
          <td height="25" background="images/right_titlebg.gif" class="right_title">我们的链接</td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;"><ul>
          	<? for($i=0;$i<$count;$i++){?>
              <li><a href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a></li>
              <? }?>
          </ul>
          <p>&nbsp;</p></td>
        </tr>
      </table>
      <table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="26" background="images/blue_titlebg.gif" class="left_title">访问统计</td>
        </tr>
        <tr>
          <td>
          	<? //$report=getcategoryreport();?>
          	<ul>
          		<? //for($i=0;$i< $report->itemcount;$i++){?>
            <div><div style="float:left; display:inline;"><? //echo $report->items[$i]->name;?></div><div style="float:right; display:inline;"><? //echo $report->items[$i]->clickcount;?></div></div><br>
            <? //}?>
          </ul><br>
          <span style="margin-left:20px;"><input type="text" name="search" id="search" />　<button style="width:63px; height:23px; border:none; background:url('images/search.gif')" OnClick="searchnews('search')"></button></span>
          <p align="right">&nbsp;</p></td>
        </tr>
    </table></td>
    <td width="5" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td  width="460" valign="top">
      <table width="460" style="border:1px solid #bbbbbb;"  border="0" cellspacing="1" cellpadding="3">
	  	<?php
	  		$records = show_content('smg_images','picture','文广互动','首页图片','1');
	 	?>
        	<tr><td colspan="2"><img width="450" src="<? echo $records[0]->src;?>"></tr>
      
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','最新动态','7');
					$count = count($records);
             ?>
          <td height="25" colspan="2" bgcolor="#FF6600" class="mtitle">最新动态</td>
        </tr>
        
        <tr>	
          <td colspan="2" >
          	<ul>
            <? for($i=0;$i<$count;$i++){?>
            <li><a style="width:230px; height:14px; overflow:hidden;" href="content.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title;?></a></li>
            <? }?>
            </ul>
          <p>&nbsp;</p></td>
        </tr>
    </table>
      <table style="border:1px solid #bbbbbb;" width="460" border="0" cellspacing="1" cellpadding="3">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','我们的节目','10');
					$count = count($records);
             ?>
          <td height="25" colspan="2" bgcolor="#FF6600" class="mtitle"><? echo $newslist1->categoryname;?></td>
        </tr>
        <tr>
          <td width="200">
          	<?php 
          	for($i=0;$i<($count<4?$count:4);$i++){
				//获得首页图片切换的相关信息
					$picsurl1[]=$records[$i]->photo_src;
					$picslink1[]='content.php?id='.$newslist1->items[$i]->id;
					$picstext1[]=$records[$i]->title;
				}
				?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<!-- 图片播放器开始 -->
				<div id="focus_02"></div> 
				<script type="text/javascript"> 
				var pic_width1=200; //图片宽度
				var pic_height1=150; //图片高度
				var pics1="<?php echo implode(',',$picsurl1);?>";
				var mylinks1="<?php echo implode(',',$picslink1);?>";
				var texts1="<?php echo implode(',',$picstext1);?>";
				
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "200", "150", "6","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics1);
				picflash.addVariable("piclink",mylinks1);
				picflash.addVariable("pictext",texts1);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","200");
				picflash.addVariable("borderheight","150");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","0");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				
				picflash.write("focus_02");				
				</script>
				</td>
          <td width="260">
          	<ul>
          		<? for($i=0;$i<$count;$i++){?>
            <li><a style="width:260px; height:14px; overflow:hidden;" href="content.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title;?></a></li>
            <? }?>
            </ul>
          <p>&nbsp;</p></td>
        </tr>
    </table>
      <table style="border:1px solid #bbbbbb;" width="460" border="0" cellspacing="1" cellpadding="3">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','我们的生活','10');
					$count = count($records);
             ?>
          <td height="25" colspan="2" bgcolor="#FF6600" class="mtitle">我们的生活</td>
        </tr>
        <tr>
          <td width="260"><ul>
            <? for($i=0;$i<$count;$i++){?>
            <li><div style="width:195px; height:14px; overflow:hidden;"><a style="width:195px; height:14px; overflow:hidden;" href="content.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title;?></a></div></li>
            <? }?>
            </ul>
          <p>&nbsp;</p></td>
          <td width="200">
          	<?php 
          	for($i=0;$i<($count<4?$count:4);$i++){
				//获得首页图片切换的相关信息
					$picsurl2[]=$records[$i]->photo_src;
					$picslink2[]='content.php?id='.$newslist2->items[$i]->id;
					$picstext2[]=$records[$i]->title;
				}
				?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<!-- 图片播放器开始 -->
				<div id="focus_03"></div> 
				<script type="text/javascript"> 
					var pic_width2=200; //图片宽度
					var pic_height2=150; //图片高度
					var pics2="<?php echo implode(',',$picsurl2);?>";
					var mylinks2="<?php echo implode(',',$picslink2);?>";
					var texts2="<?php echo implode(',',$picstext2);?>";
	 
					var picflash = new sohuFlash("/flash/focus.swf", "focus_03", "200", "150", "6","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics2);
					picflash.addVariable("piclink",mylinks2);
					picflash.addVariable("pictext",texts2);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth","200");
					picflash.addVariable("borderheight","150");
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","0");				
					picflash.addVariable("pic_width",pic_width2);
					picflash.addVariable("pic_height",pic_height2);
					
					picflash.write("focus_03");				
				</script></td>
        </tr>
    </table>
      <table width="460" border="0" cellspacing="1" cellpadding="3">
        <tr>
        	<?php
		  		$records = show_content('smg_images','picture','文广互动','我们的伙伴','6');
				$count = count($records);
		 	?>
          <td height="25" bgcolor="#FF6600" class="mtitle">我们的伙伴></td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;" align="center">
						<div style="width:450px; display:inline;">
          	<? for($i=0;$i<($count<3?$count:3);$i++){
          		?>        		
          		<a  target="_blank" href="/show/show.php?id=<?php echo $records[$i]->id; ?>"><img border="0" src="<? echo $records[$i]->src;?>" width="120" height="70" /></a>
            <? }?></div>
            <div>
            	<? if($count>3){for($i=3;$i<$count;$i++){?>
          		<a  target="_blank" href="/show/show.php?id=<?php echo $records[$i]->id; ?>"><img border="0" src="<? echo $records[$i]->src;?>" width="120" height="70" /></a>
            <? }}?></div></div>
          	</td>
        </tr>
    </table></td>
    <td width="5" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td style="border:1px solid #bbbbbb;" align="center" width="205" valign="top" bgcolor="#dcdcdc">
    	<table width="205" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<?php
	  		$records = show_content('smg_images','picture','文广互动','开心一日','4');
			$count = count($records);
	 	?>
        <td height="25" background="images/right_titlebg.gif" class="right_title"><span style="margin-top:7px; float:left; display:inline;">开心一日</span></td>
      </tr>
      <tr align="left">
        <td style="border:1px solid #bbbbbb;">
				    <? for($i=0;$i<$count; $i++){?>	
				    	<a target="_blank" style="text-decoration:none;" href="/show/show.php?id=<?php echo $records[$i]->id;?>"><img width="180" style="margin-top:5px; margin-left:12px;" border="0" src="<? echo $records[$i]->src;?>" /></a>
				    <? }?></td>
      </tr>
      <tr><td height="5"></td></tr>
    </table>
      <table width="205" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','文广互动','我们的沙龙','6');
					$count = count($records);
             ?>
          <td align="left" height="25" background="images/right_titlebg.gif" class="right_title"><? echo $newslist4->categoryname;?></td>
        </tr>
        <tr>
          <td style="border:1px solid #bbbbbb;"><?php 
          	for($i=0;$i<$count;$i++){
				//获得首页图片切换的相关信息
					$picsurl4[]=$records[$i]->photo_src;
					$picslink4[]='content.php?id='.$records[$i]->id;
					$picstext4[]=$records[$i]->title;
				}
				?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<!-- 图片播放器开始 -->
				<div style="height:205px; margin-top:5px;" id="focus_04"></div> 
				<script type="text/javascript"> 
				var pic_width4=190; //图片宽度
				var pic_height4=200; //图片高度
				var pics4="<?php echo implode(',',$picsurl4);?>";
				var mylinks4="<?php echo implode(',',$picslink4);?>";
				var texts4="<?php echo implode(',',$picstext4);?>";
 
				var picflash = new sohuFlash("/flash/focus.swf", "focus_04", "190", "200", "6","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics4);
				picflash.addVariable("piclink",mylinks4);
				picflash.addVariable("pictext",texts4);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","190");
				picflash.addVariable("borderheight","200");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","24");				
				picflash.addVariable("pic_width",pic_width4);
				picflash.addVariable("pic_height",pic_height4);
				
				picflash.write("focus_04");				
				</script></td>
        </tr>
        <tr align="left">
        	<td><ul>
          		<?php for($i=0;$i<$count;$i++){?>
            <li><a style="width:260px; height:14px; overflow:hidden;" href="content.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></li>
            <? }?>
            </ul></td>
        </tr>
      </table>
      <form id="addform" name="addform" action="sitv.post.php" method="post">
      <table width="205" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" colspan="2" height="25" background="images/right_titlebg.gif" class="right_title">互动信箱</td>
        </tr>
        <tr><td height="15"></td></tr>
        <tr>
          <td align="center">发件人：</td><td><input style="width:130px;" type="text" id="from" name="from"></td>
        </tr>
        <tr>
          <td align="center">标　题：</td><td><input style="width:130px;" type="text" id="subject" name="subject"></td>
        </tr>
        <tr>
          <td align="center">内　容：</td><td><textarea style="width:130px;"  id="message" name="message" rows="10"></textarea></td>
        </tr>
        <tr>
          <td></td><td><input type="button" onclick="checkform()" value="发送"></td>
        </tr>	 
      </table></form></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="10" cellspacing="0" background="images/bottom.gif">
  <tr>
    <td align="center" bgcolor="001c58"><span class="STYLE2">上海文广新闻传媒集团 版权所有</span></td>
  </tr>
</table>
<script language="JavaScript" type="text/javascript" src="http://172.27.203.80:8080/pphlogger.js"></script> 
<noscript><img alt="" src="http://172.27.203.80:8080/pphlogger/pphlogger.php?id=yang&st=img"></noscript>
</body>
</html>
