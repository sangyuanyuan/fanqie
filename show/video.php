<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-视频子页</title>
	<?php
		use_jquery();
		css_include_tag('show_video','top','bottom');
		js_include_tag('pubfun');
 	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	  <div id=ibody_top>
	  		<div id=t_l></div>
			<div id=t_c>
				<div class=video>
					<?php 
						$video = new table_class('smg_video');
						$video->find($id);
						$video->click_count = $video->click_count+1;
						$video->save();
						show_video_player('480','390',$video->photo_url,$video->video_url,$autostart = "false"); 
					?>
				</div>
				<div class=digg>
					<div id="flower">
						<?php echo $video->flower;?>
						<input type="hidden" id="hidden_flower" value="<?php echo $video->flower;?>">
					</div>
					<div id="tomato">
						<?php echo $video->tomato;?>
						<input type="hidden" id="hidden_tomato" value="<?php echo $video->tomato;?>">
					</div>
					<input type="hidden" id="video_id" value="<?php echo $id;?>">
				</div>
			</div>
			<div id=t_r></div>
	  </div>
	 	<div id=ibody_left>
	 	  	<div id=l_t>
	 	  		<div class=title>视频信息</div>
				<div class=content><span></span>
					<div class=top>
						<div class=title>视频简介：</div>
						<div id=description><?php echo $video->description;?></div>
					</div>
					<div class=center>
						<div class=left>
							<div class=title>发布于：</div>
							<div id=date><?php echo substr($video->created_at, 0, 10);?></div>
						</div>
						<div class=right>
							<div class=title>该视频被播放：</div>
							<div id=count><?php echo $video->click_count;?></div>
						</div>
					</div>
					<div class=bottom>
						<div id=name>视频名称：<?php echo $video->title;?></div>
					</div>
				</div>
	 	  	</div>
			<div id=l_b>
				<?php 
					$comment = new table_class('smg_comment');
					$records = $comment->find('all',array('conditions' => 'resource_type="video" and resource_id='.$id));
					$count2 = count($records);
					$records = $comment->paginate('all',array('conditions' => 'resource_type="video" and resource_id='.$id),10);
					$count = count($records);
				?>
				<div class=title>网友评论（<?php echo $count2;?>）</div>
				<?php for($i=0;$i<$count;$i++){ ?>
				<div class=content>
					<div class=nick_name><?php echo $records[$i]->nick_name;?></div>
					<div class=time><?php echo $records[$i]->created_at;?></div>
					<div class=comment><?php echo $records[$i]->comment;?></div>
				</div>
				<?php } ?>
				<div id=paginate><?php paginate();?></div>
				<div id=comment_box>
					<form id="comment_form" action="/pub/pub.post.php" method="post">
						<div class=title>发表评论</div>
						<div id=commenter_box><input type="text" name="post[nick_name]">请输入昵称</div>
						<input type="hidden" name="post[resource_id]" value="<?php echo $id;?>">
						<input type="hidden" name="post[resource_type]" value="video">
						<input type="hidden" name="target_url" value="/show/video.php?id=<?php echo $id;?>">
						<input type="hidden" name="type" value="comment">
						<div id="commit_fck"><?php show_fckeditor('post[comment]','Title',false,'75','','540');?></div>
						<div id=fqbq></div>
						<div id=submit_comment></div>
					</form>
				</div>
			</div>
		  </div>
			
		<div id=ibody_right>
			  	<div id=r_t>
			  		<div class=title>更多该用户的视频</div>
					<div class=more>全部333个视频>></div>
			  		<div class=content></div>
			  	</div>
				<div id=r_b>
					<div class=title>相关视频</div>
					<div class=more>更多333个视频>></div>
			  		<div class=content></div>
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
			$.post("/pub/pub.post.php",{'type':'flower','id':$("#video_id").attr('value'),'db_table':'smg_video','digg_type':'video'},function(data){
				if(data!=''){
					alert(data);
				}
			});
		});
		
		$("#tomato").click(function(){
			tomato_num++;
			$("#hidden_tomato").attr('value',tomato_num);
			$(this).html(tomato_num);
			$.post("/pub/pub.post.php",{'type':'tomato','id':$("#video_id").attr('value'),'db_table':'smg_video','digg_type':'video'},function(data){
				if(data!=''){
					alert(data);
				}
			});
		})
	});
</script>