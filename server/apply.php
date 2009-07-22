<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-婚庆-我要报名</title>
	<?php
		css_include_tag('news_sub','top','bottom');
		use_jquery();
    ?>
</head>
<body>
<?php
	require_once('../inc/top.inc.html');
	validate_form("marry");
?>
<div id=ibody>
	<form id="marry" enctype="multipart/form-data" action="apply.post.php" method="post">
	<div class=title><?php echo $title; ?></div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　姓名</div>
		<div class=t_r><input type="text" name="marry[name]"  class="required"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　性别</div>
		<div class=t_r>
			<select id=sex name="marry[sex]">
				<option value="0">请选择</option>
				<option value="man">男</option>
				<option value="woman">女</option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　生日</div>
		<div class=t_r>
			<select id=year name="year">
				<option value="0">请选择</option>
				<?php for($i=1990;$i>1950;$i--){
				?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php }  ?>
			</select>
			<select id=month name="month">
				<option value="0">请选择</option>
				<?php for($i=1;$i<13;$i++){
				?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php }  ?>
			</select>
			<select id=day name="day">
				<option value="0">请选择</option>
				<?php for($i=1;$i<32;$i++){
				?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php }  ?>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　身高</div>
		<div class=t_r>
			<select id=height name="marry[height]">
				<option value="0">请选择</option>
				<?php for($i=140;$i<230;$i++){
				?>
				<option value="<?php echo $i ?>"><?php echo $i;?>cm</option>
				<?php }  ?>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　学历</div>
		<div class=t_r><input type="text" name="marry[education]"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　毕业学校</div>
		<div class=t_r><input type="text" name="marry[school]"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　职业</div>
		<div class=t_r><input type="text" name="marry[job]"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　收入</div>
		<div class=t_r><input type="text" name="marry[income]" ></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　恋爱史</div>
		<div class=t_r><input type="text" name="marry[history]"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　择偶标准</div>
		<div id=m_r><textarea style="width:740px; height:30px; " name="marry[request]" class="required"></textarea></div>
	</div>
	<div class=title><?php echo $title; ?></div>
	<div id=b>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　选择图片</div>
		<div class=t_r>
			<input type="file" name="image" id="image" class="required">
		</div>
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
	$("#button_submit").click(function(){
		if($("#sex").attr('value')=='0'){
			alert('请选择性别！');
			return false;
		}
		if($("#year").attr('value')=='0'){
			alert('请选择生日！');
			return false;
		}
		if($("#month").attr('value')=='0'){
			alert('请选择生日！');
			return false;
		}
		if($("#day").attr('value')=='0'){
			alert('请选择生日！');
			return false;
		}
		if($("#height").attr('value')=='0'){
			alert('请选择身高！');
			return false;
		}
		
		$("#marry").submit();
	});
</script>