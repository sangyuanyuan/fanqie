<?php
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	if($id==""||$id==null){die('û���ҵ���ҳ');}
	$cookie= (isset($_COOKIE['vote_user'])) ? $_COOKIE['vote_user'] : 0;
	$cookie=isset($_COOKIE['news_head_'.date('Y-m-d').$id]) ? $_COOKIE['news_'.date('Y-m-d').$id] : 0;
	if($cookie==0)
	{
		@SetCookie('news_head_'.date('Y-m-d').$id,1);
	}
	else
	{
		@SetCookie('news_head_'.date('Y-m-d').$id,$cookie+1);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-cn>
	<?php if($_REQUEST['page']){ ?>
	<script type="text/javascript">
			window.location.href = "#pinglun";
	</script>
	<? }?>
	<title>SMG-������-����-����ͷ��</title>
	<? 	
		css_include_tag('news_news_head','top','bottom');
		use_jquery();
		js_include_once_tag('pubfun','news','pub','total');
		$db = get_db();
		if($cookie<=200)
		{
			$sql="update smg_news set click_count=click_count+1 where id=".$id;
			$db->execute($sql);
		}
		$sql="select n.*,c.id as cid,c.name as categoryname,d.name as deptname,c.platform as cplatform from smg_news n inner join smg_category c on n.category_id=c.id inner join smg_dept d on n.dept_id=d.id and n.id=".$id;
		$record=$db->query($sql);	
		$about = array();
		if($record[0]->related_news!="")
		{	
			$about1=search_newsid($id,$record[0]->related_news,"smg_news",10,"n.priority asc,n.created_at desc");
			$about = $about1;
			if(count($about1)<10)
			{
				if($record[0]->keywords!=""){
					$a2=search_keywords($id,$record[0]->keywords,'smg_news',$about1,10-count($about1),"n.priority asc,n.created_at desc");
					$about = array_merge($about, $a2);
				}
			}
			
		}
		else{
			
			$about=search_keywords($id,$record[0]->keywords,'smg_news',$record,10,"n.priority asc,created_at desc");
		}
		$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc";
		$comment=$db->paginate($sql,5);
		$sql="select count(*) as flowernum,(select count(*) from smg_digg cd where cd.type='tomato' and cd.diggtoid=d.diggtoid and cd.file_type='comment') as tomatonum,(select count(*) from smg_digg cd where cd.diggtoid=d.diggtoid and cd.file_type='comment') as total,c.*,d.diggtoid from smg_digg d inner join smg_comment c on d.diggtoid=c.id and d.type='flower' and d.file_type='comment' and resource_type='news' and  c.resource_id=".$id." and d.file_type='comment' group by diggtoid order by total desc limit 2";
		$digg=$db->query($sql);
    ?>
 <?php 
 if($cookie<=200){
 if($record[0]->cplatform=="news"){?>
<script>
	total("<?php echo $record[0]->categoryname; ?>","news");
</script>
<?php }else if($record[0]->cplatform=="show"){ ?>
<script>
	total("<?php echo $record[0]->categoryname; ?>","show");
</script>
<?php }else if($record[0]->cplatform=="server"){?>
<script>
	total("<?php echo $record[0]->categoryname; ?>","server");
</script>
<?php }else if($record[0]->cplatform=="zone"){?>
<script>
	total("<?php echo $record[0]->categoryname; ?>","zone");
</script>
<?php }else{?>
<script>
	total("<?php echo $record[0]->categoryname; ?>","other");
</script>
<?php }} ?>
</head>
<body <?php if($record[0]->forbbide_copy == 1){ ?>onselectstart="return false" <?php }?>>
<? 
if($record[0]->news_type==2)
{
	redirect($record[0]->file_name);
}
else if($record[0]->news_type==3)
{
	if(strpos($record[0]->target_url,basename($_SERVER['PHP_SELF']))&&strpos($record[0]->target_url,'id='.$id)){
		alert('�Բ������ӳ����ˣ�����ϵ����Ա!');
	}
	else{
		redirect($record[0]->target_url);
	}
}
require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<input type="hidden" id="newsid" value="<?php echo $id;?>">
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">����<a href="/">��ҳ</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">����</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span> <a href="/news/news_list.php?id=<? echo $record[0]->cid;?>"><?php echo $record[0]->categoryname;?></a>
		</div>
		<div id=l_b>
			<div id=title><?php echo delhtml($record[0]->title);?></div>
			<div id=comefrom>��Դ��<?php echo $record[0]->deptname;?>��<?php if($record[0]->publisher_id!=""&&$record[0]->categoryname=="��Ҫ����"){?>���ߣ�<?php echo $record[0]->publisher_id;} ?>�����������<span style="color:#C2130E"><?php echo $record[0]->click_count;?></span>��ʱ�䣺<?php echo $record[0]->created_at;?></div>
			<?php if($record[0]->video_src!=""&&$record[0]->video_src!=null){
					if($record[0]->low_quality==0){
				?>
			<div id=video><?php show_video_player('529','435',$record[0]->video_photo_src,$record[0]->video_src); ?></div>
			<?php }else
			{?>
				<div id=video><?php show_video_player('265','218',$record[0]->video_photo_src,$record[0]->video_src); ?></div>
			<?php }} ?>
			<div id=content>
				<?php echo get_fck_content($record[0]->content);?>
			</div>
			
			<?php 
			if($record[0]->vote_id!=""&&$record[0]->vote_id!=0){?>
				
				<div class=vote>
				<?php 
						$vote = new smg_vote_class();
						$vote->find($record[0]->vote_id);
						$vote->display(array("target"=>"_blank",'submit_src'=>'/images/news/news_vote_button.jpg','view_src'=>'/images/news/news_view_button.jpg')); ?>
				</div>
			<? }?>
			<div id=contentpage><?php echo print_fck_pages($record[0]->content,"news_head.php?id=".$id); ?></div>
			<?php if($record[0]->categoryname=="��Ҫ����"){?><div id=lc>����ϵ���������ѱ������ţ������������Ĺ۵��������</div><?php } ?>
			<div id=wybl><a style="margin-left:20px;" target="_blank" href="/news/news_sub.php"><img border=0 src="/images/news/news_head_r_t.jpg"></a></div>
			<div id=more><a target="_blank" href="/news/news_list.php?id=<?php echo $record[0]->cid;?>">�鿴��������>></a></div>
			<?php if(count($about)>0||count($about)>0){?>
			<div class=abouttitle>������ڡ�<?php echo mb_substr(strip_tags($record[0]->short_title),0,36,"utf-8");?>��������</div>
			<div class=aboutcontent style="padding-bottom:10px;">
				<div class=title>�������</div>
					<?php for($i=0;$i<count($about);$i++){
					?>
				<div class=content>
						<?php if($about[$i]->category_id=="1"||$about[$i]->category_id=="2"){ ?>
							��<a target="_blank" href="/<?php echo $about[$i]->platform ?>/news/news_head.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->created_at; ?>)</span>
							</a>
						<?php }else{?>
							��<a target="_blank" href="/<?php echo $about[$i]->platform ?>/news/news.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->created_at; ?>)</span>
							</a>
						<?php }?>
					</div>		
				<?php }?>		
			</div>
			<?php } ?>
			<div style="float:left; display:inline;"><a id="pinglun" name="pinglun">&nbsp;</a></div>
			<?php if($record[0]->is_commentable==1){ if(count($comment)>0){?>
			<div id=comment>
				<?php if(count($digg)>0){
				 for($i=0;$i<count($digg);$i++){ ?>
					<!--<div class=content>	
						<div class=title1>
							<div style="width:110px; height:20px; margin-left:118px; overflow:hidden; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><? echo $digg[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; height:30px; float:left; display:inline;"><img title="���ʻ�" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $digg[$i]->id;?>" style="none"><div id="hidden_flower" style="width:65px; height:12px; margin-left:3px; margin-top:8px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $digg[$i]->flowernum;?></div><img title="�ӷ���" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $digg[$i]->id;?>" style="none"><div style="width:60px; height:15px; margin-top:8px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $digg[$i]->tomatonum;?></div></div>
								<div style="width:140px; line-height:20px;  color:#FF0000; float:right; display:inline;"><?php echo $digg[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
								<?php  echo strfck($digg[$i]->comment);?>
							</div>	
					</div>-->
				<?php }}
				
				  for($i=0;$i<count($comment);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; height:20px; margin-top:10px; margin-left:10px; line-height:20px; overflow:hidden; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $comment[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="���ʻ�" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $comment[$i]->id;?>" style="none"><div id="hidden_flower" style="width:65px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $comment[$i]->flowernum;?></div><img title="�ӷ���" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $comment[$i]->id;?>" style="none"><div style="width:60px; height:15px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $comment[$i]->tomatonum;?></div></div>��
								<div style="width:140px; line-height:20px; color:#FF0000; float:right; display:inline"><?php echo $comment[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
							<?php echo strfck($comment[$i]->comment);?>
						</div>
					</div>
				<?php }?>		
			</div>
			<div class=page><?php paginate('');?></div>
			<?php }?>
			<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
			<div class=abouttitle>��������</div>
			<div class=aboutcontent style="padding-bottom:10px;">
				<div class=title style="background:#ffffff;">����<span style="color:#FF5800;"><?php $totalcoment=$db->query("select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc"); echo count($totalcoment);?></span>�˶Ա��Ľ���������<?php if(count($totalcoment)>0){ ?>����<a style="color:#1862A3" target="_blank" href="/comment/comment_list.php?id=<?php echo $id;?>&type=news">�鿴��������</a><?php } ?>����<a style="color:#1862A3;" target="_blank" href="/comment/all_comment.php">�鿴��������</a></div>
				<input type="text" id="commenter" name="post[nick_name]">
				<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="news">
				<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
				<input type="hidden" name="type" value="comment">
				<div style="margin-top:5px; margin-left:13px; float:left; display:inline;"><?php show_fckeditor('post[comment]','Title',false,'75','','617');?></div>
				<div id=fqbq>
					
				</div>
				<button id="comment_sub">�ύ����</button>
			</div>
			</form>
			<?php }?>
		</div>
	</div>
	
	<div id=ibody_right>
		<div id=r_t style="margin-bottom:15px;">
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="298" height="88" id="FLVPlayer">
			 <param name="movie" value="/flash/news.swf" />
			 <param name="salign" value="lt" />
			 <param name="quality" value="high" />
			 <param name="wmode" value="opaque" />
			 <param name="scale" value="noscale" />
			 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" />
			 <embed src="/flash/news.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" quality="high" scale="noscale" width="298" height="88" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>		
		</div>
		<?php
		if($record[0]->related_videos!=""){
		$keys = explode(',',$record[0]->related_videos);
		$sql="select photo_url,video_url from smg_video where id=".$keys[0];
		$r_video=$db->query($sql);
		 if($record[0]->video_src==""){
		 	if($record[0]->low_quality==0){
			?>
			<div class=r_video><?php show_video_player('298','240',$r_video[0]->photo_url,$r_video[0]->video_url);?></div>
		<?php }
			else
			{?>
				<div class=r_video><?php show_video_player('150','120',$r_video[0]->photo_url,$r_video[0]->video_url);?></div>
			<?php }
		} ?>
		<div id=r_m>
			<?php 
			 for($i=0;$i< count($keys);$i++){
			 	$sql="select id,title from smg_video where id=".$keys[$i];
			 	$videolist=$db->query($sql);
			 ?> 
			 	<div class="r_content">
			 		<?php  if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a target="_blank" href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }else{?>
						<div class=pic2>
							<?php if($i<9){
								 echo "0".($i+1);
								 }else{ echo $i+1;}?>
						</div>
						<div class=cl2><a target="_blank" href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<?php }?>
		<div class=r_b1>
			<div class=title>��ʷͷ��</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n inner join smg_category c on c.id=n.category_id and n.is_adopt=1 and n.id<>".$id." and n.tags='��ʷͷ��' order by n.created_at desc limit 8";
			 $morehead=$db->query($sql);
			 for($i=0;$i<count($morehead);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a target="_blank" href="/<?php echo $morehead[$i]->platform;?>/news/news_head.php?id=<?php echo $morehead[$i]->id;?>"><?php echo delhtml($morehead[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<div class=cl2><a target="_blank" href="/<?php echo $morehead[$i]->platform;?>/news/news_head.php?id=<?php echo $morehead[$i]->id;?>"><?php echo delhtml($morehead[$i]->short_title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<div class=r_b1>
			<div class=title>С��Ӿ�</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n inner join smg_category c on c.id=n.category_id and n.is_adopt=1 and n.id<>".$id." and n.tags='С��Ӿ�' order by n.priority asc,n.created_at desc limit 10";
			 $xbjj=$db->query($sql);
			 for($i=0;$i<count($xbjj);$i++){
			 ?>
			 	<div class="r_content">
			 		<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl1>��<a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else
					{?>
						<div class=cl1>��<a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<div id=r_b2>
			<div class=b_head_title1 param=1>���ŷ�����</div>
			<div class=b_head_title1 param=2 style="background:none; color:#000000;">���ŵ�����а�</div>
			<div id=b_b_1 class="b_b" style="display:block">
			<?php 
			 $sql="select *,(n1+v1+p1) as a1,(n2+v2+p2) as a2  from (select a.name,ifnull(b.allcounts,0) as n1,ifnull(c.counts,0) as n2,ifnull(p1allcounts,0) as p1,ifnull(p2counts,0) as p2,ifnull(v1allcounts,0) as v1,ifnull(v2counts,0) as v2 from smg_dept a left join
(select count(dept_id) as allcounts,dept_id from smg_news where is_recommend=1  group by dept_id) b on a.id=b.dept_id left join  (select count(dept_id) as counts,dept_id from smg_news where is_adopt=1 group by dept_id) c on b.dept_id = c.dept_id
left join (select count(dept_id) as p1allcounts,dept_id from smg_images where is_recommend=1 group by dept_id) p1 on a.id=p1.dept_id left join  (select count(dept_id) as p2counts,dept_id from smg_images where is_adopt=1 group by dept_id) p2 on p1.dept_id = p2.dept_id
left join (select count(dept_id) as v1allcounts,dept_id from smg_video where is_recommend=1 group by dept_id) v1 on a.id=v1.dept_id left join  (select count(dept_id) as v2counts,dept_id from smg_video where is_adopt=1 group by dept_id) v2 on v1.dept_id = v2.dept_id
order by b.allcounts desc) tb order by a1 desc limit 10";
			$pubcount=$db->query($sql);
			$total=0;
			for($i=0;$i<count($pubcount);$i++)
			{
				$total=$total+(int)$pubcount[$i]->a1;
			}
			 for($i=0;$i<count($pubcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->a1/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->a1/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			<? }?>
			</div>
			
			<div id=b_b_2 class="b_b" style="display:none;">
			<?php 
			 $sql="select * from smg_dept order by click_count desc limit 10";
			 $clickcount=$db->query($sql);
			 $total=$db->query("select sum(click_count) as total from smg_dept");
			 for($i=0;$i<count($clickcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo delhtml($clickcount[$i]->name);?></div><div class=percentage><?php $count=$clickcount[$i]->click_count/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo delhtml($clickcount[$i]->name);?></div><div class=percentage><?php $count=$clickcount[$i]->click_count/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			 <? }?>
			 </div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

