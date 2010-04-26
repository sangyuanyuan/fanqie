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
	    <link href="css/smg.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="ibody">
		<div id="iibody">
			 <? require_once('inc/top.inc.php');?>
			 			<div id="left">
			 							<div id="lefta">
			 										<div id="title_left">
			 										<?php $sql = 'select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="SMG世博青年志愿者" and i.category_type="news" and i.is_adopt=1 and c.name="首页头新闻" order by i.priority asc, n.created_at desc limit 11';
														  $record_star=$db -> query($sql);	 
													?>
			 												<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
																<div id="focus_01"></div> 
																<script type="text/javascript"> 
																var pic_width1=370; //图片宽度
																var pic_height1=278; //图片高度
																
																<?php 
																	$picsurl10 = array();
																	$picslink10 = array();
																	$picstext10 = array();
																	for ($i=0;$i<4;$i++)
																	{
																		$picsurl10[]=$record_star[$i]->photo_src;
																		$picslink10[]='news.php?id='.$record_star[$i]->id;
																		$picstext10[]=$record_star[$i]->title;
																	}
																	
																	
																?>
																var pics1=<?php echo '"',$pics10,'"'?>;
																var mylinks1=<?php echo '"',$mylinks10,'"'?>;
																var texts1=<?php echo '"',$texts10,'"'?>;			
																 	
																var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "370", "278", "4","#FFFFFF");
																picflash.addParam('wmode','opaque');
																picflash.addVariable("picurl",pics1);
																picflash.addVariable("piclink",mylinks1);
																picflash.addVariable("pictext",texts1);				
																picflash.addVariable("pictime","5");
																picflash.addVariable("borderwidth","370");
																picflash.addVariable("borderheight","278");
																picflash.addVariable("borderw","false");
																picflash.addVariable("buttondisplay","true");
																picflash.addVariable("textheight","15");				
																picflash.addVariable("pic_width",pic_width1);
																picflash.addVariable("pic_height",pic_height1);
																picflash.write("focus_01");				
																</script>
			 										</div>
			 										<div id="title_right">
			 												<div id="title" ><?php ?></div>
			 												<div id="w_hr" ></div>
			 												<?php for($i=1;$i<11; $i++){ ?>
			 												<div class="title_w"><a target="_blank" href="">四大发生大幅啊事件发生负担阿桑</a></div><?php if($i==1){ ?><div id="newsa"></div><?php }?>
			 												<?php }?>
			 												<div id="title_buttom"><a target="_blank" href="#"><font style="color:#5A9720">>>&nbsp;更多</a></font></div>
			 										</div>
			 							</div>
			 							<div id="leftb">
			 										<div class="guanz">
			 												<div id="zhong_top"><div id="texta">重点关注</div><a target="_blank" href="#">更多 >></a></div>
			 												<div id="zhong_img_left"></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title">索尼单反拉萨地方</div>
			 														<div class="zhong_c">撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你的fasdfasdf</div>
			 														<div class="zhong_bottom"><a target="_blank" href="#"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1; $i<5; $i++){ ?>
			 												<div class="content_z">
			 														<div class="content_d"></div>
			 														<div class="content"><a target="_blank" href="">十多年封杀的烦恼</a></div>
			 												</div>
			 												<div class="content_hr"></div>
			 												<?php }?>
			 										</div>
			 										<div class="guanr">
			 													<div id="guanr_top"><div id="textb">志愿星</div><a target="_blank" href=""#>更多 >></a></div>
			 													<div id="zhong_img_right_right"></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title">索尼单反拉萨地方</div>
			 														<div class="zhong_c">撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你的fasdfasdf</div>
			 														<div class="zhong_bottom"><a target="_blank" href="#"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1; $i<5; $i++){ ?>
				 												<div class="content_z">
				 														<div class="content_d"></div>
				 														<div class="content"><a target="_blank" href="">十多年封杀的烦恼</a></div>
				 												</div>
				 												<div class="content_hr"></div>
			 												<?php }?>
			 										</div>
			 							</div>
			 							<div id="leftc">
			 									<div id="leftc_top"><div id="textc">志愿者风采</div></div>
			 									<div id="leftc_middle">
			 										<div id="m_m">
			 													<div id="imga">
			 															<img src="./image/img1.gif" style="width:150px; height:105px; border:1px solid #DADADA;  ">
			 															<div class="imga_a">SADFSAFAS</div>
			 													</div>
			 													<div id="imgb">
			 															<img src="./image/img3.gif" style="width:150px; height:105px;  border:1px solid #DADADA; ">
			 															<div class="imga_a">SADFSAFAS</div>
			 													</div>
			 													<div id="imgc">
			 															<img src="./image/img4.gif" style="width:150px; height:105px;  border:1px solid #DADADA; ">
			 															<div class="imga_a">SADFSAFAS</div>
			 													</div>
			 													<div id="imgd">
			 															<img src="./image/img5.jpg" style="width:150px; height:105px;  border:1px solid #DADADA; ">
			 															<div class="imga_a">SADFSAFAS</div>
			 													</div>
			 										</div>
			 									</div>
			 							</div>
			 							<div id="leftd">
			 								
			 									<div class="guanz">
			 												<div id="activities_top"><div id="textd">活动介绍</div><a target="_blank" href="#">更多 >></a></div>
			 												<div id="activities_img_left"></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title">索尼单反拉萨地方</div>
			 														<div class="zhong_c">撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你的fasdfasdf</div>
			 														<div class="zhong_bottom"><a target="_blank" href="#"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1;$i<5;$i++){ ?>
			 												<div class="content_z">
			 														<div class="content_d"></div>
			 														<div class="content"><a target="_blank" href="">四大发生大幅啊事件发生负担阿桑</a></div>
			 												</div>
			 												<div class="content_hr"></div>
			 												<?php }?>
			 										</div>
			 										<div class="guanr">
			 													<div id="activities_r_top"><div id="texte">基层截音</div><a target="_blank" href="#">更多 >></a></div>
			 													<div id="activities_r_img"></div>
			 												<div class="zhong_img_right">
			 														<div class="zhong_title">索尼单反拉萨地方</div>
			 														<div class="zhong_c">撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你撒旦萨迪南磨房乐山大佛拉上你的fasdfasdf</div>
			 														<div class="zhong_bottom"><a target="_blank" href="#"><font style="color:#67A22A;">查看全部</font></a></div>
			 												</div>
			 												<?php for($i=1;$i<5;$i++){ ?>
			 												<div class="content_z">
			 														<div class="content_d"></div>
			 														<div class="content"><a target="_blank" href="">十多年封杀的烦恼</a></div>
			 												</div>
			 												<div class="content_hr"></div>
			 												<?php }?>
			 												
			 										</div>			 								
			 							</div>
			 							<div id="lefte"></div>
			 			</div>
			 			<? require_once('inc/right.inc.php');?>
			 <? require_once('inc/bottom.inc.php');?>
		</div>
	</div>
</body>