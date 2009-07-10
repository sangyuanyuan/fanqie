<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
	if($_REQUEST['show_div'] != '0'){
		echo "<div id='result_box'>";
	}
?>


	<table width="600" border="0" id="list" style="boder:1px solid">
		<tr class="tr1">
			<td colspan="4">　
			<span style="margin-left:100px; font-size:13px">搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索" id="subject_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td>专题名称</td><td width="80">新闻类别</td><td width="80">发布时间</td>
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
					<td align="left"><input type="radio" value="<?php echo $subjects[$i]->id;?>" name="subject" style="width:10px;"><span><?php echo $subjects[$i]->name;?></span></td>
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
	</table>
	<div class="div_box" style="width:600px;">
		<table width="600" border="0">
			<tr colspan="5" class=tr3>
				<td><?php paginate('','result_box');?></td>
			</tr>
			<tr colspan="5" class=tr3>
				<td><button id="save">确定</button> <button id="cancel">取消</button></td>
			</tr>
		</table>
	</div>
	<input type="hidden" id="chosen_subject_id" value="">
	<input type="hidden" id="chosen_subject_name" value="">
	<input type="hidden" id="chosen_subject_category_id" value="">

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
				str += '<input type="hidden" name="subject_id" value="' + subject_id +'">' ;
				str += '<input type="hidden" name="subject_category_id" value="'+subject_category_id +'">';
				$('#subject_id').attr('value',$('#chosen_subject_id').attr('value'));
				//alert($('#chosen_subject_id').attr('value'));
				$('#td_subject').html(str);
				tb_remove();
				$('#delete_subject').click(function(e){
					e.preventDefault();
					str = '<a style="color:blue;" href="assign_subject.php?width600&height=400" class="thickbox" id="a_assign_subject">关联专题</a>';
					str += '<input type="hidden" name="subject_id" value="">';
					str += '<input type="hidden" name="subject_category_id" value="">';
					$('#td_subject').html(str);
					tb_init('#a_assign_subject');
				});
			}
		});
		$('#cancel').click(function(){
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
			$('#result_box').load('assign_subject.php',{'show_div':'0','key':$('#search_text').attr('value')});
		});
</script>
<?php 
	if($_REQUEST['show_div'] != '0'){
		echo "</div>";
	}
?>