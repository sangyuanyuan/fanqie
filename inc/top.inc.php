<? 
	require_once('../frame.php');
	$nav = new table_class("smg_nav");
	$nav = $nav->find("all",array('order' => 'id asc'));
	$db = get_db();
	use_jquery();
	js_include_tag('jquery.cookie','pubfun');
?>

<div id=nav1>
	<div id=box>	
   	<a href="/dx/dx.php" target="_blank"><img src="/images/top/sms.jpg" border=0></a>
		<div id=context><a href="http://172.27.203.88/emailfront/emailfront.htm" target="_blank">企业邮箱</a> <a href="#">新节目</a> <a href="#">直播</a> <a href="/contact/contact.php" target="_blank">联系我们</a> <span onclick="javascript:document.getElementById('toolcontent').style.display='inline'">常用办公软件</span></div>		
		<a id=home href="/home/" target="_blank"><img src="/images/top/jiayuan.gif" border=0></a>
	</div>	
</div>
<div id=nav2>
	<div id=box>
		<div id=logo></div>
		<?php for($j=0;$j<5;$j++){?>
		<ul>
				<?php	for($i=8*$j;$i<8*($j+1);$i++)	{ ?>
				<li><?php if($i%4==0){?><b><?php }?><a href="<?php echo $nav[$i]->href;?>"><?php echo $nav[$i]->name;?></a><?php if($i%4==0){?></b><?php }?></li>
				<?php	}?>
	 	</ul>
		<?php }?>
	  <div id=weather>
	  <!--
			<iframe src="/index_weather.php" width=135px height=22px scrolling="no" frameborder="0"></iframe>
		!-->25℃～28℃ 大雨
	  </div>	
	  <span id=deptbtn onclick='$("#deptcontent").show();'></span>	  
	  <div id=search>
	  	<form id="top_search_form" method="get" action="/search/">
	   		<input type="text" name="key"></input>
	   		<button id=button1></button>
	   		<button id=button2></button>
			<input type="hidden" name="search_type" id="search_type_hidden" value="smg_news" style="display:none">
		</form>
 			<?php
 				$sql = 'select search_key,count(search_key) as icount from smg_search_keys where TO_DAYS(NOW())-TO_DAYS(created_at) <= 30 group by search_key order by icount desc limit 6';
				$record=$db -> query($sql);		
			?>			
   		<div id=hot>
   			<?php for($i=0;$i<2;$i++){?>
   			<a href="/search/?key=<?php echo urlencode($record[$i]->search_key)?>&search_type=smg_news" target=_blank><?php echo $record[$i]->search_key ?></a>　
   			<? }?>
   		</div>
		<div id=zongcai><a href='/zongcai/' target="_blank">总裁奖</a></div>
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

<?php
 	$sql = 'select * from smg_dept_list s order by priority asc';
	$record=$db -> query($sql);		
?>	
<div id=dept>
	<div id=deptbox>
		<div id=deptcontent>
				<?php for($i=0;$i<count($record);$i++){?>			
							<div class=depts><a href="<?php echo $record[$i]->href?>" target="_blank"><?php echo $record[$i]->name?></a></div>
				<? }?>
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
	});
</script>