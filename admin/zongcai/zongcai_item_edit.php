<?php 
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$zongcai_item = new table_class('smg_zongcai_item');
	$record = $zongcai_item->find('all',array('conditions' => 'id='.$id));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -总裁奖报名</title>
	<?php 
		css_include_tag('zongcai');
		validate_form("sing_up");
	?>
</head>
<body>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/zongcai/index.php" style="color:#FFFFFF;text-decoration:none">总裁奖</a>  > 填写参评推荐表</div>
		<div id=subject_contenta style="height:750px; padding-top:20px;">
			<form  id="sing_up" enctype="multipart/form-data" action="/zongcai/zongcai.post.php" method="post"> 
			<table width="700px;" border="2" align="center" bordercolor="#000000">
				<tr height="25px;">
					<td width="100px">*节目类型</td>
					<td width="600px" colspan="3" align="left">
						<select  name=post[program_type] class="required" style="height:22px;width:253px;background:#ffffcc;">
							<option></option>
							<option value="tv_recommend" <?php if($record[0]->program_type=="tv_recommend"){?>selected="selected"<?php }?>>电视推荐节目投票</option>
							<option value="tv_self" <?php if($record[0]->program_type=="tv_self"){?>selected="selected"<?php }?>>电视自荐节目投票</option>
							<option value="broadcast_recommend" <?php if($record[0]->program_type=="broadcast_recommend"){?>selected="selected"<?php }?>>广播推荐节目投票</option>
							<option value="broadcast_self" <?php if($record[0]->program_type=="broadcast_self"){?>selected="selected"<?php }?>>广播自荐节目投票</option>
						</select>				
					</td>
				</tr>
				<tr height="25px;">
					<td width="100px">*节目名称</td>
					<td width="250px"><input type="text" class="required" name=post[name] value="<?php echo $record[0]->name;?>"></td>
					<td width="100px">节目音/视频链接</td>
					<td width="250px"><input type="text" name=post[url] value="<?php echo $record[0]->url?>"></td>
				</tr>
				<tr height="25px;">
					<td >*主创人员</td>
					<td><input type="text" class="required" name=post[author] value="<?php echo $record[0]->author;?>"></td>
					<td>*联系方式（手机）</td>
					<td><input type="text" class="required" name=post[mobile] value="<?php echo $record[0]->mobile;?>"></td>
				</tr>
				<tr height="25px;">
					<td >*播出栏目</td>
					<td><input type="text" class="required" name=post[broadcast_name] value="<?php echo $record[0]->broadcast_name;?>"></td>
					<td>*节目长度</td>
					<td><input type="text" class="required" name=post[program_length] value="<?php echo $record[0]->program_length;?>"></td>
				</tr>							
				<tr height="25px;">
					<td >*播出单位</td>
					<td><input type="text" class="required" name=post[broadcast_unit] value="<?php echo $record[0]->broadcast_unit;?>"></td>
					<td>*播出日期及时间</td>
					<td><input type="text" class="required" name=post[broadcast_date] value="<?php echo $record[0]->broadcast_date;?>"></td>
				</tr>							
				<tr height="100px;">
					<td >*推荐理由</td>
					<td colspan="3"><textarea class="required" name=post[reason] ><?php echo $record[0]->reason;?></textarea></td>
				</tr>							
				<tr height="100px;">
					<td >*采编/创作过程</td>
					<td colspan="3"><textarea class="required" name=post[progress] ><?php echo $record[0]->progress;?></textarea></td>
				</tr>							
				<tr height="100px;">
					<td >*节目影响</td>
					<td colspan="3"><textarea class="required" name=post[effect]><?php echo $record[0]->effect;?></textarea></td>
				</tr>							
				<tr>
					<td >*推荐单位/自荐人姓名</td>
					<td colspan="3"><input type="text" class="required" name=post[uploader] value="<?php echo $record[0]->uploader;?>"/></td>
				</tr>							
				<tr height="25px;">
					<td>*主创人员工作照片</td>
					<td colspan="3" align="left"><?php if($record[0]->photo_url!=''){?><img src="<?php echo $record[0]->photo_url?>" width=50 height=50 border=0><?php } ?><input  type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="upfile" id="upfile"  type="file" style="width:325px;">可上传节目主创人员工作照片</td>
				</tr>							
				<tr height="35px;">
					<td colspan="4" align="center"><button type="submit" value='submit'>提交</button></td>
				</tr>							
			</table>
			<div style="margin-left: 30px; margin-top: 5px;font-size:14px;">
			注：1:所有带*号的项目为必填项。<br>
			　　2:若有节目音/视频链接，请在节目名称后注明“（有视频）”。<br>
			　　3:节目视频链接为可选项,请完整填写视频的播放地址。视频可以由部门管理员上传或者通过博客上传。<br>
			　　4:节目视频链接请填写完整路径，即以http://开头<br>
			　　5:上传图片建议为580*360
			</div>
			<input type="hidden" name=type value="admin_edit">
			<input type="hidden" name=id value="<?php echo $id;?>">
			<input type="hidden" name=post[create_time] value="<?php echo $record[0]->create_time;?>">
			</form>
		
		</div>
	</div>
</body>
</html>