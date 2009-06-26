<?php
	require_once('../../frame.php');
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	$limit_type = $_REQUEST['limit'];
	$max_vote_count = $_REQUEST['max'];
	switch($limit_type) {
		case "user_id":
			$limit_name = "工号登录";
			break;
		case "ip":
			$limit_name = "IP控制";
			break;
		case "no_limit":
			$limit_name = "不设限制";
			break;
		default:
			$limit_name = "未知类型";
	}
?>

 <table width="795" border="0" id="ajax_table">  
		<tr class=tr1>
			<td colspan="2">　添加投票</td>
		</tr>
		<tr class=tr3>
			<td width=150>标题：</td>
			<td width=645 align="left"><input type="text" id="name" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" id="description"></td>
		</tr>
		<tr class=tr3>
			<td>添加图片：</td>
			<td align="left"><input type="hidden" id="MAX_FILE_SIZE" value="2097152"><input name="ajax_image" id="ajax_image" type="file"></td>
		</tr>
		<tr class=tr3>
			<td>投票类型：</td>
			<td align="left" class="newsselect">
				<select  id="vote_type" onChange="change()">
					<option value="word_vote">文字投票</option>
					<option value="image_vote">图片投票</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td>控制方式：</td>
			<td align="left">
				<?php echo $limit_name;?>
				<input type="hidden" id="limit_name" value="<?php echo $limit_name?>">
			</td>
		</tr>
		<tr class=tr3>
			<td>票数限制：</td>
			<td align="left"><?php echo $max_vote_count;?><input type="hidden" id="vote[max_vote_count]" value="<?php echo $max_vote_count?>"></td>
		</tr>
		<tr class=tr3>
			<td>开始日期：</td>
			<td align="left"><?php echo $start?><input type="hidden" id="start_at" value="<?php echo $start?>"></td>
		</tr>
		<tr class=tr3>
			<td>截止日期：</td>
			<td align="left"><?php echo $end?><input type="hidden" id="end_at" value="<?php echo $end?>"></td>
		</tr>
		<tr class=tr3>
			<td>投票项目：</td>
			<td align="left" id="single">
				<div id="single">
				标题<input type="text" id="title1" style="width:100px;">
				短标题<input type="text" id="short_title1" style="width:100px;">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
				<input name="ajax_image1"  class="ajax_image" id="ajax_image1" type="file" style="display:none;">
				<a  class="ajax_add_item" value="1" style="cursor:pointer;" onclick="add_item()">继续添加</a>
				</div>
			</td>	
		</tr>  
 </table>
 <table width="795" border="0" id="list">
		<tr class=tr3>
			<td colspan="2"><button  onclick="submit()">提 交</button></td>
		</tr>
		<input type="hidden" name="post_type" id="post_type" value="single_vote">
		<input type="hidden" id="created_at"  value="<?php echo date("y-m-d")?>">  
 </table>

 <script>
 	var ajax_num = 1;
	var displayed = "none";
	
 	function add_item(){
		ajax_num++;
		$("#ajax_table").append("<tr class=tr3 ><td>投票项目：</td><td align='left'>标题<input type='text' id='title"+ajax_num+"' style='width:100px;'>&nbsp;短标题<input type='text' id='short_title"+ajax_num+"' style='width:100px;'><input type='hidden' name='MAX_FILE_SIZE' value='2097152'><input name='ajax_image"+ajax_num+"' id='ajax_image"+ajax_num+"' type='file' class='ajax_image' style='display:"+displayed+";'></td></tr>");
	}
	
	function submit() {
		
		var i=1;
		var vote_id = 0;
		var photo_url = "";
		
		$.ajaxFileUpload 
		( 
			{ 
				url:'ajax.post.php', 
				secureuri:false, 
				fileElementId:'ajax_image', 
				dataType: 'text', 
				success: function (data) 
				{ 
					photo_url = data;
					$.post("/admin/vote/ajax.post.php",
						{
							'vote[name]':$("#name").attr('value'),
							'vote[description]':$("#description").attr('value'),
						    'vote[vote_type]':$("#vote_type").attr('value'),
						    'vote[limit_type]':$("#limit_name").attr('value'),
							'vote[max_vote_count]':$("#max_vote_count").attr('value'),
						    'vote[started_at]':$("#start_at").attr('value'),
							'vote[ended_at]':$("#end_at").attr('value'),
							'vote[created_at]':$("#created_at").attr('value'),
							'vote[photo_url]':photo_url,
							'type':'ajax_vote'
						},
						function(data){
							vote_id = data;
							for(j=1;j<=ajax_num;j++){
								alert("j1"+j);
								$.ajaxFileUpload 
								( 
									{ 
										url:'ajax.post.php', 
										secureuri:false, 
										fileElementId:'ajax_image'+j, 
										dataType: 'text', 
										success: function (data) 
										{ 	
											
											photo_url = data;
											$.post("/admin/vote/ajax.post.php",
												{
													'vote_item[title]':$("#title"+j).attr('value'),
													'vote_item[short_title]':$("#short_title"+j).attr('value'),
													'vote_item[vote_id]':vote_id,
													'vote_item[photo_url]':photo_url,
													'type':'ajax_item'
												},
												function(data){
													//alert(data);
													alert("j2"+j);
												}
											);
										} 
									} 
								) 	
							}
							$("#item").before('<tr class=tr3><td>投票项目：</td><td align="left" ><a href="vote_add.ajax.php?height=600&width=600&voteid='+vote_id+'" class="thickbox">查看投票</a><input type="hidden" name="sub_vote_id" value="'+vote_id+'"></td></tr>')
							tb_remove();
						}
					);
				} 
			} 
		) 
		
	}
	
	$("#vote_type").change(function(){
		if($("#vote_type").attr('value')=="word_vote"){
			$(".ajax_image").hide();
			displayed = "none";
		}else{
			$(".ajax_image").show();
			displayed = "inline";
		}
	});
 </script>