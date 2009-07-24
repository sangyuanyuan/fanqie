<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-摄影主页</title>
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
				$category_id = category_id_by_name('摄影主页','picture');
				$db = get_db();
				$images = new smg_images_class();
				$records = $images->find('all',array('conditions' => 'is_adopt=1 and src is not null and category_id='.$category_id,'limit' => '12','order' => 'created_at desc'));
				$count = count($records);
				for($i=0; $i<$count;$i++){ 
			?>
				
				<div class=img><img id="<?php echo $i+1;?>" style="cursor:pointer;" class="small_pic" border=0 width=110 height=72 src="<?php echo $records[$i]->src_path('small');?>" name="<?php echo $records[$i]->src;?>" value="show.php?id=<?php echo $records[$i]->id;?>"></div>
			  <?php }?>
	 	  </div>
	 	  <div id=t_r><a href="<?php echo $records[0]->url?>" target="_blank" id="pic_url"><img border=0 id="big_pic" width="518" height="236" src="<?php echo $records[0]->src?>"></a></div>
	 </div>	
	 <div id=ibody_left>
		  	<a target="_blank" href="show_sub.php?type=image"><img border=0 src="/images/show/show_l_t.jpg" width="285"></a>
			<div class=l_m>
				<div class=title><div class=left>热门标签</div></div>
				<div class=content style="border-bottom:none;">
				<?php
					$sql = 'select keywords from smg_images where keywords!="" order by click_count desc limit 10';
					$records = $db->query($sql);
					$c = array();
					for($i=0;$i<count($records);$i++){
						$keywords = explode(',', $records[$i]->keywords);
						if(count($keywords)==0)$keywords = explode('，', $records[$i]->keywords);
						if(count($keywords)==0)$keywords = explode('　', $records[$i]->keywords);
						if(count($keywords)==0)$keywords = explode(' ', $records[$i]->keywords);
						for($j=0;$j<count($keywords);$j++){
							if(!in_array($keywords[$j],$c))array_push($c,$keywords[$j]);
						}
						$keywords = '';
					}
					for($i=0;$i<count($c);$i++){
				?>
				<a class="tag<?php echo rand(1, 6);?>" href="/search/?key=<?php echo urlencode($c[$i]);?>&search_type=smg_images"><?php echo $c[$i];?></a>
				<?php } ?>
				
				</div>
			</div>
			<div class=l_m2>
			<?php
				$db = get_db();
				$sql = 'select i.id,i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
				$record_ad=$db -> query($sql);
			?>
			<script src="/flash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script type="text/javascript"> 
				var pic_width1=287; 
				var pic_height1=190; 
				var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src ?>";
				var mylinks1="<?php echo "show.php?id=".$record_ad[0]->id.",show.php?id=".$record_ad[1]->id.",show.php?id=".$record_ad[2]->id.",show.php?id=".$record_ad[3]->id ?>";
				var texts1=<?php echo '"',flash_str_replace($record_ad[0]->title).",".flash_str_replace($record_ad[1]->title).",".flash_str_replace($record_ad[2]->title).",".flash_str_replace($record_ad[3]->title).'"'; ?>;
	
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "287", "190", "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics1);
				picflash.addVariable("piclink",mylinks1);
				picflash.addVariable("pictext",texts1);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","287");
				picflash.addVariable("borderheight","190");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
			</script> 
			</div>
		  	<div class=l_m>
				<div class=title><div class=left>用户排行榜</div></div>
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
							<div class=top><a href="show_list.php?name=<?php echo $records[$i]->publisher;?>&type=image"><?php echo $records[$i]->publisher; ?></a></div>
							<div class=bottom>发布了<?php echo $records[$i]->num; ?>张图片！</div>
						</div>
					</div>
				<? }?>
			</div>
		</div>
		<div id=ibody_right>
		  	<div id=r_t>
		  		<div class=left>边走边摄</div>
				<div class=more><a target="_blank" href="list.php?type=image">更多</a></div>
		  	</div>
			<div class=r_b>
			<?php
				$sql="select t1.* from smg_images t1 join smg_category t2 on t1.category_id=t2.id where t1.is_adopt=1 and t1.publisher is not null and t2.platform='show' order by t1.priority asc,t1.created_at desc";
				$records = $db->paginate($sql,16);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=pic><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=75 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=title><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher>作者：<?php if($records[$i]->publisher!=''){echo $records[$i]->publisher;}else{echo get_dept_info($records[$i]->dept_id)->name;}?></div>
					<div class=keywords><?php echo $records[$i]->created_at;?></div>
					<div class=keywords>点击：<?php echo $records[$i]->click_count;?>次</div>
				</div>
			<?php } ?>
			<div id=paginate><?php paginate();?></div>
			</div>
		</div>

</div>
<?php
	close_db();
	require_once('../inc/bottom.inc.php');
?>


</body>
</html>

<script>
	var num=1;
	
	$(function(){
		$(".small_pic").click(function(){
			$("#big_pic").attr('src',$(this).attr('name'));
			$("#pic_url").attr('href',$(this).attr('value'));
		});
		
		$("[class*=tag]").click(function(){
			//window.location.href="list.php?tag="+$(this).html()+"&type=show";
		})
	});
	
	function change(){
		num = boundrandom(1,12);
		$("#big_pic").attr('src',$("#"+num).attr('name'));
		$("#pic_url").attr('href',$("#"+num).attr('value'));
	}
	
	function boundrandom(bound1, bound2) {
        return parseInt(Math.random() * (bound1 - bound2) + bound2);
    }

	
	setInterval(change,5000);
	
	
	//$("#pic_url").attr('href',$(this).attr('value'));
	
</script>