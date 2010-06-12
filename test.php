<?php 
	ob_start();
	include 'frame.php';
	use_jquery_ui();
	include 'lib/xspace_api.php';
	include 'lib/discuz_api.php';
	include 'lib/uchome_api.php';
	include 'lib/ActiveRecord.php';
	include 'inc/project_pubfun.php';

	$items = Uchomethread::find($find_param);
	#var_dump($items);					
	$bloger = Bloger::find(1);
	#$ret = create_baby_album(1,'admin','create宝宝111','2010/06/1_201006011115141wlOf.jpg','message','127.0.0.1');
	#$ret = DiscuzThread::find(array('limit' => 5));
	#var_dump($ret);
	echo $bloger->articles[0]->subject;
	#echo date('Y-m-d h:i:s',$bloger->articles[0]->lastpost);
	#echo date('Y-m-d h:i:s',$bloger->baby_album->lastpost);
	#var_dump($bloger->baby_album->images);
	#var_dump($bloger->baby_album->imagenum);
	#$bloger = new ActiveRecord('blog_spaceitems');
	#var_dump($bloger->fields_defination);
	$image = BlogImages::find(array('limit' => 2));
	foreach ($image as $im)
	echo "<a href={$im->href}>{$im->subject}<img src='{$im->image}' /></a><br/>";
	#var_dump(BlogItems::find(array('condition' => 'uid=1')));
	$db=get_db();
	#var_dump($db->query("select * from blog_spaceitems limit 2"));
	echo $blog->href;
	#echo Table::test();
	$test = new Child();
	$test->test1();
	$bloger = new Bloger();
	#var_dump($bloger->_table_name);
?>

<meta charset="UTF-8" />
	
	
	
	
	
	
	
	
	<style type="text/css">
	sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { border:1px dashed; }
	.ui-sortable-placeholder { border: 1px dotted red; visibility: visible !important; }
	.ui-sortable-placeholder * { visibility: hidden; }
	
	</style>
	<script type="text/javascript">
	$(function() {
		$("sortable").sortable({
		});
		$("sortable").disableSelection();
	});
	</script>


<div class="demo">


</div><!-- End demo -->

<div class="demo-description">


</div><!-- End demo-description -->
