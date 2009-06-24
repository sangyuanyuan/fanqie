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
	js_include_tag('admin_pub','vote');
	validate_form("vote_form");
?>
</head>

<body>
 <table width="795" border="0" id="list">
     <form id="vote_form" method="post" action="vote.post.php">
		<tr class=tr1>
			<td colspan="2">　添加投票</td>
		</tr>
		<tr class=tr3>
			<td width=150>标题：</td>
			<td width=645 align="left"><input type="text" name="vote[name]" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" name="vote[description]"></td>
		</tr>
		<tr class=tr3>
			<td>添加图片：</td>
			<td align="left"><input type="hidden" name="MAX_FILE_SIZE1" value="2097152"><input name="image" id="image" type="file"></td>
		</tr>
		<tr class=tr3>
			<td>投票类型：</td>
			<td align="left" class="newsselect">
				<select id=select_vote_type name="vote[vote_type]">
					<option value="word_vote">文字投票</option>
					<option value="image_vote">图片投票</option>
					<option value="more_word_vote">复合文字投票</option>
					<option value="more_image_vote">复合图片投票</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td>控制方式：</td>
			<td align="left" class="newsselect">
				<select id=select_limit_type name="vote[limit_type]">
					<option value="user_id">工号登录</option>
					<option value="ip">IP控制</option>
					<option value="no_limit">不设限制</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td>票数限制：</td>
			<td align="left"><input type="text" name="vote[max_vote_count]" class="number">如果不填则无限制</td>
		</tr>
		<tr class=tr3>
			<td>开始日期：</td>
			<td align="left"><input type="text" class="date"></td>
		</tr>
		<tr class=tr3>
			<td>截止日期：</td>
			<td align="left"><input type="text"  class="date"></td>
		</tr>
		<tr class=tr3>
			<td>投票项目：</td>
			<td align="left" id="single">
				<div id="single">
				标题<input type="text" name="vote_item1[title]" style="width:100px;">
				短标题<input type="text" name="vote_item1[short_title]" style="width:100px;">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
				<input name="item_image1" type="file" style="display:none;">
				<a  class="add_item" value="1" style="cursor:pointer;">继续添加</a>
				</div>
			</td>	
			<td align="left" >
				<div style="display:none;" id="many">
					<a href="vote_add.ajax.php?height=600&width=600&modal=true" class="thickbox">添加子投票</a>
				</div>
			</td>
		</tr>  
 </table>
 <table width="795" border="0" id="list">
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="post_type" id="post_type" value="single_vote">
	</form>
	  
 </table>
</body>
</html>