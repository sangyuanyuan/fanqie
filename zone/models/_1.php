<?php 
	if($params){
		$params = explode('|',$params);
		foreach($params as $param){
			if($param=='catid=-1')continue;
			if(strpos($param,'order')===0){
				$order = explode('=',$param);
				$order = $order[1];
			}else if(strpos($param,'background-color') === false){
				$con[] = $param;									
			}
		}
		if(is_array($con)){
			$con = implode(' and ', $con);
		}
	}
	$find_param['order'] = $order ? $order : 'viewnum desc, dateline desc';
	$find_param['condition'] = $con;
	$find_param['limit'] = 5;
	$items = BlogArticles::find($find_param);
	$len = count($items);
?>
<style>
<!--
	.blog_list{background: url('/images/zone/list_icon.gif') 0px 7px no-repeat;}
	.list_a{margin-left:5px; width:230px; float:left;}
	.blog_list span{width:50px;height:18px;font-size:10px; line-height:18px; text-align:right; margin-top:2px; float: right; }
	.blog_list span a{color:#999999;}
-->
</style>
<ul>
	<?php for($i=0;$i < $len; $i++){
		$class = "blog_list " .( $i<2 ? 'top' : 'normal');
	?>
	<?php echo "<li class=\"{$class}\"><a class='list_a' href='{$items[$i]->href}' title='{$items[$i]->subject}'  target='_blank'>{$items[$i]->subject}</a><span><a style='color:#999999' href='{$items[$i]->home}' target='_blank'>{$items[$i]->username}</a></span></li>"?>
	<?php }?>
</ul>