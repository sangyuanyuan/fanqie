	<div id=right>	
		<div>
			<A href="http://www.expo2010china.com/">
        <DIV style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; BACKGROUND: url(images/expo.jpg) ; PADDING-BOTTOM: 0px; MARGIN: 0px; WIDTH: 215px; CURSOR: hand; PADDING-TOP: 0px; HEIGHT: 39px">
           <DIV style="BORDER-TOP-WIDTH: 0px; margin-left:85px; margin-top:-3px; PADDING-RIGHT: 500; PADDING-LEFT: 0px; FONT-WEIGHT: bold; BORDER-LEFT-WIDTH: 0px; FONT-SIZE: 18px; BACKGROUND: #fffffd; LEFT: 87px; BORDER-BOTTOM-WIDTH: 0px; PADDING-BOTTOM: 0px; VERTICAL-ALIGN: baseline; WIDTH: 30px; COLOR: #ff3535; PADDING-TOP: 0px; POSITION: relative; TOP: 13px; HEIGHT: 20px; BORDER-RIGHT-WIDTH: 0px">
              <SCRIPT type=text/javascript>var nowDate=new Date();var expoDate=new Date();expoDate.setFullYear(2010,4,1);document.write((expoDate-nowDate)/(1000*3600*24));</SCRIPT>
        </DIV></DIV></A>
		</div>
		<div style="display:inline;">
				<?php
					$records = show_content('smg_video','video','精神文明办','视频','1');
					show_video_player(216,230,$records[0]->photo_url,$records[0]->video_url);
				?>	
		</div>
		<div id=search><div id=content><input type="text" name="textfield" id="textfield" /><input type="button" OnClick="searchnews('textfield')" value="搜索"></div></div>
			<div class=title1><img src="images/sj2.jpg" style="margin-left:16px; "> 关于我们</div>
			<div class=content style="width:200px; padding-left:16px; background:#FF3366;"><a style="margin-top:10px;" target="_blank" href="about_us.php">・关于我们</a></div>
			<div class=title1><img src="images/sj2.jpg" style="margin-left:16px; "> 绿番茄</div>
			<div class=content style="text-align:center;"><a target="_blank" href="/jswmb/newslist.php?id=<?php echo dept_category_id_by_name('绿番茄','精神文明办','news');?>"><img width=100 height=85 border=0 src="/images/pic/greentomato.gif"></a></div>
			<div class=content>
				<div id=tj>访问统计</div>
				<? //$report=getcategoryreport();
					// for($i=0;$i< 4;$i++){?>
					<div class=content style="width:200px; height:118px; line-height:20px; padding-left:16px; background:#FF3366; float:left; display:inline; "><div style="width:100px; height:20px; margin-top:10px; float:left; display:inline; "><? echo $report->items[$i]->name;?></div><div style="width:50px; height:20px; margin-top:10px; float:left; display:inline; margin-left:40px; text-align:right;"><? echo $report->items[$i]->clickcount;?></div></div>
				<?// }?>
			</div>
			<div class=title2><img src="images/sj2.jpg">文明链接<img style="margin-left:120px;" src="images/right_titlepic.jpg">
				<div style="width:216px; height:15px; margin-top:10px; margin-left:-17px; padding-left:10px;  border-bottom:1px dashed #ffffff; float:left; display:inline;">
				</div>
				<?php
				$link = show_content('smg_link','link','精神文明办','文明链接','6');
				$count = count($link);
      			?>
				<div class=contentt style="width:200px;">
					<? for($i=0;$i<$count;$i++){?>
						<a style="width:200px; font-weight:normal; margin-top:7px; margin-left:10px; float:left; display:inline;" target="_blank" href="<? echo $link[$i]->link;?>">・<?php echo $link[$i]->name;?></a>
					<? }?>
				</div>
			</div>
			<div id=bottom>
				<div class=title>
					　<img src="images/right_titlepic2.jpg">　常用表格软件下载
				</div>
				<div style="margin-top:10px; float:left display:inline;">
					<? $newslist = show_content('smg_news','news','精神文明办','相关表格软件下载','2')?>
					<? for($i=0;$i<count($newslist);$i++){?>
						<a style="width:180px; height:20px; overflow:hidden; line-height:20px; margin-top:7px; margin-left:25px; color:#192C54; float:left; display:inline;" target="_blank" title="<?php echo $newslist[$i]->title ?>" href="content.php?id=<?php echo $newslist[$i]->id;?>">
							<?php echo $newslist[$i]->short_title;?>
						</a>
					<? }?>
				</div>
				
			</div>
		</div>