<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$vote = new table_class('smg_vote');
	$vote_record = $vote->find('all',array('conditions' => 'id='.$id));
	$vote_type = $vote_record[0]->vote_type;
	switch($vote_type) {
			case "word_vote":
				$vote_name = "文字投票";
				break;
			case "image_vote":
				$vote_name = "图片投票";
				break;
			case "more_vote":
				$vote_name = "复合投票";
				break;
			default:
				$vote_name = "未知类型";
	}
	$vote_item = new table_class('smg_vote_item');
	$vote_item_record = $vote_item->find('all',array('conditions' => 'vote_id='.$id));
	$count = count($vote_item_record);
	$category = new table_class("smg_category");
	$category_menu = $category->find("all",array('conditions' => "category_type='vote'","order" => "priority"));
	$category_count = count($category_menu);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
<?php 
	css_include_tag('admin','thickbox','jquery_ui');
	use_jquery_ui();
	js_include_once_tag('thickbox');
	js_include_tag('admin_pub','vote_edit','ajaxfileupload');
	validate_form("vote_form");
?>
</head>

<body>
<form id="vote_form" method="post" enctype="multipart/form-data" action="vote.post.php">
 <table width="795" border="0" id="list">
		<tr class=tr1>
			<td colspan="2">　添加投票</td>
		</tr>
		<tr class=tr3>
			<td width=150>标题：</td>
			<td width=645 align="left"><?php show_fckeditor('title','Title',true,"80",$vote_record[0]->name);?></td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" name="vote[description]" value="<?php echo $vote_record[0]->description;?>"></td>
		</tr>
		<tr class=tr3>
			<td>添加图片：</td>
			<td align="left"><?php if(null!=$vote_record[0]->photo_url){?><img src="<?php echo  $vote_record[0]->photo_url;?>" width="50" height="50" border="0"><?php }?><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file"></td>
		</tr>
		<tr class=tr3>
			<td>投票选项限制：</td>
			<td align="left"><input type="text" name="vote[max_item_count]" class="number" id="max_item_count" value="<?php echo $vote_record[0]->max_item_count;?>">如果不填则无限制</td>
		</tr>
		<?php if($vote_type=="word_vote"){?>
			<tr class=tr3>
				<td>投票项目：</td>
				<td align="left">
					标题<input type="text" name="vote_item1[title]" id="first_item" style="width:100px" class="required" value="<?php echo $vote_item_record[0]->title?>">
					<a id="add_item" value="1" style="cursor:pointer;">继续添加</a>
					<input type="hidden" name="deleted1" value="false">
					<input type="hidden" name="vote_item1_id" value="<?php echo $vote_item_record[0]->id;?>">
				</td>	
			</tr>
			<?php for($k=2;$k<=$count;$k++){?>
				<tr class=tr3>
					<td>投票项目：</td>
					<td align="left">
						标题<input type="text" name="vote_item<?php echo $k;?>[title]" style="width:100px;" class="required" value="<?php echo $vote_item_record[$k-1]->title;?>">
						<a class='del_item' name="<?php echo $vote_item_record[$k-1]->id;?>" style='cursor:pointer;'>删除</a>
						<input type="hidden" name="deleted<?php echo $k;?>" id="deleted<?php echo $k;?>" value="false">
						<input type="hidden" name="vote_item<?php echo $k;?>_id" value="<?php echo $vote_item_record[$k-1]->id;?>">
					</td>	
				</tr>
			<?php }?>
		<?php }?>
 </table>
 <table width="795" border="0" id="list">
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="type" value="edit">
		<input type="hidden" name="vote_id" value="<?php echo $id;?>">
		<input type="hidden" id="vote_type" value="word_vote">
		<input type="hidden" id="vote_item_count" name="vote_item_count" value="<?php echo $count;?>">
		<input type="hidden" name="is_app" value="1">
 </table>
 </form>
 
</body>
</html>