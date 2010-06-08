<?php
	if(!class_exists('DiscuzThread')){
		include_once dirname(__FILE__). '/../../lib/discuz_api.php';
	}
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
	$items = DiscuzThread::find($find_param);
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
	$time = date('y-m-d',$items[$i]->dateline);
?>
<?php echo "<li class=\"{$class}\"><a class='list_a' href='{$items[$i]->href}' title='{$items[$i]->subject}'>{$items[$i]->subject}</a><span class='span_time'>{$time}</span></li>"?>
<?php }?>
</ul>