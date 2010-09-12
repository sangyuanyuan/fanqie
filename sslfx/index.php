<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>电视节目收视定量分析工具</title>
	<?php
		css_include_tag('sslfx','top','bottom');
		use_jquery();
	 js_include_once_tag('total');	 ?>
<script>
	total("收视率分析","server");
</script>
</head>
<body>
	<?php require_once('../inc/top.inc.html'); 
	css_include_tag('jquery_ui');
	use_jquery_ui();
	
	$db=get_db();
	$sql="select distinct(i.name),i.id,r.file_path from smg_report_item i left join smg_ratings r on i.id=r.item_id where i.is_dept=0 and r.imagetype='rader' group by i.name order by i.id desc";
	$name=$db->query($sql);
	$sql="select n.title from smg_news n left join smg_category c on n.category_id=c.id where c.name='收视率分析滚动更新' order by n.created_at desc";
	$news=$db->query($sql);
	?>
	<div id=ibody>
		<div id="ssl_banner">
			<div id="zdtj"><label>重点推荐：</label><?php echo $news[0]->title; ?></div>
		</div>
		<div id=ibody_left>
			<div class=l_title>番茄收视预测</div>
			<div class=l_content>
				<div id="l_c_t">
					<div id=content>
						<?php 
							$sql="SELECT v.value,v.date,i.id,i.name,i.content,i.click_count FROM smg_rating_value v left join smg_report_item i on v.item_id=i.id where i.is_dept=1 and i.is_show=1 order by v.date desc"; 
							$news=$db->query($sql);
							$w = date( "w ",strtotime(substr($news[0]->date,0,10)));
						  if($w!=0)
						  {
								$date=aweek(substr($news[0]->date,0,10),1);
							}
							if(substr($news[0]->date,0,10)==$date[5]||$w==0)
							{
								$datetime=substr($news[0]->date,0,10);	
							}
							else
							{
								$datetime=$date[0]." -- ".$date[4];	
							}
						?>
						<div id="pic">
							<div id="pic_l"><?php echo $news[0]->name; ?></div>
							<div id="pic_r"><?php echo $news[0]->value; ?></div>
						</div>
						<div id="pictitle">预测时间段：<?php echo $datetime; ?></div>
						<div id="piccontent">
								<a href="/news/ratings.php?id=<?php echo $news[0]->id ?>"><?php echo delhtml($news[0]->content); ?></a>
						</div>
					</div>
					<div id="more"><a target="_blank" href="/news/ratings_list.php">>>更多节目预测</a></div>	
				</div>
				<?php $sql="select * from smg_comment where resource_id=".$news[0]->id." and resource_type='ratings' order by created_at desc";
					$comment=$db->query($sql);
				 ?>
				<div id="l_c_b">
					<div id="click_num">点击(<?php echo $news[0]->click_count; ?>)</div><div id="comment_num">评论(<?php echo count($comment); ?>)</div>
					<?php for($i=0;$i<count($comment);$i++){ ?>
						<div class="comment">评论<?php echo $i+1; ?>：<?php echo $comment[$i]->nick_name; ?>发表：<?php echo $comment[$i]->content; ?></div>
					<?php } ?>
				</div>
			</div>			
		</div>
		<div id=ibody_right>
			<div class=r_title>SMG电视总裁奖</div>
			<div class=r_content>
				<div class="r_c_t_l">总裁奖</div>
				<div class="r_c_t_r"><img  src="/images/ssl/zcj.jpg"></div>
				<div class="calendars"><a target="_blank" href="/news/news_list.php?id="240""><img border="0" src="/images/ssl/zcjrl.jpg"></a></div>
				<?php $sql="select * from smg_news where category_id=240 and is_adopt=1 order by priority asc,created_at desc"; 
					$news=$db->query($sql);
					for($i=0;$i<5;$i++){
				?>
				<div class="zcj" <?php if($i==0){ ?>style="background:url('/images/ssl/star.jpg') no-repeat 7px;"<?php } ?>>
					<a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a>
				</div>
				<?php } ?>
			</div>
			<div class=r_title>SMG收听收视警示榜</div>
			<div class=r_content>
				<div class="r_c_t_l">警示榜</div>
				<div class="r_c_t_r"><img border="0" src="/images/ssl/jsb.jpg"></div>
				<div class="calendars"><a target="_blank" href="/news/news_list.php?id="240""><img border="0" src="/images/ssl/jsbrl.jpg"></a></div>
				<?php $sql="select * from smg_news where category_id=238 and is_adopt=1 order by priority asc,created_at desc"; 
					$news=$db->query($sql);
					for($i=0;$i<5;$i++){
				?>
				<div class="zcj" <?php if($i==0){ ?>style="background:url('/images/ssl/star.jpg') no-repeat 7px;"<?php } ?>>
					<a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php /*$sql="select a.* from (select r.*,i.name from smg_ratings r right join smg_report_item i on r.item_id=i.id where is_dept=1 and i.is_show=1 order by r.id desc) as a group by name order by id desc limit 5";
				$prom=$db->query($sql);*/
			?>
			<!--<div class=b_title><div style="float:left; display:inline;">预测节目收视率跟踪</div><div style="margin-right:10px; float:right; display:inline;"><a style="color:#ffffff; font-size:12px; text-decoration:none;" href="list2.php">历史数据</a></div></div>
			<div class=b_content>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:inline;" id="imagefoldincom0"><img width=800 height=400 src="<?php echo $prom[0]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom1"><img width=800 height=400 src="<?php echo $prom[1]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom2"><img width=800 height=400 src="<?php echo $prom[2]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom3"><img width=800 height=400 src="<?php echo $prom[3]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom4"><img width=800 height=400 src="<?php echo $prom[4]->file_path;?>"></div>
			</div>
			<div style="width:993px; border:1px solid #DC7638; border-top:none; float:left; display:inline;">
				<?php for($i=0;$i<count($prom);$i++){ ?>
					<div param="<?php echo $i;?>" class=b_pro1 <?php if($i==0){?>style="width:197px; color:#000000; background:#FF9900;"<?php } ?>><?php echo $prom[$i]->name; ?></div>
				<?php } ?>
			</div>-->
		<div class=b_title><div style="float:left; display:inline;"><!--番茄跟踪T Tracking　　　<?php echo date('Y-m-d');$date=date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-1,date("Y")));?></div><div style="margin-right:10px; float:right; display:inline;">-->使用说明</div></div>	
		<div class=b_content style="height:264px;">
			<iframe FRAMEBORDER=0 style="width:600px; height:264px; margin-top:10px; overflow:hidden; float:left; display:inline;" src="sslfxframe.php"></iframe>
			<div class=table><a style="color:#FF0000;" href="预测节目信息登记表.xls">预测节目信息登记表</a></div><div class=table><a style="color:#FF0000;" href="新节目审片信息登记表.doc">新节目审片信息登记表</a></div>
			<div style=" margin-top:10px; margin-left:10px; font-size:15px; line-height:25px; float:left; display:inline;">
				<form method=post name=sndml action=sendmail.php ENCTYPE="multipart/form-data"> 
					<table> 
					<tr><td>发送者：</td> 
					<td><input type=text name=from ></td>
					<td>主题：</td> 
					<td><input type=text name=subject ></td>
					</tr> 
					<tr><td colspan="4">附　件：　<input style="width:150px;" type=file name=upload_file>　<input type="submit" value="发送"> 
					</td> 
					</tr> 
					</table> 
					</form> 	
				</div>
			
		</div>
					
		<?php $sql="select n.title,n.id,n.content,n.publisher_id,n.click_count,c.id as cid,c.platform as cpf from smg_news n left join smg_category c on n.category_id=c.id where c.category_type='server' and c.name='番茄点评' and n.is_adopt=1 order by n.priority asc, n.created_at desc";
				$news=$db->query($sql);
			?>
			<div class=b_title><div style="float:left; display:inline;">番茄点评</div><div class=more><a href="/news/news_list.php?id=<?php echo $news[0]->cid;?>">更多</a></div></div>
			<div id=b_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class="b_content_every">
					<div class=title><span style="font-weight:bold;"><a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo get_fck_content($news[$i]->title);?></a></span></div><div class="from">技术运营中心　　　<?php echo $news[$i]->publisher_id; ?></div>
					<div class=content><a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo get_fck_content($news[$i]->content);?></a></div>
					<?php $sql="select * from smg_comment where resource_id=".$news[$i]->id." and resource_type='news' order by created_at desc";
						$comment=$db->query($sql);
					 ?>
					<div class="click_num">点击(<?php echo $news[$i]->click_count ?>)</div><div class="comment_num">评论(<?php echo count($comment); ?>)</div>
					<div class=comment>
						<?php for($j=0;$j<count($comment);$j++){ ?>
							<div class="comment">评论<?php echo $j+1; ?>：<?php echo $comment[$j]->nick_name; ?>发表：<?php echo $comment[$j]->content; ?></div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id="forecasting">
				<div id=forecasting_title>番茄收视预测</div>
				<div id=forecasting_content>
					<select style="margin-left:10px;" id="raderpd">
						<?php for($i=0;$i<count($name);$i++){ ?>
							<option value="<?php echo $name[$i]->id; ?>" <?php if($name[$i]->name=="上海电视台新闻综合频道"){?>selected="selected"<?php } ?>><?php echo $name[$i]->name; ?></option>
							<?php } ?>
					</select>
					<input type="button" id="radercx" value="查询">
					<a style="color:#000000; text-decoration:none;" href="list.php">历史数据</a>
					<?php $sql="select i.id,r.file_path from smg_report_item i left join smg_ratings r on i.id=r.item_id where i.is_dept=0 and r.imagetype='rader' and i.name='上海电视台新闻综合频道'  order by r.id desc";
						$rader=$db->query($sql);
					?>
					<!--<iframe style="width:395px; height:395px; float:left; display:inline;" frameborder="no" scrolling=no id="raderimg" src="/pChart/example8.jpg"></iframe>-->
					<div style="width:375px; height:342px; margin-top:10px; margin-left:10px; overflow:hidden; float:left; display:inline;" id="raderimg"><img src="<?php echo $rader[0]->file_path; ?>"></div>
				</div>
			</div>
			<div id="graph">
				<div id=graph_title>18:00~24:00每十分钟收视率曲线图</div>
				<div id=graph_content>
					<?php $sql="select distinct(i.name),i.id,r.date from smg_report_item i left join smg_ratings r on i.id=r.item_id where i.is_dept=0 and r.imagetype='foldline' group by i.name order by i.id desc";
		$name=$db->query($sql);?>
					<select id="pd">
						<?php for($i=0;$i<count($name);$i++){ ?>
							<option value="<?php echo $name[$i]->id; ?>" <?php if($name[$i]->name=="上海电视台新闻综合频道"){ ?>selected="selected"<?php } ?>><?php echo $name[$i]->name; ?></option>
							<?php } ?>
					</select>
					<?php $rq=$db->query('select date from smg_ratings where imagetype="foldline" order by id desc');
					$rq=substr($rq[0]->date,0,10);
					$w   =   date( "w ",strtotime($rq));
					if($w==0)
					{
						$rq=date("Y-m-d",strtotime($rq.' -1 day'));	
					}
					$date=aweek($rq,1);
					?>
					<select id="rq">
						<option value="<?php echo $date[0]."-".$date[4]; ?>">周一~周五</option>
						<option value="<?php echo $date[5];?>" selected=selected >周六</option>
						<option value="<?php echo $date[6];?>">周日</option>
					</select>
					<input type="button" id="pdcx" value="查询"> <a style="text-decoration:none; color:#000000;" target="_blank" href="list.php">历史数据</a>
					<input id="riqi" style="width:200px; border:0px;" type="text" readonly="true">
					<div style="width:570px; text-align:center; float:left; display:inline;" id="imagefoldline"><?php $foldline=$db->query("select file_path from smg_ratings r left join smg_report_item i on r.item_id=i.id where r.imagetype='foldline' and i.name='上海电视台新闻综合频道' and r.date='".$date[5]."' order by r.id desc limit 1"); ?>
						<img width="560" height="330" src="<?php echo $foldline[0]->file_path; ?>">
					</div>
			</div>
		</div>	
<?php require_once('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(document).ready(function(){
		$(".date_jquery").datepicker(
			{
				monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dateFormat: 'yy-mm-dd'
			}
		);
		$("#radercx").click(function(){
			$.post("/pChart/Example8.php",{'id':$("#raderpd").val()},function(data){
					$("#raderimg").html(data);
			})
		});
		
		$("#pdcx").click(function(){
			if($("#pd").val()==0)
			{
				alert('请选择一个频道');
				return false;	
			}
			else if($("#rq").val()==0)
			{
				alert('请选择一个日期');
				return false;
			}
			else{
						$("#riqi").attr("value",$("#rq").val());
						$.post("/pChart/Example9.php",{'id':$("#pd").val(),'date':$("#rq").val()},function(data){
								$("#imagefoldline").html(data);
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
			$(".imagefoldincom").css("display","none");
			$("#imagefoldincom"+$(this).attr("param")).css("display","inline");
		});
		$(".b_b_pro1").mouseover(function(){
			$(".b_b_pro1").css("background","#FFCC00");
			$(".b_b_pro1a").css("color","#ffffff");
			$(".b_b_pro1").css("width","199px");
			$(this).css("width","197px");
			$(this).css("background","#FF9900");
			$("#b_b_pro1"+$(this).attr("param")).css("color","#000000");
			$(".bpro").css("display","none");
			$("#bpro"+$(this).attr("param")).css("display","inline");
		});
	})
</script>