<? 
	require_once('../frame.php');
	$nav = new table_class("smg_nav");
	$nav = $nav->find("all",array('order' => 'id asc'));
	use_jquery();
	js_include_tag('jquery.cookie','pubfun');
?>

<div id=nav1>
	<div id=box>	
   	<img src="/images/top/sms.jpg">
		<div id=context><a href="http://172.27.203.88/emailfront/emailfront.htm" target="_blank">企业邮箱</a> <a href="#">新节目</a> <a href="#">直播</a> <a href="#">联系我们</a> <span onclick="javascript:document.getElementById('toolcontent').style.display='inline'">常用办公软件</span></div>		
	</div>	
</div>
<div id=nav2>
	<div id=box>
		<div id=logo></div>
		<?php for($j=0;$j<5;$j++){?>
		<ul>
				<?php	for($i=8*$j;$i<8*($j+1);$i++)	{ ?>
				<li><?php if($i%4==0){?><b><?php }?><a href="<?php echo $nav[$i]->href;?>" target=_blank><?php echo $nav[$i]->name;?></a><?php if($i%4==0){?></b><?php }?></li>
				<?php	}?>
	 	</ul>
		<?php }?>
	  <div id=weather>
	  	<img src="/images/weather/1.gif">
	  	<div id=context>多云 20℃～32℃</div>
	  </div>	
	  <span id=deptbtn onclick='$("#deptcontent").show();'></span>	  
	  <div id=search>
	  	<form id="top_search_form" method="get" action="/search/">
	   		<input type="text" name="key"></input>
	   		<button id=button1></button>
	   		<button id=button2></button>
		</form>
   		<div id=hot><a href="#">星尚大典</a> <a href="#">小沈阳</a> <a href="#">朝鲜核实验</a></div>
   	</div>
		<div id=login>
			<div id=welcome>			<img src="/images/top/person.jpg">
欢迎您：<span style="font-weight:bold;">admin</span>　<a href="#">修改密码</a>　<a href="#">后台管理</a>　<a href="#">退出</a>
			</div>
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
							<div class=tools><a href="http://172.27.203.88/smgit/pro_select.htm" target="_blank">串联单查询</a></div>
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
							<div class=depts><a href="http://172.28.2.112:2000/" target="_blank">新华社</a></div>
							<div class=depts><a href="http://172.27.203.88/techmanage/admin/chart_new1.asp" target="_blank">制作录象计划表</a></div>
							<div class=depts><a href="http://172.27.203.125" target="_blank">办公自动化系统</a></div>
							<div class=depts><a href="http://172.27.203.88/waishi/" target="_blank">外事管理系统</a></div>
							<div class=depts><a href="http://172.27.203.88/CBNBMS/login.aspx" target="_blank">SMG系统</a></div>
							<div class=depts><a href="http://172.27.203.41/test/login.php" target="_blank">奖金发放系统</a></div>
							<div class=depts><a href="http://172.27.203.88/smgit/pro_select.htm" target="_blank">串联单查询</a></div>
							<div class=depts><a href="http://172.27.203.88/stvmis/login.asp" target="_blank">新闻来源系统</a></div>
							<div class=depts><a href="http://172.27.203.47/login/smglogin.jsp" target="_blank">管理信息平台</a></div>
							<div class=depts><a href="http://172.27.203.16:8088/zb/" target="_blank">节目信息管理系统</a></div>
							<div class=depts><a href="http://172.28.10.31/" target="_blank">广播节目检索系统</a></div>
							<div class=depts><a href="http://172.27.203.88/assetsmanage/ReadNews.asp?NewsID=1206&BigClassName=动态公告&SmallClassName=动态公告&SpecialID=0" target="_blank">集团固定资产管理信息系统</a></div>
							<div class=tools style="text-align:right; color:#FF0000; font-weight:bold; cursor:pointer;" onclick='$("#deptcontent").hide();'>关闭</div>
		</div>
	</div>
</div>
<script>
	display_login();
	$(function(){
		$('#button1').click(function(){
			$('#top_search_form').attr('action','/search/?search_key=smg_news');
			$('#top_search_form').submit();
		});
		$('#button2').click(function(){
			$('#top_search_form').attr('action','/search/');
			$('#top_search_form').submit();
		});
	});
</script>