<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-电视新闻中心-党组织架构</title>
	<link href="dzzjg.css" rel="stylesheet" type="text/css" />
	<? 
		use_jquery();
		js_include_once_tag('total1');
		$db=get_db();
	?>
	<script>
		total("电视新闻中心三项教育","other");
	</script>
</head>
<body>
	<div id=ibody>
		<?php $sql="select file_name from smg_news where dept_category_id=202 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
		<div id=ileft><a href="<?php echo $news[0]->file_name; ?>">电视新闻中心党委</a></div>
		<?php $sql="select file_name from smg_news where dept_category_id=203 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
		<div id=icenter_l><a href="<?php echo $news[0]->file_name; ?>">专职组织员</a></div>
		<div class=ispace></div>
		<div id=icenter_r>
			<?php $sql="select file_name from smg_news where dept_category_id=205 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div id="context">
				<a href="<?php echo $news[0]->file_name; ?>">职能部门党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=212 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content">
				<a href="<?php echo $news[0]->file_name; ?>">采访一部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=216 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content">
				<a href="<?php echo $news[0]->file_name; ?>">采访二部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=222 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content" style="margin-top:155px;">
				<a href="<?php echo $news[0]->file_name; ?>">国内国际部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=227 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content">
				<a href="<?php echo $news[0]->file_name; ?>">上视编播部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=232 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content">
				<a href="<?php echo $news[0]->file_name; ?>">卫视编播部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=237 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content" style="margin-top:155px;">
				<a href="<?php echo $news[0]->file_name; ?>">评论部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=242 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content">
				<a href="<?php echo $news[0]->file_name; ?>">栏目部党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=247 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content" style="margin-top:155px;">
				<a href="<?php echo $news[0]->file_name; ?>">制作部第一党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=252 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content">
				<a href="<?php echo $news[0]->file_name; ?>">制作部第二党支部</a>
			</div>
			<?php $sql="select file_name from smg_news where dept_category_id=258 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
			<div class="content" style="margin-top:155px;">
				<a href="<?php echo $news[0]->file_name; ?>">新进大学生</a>
			</div>
		</div>
		<div id="iright">
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=206 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=207 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=208 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=210 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=211 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=213 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=218 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=219 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=220 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=223 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=224 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=225 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=228 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=229 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=230 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=233 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=234 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=235 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=238 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=239 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=240 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=243 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=244 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=245 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
				<?php $sql="select file_name from smg_news where dept_category_id=248 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=249 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=250 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
					<?php $sql="select file_name from smg_news where dept_category_id=253 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
					<?php $sql="select file_name from smg_news where dept_category_id=254 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
					<?php $sql="select file_name from smg_news where dept_category_id=255 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
			<div class=content>
					<?php $sql="select file_name from smg_news where dept_category_id=259 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">正式党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=260 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">预备党员</a></div>
				<?php $sql="select file_name from smg_news where dept_category_id=261 and is_dept_adopt=1 order by dept_priority asc, created_at desc";
					$news=$db->query($sql);
		 ?>
				<div class=context><a href="<?php echo $news[0]->file_name; ?>">入党积极分子</a></div>
			</div>
		</div>
	</div>
</body>
</html>