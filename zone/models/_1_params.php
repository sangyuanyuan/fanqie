	<?php 
		require_once '../../frame.php';
		$db = get_db();
		$cats = $db->query("select upid,catid,name from blog_categories where type='blog' order by catid asc ");
	?>
	<span id="span_fid">博文分类：</span>
	<select id="catid">
		<option value="-1">所有分类</option>
		<?php foreach($cats as $cat) {?>
		<option value=<?php echo $cat->catid?>><?php echo $cat->upid == 0 ? $cat->name : "--" .$cat->name;?></option>
		<?php }?>
	</select>
	<select id="order">
		<option value="dateline desc">最新发布</option>
		<option value="viewnum desc">查看最多</option>
		<option value="replynum desc">回复最多</option>
	</select>