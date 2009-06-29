<?php
	require_once('../../frame.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
<?php 
	css_include_tag('admin','thickbox','jquery_ui');
	use_jquery_ui();
	js_include_once_tag('thickbox');
	js_include_tag('admin_pub','vote','ajaxfileupload');
?>
</head>

<body>
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
			<td align="left"><input type="hidden" id="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file"></td>
		</tr>
		<tr class=tr3>
			<td>投票类型：</td>
			<td align="left" class="newsselect">
				<select  id="vote_type">
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
				<input name="item_image1" type="file" style="display:none;">
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
 	function add_item(){
		ajax_num++;
		$("#ajax_table").append("<tr class=tr3 ><td>投票项目：</td><td align='left'>标题<input type='text' id='title"+ajax_num+"' style='width:100px;'>&nbsp;短标题<input type='text' id='short_title"+ajax_num+"' style='width:100px;'><input type='hidden' name='MAX_FILE_SIZE' value='2097152'><input name='item_image"+ajax_num+"' type='file' style='display:none;'></td></tr>");
	}
	
	function submit() {
		
		var i=1;
		var vote_id = 0;
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
				'type':'ajax_vote'
			},
			function(data){
				vote_id = data;
				//alert($("#title"+i).attr('value'));
				for(i=1;i<=ajax_num;i++){
					$.post("/admin/vote/ajax.post.php",
						{
							'vote_item[title]':$("#title"+i).attr('value'),
							'vote_item[short_title]':$("#short_title"+i).attr('value'),
							'vote_id':vote_id,
							'type':'ajax_item'
						},
						function(data){
							//alert(data);
						}
					);
				}
			}
		);
		
		$.ajaxFileUpload 
		( 
			{ 
				url:'ajax.post.php', 
				secureuri:false, 
				fileElementId:'image', 
				dataType: 'text', 
				success: function (data) 
				{ 
					alert(data); 
				} 
			} 
		) 
		return false; 
			
		}


	

	
	
 </script>