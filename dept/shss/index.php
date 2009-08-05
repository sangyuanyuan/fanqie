<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时尚传媒内网</title>
<script language="javascript" src="shss.js"></script>
<style type="text/css">
<!--
body {
	background-image: url();
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #171717;
}
body,td,th {
	font-size: 12px;
}
a{
	text-decoration:none;
	color:#000000;
}
-->
</style></head>

<body>
<table width="980" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="images/xstitle.gif" width="941" height="95" /></td>
  </tr>
</table>
<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18">&nbsp;</td>
    <td width="605"><? $photo = show_content('smg_images','picture','生活时尚频道','首页图片');?><img src="<? echo $photo[0]->src;?>" width="587" height="261" /></td>
    <td width="338">
    	<? $video = show_content('smg_video','video','生活时尚频道','首页视频');
			show_video_player(338,256,$video[0]->photo_url,$video[0]->video_url);
		?></td>
    <td width="19">&nbsp;</td>
  </tr>
</table>
<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18">&nbsp;</td>
    <td width="589" background="images/bg.gif"><table width="589" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/title.gif" width="587" height="46" /></td>
      </tr>
    </table>
    <? $link = show_content('smg_link','link','生活时尚频道','管理层邮箱',3);?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="589" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="9">&nbsp;</td>
              <td width="317" valign="top"><table width="90%" border="0" align="center" cellpadding="6" cellspacing="0">
              	<? for($i=0;$i<count($link);$i++){?>
                <tr>
                  <td><img src="images/arrow.gif" width="10" height="9" /><a href="mailto:<? echo $link[$i]->link;?>"><? echo $link[$i]->name;?></a></td>
                </tr>
                <tr>
                  <td><img src="images/line.gif" width="269" height="1" /></td>
                </tr>
                <? }?>
              </table>
              <? $news = show_content('smg_news','news','生活时尚频道','一周日程安排',5);?>
                <div style="width:284px; height:28px; padding-top:10px; background:url(images/title2.gif) no-repeat; text-align:right; float:left; display:inline" ><a style="color:#FF6600" target="_blank" href="newslist.php?id=<? echo $news[0]->dept_category_id;?>">更多</a></div>
                <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                	<? 
                		for($i=0;$i<count($news);$i++){
                	?>
	                  <tr>
	                    <td><img src="images/arrow.gif" width="10" height="9" /><a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></td>
	                  </tr>
                  <? }?>
                </table></td>
              <td width="31">&nbsp;</td>
              <td width="222" height="285" valign="top" background="images/bg2.gif" style=line-height:140%><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
              	<? $news = show_content('smg_news','news','生活时尚频道','重要通知',1);?>
                <tr>
                  <td><span style="text-indent:24px;"><? echo strip_tags($news[0]->content);?></span></td>
                </tr>
              </table></td>
              <td width="12">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
    </table>
      <table width="572" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
        <? $news = show_content('smg_news','news','生活时尚频道','快速浏览',8);?>
      <table width="572" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div style="width:572px; height:50px; padding-top:35px; padding-right:10px; background:url(images/ksll.gif) no-repeat; text-align:right; float:right; display:inline;"><a style="color:#ffffff;" href="newslist.php?id=<?php echo $news[0]->dept_category_id;?>">更多</a></div></td>
        </tr>
      </table>

      <table width="572" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td background="images/bg3.gif"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
          <td align="center"><p><? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><div style="width:73px; height:78px; margin:10px; float:left; display:inline;"><a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><img src="<? echo $news[$i]->photo_src;?>" border=0 width="73" height="78" vspace="5" /></a></div><? }}?></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
          </table>
            <table width="460" border="0" align="center" cellpadding="5" cellspacing="0">
              <tr>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->short_title;?></a></td>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[4]->id;?>"><? echo $news[4]->short_title;?></a></td>
              </tr>
              <tr>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[1]->id;?>"><? echo $news[1]->short_title;?></a></td>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[5]->id;?>"><? echo $news[5]->short_title;?></a></td>
              </tr>
              <tr>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[2]->id;?>"><? echo $news[2]->short_title;?></a></td>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[6]->id;?>"><? echo $news[6]->short_title;?></a></td>
              </tr>
              <tr>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[3]->id;?>"><? echo $news[3]->short_title;?></a></td>
                <td width="230"><img src="images/arrow.gif" width="10" height="9" /><a  href="/news/news.php?id=<? echo $news[7]->id;?>"><? echo $news[7]->short_title;?></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="27" background="images/bg4.gif">&nbsp;</td>
        </tr>
      </table>
      <table width="572" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <? $news = show_content('smg_news','news','生活时尚频道','主题宣传',6);?>
      <table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td background="images/bg5.gif"><table width="538" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="265" valign="top">
              	<div style="width:265px; height:32px; padding-top:12px; background:url(images/title3.gif) no-repeat; text-align:right; float:left; display:inline;"><a style="color:#FF6600" target="_blank" href="newslist.php?id=<?php echo $news[0]->dept_category_id;?>">更多</a></div>
                <table width="240" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td height="160" valign="top" style=font-size:14px;line-height:140%>
                    	<? for($i=0;$i<count($news);$i++){?>    	
                    <img src="images/arrow.gif" width="10" height="9" /><a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a><br />
                    <? }?>
                    </td>
                  </tr>
                </table>
                <table width="245" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="images/bottombg.gif" width="245" height="10" /></td>
                  </tr>
                </table></td>
              <td width="28" valign="top"><img src="images/mline.gif" width="15" height="189" /></td>
              <? $news = show_content('smg_news','news','生活时尚频道','YOUNGS快报',6);?>
              <td width="245" valign="top"><div style="width:245px; height:32px; padding-top:12px; background:url(images/title4.gif) no-repeat; text-align:right; float:left; display:inline;"><a style="color:#FF6600" target="_blank" href="newslist.php?id=<?php echo $news[0]->dept_category_id;?>">更多</a></div>
              	
                <table width="240" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td height="160" valign="top" style="font-size:14px;line-height:140%">
                    	<? for($i=0;$i<count($news);$i++){?>
                    		<img src="images/arrow.gif" width="10" height="9" /><a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a><br />
                    	<? }?>
                    </td>
                  </tr>
                </table>
                <table width="245" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="images/bottombg.gif" width="245" height="10" /></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <? $news = show_content('smg_news','news','生活时尚频道','行业动态',6);?>
            <table width="540" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="525" valign="top"><table width="525" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div style="width:525px; height:32px; padding-top:12px; padding-right:10px; background:url(images/title5.gif) no-repeat; text-align:right; float:left; display:inline;"><a style="color:#FF6600" target="_blank" href="newslist.php?id=<?php echo $news[0]->dept_category_id;?>">更多</a></div></td>
                  </tr>
                </table>
                
                  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>
                      	<? for($i=0;$i<count($news);$i++){?>
                    			<img src="images/arrow.gif" width="10" height="9" /><a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a><br />
                    		<? }?>
	                    </td>
                    </tr>
                </table></td>
                <td width="30" valign="top"><img src="images/rightline.gif" width="10" height="170" /></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/bottombg2.gif" width="522" height="6" /></td>
                <td valign="top">&nbsp;</td>
              </tr>
          </table>
          <? $news = show_content('smg_news','news','生活时尚频道','管理制度',3);?>
            <table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="334"><table width="334" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div style="width:334px; height:30px; padding-top:12px; padding-right:10px; background:url(images/gltitle.gif) no-repeat; text-align:right; float:left; display:inline;"><a style="color:#FF6600" target="_blank" href="newslist.php?id=<?php echo $news[0]->dept_category_id;?>">更多</a></div></td>
                  </tr>
                  <tr>
                    <td background="images/glbg.gif"><table width="300" border="0" align="center" cellpadding="5" cellspacing="0">
                      <tr>
                        <td valign="top" style="font-size:14px;line-height:140%">
                        	<? for($i=0;$i<count($news);$i++){?>
                    				<img src="images/arrow.gif" width="10" height="9" /><a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a><br />
                    			<? }?>
                        </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><img src="images/glbottom.gif" width="334" height="15" /></td>
                  </tr>
                </table></td>
                <td valign="top">
                	<? $news = show_content('smg_news','news','生活时尚频道','表单下载',3);?>
                	<table width="224" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><div style="width:224px; height:30px; padding-top:12px; padding-right:10px; background:url(images/rtop.gif) no-repeat; text-align:right; float:left; display:inline;"><a style="color:#FF6600" target="_blank" href="newslist.php?id=<?php echo $news[0]->dept_category_id;?>">更多</a></div></td>
                  </tr>
                  <tr>
                    <td background="images/rbg.gif"><table width="220" border="0" align="center" cellpadding="5" cellspacing="0">
                      <tr>
                        <td valign="top" style="font-size:14px;line-height:140%">
                        	<? for($i=0;$i<count($news);$i++){?>
                    				<img src="images/arrow.gif" width="10" height="9" /><a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a><br />
                    			<? }?></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><img src="images/rbottom.gif" width="224" height="28" /></td>
                  </tr>
                </table></td>
              </tr>
          </table>
          <? $news = show_content('smg_news','news','生活时尚频道','读书沙龙',3);?>
            <table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><img src="images/title6.gif" width="560" height="30" /></td>
              </tr>
              <tr>
                <td><table width="95%" border="0" align="center" cellpadding="1" cellspacing="0">
                	<? for($i=0;$i<count($news);$i++){?>
                  <tr>
                    <td><img src="images/pen.gif" width="21" height="26" alt="" /></td>
                    <td><span style="font-size:14px;line-height:140%"><a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></span></td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="images/line2.gif" width="541" height="3" /></td>
                  </tr>
                  <? }?>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/line3.gif" width="587" height="8" /></td>
        </tr>
      </table></td>
    <td width="14">&nbsp;</td>
    <td width="359" valign="top"><table width="347" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/rtitle1.gif" width="347" height="53" /></td>
      </tr>
      <tr>
        <td background="images/rbg1.gif"><br />
        	<? $news = show_content('smg_news','news','生活时尚频道','收视排行',5);?>
          <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
          	<? for($i=0;$i<count($news);$i++){?>
          <tr>
            <td><img src="images/arrow.gif" width="10" height="9" /><? echo $news[$i]->title;?></td>
          </tr>
          <? }?>
        </table>
          <br /></td>
      </tr>
      <tr>
        <td><img src="images/rbottom1.gif" width="347" height="11" /></td>
      </tr>
      <tr>
        <td><img src="images/rtitle2.gif" width="347" height="92" /></td>
      </tr>
      <tr>
        <td background="images/rbg1.gif"><br />
          <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
          	<?php
				$db = get_db();
				$sql = 'select tid,subject from bbs_posts where first=1 order by tid desc limit 5';
				$record = $db->query($sql);
				$count = count($record)
			?>
			<? for($i=0;$i<$count;$i++){?>
	          <tr>
	            <td>
	            	<img src="images/arrow.gif" width="10" height="9" />
					<a target="_blank" title="<?php echo $record[$i]->subject; ?>" href="/bbs/viewthread.php?tid=<?php echo $record[$i]->tid;?>">
						<?php echo $record[$i]->subject;?>
					</a>
				</td>
	          </tr>
	        <? }?>
        </table>
          <br /></td>
      </tr>
      <tr>
        <td><img src="images/rtitle3.gif" width="347" height="99" /></td>
      </tr>
      <tr>
        <td background="images/rbg1.gif"><br />
          <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
          	<?php
				$db = get_db();
				$sql='select uid,itemid,subject from blog_spaceitems order by itemid desc limit 5';
				$record_blog = $db->query($sql);
				$count = count($record_blog)
			?>
			<? for($i=0;$i<$count;$i++){?>
	          <tr>
	            <td>
	            	<img src="images/arrow.gif" width="10" height="9" />
					<a href="/blog/?uid-<?php echo $record_blog[$i]->uid; ?>-action-viewspace-itemid-<?php echo $record_blog[$i]->itemid; ?>" target=_blank ><?php echo $record_blog[$i]->subject; ?></a>
				</td>
	          </tr>
	        <? }?>
          </table>
          <br /></td>
      </tr>
      <tr>
        <td><img src="images/rtitle4.gif" width="347" height="99" /></td>
      </tr>
      <tr>
      	<? $news = show_content('smg_news','news','生活时尚频道','时尚观察',6);?>
        <td background="images/rbg1.gif"><br />
          <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
          	<? for($i=0;$i<count($news);$i++){?>
            <tr>
              <td><img src="images/arrow.gif" width="10" height="9" /><a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></td>
            </tr>
            <? }?>
          </table>
          <br /></td>
      </tr>
      <tr>
        <td><img src="images/rtitle6.gif" width="347" height="101" /></td>
      </tr>
      <tr>
        <td background="images/rbg1.gif"><br />
        	<? $video = show_content('smg_video','video','生活时尚频道','视频点播');?>
          <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
          	<? for($i=0;$i<count($video);$i++){?>
            <tr>
              <td><img src="images/arrow.gif" width="10" height="9" /><span style="cursor: hand;" onclick="goplay('<? echo $video[$i]->video_url;?>')"><? echo $video[$i]->title;?></span></td>
            </tr>
            <? }?>
          </table>
          <br /></td>
      </tr>
      <tr>
        <td><img src="images/rtitle7.gif" width="347" height="99" /></td>
      </tr>
      <tr>
        <td background="images/rbg1.gif"><br />
          <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
        			<? //$report=getcategoryreport();?>
		          <td><? for($i=0;$i< $report->itemcount;$i++){?><div><div style="float:left; display:inline;">&middot;<? echo $report[$i]->name;?></div><div style="float:right; display:inline;"><? echo $report[$i]->clickcount;?></div></div><br><? }?></td>
		        </tr>
          </table>
          <br /></td>
      </tr>
      <tr>
        <td><img src="images/rtitle8.gif" width="347" height="8" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="967" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="106"><img src="images/bottom.gif" width="980" height="129" /></td>
  </tr>
</table>
</body>
</html>
