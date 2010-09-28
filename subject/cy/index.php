<?php
	require_once('../../frame.php');
    $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -创意提案</title>
	<?php css_include_tag('subject_cy');
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("专题-创意","subject");
	</script>
</head>
<body>			
	<div id=ibody>
		<div id=iright>
			<form action="cy.post.php" method="post" id="cy_add" name="cy_add">
				<div id=top>
					<table align="center" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20%" align="center">创意名称</td>
								<td><input type="text" style="width:339px;" id="cytitle" name="cy[title]"></td>
							</tr>
							<tr>
								<td align="center" valign="top">创意简介</td>
								<td><textarea rows="7" style="width:339px;" id="cycontent" name="cy[content]"></textarea></td>
							</tr>
							<tr>
								<td align="center" valign="top">提案理由</td>
								<td><input type="text" id="reason" style="width:339px;" name="cy[reason]"></textarea></td>
							</tr>
							<tr>
								<td align="center" valign="top">创意关键词</td>
								<td><input type="text" id="keywords" style="width:339px;" name="cy[keywords]"></textarea></td>
							</tr>
							<tr>
								<td align="center">提案人</td>
								<td>
									<table align="center" border="0" cellspacing="0" cellpadding="0"
										<tr>
											<td><input type="text" style="width:60px;" id="username" name="cy[username]"></td>
											<td align="center">年龄</td>
											<td><input type="text" style="width:25px;" id="age" name="cy[age]"></td>
											<td align="center">联系电话</td>
											<td><input type="text" style="width:85px; id="phone" name="cy[phone]"></td>
										</tr>	
									</table>
								</td>
							</tr>
							<tr>
								<td align="center">电子邮箱</td>
								<td>
									<table align="center" border="0" cellspacing="0" cellpadding="0"
										<tr>
											<td><input type="text" style="width:100px;" id="mail" name="cy[mail]"></td>
											<td align="center">部门</td>
											<td><input type="text" style="width:130px;"  id="age" name="cy[address]"></td>
										</tr>	
									</table>
								</td>
							</tr>
							<tr>
								<td align="center">工作岗位</td>
								<td><input type="text" id="position" style="width:339px;" name="cy[position]"></textarea></td>
							</tr>
							<tr>
								<td height="50" align="center" colspan="2"><button id="sub">提交创意</button></td>
							</tr>
					</table>
				</div>
			</form>
			<div class=more><a target="_blank" href="/news/news_subject_list.php?id=196">更多</a></div><div class=more><a target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=89">论坛</a></div>
			<?php $news = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目创意" and i.category_type="news" and i.is_adopt=1 and c.name="相关新闻" order by i.priority asc, n.created_at desc limit 14'); ?>
			<div id=about>
					<?php for($i=0;$i<count($news);$i++){ ?>
						<div class="cl" ><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>" <?php if($i<4){ ?>style="color:red; font-weight:bold;"<?php } ?>>·<?php echo $news[$i]->short_title; ?></a></div>	
					<?php } ?>
			</div>
		</div>
		
	</div>
</body>
</html>
<script>
	$(function(){
		$('#sub').click(function(){	
			if($('#cytitle').val() == ''){
				alert('请填写创意名称!');
				return false;
			}
			if($('#cycontent').val() == ''){
				alert('请填写创意简介!');
				return false;
			}
			if($('#keywords').val() == ''){
				alert('请填写创意关键词!');
				return false;
			}
			if($('#username').val() == ''){
				alert('请填写提案人!');
				return false;
			}
			if($('#age').val() == ''){
				alert('请填写年龄!');
				return false;
			}
			if($('#phone').val() == ''){
				alert('请填写联系方式!');
				return false;
			}
			if($('#mail').val() == ''){
				alert('请填写电子邮件!');
				return false;
			}
			if($('#address').val() == ''){
				alert('请填写工作单位!');
				return false;
			}
			if($('#position').val() == ''){
				alert('请填写工作岗位!');
				return false;
			}
			document.cy_add.submit();
		});
	});
</script>
