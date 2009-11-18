<?php
	require_once('../../frame.php');
	$id=$_REQUEST['id'];
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
			<td width=50>选择</td><td width=350>题目名称</td><td width="100">发布时间</td>
		</tr>
		<?php
			$subject = new table_class("smg_xlcs");

			if($key!=''){
				$subjects = $subject->paginate("all",array('conditions' => 'title  like "%'.trim($key).'%"','order' => 'created_at desc'),18);
			}else{
				$subjects = $subject->paginate("all",array('order' => 'created_at desc'),18);
			}
			$count_record = count($subjects);			
			//--------------------		
			for($i=0;$i<$count_record;$i++)	{
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><input type="radio" value="<?php echo $subjects[$i]->id;?>" name="subject" style="width:10px;"></td>
					<td><?php echo $subjects[$i]->title;?></td>
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
				</td>
		</tr>
	</table>


<script>
		$('#save').click(function(){
			subject_id = $('#chosen_subject_id').attr('value');
			if(subject_id ==''){
				alert('请选择题目!');
				return false;				
			}
			else
			{
				str = $('#chosen_subject_name').attr('value') + '<a href="#" id="delete_subject" style="color:blue">删除</a>';
				$('#item2child_id').attr('value',subject_id);
				//alert($('#chosen_subject_id').attr('value'));
				$('#td_xlcs<?php echo $id;?>').html(str);
				tb_remove();
				$('#delete_subject').click(function(e){
					e.preventDefault();
					str = '<input type="hidden" id="item<?php echo $id;?>[child_id]" name="item<?php echo $id;?>[child_id]"><a href="xlcs_child.php?width=500&height=400&id=<?php echo $id;?>" class="thickbox" id="child<?php echo $id;?>">关联下一题</a>';
					$('#td_xlcs<?php echo $id;?>').html(str);			
					tb_init('#child<?php echo $id;?>');	
				});
			}
		});
		$('#cancel').click(function(){
			tb_remove();
		});	
		$('input:radio').click(function(){
			$('#chosen_subject_id').attr('value',$(this).attr('value'));
			$('#chosen_subject_name').attr('value',$(this).parent().next('td').html());					
		});
		$('#search_text').keydown(function(e){
			if(e.keyCode == 13){
				send_search();
			}
		});
		function send_search(){
			$('#result_box').load('xlcs_child.php',{'show_div':'0','key':encodeURI($('#search_text').attr('value'))});
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