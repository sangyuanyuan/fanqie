	<p>
	  <label for="name">名称:</label><input type="text" name="name" id="name" value="<?php echo $_REQUEST['name'][0];?>">	
	</p>
	<p>
		<label>类型:</label>
		<select name="category_type" id="category_type">
			<option name="newslist" value="newslist" <?php if ($_REQUEST['category_type'][0] == 'newslist') echo "selected='selected'";?>>新闻列表</option>
			<option name="newslist" value="news" <?php if ($_REQUEST['category_type'][0] == 'news') echo "selected='selected'";?>>新闻内容</option>
			<option name="newslist" value="photolist" <?php if ($_REQUEST['category_type'][0] == 'photolist') echo "selected='selected'";?>>图片列表</option>	
			<option name="newslist" value="photo" <?php if ($_REQUEST['category_type'][0] == 'photo') echo "selected='selected'";?>>图片展示</option>	
			<option name="newslist" value="videolist" <?php if ($_REQUEST['category_type'][0] == 'videolist') echo "selected='selected'";?>>视频列表</option>	
			<option name="newslist" value="video" <?php if ($_REQUEST['category_type'][0] == 'video') echo "selected='selected'";?>>视频展示</option>				
			<option name="newslist" value="commet" <?php if ($_REQUEST['category_type'][0] == 'commet') echo "selected='selected'";?>>专题评论</option>	
		</select>	
	</p>
	<p id="height_p">
		<label for="height">高度:</label><input type="text" name="height" id="height" value="<?php echo $_REQUEST['height'][0];?>">像素
	</p>	
	<p id="limit_p">
		<label for="limit">条数:</label><input type="text" name="limit" id="limit" value="<?php echo $_REQUEST['record_limit'][0];?>">	
	</p>
	<p id="eheight_p">
		<label for="eheight">元素高度:</label><input type="text" name="eheight" id="eheight" value="<?php echo $_REQUEST['eheight'][0];?>">	
	</p>
	<p id="ewidth_p">
		<label for="ewidth">元素高度:</label><input type="text" name="ewidth" id="ewidth" value="<?php echo $_REQUEST['ewidth'][0];?>">	
	</p>	
	<p id="scroll_type_p">
		<label>滚动类型:</label>
		<select name="scroll_type" id="scroll_type">
			<option name="newslist" value="0" <?php if ($_REQUEST['scroll_type'][0] == '0') echo "selected='selected'";?>>不滚动</option>
			<option name="newslist" value="1" <?php if ($_REQUEST['scroll_type'][0] == '1') echo "selected='selected'";?>>向左滚动</option>
			<option name="newslist" value="2" <?php if ($_REQUEST['scroll_type'][0] == '2') echo "selected='selected'";?>>向上滚动</option>				
			<option name="newslist" value="3" <?php if ($_REQUEST['scroll_type'][0] == '3') echo "selected='selected'";?>>向右滚动</option>
			<option name="newslist" value="4" <?php if ($_REQUEST['scroll_type'][0] == '4') echo "selected='selected'";?>>向下滚动</option>
		</select>	
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
	function refresh_p(){
		var cate = $('#category_type').attr('value');
		switch(cate){
			case 'newslist':
				$('#limit_p').show();
				$('#eheight_p').hide();
				$('#ewidth_p').hide();
				$('#scroll_type_p').show();
				break;
			case 'news':
				$('#limit_p').hide();
				$('#eheight_p label').html('新闻高度:');
				$('#eheight_p').show();
				$('#ewidth_p label').html('新闻宽度:');
				$('#ewidth_p').show();
				$('#scroll_type_p').hide();
				break;				
			case 'photolist':
				$('#limit_p').show();
				$('#eheight_p label').html('图片高度:');
				$('#eheight_p').show();
				$('#ewidth_p label').html('图片宽度:');
				$('#ewidth_p').show();
				$('#scroll_type_p').show();
				break;
			case 'photo':
				$('#limit_p').hide();
				$('#eheight_p label').html('图片高度:');
				$('#eheight_p').show();
				$('#ewidth_p label').html('图片宽度:');
				$('#ewidth_p').show();
				$('#scroll_type_p').hide();
				break;	
			case 'videolist':
				$('#limit_p').show();
				$('#eheight_p').hide();
				$('#ewidth_p').hide();
				$('#scroll_type_p').show();
				break;
			case 'video':
				$('#limit_p').hide();
				$('#eheight_p label').html('视频高度:');
				$('#eheight_p').show();
				$('#ewidth_p label').html('视频宽度:');
				$('#ewidth_p').show();
				$('#scroll_type_p').hide();
				break;								
		}
	}
	$(function(){
		$('#cancel').click(function(){
			tb_remove();
			return false;
		});
		var id = <?php echo $_REQUEST['id'] ?>;
		$('#save').click(function(){
			save_item_param(id,$('#name').attr('value'),$('#category_type').attr('value'),$('#description').attr('value'),$('#limit').attr('value'),$('#height').attr('value'),$('#eheight').attr('value'),$('#ewidth').attr('value'),$('#scroll_type').attr('value'));
		});
		$('#category_type').change(function(){
			refresh_p();
		});
		refresh_p();
	});
	
</script>