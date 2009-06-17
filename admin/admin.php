<?php
	require_once('../frame.php');
	css_include_tag('admin');
	use_jquery_ui();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body  style="background:url(/images/bg/admin_bg2.jpg) repeat-x;">
	<div id=admin_body>
		<div id=part1>
			<div id=nav></div>
			<div id=title>SMG</div>
			<div id=index><a href="/index.php" target="_blank">SMG</a></div>
		</div>
		<div id=part2>
			<div id="accordion">
				<?php				
					$menu = new table_class("smg_admin_menu");
<<<<<<< HEAD:admin/admin.php
					$main_menu = $menu->find("all",array('order' => 'parent_id,priority desc'));
					$main_menu2 = $main_menu;
					//--------------------				
					for($i=count($main_menu)-1;$i>=0;$i--)
					{

						//--------------				
						if(0==$main_menu[$i]->parent_id){ 
				?>

						<div class="menu1"><a href="<?php echo $main_menu[$i]->href;?>" target="<?php echo $main_menu[$i]->target;?>" list="<?php echo $i;?>"><?php echo $main_menu[$i]->name;?></a></div>

						<? 
							 //-----
							 for($j=count($main_menu2)-1;$j>=0;$j--)
							 {	
							 		if($main_menu[$i]->id==$main_menu2[$j]->parent_id)
							 		{
						 ?>	 			
						 			<div class="menu2 list2_<?php echo $i;?>" onClick='$("#admin_iframe").attr("src","<?php echo $main_menu2[$j]->href; ?>")' >.<?php echo $main_menu2[$j]->name ?></div>
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
=======
					$main_menu = $menu->find("all",array('conditions' => 'href="#"  and parent_id=0','order' => 'priority'));
					for($i=0;$i<count($main_menu);$i++){
>>>>>>> db1f775f3ef144d96c55809b7737b3213ad1fa5b:admin/admin.php1
				?>
				<div class=menu1><a href="<?php echo $main_menu[$i]->href;?>"><?php echo $main_menu[$i]->name;?></a></div>
					<?php
						$child_menu=$menu->find("all",array('conditions' => 'parent_id='.$main_menu[$i]->id,'order' => 'priority'));
						for($j=0;$j<count($child_menu);$j++){
					?>
						<div class=menu2>·<a href="<?php echo $child_menu[$j]->href;?>" target="admin_iframe"><?php echo $child_menu[$j]->name;?></a></div>
					<?php }
						}?>
			</div>
			<?php
				$main_menu = $menu->find("all",array('conditions' => 'href!="#" and parent_id=0','order' => 'priority'));
				for($i=0;$i<count($main_menu);$i++){
			?>
			<div class=menu1><a href="<?php echo $main_menu[$i]->href;?>" target="admin_iframe"><?php echo $main_menu[$i]->name;?></a></div>
			<?php }?>
		</div>
		
		<div id=part3>
		  <iframe id=admin_iframe name="admin_iframe" scrolling="yes" src="menu_list.php" width="99%" height="700"></iframe>
		</div>
	</div>
</body>
</html>

<SCRIPT type=text/javascript>
	$(function() {
		$("#accordion").accordion({
			active:10,
			autoHeight:false,
			animated:false
		});
	});
</SCRIPT>


