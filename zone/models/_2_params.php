	<?php 
		require_once '../../frame.php';
		$db = get_db();
		$cats = $db->query("select upid,catid,name from blog_categories where type='image' order by catid asc ");
		foreach ($cats as $cat){
			$category[$cat->upid][$cat->catid] = $cat->name;
		}
	?>
	<div class="model_param">
		<span id="span_fid">图片分类：</span>
		<select id="catid">
			<option value="-1">所有分类</option>
			<?php foreach($cats as $cat) {?>
			<option  value=<?php echo $cat->catid?>><?php echo $cat->upid == 0 ? $cat->name : "--" .$cat->name;?></option>
			<?php }?>
		</select>
	</div>
