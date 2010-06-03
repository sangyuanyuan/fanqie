<?php
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	if($id==""||$id==null){die('没有找到网页');}
	$cookie= (isset($_COOKIE['vote_user'])) ? $_COOKIE['vote_user'] : 0;
	/*$cookie1=isset($_COOKIE['news_head_'.date('Y-m-d').$id]) ? $_COOKIE['news_head_'.date('Y-m-d').$id] : 0;
	if($cookie1==0)
	{
		setcookie('news_head_'.date('Y-m-d').$id,1);
	}
	else
	{
		setcookie('news_head_'.date('Y-m-d').$id,$cookie1+1);
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	
	<title>SMG-番茄网-新闻-新闻头条</title>
	<? 
		$string = 'http://' .$_SERVER[HTTP_HOST].$_SERVER['PHP_SELF'].'?id='.$id;
		css_include_tag('news_news_head','top','bottom');
		use_jquery();
		js_include_once_tag('pubfun','news','pub','total','total1');
		$datetime1=date('Y-m-d')." 00:00:00";
		$datetime2=date('Y-m-d')." 23:59:59";
		$db = get_db();
		$strsql='select * from smg_total2 where name="news_head" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
		$record=$db -> query($strsql);
		if(!$record || count($record)==0)
		{
			$strsql='insert into smg_total2 (platform,name,datetime,count,parentname) values("news","news_head",now(),1,"news")'; 
			$record = $db->execute($strsql);
		}
		else
		{
			$strsql='update smg_total2 set count=count+1 where name="news_head" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
			$record = $db->execute($strsql);
		}
		
		close_db();
		$db = get_db();
		$sql="select n.*,c.id as cid,c.name as categoryname,d.name as deptname,c.platform as cplatform from smg_news n inner join smg_category c on n.category_id=c.id inner join smg_dept d on n.dept_id=d.id and n.id=".$id;
		$record=$db->query($sql);
		if($record[0]->cplatform=="news"||$record[0]->cplatform=="show"||$record[0]->cplatform=="server"||$record[0]->cplatform=="zone"){
			$platform = $record[0]->cplatform;
			$name = $record[0]->categoryname;
		}else{
			$platform = 'news';
			$name = '部门或专题';
		}
		$strsql='select * from smg_total where platform="'.$platform.'" and parentname="'.$_SERVER['PHP_SELF'].'" and name="'.$name.'" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
		$record1=$db -> query($strsql);
		if(!$record1 || count($record1)==0)
		{
			$strsql='insert into smg_total (platform,name,datetime,count,parentname) values("'.$platform.'","'.$name.'",now(),1,"'.$_SERVER['PHP_SELF'].'")'; 
			$db->execute($strsql);
		}
		else
		{
			$strsql='update smg_total set count=count+1 where parentname="'.$_SERVER['PHP_SELF'].'" and platform="'.$platform.'" and name="'.$name.'" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
			$db->execute($strsql);		
		}
		
  //if($cookie1<=200){
  //if($record[0]->cplatform=="news"){?>
<script>
	//total("<?php echo $record[0]->categoryname; ?>","news");
</script>
<?php //}else if($record[0]->cplatform=="show"){ ?>
<script>
	//total("<?php echo $record[0]->categoryname; ?>","show");
</script>
<?php //}else if($record[0]->cplatform=="server"){?>
<script>
	//total("<?php echo $record[0]->categoryname; ?>","server");
</script>
<?php// }else if($record[0]->cplatform=="zone"){?>
<script>
	//total("<?php echo $record[0]->categoryname; ?>","zone");
</script>
<?php// }else{?>
<script>
	//total("部门或专题","news");
</script>
<?php //}

//} 
?>
</head>
<?php 
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
		$page=$_REQUEST['page'];
		$page_size=10;
		$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc";
		$comment=$db->query($sql);
		$rs_num=count($comment);
		if($rs_num <= 5){
			$page_count = 0;
		}else{
			$page_count = 1+ ceil(($rs_num - 5) / $page_size);
		}
		
		/*
		if( ($rs_num-5) > 0 ){
	   		if( ($rs_num-5) < $page_size ){ $page_count = 2; }               
	   		if( ($rs_num-5) % $page_size ){                                  
	       		$page_count = (int)($rs_num / $page_size) + 2;           
	   		}else{
	       		$page_count = (int)($rs_num / $page_size) + 1;                      
	  		}
		}
		else{
	   		$page_count = 0;
		}
		*/
		if ($page=="")  {$page=1;}
		if ($page > $page_count)  {$page=$page_count;}
		//if ($page==0)  {$page=1;}
		if ($page <= 0)  {$page=1;}
		if($page > 1)
		{
			$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc limit ".(((int)$page-1)*$page_size - 5).",".$page_size;
		}
		else
		{
			$page_size=5;
			$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc limit ".(((int)$page-1)*$page_size).",".$page_size;
		}
		$comment=$db->query($sql);
		//$sql="select count(*) as flowernum,(select count(*) from smg_digg cd where cd.type='tomato' and cd.diggtoid=d.diggtoid and cd.file_type='comment') as tomatonum,(select count(*) from smg_digg cd where cd.diggtoid=d.diggtoid and cd.file_type='comment') as total,c.*,d.diggtoid from smg_digg d inner join smg_comment c on d.diggtoid=c.id and d.type='flower' and d.file_type='comment' and resource_type='news' and  c.resource_id=".$id." and d.file_type='comment' group by diggtoid order by total desc limit 2";
		//$digg=$db->query($sql);
