<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>传媒集团内网-fwb</title>
<?php
	js_include_once_tag('total');
	use_jquery();
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFF;
	background-image: url(images/bg.jpg);
	background-repeat: repeat-x;
}
A
{
	text-decoration:none;
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
	margin-left: 30px;
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
<script>
	total("法务部","news");	
</script>
<body>	
<table width="780" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td bgcolor="#004e90">&nbsp;</td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/title.jpg" width="780" height="120" /></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<?php
		$records = show_content('smg_link','link','法务部','index_top');
		$count = count($records);
	?>
    <td height="33" align="center" background="images/menu.gif" style=color:white><? for($i=0;$i<$count;$i++){?><a target="_blank" style="text-decoration:none; color:white;" href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<? }?></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td width="213" valign="top" bgcolor="#eeede9"><table width="211" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/left_title01.gif" width="211" height="32" /></td>
      </tr>
    </table>
      <table  width="211" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	 <?php
					$records = show_content('smg_news','news','法务部','以案论法','6');
					$count = count($records);
             ?>
          <td valign="top"  bgcolor="#2e81c3" style=font-size:12px;line-height:140%;color:white><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:white;" href="/fwb/content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title; ?></a><br><? }?></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/left_titlelink.gif" width="211" height="25" /></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/left_title02.gif" alt="" width="211" height="35" /></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','法律常识','6');
					$count = count($records);
             ?>
          <td bgcolor="#12aa71"  style=font-size:12px;line-height:140%;color:white><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:white;" href="/fwb/content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?></a><br><? }?></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/left_titlelink2.gif" width="211" height="49" /></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/left_title03.gif" width="211" height="30" /></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','常用表格下载','4');
					$count = count($records);
             ?>
          <td style=font-size:12px;line-height:140%><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:#003366;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title; ?></a><br><? }?></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/left_title04.gif" width="211" height="30" /></td>
        </tr>
      </table>
      <table width="211" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
				$records = show_content('smg_link','link','法务部','相关链接',4);
				$count = count($records);
			?>
          <td  style=font-size:12px;line-height:140%><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:#003366;" href="<? echo $records[$i]->link;?>">&middot;<? echo $records[$i]->name; ?></a><br><? }?></td>
        </tr>
      </table>
