<?php
	 require_once('../../frame.php');
?>

<html>
<head>
<title>传承文化 传播知识 传达真实的力量</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
	use_jquery();
	js_include_once_tag('total');
?>
<style type="text/css">
<!--
@import url("nw.css");
body {
	background-color: #014380;
	font-size:12px;
}
A{
	text-decoration:none;
}
A:visited{
	text-decoration:none;
}

.addr {	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
</head>
<script>
	total("纪实频道","news");	
</script>
<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (内网-ge.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="204" valign="top" align="center"><!-- #BeginLibraryItem "/Library/top.lbi" -->
<style type="text/css">
<!--
@import url("../top.css");
.add {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
}
.ss {
	font-family: "宋体";
	font-size: 12px;
	line-height: 15px;
	color: #FFFFFF;
	text-decoration: none;
}
.link1 {
	font-family: "宋体";
	font-size: 12px;
	line-height: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
<?php 
include("inc/topbar.inc.php");
?>
<!-- #EndLibraryItem -->
<table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
          <td><table id="__01" width="255" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="28" background="images/left_01.jpg">
              <table width="226" height="15" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td  width="31" height="18">&nbsp;</td>
                  <?php
						$records = show_content('smg_news','news','纪实频道','广而告之','10');
						$count = count($records);
                  ?>
                    <td  width="195" class="m-t"><div style="float:left; display:inline;">广而告之</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="newslist.php?id=<?php echo dept_category_id_by_name('广而告之','纪实频道','news');?>">更多</a></div></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="137" align="center" valign="top" background="images/left_02.jpg">
              <table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                  <td height="143"  class="blue">
                 <marquee height="143" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
										<? for($i=0;$i<$count;$i++)
										{
	              						?>
	              					<a title="<?php echo $records[$i]->title; ?>" href="news.php?id=<? echo $records[$i]->id;?>" class="blue short">・<? echo $records[$i]->short_title;?></a>
	              				</a> <br>
	                  	<?
	                  	}
	                  	?>
									</marquee>
                    </td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="45" valign="top" background="images/left_03.jpg">
              <table width="226" height="35" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="31" height="35">&nbsp;</td>
                    <?php  
						$records = show_content('smg_news','news','纪实频道','第一资源','10');
						$count = count($records);
					?>
                    <td width="195" valign="bottom" class="m-t"><div style="float:left; display:inline;">第一资源</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="newslist.php?id=<?php echo dept_category_id_by_name('第一资源','纪实频道','news');?>">更多</a></div></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="205" align="center" valign="top" background="images/left_04.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="green">
                   <? for($i=0;$i<$count;$i++)
										{
	              						?>
	              					<a title="<?php echo $records[$i]->title; ?>" href="news.php?id=<? echo $records[$i]->id;?>" class="blue short">・<? echo $records[$i]->short_title;?></a>
	              				</a> <br>
	                  	<?
	                  	}
	                  	?>
                    </td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="37" background="images/left_05.jpg"><table width="226" height="18" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="31" height="18">&nbsp;</td>
                    <td width="195" valign="bottom" class="m-t"><div style="float:left; display:inline;">有话大家说</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="yhdjs.php">更多</a></div></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="168" align="center" background="images/left_06.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="yel">
                  <?php
                  		$db = get_db();
                  		$sql = 'select * from smg_comment where resource_type="yhdjs" order by created_at';
						$records = $db->query($sql);
						$count = count($records);
                  	 for($i=0;$i<$count;$i++){?>
                    <a target="_blank" href="yhdjs.php" class="yel">・
                    <? 
	              		echo $records[$i]->title;
                    ?>
                    </a><br /> 
                    <? }?>
                    </td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td><a target="_blank" href="yhdjs.php"><img border="0" src="images/left_07.jpg" alt="" width="255" height="33" border="0" ></a></td>
              </tr>
            <tr>
              <td height="41" background="images/left_08.jpg"><table width="226" height="18" border="0" cellpadding="0" cellspacing="0">
                <tr>
                <?php 
                	
               
                ?>
                  <td width="31" height="18">&nbsp;</td>
                    <td width="195" valign="bottom" class="m-t"><div style="float:left; display:inline;">我要投票</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="#">更多</a></div></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="175" align="center" background="images/left_09.jpg"><table width="225" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <?php  
						$sql = 'select id,name from smg_vote where is_adopt=1 order by created_at desc limit 8';
						$record = $db->query($sql);
						$count = count($record);
				  ?>
                  <td class="gry">
                   <? for($i=0;$i<$count;$i++)
										{
	              						?>
	              					<a class="gry short" href="/vote/vote.php?vote_id=<?php echo $record[$i]->id ?>" title="<?php echo strip_tags($record[$i]->name); ?>" target=_blank><?php echo strip_tags($record[$i]->name);?></a> <br>
	                  	<?
	                  	}
	                  	?>
                    </td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="26" valign="top" background="images/left_10.jpg"><table width="226" height="19" border="0" cellpadding="0" cellspacing="0">
                <tr>
                <?php
					$records = show_content('smg_link','link','纪实频道','相关链接','8');
					$count = count($records);
                ?>
                  <td width="12" height="19">&nbsp;</td>
                    <td width="214" valign="bottom" class="m-t">相关链接</a></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="165" align="center" background="images/left_11.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top" class="gry"> 	
                  	<?php
                  		for($i=0;$i<$count;$i++){?>
                  			<a target="_blank" href="<? echo $records[$i]->link;?>" title="<?php echo $records[$i]->name; ?>" target="_blank" class="gry short">・ 
                  				<?php
		              					echo $records[$i]->name;
								?>
                  			</a><br>
                  			<? }?>
                  </td>
                 </tr>	
                </table>
                </td>
              </tr>
            <tr>
              <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
              </tr>
            </table></td>
            <td valign="top" align="center">
            <table id="__01" width="418" border="0" cellpadding="0" cellspacing="0">
              <tr>
              	<?php 
					$record = show_content('smg_images','picture','纪实频道','indexphoto','4');
					$count = count($record);
					for($i=0;$i<$count;$i++){
						$picsurl[]=$record[$i]->src;
						$picslink[]='/show/show.php?id='.$record[$i]->id;
						$picstext[]=$record[$i]->title;
					}
				?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<div id="focus_02"></div> 
				<script type="text/javascript"> 
					var pic_width=415; 
					var pic_height=180;
					var pics="<?php echo implode(',',$picsurl);?>";
					var mylinks="<?php echo implode(',',$picslink);?>";
					var texts="<?php echo implode(',',$picstext);?>";
				
					var picflash = new sohuFlash("/flash/focus.swf", "focus_02", pic_width, pic_height, "4","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics);
					picflash.addVariable("piclink",mylinks);
					picflash.addVariable("pictext",texts);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth",pic_width);
					picflash.addVariable("borderheight",pic_height);
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","15");				
					picflash.addVariable("pic_width",pic_width);
					picflash.addVariable("pic_height",pic_height);
					picflash.write("focus_02");				
				</script> 
                </td>
              </tr>
              <tr>
                <td height="33" background="images/med_02.jpg"><table width="226" height="20" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22" height="24">&nbsp;</td>
                     <?php 
							$records1 = show_content('smg_news','news','纪实频道','麻辣头条','8');
							$count1 = count($records1);
							$records2 = show_content('smg_news','news','纪实频道','重点关注','8');
							$count2 = count($records2);
                  	 ?>
                    <td width="204" valign="bottom" class="m-m"><span class="change" style="cursor:pointer" name="mltt" >麻辣头条</span>　|  <span class="change" name="zdgz" style="cursor:pointer">重点关注</span></td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="170" align="center" valign="top" background="images/med_03.jpg">
                	<table width="405" border="0" cellspacing="0" cellpadding="0">
	                  <tr>        						
	                    <td class="gre-nr" valign="top">
	                    	<div  class="mltt hide" style="display:block;">
	                    		<? for($i=0;$i<$count1;$i++){?>
		                    		<a target="_blank" title="<?php echo $records1[$i]->title; ?>" href="news.php?id=<?php echo $records1[$i]->id;?>" class="gre-nr long">・ 
			                    		<?php
					              					echo $records1[$i]->short_title;
			                    		?>
			                    	</a>  <span class="grr"> <? echo $records1[$i]->created_at;?></span> <br>
	                    		<? }?>
	                    	</div>	                     
	                     	<div class="zdgz hide" style="display:none;">
		                    		<? for($i=0;$i<$count2;$i++){?>
			                    		<a target="_blank" title="<?php echo $records2[$i]->title; ?>" href="news.php?id=<?php echo $records2[$i]->id;?>" class="gre-nr long">・ 
				                    		<?php
						              					echo $records2[$i]->short_title;
				                    		?>
				                    	</a>  <span class="grr"> <? echo $records2[$i]->created_at;?></span> <br>
		                    		<? }?>
	                    	</div>
	                    </td>
	                    	
	                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td>
                	<div class="mltt hide" style="display:block;">
                		<a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('麻辣头条','纪实频道','news');?>">
                			<img src="images/med_04.jpg" alt="" width="418" height="38" border="0" >
                		</a>
                	</div>
                	<div class="zdgz hide" style="display:none;">
                		<a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('重点关注','纪实频道','news');?>">
                			<img src="images/med_04.jpg" alt="" width="418" height="38" border="0" >
                		</a>
                	</div>
                </td>
              </tr>
              <tr>
                <td height="37" background="images/med_05.jpg"><table width="226" height="24" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22" height="24">&nbsp;</td>
                     <?php
											
							$records = show_content('smg_news','news','纪实频道','纪实达人','8');
							$count = count($records);
                  		?>
                    <td width="204" valign="bottom" class="m-m">纪实达人</td>
                  </tr>
                  </table></td>
              </tr>
              <tr valign="top">
                <td height="167" align="center" background="images/med_06.jpg"><table width="405" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="gre-nr">
                    		<?php for($i=0;$i<$count;$i++){?>
	                    		<a target="_blank" title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" class="gre-nr long">・ 
	                    			<?php
			              					echo $records[$i]->short_title;
	                    			?>
	                    		</a>  <span class="grr"> <?php echo $records[$i]->created_at;?></span> <br>
	                    	<? }?>
	                   </td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td><a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('纪实达人','纪实频道','news');?>"><img src="images/med_07.jpg" alt="" width="418" height="33" border="0" ></a></td>
              </tr>
              <tr>
                <td height="41" background="images/med_08.jpg"><table width="226" height="24" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22" height="24">&nbsp;</td>
                    <?php
						 $records = show_content('smg_news','news','纪实频道','现磨咖啡','8');
						 $count = count($records);
                  	?>
                    <td width="204" valign="bottom" class="m-m">现磨咖啡</td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="167" align="center" valign="top" background="images/med_09.jpg"><table width="405" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="gre-nr">
                    	<?php for($i=0;$i<$count;$i++){?>
	                    		<a target="_blank" title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" class="gre-nr long">・ 
	                    			<?php
			              					echo $records[$i]->short_title;
	                    			?>
	                    		</a>  <span class="grr"> <?php echo $records[$i]->created_at;?></span> <br>
	                    	<? }?>
	                  </td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td><a target="_blank" href="newslist.php?id=<?php echo dept_category_id_by_name('现磨咖啡','纪实频道','news');?>"><img src="images/med_10.jpg" alt="" width="418" height="31" border="0" ></a></td>
              </tr>
              <tr>
                <td height="49" background="images/med_11.jpg"><table width="226" height="24" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22" height="24">&nbsp;</td>
                    <?php
						$records = show_content('smg_images','picture','纪实频道','才艺展示','8');
						$count = count($records);
                  	?>
                    <td width="204" valign="bottom" class="m-m">才艺展示</td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="133" align="center" background="images/med_12.jpg"><table width="404" height="20" border="0" cellpadding="0" cellspacing="0">
                  <tr>        
                 		<td colspan="3">
                 			<marquee height="133" onmouseover=this.stop() onmouseout=this.start() >
                 				<? for($i=0;$i<$count;$i++){?>         					
                 					<a target="_blank" href="/show/show.php?id=<? echo $records[$i]->id;?>"><img border="0" src="<? echo $records[$i]->src;?>" width="125" height="100"></a>
                 				<? }?>
                 			</marquee>
                 		</td>	
                  </table></td>
              </tr>
              </table></td>
            <td valign="top" align="right">
            <table id="__01" width="271" height="1078" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="31" background="images/rig_01.jpg"><table width="253" height="19" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                  <?php
				  	$records = show_content('smg_video','video','纪实频道','好好学习','1');
					$count = count($records);
				  ?>
                    <td width="37" height="19">&nbsp;</td>
                    <td width="216" valign="bottom" class="m-t"><div style="float:left; display:inline;">好好学习</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="video.php?id=<?php echo $records[0]->id;?>">更多</a></div></td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="271" height="340" align="center" valign="top" background="images/rig_02.jpg"><table width="251" height="92" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2" class="m-t">
                    	<?php
							show_video_player(248,148,$records[0]->photo_url,$records[0]->video_url);
                    	?>
                    	
                    </td>
                    </tr>   
                  <tr>
                    <td height="18" colspan="2" class="nr-d"><img src="images/line.jpg" width="251" height="14"></td>
                    </tr>
                  </table>
                  <table width="251" height="150" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                    <?php
						$records = show_content('smg_news','news','纪实频道','私房推荐','4');
						$count = count($records);
					?>
                      <td width="146" height="20" class="m-t">[私房推荐]</td>
                      <td width="114" rowspan="2" align="center"><img src="<? echo $records[0]->photo_src;?>" width="80" height="80"></td>
                    </tr>
                    <tr>
                      <td class="nr-d"><a target="_blank" href="news.php?id=<? echo $records[0]->id;?>" class="nr-d"><? echo $records[0]->title; ?></a></td>
                    </tr>
                    <tr>
                      <td height="18" colspan="2" class="nr-d"><img src="images/line.jpg" width="251" height="14"></td>
                    </tr>
                    <tr>
                      <td height="18" colspan="2" class="nr-d"><? for($i=1;$i<$count;$i++){?>
		              	<a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" class="nr-d short" title="<?php echo $records[$i]->title;?>">・<? echo $records[$i]->short_title;?></a>
                      	</a><br><? }?>
					  </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td><a target="_blank" href="kxfz-ok.php"><img  src="images/rig_03.jpg" alt="" width="271" height="70" border="0"></a></td>
              </tr>
              <tr>
                <td><a target="_blank" target="_blank" href="/bbs/forumdisplay.php?fid=37"><img border="0" src="images/rig_04.jpg" width="271" height="73" alt=""></a></td>
              </tr>
              <tr>
                <td height="31" background="images/rig_05.jpg"><table width="226" height="20" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                  <?php
                  		$records = show_content('smg_news','news','纪实频道','群团乐趣','1');
						$count = count($records);
                  ?>
                    <td width="37" height="20">&nbsp;</td>
                    <td width="189" valign="bottom" class="m-t"><div style="float:left; display:inline;">文明采风</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="wmzl.php">更多</a></div></td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="250" align="center" valign="top" background="images/rig_06.jpg"><table width="251" height="92" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="146" height="25" class="m-t">[群团乐趣]</td>
                    
                    <td width="114" rowspan="2" align="center"><img src="<? echo $records[0]->photo_src; ?>" width="80" height="80"></td>
                  </tr>
                  <tr>
                    <td class="nr-d"><a target="_blank" href="news.php?id=<? echo $records[0]->id;?>" class="whi"><? echo $records[0]->title;?></a></td>
                  </tr>
                  <tr>
                    <td height="18" colspan="2" class="nr-d"><img src="images/line.jpg" width="251" height="14"></td>
                  </tr>
                  </table>
                  <table width="251" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="whi">
                      		<?php 
								$records = show_content('smg_news','news','纪实频道','文明采风','7');
								$count = count($records);
								for($i=0;$i<$count;$i++) {
							?>
								<a target="_blank" href="news.php?id=<? echo$records[$i]->id;?>" title="<?php echo $records[$i]->title;?>" class="whi short">・<? echo $records[$i]->short_title;?></a><br/>
							<?php 
								}
							?>   
					  </td>
                    </tr>
                  </table>
                  <table width="251" border="0" cellspacing="0" cellpadding="0">
                  </table></td>
              </tr>
              <tr>
                <td height="31" background="images/rig_07.jpg"><table width="226" height="21" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                  <?php
                 	 	$records = show_content('smg_news','news','纪实频道','党员活动','8');
						$count = count($records);
                  ?>
                    <td width="37">&nbsp;</td>
                    <td width="189" valign="bottom" class="m-t"><div style="float:left; display:inline;">党员活动</div><div style="float:right; display:inline"><a target="_blank" style="color:#ffffff; text-decoration:none;" href="photolist.php">更多</a></div></td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="250" align="center" valign="top" background="images/rig_08.jpg"><table width="251" height="92" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                  	<td width="146" height="25" class="m-t">&nbsp;</td>
                    <td width="114" rowspan="2" align="center"><img src="<?php echo $records[0]->photo_src;?>" width="80" height="80"></td>
                  </tr>
                  <tr>
                    <td class="nr-d"><a target="_blank" href="news.php?id=<?php echo $records[0]->id;?>" class="whi"><?php echo $records[0]->title;?></a></td>
                  </tr>
                  <tr>
                    <td height="18" colspan="2" class="nr-d"><img src="images/line.jpg" width="251" height="14"></td>
                  </tr>
                  </table>
                  <table width="251" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="whi">
                      	<? for($i=1;$i<$count;$i++){?>
		              		<a target="_blank" title="<?php echo $records[$i]->title; ?>" class="whi short" href="news.php?id=<? echo $records[$i]->id;?>">・<? echo $records[$i]->short_title;?></a>
						<? }?>			
		              </td>
                  </tr>
                  </table>
                  <table width="251" border="0" cellspacing="0" cellpadding="0">
                  </table></td>
              </tr>
              </table></td>
        </tr>
        <tr>
          <td height="101" colspan="3" align="center" valign="middle" background="images/di.jpg" class="nr-d">上海文广新闻传媒集团  纪实频道 版权所有<br>
            建议 1024X768 浏览效果最佳</td>
        </tr>
    </table></td></tr>
</table>
<!-- End ImageReady Slices -->

<map name="Map"><a target="_blank"rea shape="rect" coords="140,2,250,33" href="#"></map>
<map name="Map2"><a target="_blank"rea shape="rect" coords="305,2,402,34" href="#"></map>
<map name="Map3"><a target="_blank"rea shape="rect" coords="310,1,403,39" href="#"></map>
<map name="Map4"><a target="_blank"rea shape="rect" coords="313,1,404,39" href="#"></map></body>
</html>

<script>
	$(function(){
		$(".change").hover(function(){
			$(".hide").hide();
			$("."+$(this).attr('name')).show();
		});
	});
</script>