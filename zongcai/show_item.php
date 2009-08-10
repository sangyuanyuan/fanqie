<?php 
	require_once('../frame.php');
	$id = $_REQUEST['id'];
	$zongcai_item = new table_class('smg_zongcai_item');
	$record = $zongcai_item->find('all',array('conditions' => 'id='.$id));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-总裁投票</title>
	<?php 
		css_include_tag('zongcai');
		js_include_once_tag('total');
	?>
</head>
<script>
	total("总裁投票","news");	
</script>
<body>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/zongcai/index.php" style="color:#FFFFFF;text-decoration:none">总裁奖</a>  > 填写参评推荐表</div>
		<div id=subject_contenta style="padding-bottom:30px; padding-top:20px;">
			<table width="700px;" border="2" align="left" bordercolor="#000000">
				<tr height="25px;">
					<td width="100px">节目类型</td>
					<td width="600px" colspan="3" align="left">
						<?php
							switch($record[0]->program_type){
								 case "tv_recommend":
							        $name = '电视推荐节目投票';
							        break;
							    case "tv_self":
							         $name = '电视自荐节目投票';
							        break;
							    case "broadcast_recommend":
							         $name = '广播推荐节目投票';
							        break;
								case "broadcast_self":
							         $name = '广播自荐节目投票';
							        break;
							}
							echo $name;
						?>
					</td>
				</tr>
				<tr height="25px;">
					<td width="100px">节目名称</td>
					<td width="250px"><?php echo $record[0]->name;?></td>
					<td width="100px">节目音/视频链接</td>
					<td width="250px"><?php echo $record[0]->url?></td>
				</tr>
				<tr height="25px;">
					<td >主创人员</td>
					<td><?php echo $record[0]->author;?></td>
					<td>联系方式（手机）</td>
					<td><?php echo $record[0]->mobile;?></td>
				</tr>
				<tr height="25px;">
					<td >播出栏目</td>
					<td><?php echo $record[0]->broadcast_name;?></td>
					<td>节目长度</td>
					<td><?php echo $record[0]->program_length;?></td>
				</tr>							
				<tr height="25px;">
					<td >播出单位</td>
					<td><?php echo $record[0]->broadcast_unit;?></td>
					<td>播出日期及时间</td>
					<td><?php echo $record[0]->broadcast_date;?></td>
				</tr>							
				<tr height="100px;">
					<td >推荐理由</td>
					<td colspan="3"><?php echo $record[0]->reason;?></td>
				</tr>							
				<tr height="100px;">
					<td >采编/创作过程</td>
					<td colspan="3"><?php echo $record[0]->progress;?></td>
				</tr>							
				<tr height="100px;">
					<td >节目影响</td>
					<td colspan="3"><?php echo $record[0]->effect;?></td>
				</tr>							
				<tr>
					<td >推荐单位/自荐人姓名</td>
					<td colspan="3"><?php echo $record[0]->uploader;?></td>
				</tr>							
				<tr height="25px;">
					<td>主创人员工作照片</td>
					<td colspan="3" align="left"><img src="<?php echo $record[0]->photo_url?>" width="660" height="360"  border=0></td>
				</tr>							
			</table>
		
		</div>
	</div>
</body>
</html>