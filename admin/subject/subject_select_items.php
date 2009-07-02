<?php
/*
 * just use in ajax mode
 */
	require "../../frame.php";
	parse_str($_SERVER['QUERY_STRING']);
	$db = get_db();
	switch ($category_type[0]) {
		case 'news':
			$record_limit[0] = 1;
			$table = 'smg_news';
		break;
		case 'newslist':
			$table = 'smg_news';
		break;
		case 'photo':
			$record_limit[0] = 1;
			$table = 'smg_images';
		break;
		case 'photolist':
			$table = 'smg_images';
		break;
		case 'video':
			$record_limit[0] = 1;
			$table = 'smg_video';
		break;
		case 'videolist':
			$table = 'smg_video';
		break;
		default:
			;
		break;
	}
	$exists_items = $db->query('select b.* from smg_subject_items a left join ' .$table .' b on a.resource_id = b.id where a.category_id=' .$cate_id[0] .'order by a.priority');
?>
<div id=div_top>
	<h3>筛选属于<?php echo $name[0];?>相关内容 </h3>
</div>

<div id="div_left_box">
	
</div>
<div id="div_right_box">
	
</div>
