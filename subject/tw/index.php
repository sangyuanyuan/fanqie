<?
  require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>smg</title>
	
	<?php
		css_include_tag('tw');
	 use_jquery(); ?>
</head>
<body>
	<div id="ibody">
		<div id="iibody">
			 <? include('inc/top.inc.php');?>
			 			<div id="left">
			 							<div id="lefta">
			 										<div id="title_left">
			 										<?php $sql = 'select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 and c.name="首页头新闻" order by i.priority asc, n.created_at desc limit 11';
														  $record_star=$db -> query($sql);
														  $sql="select * from smg_news where id=46890";
														  $news=$db->query($sql); 
														  show_video_player('350','258',$news[0]->video_photo_src,$news[0]->video_src);
													?>
			 												
			 										</div>
			 										<div id="title_right">
			 												<div id="title_right_title"><a target="_blank" href="news.php?id=<?php echo $record_star[0]->id; ?>"><?php echo $record_star[0]->short_title; ?></a></div>
			 												<div id="w_hr" ></div>
			 												<?php for($i=1;$i<11; $i++){ ?>
			 												<div class="title_w"><a target="_blank" href="news.php?id=<?php echo $record_star[$i]->id; ?>"><?php echo $record_star[$i]->short_title; ?></a></div><?php if($i==1){ ?><div id="newsa"></div><?php }?>
			 												<?php }?>
			 												<div id="title_buttom"><a target="_blank" href="list.php?id=175"><font style="color:#5A9720">>>&nbsp;更多</a></font></div>
			 										</div>
			 							</div>
			 							<div id="leftb">
			 										<div class="guanz">
			 										<?php $sql = 'select n.photo_src,n.id,n.short_title,n.description,n.news_type,n.video_src,n.video_photo_src,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 and c.name="重点关注" order by i.priority asc, n.created_at desc limit 6';
														  $news=$db -> query($sql); 
													?>
			 												<div id="zhong_top"><div id="texta">重点关注</div><a target="_blank" href="list.php?id=162">更多 >></a></div>
			 												<div id="zhong_img_left"><?php if($news[0]->video_src!=""){show_video_player('171','117',$news[0]->video_photo_src,$news[0]->video_src);}else{ echo '<a target="_blank" href="news.php?id='.$news[0]->id.'"><img width=171 height=117 border=0 src="'.$news[0]->photo_src.'"></a>';} ?></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title"><?php echo $news[0]->short_title; ?></div>
			 														<div class="zhong_c"><?php echo $news[0]->description; ?></div>
			 														<div class="zhong_bottom"><a target="_blank" href="news.php?id=<?php echo $news[0]->id; ?>"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1; $i<5; $i++){ ?>
			 												<div class="content_z">
			 														<div class="content_d"></div>
			 														<div class="content"><a target="_blank" href="news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
			 												</div>
			 												<div class="content_hr"></div>
			 												<?php }?>
			 										</div>
			 										<div class="guanr">
				 										<?php $sql = 'select n.photo_src,n.id,n.short_title,n.description,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 and c.name="志愿星" order by i.priority asc, n.created_at desc limit 6';
															  $news=$db -> query($sql); 
														?>
			 													<div id="guanr_top"><div id="textb">志愿星</div><a target="_blank" href="list.php?id=16">更多 >></a></div>
			 													<div id="zhong_img_right_right"><?php if($news[0]->video_src!=""){show_video_player('171','117',$news[0]->video_photo_src,$news[0]->video_src);}else{ echo '<a target="_blank" href="news.php?id='.$news[0]->id.'"><img width=171 height=117 border=0 src="'.$news[0]->photo_src.'"></a>';} ?></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title"><?php echo $news[0]->short_title; ?></div>
			 														<div class="zhong_c"><?php echo $news[0]->description; ?></div>
			 														<div class="zhong_bottom"><a target="_blank" href="news.php?id=<?php echo $news[0]->id; ?>"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1; $i<5; $i++){ ?>
				 												<div class="content_z">
				 														<div class="content_d"></div>
				 														<div class="content"><a target="_blank" href="news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
				 												</div>
				 												<div class="content_hr"></div>
			 												<?php }?>
			 										</div>
			 							</div>
			 							<div id="leftc">
			 									<div id="leftc_top"><div id="textc">志愿者风采</div></div>
			 									<div id="leftc_middle">
			 										<div id="m_m">
			 												<DIV id=Layer5 style="margin-left:10px; ">
													      <DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 95%;">
													      <TABLE cellSpacing=0 cellPadding=0 border=0>
													        <TBODY>
													        <TR>
													          <TD id=demo7 vAlign=top align=middle>
													            <TABLE cellSpacing=0 cellPadding=2 border=0>
													              <TBODY>
													              <TR align=left>
																		<?php $sql = 'select n.photo_src,n.id,n.short_title,n.description,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 and c.name="志愿者风采" order by i.priority asc, n.created_at desc';
																				  $news=$db -> query($sql); 
																		for($i=0;$i<count($news);$i++){
																	?>
													                <TD>
																<div class="imga">
			 															<img src="<?php echo $news[$i]->photo_src; ?>" style="width:150px; height:105px; border:1px solid #DADADA;  ">
			 															<div class="imga_a"><?php echo $news[$i]->short_title; ?></div>
															</div></TD>
				               				 <? }?>
				              				</TR></TBODY></TABLE></TD>
				          			<TD id="demo8" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo6 = document.getElementById('demo6');
										var demo7 = document.getElementById('demo7');
										var demo8 = document.getElementById('demo8');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo8.innerHTML=demo7.innerHTML
											function Marquee(){
											if(demo8.offsetWidth-demo6.scrollLeft<=0)
											demo6.scrollLeft-=demo7.offsetWidth
											else{
											demo6.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo6.onmouseover=function() {clearInterval(MyMar)}
											demo6.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
				</DIV>
			 													
			 										</div>
			 									</div>
			 							</div>
			 							<div id="leftd">
			 								
			 									<div class="guanz">
			 											<?php $sql = 'select n.photo_src,n.id,n.short_title,n.description,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 and c.name="活动介绍" order by i.priority asc, n.created_at desc limit 6';
															  $news=$db -> query($sql); 
														?>
			 												<div id="activities_top"><div id="textd">活动介绍</div><a target="_blank" href="list.php?id=165">更多 >></a></div>
			 												<div id="activities_img_left"><?php if($news[0]->video_src!=""){show_video_player('171','117',$news[0]->video_photo_src,$news[0]->video_src);}else{ echo '<a target="_blank" href="news.php?id='.$news[0]->id.'"><img width=171 height=117 border=0 src="'.$news[0]->photo_src.'"></a>';} ?></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title"><?php echo $news[0]->short_title; ?></div>
			 														<div class="zhong_c"><?php echo $news[0]->description; ?></div>
			 														<div class="zhong_bottom"><a target="_blank" href="news.php?id=<?php echo $news[0]->id; ?>"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1;$i<5;$i++){ ?>
			 												<div class="content_z">
			 														<div class="content_d"></div>
			 														<div class="content"><a target="_blank" href="news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
			 												</div>
			 												<div class="content_hr"></div>
			 												<?php }?>
			 										</div>
			 										<div class="guanr">
			 											<?php $sql = 'select n.photo_src,n.id,n.short_title,n.description,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 and c.name="基层撷音" order by i.priority asc, n.created_at desc limit 6';
															  $news=$db -> query($sql); 
														?>
			 													<div id="activities_r_top"><div id="texte">基层撷音</div><a target="_blank" href="list.php?id=169">更多 >></a></div>
			 													<div id="activities_r_img"><?php if($news[0]->video_src!=""){show_video_player('171','117',$news[0]->video_photo_src,$news[0]->video_src);}else{ echo '<a target="_blank" href="news.php?id='.$news[0]->id.'"><img width=171 height=117 border=0 src="'.$news[0]->photo_src.'"></a>';} ?></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title"><?php echo $news[0]->short_title; ?></div>
			 														<div class="zhong_c"><?php echo $news[0]->description; ?></div>
			 														<div class="zhong_bottom"><a target="_blank" href="news.php?id=<?php echo $news[0]->id; ?>"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1;$i<5;$i++){ ?>
			 												<div class="content_z">
			 														<div class="content_d"></div>
			 														<div class="content"><a target="_blank" href="news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
			 												</div>
			 												<div class="content_hr"></div>
			 												<?php }?>
			 												
			 										</div>			 								
			 							</div>
			 							<div id="lefte"></div>
			 			</div>
			 			<? include('inc/right.inc.php');?>
			 <? include('inc/bottom.inc.php');?>
		</div>
	</div>
</body>