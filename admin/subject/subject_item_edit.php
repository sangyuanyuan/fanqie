	<p>
	  <label for="name">名称:</label><input type="text" name="name" id="name" value="<?php echo $_REQUEST['name'][0];?>">	
	</p>
	<p>
		<label>类型:</label>
		<select name="category_type" id="category_type">
			<option name="newslist" value="newslist" <?php if ($_REQUEST['category_type'][0] == 'newslist') echo "selected='selected'";?>>新闻列表</option>
			<option name="newslist" value="news" <?php if ($_REQUEST['category_type'][0] == 'news') echo "selected='selected'";?>>新闻内容</option>
			<option name="newslist" value="photolist" <?php if ($_REQUEST['category_type'][0] == 'photolist') echo "selected='selected'";?>>图片列表</option>	
		</select>	
	</p>
	<p>
		<label for="limit">条数:</label><input type="text" name="limit" id="limit" value="<?php echo $_REQUEST['record_limit'][0];?>">	
	</p>
	
	<p>
		<label for="description">描述:</label><textarea name="description" id="description"><?php echo $_REQUEST['description'][0];?></textarea>
	</p>
	<p>
		<button id="save">确定</button>
		<button id="cancel">取消 </button>			
	</p>
<?php 
  #var_dump($_REQUEST);
?>
<script>
	$(function(){
		$('#cancel').click(function(){
			tb_remove();
			return false;
		});
		var id = <?php echo $_REQUEST['id'] ?>;
		$('#save').click(function(){
			save_item_param(id,$('#name').attr('value'),$('#category_type').attr('value'),$('#description').attr('value'),$('#limit').attr('value'));
		});
	});
	
</script>