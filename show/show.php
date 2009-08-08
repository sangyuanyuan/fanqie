<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
	$image = new smg_images_class();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-摄影</title>
	<?php
		css_include_tag('show_show','top','bottom');
		use_jquery();
		js_include_tag('pubfun','total');
  	?>
</head>
<script>
	total("图片内页","show");	
</script>
<body>
<? require_once('../inc/top.inc.html');
	$image->find($id);
	if($image->url!=''){
		$image->click_count = $image->click_count+1;
		$image->save();
		redirect($image->url);
	}
?>
<div id=ibody>	
 <div id=ibody_left>
 	  	<div id=l_t>
	 	  	<a target="_blank" href="show_sub.php?type=image"><img border=0 src="/images/show/show_l_t.jpg" width="290"></a>
			<?php 
				$db = get_db();
				$sql = 'select i.id as img_id,i.title,i.src,i.priority as ipriority from smg_images i left join smg_category c on i.category_id=c.id where i.priority=0 and i.is_adopt=1 and c.name="番茄广告" and c.platform="show" order by i.priority asc,i.created_at desc limit 4';
				$record_ad=$db -> query($sql);
				$count = count($record_ad);
				for($i=0;$i<$count;$i++){
					$picsurl[]=$record_ad[$i]->src;
					$picslink[]='/show/show.php?id='.$record_ad[$i]->id;
					$picstext[]=flash_str_replace($record_ad[$i]->title);
				}
			?>
			
			<?php if($count==1){?>
				<a href="/show/show.php?id=<?php echo $record_ad[0]->img_id?>" target=_blank><img src="<?php echo $record_ad[0]->src?>" width=286px; height=187px; border=0></a>
			<? }else{?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<div id="focus_02"></div> 
				<script type="text/javascript"> 
				var pic_width1=287; //图片宽度
				var pic_height1=190; //图片高度
				var pics="<?php echo implode(',',$picsurl);?>";
				var mylinks="<?php echo implode(',',$picslink);?>";
				var texts="<?php echo implode(',',$picstext);?>";
				
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", pic_width1, pic_height1, "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics);
				picflash.addVariable("piclink",mylinks);
				picflash.addVariable("pictext",texts);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth",pic_width1);
				picflash.addVariable("borderheight",pic_height1);
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
				</script>		
			<? }?>
 	  	</div>
		<div class=l_m>
			<div class=title><div class=left>用户排行榜</div></div>
			<?php
				$sql = 'SELECT t1.publisher,count(t1.title) as num FROM smg_images t1 join smg_category t2 on t1.category_id=t2.id where t1.publisher!="" and t1.is_adopt=1 and t1.publisher!="admin" and t2.platform="show" group by t1.publisher limit 5';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content <?php if($i==$count-1){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=right>
						<div class=top><a target="_blank" href="list.php?publisher=<?php echo urlencode($records[$i]->publisher);?>"><?php echo $records[$i]->publisher; ?></a></div>
						<div class=bottom>发布了<?php echo $records[$i]->num; ?>张图片！</div>
					</div>
				</div>
			<? }?>
		</div>
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
			<a class="tag<?php echo rand(1, 6);?>" target="_blank" href="/search/?key=<?php echo urlencode($c[$i]);?>&search_type=smg_images"><?php echo $c[$i];?></a>
			<?php } ?>
			</div>
		</div>
 </div>
 <div id=ibody_right>
	    <div id=r_t>
	    	<?php if($image->src==''){?>
			对不起！你所访问的图片链接有错误，请与管理员联系
			<?php }else{
				$image->click_count = $image->click_count+1;
				$image->save();	
			?>
		  	<div id="image">
			  	<a target="_blank" href="<?php echo $image->src;?>">
			  		<img border=0 src="<?php echo $image->src?>" width="670" height="420">
				</a>
			</div>
			<div class=digg>
				<div id="flower" title="送鲜花">
					<?php echo $image->flower;?>
					<input type="hidden" id="hidden_flower" value="<?php echo $image->flower!=''?$image->flower:0;?>">
				</div>
				<div id="tomato" title="丢番茄">
					<?php echo $image->tomato;?>
					<input type="hidden" id="hidden_tomato" value="<?php echo $image->tomato!=''?$image->tomato:0;?>">
				</div>
				<input type="hidden" id="image_id" value="<?php echo $id;?>">
			</div>
			<?php }?>
	    </div>
	  
	  
	  	<div id="info">
	  		<div class=title>图片信息</div>
			<div class=content>
				<div class=top>
					<div id=name>图片名称：<?php echo $image->title;?></div>
				</div>
				<div class=center>
					<div class=left>
						<div class=title>发布者：</div>
						<div id=publisher><?php echo $image->publisher;?></div>
					</div>
					<div class=middle>
						<div class=title>发布于：</div>
						<div id=date><?php echo substr($image->created_at, 0, 10);?></div>
					</div>
					<div class=right>
						<div class=title>该图片被点击：</div>
						<div id=count><?php echo $image->click_count;?></div>
					</div>
				</div>
				<div class=bottom>
					<div class=title>图片简介：</div>
					<div id=description><?php echo $image->description;?></div>
				</div>
				
			</div>
		</div>
		
		<div id=r_b>
			<div id=r_b_l>
				<div class=title>网友评论</div>
				<?php 
					$comment = new table_class('smg_comment');
					$records = $comment->find('all',array('conditions' => 'resource_type="picture" and resource_id='.$id));
					$count2 = count($records);
					$records = $comment->paginate('all',array('conditions' => 'resource_type="picture" and resource_id='.$id,'order' => 'created_at desc'),6);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
					<div class=content>
						<div class=r>
							<div class=t><?php echo $records[$i]->nick_name?></div>
							<div class=b><?php echo $records[$i]->comment?></div>
						</div>
					</div>
				<?php }?>
				<div id=paginate><?php paginate();?></div>
				<div id=comment_box <?php if($image->commentable!="on"){?>style="display:none;"<?php } ?>>
					<form id="comment_form" action="/pub/pub.post.php" method="post">
						<div class=title>现在有<span style="color:#FF5800"><?php echo $count2;?></span>人发表评论</div>
						<div id=commenter_box><input type="text" style="width:330px;" id="c_n_n" name="post[nick_name]"></div>
						<input type="hidden" name="post[resource_id]" value="<?php echo $id;?>">
						<input type="hidden" name="post[resource_type]" value="picture">
						<input type="hidden" name="type" value="comment">
						<div id="commit_fck"><?php show_fckeditor('post[comment]','Title',false,'75','','334');?></div>
						<div id=fqbq></div>
						<div id=submit_comment></div>
					</form>
				</div>
			</div>
			
			<div id=r_b_r>
				<div class=title>更多该用户的照片</div>
				<?php
					$images = new smg_images_class();
					$records = $images->find('all',array('conditions' => 'is_adopt=1 and src is not null and publisher="'.$image->publisher.'" and id!='.$id,'limit' => '8'));
					$count = count($records);
					for($i=0;$i<$count;$i++){ 
				?>
					<div class=pic><a target="_blank" title="<?php echo $records[$i]->title; ?>" href="show.php?id=<?php echo $records[$i]->id;?>"><img width=145 height=105 border=0 src="<?php echo $records[$i]->src_path('small');?>"></a></div>
				<?php }?>
			</div>
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
	$(function(){
		var flower_num = $("#hidden_flower").attr('value');
		var tomato_num = $("#hidden_tomato").attr('value');
		
		display_fqbq('fqbq','post[comment]');
		
		$("#submit_comment").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('post[comment]') ;
			var comment = oEditor.GetHTML();
			if($("#c_n_n").val().length>80){
				alert("昵称长度太长！");
				return false;
			}
			if(comment==""){
				alert("请输入评论内容！");
				return false;
			}
			$("#comment_form").submit();
		})
		
		$("#flower").click(function(){
			flower_num++;
			$("#hidden_flower").attr('value',flower_num);
			$(this).html(flower_num);
			$.post("/pub/pub.post.php",{'type':'flower','id':$("#image_id").attr('value'),'db_table':'smg_images','digg_type':'picture'},function(data){
				if(data!=''){
					alert(data);
				}
			});
		});
		
		$("#tomato").click(function(){
			tomato_num++;
			$("#hidden_tomato").attr('value',tomato_num);
			$(this).html(tomato_num);
			$.post("/pub/pub.post.php",{'type':'tomato','id':$("#image_id").attr('value'),'db_table':'smg_images','digg_type':'picture'},function(data){
				if(data!=''){
					alert(data);
				}
			});
		})
		
		$("[class*=tag]").click(function(){
			//window.location.href="list.php?tag="+$(this).html();
		})
	});
</script>