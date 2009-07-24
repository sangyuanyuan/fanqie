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

	<table width="600" border="0" id="list" style="boder:1px solid">
		<tr class="tr2">
			<td colspan="5">搜索 <input id="search_text" type="text" value="<? echo $key;?>">
			<input type="button" value="搜索" id="vote_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="50">选择</td><td width=250>投票名称</td><td width="100">投票类型</td><td width="100">到期时间</td><td width="100">所属类别</td>
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
					<td><input type="radio" value="<?php echo $record[$i]->id;?>" name="vote" style="width:10px;"></td>
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $vote_name;?></td>
					<td><?php echo substr($record[$i]->ended_at, 0, 10);?></td>
					<td><?php for($j=0;$j<$category_count;$j++){if($category_record[$j]->id==$record[$i]->category_id){echo $category_record[$j]->name;}}?></td>					
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class=tr3>
				<td colspan="5"><?php paginate('','result_box');?></td>
		</tr>
		<tr class=tr3>
				<td colspan="5"><button id="save" style="width:150px">确定</button><button id="cancel" style="width:150px">关闭</button>
						<input type="hidden" id="chosen_vote_id" value="">
						<input type="hidden" id="chosen_vote_name" value="">
				</td>
		</tr>
	</table>



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
		$('#search_text').keydown(function(e){
			if(e.keyCode == 13){
				send_search();
			}
		});
		$('input:radio').click(function(){
			$('#chosen_vote_id').attr('value',$(this).attr('value'));
			$('#chosen_vote_name').attr('value',$(this).parent().next('td').html());			
		});
		function send_search(){
			$('#result_box').load('add_vote.php',{'show_div':'0','key':encodeURI($('#search_text').attr('value'))});
		}
		$('#vote_search').click(function(){
			send_search();
		});
</script>
<?php 
	if($_REQUEST['show_div'] != '0'){
		echo "</div>";
	}
?>