<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>电视节目收视定量分析工具</title>
	<?php
		css_include_tag('sslfx','top','bottom');
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
	?>
	<div id=ibody>
		<div style="width:995px; font-weight:bold; text-align:center; float:left; display:inline;"><h1>电视节目收视定量分析工具</h1></div>
		<?php $sql="select n.title from smg_news n left join smg_category c on n.category_id=c.id where c.name='收视率分析滚动更新' order by n.created_at desc";
			$news=$db->query($sql);
		 ?>
		<div style="width:995px; height:20px; line-height:20px; text-align:center; float:left; display:inline;">
			<marquee scrollAmount="3" onmouseover=stop() onmouseout=start()>
			<?php for($i=0;$i<count($news);$i++){echo "　　".get_fck_content($news[$i]->title);}?>
		</marquee></div>
		<div id=ibody_left>
			<div class=l_title>SMG收视率和收视份额分析</div>
			<div class=l_content>
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
				<div style="width:375px; height:363px; margin-top:10px; margin-left:10px; float:left; display:inline;" id="raderimg"><img src="<?php echo $rader[0]->file_path; ?>"></div>
			</div>
			
		</div>
		<div id=ibody_right>
			<div class=r_title>收视率预测系统使用说明</div>
			<div id=r_content>
				<iframe FRAMEBORDER=0 style="width:590px; height:264px; margin-top:10px; overflow:hidden; float:left; display:inline;" src="sslfxframe.php"></iframe>
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
			
		</div>
		<?php $sql="select a.* from (select r.*,i.name from smg_ratings r right join smg_report_item i on r.item_id=i.id where is_dept=1 and i.is_show=1 order by r.id desc) as a group by name order by id desc limit 5";
				$prom=$db->query($sql);
			?>
			<div class=b_title><div style="float:left; display:inline;">预测节目收视率跟踪</div><div style="margin-right:10px; float:right; display:inline;"><a style="color:#ffffff; font-size:12px; text-decoration:none;" href="list2.php">历史数据</a></div></div>
			<div class=b_content>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:inline;" id="imagefoldincom0"><img width=800 height=300 src="<?php echo $prom[0]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom1"><img width=800 height=300 src="<?php echo $prom[1]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom2"><img width=800 height=300 src="<?php echo $prom[2]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom3"><img width=800 height=300 src="<?php echo $prom[3]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom4"><img width=800 height=300 src="<?php echo $prom[4]->file_path;?>"></div>
			</div>
			<div style="width:993px; border:1px solid #DC7638; border-top:none; float:left; display:inline;">
				<?php for($i=0;$i<count($prom);$i++){ ?>
					<div param="<?php echo $i;?>" class=b_pro1 <?php if($i==0){?>style="width:197px; color:#000000; background:#FF9900;"<?php } ?>><?php echo $prom[$i]->name; ?></div>
				<?php } ?>
			</div>
		<div class=b_title><div style="float:left; display:inline;">番茄跟踪T Tracking</div><div style="margin-right:10px; float:right; display:inline;"></div></div>	
			<div class=b_content>
				<?php $sql="select content from smg_news where title='上海东方卫视波动说明' order by created_at desc";
					$news=$db->query($sql);
					$sql="select id,name from smg_report_item where dept_id=12";
					$dfws=$db->query($sql);	
				?>
				<div class="bpro" id="bpro1">
					<div style="width:800px;  line-height:20px; text-align:center; overflow:hidden; float:left; display:inline;">
						<?php for($i=0;$i<4;$i++){ ?>
						<div style="width:200px; float:left; display:inline;">
										<div style="width:60px; float:left; display:inline;">节目名称</div><div style="width:70px; float:left; display:inline;">实际收视率</div><div style="width:50px; float:left; display:inline;">差额</div>
							</div>
							<?php } ?>
						<?php for($i=0;$i<count($dfws);$i++){ 
								$sql="select value from smg_rating_value where item_id=".$dfws[$i]->id." order by date desc,id desc limit 2";
								$record=$db->query($sql);
								$recordvalue=(float)($record[0]->value)-(float)($record[1]->value);
							?>
							
							<div style="width:200px; height:20px; overflow:hidden; float:left; display:inline;">
								<div style="width:60px; float:left; display:inline;"><?php echo $dfws[$i]->name;?></div>
								<div style="width:70px; float:left; display:inline;"><?php if($recordvalue >0){?>
								<span style="color:red;"><?php echo $record[0]->value;?> ↑</span>
									<?php }else if($recordvalue<0){?>
									<span style="color:green;"><?php echo $record[0]->value;?> ↓</span>
									<?php }else if($recordvalue==0){?>
									<span style="color:#000000;"><?php echo $record[0]->value;?> →</span>
									<?php } ?>
								</div>
								<div style="width:50px; float:left; display:inline;"><?php echo $recordvalue; ?></div>
							</div>
						<?php } ?>
					</div>
					<div style="width:193px;  float:left; display:inline;"><?php echo get_fck_content($news[0]->content); ?></div></div>
				<?php $sql="select content from smg_news where title='上海电视台电视剧频道波动说明' order by created_at desc";
					$news=$db->query($sql);	
					$sql="select id,name from smg_report_item where dept_id=21";
					$dsj=$db->query($sql);	
				?>
				<div class="bpro" id="bpro2">
					<div style="width:800px;  line-height:20px; text-align:center; overflow:hidden; float:left; display:inline;">
						<?php for($i=0;$i<4;$i++){ ?>
						<div style="width:200px; float:left; display:inline;">
										<div style="width:60px; float:left; display:inline;">节目名称</div><div style="width:70px; float:left; display:inline;">实际收视率</div><div style="width:50px; float:left; display:inline;">差额</div>
							</div>
							<?php } ?>
						<?php for($i=0;$i<count($dsj);$i++){ 
								$sql="select value from smg_rating_value where item_id=".$dsj[$i]->id." order by date desc,id desc limit 2";
								$record=$db->query($sql);
								$recordvalue=(float)($record[0]->value)-(float)($record[1]->value);
							?>
							
							<div style="width:200px; height:20px; overflow:hidden; float:left; display:inline;">
								<div style="width:60px; float:left; display:inline;"><?php echo $dsj[$i]->name;?></div>
								<div style="width:70px; float:left; display:inline;"><?php if($recordvalue >0){?>
								<span style="color:red;"><?php echo $record[0]->value;?> ↑</span>
									<?php }else if($recordvalue<0){?>
									<span style="color:green;"><?php echo $record[0]->value;?> ↓</span>
									<?php }else if($recordvalue==0){?>
									<span style="color:#000000;"><?php echo $record[0]->value;?> →</span>
									<?php } ?>
								</div>
								<div style="width:50px; float:left; display:inline;"><?php echo $recordvalue; ?></div>
							</div>
						<?php } ?>
					</div>
					<div style="width:193px; float:left; display:inline;"><?php echo get_fck_content($news[0]->content); ?></div></div>
				<?php $sql="select content from smg_news where title='上海电视台生活时尚频道波动说明' order by created_at desc";
					$news=$db->query($sql);
					$sql="select id,name from smg_report_item where dept_id=22";
					$shss=$db->query($sql);
				?>
				<div class="bpro" id="bpro3">
					<div style="width:800px;  line-height:20px; text-align:center; overflow:hidden; float:left; display:inline;">
						<?php for($i=0;$i<4;$i++){ ?>
						<div style="width:200px; float:left; display:inline;">
										<div style="width:60px; float:left; display:inline;">节目名称</div><div style="width:70px; float:left; display:inline;">实际收视率</div><div style="width:50px; float:left; display:inline;">差额</div>
							</div>
							<?php } ?>
						<?php for($i=0;$i<count($shss);$i++){ 
								$sql="select value from smg_rating_value where item_id=".$shss[$i]->id." order by date desc,id desc limit 2";
								$record=$db->query($sql);
								$recordvalue=(float)($record[0]->value)-(float)($record[1]->value);
							?>
							
							<div style="width:200px; height:20px; overflow:hidden; float:left; display:inline;">
								<div style="width:60px; float:left; display:inline;"><?php echo $shss[$i]->name;?></div>
								<div style="width:70px; float:left; display:inline;"><?php if($recordvalue >0){?>
								<span style="color:red;"><?php echo $record[0]->value;?> ↑</span>
									<?php }else if($recordvalue<0){?>
									<span style="color:green;"><?php echo $record[0]->value;?> ↓</span>
									<?php }else if($recordvalue==0){?>
									<span style="color:#000000;"><?php echo $record[0]->value;?> →</span>
									<?php } ?>
								</div>
								<div style="width:50px; float:left; display:inline;"><?php echo $recordvalue; ?></div>
							</div>
						<?php } ?>
					</div>
					<div style="width:193px; float:left; display:inline;"><?php echo get_fck_content($news[0]->content); ?></div>
				</div>
				<?php $sql="select content from smg_news where title='上海电视台新闻综合频道波动说明' order by created_at desc";
					$news=$db->query($sql);
					$sql="select id,name from smg_report_item where dept_id=19";
					$newscenter=$db->query($sql);
				?>
				<div class="bpro" id="bpro4">
					<div style="width:800px;  line-height:20px; text-align:center; overflow:hidden; float:left; display:inline;">
						<?php for($i=0;$i<4;$i++){ ?>
						<div style="width:200px; float:left; display:inline;">
										<div style="width:60px; float:left; display:inline;">节目名称</div><div style="width:70px; float:left; display:inline;">实际收视率</div><div style="width:50px; float:left; display:inline;">差额</div>
							</div>
							<?php } ?>
						<?php for($i=0;$i<count($newscenter);$i++){ 
								$sql="select value from smg_rating_value where item_id=".$newscenter[$i]->id." order by date desc,id desc limit 2";
								$record=$db->query($sql);
								$recordvalue=(float)($record[0]->value)-(float)($record[1]->value);
							?>
							
							<div style="width:200px; height:20px; overflow:hidden; float:left; display:inline;">
								<div style="width:60px; float:left; display:inline;"><?php echo $newscenter[$i]->name;?></div>
								<div style="width:70px; float:left; display:inline;"><?php if($recordvalue >0){?>
								<span style="color:red;"><?php echo $record[0]->value;?> ↑</span>
									<?php }else if($recordvalue<0){?>
									<span style="color:green;"><?php echo $record[0]->value;?> ↓</span>
									<?php }else if($recordvalue==0){?>
									<span style="color:#000000;"><?php echo $record[0]->value;?> →</span>
									<?php } ?>
								</div>
								<div style="width:50px; float:left; display:inline;"><?php echo $recordvalue; ?></div>
							</div>
						<?php } ?>
					</div>
					<div style="width:193px; float:left; display:inline;"><?php echo get_fck_content($news[0]->content); ?></div>
				</div>
				<?php $sql="select content from smg_news where title='上海东方电视台娱乐频道波动说明' order by created_at desc";
					$news=$db->query($sql);
					$sql="select id,name from smg_report_item where dept_id=16";
					$yl=$db->query($sql);
				?>
				<div class="bpro" id="bpro5">
					<div style="width:800px;  line-height:20px; text-align:center; overflow:hidden; float:left; display:inline;">
						<?php for($i=0;$i<4;$i++){ ?>
						<div style="width:200px; float:left; display:inline;">
										<div style="width:60px; float:left; display:inline;">节目名称</div><div style="width:70px; float:left; display:inline;">实际收视率</div><div style="width:50px; float:left; display:inline;">差额</div>
							</div>
							<?php } ?>
						<?php for($i=0;$i<count($yl);$i++){ 
								$sql="select value from smg_rating_value where item_id=".$yl[$i]->id." order by date desc,id desc limit 2";
								$record=$db->query($sql);
								$recordvalue=(float)($record[0]->value)-(float)($record[1]->value);
							?>
							
							<div style="width:200px; height:20px; overflow:hidden; float:left; display:inline;">
								<div style="width:60px; float:left; display:inline;"><?php echo $yl[$i]->name;?></div>
								<div style="width:70px; float:left; display:inline;"><?php if($recordvalue >0){?>
								<span style="color:red;"><?php echo $record[0]->value;?> ↑</span>
									<?php }else if($recordvalue<0){?>
									<span style="color:green;"><?php echo $record[0]->value;?> ↓</span>
									<?php }else if($recordvalue==0){?>
									<span style="color:#000000;"><?php echo $record[0]->value;?> →</span>
									<?php } ?>
								</div>
								<div style="width:50px; float:left; display:inline;"><?php echo $recordvalue; ?></div>
							</div>
						<?php } ?>
					</div>
					<div style="width:193px; float:left; display:inline;"><?php echo get_fck_content($news[0]->content); ?></div>
				</div>
			</div>
			<div style="width:993px; border:1px solid #DC7638; border-top:none; float:left; display:inline;">
					<div param="1" class=b_b_pro1 style="width:197px; color:#000000; background:#FF9900;">上海东方卫视</div>
					<div param="2" class=b_b_pro1>上海电视台电视剧频道</div>
					<div param="3" class=b_b_pro1>上海电视台生活时尚频道</div>
					<div param="4" class=b_b_pro1>上海电视台新闻综合频道</div>
					<div param="5" class=b_b_pro1>上海东方电视台娱乐频道</div>
			</div>
		<?php $sql="select n.title,n.id,n.content,c.id as cid,c.platform as cpf from smg_news n left join smg_category c on n.category_id=c.id where c.category_type='news' and c.name='收视率相关文献' and n.is_adopt=1 order by n.priority asc, n.created_at desc limit 2";
				$news=$db->query($sql);
			?>
			<div class=b_title><div style="float:left; display:inline;">收视率相关文献</div><div class=more><a href="/news/news_list.php?id=<?php echo $news[0]->cid;?>">更多</a></div></div>
			<div id=b_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class="b_content_every">
					<div class=title><span style="color:#ff9900; font-weight:bold;">【节目】<a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo get_fck_content($news[$i]->title);?></a></span></div>
					<div class=content><a target="_blank" href="/server/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo get_fck_content($news[$i]->content);?></a></div>
				</div>
				<?php } ?>
			</div>
		<div class=b_title>18:00~24:00每十分钟收视率曲线图</div>
			<div class=b_content>
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
				<!--<iframe style="width:970px; height:350px;" frameborder="no" scrolling=no id="imagefoldline" src="<?php echo $showtime=date("Y-m-d H:i:s");?> "></iframe>-->
				<div style="width:970px; text-align:center; float:left; display:inline;" id="imagefoldline"><?php $foldline=$db->query("select file_path from smg_ratings r left join smg_report_item i on r.item_id=i.id where r.imagetype='foldline' and i.name='上海电视台新闻综合频道' and r.date='".$date[5]."' order by r.id desc limit 1"); ?><img src="<?php echo $foldline[0]->file_path; ?>"></div>
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
			$(".b_b_pro1").css("color","#ffffff");
			$(".b_b_pro1").css("width","199px");
			$(this).css("width","197px");
			$(this).css("background","#FF9900");
			$(this).css("color","#000000");
			$(".bpro").css("display","none");
			$("#bpro"+$(this).attr("param")).css("display","inline");
		});
	})
</script>