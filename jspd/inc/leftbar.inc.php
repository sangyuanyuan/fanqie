<table id="__01" width="255" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="28" background="images/left_01.jpg">
             <table width="226" height="15" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="31">&nbsp;</td>
                  <?
					$newslist = load_module('pos_indexleft1',6);
					//print_r($newslist);
                  ?>
                    <td width="195" class="m-t"><? echo $newslist->categoryname ?></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="137" align="center" valign="top" background="images/left_02.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="blue">
                  	<marquee DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
											<? for($i=0;$i<$newslist->itemcount;$i++)
											{?>
	              				<a style="width:230px; overflow:hidden;" href="news.php?id=<? echo $newslist->items[$i]->id;?>" target="_blank" class="blue">・ <? echo $newslist->items[$i]->shorttitle;?></a> <br>
	                  	<?
	                  	}
	                  	?>
										</marquee>
                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
              <td height="45" valign="top" background="images/left_03.jpg"><table width="226" height="35" border="0" cellpadding="0" cellspacing="0">
                <tr>
                <? $video=load_module('pos_index_right1',4)?>
                  <td width="37" height="19">&nbsp;</td>
                  <td width="189" valign="bottom" class="m-t"><? echo $video->categoryname;?></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td height="165" align="center" background="images/left_11.jpg"><table width="234" height="92" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td  width="248" colspan="2" class="m-t">
                  <? 
                  	ShowMediaPlay(248,148,$video->items[0]->photourl,$video->items[0]->videourl);
                  	for($i=1;$i<$video->itemcount;$i++)
                  	{?>
                  		<a style="width:248px; margin-top:15px; float:left; display:inline;" href="video.php?id=<? echo $video->items[$i]->id;?>">
                  	<? echo $video->items[$i]->title;?></a><br>
                  	<?}
                  ?>
                  </td>
                </tr>
                <tr>
                  <td height="18" colspan="2" class="gre-nr">&nbsp;</td>
                </tr>
            
               
            <tr>
              <td height="37" background="images/left_05.jpg"><table width="226" height="18" border="0" cellpadding="0" cellspacing="0">
                <tr>
                	<? $newslist=load_module('pos_indexcenter1',8)?>
                  <td width="31" height="18">&nbsp;</td>
                    <td width="195" valign="bottom" class="m-t"><? echo $newslist->categoryname;?></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="168" align="center" background="images/left_06.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="yel"> <?
                   for($i=0;$i< $newslist->itemcount;$i++){?>
                    <a style="width:230px; overflow:hidden;" href="news.php?id=<? echo $newslist->items[$i]->id; ?>" class="yel">・<? echo  $newslist->items[$i]->title;?></a><br /> 
                    <? }?></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="45" valign="top" background="images/left_03.jpg">
              <table width="226" height="35" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="31" height="35">&nbsp;</td>
                    <? $newslist = load_module('pos_indexleft2',8); ?>
                    <td width="195" valign="bottom" class="m-t"><? echo $newslist->categoryname ?></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="205" align="center" valign="top" background="images/left_04.jpg"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="green">
                    <? for($i=0;$i<$newslist->itemcount;$i++)
                  	{?>
                  		<a style="width:230px; overflow:hidden;" href="<? echo $newslist->items[$i]->newslink;?>" target="_blank" class="blue">・ <? echo $newslist->items[$i]->shorttitle;?></a> <br>
                  	<?
                  	}
                  	?>
                    </td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td height="41" background="images/left_08.jpg"><table width="226" height="18" border="0" cellpadding="0" cellspacing="0">
                <tr>
                	<? $newslist=load_module('pos_wmzl_center1',4);
                		$wmlv2=load_module('pos_wmzl_center2',4);
                	?>
                  <td width="31" height="18">&nbsp;</td>
                    <td width="195" valign="bottom" class="m-t">文明采风</td>
                  </tr>
                 
                </table></td>
              </tr>
            <tr valign="top">
              <td height="175" align="center" background="images/left_09.jpg"><table width="251" border="0" cellspacing="0" cellpadding="0">
                <tr>
         
                  <td valign="top" class="gry"> 
                  	<? for($i=0;$i< $newslist->itemcount;$i++)
                  	{?>
                  		<a style="width:230px; overflow:hidden;" href="news.php?id=<? echo $newslist->items[$i]->id;?>" target="_blank" class="blue">・ <? echo $newslist->items[$i]->shorttitle;?></a> <br>
                  	<?
                  	}
                  	?>
                  	<? for($i=0;$i< $wmlv2->itemcount;$i++)
                  	{?>
                  		<a style="width:230px; overflow:hidden;" href="news.php?id=<? echo $wmlv2->items[$i]->id;?>" target="_blank" class="blue">・ <? echo $wmlv2->items[$i]->shorttitle;?></a> <br>
                  	<?
                  	}
                  	?></td>
                </tr>
              </table></td>
            </tr>
           
              </table>