<p>&nbsp;</p></td>
    <td width="345" valign="top" bgcolor="#FFFFFF"><table width="340" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        	<?php
			  		$records = show_content('smg_images','picture','法务部','首页图片',4);
					$count = count($records);
              		for ($i=0;$i<$count;$i++)
					{
						$picsurl[]=$records[$i]->src;
						$picslink[]=$records[$i]->url;
					}
              ?>
                <td>
                	<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
						<!-- 图片播放器开始 -->
						<div id="focus_01"></div> 
						<script type="text/javascript"> 
						var pic_width=320; //图片宽度
						var pic_height=224; //图片高度
						var pics="<?php echo implode(',',$picsurl);?>";
						var mylinks="<?php echo implode(',',$picslink);?>";
		 
						var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "320", "224", "6","#FFFFFF");
						picflash.addParam('wmode','opaque');
						picflash.addVariable("picurl",pics);
						picflash.addVariable("piclink",mylinks);				
						picflash.addVariable("pictime","5");
						picflash.addVariable("borderwidth","320");
						picflash.addVariable("borderheight","224");
						picflash.addVariable("borderw","false");
						picflash.addVariable("buttondisplay","true");
						picflash.addVariable("textheight","0");				
						picflash.addVariable("pic_width",pic_width);
						picflash.addVariable("pic_height",pic_height);
						
						picflash.write("focus_01");				
					</script></td>
       </tr>
    <table width="335" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="images/mtitle.gif" width="333" height="31" vspace="3" /></td>
        </tr>
    </table>
      <table width="335" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','法务动态','6');
					$count = count($records);
             ?>
          <td style=font-size:12px;line-height:140%>
          	<? for($i=0;$i< $count;$i++){?><a target="_blank" style="color:#003366;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?></a><br /><? }?>
          </td>
        </tr>
        <tr>
          <td align="right" style=font-size:12px;line-height:140%><a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('法务动态','法务部','news');?>"><img border=0 src="images/more.gif" width="59" height="24" /></a></td>
        </tr>
    </table>
      <table width="335" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="images/mtitle2.gif" alt="" width="333" height="31" vspace="3" /></td>
        </tr>
    </table>
      <table width="335" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','规章制度','6');
					$count = count($records);
             ?>
          <td style="font-size:12px;line-height:140%"><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:#003366;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?></a><br /><? }?></td>
        </tr>
        <tr>
          <td align="right" style="font-size:12px;line-height:140%"><a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('规章制度','法务部','news');?>"><img border=0 src="images/more.gif" width="59" height="24" /></a></td>
        </tr>
    </table>
      <table width="335" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="images/mtitle3.gif" width="333" height="30" vspace="3" /></td>
        </tr>
      </table>
      <table width="335" border="0" align="center" cellpadding="5" cellspacing="0">
       <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','合同文本下载','6');
					$count = count($records);
             ?>
          <td style="font-size:12px;line-height:140%"><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:#003366;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?></a><br /><? }?></td>
        </tr>
        <tr>
          <td align="right" style="font-size:12px;line-height:140%"><a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('合同文本下载','法务部','news');?>"><img border=0 src="images/more.gif" width="59" height="24" /></a></td>
        </tr>
      </table>
      <table width="335" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="images/mtitle4.gif" alt="" width="333" height="31" vspace="3" /></td>
        </tr>
      </table>
      <table width="335" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','违规通报','6');
					$count = count($records);
             ?>
          <td style="font-size:12px;line-height:140%"><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:#003366;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?></a><br /><? }?></td>
        </tr>
        <tr>
          <td align="right" style="font-size:12px;line-height:140%"><a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('违规通报','法务部','news');?>"><img border=0 src="images/more.gif" width="59" height="24" /></a></td>
        </tr>
    </table></td>
    <td width="216" valign="top" bgcolor="#427fb8"><table width="216" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/search.gif" width="216" height="43" /></td>
      </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td width="112" bgcolor="#dfdfdf"><label>
              <input name="textfield" type="text" id="search" name="search" size="16" />
          </label></td>
          <td width="64" bgcolor="#dfdfdf"><input type="submit" name="button" id="dept_search" value="搜索" /></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/right_title.gif" width="216" height="31" /></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','关于我们','4');
					$count = count($records);
             ?>
          <td bgcolor="#217fe1"><p style="font-size:12px;line-height:140%;color:white"><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:white; text-decoration:none;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?><br /><? }?></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/right_title2.gif" width="216" height="31" /></td>
        </tr>
      </table>
      <table width="216" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
				$db = get_db();
				$sql = 'select * from smg_comment where resource_type="fwb" order by created_at desc limit 4';
				$comments = $db->query($sql);
			?>
          <td bgcolor="#217fe1"><p style="font-size:12px;line-height:140%;color:white"><? for($i=0;$i<count($comments);$i++){ ?>
          	&middot;<? echo $comments[$i]->title;?><br /><? }?></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><a target="_blank" href="mailto:fawubu@smg.sh.cn"><img border=0 src="images/mail.gif" width="216" height="75" /></a></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/right_title3.gif" width="216" height="45" /></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="15">
        <tr>
          <td><?php 
		  		$db = get_db();
				$sql = 'select sum(a.click_count) as click_count, b.name from smg_news a left join smg_category_dept b on a.dept_category_id=b.id where a.dept_id=1 and a.dept_category_id >0  group by a.dept_category_id order by click_count desc';
				$record = $db->query($sql);
				$count = count($record);
		  		for($i=0;$i<$count;$i++){?>
			  <div style="width:180px; float:left; display:inlne">
				  <div style="color:white; float:left; display:inline;">&middot;<?php echo $record[$i]->name;?></div>
				  <div style="color:white; float:right; display:inline;"><?php echo $record[$i]->click_count;?></div>
			  </div><? }?>
		  </td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="10" cellspacing="0" background="images/bottom.gif">
  <tr>
    <td align="center" bgcolor="#004e90"><span class="STYLE2">上海文广新闻传媒集团 版权所有</span></td>
  </tr>
</table>
</body>
</html>


<script>
	$(function(){
		
		$("#dept_search").click(function(){
			window.location.href='/search/?key='+encodeURI($("#search").val())+'&search_type=smg_news';
		})
	});
</script>