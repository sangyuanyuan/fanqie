<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
	$image = new smg_images_class();
	$image->find($id);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-我型我秀子页</title>
	<?php
		css_include_tag('show_show','top','bottom');
		use_jquery();
		js_include_tag('pubfun');
  	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>	
 <div id=ibody_left>
 	  	<div id=l_t>
	 	  	<a target="_blank" href="#"><img border=0 src="/images/show/show_l_t.jpg"></a>
			  <a target="_blank" style="margin-left:5px;" href="#"><img border=0 width=136 height=70 src=""></a>
			  <a style="margin-left:5px;" target="_blank" href="#"><img border=0  width=136 height=70 src=""></a>
			  <a target="_blank" style="margin-left:5px;" href="#"><img border=0  width=136 height=70 src=""></a>
			  <a style="margin-left:5px;" target="_blank" href="#"><img border=0  width=136 height=70 src=""></a>
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
		<div class=l_m>
			<div class=title><div class=left>热门标签</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<div class=content style="border-bottom:none;"></div>
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
				<div id="flower">
					<?php echo $image->flower;?>
					<input type="hidden" id="hidden_flower" value="<?php echo $image->flower;?>">
				</div>
				<div id="tomato">
					<?php echo $image->tomato;?>
					<input type="hidden" id="hidden_tomato" value="<?php echo $image->tomato;?>">
				</div>
				<input type="hidden" id="image_id" value="<?php echo $id;?>">
			</div>
			<?php }?>
	    </div>
	  
		<div id=r_b>
			<div id=r_b_l>
				<div class=title>网友评论</div>
				<?php 
					$comment = new table_class('smg_comment');
					$records = $comment->find('all',array('conditions' => 'resource_type="picture" and resource_id='.$id));
					$count2 = count($records);
					$records = $comment->paginate('all',array('conditions' => 'resource_type="picture" and resource_id='.$id),6);
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
				<div id=comment_box>
					<form id="comment_form" action="/pub/pub.post.php" method="post">
						<div class=title>现在有<span style="color:#FF5800"><?php echo $count2;?></span>人发表评论</div>
						<div id=commenter_box><input type="text" style="width:330px;" name="post[nick_name]"></div>
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
				<div class=more><a target="_blank" href="show_list.php?name=<?php echo $image->publisher;?>">更多>></a></div>
				<?php
					$images = new smg_images_class();
					$records = $images->find('all',array('conditions' => 'is_adopt=1 and publisher="'.$image->publisher.'" and id!='.$id,'limit' => '8'));
					$count = count($records);
					for($i=0;$i<$count;$i++){ 
				?>
					<div class=pic><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img width=145 height=105 border=0 src="<?php echo $records[$i]->src_path('small');?>"></a></div>
				<?php }?>
			</div>
		</div>

 </div>
</div>
<? require_once('../inc/bottom.inc.php');?>


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
	});
</script>