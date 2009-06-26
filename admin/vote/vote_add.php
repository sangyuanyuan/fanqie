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
	validate_form("vote_form");
?>
</head>

<body>
<form id="vote_form" method="post" enctype="multipart/form-data" action="vote.post.php">
 <table width="795" border="0" id="list">
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
			<td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file"></td>
		</tr>
		<tr class=tr3>
			<td>投票类型：</td>
			<td align="left" class="newsselect">
				<select id=select_vote_type name="vote[vote_type]">
					<option value="word_vote">文字投票</option>
					<option value="image_vote">图片投票</option>
					<option value="more_vote">复合投票</option>
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
			<td align="left"><input type="text" name="vote[max_vote_count]" class="number" id="max_vote_count">如果不填则无限制</td>
		</tr>
		<tr class=tr3>
			<td>开始日期：</td>
			<td align="left"><input type="text" class="date_jquery required" name="vote[started_at]" id="start"></td>
		</tr>
		<tr class=tr3>
			<td>截止日期：</td>
			<td align="left"><input type="text"  class="date_jquery required" name="vote[ended_at]" id="end"></td>
		</tr>
		<tr class=tr3 id="item">
			<td>投票项目：</td>
			<td align="left" id="single">
				<div id="single">
				标题<input type="text" name="vote_item1[title]" style="width:100px;">
				短标题<input type="text" name="vote_item1[short_title]" style="width:100px;">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
				<input name="item_image1" type="file" class="image" style="display:none;">
				<a  id="add_item" value="1" style="cursor:pointer;">继续添加</a>
				</div>
			</td>	
			<td align="left" >
				<div style="display:none;" id="many">
					<a  href="" class="thickbox" id="add_sub_vote">添加子投票</a>
					<a  id="can_not_add" style="display:none; cursor:pointer;">请先填写日期并选择好控制方式</a>
					<div id="test"></div>
				</div>
			</td>
		</tr>
 </table>
 <table width="795" border="0" id="list">
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="post_type" id="post_type" value="single_vote">
		<input type="hidden" name="vote[created_at]"  value="<?php echo date("y-m-d")?>">
		<input type="hidden" id="vote_item_count" name="vote_item_count" value="1">
 </table>
 </form>
 
</body>
</html>