?>
<body <?php if($record[0]->forbbide_copy == 1){ ?> oncontextmenu="return false" ondragstart="return false" onselectstart ="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onbeforecopy="return false" onmouseup="document.selection.empty()" <?php }?>>
<? 
if($record[0]->news_type==2)
{
	redirect($record[0]->file_name);
}
else if($record[0]->news_type==3)
{
	if(strpos($record[0]->target_url,basename($_SERVER['PHP_SELF']))&&strpos($record[0]->target_url,'id='.$id)){
		alert('对不起，链接出错了！请联系管理员!');
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
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="news_list.php">新闻</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span> <?php if($record[0]->cid!=157){ ?><a href="/news/news_list.php?id=<? echo $record[0]->cid;?>"><?php echo $record[0]->categoryname;?></a><? }else{?><a href="/news/dylist.php">改革发展调研</a><?php } ?>
		</div>
		<?php $sql="update smg_news set click_count=click_count+1 where id=".$id;
$db->execute($sql); ?>
		<div id=l_b>
			<div id=title><?php echo delhtml($record[0]->title);?></div>
			<div id=comefrom><?php if($record[0]->publisher_id!=""&&$record[0]->categoryname=="我要报料"){?>作者：<?php echo $record[0]->publisher_id;}else{?>来源：<?php echo $record[0]->deptname;?>　<?php } ?>　浏览次数：<span style="color:#C2130E"><?php echo $record[0]->click_count;?></span>　时间：<?php echo $record[0]->created_at;?></div>
			<?php if($page==1||$page=="")
			{?>
			<div id=content>
				<?php if($record[0]->video_src!=""&&$record[0]->video_src!=null){
					if($record[0]->low_quality==0){
				?>
				<div id=video><?php show_video_player('400','300',$record[0]->video_photo_src,$record[0]->video_src); ?></div>
				<?php }else
				{?>
				 	<div id=video><?php show_video_player('200','150',$record[0]->video_photo_src,$record[0]->video_src); ?></div>
				<?php }} ?>
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
			<div id=contentpage><?php echo print_fck_pages($record[0]->content,"/news/news_head.php?id=".$id); ?></div>
			<?php if($record[0]->categoryname=="我要报料"){?><div id=lc>此文系番茄网网友报料新闻，不代表番茄网的观点或立场。</div><?php } ?>
			<?php } ?>
			<?php 
				if(count($comment)>0){?>
			<div id=comment>
				<?php if(count($digg)>0){
				 for($i=0;$i<count($digg);$i++){ ?>
					<!--<div class=content>	
						<div class=title1>
							<div style="width:110px; height:20px; margin-left:118px; overflow:hidden; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><? echo $digg[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; height:30px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $digg[$i]->id;?>" style="none"><div id="hidden_flower" style="width:65px; height:12px; margin-left:3px; margin-top:8px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $digg[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $digg[$i]->id;?>" style="none"><div style="width:60px; height:15px; margin-top:8px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $digg[$i]->tomatonum;?></div></div>
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
							<div style="width:230px; height:20px; margin-top:10px; margin-left:10px; overflow:hidden; line-height:20px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $comment[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $comment[$i]->id;?>" style="none"><div id="hidden_flower" style="width:65px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $comment[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $comment[$i]->id;?>" style="none"><div style="width:60px; height:15px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $comment[$i]->tomatonum;?></div></div>　
								<div style="width:140px; line-height:20px; color:#FF0000; float:right; display:inline"><?php echo $comment[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
							<?php echo strfck($comment[$i]->comment);?>
						</div>
					</div>
				<?php }?>		
			</div>
			<div class=page>
	<?php
	if($rs_num >5)
	{
	if ($page == 1 || $page ==null || $page == "")
	{?>
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=<?php echo $page+1;?>">[下页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=<?php echo $page_count-1; ?>">[尾页]</a></span>
	<?php	
	}
	if ($page < $page_count && $page > 1 )
	{?>
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=1">[首页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=<?php echo $page-1;?>">[上页]</a></span>			
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=<?php echo $page+1;?>">[下页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=<?php echo $page_count-1; ?>">[尾页]</a></span>		
	 <?php
	}
	if ($page == $page_count)
	{?>
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=1">[首页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $string;?>&page=<?php echo $page-1;?>">[上页]</a></span>		
	<?php	
	}
	?>共找到<?php echo $rs_num; ?>条记录　
  当前第<select name="pageselect" id="pageselect" onChange="jumppage('<?php echo $string."&page="; ?>',this.options[this.options.selectedIndex].value);">
	<?php	
	//产生所有页面链接
	for($i=1;$i<=$page_count;$i++){ ?>
		<option <?php if($page== $i) echo 'selected="selected"';?> value="<?php echo $i;?>" ><?php echo $i;?></option>
		<?php	
	}
	?>
	</select>页　共<?php echo $page_count;?>页
	<script>
			function jumppage(urlprex,pageindex)
			{
				var surl=urlprex+pageindex;
				<?php
				if($ajax_dom){ ?>
					$('#<?php echo $ajax_dom;?>').load(surl);
				<?php  }else{ ?>
					window.location.href=surl;
				<?php }
				?>	
				
			} 
	</script>
	
	<?php
	if(!empty($ajax_dom)){
		?>
		<script>
			$(".paginate_link").click(function(e){
				e.preventDefault();
				$("#<?php echo $ajax_dom;?>").load($(this).attr('href'));
			});
		</script>
		<?php
	}}?>
			</div>
			<?php }
				if($record[0]->is_commentable==1){
			?>
			<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
			<div class=abouttitle>发表评论</div>
			<div class=aboutcontent style="padding-bottom:10px;">
				<div class=title style="background:#ffffff;">现有<span style="color:#FF5800;"><?php $totalcoment=$db->query("select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc"); echo count($totalcoment);?></span>人对本文进行了评论<?php if(count($totalcoment)>0){ ?>　　<a target="_blank" style="color:#1862A3"  href="/comment/comment_list.php?id=<?php echo $id;?>&type=news">查看更多评论</a><?php } ?>　　<a target="_blank" style="color:#1862A3;"  href="/comment/all_comment.php">查看所有评论</a></div>
				<input type="text" id="commenter" name="post[nick_name]">
				<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="news">
				<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
				<input type="hidden" name="type" value="comment">
				<div style="margin-top:5px; margin-left:13px; float:left; display:inline;"><?php show_fckeditor('post[comment]','Title',false,'75','','617');?></div>
				<div id=fqbq>
					
				</div>
				<button id="comment_sub">提交评论</button>
			</div>
			</form>
			<?php }?>
			<div id=wybl><a style="margin-left:20px;"  href="/news/news_sub.php"><img border=0 src="/images/news/news_head_r_t.jpg"></a></div>
			<div id=more><a target="_blank" href="/news/news_list.php?id=<?php echo $record[0]->cid;?>">查看更多新闻>></a></div>
			<?php if(count($about)>0||count($about)>0){?>
			<div class=abouttitle>更多关于“<?php echo mb_substr(strip_tags($record[0]->short_title),0,36,"utf-8");?>"的新闻</div>
			<div class=aboutcontent style="padding-bottom:10px;">
				<div class=title>相关链接</div>
					<?php for($i=0;$i<count($about);$i++){
					?>
				<div class=content>
						<?php if($about[$i]->category_id=="1"||$about[$i]->category_id=="2"){ ?>
							·<a  href="/<?php echo $about[$i]->platform ?>/news/news_head.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->created_at; ?>)</span>
							</a>
						<?php }else{?>
							·<a  href="/<?php echo $about[$i]->platform ?>/news/news.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->created_at; ?>)</span>
							</a>
						<?php }?>
					</div>		
				<?php }?>		
			</div>
			<?php } ?>
			
		</div>
	</div>
	
	<div id=ibody_right>
		<div id=r_b2 style="margin-top:0px;">
			<div class=b_head_title1 param=1>本月部门发表量</div>
			<div class=b_head_title1 param=2 style="background:none; color:#000000;">本月点击排行榜</div>
			<div id=b_b_1 class="b_b" style="display:block">
			<?php 
			 $sql="SELECT * FROM smg_fgl_count";
			$pubcount=$db->query($sql);
			$total=0;
			for($i=0;$i<count($pubcount);$i++)
			{
				$total=$total+(int)$pubcount[$i]->fgl;
			}
			 for($i=0;$i<count($pubcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->fgl/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->fgl/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			<? }?>
			</div>
			
			<div id=b_b_2 class="b_b" style="display:none;">
			<?php 
			 $sql="select * from smg_djl_count";
			 $clickcount=$db->query($sql);
			 for($i=0;$i<count($clickcount);$i++)
			 {
			 	if($clickcount[$i]->name!="集团办公室"&&$clickcount[$i]->name!="传媒人报"&&$clickcount[$i]->name!="精神文明办")
			 	{
			 			$click[]=array((int)$clickcount[$i]->num,$clickcount[$i]->name);
			 	}
			 	else if($clickcount[$i]->name=="集团办公室")
			 	{
			 			$cmrb=$db->query("select num from smg_djl_count where name='传媒人报'");
			 			$jswmb=$db->query("select num from smg_djl_count where name='精神文明办'");
			 			$jtbgs=(int)$clickcount[$i]->num+(int)$cmrb[0]->num+(int)$jswmb[0]->num;
			 			$click[]=array($jtbgs,$clickcount[$i]->name);
			 	}
			 }
			 $click=array2sort($click,0,'d');
			 $total=$db->query("select sum(num) as total from smg_djl_count");
			 for($i=0;$i<10;$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i< 3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo delhtml($click[$i][1]);?></div><div class=percentage><?php $count=$click[$i][0]/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo delhtml($click[$i][1]);?></div><div class=percentage><?php $count=$click[$i][0]/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			 <? }?>
			 </div>
		</div>
		<div id=r_t style="margin-top:10px; margin-bottom:10px;">
			<?php //$bbtv=$db->query('select file_name from smg_news where dept_category_id=198 and is_dept_adopt=1 order by priority asc,created_at desc'); ?>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="298" height="88" id="FLVPlayer">
			 <param name="movie" value="/flash/news.swf" />
			 <param name="salign" value="lt" />
			 <param name="quality" value="high" />
			 <param name="wmode" value="opaque" />
			 <param name="scale" value="noscale" />
			 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" />
			 <embed src="/flash/news.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" quality="high" scale="noscale" width="298" height="88" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
			<!--<embed src="<?php echo $bbtv[0]->file_name; ?>" wmode=transparent quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="298" height="88"></embed>
			<?php $bbtv=$db->query('select src from smg_images where dept_category_id=197 order by priority asc,created_at desc'); ?>
			<a target="_blank" href="http://www.bbtv.cn"><img border=0 src="<?php echo $bbtv[0]->src; ?>"></a>-->
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
			 			<div class=cl1><a  href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }else{?>
						<div class=pic2>
							<?php if($i<9){
								 echo "0".($i+1);
								 }else{ echo $i+1;}?>
						</div>
						<div class=cl2><a  href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<?php }?>
		<div class=r_b1>
			<div class=title>历史头条</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n inner join smg_category c on c.id=n.category_id and n.is_adopt=1 and n.id<>".$id." and n.tags='历史头条' order by n.created_at desc limit 8";
			 $morehead=$db->query($sql);
			 for($i=0;$i<count($morehead);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a  href="/<?php echo $morehead[$i]->platform;?>/news/news_head.php?id=<?php echo $morehead[$i]->id;?>"><?php echo delhtml($morehead[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<div class=cl2><a  href="/<?php echo $morehead[$i]->platform;?>/news/news_head.php?id=<?php echo $morehead[$i]->id;?>"><?php echo delhtml($morehead[$i]->short_title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<div class=r_b1>
			<div class=title>小编加精</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n left join smg_category c on c.id=n.category_id where n.is_adopt=1 and n.id<>".$id." and n.tags='小编加精' order by n.priority asc,n.created_at desc limit 10";
			 $xbjj=$db->query($sql);
			 for($i=0;$i<count($xbjj);$i++){
			 ?>
			 	<div class="r_content">
			 		<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl1>·<a  href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else
					{?>
						<div class=cl1>·<a href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

