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
	use_jquery();
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
	margin-left:5px;
	font-size:14px;	
}
.border_orange {
	border: 1px solid #fd7521;
}
.left_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;
}
.mtitle {
	font-size: 16px;
	font-weight: bold;
	color: #990000;
}
body,td,th {
	line-height:20px;
	font-size: 12px;
	color: #003366;
}
ul {
	list-style-position: inside;
	list-style-type: square;
	margin-right: 5px;
	margin-left: 5px;
	font-size: 12px;
	line-height: 140%;
}
li
{
	margin-top:15px;
	line-height:15px;
}
.right_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;
}
.STYLE2 {color: #CCCCCC}
.STYLE3 {color: #FFFFFF}
-->
</style>
</head>
<script>
	total("对外事务","news");	
</script>
<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="22" background="/images/dwsw/topbg.gif"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style=color:white;font-size:12px>
      <tr>
        <td width="402">&nbsp;</td>
        <td width="498" align="right"><? echo strftime("%Y年").strftime("%m月").strftime("%d日");?></td>
      </tr>
    </table></td>
  </tr><p align="right"></p>
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
    <td width="84" background="/images/dwsw/menu.gif"><input type="image" name="imageField" id="dept_search" src="/images/dwsw/search.gif" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="5"><img src="/images/dwsw/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="257" valign="top" bgcolor="f4e6d7"><table width="255" border="0" align="center" cellpadding="0" cellspacing="0" class=border_orange>
      <tr>
        <td><table width="253" border="0" cellspacing="0" cellpadding="0">
          <tr>
          	<?php
				$records = show_content('smg_news','news','对外事务部','因公出国规定');
				$count = count($records);
			?>
            <td height="26" background="/images/dwsw/orange_titlebg.gif" class="left_title">因公出国规定</td>
          </tr>
          <tr>
            <td>
            	
            		<?php
            			for($i=0;$i<$count;$i++){?>
		            		<div style=" width:240px; line-height:20px; color:#003366; text-decoration:none; margin-left:10px; margin-top:5px; padding-top:5px;  float:left; display:inline;">
								<a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <?php if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            				<?php }else {?>href="<?php echo $records[$i]->file_name;?>"<? }?> >
								<? echo $records[$i]->title;?>
								</a>
							</div>
		            <? }?>
               
                  <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
            </td>
          </tr>

        </table></td>
      </tr>
    </table>
      <table width="255" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5"><img src="/images/dwsw/spacer.gif" width="1" height="1" /></td>
        </tr>
      </table>
      <table width="255" border="0" align="center" cellpadding="0" cellspacing="0" class="border_orange">
        <tr>
          <td><table width="253" border="0" cellspacing="0" cellpadding="0">
              <tr>
              	<?php
					$records = show_content('smg_news','news','对外事务部','海外出访指南',7);
					$count = count($records);
				?>
                <td height="26" background="/images/dwsw/orange_titlebg.gif" class="left_title">海外出访指南</td>
              </tr>
              <tr>
                <td>
                
                  <? 
                  
                  for($i=0;$i<$count;$i++){?>
		            	<div style=" width:240px; line-height:20px; color:#003366; text-decoration:none; margin-top:5px; margin-left:10px; padding-top:5px;  float:left; display:inline;"><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <?php if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            				<?php }else {?>href="<?php echo $records[$i]->file_name;?>"<? }?> >
								<? echo $records[$i]->title;?>
								</a></div>
		            	<? }?>
                
                  <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <table width="255" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5"><img src="/images/dwsw/spacer.gif" alt="" width="1" height="1" /></td>
        </tr>
      </table>
      <table width="255" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','常用表格下载',7);
				$count = count($records);
			?>
                <td height="26" background="/images/dwsw/blue_titlebg.gif" class="left_title">常用表格下载</td>
        </tr>
        <tr>
          <td>
          	
            <? 
                  for($i=0;$i<$count;$i++){?>
		            	<div style=" width:240px; line-height:20px; color:#003366; text-decoration:none; margin-top:5px; margin-left:10px; padding-top:5px;  float:left; display:inline;">
							<a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <?php if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
            				<?php }else {?>href="<?php echo $records[$i]->file_name;?>"<? }?> >
							<? echo $records[$i]->title;?>
							</a>
						</div>
		            	<? }?>
          
            <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
          </td>
        </tr>
      </table>
      <table width="255" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5"><img src="/images/dwsw/spacer.gif" alt="" width="1" height="1" /></td>
        </tr>
      </table>
      <table width="255" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','出访费用说明',7);
				$count = count($records);
			?>
                <td height="26" background="/images/dwsw/blue_titlebg.gif" class="left_title">出访费用说明</td>
        </tr>
        <tr>
          <td>
          	
            <? 
                  for($i=0;$i<$count;$i++){?>
		            	<div style=" width:240px; line-height:20px; color:#003366; text-decoration:none; margin-top:5px; margin-left:10px; padding-top:5px;  float:left; display:inline;">
							<a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <?php if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
            				<?php }else {?>href="<?php echo $records[$i]->file_name;?>"<? }?> >
							<? echo $records[$i]->title;?>
							</a>
						</div>
		            	<? }?>
          
            <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
          </td>
        </tr>
      </table>
      <table width="255" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5"><img src="/images/dwsw/spacer.gif" alt="" width="1" height="1" /></td>
        </tr>
      </table>
      <table width="255" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','外事咨询联系',7);
				$count = count($records);
			?>
                <td height="26" background="/images/dwsw/blue_titlebg.gif" class="left_title">外事咨询联系</td>
        </tr>
        <tr>
          <td>
          	
            <? 
                  for($i=0;$i<$count;$i++){?>
		            	<div style=" width:240px; line-height:20px; color:#003366; text-decoration:none; margin-top:5px; margin-left:10px; padding-top:5px;  float:left; display:inline;">
							<a title="<? echo $records[$i]->title;?>" style=" width:240px; height:12px; color:#003366; text-decoration:none; overflow:hidden;" <?php if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
            				<?php }else {?>href="<?php echo $records[$i]->file_name;?>"<? }?> >
							<? echo $records[$i]->title;?>
							</a>
						</div>
		            	<? }?>
          
            <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
          </td>
        </tr>
      </table></td>
    <td width="5" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
	<?php
		$records = show_content('smg_images','picture','对外事务部','cat_indexphoto',1);
	?>
    <td width="415" valign="top" bgcolor="#fef3be"><img src="<? echo $records[0]->src;?>" width="415" />
      <table width="415" border="0" cellspacing="3" cellpadding="3">
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','外事新闻',7);
				$count = count($records);
			?>
          <td class="mtitle">外事新闻</td>
        </tr>
        <tr>
          <td>
          	<ul>
            <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:400px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; padding-top:5px;  float:left; display:inline;">
	            		<li><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:15px; line-height:15px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a>　<span style="color:#999999;"><? echo substr($records[$i]->created_at,0,10);?></span></li></div>
	            	<? }?>
               </ul>
                  <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
        </tr>
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','媒体眼中的SMG',7);
				$count = count($records);
			?>
          <td class="mtitle">媒体眼中的SMG</td>
        </tr>
        <tr>
          <td>
          	<ul>
            <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:400px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; padding-top:5px;  float:left; display:inline;">
	            		<li><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:15px; line-height:15px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a>　<span style="color:#999999;"><? echo substr($records[$i]->created_at,0,10);?></span></li></div>
	            	<? }?>
               </ul>
                  <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
        </tr>
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','国际传媒资讯',7);
				$count = count($records);
			?>
          <td class="mtitle">国际传媒资讯</td>
        </tr>
        <tr>
          <td>
          	<ul>
            <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:400px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; padding-top:5px;  float:left; display:inline;">
	            		<li><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:15px; line-height:15px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a>　<span style="color:#999999;"><? echo substr($records[$i]->created_at,0,10);?></span></li></div>
	            	<? }?>
               </ul>
                  <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
        </tr>
        <tr>
        	<?php
				$records = show_content('smg_news','news','对外事务部','政策法规',7);
				$count = count($records);
			?>
          <td class="mtitle">政策法规</td>
        </tr>
        <tr>
          <td>
          	<ul>
            <? 
                
                for($i=0;$i<$count;$i++){?>
	            	<div style=" width:400px; height:30px; line-height:30px; color:#003366; text-decoration:none; overflow:hidden; padding-top:5px;  float:left; display:inline;">
	            		<li><a title="<? echo $records[$i]->title;?>" style=" width:240px; height:15px; line-height:15px; color:#003366; text-decoration:none; overflow:hidden;" <? if($records[$i]->file_name==""){?>href="content.php?id=<? echo $records[$i]->id;?>"
	            		<? }else {?>
	            		href="<? echo $records[$i]->file_name;?>"<? }?>><? echo $records[$i]->title;?></a>　<span style="color:#999999;"><? echo substr($records[$i]->created_at,0,10);?></span></li></div>
	            	<? }?>
               </ul>
                  <p align="right"><a href="newslist.php?id=<?php echo $records[0]->dept_category_id;?>"><img border=0 src="/images/dwsw/more.gif" alt="" width="51" height="17" hspace="15" vspace="5" /></p></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table></td>
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
          
          </td>
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

<script>
	$(function(){
		
		$("#dept_search").click(function(){
			window.location.href='/search/?key='+encodeURI($("#search").val())+'&search_type=smg_news';
		})
	});
</script>