<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
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
		js_include_tag('vote_list','admin_pub');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="8">　<a style="margin-right:50px" href="vote_add.php">添加投票</a>
			<span style="margin-left:100px; font-size:13px">搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索" id="vote_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td>投票名称</td><td width="80">登录限制</td><td width="80">票数限制</td><td width="80">投票类型</td><td width="80">发布时间</td><td width="80">到期时间</td><td width="80">所属类别</td><td width="120">操作</td>
		</tr>
		<?php
			$category = new table_class('smg_category');
			$category_record = $category->find('all',array('conditions' => 'category_type="vote"'));
			$category_count = count($category_record);
			$vote = new table_class("smg_vote");
			if($key!=''){
				$record = $vote->paginate("all",array('conditions' => 'is_sub_vote=0  and name  like "%'.trim($key).'%"','order' => 'created_at desc'),18);
			}else{
				$record = $vote->paginate("all",array('conditions' => 'is_sub_vote=0 ','order' => 'created_at desc'),18);
			}
			$count_record = count($record);
			//--------------------
			for($i=0;$i<$count_record;$i++){
				switch($record[$i]->vote_type) {
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
				
				switch($record[$i]->limit_type) {
					case "user_id":
						$limit_name = "工号登录";
						break;
					case "ip":
						$limit_name = "IP控制";
						break;
					case "no_limit":
						$limit_name = "不设限制";
						break;
					default:
						$limit_name = "未知类型";
				}
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $limit_name;?></td>
					<td><?php echo $record[$i]->max_vote_count;?></td>
					<td><?php echo $vote_name;?></td>
					<td><?php echo substr($record[$i]->created_at, 0, 10);?></td>
					<td><?php echo substr($record[$i]->ended_at, 0, 10);?></td>
					<td><?php for($j=0;$j<$category_count;$j++){if($category_record[$j]->id==$record[$i]->category_id){echo $category_record[$j]->name;}}?></td>
					<td>
						<?php if($record[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
						<?php if($record[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
						<a href="vote_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
						<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer;">删除</a>
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
	</table>
	<div class="div_box">
		<table width="795" border="0">
			<tr colspan="5" class=tr3>
				<td><?php paginate();?></td>
			</tr>
		</table>
	</div>
	<input type="hidden" id="db_talbe" value="smg_vote">
</body>
</html>
