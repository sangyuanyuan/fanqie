﻿<? 
require_once('../frame.php');
	$actid = $_REQUEST['id'];
	$cookie=(isset($_COOKIE['smg_username'])) ? $_COOKIE['smg_username'] : 0;
	if($actid==""){die ('没有找到网页');}
	$db = get_db();
	$StrSql='update smg_tg set clickcount=clickcount+1 where id='.$actid;
	$Record = $db->execute($StrSql);
	$news=$db->query('SELECT * FROM smg_shop where id='.$actid);
	$countnews=$db->query('SELECT count(*) as total,sum(num) as zs FROM smg_shop_signup where tg_id='.$actid);
	$comments=$db->paginate('select * from smg_comment where resource_id='.$actid.' and resource_type="shop" order by created_at desc',5);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -商品详细</title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery(); 
		js_include_once_tag('tg','total');
	?>
<script>
	total("个人网店","server");
</script>
</head>
<body>

<? require_once('../inc/top.inc.html');?>
<div id=bodys>
 <div id=activitynews>
 		<div id=activity_content1><a href="/">首页</a>　>　<a href="#">商品简介</a></div>
		<div id=content2><? echo $news[0]->title;?></div>
 		<div id=content3>开始时间: <? echo $news[0]->starttime;?>  结束时间：<? echo $news[0]->endtime;?>  浏览量：<? echo $news[0]->clickcount;?></div>
		<div id=content4>
			<? 
			$start_date=date("Y-m-d H:i:s");
			$start_date_year = substr($start_date,0,4);
			$start_date_month = substr($start_date,5,2);
			$start_date_day = substr($start_date,8,2);   
			$start_time = mktime(0,0,0,$start_date_month,$start_date_day,$start_date_year);
			$end_date=$news[0]->endtime;	
			$end_date_year = substr($end_date,0,4); 
			$end_date_month = substr($end_date,5,2);  
			$end_date_day = substr($end_date,8,2);  
			$end_time = mktime(0,0,0,$end_date_month,$end_date_day,$end_date_year);
			$days=round(($end_time-$start_time)/3600/24);
			if($days >=0){?>离订购时间<span style="color:red; font-weight:bold;"><? echo $days; ?></span>天<? }else{?>订购已截止！<? }?><br>共有
				<span style="color:red; font-weight:bold;"><? echo $countnews[0]->total;?></span>位用户订购。订购商品<span style="color:red; font-weight:bold;"><? echo $countnews[0]->zs;?></span>件<br>
					<? if($news[0]->maxnum!=""){?>限量订购<? echo $news[0]->maxnum;?>,已经订购<? echo $countnews[0]->zs;?>,剩余<? echo ((int)$news[0]->maxnum-(int)$countnews[0]->zs); }?>
				<?php echo get_fck_content($news[0]->content);?></div>
		<div style="width:976px; margin-top:10px; margin-left:10px; text-align:center; font-size:15px; line-height:25px; float:left; display:inline;"><?php print_fck_pages($news[0]->content,"/fgtg/fgtg.php?id=".$id);?></div>
    <div id=content5>
			 <? if($news[0]->maxnum!=""){
    		if(strtotime(date("Y-m-d H:i:s")) < strtotime($news[0]->endtime)&&($news[0]->maxnum>=$countnews[0]->zs)){?>
    	<a target="_blank" href="/shop/spdg.php?id=<? echo $actid;?>">订购商品</a>
    	<? } else{?>
    	
    	<? }
    	}
    	else{
    	if(strtotime(date("Y-m-d H:i:s")) < strtotime($news[0]->endtime)){?>
    	<a target="_blank" href="/shop/spdg.php?id=<? echo $actid;?>">订购商品</a>
    	<? } else{?>
    	
    	<? 
    		}
    	}?>
    </div>
    <? for($i=0;$i<count($comments);$i++){?>
    <div class=content7>
    	<div class=name><a href="#"><?php echo $comments[$i]->nick_name; ?></a></div>	
    	<div class=time><?php echo $comments[$i]->created_at; ?></div>	
    	<div class=context><?php echo $comments[$i]->comment; ?></div>	
    </div>
    
    <?php }
     //显示评论页数链接
     if($sqlmanager->pagecount > 1)
     {
    ?>
      <div class="pageurl">
         <?php 
	         if($fck_pageindex=="")
	          echo paginate("/shop/spinfo.php?id=" .$actid); 
           else
           	echo paginate("/shop/spinfo.php?id=" .$actid."&fck_pageindex=".$_REQUEST['fck_pageindex']);  
         ?>
      </div>
    <?php
  	}
  	//显示评论页面链接完成
    ?>
   
    <div id=content8>
    		<div id=left>发表评论</div>
    		<div id=right><a href="/comment/comment.php" target="_blank" style="text-decoration:none;color:#000;">更多评论>> </a></div>
    </div>
    <form id="comment" method="post" action="/pub/pub.post.php">
    	 <input type="hidden" id="tgid" name="tgid" value="<?php echo $actid; ?>">
       <div id=content9>
    	   用户：<input type="text" value="" id="commenter" name="post[nick_name]">  
		   <input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $actid;?>">
			<input type="hidden" id="resource_type" name="post[resource_type]" value="shop">
			<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
			<input type="hidden" name="type" value="comment">
			<input type="hidden" id="username" value="<?php echo $cookie; ?>">
       </div>
       <div id=content10>
    	  <div id=left>评论：</div><textarea id="commentcontent" name="post[comment]"></textarea>
       </div>  
       <div id=content11></div>
    </form>
 </div>
</div>
<? require_once('../inc/bottom.inc.html');?>	
</body>
</html>
