<?php
	 require_once('../frame.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>新闻中心内网</title>
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="bg">	
	<?php include("inc/topbar.inc.php");?>
	
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
				<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
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
			<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
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
      		<span class="more4"><a href="newslist.php?id=<?php echo dept_category_id_by_name('常用表格下载','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
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
			收视率查询
		</div>
		<div class="normalbox2">
			<?php //include('http://172.27.203.88/rd/datacsmselect.asp'); ?>
		</div>
	</div>
	
	<div id="center">
		<div id="flash">
			<?php
      			$records = show_content('smg_images','picture','电视新闻中心','flash','4');
				$count = count($records);
      			for ($i=0;$i<$count;$i++)
				{
					$picsurl[]=$records[$i]->src;
					$picslink[]=$records[$i]->url;
				}
     		 ?>
              
    	<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<!-- 图片播放器开始 -->
				<div id="focus_01"></div> 
				<script type="text/javascript"> 
				var pic_width=443; //图片宽度
				var pic_height=200; //图片高度
				var pics="<?php echo implode(',',$picsurl);?>";
				var mylinks="<?php echo implode(',',$picslink);?>";
 
				var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "443", "200", "6","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics);
				picflash.addVariable("piclink",mylinks);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","443");
				picflash.addVariable("borderheight","200");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","0");				
				picflash.addVariable("pic_width",pic_width);
				picflash.addVariable("pic_height",pic_height);
				
				picflash.write("focus_01");				
				</script> 	
		</div>
		<div class="normaltitle2">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','今日头条','10');
				$count = count($records);
      		?>
			今日头条
      <span class="more2"><a href="newslist.php?id=<?php echo dept_category_id_by_name('今日头条','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox3">
			<div class="box">
				<?php
						for($i=0;$i<$count;$i++) {
				?>
				<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php  
						if(strlen($records[$i]->short_title)>40)
    				{
    					echo substr($records[$i]->short_title,0,40).'...';
    				}
    				else 
						{
          		echo $records[$i]->short_title;
	          }
	         ?>
				</a></li>
				<?php } ?>
			</div>
			<div class="pic">
				<?php
						for($i=0;$i<$count;$i++) {
							if($records[$i]->photo_src != ""){
				?>
				<img border="0" src="<? echo $records[$i]->photo_src;?>" width="100" height="120">
				<?php
						break;}
					}
				?>
			</div>
		</div>
		<div class="normaltitle2">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','部门快讯','10');
				$count = count($records);
      		?>
			部门快讯
      <span class="more2"><a href="newslist.php?id=<?php echo dept_category_id_by_name('部门快讯','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox3">
			<div class="box">
				<?php
						for($i=0;$i<$count;$i++) {
				?>
				<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php  if(strlen($records[$i]->short_title)>40)
	    				{
	    					echo substr($records[$i]->short_title,0,40).'...';
	    				}
	    				else 
							{
	          		echo $records[$i]->short_title;
		          }
		      ?>
				</a></li>
				<?php } ?>
			</div>
			<div class="pic">
				<?php
						for($i=0;$i<$count;$i++) {
							if($records[$i]->photo_src != ""){
				?>
				<img border="0" src="<? echo $records[$i]->photo_src;?>" width="100" height="120">
				<?php
						break;}
					}
				?>
			</div>
		</div>
		<div class="normaltitle2">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','党建创建','10');
				$count = count($records);
      		?>
			今日头条
      <span class="more2"><a href="newslist.php?id=<?php echo dept_category_id_by_name('党建创建','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox3">
			<div class="box">
				<?php
						for($i=0;$i<$count;$i++) {
				?>
				<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php 
							if(strlen($records[$i]->short_title)>40)
	    				{
	    					echo substr($records[$i]->short_title,0,40).'...';
	    				}
	    				else 
							{
	          		echo $records[$i]->short_title;
		          }
		       ?>
				</a></li>
				<?php } ?>
			</div>
			<div class="pic">
				<?php
						for($i=0;$i<$count;$i++) {
							if($records[$i]->photo_src != ""){
				?>
				<img border="0" src="<? echo $records[$i]->photo_src;?>" width="100" height="120">
				<?php
						break;}
					}
				?>
			</div>
		</div>
		<div id="show">
			<div id="photo">
				<?php
					$records = show_content('smg_images','picture','电视新闻中心','我型我秀',10);
					$count = count($records);
	      		?>
	      <marquee height="133" onmouseover=this.stop() onmouseout=this.start() scrollamount=3>
	 				<? for($i=0;$i<$count;$i++){?>  
	 				<div class="photo_all">       					
	 					<a target="_blank" href="/photo/showphoto.php?id=<? echo $records[$i]->id;?>" style="float:left; display:inline; "><img border="0" src="<? echo $records[$i]->src;?>" width="70" height="70" ></a>
	 					<a target="_blank" href="/photo/showphoto.php?id=<? echo $records[$i]->id;?>" style="width:70px; text-align:center; float:left; display:inline; "><? echo $records[$i]->title;?></a>
	 				</div>
	 				<? }?>
	 			</marquee>
	 		</div>
		</div>
	</div>
	
	<div id="right">
		<div id="box">
			<div id="title">
			生日快乐
			</div>
			<div id="boxb">
				<marquee height="143" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
				<?php
					for($i=0;$i< count($birthday);$i++) {
				?>
				<li>
				<img src="<?php if($birthday[$i]->gender == '男') echo '/images/icon/boy.gif'; else echo '/images/icon/girl.gif';?>">　<span style="color:#000000;"><?php echo $birthday[$i]->nickname;?>[</span><? echo $birthday[$i]->name;?><span style="color:#000000;">]</span>
				</li>
				<?php } ?>
				</marquee>
			</div>
		</div>
		<div class="normaltitle3">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','深度思考','10');
				$count = count($records);
      		?>
			深度思考
     		<span class="more3"><a href="newslist.php?id=<?php echo dept_category_id_by_name('深度思考','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox4">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php  echo $records[$i]->short_title;?>
			</a></li>
			<?php } ?>
		</div>
		<div class="normaltitle3">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','资料交流','10');
				$count = count($records);
      		?>
			资料交流
      <span class="more3"><a href="newslist.php?id=<?php echo dept_category_id_by_name('资料交流','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox4">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a target="_blank" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php  echo $records[$i]->short_title;?>
			</a></li>
			<?php } ?>
		</div>
		<div id="botton">
			<div class="btn1">
				<a href="http://222.68.17.191:8080/Index_Online/Index.html"  target="_blank"><img border=0 src="images/s1.jpg"></a>
			</div>
			<div class="btn2">
				<a href="yhzs.php"  target="_blank"><img border=0 src="images/s2.jpg"></a>
			</div>
			<div class="btn1">
				<a href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=46"  target="_blank"><img border=0 src="images/s3.jpg"></a>
			</div>
			<div class="btn2">
				<a href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=46"  target="_blank"><img border=0 src="images/s4.jpg"></a>
			</div>
		</div>
		<div class="normaltitle3">
			<?php
				$records = show_content('smg_link','link','电视新闻中心','相关链接','10');
				$count = count($records);
     		?>
			相关链接
		</div>
		<div class="normalbox5" >
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a target="_blank" href="<? echo $records[$i]->link;?>" target="_blank" class="blue">
				<?php echo $records[$i]->name;?>
			</a></li>
			<?php } ?>
		</div>
	</div>
	
	<div id="bottom">
	</div>
</div>		
</body>
</html>
