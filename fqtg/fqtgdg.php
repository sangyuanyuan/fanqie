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
		js_include_once_tag('fqtgdg1','total');
	?>
<script>
	total("番茄团购","server");
</script>
</head>
<body>
<? 
	include('../inc/top.inc.html');
	$sql="SELECT count(*) as num FROM smg_tg_signup where tg_id=46 and name='".$_COOKIE['smg_user_nickname']."'";
	$num=$db->query($sql);
?>
<div id=bodys>
<div id=nyf_left>
 		<div id=content1><a href="/">首页</a>　>　<? echo $tg[0]->title;?></div>
		<div style="width:650px; height:20px; margin-top:12px; overflow:hidden; float:left; display:inline;">
			
	 		<div style="width:100px; height:20px; margin-left:10px;  text-align:center; float:left; display:inline;">姓名</div>
	    <div style="width:250px; height:20px; margin-left:10px;  text-align:center; overflow:hidden; float:left; display:inline;">商品名称</div>
			<div style="width:30px; height:20px; margin-left:10px; text-align:center; float:left; display:inline;">数量</div>
			<div style="width:150px; height:20px; margin-left:10px; text-align:center; color:#0071B5; overflow:hidden; float:left; display:inline;">订购时间</div>
    	<? if($_COOKIE['smg_userid']==157||$_COOKIE['smg_userid']==3926||$_COOKIE['smg_userid']==3384){?><div style="width:65px; height:20px; margin-left:10px;  text-align:center; float:left; display:inline;">操作</div><? }?>
    </div>
    <? for($i=0;$i<count($nyf);$i++){?>	
	<div style="width:650px; height:20px; margin-top:12px;  float:left; display:inline;">
    	<div style="width:100px; height:20px;  margin-left:10px; text-align:center; float:left; display:inline;"><?php echo $nyf[$i]->name;?></div>	
    	<div style="width:250px; height:20px;  margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;"><?php echo $nyf[$i]->spname; ?></div>
			<div style="width:30px; height:20px;  margin-left:10px; text-align:center; float:left; display:inline;"><? echo $nyf[$i]->num;?></div>
			<div style="width:150px; height:20px; margin-left:15px;  text-align:center; color:#0071B5; float:left; display:inline;"><?php echo $nyf[$i]->createtime; ?></div>
    	<? if($_COOKIE['smg_userid']==157||$_COOKIE['smg_userid']==3926||$_COOKIE['smg_userid']==3384){?><div style="width:65px; height:20px; margin-left:10px; text-align:center; color:#0071B5; float:left; display:inline"><? if($nyf[$i]->state=="0"){?><button class="lq" style="border:0px;">领取</button><input type="hidden" value="<?php echo $nyf[$i]->id; ?>"><? }else{?><span class="ylq" name="<?php echo $nyf[$i]->id; ?>" style="cursor:pointer;">已领取</span><? }?></div><? }?>
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
       	<?php if($id!=64)
				{?>
       	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
       	 您的部门：<select id="deptid" name="deptid">
					<? for($i=0;$i<count($dept);$i++){?>
						<option  value=<? echo $dept[$i]->id;?><? if($dept[$i]->id==7){?> selected="selected"<? }?>><? echo $dept[$i]->name;?></option>
					<? }?>
				</select><br>
       	 商品名称：<input type="text" id="spname" name="spname"><br>
       	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br>
       	 <?php } ?>  	 
    	   联系方式：<input type="text" id="phone" name="phone"><br>
    	   <? if($tg[0]->issendfq==0){?>送货地址：<input type="text" id="address" name="address"><? } else {?><input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网"><? }?><br> 
    	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
    	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
    	   <input type="hidden" id="tg_maxnum" name="tg_maxnum" value="<? echo $tg[0]->maxnum;?>">
    	   <input type="hidden" id="tg_count" name="tg_count" value="<? echo $count[0]->total;?>">
       </div> 
       <?php if((int)$num[0]->num==0){ ?>
       <div id=content11>订　购</div>
       <?php } ?>
       	<? 
      		}
       	}
       	else{
					 if(strtotime(date("Y-m-d H:i:s")) < strtotime($tg[0]->endtime)&&($tg[0]->maxnum > $count[0]->total)){
       	?>
       	<div id=content9>
       	<hr>
       		<?php if($id!=64)
				{?>
       	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
       	 您的部门：<select id="deptid" name="deptid">
								<? for($i=0;$i<count($dept);$i++){?>
									<option value=<? echo $dept[$i]->id;?><? if($dept[$i]->id==7){?> selected="selected"<? }?>><? echo $dept[$i]->name;?></option>
								<? }?>
							</select><br>
       	 商品名称：<input type="text" id="spname" name="spname"><br>
       	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br> 
       	 <?php } ?>  	 
    	   联系方式：<input type="text" id="phone" name="phone"><br>
    	   <? if($tg[0]->issendfq==0){?>送货地址：<input type="text" id="address" name="address"><? } else {?><input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网"><? }?><br> 
    	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
    	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
    	   <input type="hidden" id="tg_maxnum" name="tg_maxnum" value="<? echo $tg[0]->maxnum;?>">
    	   <input type="hidden" id="tg_count" name="tg_count" value="<? echo $count[0]->total;?>">
       </div>
       <?php if((int)$num[0]->num==0){ ?>
       	<div id=content11 >订　购</div>
       	<? }}}?>
      </form>
 </div>

 <div id=ibody_right>
		<div class=r_m>
			<div class=title>小编推荐</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n inner join smg_category c on n.category_id=c.id and is_adopt=1 and tags='小编推荐' order by n.priority asc,n.created_at desc limit 8";
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
		<div class=r_m>
			<div class=title>精彩视频</div>
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
		<div id=r_b_t>
			<div class=b_t_title1 style="background:url(/images/news/news_r_b_t_title2.jpg) no-repeat" param=1>论坛新帖</div>
			<div class=b_t_title1 param=2>博客新帖</div>
			<div class="b_t" id="b_t_1" style="display:block;">
				<? 
					$sql="SELECT tid,subject FROM bbs_posts where first=1 order by pid desc limit 5";
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
					$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by itemid desc limit 5";
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
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 style="font-weight:bold; color:#000000; text-decoration:none;" param=1>本月部门发表量</div>
			<div class=b_b_title1 param=2 style="color:#C2130E; text-decoration:underline; background:url('/images/news/news_r_b_b_title1.jpg') no-repeat;">本月点击排行榜</div>
			<div id="b_b_1" class="b_b" style="display:none">
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
			
			<div id=b_b_2 class="b_b" style="display:block;">
			<?php 
			 $sql="select * from smg_djl_count";
			 $clickcount=$db->query($sql);
			 for($i=0;$i<count($clickcount);$i++)
			 {
			 	if($clickcount[$i]->name!="集团办公室"&&$clickcount[$i]->name!="传媒人报")
			 	{
			 			$click[]=array((int)$clickcount[$i]->num,$clickcount[$i]->name);
			 	}
			 	else if($clickcount[$i]->name=="集团办公室")
			 	{
			 			$cmrb=$db->query("select num from smg_djl_count where name='传媒人报'");
			 			$jtbgs=(int)$clickcount[$i]->num+(int)$cmrb[0]->num;
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
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>