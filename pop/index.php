<?php
	require_once('../frame.php');
  $db = get_db();
  if($_REQUEST['id']!="")
  {
  	$pop=$db->query('select * from smg_pop_task where id='.$_REQUEST['id']);
  }
  $cookie=$_COOKIE['smg_username'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<? 	
		css_include_tag('news_sub','top','bottom');
		use_jquery();
  ?>
	<title>SMG -弹出框管理</title>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<form id="news_add" name="news_add" enctype="multipart/form-data" action="pop.post.php" method="post">
	<div class=title>弹出框管理</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　类型</div>
		<div class=t_r>
			<select id=select name="pop[pop_type]">
				<option value="0">请选择</option>
				<option <?php if($pop[0]->pop_type=="news"){ ?>selected=selected<?php } ?> value=""></option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　高度</div>
		<div class=t_r><input type="text" name="pop[height]" value="<?php echo $pop[0]->height; ?>"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　宽度</div>
		<div class=t_r><input id="news_title" type="text" name="pop[width]" value="<?php echo $pop[0]->width; ?>"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　内容</div>
		<div id=m_r><?php show_fckeditor('pop[content]','Admin',true,"230",delhtml($pop[0]->content),"750");?></div>
	</div>
	<div id=b_button>
			<button id="button_submit">提　交</button>
	</div>
	</form>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	$(function(){
		$('#button_submit').click(function(){
			document.news_add.submit();
		});
	});
</script>