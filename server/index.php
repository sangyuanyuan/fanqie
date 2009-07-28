<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-首页</title>
	<? 	
		css_include_tag('server_index','top','bottom');
		use_jquery();
		$db=get_db();
		$pics = $db->query('SELECT * FROM smg_images s inner join smg_category c on s.category_id=c.id and c.name="番茄团购" and c.category_type="picture" order by s.priority asc, created_at desc limit 7');
		$tg=$db->query('select id,photourl,title from smg_tg order by priority asc,createtime desc limit 7');
		$gd=$db->query('SELECT s.* FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="番茄团购" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 5');
		$shop=$db->query('select * from smg_shopdp order by createtime desc limit 3');
		$shopph=$db->query('select b.name,b.id from smg_shopdp b inner join (select count(*) as num,s.shopdpid from smg_shop_signup ss inner join smg_shop s on ss.tg_id=s.id group by s.shopdpid order by num desc) as a on b.id=a.shopdpid');
		if(count($shopph)<10)
		{
			$bt=array();
			for($i=0;$i<count($shopph);$i++)
			{
				$bt[]=$shopph[$i]->id;
			}
			$bt1=implode(',',$bt);
			$bznum=10-count($shopph);
			$bz=$db->query('select * from smg_shopdp where id not in ('.$bt1.') limit '.$bznum);
		}
		$gj=$db->query('SELECT s.id,s.title,s.last_edited_at,s.platform,d.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="番茄工具" and c.category_type="news" inner join smg_dept d on s.dept_id=d.id order by s.priority asc, s.last_edited_at desc limit 9');
		$nbxx=$db->query('SELECT s.id,s.platform,s.photo_src,s.short_title,c.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="内部信息" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 2');
  		$yczh=$db->query('SELECT s.id,s.platform,s.photo_src,s.short_title,c.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="演出展会" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 2');
  		$xptj=$db->query('SELECT s.id,s.platform,s.photo_src,s.short_title,c.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="新片推荐" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 2');
		$msys=$db->query('SELECT s.id,s.platform,s.photo_src,s.short_title,c.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="美食养生" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 2');
		$gwmd=$db->query('SELECT s.id,s.platform,s.photo_src,s.short_title,c.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="购物摩登" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 2');
		$tyyl=$db->query('SELECT s.id,s.platform,s.photo_src,s.short_title,c.name FROM smg_news s inner join smg_category c on s.category_id=c.id and c.name="体育娱乐" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 2');
		$tk=$db->query('select id,name from smg_problem order by create_time desc limit 7');
		$tp=$db->query('SELECT * FROM smg_vote s where vote_type<>"more_type" and vote_type<>"image_vote" and is_sub_vote=0 order by created_at desc');
		$man=$db->query('select name,birthday,height,education,photo,school from smg_marry where sex="man" order by id desc limit 5');
		$woman=$db->query('select name,birthday,height,education,photo,school from smg_marry where sex="woman" order by id desc limit 5');
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_l>
			<div id=title>番茄团购</div>
			<div id=t_l_t_l>
				<? 		
				$picsurl10 = array();
				$picslink10 = array();
				$picstext10 = array();
				for ($i=0;$i<5;$i++)
				{
					$picsurl10[]=$pics[$i]->src;
					$picslink10[]=$pics[$i]->url;
					$picstext10[]=$pics[$i]->title;
				}
				?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<div id="focus_10"></div> 
				<script type="text/javascript"> 
				var pic_width=360; //图片宽度
				var pic_height=195; //图片高度
				var pics10="<?php echo implode(',',$picsurl10);?>";
				var mylinks10="<?php echo implode(',',$picslink10);?>";
				
				var texts10="<?php echo implode(',',$picstext10);?>";
 
				var picflash = new sohuFlash("/flash/focus.swf", "focus_10", "360", "195", "6","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics10);
				picflash.addVariable("piclink",mylinks10);
				picflash.addVariable("pictext",texts10);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","360");
				picflash.addVariable("borderheight","195");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","0");
				picflash.addVariable("textcolor","#FF0000");	
				picflash.addVariable("pic_width",pic_width);
				picflash.addVariable("pic_height",pic_height);
				
				picflash.write("focus_10");				
				</script>
			</div>
			<div id=t_l_t_r>
				<a target="_blank" href="<?php echo $pics[5]->url;?>"><img src="<?php echo $pics[5]->src;?>"></a>
				<?php for($i=0;$i<4;$i++){?>
					<div class="content">·<a target="_blank" href="/fqtg/fqtg.php?id=<?php echo $tg[$i]->id;?>"><?php echo $tg[$i]->title; ?></a></div>
				<?php } ?>
				<a target="_blank" href="<?php echo $pics[6]->url;?>"><img src="<?php echo $pics[6]->src;?>"></a>
			</div>
			<div id="gd">
				<MARQUEE scrollAmount=1 scrollDelay=10 behavior=scroll width="100%" height="20" style="line-height:20px;">
					<?php for($i=0;$i<count($gd);$i++){ ?>
						<a style="color:#FF00FF; font-weight:bold; text-decoration:none;" target="_blank" href="/fqtg/fqtglist.php"><?php echo delhtml($gd[$i]->short_title);?></a>
					<?php } ?>
				</MARQUEE>
			</div>
			<div id="imggd">
					<DIV id=Layer5>
				      <DIV id=demo style="OVERFLOW: hidden; WIDTH: 100%; COLOR: #ffffff">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo1 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=middle>
				              	<? for($i=0;$i<count($tg);$i++){?>
				                <TD><a target="_blank" href="/fqtg/fqtg.php?id=<?php echo $tg[$i]->id;?>"><img border=0 width=130 height=110 src="<? echo $tg[$i]->photourl; ?>"><div style="width:130px; height:20px; overflow:hidden; float:left; display:inline;"><?php echo $tg[$i]->title;?></div></a></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id=demo2 vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo2.innerHTML=demo1.innerHTML
											function Marquee(){
											if(demo2.offsetWidth-demo.scrollLeft<=0)
											demo.scrollLeft-=demo1.offsetWidth
											else{
											demo.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo.onmouseover=function() {clearInterval(MyMar)}
											demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
				</DIV>
			</div>
			<div id="t_l_b_l">
				<?php for($i=0;$i<count($shop);$i++){?>
				<div class="content">
					<div class=left><a target="_blank" href="/shop/splist.php?id=<?php echo $shop[$i]->id;?>"><img src="<?php echo $shop[$i]->shopurl; ?>"></a></div>
					<div class=right>
						<div class=title><a target="_blank" href="/shop/splist.php?id=<?php echo $shop[$i]->id;?>">店铺：<?php echo $shop[$i]->name;?></a></div>
						<div class="remark"><a target="_blank" href="/shop/splist.php?id=<?php echo $shop[$i]->id;?>">店铺简介：<?php echo delhtml($shop[$i]->remark); ?></a></div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id="t_l_b_r">
				<div id=t_l_b_r_t></div>
				<div id=t_l_b_r_b>
					<div id=t_l_b_r_b_title>销售排行榜</div>
					<div id=t_l_b_r_b_title1>店铺名称</div>
				<?php for($i=0;$i<count($shopph);$i++){ ?>
					<div class="t_l_b_r_b_content">
						<img src="/images/server/num<?php echo $i+1;?>.jpg"><a target="_blank" href="/shop/splist.php?id=<?php echo $shopph[$i]->id;?>"><?php echo $shopph[$i]->name;?></a>
					</div>
				<?php } 
				if(count($shopph)<10){
					$num=count($shopph)+1;
					for($i=0;$i<count($bz);$i++){
				?>
					<div class="t_l_b_r_b_content">
						<img src="/images/server/num<?php echo $num;?>.jpg"><a target="_blank" href="/shop/splist.php?id=<?php echo $bz[$i]->id;?>"><?php echo $bz[$i]->name;?></a>
					</div>		
				<?php $num++; }} ?>
			  </div>
			</div>
		</div>
		<div id=t_r_t>
			<div id=brithday>
				<MARQUEE scrollAmount=1 scrollDelay=60 behavior=scroll  width="100%" style="line-height:24px;">
					<?php
						$birthday = $db->query("SELECT a.nickname,a.gender,b.name FROM smg_user_real a left join smg_org_dept b on a.org_id = b.orgid  where a.state=3 and Date_format(a.birthday,'%m-%d') = '" .date('m-d') ."';");	
															
						for($i=0;$i<count($birthday);$i++)
						{
					?>	
					<img src="<?php if($birthday[$i]->gender == '男') echo '/images/icon/boy.gif'; else echo '/images/icon/girl.gif';?>">　<span style="color:#000000;"><?php echo $birthday[$i]->nickname;?>[</span><? echo $birthday[$i]->name;?><span style="color:#000000;">]</span>　　
						<?php
						}
				    ?>
				</MARQUEE>
			</div>
		</div>
		<div id=t_r_m>
			<div id=title>生活这点事</div>
			<div id=bottom>
				<div id=hd>
					<div class="left">
					<?php for($i=0;$i<count($nbxx);$i++){
						 if($nbxx[$i]->photo_src!=""){ ?><a target="_blank" href="/<?php echo $nbxx[$i]->platform;?>/news/news.php?id=<?php echo $nbxx[$i]->id;?>"><img src="<?php echo $nbxx[$i]->photo_src;?>"></a>
					<?php break; }} ?></div>
					<div class="right">
						<div class=catename><?php echo $nbxx[0]->name; ?></div>
						<?php for($i=0;$i< count($nbxx);$i++){ ?>
							<div class=content><a target="_blank" href="/<?php echo $nbxx[$i]->platform;?>/news/news.php?id=<?php echo $nbxx[$i]->id;?>"><?php echo delhtml($nbxx[$i]->short_title); ?></a></div>
						<?php } ?>
					</div>
					<div class="left">
					<?php for($i=0;$i<count($yczh);$i++){
						 if($yczh[$i]->photo_src!=""){ ?><a target="_blank" href="/<?php echo $yczh[$i]->platform;?>/news/news.php?id=<?php echo $yczh[$i]->id;?>"><img src="<?php echo $yczh[$i]->photo_src;?>"></a>
					<?php break; }} ?></div>
					<div class="right">
						<div class=catename><?php echo $yczh[0]->name; ?></div>
						<?php for($i=0;$i< count($yczh);$i++){ ?>
							<div class=content><a target="_blank" href="/<?php echo $yczh[$i]->platform;?>/news/news.php?id=<?php echo $yczh[$i]->id;?>"><?php echo delhtml($yczh[$i]->short_title); ?></a></div>
						<?php } ?>
					</div>
					<div class="left">
					<?php for($i=0;$i<count($xptj);$i++){
						 if($xptj[$i]->photo_src!=""){ ?><a target="_blank" href="/<?php echo $xptj[$i]->platform;?>/news/news.php?id=<?php echo $xptj[$i]->id;?>"><img src="<?php echo $xptj[$i]->photo_src;?>"></a>
					<?php break; }} ?></div>
					<div class="right">
						<div class=catename><?php echo $xptj[0]->name; ?></div>
						<?php for($i=0;$i< count($xptj);$i++){ ?>
							<div class=content><a target="_blank" href="/<?php echo $xptj[$i]->platform;?>/news/news.php?id=<?php echo $xptj[$i]->id;?>"><?php echo delhtml($xptj[$i]->short_title); ?></a></div>
						<?php } ?>
					</div>
				</div>
				<div id=xx>
					<div class="left">
					<?php for($i=0;$i<count($msys);$i++){
						 if($msys[$i]->photo_src!=""){ ?><a target="_blank" href="/<?php echo $msys[$i]->platform;?>/news/news.php?id=<?php echo $msys[$i]->id;?>"><img src="<?php echo $msys[$i]->photo_src;?>"></a>
					<?php break; }} ?></div>
					<div class="right">
						<div class=catename><?php echo $msys[0]->name; ?></div>
						<?php for($i=0;$i< count($msys);$i++){ ?>
							<div class=content><a target="_blank" href="/<?php echo $msys[$i]->platform;?>/news/news.php?id=<?php echo $msys[$i]->id;?>"><?php echo delhtml($msys[$i]->short_title); ?></a></div>
						<?php } ?>
					</div>
					<div class="left">
					<?php for($i=0;$i<count($gwmd);$i++){
						 if($gwmd[$i]->photo_src!=""){ ?><a target="_blank" href="/<?php echo $gwmd[$i]->platform;?>/news/news.php?id=<?php echo $gwmd[$i]->id;?>"><img src="<?php echo $gwmd[$i]->photo_src;?>"></a>
					<?php break; }} ?></div>
					<div class="right">
						<div class=catename><?php echo $gwmd[0]->name; ?></div>
						<?php for($i=0;$i< count($gwmd);$i++){ ?>
							<div class=content><a target="_blank" href="/<?php echo $gwmd[$i]->platform;?>/news/news.php?id=<?php echo $gwmd[$i]->id;?>"><?php echo delhtml($gwmd[$i]->short_title); ?></a></div>
						<?php } ?>
					</div>
					<div class="left">
					<?php for($i=0;$i<count($tyyl);$i++){
						 if($tyyl[$i]->photo_src!=""){ ?><a target="_blank" href="/<?php echo $tyyl[$i]->platform;?>/news/news.php?id=<?php echo $tyyl[$i]->id;?>"><img src="<?php echo $tyyl[$i]->photo_src;?>"></a>
					<?php break; }} ?></div>
					<div class="right">
						<div class=catename><?php echo $tyyl[0]->name; ?></div>
						<?php for($i=0;$i< count($tyyl);$i++){ ?>
							<div class=content><a target="_blank" href="/<?php echo $tyyl[$i]->platform;?>/news/news.php?id=<?php echo $tyyl[$i]->id;?>"><?php echo delhtml($tyyl[$i]->short_title); ?></a></div>
						<?php } ?>
					</div>
				</div>
			</div>	
		</div>
		<div id=t_r_b>
			<div id=content>
				<?php for($i=0;$i<count($gj);$i++){ ?>
					<div class=context><div class="contexttitle"><a href="/<?php echo $gj[$i]->platform; ?>/news/news.php?id=<?php echo $gj[$i]->id; ?>"><span style="color:#0070B0; ">[<?php echo $gj[$i]->name; ?>]</span><?php echo delhtml($gj[$i]->title);?></a></div><div style="width:120px; height:25px; color:#999999; cursor:pointer; float:right; display:inline;"><?php echo $gj[$i]->last_edited_at;?></div></div>
				<?php } ?>
			</div>
		</div>
		<div id=t_r_answer>
			<div id=t_r_answer_t>
				<div id=pic><img src="/images/server/index_dt.jpg"></div>
				<div id=content>
					<div id="title"><?php echo $tk[0]->name;?></div>
				</div>
				<div id=dt>
					<a target="_blank" href="/answer/pro_answer.php?id=<?php echo $tk[0]->id;?>"><img border=0 src="/images/server/index_start_dt.jpg"></a>
				</div>
			</div>
			<div id=t_r_answer_b>
				<div id=t_r_answer_b_l>
					<?php for($i=1;$i<count($tk);$i++){ ?>
						<div class=content><a target="_blank" href="/answer/pro_answer.php?id=<?php echo $tk[$i]->id;?>"><?php echo delhtml($tk[$i]->name); ?></a></div>
					<?php } ?>
				</div>
				<div id=t_r_answer_b_r>发起答题</div>
			</div>
		</div>
	</div>
	<div id=ibody_middle></div>
	<div id=ibody_bottom>
		<div id=b_l>
			<div id=b_l_t>
				<DIV id=Layer5>
				      <DIV id=demo3 style="OVERFLOW: hidden; WIDTH: 100%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo4 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<? for($i=0;$i<count($man);$i++){?>
				                <TD><div class=content>
							<div class=pic><a target="_blank" href="/server/marry.php"><img border=0 width=87 height=105 src="<?php echo $man[$i]->photo;?>"></a></div>
							<div class=context>姓名：<?php echo $man[$i]->name;?><br>出生年月：<?php echo $man[$i]->birthday; ?><br>身高：<?php echo $man[$i]->height;?>米<br>学历：<?php echo $man[$i]->education;?><br>毕业院校：<?php echo $man[$i]->school;?></div>
						</div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id=demo5 vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo5.innerHTML=demo4.innerHTML
											function Marquee(){
											if(demo5.offsetWidth-demo3.scrollLeft<=0)
											demo3.scrollLeft-=demo4.offsetWidth
											else{
											demo3.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo3.onmouseover=function() {clearInterval(MyMar)}
											demo3.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
				</DIV>			
			</div>
			<div id=b_l_b>
				<DIV id=Layer5>
				      <DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 100%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo7 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<? for($i=0;$i<count($woman);$i++){?>
				                <TD><div class=content>
							<div class=pic><a target="_blank" href="/server/marry.php"><img border=0 width=87 height=105 src="<?php echo $woman[$i]->photo;?>"></a></div>
							<div class=context>姓名：<?php echo $woman[$i]->name;?><br>出生年月：<?php echo $woman[$i]->birthday; ?><br>身高：<?php echo $woman[$i]->height;?>米<br>学历：<?php echo $woman[$i]->education;?><br>毕业院校：<?php echo $woman[$i]->school;?></div>
						</div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id=demo8 vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
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
			<div id=b_l_b_r>
				<a target="_blank" href="/server/apply.php"><img border=0 src="/images/server/wyzh.jpg"></a>
			</div>
		</div>
		<div id=b_r>
			<div id=left>
				<div id="tp">投票</div>
				<div id=vote>
					<?php $vote = new smg_vote_class();
					$vote->find($tp[0]->id);
					$vote->display(array("target"=>"_blank"));?>
				</div>
			</div>
			<div id=right>
				<?php for($i=0;$i<count($tp);$i++){?>
					<div class=content>·<a target="_blank" href="/vote/vote.php"><?php echo delhtml($tp[$i]->name);?></a></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	$(document).ready(function(){
		$('#t_r_answer_b_r').click(function(){
			window.location.href="/answer/question.php";
		})
	})
</script>