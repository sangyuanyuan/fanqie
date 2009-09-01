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
	<?php require_once('../inc/top.inc.html'); 
	$sql="select r.* from smg_ratings r left join smg_report_item i on i.id=r.item_id where i.name='收视率和收视份额分析' order by r.id desc";
	$rader=$db->query($sql);
	?>
	<div id=ibody>
		<div id=ibody_left>
			<div class=l_title>SMG收视率和收视份额分析</div>
			<input id="url" type="hidden" value="<?php echo $rader[0]->file_path; ?>">
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
						<td>主题：</td> 
						<td><input type=text name=subject ></td>
						</tr> 
						<tr ><td>附件：</td> 
						<td><input type=file name=upload_file></td> <td>&nbsp</td> 
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
		<?php $sql="select * from smg_report_item where is_dept=0";
			$name=$db->query($sql);
		 ?>
		<div class=b_title></div>
			<div class=b_content>
				<select id="pd">
					<option value="0">请选择</option>
					<?php for($i=0;$i<count($name);$i++){ ?>
						<option value="<?php echo $name[$i]->id; ?>"><?php echo $name[$i]->name; ?></option>
						<?php } ?>
				</select>
				<?php $rq=date('Y-m-d'); 
					$date=aweek($rq,1);
				?>
				<select id="xq">
					<option value="0">请选择</option>
					<option value="<?php echo $date[0]; ?>">星期一</option>
					<option value="<?php echo $date[1]; ?>">星期二</option>
					<option value="<?php echo $date[2]; ?>">星期三</option>
					<option value="<?php echo $date[3]; ?>">星期四</option>
					<option value="<?php echo $date[4]; ?>">星期五</option>
					<option value="<?php echo $date[5]; ?>">星期六</option>
					<option value="<?php echo $date[6]; ?>">星期日</option>
				</select>
				<input type="button" id="pdcx" value="查询">
				<img id="foldline" width="970" src="/pChart/example9.jpg">
			</div>
			<?php $sql="select r.*,i.name from smg_ratings r left join smg_report_item i on r.item_id=i.id where is_dept=1 and i.is_show=1 order by i.id desc";
				$prom=$db->query($sql);
			?>
			<div class=b_title>预测节目收视率跟踪</div>
			<div class=b_content><img width="970" id="foldincom" src="/pChart/example12.jpg"></div>
			<div style="width:993px; border:1px solid #DC7638; border-top:none; float:left; display:inline;">
				<?php for($i=0;$i<count($prom);$i++){ ?>
					<div param="<?php echo $prom[0]->id; ?>" class=b_pro1 <?php if($i==0){?>style="width:197px; color:#000000; background:#FF9900;"<?php } ?>><?php echo $prom[$i]->name; ?></div>
				<?php } ?>
				</div>
	</div>
<?php require_once('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(document).ready(function(){
		$.post("/pChart/Example8.php",{'url':$("#url").attr("value")},function(data){
		});
		$("#pdcx").click(function(){
			if($("#pd").val()==0)
			{
				alert('请选择一个频道');
				return false;	
			}
			else if($("#xq").val()==0)
			{
				alert('请选择一个日期');
				return false;
			}
			else
			{
					$.post("/pChart/Example9.php",{'id':$("#pd").val(),'date':$("#xq").val()},function(data){
						if(data=='OK')
						{
							location.reload();
						}
					});
			}
		});
		$(".b_pro1").mouseover(function(){		
			$(".b_pro1").css("background","#FFCC00");
			$(".b_pro1").css("color","#ffffff");
			$(".b_pro1").css("width","199px");
			$(this).css("width","197px");
			$(this).css("background","#FF9900");
			$(this).css("color","#000000");
			$.post("/pChart/Example9.php",{'id':$(this).attr('param')},function(data){
					$("#foldincom").attr("src",data);
			});
		})
	})
</script>