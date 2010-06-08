<?php 
	$con[] = "is_adopt=1";
	$con[] = "category_id=215";
	if($params){
		$params = explode('|',$params);
		foreach($params as $param){
			if($param=='category_id=-1')continue;
				if(strpos($param,'order')===0){
					$order = explode('=',$param);
					$order = $order[1];
					}else if(strpos($param,'background-color') === false){
					$con[] = $param;									
				}
			}
	}
	$con = implode(' and ', $con);
	$order = $order ? $order : 'created_at desc';
	$limit = 5;
	$db = get_db();
	$items = $db->query("select title,id,created_at from smg_news where {$con} order by {$order} limit {$limit}");
	$len = count($items);
?>
<style>
<!--
	.blog_list{background: url('/images/zone/list_icon.gif') 0px 7px no-repeat;}
	.list_a{margin-left:5px; width:230px; float:left;}
	.span_time{width:50px;height:18px;font-size:10px; line-height:18px; color:#999999; text-align:right; margin-top:2px; float: right;}
-->
</style>
<ul>
	<?php for($i=0;$i < $len; $i++){
		$class = "blog_list " .( $i<2 ? 'top' : 'normal');
		$time = date('y-m-d',$items[$i]->created_at);
	?>
	<?php echo "<li class=\"{$class}\"><a class='list_a' href=/news/news.php?id={$items[$i]->id} title='{$items[$i]->title}'>{$items[$i]->title}</a><span class='span_time'>{$time}</span></li>"?>
	<?php }?>
</ul>