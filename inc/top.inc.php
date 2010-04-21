<? 
	require_once('../frame.php');
	$nav = new table_class("smg_nav");
	$nav = $nav->find("all",array('order' => 'id asc'));
	$db = get_db();
	use_jquery();
	js_include_tag('jquery.cookie','pubfun');
	css_include_tag('top');
	function daysInSpan($start,$end)
		{
		 $dayTicks=ticksInDay();
		 return ($end-$start)/$dayTicks;
		}
		 
	function ticksInDay()
	{
	 $today=getdate();
	 $yesterday=mktime(0,0,0,$today[mon],$today[mday]-1,$today[year]);
	 $today=mktime(0,0,0,$today[mon],$today[mday],$today[year]);
	 return $today-$yesterday;
	}
	$nowday=date('Y-m-d');
?>

<div id=nav1>
	<div id=box>
   	<a href="/dx/dx.php" target="_blank"><img src="/images/top/sms.jpg" border=0></a>
		<?php $xsb=$db->query('select id from smg_category where name="星尚榜"'); ?>
		<div id=context><a target="_blank" href="/news/news_list.php?id=<?php echo $xsb[0]->id;?>" target="_blank" style="color:#ff0000;font-weight:bold">星尚榜</a> <a href="/zone/" target="_blank" style="color:#ff0000;font-weight:bold">番茄个性版</a> <a id=line3 style="font-weight:bold; color:#0B0B8D;" href="http://172.27.203.81:8080/news/news/news.php?id=25939" target="_blank" >电脑防毒软件升级</a>　<a href="http://172.27.203.88/emailfront/emailfront.htm" target="_blank">企业邮箱</a> <a href="#">新节目</a> <a href="#">直播</a> <a href="/contact/contact.php" target="_blank">联系我们</a> <span onclick="javascript:document.getElementById('toolcontent').style.display='inline'">常用办公软件</span></div>		
		<a id=home href="/home/" target="_blank"><img src="/images/top/jiayuan.gif" border=0></a>
	</div>
