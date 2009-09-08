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
	$sql="select distinct(i.name),i.id,r.file_path from smg_report_item i left join smg_ratings r on i.id=r.item_id where i.is_dept=0 and r.imagetype='rader' order by i.id desc";
	$name=$db->query($sql);
	?>
	<div id=ibody>
		<div id=ibody_left>
			<div class=l_title>SMG收视率和收视份额分析</div>
			<div class=l_content>
				<select style="margin-left:10px;" id="raderpd">
					<option value="0">请选择</option>
					<?php for($i=0;$i<count($name);$i++){ ?>
						<option value="<?php echo $name[$i]->id; ?>"><?php echo $name[$i]->name; ?></option>
						<?php } ?>
				</select>
				<input type="button" id="radercx" value="查询">
				<!--<iframe style="width:395px; height:395px; float:left; display:inline;" frameborder="no" scrolling=no id="raderimg" src="/pChart/example8.jpg"></iframe>-->
				<div style="width:375px; height:363px; margin-top:10px; margin-left:10px; float:left; display:inline;" id="raderimg"><img src="<?php echo $name[0]->file_path; ?>"></div>
			</div>
			
		</div>
		<div id=ibody_right>
			<div class=r_title>收视率预测系统使用说明</div>
			<div id=r_content>
				<div style="width:560px; margin-top:10px; margin-left:10px; overflow:hidden; float:left; display:inline;"><?php $news=$db->query('select content from smg_news where id=22505'); 
				 echo get_fck_content($news[0]->content);
				?></div>
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
		<div class=b_title></div>
			<div class=b_content>
				<?php $sql="select distinct(i.name),i.id from smg_report_item i left join smg_ratings r on i.id=r.item_id where i.is_dept=0 and r.imagetype='foldline' order by i.id desc";
	$name=$db->query($sql);?>
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
					<option value="<?php echo $date[0]; ?>-<?php echo $date[4];?>">星期一~星期五</option>
					<option value="<?php echo $date[5]; ?>">星期六</option>
					<option value="<?php echo $date[6]; ?>">星期日</option>
				</select>
				<input type="button" id="pdcx" value="查询">
				<input id="riqi" style="width:200px; border:0px;" type="text" readonly="true">
				<!--<iframe style="width:970px; height:350px;" frameborder="no" scrolling=no id="imagefoldline" src="<?php echo $showtime=date("Y-m-d H:i:s");?> "></iframe>-->
				<div style="width:970px; text-align:center; float:left; display:inline;" id="imagefoldline"><?php $foldline=$db->query("select file_path from smg_ratings where imagetype='foldline' order by id desc limit 1"); ?><img src="<?php echo $foldline[0]->file_path; ?>"></div>
				
			</div>
			<?php $sql="select r.*,i.name from smg_ratings r left join smg_report_item i on r.item_id=i.id where is_dept=1 and i.is_show=1 order by i.id desc";
				$prom=$db->query($sql);
			?>
			<div class=b_title>预测节目收视率跟踪</div>
			<div class=b_content>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:inline;" id="imagefoldincom0"><img width=800 src="<?php echo $prom[0]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom1"><img width=800 src="<?php echo $prom[1]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom2"><img width=800 src="<?php echo $prom[2]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom3"><img width=800 src="<?php echo $prom[3]->file_path;?>"></div>
				<div class="imagefoldincom" style="width:970px; text-align:center; float:left; display:none;" id="imagefoldincom4"><img width=800 src="<?php echo $prom[4]->file_path;?>"></div>
			</div>
			<div style="width:993px; border:1px solid #DC7638; border-top:none; float:left; display:inline;">
				<?php for($i=0;$i<count($prom);$i++){ ?>
					<div param="<?php echo $i;?>" class=b_pro1 <?php if($i==0){?>style="width:197px; color:#000000; background:#FF9900;"<?php } ?>><?php echo $prom[$i]->name; ?></div>
				<?php } ?>
				</div>
	</div>
<?php require_once('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(document).ready(function(){
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
			else if($("#xq").val()==0)
			{
				alert('请选择一个日期');
				return false;
			}
			else
			{
				$("#riqi").attr('value',$("#xq").val());
				var now=new Date();
				$.post("/pChart/Example9.php",{'id':$("#pd").val(),'date':$("#xq").val()},function(data){
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
	})
</script>