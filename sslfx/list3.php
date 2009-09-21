﻿<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-新闻列表页面</title>
	<? 	
		css_include_tag('news_news_list','top','bottom');
		use_jquery();
		js_include_once_tag('news_list','total');
		$db = get_db();
		$sql1="";
		if($_REQUEST['reportitem']!="")
		{
			$sql1=$sql1." and r.item_id=".$_REQUEST['reportitem'];
		}
		if($_REQUEST['time']!="")
		{
			$sql1=$sql1." date='".$_REQUEST['time']." 00:00:00'";
		}
		$sql="select i.name,r.value,r.date from smg_rating_value r left join smg_report_item i on r.item_id=i.id where 1=1".$sql1." order by r.id desc";
		$record=$db->paginate($sql,30);		
  ?>
<script>
	total("番茄工具","server");
</script>
</head>
<body>
<? require_once('../inc/top.inc.html');
	css_include_tag('jquery_ui');
	use_jquery_ui();
?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_b>
			<div style="margin-top:10px; margin-left:10px; float:left; display:inline;">
				<?php $sql="SELECT * FROM smg_report_item s where dept_id=".$_REQUEST['itemid'];
					$item=$db->query($sql);
				?>
				节目：<select id="reportitem">
					<option value="0">请选择</option>
					<?php for($i=0;$i<count($item);$i++){ ?>
						<option value="<?php echo $item[$i]->id; ?>" <?php if($item[$i]->id==$_REQUEST['reportitem']){?>selected=selected<?php } ?>><?php echo $item[$i]->name;?></option>
					<?php } ?>
				</select>
				时间：<input type="text" class="date_jquery" name="date" id="time" value="<?php echo $_REQUEST['time'];?>">
				<input type="button" id="cx" value="查询">
			</div>
			<?php for($i=0;$i<count($record);$i++){ ?>
			<div class=l_b_l>
						<div class=l_b_l_l><img src="/images/news/li_square.jpg" /></div>
						<div class=l_b_l_r>
							<div style="float:left; display:inline;"><?php echo $record[$i]->name; ?></div>
							<div style="margin-right:100px; float:right; display:inline"><?php echo $record[$i]->value; ?></div>
						</div>
			</div>
			<div class=l_b_r><?php echo $record[$i]->date; ?></div>
			<?php }?>
			<div id=page><?php paginate('');?></div>
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_t><a target="_blank" href="/news/news_sub.php"><img border=0 src="/images/news/news_head_r_t.jpg"></a></div>
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
		
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	$(".date_jquery").datepicker(
			{
				monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dateFormat: 'yy-mm-dd'
			}
		);
	$(document).ready(function(){
		$("#cx").click(function(){
				var reportitem="";
				var time="";
				if($("#reportitem").val()!=0)
				{
					reportitem=$("#reportitem").val();	
				}
				if($("#time").val()!="")
				{
					time=$("#time").val();
				}
				if(reportitem!=""&&time!="")
				{
					window.location.href="list3.php?itemid=<?php echo $_REQUEST['itemid']; ?>&time="+time+"&reportitem="+reportitem;
				}
				else if(reportitem!=""&&time=="")
				{
					window.location.href="list3.php?itemid=<?php echo $_REQUEST['itemid']; ?>&reportitem="+reportitem;
				}
				else if(reportitem==""&&time!="")
				{
					window.location.href="list3.php?itemid=<?php echo $_REQUEST['itemid']; ?>&time="+time;
				}
				else
				{
					window.location.href="list3.php?itemid=<?php echo $_REQUEST['itemid']; ?>";
				}
		})
	});
</script>
