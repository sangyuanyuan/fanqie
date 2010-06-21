<?php
	require_once('../../frame.php');
	include_once '../../lib/xspace_api.php';
	include_once '../../lib/uchome_api.php';
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_babyshowindex','top','bottom');
		use_jquery();
	  js_include_once_tag('total','babyshowindex');
  ?>
	
</head>
<script>
total("宝宝秀","show");
</script>
<body>
<div id="ibody">
	<div id="ileft_t">
		<?php 
				$images=$db->query('select * from smg_babyshow_photo order by created_at desc');
		?>
		<div id=pic>
			<a target="_blank" href=""><img src="<?php echo $images[0]->photo_src;?>"></a>	
		</div>
		<div id=content>
 <?php
 $articles=$db->query('select * from smg_babyshow_act order by created_at desc');
  for($i=0;$i<11;$i++){ ?>
			<div class=context><a target='_blank' href=''><?php echo $articles[$i]->title; ?></a></div>
			<?php } ?>
		</div>
	</div>
<form name="babylogin" id="babylogin" action="babyshow.login.php" method="post">
	<div id=login>
		<div id=username><input type="text" id=login_text name=login_text ></div>
		<div id=password><input type="password" id=password_text name=password_text></div>
		<div id=logins>
			<div id=sub></div>
			<div id=reg></div>
		</div>
		<input type="hidden" name="user_type" value="login">
	</div>
</form>
	<div id=iright_t>
				<?php 
		$blog=$db->query('select a.id as aid,a.title,p.id as pid,photo_src,p.user_id as puser,a.user_id as auser from smg_babyshow_act a,smg_babyshow_photo p order by p.created_at desc,a.created_at desc');
		 for($i=0;$i<11;$i++){ 
		 	if($blog[$i]->pid=="")
		 	{
		 	?>
				<div class=content><a href="person_index.php?id=<?php echo $blog[$i]->auser; ?>"><?php echo $blog[$i]->auser; ?></a>发表了<a href="">新日志</div>	
			<?php} } ?>
	</div>
	<div id=ileft_b>
			<?php for($i=1;$i<count($images);$i++){ ?>
				<div class=pic><a target="_blank" href="<?php echo $images[$i]->href.'>'.$images[$i]->subject; ?>"><img src="<?php echo $images[$i]->thumbpath;?>"></a></div>
			<?php } ?>
	</div>
	<div id=iright_b>
		<?php 

		for($i=0;$i<count($blog);$i++){ ?>
			<div class=pic><a target="_blank" href=""><img src="/ucenter/data/avatar/000/00/00/<?php echo $blog[$i]->uid; ?>_avatar_middle.jpg"></a></div>
		<?php } ?>	
	</div>
</div>
</body>
</html>