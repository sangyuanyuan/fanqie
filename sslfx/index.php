<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<?php css_include_tag('sslfx','top','bottom');
	use_jquery();
	js_include_once_tag('sslfx','total');	
	$db=get_db();
	?>
<script>
	total("收视率分析","server");
</script>
</head>
<body>
	<?php require_once('../inc/top.inc.html'); ?>
	<div id=ibody>
		<div id=ibody_left>
			<div class=l_title>SMG收视率和收视份额分析</div>
			<input id="url" type="hidden" value="Sample/rader.csv">
			<script>
				$.post("/pChart/Example8.php",{'url':$("#url").attr("value")},function(data){
				});
			</script>
			<div class=l_content><img id="rader" src="/pChart/example8.jpg"></div>
		</div>
		<div id=ibody_right>
			<div class=r_title>收视率预测系统使用说明</div>
			<div id=r_content>
				<div class=table><a style="color:#FF0000;" href="预测节目信息登记表.xls">预测节目信息登记表</a></div><div class=table><a style="color:#FF0000;" href="新节目审片信息登记表.doc">新节目审片信息登记表</a></div>
				<div style=" margin-top:10px; margin-left:10px; font-size:15px; line-height:25px; float:left; display:inline;">
					<form method=post name=sndml action=sendmail.php ENCTYPE="multipart/form-data"> 
						<table> 
						<tr ><td>发送者：</td> 
						<td><input type=text name=from ></td> 
						</tr> 
						<tr ><td>主题：</td> 
						<td><input type=text name=subject ></td> 
						</tr> 
						<tr ><td>附件：</td> 
						<td><input type=file name=upload_file></td> 
						</tr> 
						<tr><td>&nbsp</td> 
						<td><input type="submit" value="发送"> 
						</td> 
						</tr> 
						</table> 
						</form> 	
					</div>
			</div>
			<?php $sql="select n.title,n.id,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where c.category_type='news' and c.name='收视率相关文献' order by n.priority asc, n.created_at desc limit 2";
				$news=$db->query($sql);
			?>
			<div class=r_title><div style="float:left; display:inline;">收视率相关文献</div><div class=more><a href="/server/news/news_list.php?id=<?php echo $news[0]->cid;?>>">更多</a></div></div>
			<div id=r_content1>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class="r_content_every">
					<div class=title><span style="color:#ff9900; font-weight:bold;">【节目】<a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->cid;?>"><?php echo get_fck_content($news[$i]->title);?></a></span></div>
					<div class=content><a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo get_fck_content($news[0]->content);?></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class=b_title></div>
			<div class=b_content>
				<select id="pd">
					<option value="0">请选择</option>
				</select>
				<select id="xq">
					<option value="0">请选择</option>
					<option value="1">星期一</option>
					<option value="2">星期二</option>
					<option value="3">星期三</option>
					<option value="4">星期四</option>
					<option value="5">星期五</option>
					<option value="6">星期六</option>
					<option value="7">星期日</option>
				</select>
				<input type="button" id="pdcx" value="查询">
				<input id="url1" type="hidden" value="Sample/foldline.csv">
				<script>
					$.post("/pChart/Example9.php",{'url':$("#url1").attr("value")},function(data){
					});
				</script>
				<img id="foldline" width="970" src="/pChart/example9.jpg">
			</div>
			<div class=b_title>预测节目收视率跟踪</div>
			<input id="url2" type="hidden" value="Sample/foldincom.csv">
			<script>
					$.post("/pChart/Example12.php",{'url':$("#url2").attr("value")},function(data){
					});
			</script>
			<div class=b_content><img width="970" id="foldincom" src="/pChart/example12.jpg"></div>
			<div style="width:993px; border:1px solid #DC7638; border-top:none; float:left; display:inline;"><div class=b_pro1>节目1</div><div class=b_pro2>节目2</div><div class=b_pro2>节目3</div><div class=b_pro2>节目4</div><div class=b_pro2>节目5</div></div>
	</div>
<?php require_once('../inc/bottom.inc.php');?>
</body>
</html>