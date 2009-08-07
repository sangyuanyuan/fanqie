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
		js_include_tag('total');
    ?>
</head>
<script>
	total("婚庆报名","server");	
</script>
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
		<div class=l><img src="/images/news/news_sub_icon.jpg">　生日/生肖</div>
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
			<select id=zodiac name="marry[zodiac]">
				<option value="0">请选择</option>
				<option value="鼠">鼠</option>
				<option value="牛">牛</option>
				<option value="虎">虎</option>
				<option value="兔">兔</option>
				<option value="龙">龙</option>
				<option value="蛇">蛇</option>
				<option value="马">马</option>
				<option value="羊">羊</option>
				<option value="猴">猴</option>
				<option value="鸡">鸡</option>
				<option value="狗">狗</option>
				<option value="猪">猪</option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　身高/血型/星座</div>
		<div class=t_r>
			<select id=height name="marry[height]">
				<option value="0">请选择</option>
				<?php for($i=140;$i<230;$i++){
				?>
				<option value="<?php echo $i ?>"><?php echo $i;?>cm</option>
				<?php }  ?>
			</select>
			<select id=blood name="marry[blood]">
				<option value="0">请选择</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="AB">AB</option>
				<option value="O">O</option>
			</select>
			<select id=star name="marry[star]">
				<option value="白羊">白羊座</option>
				<option value="金牛">金牛座</option>
				<option value="双子">双子座</option>
				<option value="巨蟹">巨蟹座</option>
				<option value="狮子">狮子座</option>
				<option value="处女">处女座</option>
				<option value="天秤">天秤座</option>
				<option value="天蝎">天蝎座</option>
				<option value="射手">射手座</option>
				<option value="摩羯">摩羯座</option>
				<option value="水瓶">水瓶座</option>
				<option value="双鱼">双鱼座</option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　收入</div>
		<div class=t_r>
			<select id=star name="marry[income]">
				<option value="0">2000以下</option>
				<option value="1">2000-4000</option>
				<option value="2">4000-6000</option>
				<option value="3">6000-10000</option>
				<option value="4">10000-20000</option>
				<option value="5">20000以上</option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　选择图片</div>
		<div class=t_r>
			<input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input type="file" name="image" id="image" class="required">
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　联系方式</div>
		<div class=t_r><input type="text" name="marry[phone]"></div>
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
		<div class=l><img src="/images/news/news_sub_icon.jpg">　恋爱史</div>
		<div class=t_r><input type="text" name="marry[history]"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　择偶标准</div>
		<div id=m_r><textarea style="width:740px; height:30px; " name="marry[request]" class="required"></textarea></div>
	</div>
	<div id=b_button>
			<button id="button_submit">提　交</button>
	</div>
	</form>
</div>
<? require_once('../inc/bottom.inc.php');?>
</body>
</html>
<img id="test" src="about:blank">
<script>
	$(function(){
		
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
			
			if($("#blood").attr('value')=='0'){
				alert('请选择血型！');
				return false;
			}
			
			if($("#zodiac").attr('value')=='0'){
				alert('请选择生肖！');
				return false;
			}
			
			
			$("#marry").submit();
		});
		
	});
	
	
</script>