</div>
<? if($nowday!="2010-04-21"){ ?>
<div id=bannerimg>
	<div id=nimg1>
		<div class=deptlogo name=1></div>
		<div class=deptlogo name=2></div>
		<div class=deptlogo name=3></div>
		<div class=deptlogo name=7></div>
		<div class=deptlogo name=8></div>
		<div class=deptlogo name=9></div>
		<div class=deptlogo name=13></div>
		<div class=deptlogo name=14></div>
		<div class=deptlogo name=15></div>
	</div>
	<div id=nimg2>
		<div class=deptlogo name=4></div>
		<div class=deptlogo name=5></div>
		<div class=deptlogo name=6></div>
		<div class=deptlogo name=10></div>
		<div class=deptlogo name=11></div>
		<div class=deptlogo name=12></div>
	</div>
	<div id=fd>
		<div id=fd_l>
			<a target="_blank" href="/subject/jwzxsbh/">技术保障信息平台</a>　<a target="_blank" href="http://192.168.61.247/">节目资源信息发布平台</a>　<a target="_blank" href="/subject/fk/">世博安全保障平台</a>
		</div>
		<?php $banner=$db->query('select * from smg_news where category_id=208 and is_adopt=1 order by priority asc,created_at desc limit 2'); ?>
		<div id=fd_r>
			<a target="_blank" href="/news/news/news.php?id=<?php echo $banner[0]->id; ?>"><?php echo $banner[0]->title; ?></a>　<a target="_blank" href="/news/news/news.php?id=<?php echo $banner[1]->id; ?>"><?php echo $banner[1]->title; ?></a>
		</div>	
	</div>
	<!--<img src="/images/yuanlei.jpg">-->
</div>
<?php }else{ ?>
<div id=bannerimg1>
	<?php $commment=$db->query('select * from smg_comment where resource_type="zf" order by created_at desc'); ?>
	<div id=more><a target="_blank" href="/zf/index.php">我要祈福</a></div>
	<div id=wz>共有<a target="_blank" href="/zf/index.php"><?php echo count($commment); ?></a>人祈福</div>
	<script>
		setTimeout('zfrs()',1000);	
	</script>
</div>
<?php } ?>
<div id=nav2>
	
	<div id=box <? if($nowday=="2010-04-01"){ ?>style="background:url('/images/top/bg2.jpg') no-repeat;"<?php } ?>>
		
		<div id=logo <?php if(date('Y-m-d')=="2010-04-01"){ ?>style="background:url('/images/top/logo2.jpg') no-repeat;"<?php } ?>></div>
		<?php for($j=0;$j<5;$j++){?>
		<ul>
				<?php	for($i=8*$j;$i<8*($j+1);$i++)	{ ?>
				<li><?php if($i%4==0){?><b><?php }?><a href="<?php echo $nav[$i]->href;?>"><?php echo $nav[$i]->name;?></a><?php if($i%4==0){?></b><?php }?></li>
				<?php	}?>
	 	</ul>
		<?php }?>
	  <div id=weather>
			<iframe src="/index_weather<?php if($nowday=="2010-04-01"){ ?>1<?php } ?>.html" width=135px height=22px scrolling="no" frameborder="0"></iframe>
	  </div>
	  <span id=deptbtn <?php if($nowday=="2010-04-01"){ ?>style="background:url('/images/top/dept1.jpg') no-repeat;"<?php } ?> onclick='$("#deptcontent").show();'></span>
	  <div id=search>
	  	<form id="top_search_form" method="get" action="/search/">
	   		<input type="text" name="key"></input>
	   		<button id=button1 <?php if($nowday=='2010-04-01'){ ?>style="background:url('/images/top/btn1_1.jpg') no-repeat;"<?php } ?>></button>
	   		<button id=button2 <?php if($nowday=='2010-04-01'){ ?>style="background:url('/images/top/btn2_1.jpg') no-repeat;"<?php } ?>></button>
			<input type="hidden" name="search_type" id="search_type_hidden" value="smg_news" style="display:none">
		</form>
 			<?php
 				$sql = 'select search_key,count(search_key) as icount from smg_search_keys where TO_DAYS(NOW())-TO_DAYS(created_at) <= 30 group by search_key order by icount desc limit 6';
				$record=$db -> query($sql);		
			?>			
   		<div id=hot>
   			<?php //for($i=0;$i<1;$i++){?>
   				<?php if(date('Y-m-d')!="2010-04-21"){ ?><a href="http://qjdls.smgbb.cn" target=_blank><img style="width:50px; height:20px; margin-top:0px;" width=50 height=20 border=0 src="/images/qj.gif"></a><?php } ?>
   			<!--<a href="/search/?key=<?php echo urlencode($record[0]->search_key)?>&search_type=smg_news" target=_blank><?php echo $record[0]->search_key ?></a>-->　
   			<? //}?>
   			<a href='/zongcai/' target="_blank">总裁奖</a>
   		</div>
			<div id=zongcai><?php if(date('Y-m-d')!="2010-04-21"){ ?><a target="_blank" href="http://192.168.61.247/"><img border=0 style="width:86px; height:14px; margin-top:0px; background:none;" src="/images/pic/world.gif"></a><?php } ?></div>
   	</div>
   	<?php 
   				$cookie=isset($_COOKIE['smg_username']) ? $_COOKIE['smg_username'] : "";
   				if($cookie!="")
   				{
	   				$sql="SELECT count(*) as num FROM smg_birthday_gift where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(created_at) and reciever='".$cookie."'";
	   				$birthday1=$db->query($sql);
	   				$endtime=date("m-d",mktime(date("H",time()),date("i",time()),date("s",time()),date("m",time()),date("d",time())+7,date("Y",time())));
	   				$sql="select count(*) as num from smg_friends f left join smg_user_real a on f.friend_name=a.loginname where Date_format(a.birthday,'%m-%d')>='".date('m-d')."' and Date_format(a.birthday,'%m-%d')<='".$endtime."' and f.my_name='".$cookie."'";
	   				$birthday2=$db->query($sql);
   				}
   				
   	?>
   	<input type="hidden" id="birthday1" style="display:none" value="<?php echo $birthday1[0]->num; ?>"><input type="hidden" style="display:none" id="birthday2" value="<?php echo $birthday2[0]->num; ?>">
		<div id=login>
			
		</div>
	</div>
</div>
&nbsp;
<div id=tool>
	<div id=toolbox>
		<div id=toolcontent>
							<div class=tools><a href="http://172.28.2.112:2000/" target="_blank">新华社</a></div>
							<div class=tools><a href="http://172.27.203.88/techmanage/admin/chart_new1.asp" target="_blank">制作录象计划表</a></div>
							<div class=tools><a href="http://172.27.203.125" target="_blank">办公自动化系统</a></div>
							<div class=tools><a href="http://172.27.203.88/waishi/" target="_blank">外事管理系统</a></div>
							<div class=tools><a href="http://172.27.203.88/CBNBMS/login.aspx" target="_blank">SMG系统</a></div>
							<div class=tools><a href="http://172.27.203.41/test/login.php" target="_blank">奖金发放系统</a></div>
							<div class=tools><a href="http://172.27.203.88/chuanliandan/pro_select.htm" target="_blank">串联单查询</a></div>
							<div class=tools><a href="http://172.27.203.88/stvmis/login.asp" target="_blank">新闻来源系统</a></div>
							<div class=tools><a href="http://172.27.203.47/login/smglogin.jsp" target="_blank">管理信息平台</a></div>
							<div class=tools><a href="http://172.27.203.16:8088/zb/" target="_blank">节目信息管理系统</a></div>
							<div class=tools><a href="http://172.28.10.31/" target="_blank">广播节目检索系统</a></div>
							<div class=tools><a href="http://172.27.203.88/assetsmanage/ReadNews.asp?NewsID=1206&BigClassName=动态公告&SmallClassName=动态公告&SpecialID=0" target="_blank">集团固定资产管理信息系统</a></div>
							<div class=tools style="text-align:right; color:#FF0000; font-weight:bold; cursor:pointer; " onclick='$("#toolcontent").hide();'>关闭</div>
		</div>
	</div>
