<?php
	require_once('../../frame.php');
	$id = 1427;
	$qs=1;
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
	<title>SMG-番茄网-直播专题</title>
	<?php
		use_jquery();
		css_include_tag('show_video','top','bottom');
		js_include_tag('pubfun','total');
 	?>
</head>
<script>
	total("<?php echo $category->name;?>","other");	
</script>

<body>
<? require_once('../../inc/top.inc.html');?>
<div id=ibody>
	  <div id=ibody_top>
	  	<div id=t_l></div>
			<div id=t_c>
				<div class=video>
					<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=414   width=537   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT> 
						<PARAM   NAME= "URL"   VALUE= "<?php echo $video->online_url; ?>"> 
						<PARAM   NAME= "playCount"   VALUE= "1"> 
						<PARAM   NAME= "autoStart"   VALUE= "true"> 
						<PARAM   NAME= "invokeURLs"   VALUE= "false">
						<PARAM   NAME= "uiMode"   VALUE= "Full">
						<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
						<embed src="<?php echo $video->online_url; ?>" align="baseline" border="0" width="537" height="414" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
					</OBJECT>
				</div>
			
			</div>
			<div id=t_r>
			</div>
	  </div>
	 	<div id=ibody_left>
	 	  <div id=l_t>
	 	  	<div class=title style="font-weight:bold;">直播简介</div>
				<div class=content>
						<p style="margin-left:10px;"><?php echo $video->description; ?></p>
				</div>
	 	  </div>
			<div id=l_b>
				<?php 
					$comment = new table_class('smg_comment');
					$records = $comment->find('all',array('conditions' => 'resource_type="video" and zbqs='.$qs));
					$count2 = count($records);
					$records = $comment->paginate('all',array('conditions' => 'resource_type="video" and zbqs='.$qs,'order' => 'created_at desc'),10);
					$count = count($records);
				?>
				<div class=title style="font-weight:bold;">网友评论（<?php echo $count2;?>）</div>
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
						<input type="hidden" name="post[zbqs]" value="1">
						<input type="hidden" name="post[resource_type]" value="zhibo">
						<input type="hidden" name="type" value="comment">
						<div id="commit_fck"><?php show_fckeditor('post[comment]','Title',false,'75','','540');?></div>
						<div id=fqbq></div>
						<div id=submit_comment></div>
					</form>
				</div>
			</div>
		  </div>
			
		<div id=ibody_right>
				<div id=r_b>
					<?php 
						$db = get_db();
						$news=$db->query('select * from smg_news where category_id=214 and is_adopt=1 order by priority asc ,created_at desc');
					?>
					<div class=title style="font-weight:bold;">相关新闻</div>
			  	<div class=pic><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 src="<?php echo $news[0]->photo_src;?>"></a></div>
			  	<div class=piccontent><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->description; ?></a></div>
			  	<?php for($i=1;$i<count($news);$i++){ ?>
			  		<div class=piclist><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title;?></a></div>
			  	<?php } ?>
		</div>
		
</div>
<? require_once('../../inc/bottom.inc.php');?>


</body>
</html>

<script>
	$(function(){
		
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
		
	});
</script>
