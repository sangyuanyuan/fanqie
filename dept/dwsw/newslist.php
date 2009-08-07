<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>传媒集团内网-对外事务</title>
<?php
	js_include_once_tag('total');
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #003366;
}
A{
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
	color: #990000;
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
.STYLE3 {color: #FFFFFF}
.STYLE5 {font-size: 18px; font-weight: bold; color: #990000; }
-->
</style>
</head>
<script>
	total("对外事务列表","news");	
</script>
<body>
	<?php
		if(!isset($_REQUEST['id'])) die('非法新闻类型！');
		$listid = $_REQUEST['id'];
		$db = get_db();
		$sql = 'select * from smg_news where dept_category_id='.$listid.' and is_dept_adopt=1 order by dept_priority,created_at desc';
		echo $sql;
		$newslist = $db->query($sql);
	?>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="22" background="/images/dwsw/topbg.gif"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style=color:white;font-size:12px>
      <tr>
        <td width="402">&nbsp;</td>
        <td width="498" align="right"><?php echo strftime("%Y年").strftime("%m月").strftime("%d日");?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/images/dwsw/title.jpg" width="950" height="135" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<?php
		$records = show_content('smg_link','link','对外事务部','indextop');
		$count = count($records);
	?>
    <td width="683" height="34" align="center" background="/images/dwsw/menu.gif"><span class="STYLE3"><? for($i=0;$i<$count;$i++){?><a style="color:#ffffff; text-decoration:none;" href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a>     &nbsp;|　<? }?> </span></td>
    <td width="183" background="/images/dwsw/menu.gif">
	    <label>
	      <input type="text" name="search" id="search" />
	    </label>
    </td>
    <td width="84" background="/images/dwsw/menu.gif"><input type="image" name="imageField" id="imageField" OnClick="searchnews('search')" src="/images/dwsw/search.gif" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="/images/dwsw/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><img src="/images/dwsw/spacer.gif" width="1" height="1" />
      <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td style="font-size:14px;line-height:25px;">
          	<? for($i=0;$i< count($newslist);$i++){?>
          		<a title="<? echo $newslist[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <? if($newslist[$i]->file_name==""){?>href="content.php?id=<? echo $newslist[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $newslist[$i]->file_name;?>"<? }?>><? echo $newslist[$i]->title;?></a>　<span style="color:#999999;"><? echo substr($newslist[$i]->created_at,0,10);?></span><br>
          	<? }?>
          </td>
        </tr>
      </table>
     </td>
    <td width="8" valign="top"><img src="/images/dwsw/spacer.gif" width="1" height="1" /></td>
    <td width="265" valign="top" bgcolor="#fdda85">
    <table width="265" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<?php
			$records = show_content('smg_news','news','对外事务部','通知',7);
			$count = count($records);
		?>
        <td height="25" background="/images/dwsw/right_titlebg.gif" class="right_title">通知</td>
      </tr>
      <tr>
        <td>
          <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:240px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; margin-left:10px; padding-top:5px;  float:left; display:inline;"><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a></div>
	        <? }?>
        
          <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
      </tr>
    </table>
      <table width="265" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<?php
			$records = show_content('smg_news','news','对外事务部','出访经验交流',7);
			$count = count($records);
		?>
        <td height="25" background="/images/dwsw/right_titlebg.gif" class="right_title">出访经验交流</td>
      </tr>
      <tr>
        <td>
          <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:240px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; margin-left:10px; padding-top:5px;  float:left; display:inline;"><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a></div>
	        <? }?>
        
          <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
      </tr>
    </table>
      <table width="265" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<?php
			$records = show_content('smg_news','news','对外事务部','国际传媒资讯',7);
			$count = count($records);
		?>
        <td height="25" background="/images/dwsw/right_titlebg.gif" class="right_title">国际传媒机构</td>
      </tr>
      <tr>
        <td>
          <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:240px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; margin-left:10px; padding-top:5px;  float:left; display:inline;"><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a></div>
	        <? }?>
        
          <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
      </tr>
    </table>
     <table width="265" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <?php
				$records = show_content('smg_link','link','对外事务部','相关链接',7);
				$count = count($records);
			?>
        <td height="25" background="/images/dwsw/right_titlebg.gif" class="right_title">相关链接></td>
        </tr>
        <tr>
          <td>
              <?
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:240px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; margin-left:10px; padding-top:5px;  float:left; display:inline;"><a target="_blank"  style="color:#003366; text-decoration:none;" href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a></div>
	        	<? }?>
          
          <p align="right"><a href="newslist.php?id=<?php echo $records[0]->category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
        </tr>
      </table>
      <table width="265" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<?php
			$records = show_content('smg_news','news','对外事务部','关于我们',7);
			$count = count($records);
		?>
        <td height="25" background="/images/dwsw/right_titlebg.gif" class="right_title">关于我们</td>
      </tr>
      <tr>
        <td>
          <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:240px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; margin-left:10px; padding-top:5px;  float:left; display:inline;"><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a></div>
	        <? }?>
        
          <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="/images/dwsw/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td align="center" bgcolor="001c58"><span class="STYLE2">上海文广新闻传媒集团 版权所有</span></td>
  </tr>
</table>
</body>
</html>