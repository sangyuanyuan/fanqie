<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
	if($_REQUEST['show_div'] != '0'){
		echo "<div id='result_box'>";
	}
	$filter_dept = $_POST['filter_dept'] ? $_POST['filter_dept'] : -1;
	if($filter_dept != -1){
		$conditions[] = 'dept_id =' .$filter_dept;		
	}
	$filter_category = $_POST['filter_category'] ? $_POST['filter_category'] : -1;
	if($filter_category != -1){
		$conditions[] = 'category_id =' .$filter_category;		
	}
	if($conditions){
		$conditions = implode(' and ', $conditions);	
	}
	$category = new smg_category_class('news');
	$category->echo_jsdata();
	
?>


	<table width="600" border="0" id="list" style="boder:1px solid">
		<tr class="tr1">
			<td colspan="4">　
			<span style="margin-left:100px; font-size:13px">搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key;?>"></span>
			分类<span id="span_category_select"></span>
			部门<select style="width:100px;" name="filter_dept" id="filter_dept">
				<option value="-1">请选择</option>
			<?php 
				$dept = new table_class('smg_dept');
				$items = $dept->find('all');
				foreach ($items as $v) {
					if($v->id == intval($_POST['filter_dept'])){
						echo "<option value='{$v->id}' selected='selected'>{$v->name}</option>";
					}else{
						echo "<option value='{$v->id}'>{$v->name}</option>";
					}
					
				}
			?>
			</select>			
			<input type="button" value="搜索" id="subject_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td>短标题</td><td width="80">新闻类别</td><td width="80">部门</td>
		</tr>
		<?php
			$subject = new table_class("smg_news");

			$items = search_content($_POST[$key],'smg_news',$conditions,10);
			$count_record = count($items);			
			//--------------------		
			for($i=0;$i<$count_record;$i++)	{
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td align="left" >
						<input type="checkbox" id="<?php echo $items[$i]->id;?>" value="<?php echo $items[$i]->id;?>" name="subject" style="width:10px;">
						<span><?php echo strip_tags($items[$i]->short_title);?></span>
					</td>
					<td>
						<?php echo $items[$i]->category_id;?>
					</td>
					<td><?php $cate = get_dept_info($items[$i]->dept_id);echo $cate->name;?></td>					
				</tr>
		<?php
			}
			//--------------------
		?>
	</table>
	<div class="div_box" style="width:600px;">
		<table width="600" border="0">
			<tr colspan="5" class=tr3>
				<td><?php paginate('','result_box');?></td>
			</tr>
			<tr colspan="5" class=tr3>
				<button id="button_ok">确定</button><button id="cancel">关闭</button><button id="save">取消所有关联</button> </td>
			</tr>
		</table>
	</div>
	<input type="hidden" id="chosen_subject_id" value="">
	<input type="hidden" id="chosen_subject_name" value="">
	<input type="hidden" id="chosen_subject_category_id" value="">

<script>
		$('#list input:checkbox').click(function(){
			if($(this).attr('checked')){
				add_related_news($(this).attr('id'));
			}else{
				remove_related_news($(this).attr('id'));
			}
		});
		
		$('#save').click(function(){
			related_news.length = 0;
			$('#hidden_related_news').attr('value','');
			$('#list input:checkbox').each(function(){
				$(this).attr('checked',false);
			});
		});
		$('#cancel,#button_ok').click(function(){
			tb_remove();
		});	
		$('input:radio').click(function(){
			$('#chosen_subject_id').attr('value',$(this).attr('value'));
			$('#chosen_subject_name').attr('value',$(this).next('span').html());
			$('#chosen_subject_category_id').attr('value','');						
		});
		$('.subject_category_select').change(function(){
			$('#chosen_subject_category_id').attr('value',$(this).attr('value'));
		});
		$('#subject_search').click(function(){
			$('#result_box').load('filte_news.php',{'show_div':'0','key':$('#search_text').attr('value'),'filter_dept':$('#filter_dept').attr('value'),'filter_category':$('.news_category:last').attr('value')});
		});
		$('#list input:checkbox').each(function(){
			if(jQuery.inArray($(this).attr('id'),related_news) != -1){
				$(this).attr('checked',true);
			}
		});
		category.display_select('news_category',$('#span_category_select'),<?php echo $filter_category;?>);

</script>
<?php 
	if($_REQUEST['show_div'] != '0'){
		echo "</div>";
	}
?>