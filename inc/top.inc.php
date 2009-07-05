<? 
	require_once('../frame.php');
	$nav = new table_class("smg_nav");
	$nav = $nav->find("all",array('order' => 'id asc'));
?>

<div id=nav1>
	<div id=box>	
   	<img src="/images/top/sms.jpg">
   	<img src="/images/top/tools.jpg">
		<div id=context><a href="#">企业邮箱</a> <a href="#">新节目</a> <a href="#">直播</a> <a href="#">联系我们</a> <a href="#">常用办公软件</a></div>		
	</div>	
</div>
<div id=nav2>
	<div id=box>
		<div id=logo></div>
		<?php for($j=0;$j<5;$j++){?>
		<ul>
				<?php	for($i=8*$j;$i<8*($j+1);$i++)	{ ?>
				<li><?php if($i==0||$i==8||$i==16||$i==24||$i==32){?><b><?php }?><a href="<?php echo $nav[$i]->href;?>"><?php echo $nav[$i]->name;?></a><?php if($i==0||$i==8||$i==16||$i==24||$i==32){?></b><?php }?></li>
				<?php	}?>
	 	</ul>
		<?php }?>
	  <div id=weather>
	  	<img src="/images/weather/1.gif">
	  	<div id=context>多云 20℃～32℃</div>
	  </div>	
	  <div id=dept></div>	  
	  <div id=search>
   		<input></input>
   		<button id=button1></button>
   		<button id=button2></button>
   		<div id=hot><a href="#">星尚大典</a> <a href="#">小沈阳</a> <a href="#">朝鲜核实验</a></div>
   	</div>
		<div id=login>
			<img src="/images/top/person.jpg">
			<div id=welcome>欢迎您：<span style="font-weight:bold;">admin</span>　<a href="#">修改密码</a>　<a href="#">后台管理</a>　<a href="#">退出</a>
			</div>
		</div>
	  
	</div>
</div>
