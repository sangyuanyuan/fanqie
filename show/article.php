<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
	$news = new table_class('smg_news');
	$news -> find($id);
	$category_name = category_name_by_id($news->category_id);
	//$y2k = mktime(0,0,0,1,1,2020); 
	//$cookie_name = 'article_'.date("Y-m-d").'_'.$id;
	//if($_COOKIE[$cookie_name]==''){
	//	SetCookie($cookie_name,'1',$y2k,'/');
	//}else{
	//	$cookie = $_COOKIE[$cookie_name]+1;
	//	SetCookie($cookie_name,$cookie,$y2k,'/');
	//}
	//if($_COOKIE[$cookie_name]<200){
		$news->click_count = $news->click_count+1;
		$news -> save();
	//}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-<?php echo $category_name;?></title>
	<?php
		css_include_tag('show_article','top','bottom','thickbox');
		use_jquery();
		js_include_tag('pubfun','total');
  	?>
	
</head>
<?php 
	//if($_COOKIE[$cookie_name]<200){
?>
<script>
	total("<?php echo $category_name;?>","show");	
</script>
<?php
	//}
?>
<body>
<?php 
	require_once('../inc/top.inc.html');
	js_include_once_tag('thickbox');
?>
<div id=ibody>	
 <div id=ibody_left>
 	  <div class=l>
 	  		<?php $category_id = category_id_by_name('每日之星'); ?>
			<div class=title1><div name="mrzx" class=left1>每日之星排行榜|</div><div name="bm" class=left1 style="color:#999999">部门排行榜</div><div class="more"><a target="_blank" href="list.php?id=<?php echo $category_id; ?>&type=news">更多>></a></div></div>
			<div id="mrzx">
			<?php
				$db = get_db();
				$sql = 'select id,short_title,flower,photo_src from smg_news where is_adopt=1 and category_id='.$category_id.' and photo_src!="" order by flower desc limit 5';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class="content mrzx change" <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a  href="article.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->photo_src?>"></a></div>
					<div class=right>
						<div class=top><a  href="article.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->short_title;?></a></div>
						<div class=bottom><a  href="article.php?id=<?php echo $records[$i]->id;?>">共得到<?php echo $records[$i]->flower; ?>束鲜花</a></div>
					</div>
				</div>
			<? }?>
			</div>
			<div id="bm" style="display:none;">
			<?php
				$db = get_db();
				$sql = 'select dept_id,count(dept_id) as count from smg_news where is_adopt=1 and category_id='.$category_id.' group by dept_id order by count(dept_id) desc limit 5 ';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class="content bm change" <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=right>
						<div class=top><?php echo get_dept_info($records[$i]->dept_id)->name;?></div>
						<div class=bottom>共推荐<?php echo $records[$i]->count;?>位明星</div>
					</div>
				</div>
			<? }?>
			</div>
		</div>
 	  	
		<div class=l>
			<?php 
				$sql = 'select * from smg_video where TO_DAYS(NOW())-TO_DAYS(created_at) <= 30 and is_adopt=1 order by click_count desc limit 5;';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>视频排行榜</div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a  href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=right>
						<div class=top><a  href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom><a  href="video.php?id=<?php echo $records[$i]->id;?>">被播放了<?php echo $records[$i]->click_count ?>次</a></div>
					</div>
				</div>
			<? }?>
		</div>
		<div class=l>
			<?php 
				$sql = 'select * from smg_images where TO_DAYS(NOW())-TO_DAYS(created_at) <= 30 and is_adopt=1 order by click_count desc limit 5;';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>我行我秀排行榜</div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a  href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=right>
						<div class=top><a  href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom><a  href="show.php?id=<?php echo $records[$i]->id;?>">被点击了<?php echo $records[$i]->click_count;?>次</a></div>
					</div>
				</div>
			<? }?>
		</div>
		
 </div>
 <div id=ibody_right>
	  	<?php
			if($news->news_type==2){
				redirect($news->file_name);
			}elseif($news->news_type==3){
				if(strpos($news->target_url,basename($_SERVER['PHP_SELF']))&&strpos($news->target_url,'id='.$id)){
					alert('对不起，链接出错了！请联系管理员!');
				}else{
					redirect($news->target_url);
				}
			}
		?>
		<div class=top>
			<div class=left><?php $category_name = category_name_by_id($news->category_id); echo $category_name; ?></div>
		</div>
		
		<div class=title><?php echo $news->title; ?></div>
		<div class=a_title>
			来源：<?php echo get_dept_info($news->dept_id)->name;?>&nbsp;
			浏览次数：<font color=#C2130E><?php echo $news->click_count; ?></font>&nbsp;
			时间：<?php echo $news->created_at; ?>
		</div>
		<?php if($news->video_flag==1){?>
		<div style="width:400px; height:300px; float:left; margin-top:10px; margin-left:140px; display:inline;">
			<?php show_video_player('400','300',$news->video_photo_src,$news->video_src,$autostart = "false");?>
		</div>
		<?php }?>
		<div class=content>
			<?php echo get_fck_content($news->content); ?>
			<div id=page><?php print_fck_pages($news->content,'article.php?id='.$id); ?></div>
		</div>
		<?php if($category_name=='每日之星'){ ?>
		<div id=point>
			<div id=flower name="<?php echo $id; ?>" title="点击赠送鲜花"></div>
			<div id=point_r>
				<?php if($news->description!=''){?>
				领导祝福：<?php echo $news->description;?><br>
				<?php }?>
				共有<?php echo $news->flower;?>人给该明星赠送鲜花<br><br>
				<font size=5 color=#ff0000>点击鲜花送花送祝福！</font>
			</div>
			<!--
			<?php 
				$sql = 'select avg(point) as a_point,count(point) as count from smg_star_point where type="news" and resource_id='.$id;
				$record = $db->query($sql);
				$point = $record[0]->a_point;
				$count = $record[0]->count;
				if($point==''){
					$r_point = '0.0';
				}else{
					$r_point = substr($point, 0, 3);
					if($r_point=='10.')$r_point=10;
					$o_point = substr($point, 0, 1);
					if(substr($r_point,2,1)=='0'){
						$s_point=$r_point;
					}else{
						$s_point = ($r_point-$o_point)>0.49?(a1):$o_point;
					}
				}
				if($count=='')$count=0;
			?>
			<div id=result><?php echo $r_point.'分';?></div>
			<?php 
				for($i=0;$i<$s_point;$i++){
			?>
			<div class=star value="<?php echo $i+1; ?>" name="<?php echo $i+1; ?>"  title="<?php echo ($i+1)."分";?>" style="background:url('/images/show/star1.jpg') no-repeat;"></div>
			<?php } ?>
			<?php 
				for($i=$s_point;$i<10;$i++){
			?>
			<div class=star value="<?php echo $i+1; ?>" name="<?php echo $i+1; ?>"  title="<?php echo ($i+1)."分";?>"></div>
			<?php } ?>
			<div id=info>共<?php echo $count; ?>人评分[点击星星直接打分]</div>
			<input type="hidden" id="y_star" value="<?php echo $s_point;?>">
			-->
		</div>
		<?php }?>
		<div id=comment>
			<?php 
				$comment = new table_class('smg_comment');
				$records = $comment->find('all',array('conditions' => 'resource_type="artcle_flower" and resource_id='.$id,'order' => 'created_at desc'));
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=r>
						<div class=t style="color:#ff0000">同事祝福：</div>
						<div class=b><?php echo $records[$i]->nick_name;?>说：<?php echo $records[$i]->comment?></div>
					</div>
				</div>
			<?php }?>
			
			<?php 
				$record = $db->query('select * from smg_comment where resource_type="news" and resource_id='.$id);
				$count2 = count($record);
				
				$comment = $db->paginate('select * from smg_comment where resource_type="news" and resource_id='.$id.' order by created_at desc',10);
				$count = count($comment);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=r>
						<div class=t><?php echo $comment[$i]->nick_name?></div>
						<div class=b><?php echo $comment[$i]->comment?></div>
					</div>
				</div>
			<?php }?>
			<div id=paginate><?php paginate();?></div>
			<div class=f_title <?php if($news->is_commentable!=1){?>style="display:none;"<?php } ?>><div id=f>发表评论</div></div>
			<div class=comment_box <?php if($news->is_commentable!=1){?>style="display:none;"<?php } ?>>
				<form id="comment_form" action="/pub/pub.post.php" method="post">
					<div class=c_title>现在有<span style="color:#FF5800"><?php echo $count2;?></span>人发表评论</div>
					<div class=commenter_box><input type="text" style="width:170px;" id="c_n_n" name="post[nick_name]"></div>
					<input type="hidden" name="post[resource_id]" id="resource_id" value="<?php echo $id;?>">
					<input type="hidden" name="post[resource_type]" value="news">
					<input type="hidden" name="type" value="comment">
					<div class="commit_fck"><?php show_fckeditor('post[comment]','Title',false,'75','','325');?></div>
					<div id=fqbq></div>
					<div id=submit_comment></div>
				</form>
			</div>
		</div>
		<div id=question>
			<?php 
				$question = $db->query('select * from smg_show_question where news_id='.$id.' order by created_at desc');
				for($i=0;$i<count($question);$i++)
				{
			?>
			<div class=content>
					<div class=r>
						<div class=t><?php echo $question[$i]->name;?></div><div class=replay><?php $cookie=$_COOKIE['smg_username']; $role=$db->query("select loginname from smg_user_real where dept_id=".$news->dept_id); if(count($role)>0||$cookie=='admin'){ if(in_array($cookie,$role)||$cookie=='admin'){ ?><span class="showquestionreplay" name="<?php echo $question[$i]->id; ?>">回答</span>　<span class="showquestiondel" name="<?php echo $question[$i]->id; ?>">删除</span><?php }} ?></div>
						<div class=b><?php echo $question[$i]->content;?></div>
					</div>
					<?php 
					$anwser = $db->query('select * from smg_show_answer where question_id='.$question[$i]->id.' order by created_at desc');
					for($j=0;$j<count($anwser);$j++)
					{
				?>
					<div class=answer>
						答：<?php echo $anwser[$j]->content; ?>
					</div>
					<?php } ?>
			</div>	
			<?php } ?>
			<div class=f_title style="width:320px;"><div id=f>我要提问</div></div>
			<div class=comment_box style="width:318px; margin-left:0px;">
				<form id="showquestion" action="question.post.php" method="post">
					<div class=c_title>现在有<span style="color:#FF5800"><?php echo count($question);?></span>人提问</div>
					<div class=commenter_box style="width:300px; margin-left:5px;"><input type="text" style="width:170px;" id="c_n_n" name="post[name]"></div>
					<input type="hidden" name="post[news_id]" value="<?php echo $id;?>">
					<div class="commit_fck" style="width:300px; margin-left:5px;"><?php show_fckeditor('post[content]','Title',false,'75','','300');?></div>
					<div id=submit_question></div>
				</form>
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
		
		$(".left1").hover(function(){
			$(".left1").css('color','#999999');
			$(this).css('color','#000000');
			$("#mrzx").css('display','none');
			$("#bm").css('display','none');
			$("#"+$(this).attr('name')).show();
		});
		
		/*
		$(".star").click(function(){
			$.post("/pub/pub.post.php",{'type':'star','r_type':'news','id':$("#news_id").attr('value'),'value':$(this).attr('value')},function(data){
				if(data!=""){
					alert(data);
				}else{
					window.location.reload();
				}
			});
		});
		
		$(".star").hover(function(){
			var value = parseInt($(this).attr('name'));
			$(".star").each(function(){
				if(parseInt($(this).attr('name'))<=value){
					$(this).css('background','url("/images/show/star3.jpg") no-repeat');
				}else{
					$(this).css('background','url("/images/show/star2.jpg") no-repeat');
				}
			})
		});
		
		$(".star").mouseout(function(){
			var value = parseInt($("#y_star").val());
			$(".star").each(function(){
				if(parseInt($(this).attr('name'))<=value){
					$(this).css('background','url("/images/show/star1.jpg") no-repeat');
				}else{
					$(this).css('background','url("/images/show/star2.jpg") no-repeat');
				}
			})
		});
		*/
		
		$("#flower").click(function(){
			$.post("/pub/pub.post.php",{'type':'flower','id':$(this).attr('name'),'db_table':'smg_news','digg_type':'article'},function(data){
				if(data!=''){
					alert(data);
				}else{
					tb_show('送鲜花送祝福','flower.php?height=300&width=300&modal=false&id=<?php echo $id; ?>');
				}
			});
		});
		
		$(".showquestionreplay").click(function(){
			tb_show('送鲜花送祝福','answer.php?height=250&width=300&id='+$(this).attr('name'));
		});
		
		$(".showquestiondel").click(function(){
			if(confirm('确定删除此问题吗？'))
			{
				$.post("answer.post.php",{'type':'del','id':$(this).attr('name')},function(data){
					alert(data);
					location.reload();
				});
			}
		});
		
		display_fqbq('fqbq','post[comment]');
		$("#fqbq").children().css('margin-left','5px');
			
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
		});
		
		$("#submit_question").click(function(){
			$("#showquestion").submit();
		});
		
	});
	
</script>
