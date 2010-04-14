<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
	$video = new table_class('smg_video');
	$video->find($id);
	$category = new table_class('smg_category');
	$category->find($video->category_id);
	//$y2k = mktime(0,0,0,1,1,2020); 
	//$cookie_name = 'video_'.date("Y-m-d").'_'.$id;
	//if($_COOKIE[$cookie_name]==''){
	//	SetCookie($cookie_name,'1',$y2k,'/');
	//}else{
	//	$cookie = $_COOKIE[$cookie_name]+1;
	//	SetCookie($cookie_name,$cookie,$y2k,'/');
	//}
	//if($_COOKIE[$cookie_name]<200){
		$video->click_count = $video->click_count+1;
		$video -> save();
	//}
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
		js_include_tag('pubfun','total');
 	?>
</head>
<?php 
	if($_COOKIE[$cookie_name]<200){
?>
<script>
	total("<?php echo $category->name;?>","<?php echo $category->platform;?>");	
</script>
<?php
	}
?>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	  <div id=ibody_top>
	  		<div id=t_l></div>
			<div id=t_c>
				<div class=video>
					<?php 
						if($video->online_url!=''){
							if(strpos($video->online_url,basename($_SERVER['PHP_SELF']))&&strpos($video->online_url,'id='.$id)){
								alert('对不起，链接出错了！请联系管理员!');
							}else{
								redirect($video->online_url);
							}
						}
						if($video->video_url!=''){
							show_video_player('537','414',$video->photo_url,$video->video_url,$autostart = "false");
						}else{
					?>
					<div class=error>对不起，你所访问的视频链接不存在，请与管理员联系！</div>
					<?
						}
					?>
				</div>
				<div class=digg>
					<div id="flower" title="送鲜花">
						<?php echo $video->flower;?>
						<input type="hidden" id="hidden_flower" value="<?php echo $video->flower!=''?$video->flower:0;?>">
					</div>
					<div id="tomato" title="丢番茄">
						<?php echo $video->tomato;?>
						<input type="hidden" id="hidden_tomato" value="<?php echo $video->tomato!=''?$video->tomato:0;?>">
					</div>
					<input type="hidden" id="video_id" value="<?php echo $id;?>">
				</div>
			</div>
			<div id=t_r>
			</div>
	  </div>
	 	<div id=ibody_left>
	 	  	<div id=l_t>
	 	  		<div class=title>视频信息</div>
				<div class=content><span></span>
					<div class=top>
						<div id=name>视频名称：<?php echo $video->title;?></div>
					</div>
					<div class=center>
						<div class=left>
							<div class=title>发布者：</div>
							<div id=publisher><?php echo$video->publisher;?></div>
						</div>
						<div class=middle>
							<div class=title>发布于：</div>
							<div id=date><?php echo substr($video->created_at, 0, 10);?></div>
						</div>
						<div class=right>
							<div class=title>该视频被播放：</div>
							<div id=count><?php echo $video->click_count;?></div>
						</div>
					</div>
					<div class=bottom>
						<div class=title>视频简介：</div>
						<div id=description><?php echo $video->description;?></div>
					</div>
				</div>
	 	  	</div>
			<div id=l_b>
				<?php 
					$comment = new table_class('smg_comment');
					$records = $comment->find('all',array('conditions' => 'resource_type="video" and resource_id='.$id));
					$count2 = count($records);
					$records = $comment->paginate('all',array('conditions' => 'resource_type="video" and resource_id='.$id,'order' => 'created_at desc'),10);
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
				<div id=comment_box <?php if($video->commentable!="on"){?>style="display:none;"<?php } ?>>
					<form id="comment_form" action="/pub/pub.post.php" method="post">
						<div class=title>发表评论</div>
						<div id=commenter_box><input type="text" id="c_n_n" name="post[nick_name]">请输入昵称</div>
						<input type="hidden" name="post[resource_id]" value="<?php echo $id;?>">
						<input type="hidden" name="post[resource_type]" value="video">
						<input type="hidden" name="type" value="comment">
						<div id="commit_fck"><?php show_fckeditor('post[comment]','Title',false,'75','','540');?></div>
						<div id=fqbq></div>
						<div id=submit_comment></div>
					</form>
				</div>
			</div>
		  </div>
			
		<div id=ibody_right>
			<div id="up_pic"><a href="show_sub.php?type=video"  ><img src="/images/show/video_up2.jpg" width="370" height="130" border=0></a></div>
					<?php 
						$db = get_db();
						$sql = 'select * from smg_video where is_adopt=1 and publisher="'.$video->publisher.'" and id!='.$id.' limit 6';
						$records = $db->query($sql);
						$count = count($records);
					?>
			  	<div id=r_t <?php if($count==0){?>style="display:none;"<?php } ?>>
			  		<div class=title>更多该用户的视频</div>
		  			<?php 
						for($i=0;$i<$count;$i++) {
					?>
					<div class=content>
						<div class=box>
							<div class=photo>
								<a  href="video.php?id=<?php echo $records[$i]->id;?>">
									<img src="<?php echo $records[$i]->photo_url;?>" width="90" height="56" border=0>
								</a>
							</div>
						</div>
						<div class=title><a  href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					</div>
					<?
						}
					?>
			  	</div>
				<div id=r_b>
					<?php 
						$db = get_db();
						$keywords = explode(",", $video->keywords);
						if(count($keywords==0))$keywords = explode("，", $video->keywords);
						$key_count = count($keywords);
						$sql = 'select * from smg_video where id!='.$id;
						if($key_count>0){
							if($keywords[0]!=''){
								$sql = $sql.' and keywords like "%'.$keywords[0].'%"';
							}
							for($i=1;$i<$key_count;$i++){
								$sql = $sql.' or keywords like "%'.$keywords[$i].'%"';
							}
						}
						$sql = $sql." limit 12";
						$records = $db->query($sql);
						$count = count($records);
					?>
					<div class=title>相关视频</div>
			  		<?php 
						for($i=0;$i<$count;$i++) {
					?>
					<div class=content>
						<div class=box>
							<div class=photo>
								<a  href="video.php?id=<?php echo $records[$i]->id;?>">
									<img src="<?php echo $records[$i]->photo_url;?>" width="90" height="56" border=0>
								</a>
							</div>
						</div>
						<div class=title><a  href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					</div>
					<?php
						}
						if($count<12){
							$count = 12-$count;
							$sql = 'select * from smg_video where id!='.$id.' order by rand() limit '.$count;
							$records = $db->query($sql);
							$count = count($records);
							for($i=0;$i<$count;$i++) {
					?>
					<div class=content>
						<div class=box>
							<div class=photo>
								<a  href="video.php?id=<?php echo $records[$i]->id;?>">
									<img src="<?php echo $records[$i]->photo_url;?>" width="90" height="56" border=0>
								</a>
							</div>
						</div>
						<div class=title><a href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					</div>
					<?php }
						}
					?>
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
			if($("#c_n_n").val().length>80){
				alert("昵称长度太长！");
				return false;
			}
			if(comment==""){
				alert("请输入评论内容！");
				return false;
			}
			
			if(comment.length > 1500){
				alert('评论内容太长,请联系管理员');
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
				}else{
					total("<?php echo $category->name;?>digg","<?php echo $category->platform;?>");	
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
				}else{
					total("<?php echo $category->name;?>digg","<?php echo $category->platform;?>");	
				}
			});
		})
	});
</script>
