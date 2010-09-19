<?php
	require_once('../../frame.php');
	$key = urldecode($_REQUEST['key']);
	if($_REQUEST['show_div'] != '0'){
		echo "<div id='result_box'>";
	}
?>
<?
		css_include_tag('admin');

?>

	<table width="600" border="0" id="list">
		<tr class="tr2">
			<td colspan="4">搜索 <input id="search_text" type="text" value="<? echo $key;?>"><input type="button" value="搜索" id="subject_search" style="border:1px solid #0000ff; height:21px"></td>
		</tr>
		<tr class="tr2">
			<td width=50>选择</td><td width=350>专题名称</td><td width="100">新闻类别</td><td width="100">发布时间</td>
		</tr>
		<?php
			$subject = new table_class("smg_subject");

			if($key!=''){
				$subjects = $subject->paginate("all",array('conditions' => 'name  like "%'.trim($key).'%"','order' => 'created_at desc'),18);
			}else{
				$subjects = $subject->paginate("all",array('order' => 'created_at desc'),18);
			}
			$count_record = count($subjects);
			$category = new table_class('smg_subject_category');			
			//--------------------		
			for($i=0;$i<$count_record;$i++)	{
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><input type="radio" value="<?php echo $subjects[$i]->id;?>" name="subject" style="width:10px;"></td>
					<td><?php echo $subjects[$i]->name;?></td>
					<td>
						<select class="subject_category_select">
							<option value="-1">请选择</option>
						<?php 
						$categorys = $category->find('all',array('conditions' => 'subject_id=' .$subjects[$i]->id ." and category_type like 'news%'"));
						foreach ($categorys as $v) {
							echo "<option value='{$v->id}'>{$v->name}</option>";
						}
						?>
					</select>
					</td>
					<td><?php echo substr($subjects[$i]->created_at, 0, 10);?></td>					
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class=tr3>
				<td colspan="4"><?php paginate('','result_box');?></td>
		</tr>	
		<tr class=tr3>
				<td colspan="4"><button id="save" style="width:150px;">确定</button><button id="cancel" style="width:150px;">关闭</button>
						<input type="hidden" id="chosen_subject_id" value="">
						<input type="hidden" id="chosen_subject_name" value="">
						<input type="hidden" id="chosen_subject_category_id" value="">
				</td>
		</tr>
	</table>


<script>
		$('#save').click(function(){
			subject_id = $('#chosen_subject_id').attr('value');
			if(subject_id ==''){
				alert('请选择专题!');
				return false;				
			}else{
				
				subject_category_id = $('#chosen_subject_category_id').attr('value');
				if (subject_category_id == '' || subject_category_id == '-1'){
					alert('请选择分类');
					return false;
				}
				str = $('#chosen_subject_name').attr('value') + '<a href="#" id="delete_subject" style="color:blue">删除</a>';
				$('#hidden_subject_id').val(subject_id);
				$('#hidden_subject_category_id').val(subject_category_id);
				$('#hidden_delete_subject').val('1');
				//alert($('#chosen_subject_id').attr('value'));
				$('#td_subject').html(str);
				tb_remove();
				$('#delete_subject').click(function(e){
					e.preventDefault();
					str = '<a style="color:blue;" href="assign_subject.php?width600&height=400" class="thickbox" id="a_assign_subject">关联专题</a>';
					$('#td_subject').html(str);
					$('#hidden_delete_subject').val('2');				
					tb_init('#a_assign_subject');
				});
			}
		});
		$('#cancel').click(function(){
			tb_remove();
		});	
		$('input:radio').click(function(){
			$('#chosen_subject_id').attr('value',$(this).attr('value'));
			$('#chosen_subject_name').attr('value',$(this).parent().next('td').html());
			$('#chosen_subject_category_id').attr('value','');						
		});
		$('.subject_category_select').change(function(){
			$('#chosen_subject_category_id').attr('value',$(this).attr('value'));
		});
		$('#search_text').keydown(function(e){
			if(e.keyCode == 13){
				send_search();
			}
		});
		function send_search(){
			$('#result_box').load('assign_subject.php',{'show_div':'0','key':encodeURI($('#search_text').attr('value'))});
		}
		$('#subject_search').click(function(){
			send_search();
		});
</script>
<?php 
	if($_REQUEST['show_div'] != '0'){
		echo "</div>";
	}
?>
