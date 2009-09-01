<?
	require_once('../../frame.php');
  $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -党建新闻列表</title>
	<?php css_include_tag('subject_templete/templet1');
		use_jquery();
		js_include_once_tag('dj');
	?>
</head>
<body>
	<div id=bodys>			
		<? include('inc/djtop.inc.php');?>
					<div id=right>
							<?php 
								$modules = new smg_subject_module_class();
								$modules = $modules->find('all',array('conditions' => "subject_id = 24 and pos_name='pos2'",'order' => "priority asc,id desc"));
								for($i=0;$i<count($modules);$i++)
								$modules[$i]->display();
							?>
							<div id="pos3">
								<?php 
									$modules = new smg_subject_module_class();
									$modules = $modules->find('all',array('conditions' => "subject_id = 24 and pos_name='pos3'",'order' => "priority asc,id desc"));
									for($i=0;$i<count($modules);$i++)
									$modules[$i]->display();
								?>
							</div>
							<div id="pos4">
								<?php 
									$modules = new smg_subject_module_class();
									$modules = $modules->find('all',array('conditions' => "subject_id = 24 and pos_name='pos4'",'order' => "priority asc,id desc"));
									for($i=0;$i<count($modules);$i++)
									$modules[$i]->display();
								?>
							</div>
						<div class=title>领导讲话<div class=more><a target="_blank" href="djlist.php?id=<?php echo $ldjh[0]->cid;?>">更多</a></div></div>
						<div class=title>步骤安排<div class=more><a target="_blank" href="djlist.php?id=<?php echo $bzap[0]->cid;?>">更多</a></div></div>
						<div style="width:350px; float:left; display:inline;">
							<? 		$photourl="";
									for($i=0;$i<count($ldjh);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$ldjh[$i]->photo_src;	
									 }
									}
							?>
							<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
							
								<? 	
								for($i=0;$i<count($ldjh);$i++){?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $ldjh[$i]->id;?>"><? echo $ldjh[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							
						</div>
							<?
								$photourl="";
									for($i=0;$i<count($bzap);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$bzap[$i]->photo_src;	
									 }
									}
							?>
							<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
							
								<?
								for($i=0;$i<count($news1);$i++){?>
									<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $bzap[$i]->id;?>"><? echo $bzap[$i]->short_title;?></a></div>
									<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							
						<div class=bg>
							<div class=title style="margin-left:10px;">文件摘编<div class=more><a target="_blank" href="djlist.php?id=<?php echo $wjzb[0]->cid;?>">更多</a></div></div>
							<div class=title style="margin-left:10px;">经验介绍<div class=more><a target="_blank" href="djlist.php?id=<?php echo $jyjs[0]->cid;?>">更多</a></div></div>
							<div style="width:350px; float:left; display:inline;">
								<?	$photourl="";
									for($i=0;$i<count($wjzb);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$wjzb[$i]->photo_src;	
									 }
									}
								?>
								<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
									
										<? 	
										for($i=0;$i<count($wjzb);$i++){?>
										<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $wjzb[$i]->id;?>"><? echo $wjzb[$i]->short_title;?></a></div>
										<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
										<? }?>
									
							</div>
						<? 	$photourl="";
									for($i=0;$i<count($jyjs);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$jyjs[$i]->photo_src;	
									 }
									}
						?>
						<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
						
							<?
							for($i=0;$i<count($jyjs);$i++){?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $jyjs[$i]->id;?>"><? echo $jyjs[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
							<? }?>
						
						</div>
						<?php 
							$modules = new smg_subject_module_class();
							$modules = $modules->find('all',array('conditions' => "subject_id = 24 and pos_name='pos5'",'order' => "priority asc,id desc"));
							for($i=0;$i<count($modules);$i++)
							$modules[$i]->display();
						?>
						<div class=bg>
							<div class=title style="margin-left:10px;">学习资料<div class=more><a target="_blank" href="djlist.php?id=<?php echo $xxzl[0]->cid;?>">更多</a></div></div>
							<div class=title style="margin-left:10px;">三分钟论坛<div class=more><a target="_blank" href="djlist2.php">更多</a></div></div>
							
							<div style="width:350px; float:left; display:inline;">							
									<? for($i=0;$i<count($xxzl);$i++){?>
									<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $xxzl[$i]->id;?>"><? echo $xxzl[$i]->short_title;?></a></div>
									<? if($i<2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
									<? }?>
								
							</div>
							<? $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="三分钟论坛" inner join smg_subject s on c.subject_id=s.id and s.name="学习实践活动专题" order by n.priority asc, n.last_edited_at desc limit 6'); ?>
							
								<? for($i=0;$i<count($news);$i++){?>
								<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }
								$news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="即知即改" inner join smg_subject s on c.subject_id=s.id and s.name="学习实践活动专题" order by n.priority asc, n.last_edited_at desc limit 6')
								?>	
							<div class=title style="margin-left:10px;">即知即改<div class=more><a target="_blank" href="djlist.php?id=<?php echo $news[0]->cid;?>">更多</a></div></div>
							<div class=title style="margin-left:10px;">三分钟答题</div>
							<div style="width:350px; height:90px; float:left; display:inline;">
									<? for($i=0;$i<count($news);$i++){?>
									<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
									<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
									<? }?>
							</div>
							<? $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="三分钟答题" inner join smg_subject s on c.subject_id=s.id and s.name="学习实践活动专题" order by n.priority asc, n.last_edited_at desc limit 6'); ?>
								<? for($i=0;$i<count($news);$i++){?>
								<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a <? if($i<1){?>style="color:red; font-weight:bold;"<? }?> target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
						</div>
						<div class=bg>
						<div id=contenttitle style="margin-left:8px;">征求意见</div>
							<? 
							$comments = $db->paginate('select * from smg_comment where resource_type="djnews" order by created_at desc');
							for($i=0;$i<count($comments);$i++){?>
								<div class=content7>
									<div class=name><a href="#"><?php echo $comments[$i]->nick_name; ?></a></div>	
									<div class=time><?php echo $comments[$i]->created_at; ?></div>	
									<div class=context><?php echo strfck($comments[$i]->comment); ?></div>	
								</div>
								<? }?>						
							  <div class="pageurl">
							     <? paginate('');?>
							  </div>
							<form name="commentform" id="commentform" method="post" action="/pub/pub.post.php">
							   <div id=content9>
								   用户：<input type="text" value="" id="commenter" name="post[nick_name]">   	
							   </div>
							   <div id=content10>
								  <div id=plleft>意见：</div><textarea id="commentcontent" name="post[comment]"></textarea>
							   </div>   
							   <div id=content11></div>
							   	<input type="hidden" id="resource_type" name="post[resource_type]" value="djnews">
								<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
								<input type="hidden" name="type" value="comment">
							   <input type="hidden" value="<? echo count($data,COUNT_RECURSIVE);?>">
								<input type="hidden" value="<? echo count($deptname);?>">
							</form>
						</div>
					</div>
					<? include('inc/djbottom.inc.php');?>
				</div>

</body>
</html>

