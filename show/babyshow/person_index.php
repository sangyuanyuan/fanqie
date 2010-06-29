<?php
	require_once('../../frame.php');
	$db = get_db();
	$id=urldecode($_REQUEST['id']);
	$cookie=$_COOKIE['smg_user_nickname'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_person','top','bottom');
		use_jquery();
	  js_include_once_tag('total','babyshowindex');
  ?>
	
</head>
<script>
total("宝宝秀","show");
</script>
<body>
	
	<div id=ibody>
		<?php require_once('person_head.php');
				$y2k = mktime(0,0,0,1,1,2020);
				@setcookie('babyshowid',$_REQUEST['id'],$y2k,'/');
				require_once('person_left.php');?>
		<div id=iright>
			<?php 
				$photo=$db->query('select * from smg_user where nick_name="'.$id.'"');
				if(count($photo)==0)
				{
					die('对不起番茄网没有该用户信息！');	
				}
				$act=$db->paginate('select a.id as aid,a.title,p.id as pid,photo_src,p.user_id as puser,a.user_id as auser from smg_babyshow_act a,smg_babyshow_photo p order by p.created_at desc,a.created_at desc',20);
				$friendact=$db->paginate('select a.id as aid,a.title,p.id as pid,photo_src,p.user_id as puser,a.user_id as auser from smg_babyshow_act a,smg_babyshow_photo p where (p.user_id in ('.$photo[0]->friend_id.') or a.user_id in ('.$photo[0]->friend_id.')) order by p.created_at desc,a.created_at desc',20);
			?>
			<div id=head_pic><img src="<?php if($photo[0]->head_photo!=""){echo $photo[0]->head_photo;}else{echo '/images/baby/noavatar_small.gif';} ?>"></div>
			<div id=head_pictitle><?php echo $photo[0]->nick_name; ?></div>
			<div class=head_cl><a id="addfriend" param=<?php echo $id; ?> href="#">加为好友</a></div><div class=head_cl><a href="person_info.php?id=<?php echo $_REQUEST['id']; ?>">个人资料</a></div>
			<div id=person_title><div class=alltitle param="friend" style="background:url('/images/baby/babyshow_title2.jpg') no-repeat;">好友的</div><div param="all" class=alltitle>大家的</div></div>
			<div class=allcontext id="friendcontent" style="display:none;">
				<?php for($i=0;$i<count($friendact);$i++){
					if($friendact[$i]->puser==""){	
				?>
					<div class=person_content>
						<?php echo $friendact[$i]->puser.'发表了';?><a target="_blank" href="person_content.php?id=<?php echo $friendact[$i]->aid; ?>&type=act">新日志</a>
					</div>
				<?PHP }else{?>
					<div class=person_content>
						<?php echo $friendact[$i]->puser.'发表了';?><a target="_blank" href="person_content.php?id=<?php echo $friendact[$i]->pid; ?>&type=photo">新照片</a>
					</div>
				<?php } } ?>
				<div id=page><?php paginate('');?></div>
			</div>
			<div class=allcontext id="allcontent">
				<?php for($i=0;$i<count($act);$i++){
					if($act[$i]->puser==""){	
				?>
					<div class=person_content>
						<?php echo $act[$i]->puser.'发表了';?><a target="_blank" href="person_content.php?id=<?php echo $act[$i]->aid; ?>&type=act">新日志</a>
					</div>
				<?PHP }else{?>
					<div class=person_content>
						<?php echo $act[$i]->puser.'发表了';?><a target="_blank" href="person_content.php?id=<?php echo $act[$i]->pid; ?>&type=photo">新照片</a>
					</div>
				<?php } } ?>
				<div id=page><?php paginate('');?></div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
		$(function(){
			$("#addfriend").click(function(){
				$.post("friend.post.php",{'id':$(this).attr('param')},function(data){
					if(data=="")
					{		
						alert('添加成功！');
					}else
					{
						alert('对方已经是你的好友请不要重复添加！');	
					}
				});
			});
			$(".alltitle").mouseover(function(){
				$(".alltitle").css('background',"url('/images/baby/babyshow_title2.jpg') no-repeat");
				$(this).css('background',"url('/images/baby/babyshow_title1.jpg') no-repeat");
				var stat=$(this).attr('param');
				$(".allcontext").css('display','none');
				$("#"+stat+"content").css('display','inline');
			});
		});
</script>