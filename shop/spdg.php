<? 
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	$db=get_db();
	$tg=$db->query('select * from smg_shop where id='.$id);
	$strsql='select * from smg_shop_signup where tg_id='.$id.' order by createtime desc';
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
	<title>SMG网店 -<? echo $tg[0]->title;?></title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery();
		js_include_once_tag('spdg'); ?>
</head>
<body>
<? require_once('../inc/top.inc.html');	?>
<div id=bodys>
<div id=nyf_left>
	<form name="fqtg" method="post" action="/shop/spdg.post.php"> 
 		<div id=content1><a href="/">首页</a>　>　<? echo $tg[0]->title;?></div>
 		<div style="width:100px; height:20px; margin-top:12px; margin-left:25px; text-align:center; float:left; display:inline;">姓名</div>	
    	<div style="width:250px; height:20px; margin-top:12px; margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;">商品名称</div><div style="width:30px; margin-left:10px; margin-top:12px; text-align:center; float:left; display:inline;">数量</div>　　
    	<div style="width:200px; height:20px; margin-top:-2px; margin-left:20px; text-align:center; color:#0071B5; float:left; display:inline;">订购时间</div>
    <? for($i=0;$i<count($nyf);$i++){?>	
    	<div style="width:100px; height:20px; margin-top:12px; margin-left:25px; text-align:center; float:left; display:inline;"><?php echo $nyf[$i]->name;?></div>	
    	<div style="width:250px; height:20px; margin-top:12px; margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;"><?php echo $nyf[$i]->spname; ?></div><div style="width:30px; margin-top:12px; margin-left:10px; text-align:center; float:left; display:inline;"><? echo $nyf[$i]->num;?></div>　　
    	<div style="width:200px; height:20px; margin-top:12px; margin-left:20px; text-align:center; color:#0071B5; float:left; display:inline;"><?php echo $nyf[$i]->createtime; ?></div>	
    	
    <? }?>

      <div class=pageurl>
      	<?php paginate('spdg.php?id='.$id);?>
      </div>

       <div id=content9 <? if(strtotime(date("Y-m-d H:i:s")) > strtotime($tg[0]->endtime)){?>style="display:none;"<? }?>>
       	<hr>
       	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
       	 商品名称：<input type="text" id="spname" name="spname"><br>
       	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br>  	 
    	   联系方式：<input type="text" id="phone" name="phone"><br>
    	   <? if($tg[0]->issendfq==0){?>送货地址：<input type="text" id="address" name="address"><? } else {?><input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网"><? }?><br> 
    	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
    	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
       </div> 
       <div <? if(strtotime(date("Y-m-d H:i:s")) > strtotime($tg[0]->endtime)){?>style="display:none;"<? }?> id=content11 class="dg" >订　购</div>
      </form>
 </div>

 <div id=n_right>
 		<div id=content>
 			<div class=title>图片新闻</div>
			<? 
 	    $photonews = $db->query('select * from smg_images where is_adopt=1 order by priority asc, created_at desc limit 3');
 	    for($i=0;$i<count($photonews);$i++){?>
 			<div class=pic><a href="/news/news.php?id=<?php echo $photonews[$i]->id;?>" target="_blank"><img border=0  src="<?php echo $photonews[$i]->url;?>" width="160" height="105"></a></div>
 			<div class=name><a href="/news/news.php?id=<?php echo $photonews[$i]->id;?>"><?php echo $photonews[$i]->title;?></a></div>
 			<? }?>
 		</div>
		<div id=r1>
	 		 <div id=bbs>
	 				<div class=title>论坛　　　　　　　　　<a href="/bbs/">进入论坛</a></div>
					<?php for($i=0;$i<count($bbs);$i++){ ?>
						<div class=t_r_m_content><img src="/images/number/<?php echo $i+1;?>.jpg"> <a target="_blank" <?php if($i<3){?>style="color:red;"<?php } ?> href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid;?>"><?php echo $bbs[$i]->subject; ?></a></div>
					<?php } ?>
	 		 </div> 	
	 		 <div id=blog>
	 				<div class=title>博客　　　　　　　　　<a href="/blog">进入博客</a></div>
				 <?php for($i=0;$i<count($blog);$i++){ ?>
						<div class=t_r_m_content><img src="/images/number/<?php echo $i+1;?>.jpg"> <a target="_blank" <?php if($i<3){?>style="color:red;"<?php } ?> href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></div>
					<?php } ?>
	 		 </div>
		</div>
 </div>
</div>
<? require_once('../inc/bottom.inc.html');
?>	
</body>
</html>