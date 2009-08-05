<?php
	$subject_id = $_REQUEST['subject_id'];
	if(!$subject_id){
		die('非法的专题ID');
	}
	$content_type= $_REQUEST['content_type'] ? $_REQUEST['content_type'] : 'news';
	require_once('../../frame.php');	
	$db = get_db();
	switch ($content_type) {
		case 'news':
			$items = $db->query("select b.*,a.category_id as subject_category, a.priority as subject_priority, a.id as item_id, c.name as category_name from smg_subject_items a left join smg_news b on a.resource_id=b.id left join smg_subject_category c on c.id=a.category_id where a.category_type='news' and a.subject_id=$subject_id");;
			$categories = $db->query("select * from smg_subject_category where subject_id=$subject_id and category_type='news'");
		break;
		case 'video':
			$items = $db->query("select b.*,a.category_id as subject_category, a.priority as subject_priority, a.id as item_id, c.name as category_name  from smg_subject_items a left join smg_video b on a.resource_id=b.id left join smg_subject_category c on c.id=a.category_id  where a.category_type='video' and a.subject_id=$subject_id");;
			$categories = $db->query("select * from smg_subject_category where subject_id=$subject_id and category_type='video'");
		break;
		case 'photo':
			$items = $db->query("select b.*,a.category_id as subject_category, a.priority as subject_priority, a.id as item_id, c.name as category_name  from smg_subject_items a left join smg_images b on a.resource_id=b.id left join smg_subject_category c on c.id=a.category_id  where a.category_type='photo' and a.subject_id=$subject_id");;
			$categories = $db->query("select * from smg_subject_category where subject_id=$subject_id and category_type='photo'");
		break;
		default:
			;
		break;
	}
	
	
	$title = urldecode($_REQUEST['title']);
	$user = judge_role('admin');	
	$category_id = $_REQUEST['category'] ? $_REQUEST['category'] : -1;
	$dept_id = $_REQUEST['dept'];
	$is_adopt = $_REQUEST['adopt'];
	
	$sql = 'select * from smg_dept';
	$rows_dept = $db->query($sql);
	$c = array('is_recommend=1');
	if($category_id > 0){
		array_push($c, "category_id=$category_id");
	}
	if($dept_id!=''){
		array_push($c, "dept_id=$dept_id");
	}
	if($flag){
		array_push($c, "tags='$flag'");
	}
	if($is_adopt!=''){
		array_push($c, "is_adopt=$is_adopt");
	}
	if($title){
		#$record = search_content($title,'smg_news',implode(' and ', $c),20,'priority asc,id desc');
	}else{
		#$news = new table_class('smg_news');
		#$record = $news->paginate('all',array('conditions' => implode(' and ', $c),'order' => 'priority asc,id desc'),20);
	}
	
	function conver_type($type){
		switch ($type) {
			case 'news':
				return '新闻';
				break;
			case 'video':
				return '视频';
				break;
			case 'photo':
				return '图片';
				break;
			default:
				;
			break;
		}
	}
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		use_jquery();
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="6">
				<select id="content_type">
					<option value="news" <?php if($_REQUEST['content_type'] == 'news') echo ' selected="selected"';?>>新闻</option>
					<option value="video"<?php if($_REQUEST['content_type'] == 'video') echo ' selected="selected"';?>>视频</option>
					<option value="photo"<?php if($_REQUEST['content_type'] == 'photo') echo ' selected="selected"';?>>图片</option>
				</select>　
				<a href="<?php echo $content_type;?>_edit.php?subject_id=<?php echo $subject_id;?>">添加<?php echo conver_type($content_type);?></a>
				　　　搜索　<input id=title type="text" value="<? echo $title;?>">
				
				<select id="sel_category">
					<option value=-1>请选择</option>
					<?php
					for($i=0;$i < count($categories);$i++){ ?>
					<option value="<?php echo $categories[$i]->id;?>" <?php if($_REQUEST['category_id'] == $categories[$i]->id) echo 'selected="selected"';?>><?php echo $categories[$i]->name;?></option>
					<?php }					
					?>
				</select>
				<select id=adopt style="width:100px" class="select_new">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select>
				
				<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
				<input type="hidden" value="<?php echo $category_id;?>" id="category">
			</td>
		</tr>
		<tr class="tr2">

			<td></td><td width="220">标题</td><td width="100">所属类别</td><td width="120">发布时间</td><td width="200">操作</td>
		</tr>
		<?php
			//--------------------
			
			for($i=0;$i<count($items);$i++){
		?>
				<tr class=tr3 id=<?php echo $items[$i]->id;?> >
					<td><input style="width:12px;" type="checkbox" name="<?php echo $var_name;?>" value="<?php echo $items[$i]->id;?>"></td>					
					<td><a href="<?php echo $url;?>" target="_blank"><?php echo strip_tags($items[$i]->title);?></a></td>
					<td>
						<a href="?category=<?php echo $record[$i]->category_id;?>" style="color:#0000FF">
							<?php echo $items[$i]->category_name; ?>
						</a>
					</td>
					<td>
						<?php echo $items[$i]->created_at; ?>
					</td>								
					<td><?php if($items[$i]->is_adopt=="1"){?>
							<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $items[$i]->id;?>">撤消</span>
						<?php }?>
						<?php if($record[$i]->is_adopt=="0"){?>
							<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $items[$i]->id;?>">发布</span>
						<?php }?>
						<a href="<?php echo $content_type;?>_edit.php?subject_id=<?php echo $subject_id;?>&item_id=<?php echo $items[$i]->item_id;?>&id=<?php echo $items[$i]->id;?>" class="edit" name="<?php echo $items[$i]->id;?>" style="cursor:pointer">编辑</a>
						<a href="/admin/comment/comment.php?id=<?php echo $record[$i]->id;?>&type=news" style="color:#000000; text-decoration:none">评论</a>
						<?php if($record[$i]->dept_id!="7"){?>
							<span style="cursor:pointer;color:#FF0000" class="return" name="<?php echo $items[$i]->id;?>">退回</span>
						<?php }else{?>
							<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $items[$i]->id;?>">删除</span>
						<?php }?>
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$items[$i]->priority){echo $items[$i]->priority;};?>" style="width:40px;">
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=6><button id="select_all">全选</button><button id="button_delete">删除/退回</button><?php paginate();?><button id=clear_priority>清空优先级</button><button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_news">

	</table>
</body>
</html>

<script>
	function do_search(){
		var key = encodeURI($('#title').val());
		var content_type = $('#content_type').val();
		var category_id = $('#sel_category').val();
		window.location.href="subject_content.php?subject_id=<?php echo $subject_id;?>&content_type="+content_type+"&category_id=" + category_id;
	}
	$(function(){
		$('#content_type').change(function(){
			do_search();
		});
	});
</script>
