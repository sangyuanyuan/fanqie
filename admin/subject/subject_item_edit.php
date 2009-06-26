	<p>
	  <label for="name">名称:</label><input type="text" name="name" value="<?php echo $_REQUEST['name'][0];?>">	
	</p>
	<p>
		<label>类型:</label>
		<select name="category_type" id="category_type">
			<option name="newslist" value="newslist" <?php if ($_REQUEST['category_type'] == 'newslist') echo "selected='selected'";?>>新闻列表</option>
			<option name="newslist" value="news" <?php if ($_REQUEST['category_type'] == 'news') echo "selected='selected'";?>>新闻内容</option>
			<option name="newslist" value="photolist" <?php if ($_REQUEST['category_type'] == 'photolist') echo "selected='selected'";?>>图片列表</option>	
		</select>	
	</p>
	<p>
		<label for="name">名称:</label><input type="text" name="name">	
	</p>
	
	<p>
		<label for="description">描述:</label><textarea name="description"></textarea>
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
			$('#' + id ).find("input")
			alert($('#category_type').attr('value'));
		});
	});
	
</script>