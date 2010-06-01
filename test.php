<?php 
	include 'frame.php';
	include 'lib/xspace_api.php';
	include 'lib/ActiveRecord.php';
	include 'inc/project_pubfun.php';
	#$bloger = Bloger::find(1);
	$ret = create_baby_album(1,'admin','create宝宝111','2010/06/1_201006011115141wlOf.jpg','message','127.0.0.1');
	var_dump($ret);
	#echo $bloger->articles[0]->subject;
	#echo date('Y-m-d h:i:s',$bloger->articles[0]->lastpost);
	#echo date('Y-m-d h:i:s',$bloger->baby_album->lastpost);
	#var_dump($bloger->baby_album->images);
	#var_dump($bloger->baby_album->imagenum);
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
<p>
	欢迎您，<?php echo $bloger->username;?>
</p>
<p>
	您的宝宝相册里共有<?php echo ( $bloger->baby_album->imagenum);?>张照片,被浏览过<?php echo $bloger->baby_album->viewnum;?>次,回复次数:<?php echo $bloger->baby_album->replynum?>
</p>
<p>
	点击<a href="<?php echo $bloger->baby_album->href?>" target="_blank">这里</a>查看他的宝宝相册
</p>
<p>
	点击<a href="<?php echo $bloger->baby_album->edit_href?>" target="_blank">这里</a>发布宝宝图片
</p>
<p>
	Message:<?php echo $bloger->baby_album->message;?>
</p>
<p>
	封面图片:<img src="<?php echo $bloger->baby_album->image?>" />
</p>

<?php 
	for($i=0;$i< $bloger->baby_album->imagenum; $i++){ ?>
	<p>
		缩略图:<img src="<?php echo $bloger->baby_album->images[$i]->thumbpath?>" />
		原图：<img src="<?php echo $bloger->baby_album->images[$i]->filepath?>" />
	</p>	
<?php 		
	}
?>