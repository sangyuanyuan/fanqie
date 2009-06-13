<? 
	require_once "../frame.php";
	js_include_once_tag('smg');
	css_include_tag('smg');
	use_jquery_ui();
	$actid = $_REQUEST['id'];
	if($actid==""){die ('没有找到网页');}
	$db=get_db();
	$news=$db->query('SELECT * FROM smg_shop where id='.$actid);	
	$countnews=$db->query('SELECT count(*) as total,sum(num) as zs FROM smg_shop_signup where tg_id='.$actid);
	$comments=$db->paginate('select * from smg_shop_comment where tg_id='.$actid.' order by createtime desc',5);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -商品详细</title>
</head>
<body>
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
				<a href="/fqtg/fqtgdg.php?id=<? echo $actid;?>" style="color:red; font-weight:bold; text-decoration:none;"><? echo $countnews[0]->total;?></a>位用户订购。订购商品<a href="/shop/spdg.php?id=<? echo $actid;?>" style="color:red; font-weight:bold; text-decoration:none;"><? echo $countnews[0]->zs;?></a>件<br>
					<? if($news[0]->maxnum!=""){?>限量订购<? echo $news[0]->maxnum;?>,已经订购<? echo $countnews[0]->zs;?>,剩余<? echo ((int)$news[0]->maxnum-(int)$countnews[0]->zs); }?>
				<?php echo get_fck_content($news[0]->content);?></div>
		<div style="width:976px; margin-top:10px; margin-left:10px; text-align:center; font-size:15px; line-height:25px; float:left; display:inline;"></div>
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
    	<div class=name><a href="#"><?php echo $comments[$i]->commenter; ?></a></div>	
    	<div class=time><?php echo $comments[$i]->createtime; ?></div>	
    	<div class=context><?php echo $comments[$i]->content; ?></div>	
    </div>
    
    <?php }
     //显示评论页数链接
     if($sqlmanager->pagecount > 1)
     {
    ?>
      <div class="pageurl">
		<?php paginate("/shop/spinfo.php?id=".$_REQUEST['id']); ?>
      </div>
    <?php
  	}
  	//显示评论页面链接完成
    ?>
   
    <div id=content8>
    		<div id=left>发表评论</div>
    		<div id=right><a href="#" target="_blank" style="text-decoration:none;color:#000;">更多评论>> </a></div>
    </div>
    <form name="commentform" method="post" action="createcomment.post.php">
    	 <input type="hidden" id="tgid" name="tgid" value="<?php echo $actid; ?>">
       <div id=content9>
    	   用户：<input type="text" value="" id="commenter" name="comment[commenter]">  
		   <input type="hidden" name="comment[ip]" value="<? echo getenv('REMOTE_ADDR'); ?>">
		   <input type="hidden" name="comment[createtime]" value="<? echo Date('Y-m-d H:i:s'); ?>"> 	
       </div>
       <div id=content10>
    	  <div id=left>评论：</div><textarea id="commentcontent" name="comment[content]"></textarea>
       </div>  
       <div id="content11" name="content11" ></div>
    </form>
 </div>
</div>
</body>
</html>

<script>
	$(document).ready(function() {
	$("#content11").click(function() {
		return PostComment();
	});
	
});
</script>
