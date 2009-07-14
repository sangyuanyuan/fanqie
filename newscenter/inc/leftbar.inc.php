<link href="css/left.css" rel="stylesheet" type="text/css">

<div id="left">
	<div class="normaltitle1">
		<?php
				$records = show_content('smg_news','news','电视新闻中心','最新公告','10');
				$count = count($records);
     		?>
			最新公告
	</div>
	<div class="normalbox">
			<marquee height="143" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
			<?php
				for($i=0;$i<$count;$i++) {
					
			?>
			<li>·<a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php
					if(strlen($records[$i]->short_title)>20){
    					echo substr($records[$i]->short_title,0,20).'...';
    				}else{
          				echo $records[$i]->short_title;
	         		}
				?>
				</a>
			</li>
			<?php } ?>
			</marquee>
	</div>
	
	<div class="normaltitle1">
		<?php
			$records = show_content('smg_news','news','电视新闻中心','规章制度','10');
			$count = count($records);
  		?>
		规章制度
  		<span class="more"><a href="newslist.php?id=<?php echo dept_category_id_by_name('规章制度','电视新闻中心','news');?>">more>></a></span>
	</div>

	<div class="normalbox">
		<?php
				for($i=0;$i<$count;$i++) {
		?>
		<li>·<a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
			<?php  if(strlen($records[$i]->short_title)>20)
				{
					echo substr($records[$i]->short_title,0,20).'...';
				}
				else 
					{
      		echo $records[$i]->short_title;
          }
          ?>
		</a></li>
		<?php } ?>
	</div>
	
	<div class="normaltitle1">
		<?php
			$records = show_content('smg_news','news','电视新闻中心','常用表格下载','10');
			$count = count($records);
  		?>
		常用表格下载
  		<span class="more2"><a href="newslist.php?id=<?php echo dept_category_id_by_name('常用表格下载','电视新闻中心','news');?>">more>></a></span>
	</div>
	<div class="normalbox">
		<?php
				for($i=0;$i<$count;$i++) {
		?>
		<li>·<a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
			<?php  if(strlen($records[$i]->short_title)>20)
				{
					echo substr($records[$i]->short_title,0,20).'...';
				}
				else 
					{
      		echo $records[$i]->short_title;
          }
      ?>
		</a></li>
		<?php } ?>
	</div>
	
	<div class="normaltitle1">
		<?php
			$records = show_content('smg_link','link','电视新闻中心','相关链接','10');
			$count = count($records);
 		?>
		相关链接
	</div>
	<div class="normalbox2" >
		<?php
				for($i=0;$i<$count;$i++) {
		?>
		<li>·<a target="_blank" href="<? echo $records[$i]->link;?>" target="_blank" class="blue">
			<?php echo $records[$i]->name;?>
		</a></li>
		<?php } ?>
	</div>
</div>