<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css.css" type="text/css" />
<title>文广移动</title>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="szyd.js" type="text/javascript"></script>
</head>

<body class="body">
<div class="body" >
	<div class="main">
    	<div class="top">`
        </div>
        <div class="nav">    
          <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','971','height','64','src','nav','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','nav' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="971" height="64">
            <param name="movie" value="nav.swf" />
            <param name="quality" value="high" />
            <embed src="nav.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="971" height="64"></embed>
          </object></noscript>
  </div>
  <DIV  ID="MAIN_1">
        	<DIV  ID="left_c">
            	<div class="left_1" >
            		<? $newslist=show_content('smg_news','news','上海文广数字移动传播有限公司','公司简介','1');?>
            		<div style="width:200px; height:160px; margin-top:20px; overflow:hidden; margin-left:10px; font-size:12px; line-height:18px; text-indent:24px; float:left; display:inline;"><a target="_blank" style="font-size:12px;" title="<? echo strip_tags($newslist[0]->content);?>" href="news1.php?id=<? echo $newslist[0]->id;?>"><? echo strip_tags($newslist[0]->content);?></a></div>
            		<div style="width:200px; height:20px; margin-left:10px; float:left; display:inline;"><img width=14 height=14 src="pic/icon.jpg"><a style="color:green; font-size:12px;" target="_blank" href="http://222.68.17.238:5208/wenguang/">实时交通体验网站</a></div>
              </div>
              <div  class="rearch">
              	<input name="search" id="search" type="text" style="margin-top:10px;"> <img OnClick="searchnews('search')" style="margin-top:2px; display:inline;" src="pic/searchbutton.gif">
              </div>
              <div  class="link">
              	<?php
									$link = show_content('smg_link','link','上海文广数字移动传播有限公司','友情链接',2);
	      				?> 
              					<div style="width:120px; margin-top:33px; margin-left:25px; font-size:14px; float:left; display:inline;">
									<? for($i=0;$i<count($link);$i++){?>
										<a target="_blank" style="width:120px; margin-top:10px; float:left; display:inline;"  href="<? echo $link[$i]->link;?>" ><?php echo $link[$i]->name;?></a>
									<?php }?>
								</div>
              </div>
              <div  class="count">
              	 <? //$report=getcategoryreport();
              	  //for($i=0;$i< $report->itemcount;$i++){?>
		            	<div><div style="margin-left:10px; float:left; display:inline;"><? echo $report->items[$i]->name;?></div><div style="margin-right:10px; float:right; display:inline;"><? echo $report->items[$i]->clickcount;?></div></div><br>
		            <? //}?>
             </div> 
          </DIV>
        	
        	<div class="right_c" >
            	<div  class="pic"><img class="pic" src="pic2/flower.jpg"/></div>
                <div class="share" >
                 <div  class="share_top">分享家园</div>
                 <div  class="r_border">
                 		<?php
											$newslist = show_content('smg_news','news','上海文广数字移动传播有限公司','分享家园','5');
       				  			for($i=0;$i<count($newslist);$i++) {
      							?>
      							<div class="right_content">・<a target="_blank" href="news.php?id=<? echo $newslist[$i]->id;?>" title="<?php echo $newslist[$i]->title;?>" ><?php echo $newslist[$i]->short_title;?></a></div>
      							<?php }?>
                 	</div>
            	  </div>
                <div class="share" >
                 <div  class="share_top">特快专递</div>
                 <div  class="r_border">
                 	<form id="addform" name="addform" action="szyd.post.php" method="post">
							      <table width="212" border="0" cellspacing="0" cellpadding="0">
							        <tr>
							          <td align="center">发件人：</td><td><input style="width:130px; height:12px;" type="text" id="from" name="from"></td>
							        </tr>
							        <tr>
							          <td align="center">标　题：</td><td><input style="width:130px; height:12px;" type="text" id="subject" name="subject"></td>
							        </tr>
							        <tr>
							          <td align="center">内　容：</td><td><textarea style="width:130px;"  id="message" name="message" rows="2"></textarea></td>
							        </tr>
							        <tr>
							          <td></td><td><input type="button" onclick="checkform()" value="发送"></td>
							        </tr>	 
							      </table>
							     </form>
                </div>
              </div>
          </div>
            
        	<div  class="center">
           	  <div class="center_mq">
           	  </div>
                
              <div class="center_pic">
              	<? 
              		$photolist = show_content('smg_images','picture','上海文广数字移动传播有限公司','首页图片','5');
					$count = count($photolist);
					for ($i=0;$i<$count;$i++)
					{
						$picsurl[]=$photolist[$i]->src;
						$picslink[]=$photolist[$i]->url;
					}
              ?>
                <td>
                	<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
						<!-- 图片播放器开始 -->
						<div id="focus_01"></div> 
						<script type="text/javascript"> 
						var pic_width=501; //图片宽度
						var pic_height=188; //图片高度
						var pics="<?php echo implode(',',$picsurl);?>";
						var mylinks="<?php echo implode(',',$picslink);?>";
		 
						var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "501", "188", "6","#FFFFFF");
						picflash.addParam('wmode','opaque');
						picflash.addVariable("picurl",pics);
						picflash.addVariable("piclink",mylinks);				
						picflash.addVariable("pictime","5");
						picflash.addVariable("borderwidth","501");
						picflash.addVariable("borderheight","188");
						picflash.addVariable("borderw","false");
						picflash.addVariable("buttondisplay","true");
						picflash.addVariable("textheight","0");				
						picflash.addVariable("pic_width",pic_width);
						picflash.addVariable("pic_height",pic_height);
						
						picflash.write("focus_01");				
					</script>
              </div>          
             		
              <div  class="center_lm">最新动态</div>
              <div  class="center_nr">
              	<div style="height:85px;">
     	         	<?php
									$newslist = show_content('smg_news','news','上海文广数字移动传播有限公司','最新动态','5');
       				  	for($i=0;$i<count($newslist);$i++) {
      					?>
      					<div class="center_content">・<a target="_blank" href="news.php?id=<? echo $newslist[$i]->id;?>" ><?php echo $newslist[$i]->short_title;?></a></div><div class="con_time"><?php echo $newslist[$i]->created_at;?></div>
      					<?php }?>
				</div>
      					<div class="more"><a href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">More</a></div>
              </div>
          
              <div  class="center_lm">业界资讯</div>
              <div  class="center_nr">
              	<div style="height:85px;">
              	<?php
								$newslist = show_content('smg_news','news','上海文广数字移动传播有限公司','业界资讯','5');
       			  	for($i=0;$i<count($newslist);$i++) {
      					?>
      					<div class="center_content">・<a target="_blank" href="news.php?id=<? echo $newslist[$i]->id;?>" ><?php echo $newslist[$i]->short_title;?></a></div><div class="con_time"><?php echo $newslist[$i]->created_at;?></div>
      					<?php }?>
				</div>
      					<div class="more"><a href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">More</a></div>
              </div>
                  
        	</div>
        
        	<div  class="siteinfo">
        		
        	</div>
        </DIV>
           
    </div>

</div>
</body>
</html>