<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-每日之星</title>
	<?php
		css_include_tag('show_star','top','bottom');
		use_jquery();
		js_include_tag('pubfun');
  	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>	
 <div id=ibody_left>
 	  <div class=l>
 	  		<?php $category_id = category_id_by_name('每日之星'); ?>
			<div class=title><div class=left>每日之星排行榜</div><div class="more"><a target="_blank" href="list.php?id=<?php echo $category_id; ?>&type=news">更多>></a></div></div>
			<?php
				$db = get_db();
				$sql = 'select id,short_title,click_count,photo_src from smg_news where is_adopt=1 and category_id='.$category_id.' and photo_src!="" and click_count is not null order by click_count desc limit 5 ';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="star.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->photo_src?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="star.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->short_title;?></a></div>
						<div class=bottom><a target="_blank" href="star.php?id=<?php echo $records[$i]->id;?>">被浏览了<?php echo $records[$i]->click_count ?>次</a></div>
					</div>
				</div>
			<? }?>
		</div>
 	  	
		<div class=l>
			<?php 
				$sql = 'select * from smg_video where month(created_at)=month("'.date("Y-m-d").'") order by click_count desc limit 5;';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>视频排行榜</div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>">被播放了<?php echo $records[$i]->click_count ?>次</a></div>
					</div>
				</div>
			<? }?>
		</div>
		<div class=l>
			<?php 
				$sql = 'select * from smg_images where month(created_at)=month("'.date("Y-m-d").'") order by click_count desc limit 5;';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>我型我秀排行榜</div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>">被点击了<?php echo $records[$i]->click_count;?>次</a></div>
					</div>
				</div>
			<? }?>
		</div>
		
 </div>
 <div id=ibody_right>
	  	<?php
			$news = new table_class('smg_news');
			$news -> find($id);
			$news->click_count = $news->click_count+1;
			$news -> save();
		?>
		<div class=top>
			<div class=left>每日之星</div>
		</div>
		
		<div class=title><?php echo $news->title; ?></div>
		<div class=a_title>
			来源：<?php echo get_dept_info($news->dept_id)->name;?>&nbsp;
			浏览次数：<font color=#C2130E><?php echo $news->click_count; ?></font>&nbsp;
			时间：<?php echo $news->created_at; ?>
		</div>
		<div class=content>
			<?php echo get_fck_content($news->content); ?>
			<div id=page><?php print_fck_pages($news->content,'star.php?id='.$id); ?></div>
		</div>
		<div id=point>
			<?php 
				$sql = 'select avg(point) as a_point,count(point) as count from smg_star_point where type="news" and resource_id='.$id;
				$record = $db->query($sql);
				$point = $record[0]->a_point;
				$count = $record[0]->count;
				if($point==''){
					$point = '0.0';
				}else{
					$r_point = substr($point, 0, 3);
					if($r_point=='10.')$r_point=10;
					$o_point = substr($point, 0, 1);
					if(substr($r_point,2,1)=='0'){
						$s_point=$r_point;
					}else{
						$s_point = ($r_point-$o_point)>0.49?($o_point+1):$o_point;
					}
				}
				if($count=='')$count=0;
			?>
			<div id=result><?php echo $r_point;?></div>
			<?php 
				for($i=0;$i<$s_point;$i++){
			?>
			<div class=star value="<?php echo $i+1; ?>" style="background:url('/images/show/star1.jpg') no-repeat;"></div>
			<?php } ?>
			<?php 
				for($i=$s_point;$i<10;$i++){
			?>
			<div class=star value="<?php echo $i+1; ?>"></div>
			<?php } ?>
			<div id=info>共<?php echo $count; ?>人评分[点击星星直接打分]</div>
			
		</div>
		
		<div id=comment>
			<?php 
				$comment = new table_class('smg_comment');
				$records = $comment->find('all',array('conditions' => 'resource_type="news" and resource_id='.$id));
				$count2 = count($records);
				$records = $comment->paginate('all',array('conditions' => 'resource_type="news" and resource_id='.$id,'order' => 'created_at desc'),10);
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
			<div class=f_title><div id=f>发表评论</div></div>
			<div id=comment_box>
				<form id="comment_form" action="/pub/pub.post.php" method="post">
					<div class=c_title>现在有<span style="color:#FF5800"><?php echo $count2;?></span>人发表评论</div>
					<div id=commenter_box><input type="text" style="width:340px;" name="post[nick_name]"></div>
					<input type="hidden" name="post[resource_id]" value="<?php echo $id;?>">
					<input type="hidden" name="post[resource_type]" value="news">
					<input type="hidden" name="type" value="comment">
					<div id="commit_fck"><?php show_fckeditor('post[comment]','Title',false,'75','','650');?></div>
					<div id=fqbq></div>
					<div id=submit_comment></div>
				</form>
			</div>
		</div>
 </div>

</div>
<?php
	close_db();
	require_once('../inc/bottom.inc.php');
?>

<input type="hidden" value="<?php echo $id; ?>" id="news_id">
</body>
</html>

<script>
	$(function(){
		$(".star").click(function(){
			$.post("/pub/pub.post.php",{'type':'star','r_type':'news','id':$("#news_id").attr('value'),'value':$(this).attr('value')},function(data){
				if(data!=""){
					alert(data);
				}else{
					window.location.reload();
				}
			});
		});
		
		display_fqbq('fqbq','post[comment]');
			
		$("#submit_comment").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('post[comment]') ;
			var comment = oEditor.GetHTML();
			if(comment==""){
				alert("请输入评论内容！");
				return false;
			}
			$("#comment_form").submit();
		});
	});
	
</script>
