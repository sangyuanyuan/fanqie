<?php
	require_once('../../frame.php');
	$key = urldecode($_REQUEST['key']);
	if($_REQUEST['show_div'] != '0'){
		echo "<div id='result_box'>";
	}
	$filter_dept = $_REQUEST['filter_dept'] ? $_REQUEST['filter_dept'] : -1;
	if($filter_dept != -1){
		$conditions[] = 'dept_id =' .$filter_dept;		
	}
	$filter_adopt = isset($_REQUEST['filter_adopt']) ? $_REQUEST['filter_adopt'] : -1;
	if($filter_adopt != -1){
		$conditions[] = 'is_adopt= ' .$filter_adopt;
	}
	$filter_category = $_REQUEST['filter_category'] ? $_REQUEST['filter_category'] : -1;
	if($filter_category != -1){
		$conditions[] = 'category_id =' .$filter_category;		
	}
	if($_REQUEST['filter_checked']){
		$conditions[] = 'id in(' .$_REQUEST['filter_checked'] .')';
	}
	if($conditions){
		$conditions = implode(' and ', $conditions);	
	}
	$category = new smg_category_class('news');
	$category->echo_jsdata();
	
?>
<?
		css_include_tag('admin');

?>

	<table width="600" border="0" id="list" style="boder:1px solid">
		<tr class="tr2">
			<td colspan="4" align=center>　
			搜索 <input id="search_text" type="text" value="<? echo $key;?>">
			<select style="width:90px;" name="filter_dept" id="filter_dept">
				<option value="-1">发表部门</option>
				<?php 
				$dept = new table_class('smg_dept');
				$items = $dept->find('all');
				foreach ($items as $v) {
					if($v->id == $filter_dept){
						echo "<option value='{$v->id}' selected='selected'>{$v->name}</option>";
					}else{
						echo "<option value='{$v->id}'>{$v->name}</option>";
					}
					
				}
				?>
			</select>	
			<span id="span_category_select"></span>
			<select id="filter_adopt">
				<option value="-1">发布状态</option>
				<option value="0" <?php if($filter_adopt == 0) echo ' selected="selected"' ?>>未发布</option>
				<option value="1" <?php if($filter_adopt == 1) echo ' selected="selected"' ?>>已发布</option>
			</select>
			<select id="filter_checked" style="width:60px;">
				<option value="-1">请选择</option>
				<option value="1"<?php if($_REQUEST['filter_checked']) echo ' selected="selected"';?>>已选择子头条</option>
			</select>
			<input type="checkbox" name="full_text" id="full_text" value=1 <?php if($_REQUEST['full_text']) echo 'checked="checked"'; ?>><span style="font-size:11px;">全文检索</span>
			<input type="button" value="搜索" id="subject_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="50">选择</td><td width="350">短标题</td><td width="100">发表部门</td><td width="100">所属类别</td>
		</tr>
		<?php
			$subject = new table_class("smg_news");

			$items = search_content($key,'smg_news',$conditions,10,'priority asc,id desc',$_REQUEST['full_text']);
			$count_record = count($items);			
			//--------------------		
			for($i=0;$i<$count_record;$i++)	{
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><input type="checkbox" id="<?php echo $items[$i]->id;?>" value="<?php echo $items[$i]->id;?>" name="subject" style="width:12px;"></td>
					<?php
						$cate_name = category_name_by_id($items[$i]->category_id);
						$platform = $items[$i]->platform ? $items[$i]->platform : 'news';
						if($cate_name == '大头条' || $cate_name == '小头条'){
							$url = "/$platform/news/news_head.php?id={$items[$i]->id}";
						}else if($platform == 'show'){
							$url = "/$platform/article.php?id={$items[$i]->id}";
						}else{
							$url="/$platform/news/news.php?id={$items[$i]->id}";
						}
					?>
					<td><a href="<?php echo $url; ?>" target="_blank" style="color:#000"><?php echo $items[$i]->short_title;?></a></td>
					<td><?php $cate = get_dept_info($items[$i]->dept_id);echo $cate->name;?></td>					
					<td><?php echo $category->find($items[$i]->category_id)->name; ?></td>
				</tr>
		<?php
			}
			//--------------------
			
		?>
		<tr class=tr3>
				<td colspan="4"><?php paginate('','result_box');?></td>
		</tr>
		<tr class=tr3>
				<td colspan="4"><button id="button_ok" style="width:150px">确定</button><button id="save" style="width:150px">取消所有关联</button><button id="cancel" style="width:150px">关闭</button>
					<input type="hidden" id="chosen_subject_id" value="">
					<input type="hidden" id="chosen_subject_name" value="">
					<input type="hidden" id="chosen_subject_category_id" value="">
				</td>
		</tr>
	</table>


<script>
		$('#list input:checkbox').click(function(){
			if($(this).attr('checked')){
				add_sub_headlines($(this).attr('id'));
			}else{
				remove_sub_headlines($(this).attr('id'));
			}
		});
		
		$('#save').click(function(){
			sub_headlines.length = 0;
			$('#hidden_sub_headlines').attr('value','');
			$('#list input:checkbox').each(function(){
				$(this).attr('checked',false);
			});
		});
		$('#cancel,#button_ok').click(function(){
			tb_remove();
		});	
		$('#subject_search').click(function(){
			send_search();
		});
		$('#list input:checkbox').each(function(){
			if(jQuery.inArray($(this).attr('id'),sub_headlines) != -1){
				$(this).attr('checked',true);
			}
		});
		$('#filter_dept,#filter_adopt,#filter_checked').change(function(){
			send_search();
		});
		$('#search_text').keydown(function(e){
			if(e.keyCode == 13){
				send_search();
			}
		});
		function send_search(){
			var filter_dept = $('#filter_dept').attr('value');
			var filter_category = $('.news_category:last').attr('value');
			var filter_adopt = $('#filter_adopt').attr('value');
			url = 'sub_headline.php?filter_dept=' + filter_dept;
			url += '&filter_category=' + filter_category;
			url += '&filter_adopt=' + filter_adopt;
			url += '&key=' + encodeURI($('#search_text').val());
			if($('#filter_checked').val()==1){
				if(sub_headlines.length > 0 ){
					url += '&filter_checked=' + sub_headlines.join(',');
				}else{
					url += '&filter_checked=0,0';
				}				
			}
			if($('#full_text').attr('checked')){
				url = url + "&full_text=1";
			}
			$('#result_box').load(url,{'show_div':'0'});			
		}
		category.display_select('news_category',$('#span_category_select'),<?php echo $filter_category;?>,'',function(){send_search();});
		
		
</script>
<?php 
	if($_REQUEST['show_div'] != '0'){
		echo "</div>";
	}
?>