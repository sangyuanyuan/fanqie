<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-喜羊羊2-我要上传</title>
	<? 	
		css_include_tag('news_sub','top','bottom');
		use_jquery();
		js_include_once_tag('total');
  ?>
<script>
	total("喜羊羊2专题","show");
</script>	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<form id="news_add" name="news_add" enctype="multipart/form-data" action="xyy2.post.php" method="post">
	<div class=title>狼羊群</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　姓名</div>
		<div class=t_r><input type="text" name="images[publisher_id]" value="<?php echo $_COOKIE['smg_user_nickname'];?>"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　照片</div>
		<div class=t_r><input type="file" name="video_pic" id="video_pic">(png,jpg,gif)</div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　留言</div>
		<div id=m_r><textarea name="images[description]" style="width:750px; height:230px;"></textarea></div>
	</div>
	<div id=b_button>
			<input type="hidden" name="images[parent_id]" value="<?php echo $_REQUEST['id']; ?>">
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
			
			if($('#news_title').val() == ''){
				alert('请填写姓名!');
				return false;
			}
			var oEditor = FCKeditorAPI.GetInstance('news[content]');
			var content = oEditor.GetHTML();
			if(content ==''){
				alert('请填写留言!');
				return false;
			}
			if(content.length > 10000){
				alert('留言内容太长,请联系管理员');
				return false;
			}
			
			if($("#video_pic").val()!=""){
				var upfile1 = $("#video_pic").val();
				var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
				if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){
					alert("上传图片类型错误");
					return false;
				}
			}
			
			document.news_add.submit();
		});
	});
</script>