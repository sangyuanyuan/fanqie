<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-我要报料</title>
	<? 	
		css_include_tag('news_sub','top','bottom');
		use_jquery();
		js_include_once_tag('total');
  ?>
<script>
	total("我要报料","news");
</script>	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<form id="news_add" name="news_add" enctype="multipart/form-data" action="news.post.php" method="post">
	<div class=title>我要报料</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　部门</div>
		<div class=t_r>
			<select id=select name="news[dept_id]">
				<option value="0">请选择</option>
				<?php 
				$sql="SELECT * FROM smg_dept";
				$db = get_db();
				$dept=$db->query($sql);
				for($i=0;$i<count($dept);$i++){ ?>
					<option <?php if($dept[$i]->id==$_COOKIE['smg_user_dept']){?>selected="selected"<?php } ?> value="<?php echo $dept[$i]->id;?>" ><?php echo $dept[$i]->name;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　姓名</div>
		<div class=t_r><input type="text" name="news[publisher_id]" value="<?php echo $_COOKIE['smg_user_nickname'];?>"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　标题</div>
		<div class=t_r><input id="news_title" type="text" name="news[title]"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　内容</div>
		<div id=m_r><?php show_fckeditor('news[content]','Admin',true,"270","","750");?></div>
	</div>
	<div class=title>视频上传(可选)</div>
	<div id=b>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　视频照片</div>
		<div class=t_r>
			<input type="file" name="video_pic" id="video_pic">(png,jpg,gif)
		</div>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　选择视频</div>
		<div class=t_r>
			<input type="file" name="video_src" id="video_src">(flv,wmv,wav,mp3,mp4,avi,rm)
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
	$(function(){
		$('#button_submit').click(function(){
			if($('#news_title').val() == ''){
				alert('请填写新闻标题!');
				return false;
			}
			var oEditor = FCKeditorAPI.GetInstance('news[content]');
			if(oEditor.GetHTML()==''){
				alert('请填写新闻内容!');
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
			
			if($("#video_src").val()!=""){
				var upfile2 = $("#video_src").val();
				upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
				if(upload_file_extension.toLowerCase()!=".flv"&&upload_file_extension.toLowerCase()!=".wmv"&&upload_file_extension.toLowerCase()!=".wav"&&upload_file_extension.toLowerCase()!=".mp3"&&upload_file_extension.toLowerCase()!=".mp4"&&upload_file_extension.toLowerCase()!=".avi"){
					upload_file_extension=upfile2.substring(upfile2.length-3,upfile2.length);
					if(upload_file_extension.toLowerCase()!=".rm"){
						alert("上传视频类型错误");
						return false;
					}
				}
			}
			
			if($("#video_pic").val()==""&&$("#video_src").val()!=""){
				alert("请上传图片！");
				return false;
			}
			
			if($("#video_pic").val()!=""&&$("#video_src").val()==""){
				alert("请上传视频！");
				return false;
			}
			
			if($("#select").val()==0){
				alert("请选择部门！");
				return false;
			}
			document.news_add.submit();
		});
	});
</script>