<?php
    require_once('../frame.php');
    session_start();
		setsession($_SERVER['HTTP_HOST']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-东方广播创意投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','show_vote.css','vote_right.css','thickbox');
		js_include_tag('total');
	?>
</head>
<script>
	total("东方广播创意投票","subject");	
</script>
<body>
	<? require_once('../inc/top.inc.php');
		$db = get_db();
		$news=$db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid,n.description from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="东方广播创意大赛" and i.category_type="news" and i.is_adopt=1 and c.name="听觉盛宴入围作品" order by i.priority asc, n.created_at desc');
	?>
	<div id="tb">
		<table width="497" border=1 cellpadding="0" cellspacing="0" style="float:left; display:inline;">
			<tr style="font-weight:bold; font-size:14px;"><td width="45%">名称</td><td width="15%">最高分贝奖</td><td width="15%">最爱声优奖</td><td width="15%">酷声炫音奖</td></tr>
			<?php for($i=0;$i<48;$i++){ ?>
			<tr>
				<td><img width=16 height=12 src="/images/icon/laba.jpg"><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></td>
				<td><input param="<?php echo $news[$i]->id; ?>" param1="1" name="checkbox" type="checkbox"></td>
				<td><input param="<?php echo $news[$i]->id; ?>" param1="2" name="checkbox" type="checkbox"></td>
				<td><input param="<?php echo $news[$i]->id; ?>" param1="3" name="checkbox" type="checkbox"></td>
			</tr>
			<?php } ?>
		</table>
		<table width="497" border=1 cellpadding="0" cellspacing="0" style="float:right; display:inline;">
			<tr style="font-weight:bold; font-size:14px;"><td width="45%">名称</td><td width="15%">最高分贝奖</td><td width="15%">最爱声优奖</td><td width="15%">酷声炫音奖</td></tr>
			<?php for($i=48;$i<96;$i++){ ?>
			<tr>
				<td><img width=16 height=12 src="/images/icon/laba.jpg"><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></td>
				<td><input param="<?php echo $news[$i]->id; ?>" param1="1" name="checkbox" type="checkbox"></td>
				<td><input param="<?php echo $news[$i]->id; ?>" param1="2" name="checkbox" type="checkbox"></td>
				<td><input param="<?php echo $news[$i]->id; ?>" param1="3" name="checkbox" type="checkbox"></td>
			</tr>
			<?php } ?>
		</table>
		<button id="vote_sub">提交</button>　　<button id="vote_show">查看</button>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(document).ready(function(){
		$("#vote_sub").click(function(){
			$("[name='checkbox']").each(function(){
				if($(this).attr('checked'))
				{
					$.post("dfgb_vote.post.php",{'news_id':$(this).attr('param'),'value':$(this).attr('param1')},function(data){
						alert('投票成功，感谢参与投票！');
						location.reload();	
					});
				}
			});
		});
		$("#vote_show").click(function(){
			location.href="dfgb_vote_show.php";
		});
	});
</script>
