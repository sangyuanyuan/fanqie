<?php 
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-总裁奖报名</title>
	<?php 
		css_include_tag('zongcai');
		use_jquery();
		js_include_once_tag('total');
	?>
</head>
<script>
	total("总裁奖报名","news");	
</script>
<body>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/zongcai/index.php" style="color:#FFFFFF;text-decoration:none">总裁奖</a>  > 填写参评推荐表</div>
		<div id=subject_contenta style="height:750px; padding-top:20px;">
			<form  id="sing_up" enctype="multipart/form-data" action="zongcai.post.php" method="post"> 
			<table width="700px;" border="2" align="center" bordercolor="#000000">
				<tr height="25px;">
					<td width="100px">*节目类型</td>
					<td width="600px" colspan="3" align="left">
						<select  name=post[program_type] id="program_type"  style="height:22px;width:253px;background:#ffffcc;">
							<option value=''></option>
							<option value="tv_recommend">电视推荐节目投票</option>
							<option value="tv_self">电视自荐节目投票</option>
							<option value="broadcast_recommend">广播推荐节目投票</option>
							<option value="broadcast_self">广播自荐节目投票</option>
						</select>				
					</td>
				</tr>
				<tr height="25px;">
					<td width="100px">*节目名称</td>
					<td width="250px"><input type="text" id="name" name=post[name]></td>
					<td width="100px">节目音/视频链接</td>
					<td width="250px"><input type="text" name=post[url]></td>
				</tr>
				<tr height="25px;">
					<td >*主创人员</td>
					<td><input type="text" id=author name=post[author]></td>
					<td>*联系方式（手机）</td>
					<td><input type="text" id="mobile" name=post[mobile]></td>
				</tr>
				<tr height="25px;">
					<td >*播出栏目</td>
					<td><input type="text" id="broadcast_name" name=post[broadcast_name]></td>
					<td>*节目长度</td>
					<td><input type="text" id="program_length" name=post[program_length]></td>
				</tr>							
				<tr height="25px;">
					<td >*播出单位</td>
					<td><input type="text" id="broadcast_unit" name=post[broadcast_unit]></td>
					<td>*播出日期及时间</td>
					<td><input type="text" id="broadcast_date" name=post[broadcast_date]></td>
				</tr>							
				<tr height="100px;">
					<td >*推荐理由</td>
					<td colspan="3"><textarea id="reason" name=post[reason]></textarea></td>
				</tr>							
				<tr height="100px;">
					<td >*采编/创作过程</td>
					<td colspan="3"><textarea id="progress" name=post[progress]></textarea></td>
				</tr>							
				<tr height="100px;">
					<td >*节目影响</td>
					<td colspan="3"><textarea id="effect" name=post[effect]></textarea></td>
				</tr>							
				<tr>
					<td >*推荐单位/自荐人姓名</td>
					<td colspan="3"><input type="text" id="uploader" name=post[uploader] /></td>
				</tr>							
				<tr height="25px;">
					<td>*主创人员工作照片</td>
					<td colspan="3" align="left"><input name="upfile" id="upfile"  type="file" style="width:325px;">可上传节目主创人员工作照片</td>
				</tr>							
				<tr height="35px;">
					<td colspan="4" align="center"><button type="submit" id='submit' value='submit'>提交</button></td>
				</tr>							
			</table>
			<div style="margin-left: 30px; margin-top: 5px;font-size:14px;">
			注：1:所有带*号的项目为必填项。<br>
			　　2:若有节目音/视频链接，请在节目名称后注明“（有视频）”。<br>
			　　3:节目视频链接为可选项,请完整填写视频的播放地址。视频可以由部门管理员上传或者通过博客上传。<br>
			　　4:节目视频链接请填写完整路径，即以http://开头<br>
			　　5:上传图片建议为580*360
			</div>
			<input type="hidden" name=post[state] value="0">
			<input type="hidden" name=post[create_time] value="<?php echo date("Y-m-d H:i:s");?>">
			</form>
		
		</div>
	</div>
</body>
</html>

<script>
	$(function(){
		$('#submit').click(function(){
			if($('#name').val()==''){
				alert('请输入节目名称！');
				return false;
			}
			if($('#program_type').val()==''){
				alert('请选择节目类型！');
				return false;
			}
			if($('#author').val()==''){
				alert('请输入主创人员！');
				return false;
			}
			if($('#mobile').val()==''){
				alert('请输入联系方式！');
				return false;
			}
			if($('#broadcast_name').val()==''){
				alert('请输入播出栏目！');
				return false;
			}
			if($('#program_length').val()==''){
				alert('请输入节目长度！');
				return false;
			}
			if($('#broadcast_unit').val()==''){
				alert('请输入播出单位！');
				return false;
			}
			if($('#broadcast_date').val()==''){
				alert('请输入播出日期及时间！');
				return false;
			}
			if($('#reason').val()==''){
				alert('请输入推荐理由！');
				return false;
			}
			if($('#progress').val()==''){
				alert('请输入采编/创作过程！');
				return false;
			}
			if($('#effect').val()==''){
				alert('请输入节目影响！');
				return false;
			}
			if($('#uploader').val()==''){
				alert('请输入推荐单位/自荐人姓名！');
				return false;
			}
		})
	})
</script>
