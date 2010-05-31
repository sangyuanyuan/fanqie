<?php 
	include 'frame.php';
	include 'lib/xspace_api.php';
	include 'lib/ActiveRecord.php';
	include 'inc/project_pubfun.php';
	var_dump(get_baby_album(2));
	#$bloger = new ActiveRecord('blog_spaceitems');
	#var_dump($bloger->fields_defination);
	//$image = BlogImages::find(array('limit' => 2));
	//foreach ($image as $im)
	//echo "<a href={$im->href}>{$im->subject}<img src='{$im->image}' /></a><br/>";
	#var_dump(BlogItems::find(array('condition' => 'uid=1')));
	#$db=get_db();
	#var_dump($db->query("select * from blog_spaceitems limit 2"));
	//echo $blog->href;
	#echo Table::test();
	#$test = new Child();
	#$test->test1();
	#$bloger = new Bloger();
	#var_dump($bloger->_table_name);
?>