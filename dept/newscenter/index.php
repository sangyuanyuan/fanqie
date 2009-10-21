<?php
	 require_once('../../frame.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>新闻中心内网</title>
	<?php 
		use_jquery();
		js_include_once_tag('total');
	?>
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<script>
	total("新闻中心","news");	
</script>
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
				<marquee height="160" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
				<?php
					for($i=0;$i<$count;$i++) {
						
				?>
				<li><a title="<?php echo $records[$i]->title; ?>" href="news.php?id=<?php echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php
						echo $records[$i]->short_title;
					?>
					</a>
				</li>
				<?php } ?>
				</marquee>
		</div>
		
		<div class="normaltitle1">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','规章制度','8');
				$count = count($records);
      		?>
			规章制度
      		<span class="more"><a href="newslist.php?id=<?php echo dept_category_id_by_name('规章制度','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php
	          		echo $records[$i]->short_title;
		          ?>
			</a></li>
			<?php } ?>
		</div>
		
		<div class="normaltitle1">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','常用表格下载','8');
				$count = count($records);
      		?>
			常用表格下载
      		<span class="more4"><a href="newslist.php?id=<?php echo dept_category_id_by_name('常用表格下载','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a title="<?php echo $records[$i]->title; ?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php  
		          		echo $records[$i]->short_title;
			    ?>
			</a></li>
			<?php } ?>
		</div>
		
		<div class="normaltitle1">
			收视率查询
		</div>
		<div class="normalbox2">
			<iframe src="/index_report.html" style="margin-top:10px; margin-left:30px;" height="200" width=170 frameborder=0 scrolling="no" ></iframe>
		</div>
	</div>
	
	<div id="center">
		<div id="flash">
			<?php 
				$record = show_content('smg_images','picture','电视新闻中心','flash','4');
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
				var pic_width=443; 
				var pic_height=200;
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
		</div>
		<div class="normaltitle2">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','今日头条','8');
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
				<li><a title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php 
	          			echo $records[$i]->title;
		       		?>
				</a></li>
				<?php } ?>
			</div>
			<div class="pic">
				<?php
						for($i=0;$i<$count;$i++) {
							if($records[$i]->photo_src != ""){
				?>
				<img border="0" src="<? echo $records[$i]->photo_src;?>" width="100" height="150">
				<?php
						break;}
					}
				?>
			</div>
		</div>
		<div class="normaltitle2">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','部门快讯','8');
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
				<li><a title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php 
	          			echo $records[$i]->title;
		       		?>
				</a></li>
				<?php } ?>
			</div>
			<div class="pic">
				<?php
						for($i=0;$i<$count;$i++) {
							if($records[$i]->photo_src != ""){
				?>
				<img border="0" src="<? echo $records[$i]->photo_src;?>" width="100" height="150">
				<?php
						break;}
					}
				?>
			</div>
		</div>
		<div class="normaltitle2">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','党建创建','8');
				$count = count($records);
      		?>
			党建创建
      <span class="more2"><a href="newslist.php?id=<?php echo dept_category_id_by_name('党建创建','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox3">
			<div class="box">
				<?php
						for($i=0;$i<$count;$i++) {
				?>
				<li><a title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
					<?php 
	          			echo $records[$i]->title;
		       		?>
				</a></li>
				<?php } ?>
			</div>
			<div class="pic">
				<?php
						for($i=0;$i<$count;$i++) {
							if($records[$i]->photo_src != ""){
				?>
				<img border="0" src="<? echo $records[$i]->photo_src;?>" width="100" height="150">
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
	      <marquee height="100" onmouseover=this.stop() onmouseout=this.start() scrollamount=3>
	 				<?php for($i=0;$i<$count;$i++){?>  
	 				<div class="photo_all">       					
	 					<a target="_blank" href="/show/show.php?id=<? echo $records[$i]->id;?>" style="float:left; display:inline; "><img border="0" src="<? echo $records[$i]->src;?>" width="70" height="70" ></a>
	 					<div style="width:70px; height:15px; overflow:hidden;"><a target="_blank" href="/show/show.php?id=<? echo $records[$i]->id;?>" style="width:70px; text-align:center; float:left; display:inline; "><? echo $records[$i]->title;?></a></div>
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
				<marquee height="153" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
				<?php
					$db = get_db();
					$sql = 'select t1.nickname,t1.gender,t2.name from smg_user_real t1 join smg_org_dept t2 on t1.org_id=t2.orgid where t1.birthday_short="'.date("m-d").'" and t1.hide_birthday=0 and t2.parentid="ORGA007526"';
					$birthday = $db->query($sql);
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
				$records = show_content('smg_news','news','电视新闻中心','深度思考','8');
				$count = count($records);
      		?>
			深度思考
     		<span class="more3"><a href="newslist.php?id=<?php echo dept_category_id_by_name('深度思考','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox4">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php 
          			echo $records[$i]->short_title;
	       		?>
			</a></li>
			<?php } ?>
		</div>
		<div class="normaltitle3">
			<?php
				$records = show_content('smg_news','news','电视新闻中心','资料交流','8');
				$count = count($records);
      		?>
			资料交流
      <span class="more3"><a href="newslist.php?id=<?php echo dept_category_id_by_name('资料交流','电视新闻中心','news');?>">more>></a></span>
		</div>
		<div class="normalbox4">
			<?php
					for($i=0;$i<$count;$i++) {
			?>
			<li><a title="<?php echo $records[$i]->title;?>" href="news.php?id=<? echo $records[$i]->id;?>" target="_blank" class="blue">
				<?php 
          			echo $records[$i]->short_title;
	       		?>
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
		<div class="normalbox4" >
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

<script type="text/javascript">     
$(function(){
		
		$("#dept_search").click(function(){
			window.location.href='/search/?key='+encodeURI($("#textfield").val())+'&search_type=smg_news';
		})
	});
</script>