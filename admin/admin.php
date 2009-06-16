<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<? 	
		css_include_tag('admin');
		use_jquery_ui();
  ?>
</head>
<body style="background:url(/images/admin/bg.jpg) repeat-x;">
	<div id=admin_body>
		<div id=part1>
			<div id=nav>欢迎 </div>
			<div id=title>番茄网后台管理系统</div>
			<div id=index><a href="/index.php" target="_blank">动态主页</a></div>
		</div>
		<div id=part2>
				<?php
					$menu = new table_class("smg_admin_menu");
					$main_menu = $menu->find("all",array('order' => 'parent_id,priority desc'));
					$main_menu2 = $main_menu;
					//--------------------				
					for($i=count($main_menu)-1;$i>=0;$i--)
					{

						//--------------				
						if(0==$main_menu[$i]->parent_id){ 
				?>
						<div class=menu1 id=list1_<?php echo $i?> ><a href="<?php echo $main_menu[$i]->href;?>"><?php echo $main_menu[$i]->name;?></a></div>
						<? 
							 //-----
							 for($j=count($main_menu2)-1;$j>=0;$j--)
							 {	
							 		if($main_menu[$i]->id==$main_menu2[$j]->parent_id)
							 		{
						 ?>	 			
						 			<div class="menu2 list2_<?php echo $i?>" onClick='$("#admin_iframe").attr("src","<?php echo $main_menu2[$j]->href; ?>")' >.<?php echo $main_menu2[$j]->name ?></div>
						 <?	 			
							 		}
						   }
						   //-----
						?>

				<?php 
						}
						//--------------				
					}
				  //--------------------				
				?>
		</div>
		
		<div id=part3>
		  <iframe id=admin_iframe name="admin_iframe" scrolling="yes" src="/admin/menu/menu_list.php" width="99%" height="700"></iframe>
		</div>		
	</div>
</body>
</html>
<script>
$(function(){
	$(".menu1").click(function(){
		$(".menu2").hide();
		$(this).find(".menu2").show();
		
		
	});
});
	
	
	
</script>



