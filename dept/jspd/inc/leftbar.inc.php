<table id="__01" width="255" height="1155" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td  valign="top" height="28" background="images/left_01.jpg no_repeat">
             <table  width="226" height="15" border="0" cellpadding="0" cellspacing="0">
               <tr>
              <td height="28" background="images/left_01.jpg">
              <table  width="226" height="15" border="0" cellpadding="0" cellspacing="0">
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
              <td height="45" align="left" valign="top" background="images/left_03.jpg"><table width="226" height="35" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <?php
				  	$records = show_content('smg_video','video','纪实频道','好好学习','4');
					$count = count($records);
				  ?>
                  <td width="37" height="19">&nbsp;</td>
                  <td width="189" valign="bottom" class="m-t">好好学习</td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td height="165" align="left" background="images/left_11.jpg"><table width="234" height="92" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td  width="248" colspan="2" class="m-t">
                  <?php
                  	show_video_player(248,148,$records[0]->photo_url,$records[0]->video_url);
                  	for($i=1;$i<$count;$i++)
                  	{?>
                  		<a style="width:248px; margin-top:15px; margin-left:10px; float:left; display:inline;" href="video.php?id=<? echo $records[$i]->id;?>">
                  	<?php echo $records[$i]->title;?></a><br>
                  	<?}
                  ?>
                  </td>
                </tr>
                <tr>
                  <td height="18" colspan="2" class="gre-nr">&nbsp;</td>
                </tr>
            
               
            <tr>
              <td align="left" height="37" background="images/left_05.jpg"><table width="226" height="18" border="0" cellpadding="0" cellspacing="0">
                <tr>
                	<?php
						$records = show_content('smg_news','news','纪实频道','麻辣头条','8');
						$count = count($records);
					?>
                  <td width="31" height="18">&nbsp;</td>
                    <td width="195" valign="bottom" class="m-t">麻辣头条</td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="168" align="left" background="images/left_06.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="yel"> <?
                   for($i=0;$i<$count;$i++){?>
                    <a style="width:230px; overflow:hidden;" href="news.php?id=<? echo $records[$i]->id; ?>" title="<?php echo $records[$i]->title;?>" class="yel short">・<?php echo  $records[$i]->short_title;?></a>
                    <? }?></td>
                  </tr>
                </table></td>
              </tr>
           <tr>
              <td align="left" height="45" valign="top" background="images/left_03.jpg">
              <table width="226" height="35" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="31" height="35">&nbsp;</td>
                    <?php  
						$records = show_content('smg_news','news','纪实频道','第一资源','10');
						$count = count($records);
					?>
                    <td width="195" valign="bottom" class="m-t"><div style="float:left; display:inline;">第一资源</div></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="205" align="left" valign="top" background="images/left_04.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
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
              <td align="left" height="41" background="images/left_08.jpg"><table width="226" height="18" border="0" cellpadding="0" cellspacing="0">
                <tr>
                	 <?php  
						$records = show_content('smg_news','news','纪实频道','群团乐趣','10');
						$count = count($records);
					 ?>
                  <td width="31" height="18">&nbsp;</td>
                    <td width="195" valign="bottom" class="m-t">文明采风</td>
                  </tr>
                 
                </table></td>
              </tr>
            <tr valign="top">
              <td height="175" align="left" background="images/left_09.jpg"><table width="251" border="0" cellspacing="0" cellpadding="0">
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
           
              </table>