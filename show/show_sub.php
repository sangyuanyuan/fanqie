<?php
	require_once('../frame.php');
	$type = $_REQUEST['type'];
	if($type=='video'){
		$title = '上传视频';
	}else{
		$title = '上传图片';
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-我要上传</title>
	<?php
		css_include_tag('news_sub','top','bottom');
		use_jquery();
    ?>
</head>
<body>
<?php
	require_once('../inc/top.inc.html');
	validate_form("show");
?>
<div id=ibody>
	<form id="show" enctype="multipart/form-data" action="show.post.php" method="post">
	<div class=title><?php echo $title; ?></div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　部门</div>
		<div class=t_r>
			<select id=select name="show[dept_id]">
				<option>请选择</option>
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
		<div class=t_r><input type="text" name="show[publisher]" value="<?php echo $_COOKIE['smg_username'];?>" class="required"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　标题</div>
		<div class=t_r><input id="news_title" type="text" name="show[title]" class="required"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　内容</div>
		<div id=m_r><textarea style="width:740px; height:250px; " name="show[description]" class="required"></textarea></div>
	</div>
	<div class=title><?php echo $title; ?></div>
	<?php if($type=='video'){
	?>
	<input type="hidden" name="type" id="s_type" value="video">
	<input type="hidden" name="show[category_id]" value="<?php echo category_id_by_name('我要上传','video');?>">
	<div id=b>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　视频照片</div>
		<div class=t_r>
			<input type="file" name="image" id="image" class="required">(png,jpg,gif)
		</div>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　选择视频</div>
		<div class=t_r>
			<input type="file" name="video" id="video" class="required">(flv,wmv,wav,mp3,mp4,avi,rm)
		</div>
	</div>
	<?php }else{
	?>
	<input type="hidden" name="type" id="s_type" value="image">
	<input type="hidden" name="show[category_id]" value="<?php echo category_id_by_name('我要上传','picture'); ?>">
	<div id=b>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　选择图片</div>
		<div class=t_r>
			<input type="file" name="image" id="image" class="required">(png,jpg,gif)
		</div>
	</div>
	<?php } ?>
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
		if($("#s_type").val()=="image"){
			var upfile1 = $("#image").val();
			var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){
				alert("上传图片类型错误");
				return false;
			}
		}else{
			var upfile1 = $("#image").val();
			var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){
				alert("上传图片类型错误");
				return false;
			}
			var upfile2 = $("#video").val();
			upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
			if(upload_file_extension.toLowerCase()!=".flv"&&upload_file_extension.toLowerCase()!=".wmv"&&upload_file_extension.toLowerCase()!=".wav"&&upload_file_extension.toLowerCase()!=".mp3"&&upload_file_extension.toLowerCase()!=".mp4"&&upload_file_extension.toLowerCase()!=".avi"){
				upload_file_extension=upfile2.substring(upfile2.length-3,upfile2.length);
				if(upload_file_extension.toLowerCase()!=".rm"){
					alert("上传视频类型错误");
					return false;
				}
			}
		}
		$("#show").submit();
	});
</script>