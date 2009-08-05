	<div id=right>	
		<div style="display:inline;">
				<?php
					$video = load_module('sp',1);
				  ShowMediaPlay(216,230,$video->items[0]->photourl,$video->items[0]->videourl);		  
				?>	
		</div>
		<div id=search><div id=content><input type="text" name="textfield" id="textfield" /><input type="button" OnClick="searchnews('textfield')" value="搜索"></div></div>
			<div class=title1><img src="images/sj2.jpg" style="margin-left:16px; "> 关于我们</div>
			<div class=content style="width:200px; padding-left:16px; background:#FF3366;"><a style="margin-top:10px;" target="_blank" href="">·关于我们</a></div>
			<div class=title1><img src="images/sj2.jpg" style="margin-left:16px;" ></div>
			<div class=content>
				<a href="mail:to"><img border=0 src="images/mail.jpg"></a>
			</div>
			<div class=content>
				<div id=tj>访问统计</div>
				<? $report=getcategoryreport();
					 for($i=0;$i< $report->itemcount;$i++){?>
					<div class=content style="width:200px; height:30px; line-height:20px; padding-left:16px; background:#FF3366; float:left; display:inline; "><div style="width:100px; height:20px; margin-top:10px; float:left; display:inline; "><? echo $report->items[$i]->name;?></div><div style="width:50px; height:20px; margin-top:10px; float:left; display:inline; margin-left:40px; text-align:right;"><? echo $report->items[$i]->clickcount;?></div></div>
				<? }?>
			</div>
			<div class=title2><img src="images/sj2.jpg">文明链接<img style="margin-left:120px;" src="images/right_titlepic.jpg">
				<div style="width:216px; height:15px; margin-top:10px; margin-left:-17px; padding-left:10px;  border-bottom:1px dashed #ffffff; float:left; display:inline;">
				</div>
				<?php
				$link = load_module('Index_Right_5',6);
      	?>
				<div class=content style="width:200px;">
					<? for($i=0;$i<6;$i++){?>
						<a style="width:200px; font-weight:normal; margin-top:7px; margin-left:10px; float:left; display:inline;" target="_blank" href="<? echo $link->items[$i]->link;?>">·<?php echo $link->items[$i]->name;?></a>
					<? }?>
				</div>
			</div>
			<div id=bottom>
				<div class=title>
					　<img src="images/right_titlepic2.jpg">　常用表格软件下载
				</div>
				<div style="margin-top:10px; float:left display:inline;">
					<? $newslist = load_module('jswmb_cybg',6);?>
					<? for($i=0;$i<$newslist->itemcount;$i++){?>
						<a style="width:180px; margin-top:7px; margin-left:25px; color:#192C54; float:left; display:inline;" target="_blank" href="content.php?id=<?php echo $newslist->items[$i]->id;?>">
							<?php 
								if(strlen($newslist->items[$i]->shorttitle)<24){
									echo $newslist->items[$i]->shorttitle;
								}else{
									$title=msubstr($newslist->items[$i]->shorttitle,0,20);
									echo $title."...";
								}	
							?>	
						</a>
					<? }?>
				</div>
				
			</div>
		</div>