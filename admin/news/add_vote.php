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
			<input type="button" value="搜索" id="vote_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td>投票名称</td><td width="80">投票类型</td><td width="80">到期时间</td><td width="80">所属类别</td>
		</tr>
		<?php
			$category = new table_class('smg_category');
			$category_record = $category->find('all',array('conditions' => 'category_type="vote"'));
			$category_count = count($category_record);
			$vote = new table_class("smg_vote");
			if($key!=''){
				$record = $vote->paginate("all",array('conditions' => 'is_sub_vote=0 and name  like "%'.trim($key).'%"','order' => 'created_at desc'),18);
			}else{
				$record = $vote->paginate("all",array('conditions' => 'is_sub_vote=0','order' => 'created_at desc'),18);
			}
			$count_record = count($record);
			//--------------------
			for($i=0;$i<$count_record;$i++){
				switch($record[$i]->vote_type) {
						case "word_vote":
							$vote_name = "文字投票";
							break;
						case "image_vote":
							$vote_name = "图片投票";
							break;
						case "more_vote":
							$vote_name = "复合投票";
							break;
						default:
							$vote_name = "未知类型";
				}
								
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td align="left"><input type="radio" value="<?php echo $record[$i]->id;?>" name="vote" style="width:10px;"><span><?php echo $record[$i]->name;?></span></td>
					<td><?php echo $vote_name;?></td>
					<td><?php echo substr($record[$i]->ended_at, 0, 10);?></td>
					<td><?php for($j=0;$j<$category_count;$j++){if($category_record[$j]->id==$record[$i]->category_id){echo $category_record[$j]->name;}}?></td>					
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
	<input type="hidden" id="chosen_vote_id" value="">
	<input type="hidden" id="chosen_vote_name" value="">

<script>
		$('#save').click(function(){
			vote_id = $('#chosen_vote_id').attr('value');
			if(vote_id ==''){
				alert('请选择投票!');
				return false;				
			}else{
				str = $('#chosen_vote_name').attr('value') + '<a href="#" id="delete_vote" style="color:blue">删除</a>';
				str += '<input type="hidden" name="news[vote_id]" value="' + vote_id +'">' 
				$('#vote_id').attr('value',$('#chosen_vote_id').attr('value'));
				//alert($('#chosen_vote_id').attr('value'));
				$('#td_vote').html(str);
				tb_remove();
				$('#delete_vote').click(function(e){
					e.preventDefault();
					str = '<a href="add_vote.php?width=600&height=400" class="thickbox" id="a_vote_id" style="color:blue;">关联投票</a><input type="hidden" name="news[vote_id]" value="0">';
					$('#td_vote').html(str);
					tb_init('#a_vote_id');
				});
			}
		});
		$('#cancel').click(function(){
			tb_remove();
		});	
		$('input:radio').click(function(){
			$('#chosen_vote_id').attr('value',$(this).attr('value'));
			$('#chosen_vote_name').attr('value',$(this).next('span').html());			
		});
		$('#vote_search').click(function(){
			$('#result_box').load('add_vote.php',{'show_div':'0','key':$('#search_text').attr('value')});
		});
</script>
<?php 
	if($_REQUEST['show_div'] != '0'){
		echo "</div>";
	}
?>