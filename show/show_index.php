<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-我型我秀主页</title>
	<?php
		css_include_tag('show_show_index','top','bottom');
		use_jquery();
		
  	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_top>
	 	  <div id=t_l>
	  		<?php 
				$images = new smg_images_class();
				$records = $images->find('all',array('conditions' => 'is_adopt=1','limit' => '12','order' => 'created_at desc'));
				$count = count($records);
				for($i=0; $i<$count;$i++){ 
			?>
				
				<div class=img><img style="cursor:pointer;" class="small_pic" border=0 width=110 height=72 src="<?php echo $records[$i]->src_path('small');?>" name="<?php echo $records[$i]->src;?>" value="<?php echo $records[$i]->url;?>"></div>
			  <?php }?>
	 	  </div>
	 	  <div id=t_r><a href="<?php echo $records[0]->url?>" target="_blank" id="pic_url"><img border=0 id="big_pic" width="518" height="236" src="<?php echo $records[0]->src?>"></a></div>
	 </div>	
	 <div id=ibody_left>
		 	<div id=l_t>
		 	 	 <div id=top><img src="/images/show/show_index_l_t.jpg">　公告</div>
		 	</div>
		  	<a target="_blank" href="#"><img border=0 src="/images/show/show_l_t.jpg"></a>
			<div class=l_m>
				<div class=title><div class=left>热门标签</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
				<div class=content style="border-bottom:none;"></div>
			</div>
			<div class=l_m2>
			<?php
				$db = get_db();
				$sql = 'select i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
				$record_ad=$db -> query($sql);
			?>
			<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script type="text/javascript"> 
				var pic_width1=276; 
				var pic_height1=146; 
				var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src ?>";
				var mylinks1="/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php";
				var texts1="<?php echo $record_ad[0]->title.",".$record_ad[1]->title.",".$record_ad[2]->title.",".$record_ad[3]->title ?>";
	
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "287", "146", "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics1);
				picflash.addVariable("piclink",mylinks1);
				picflash.addVariable("pictext",texts1);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","287");
				picflash.addVariable("borderheight","146");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
			</script> 
			</div>
		  	<div class=l_m>
				<div class=title><div class=left>用户排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
				<?php
					$db = get_db();
					$sql = 'SELECT publisher,count(*) as num FROM smg_images where publisher!="" group by publisher limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
					<div class=content <?php if($i==$count-1){?>style="border-bottom:none;"<?php }?>>
						<div class=left><? echo $i+1;?></div>
						<div class=right>
							<div class=top><a href="show_list.php?name=<?php echo $records[$i]->publisher;?>"><?php echo $records[$i]->publisher; ?></a></div>
							<div class=bottom>发布了<?php echo $records[$i]->num; ?>张图片！</div>
						</div>
					</div>
				<? }?>
			</div>
		</div>
		<div id=ibody_right>
		  	<div id=r_t>
		  		<div class=left>边走边播</div>
				<div class=more><a target="_blank" href="list.php">更多</a></div>
		  	</div>
			<div class=r_b>
			<?php
				$images = new smg_images_class();
				$records = $images->paginate('all',array('order' => 'priority'),24);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=pic><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=75 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=title><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=keywords>[<?php if($records[$i]->keywords!=''){echo $records[$i]->keywords;}else{echo '图片';}?>]</div>
				</div>
			<?php } ?>
			<div id=paginate><?php paginate();?></div>
			</div>
		</div>

</div>
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>

<script>
	$(function(){
		$(".small_pic").click(function(){
			$("#big_pic").attr('src',$(this).attr('name'));
			$("#pic_url").attr('href',$(this).attr('value'));
		});
	});
</script>