</div>


<div id=dept>
	<div id=deptbox>
		<div id=deptcontent>
			<?php
				 	 $sql = 'select * from smg_dept_list order by priority asc';
					 $record=$db -> query($sql);		
					 for($i=0;$i<count($record);$i++){
				?>			
					<div class=depts><a href="<?php echo $record[$i]->href;?>" target="_blank"><?php echo $record[$i]->name?></a></div>
				<? }?>
			<!--<div id=top>
				<div class=title>上海广播电视台</div>
				<?php
				 	 $sql = 'select * from smg_dept_list s order by priority asc';
					 $record=$db -> query($sql);		
					 for($i=0;$i<count($record);$i++){
				?>			
					<div class=depts><a href="<?php echo $record[$i]->href;?>" target="_blank"><?php echo $record[$i]->name?></a></div>
				<? }?>
			</div>
			<div id=bottom>
				<div class=title>上海东方传媒集团有限公司</div>
				<?php
				 	 $sql = 'select * from smg_dept_list s where property=2 order by priority asc';
					 $record=$db -> query($sql);		
					 for($i=0;$i<count($record);$i++){
				?>			
					<div class=depts><a href="<?php echo $record[$i]->href;?>" target="_blank"><?php echo $record[$i]->name?></a></div>
				<? }?>
				<div class=depts style="text-align:right; color:#FF0000; font-weight:bold; cursor:pointer; " onclick='$("#deptcontent").hide();'>关闭</div>
			</div>-->
			<div class=depts style="text-align:right; color:#FF0000; font-weight:bold; cursor:pointer; " onclick='$("#deptcontent").hide();'>关闭</div>
		</div>
	</div>
</div>
<script>
	display_login();
	$(function(){
		$('#button1').click(function(){
			$('#top_search_form').attr('action','/search/?search_key=smg_news');
			$('#search_type_hidden').val('smg_news');
			$('#top_search_form').submit();
		});
		$('#button2').click(function(){
			$('#top_search_form').attr('action','/search/');
			$('#search_type_hidden').val('');
			$('#top_search_form').submit();
		});
		$(".deptlogo").click(function(){
			var num=$(this).attr('name');
			if(num==1)
			{
				location.href="http://172.27.203.81:8080/blog/?uid-3398";
			}
			else if(num==2)
			{
				location.href="http://172.27.203.81:8080/blog/?3366";
			}
			else if(num==3)
			{
				location.href="http://172.27.203.81:8080/blog/index.php?uid-3367";
			}
			else if(num==4)
			{
				location.href="http://172.27.203.81:8080/blog/?uid-3370";
			}
			else if(num==5)
			{
				location.href="http://172.27.203.81:8080/blog/?uid-3394";
			}
			else if(num==6)
			{
				location.href="http://172.27.203.81:8080/blog/?3401";
			}
			else if(num==7)
			{
				location.href="http://172.27.203.81:8080/blog/?3385";
			}
			else if(num==8)
			{
				location.href="http://172.27.203.81:8080/home/space.php?uid=3408&do=blog&view=me";
			}
			else if(num==9)
			{
				location.href="http://172.27.203.81:8080/blog/?3392";
			}
			else if(num==10)
			{
				location.href="http://172.27.203.81:8080/blog/?uid-3386";
			}
			else if(num==11)
			{
				location.href="http://172.27.203.81:8080/blog/?3399";
			}
			else if(num==12)
			{
				location.href="http://172.27.203.81:8080/blog/?3402";
			}
			else if(num==13)
			{
				location.href="http://172.27.203.81:8080/blog/?3405";
			}
			else if(num==14)
			{
				location.href="http://172.27.203.81:8080/blog/?uid-3406";
			}
			else if(num==15)
			{
				location.href="http://172.27.203.81:8080/blog/?3444";
			}
		});
	});
</script>