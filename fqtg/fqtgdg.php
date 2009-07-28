<? 
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	$db=get_db();
	$tg=$db->query('select * from smg_tg where id='.$id);
	$count=$db->query('select sum(num) as total from smg_tg_signup where tg_id='.$id);
	$dept=$db->query('SELECT * FROM smg_dept s where dept_id<>0');
	$strsql='select * from smg_tg_signup where tg_id='.$id.' order by createtime desc';
	$nyf=$db->paginate($strsql,25);
	$sql="SELECT tid,subject FROM bbs_posts where subject<>'' order by pid desc limit 6";
	$bbs=$db->query($sql);
	$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by itemid desc limit 6";
	$blog=$db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG团购 -<? echo $tg[0]->title;?></title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery(); 
		js_include_once_tag('fqtgdg1');
	?>
</head>
<body>
<? 
	include('../inc/top.inc.html');
	
?>
<div id=bodys>
<div id=nyf_left>
 		<div id=content1><a href="/">首页</a>　>　<? echo $tg[0]->title;?></div>
		<div style="width:650px; height:20px; margin-top:12px; overflow:hidden; float:left; display:inline;">
	 		<div style="width:100px; height:20px; margin-left:10px;  text-align:center; float:left; display:inline;">姓名</div>
	    <div style="width:250px; height:20px; margin-left:10px;  text-align:center; overflow:hidden; float:left; display:inline;">商品名称</div>
			<div style="width:30px; height:20px; margin-left:10px; text-align:center; float:left; display:inline;">数量</div>
			<div style="width:150px; height:20px; margin-left:10px; text-align:center; color:#0071B5; overflow:hidden; float:left; display:inline;">订购时间</div>
    	<? if($_COOKIE['smg_userid']==157||$_COOKIE['smg_userid']==3924||$_COOKIE['smg_userid']==3382){?><div style="width:65px; height:20px; margin-left:10px;  text-align:center; float:left; display:inline;">操作</div><? }?>
    </div>
    <? for($i=0;$i<count($nyf);$i++){?>	
	<div style="width:650px; height:20px; margin-top:12px;  float:left; display:inline;">
    	<div style="width:100px; height:20px;  margin-left:10px; text-align:center; float:left; display:inline;"><?php echo $nyf[$i]->name;?></div>	
    	<div style="width:250px; height:20px;  margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;"><?php echo $nyf[$i]->spname; ?></div>
			<div style="width:30px; height:20px;  margin-left:10px; text-align:center; float:left; display:inline;"><? echo $nyf[$i]->num;?></div>
			<div style="width:150px; height:20px; margin-left:15px;  text-align:center; color:#0071B5; float:left; display:inline;"><?php echo $nyf[$i]->createtime; ?></div>
    	<? if($_COOKIE['smg_userid']==157||$_COOKIE['smg_userid']==3924||$_COOKIE['smg_userid']==3382){?><div style="width:65px; height:20px; margin-left:10px; text-align:center; color:#0071B5; float:left; display:inline"><? if($nyf[$i]->state=="0"){?><button class="lq" style="border:0px;">领取</button><input type="hidden" value="<?php echo $nyf[$i]->id; ?>"><? }else{?><span class="ylq" name="<?php echo $nyf[$i]->id; ?>" style="cursor:pointer;">已领取</span><? }?></div><? }?>
    </div>
	<? }?>

      <div class=pageurl>
      	<?php paginate('fqtgdg.php?id='.$id);?>
      </div>
      <form name="fqtg" method="post" action="/fqtg/fqtgdg.post.php"> 
			<? if($tg[0]->maxnum==""){
       	if(strtotime(date("Y-m-d H:i:s")) < strtotime($tg[0]->endtime)){
       		?>
       <div id=content9>
       	<hr>
       	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
       	 您的部门：<select id="deptid" name="deptid">
					<? for($i=0;$i<count($dept);$i++){?>
						<option  value=<? echo $dept[$i]->id;?><? if($dept[$i]->id==7){?> selected="selected"<? }?>><? echo $dept[$i]->name;?></option>
					<? }?>
				</select><br>
       	 商品名称：<input type="text" id="spname" name="spname"><br>
       	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br>  	 
    	   联系方式：<input type="text" id="phone" name="phone"><br>
    	   <? if($tg[0]->issendfq==0){?>送货地址：<input type="text" id="address" name="address"><? } else {?><input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网"><? }?><br> 
    	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
    	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
    	   <input type="hidden" id="tg_maxnum" name="tg_maxnum" value="<? echo $tg[0]->maxnum;?>">
    	   <input type="hidden" id="tg_count" name="tg_count" value="<? echo $count[0]->total;?>">
       </div> 
       
       <div id=content11>订　购</div>
       	<? 
      		}
       	}
       	else{
					 if(strtotime(date("Y-m-d H:i:s")) < strtotime($tg[0]->endtime)&&($tg[0]->maxnum > $count[0]->total)){
       	?>
       	<div id=content9>
       	<hr>
       	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
       	 您的部门：<select id="deptid" name="deptid">
								<? for($i=0;$i<count($dept);$i++){?>
									<option value=<? echo $dept[$i]->id;?><? if($dept[$i]->id==7){?> selected="selected"<? }?>><? echo $dept[$i]->name;?></option>
								<? }?>
							</select><br>
       	 商品名称：<input type="text" id="spname" name="spname"><br>
       	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br>  	 
    	   联系方式：<input type="text" id="phone" name="phone"><br>
    	   <? if($tg[0]->issendfq==0){?>送货地址：<input type="text" id="address" name="address"><? } else {?><input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网"><? }?><br> 
    	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
    	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
    	   <input type="hidden" id="tg_maxnum" name="tg_maxnum" value="<? echo $tg[0]->maxnum;?>">
    	   <input type="hidden" id="tg_count" name="tg_count" value="<? echo $count[0]->total;?>">
       </div> 
       	<div id=content11 >订　购</div><? }?>
       	<? }?>
      </form>
 </div>

 <div id=ibody_right>
 	<div id=r_m>
			<div id=title>小编推荐</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n inner join smg_category c on n.category_id=c.id and is_adopt=1 and tags='小编推荐' order by n.priority asc,last_edited_at desc limit 8";
			 $xbjj=$db->query($sql);
			 for($i=0;$i<count($xbjj);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 		<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl1><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else
					{?>
						<div class=cl1><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}else{
						?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl2><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=cl2><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}?>				
				</div>
			<?php }?>
		</div>
		<div id=r_b_t>
			<div class=b_t_title1 param=1>论坛新帖</div>
			<div class=b_t_title1 param=2>博客新帖</div>
			<div class=b_t_title1 param=3 style="background:url(/images/news/news_r_b_t_title2.jpg) no-repeat">精彩视频</div>
			<div class="b_t" id="b_t_1" style="display:none;">
				<? 
					$sql="SELECT tid,subject FROM bbs_posts where subject<>'' order by pid desc limit 10";
					$bbs=$db->query($sql);
					for($i=0;$i<count($bbs);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid;?>"><?php echo $bbs[$i]->subject; ?></a></li>
					</ul>		
				</div>
				<? }?>
			</div>
			<div class=b_t id="b_t_2" style="display:none;">
				<? 
					$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by itemid desc limit 10";
					$blog=$db->query($sql);
					for($i=0;$i<count($blog);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></li>		
					</ul>
				</div>
				<? }?>
			</div>
			<div class=b_t id="b_t_3" style="display:inline;">
			<?php 
			 $sql="select id,title from smg_video where is_adopt=1 order by priority asc,created_at desc limit 10";
			 $jcsp=$db->query($sql);
			 for($i=0;$i<count($jcsp);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<ul>
						<li>·<a target="_blank" href="/show/video.php?id=<?php echo $jcsp[$i]->id;?>"><?php echo strfck($jcsp[$i]->title); ?></a></li>
					</ul>			
				</div>
			<? }?>
			</div>
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 style="font-weight:bold; color:#000000; text-decoration:none;" param=1>部门发表量</div>
			<div class=b_b_title1 param=2 style="color:#C2130E; text-decoration:underline; background:url('/images/news/news_r_b_b_title1.jpg') no-repeat;">部门点击排行榜</div>
			<div id="b_b_1" class="b_b" style="display:none">
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
			
			<div id=b_b_2 class="b_b" style="display:block;">
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