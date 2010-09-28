<?
	require_once('../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项教育首页</title>
	<?php css_include_tag('zd','thickbox');
		use_jquery();
		js_include_once_tag('thickbox','total');
	?>
<script>
	total("专题-三项学习教育","news");
</script>
</head>
<body>
<div id=bodys>
	<div id=logo><embed src="/subject/sxxx2/sxxx.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="150"></embed></div>
	<div id=ileft>
		<div id=question>
			<?php 
				$db=get_db();
				if($_REQUEST['id']=="")
				{
					$zd_question=$db->query('select * from zd_question order by created_at desc limit 1');
				}
				else
				{
					$zd_question=$db->query('select * from zd_question where id='.$_REQUEST['id']);	
				}
			?>
			<input type="hidden" name="user_id" id="uid" value="<?php echo $_COOKIE['smg_user_id']; ?>">
			<div class=l_title>问题</div>
			<div id=q_title><?php echo $zd_question[0]->title; ?></div>
			<div id=q_createtime>问题发布时间：<?php echo $zd_question[0]->created_at; ?></div>
			<div id=q_content><?php echo $zd_question[0]->content; ?></div>
			<div id=q_publisher>提问者：<span style="color:#3333cc; text-decoration:underline;"><?php echo $zd_question[0]->publisher; ?></span></div>
			<div id=l_t_b>
				<div class=btn><a class=thickbox href="question.php?height=255&width=320">我要提问</a></div><?php if($_COOKIE['smg_user_id']==160){ ?><div class=btn><span id="show_index" style="cursor:pointer;">首页显示</span></div><?php } ?>
			</div>
		</div>
		<div id=answer>
			<div id=answer_name>姓名：　<input type="text" id="aname" name="aname" value="<?php echo $_COOKIE['smg_user_nickname']; ?>"></div>
			<div id=answer_content>内容：　<?php show_fckeditor('acontent','Admin',true,"160","","600");?></div>
			<input id="qid" type="hidden" value="<?php echo $zd_question[0]->id; ?>">
			<div id=answer_sub><button id="answersub" name="answersub"></button>　　<?php if($_COOKIE['smg_user_id']==""){ ?><a target="_blank" href="/login/login.php">登陆</a><?php } ?></div>
		</div>
		<?php 
			$answer=$db->query('select a.* from zd_answer a left join smg_user u on a.publisher=u.id where question_id='.$zd_question[0]->id.' order by u.zd_score desc, a.created_at desc'); 
			if(count($answer)>0){
		?>
			<div class=answer_result>
			<div class=l_title>积分最高回答</div>
			<div class=a_content><?php echo get_fck_content($answer[0]->content); ?></div>
			<div class=a_add>
				<button style="background:url('/images/zd/add1.jpg') no-repeat;" class="addbtn" param="1" param1="<?php echo $answer[0]->id;?>"></button>
				<button style="background:url('/images/zd/add5.jpg') no-repeat;" class="addbtn" param="5" param1="<?php echo $answer[0]->id; ?>"></button>
				<button style="background:url('/images/zd/add10.jpg') no-repeat;" class="addbtn" param="10" param1="<?php echo $answer[0]->id; ?>"></button>	
				回答者：<span style="color:#3333cc; text-decoration:underline;"><?php echo $answer[0]->publisher; ?></span> - <?php echo $answer[0]->created_at; ?>
			</div>
		</div>
		<?php 
		}
			if(count($answer)>1)
			{
			$answer1=$db->query('select * from zd_answer where question_id='.$zd_question[0]->id.' and id<>'.$answer[0]->id.' order by created_at desc');
			for($i=0;$i<count($answer1);$i++){
		?>
		<div class=answer_result>
			<div class=l_title>其他回答</div>
			<div class=a_content><?php echo get_fck_content($answer1[$i]->content); ?></div>
			<div class=a_add>
				<button style="background:url('/images/zd/add1.jpg') no-repeat;" class="addbtn" param="1" param1="<?php echo  $answer1[$i]->id; ?>" ></button>
				<button style="background:url('/images/zd/add5.jpg') no-repeat;" class="addbtn" param="5" param1="<?php echo  $answer1[$i]->id; ?>"></button>
				<button style="background:url('/images/zd/add10.jpg') no-repeat;" class="addbtn" param="10" param1="<?php echo  $answer1[$i]->id; ?>" ></button>	
				回答者：<span style="color:#3333cc; text-decoration:underline;"><?php echo $answer1[$i]->publisher; ?></span> - <?php echo $answer1[$i]->created_at; ?>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div id=iright>
		<div id=wdphb>
			<?php $phb=$db->query('select * from smg_user where id<>160 order by zd_score desc limit 8'); ?>
			<div class=r_title>积分排行榜</div>
			<div id=content>
				<div class=cl>
						<div class=cl_l>姓名</div>
						<div class=cl_r>积分</div>
					</div>
				<?php for($i=0;$i<count($phb);$i++){ ?>
					<div class=cl>
						<div class=cl_l><?php echo $phb[$i]->nick_name; ?></div>
						<div class=cl_r><?php echo $phb[$i]->zd_score; ?></div>
					</div>
				<?php } ?>	
			</div>
		</div>
		<div id=newlist>
			<?php $newquestion=$db->query('select * from zd_question where id<>'.$zd_question[0]->id.' order by created_at desc limit 29'); ?>
			<div class=r_title>最新问题</div>		
			<div id=content>
				<?php for($i=0;$i<count($newquestion);$i++){ ?>
					<div class=cl><a target="" href="index.php?id=<?php echo $newquestion[$i]->id; ?>"><?php echo $newquestion[$i]->title; ?></a></div>
				<?php } ?>	
			</div>
		</div>
	</div>	
</div>
</body>
</html>
<script>
	$(function(){
		$(".addbtn").click(function(){
			$.post('answer_info.post.php',{'type':$(this).attr('param'),'answer_id':$(this).attr('param1'),'user_id':$('#uid').val()},function(data){
					alert(data);
			});
		});
		$("#show_index").click(function(){
			$.post('showindex.post.php',{'id':$("#qid").val()},function(data){
				alert(data);
			});
		})
		$("#answersub").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('acontent');
			var content = oEditor.GetHTML();
			if(content=="")
			{
				alert('请输入回答内容！');
				return false;	
			}
			
			$.post('answer.post.php',{'qid':$("#qid").val(),'name':$("#aname").val(),'acontent':content},function(data){
				if(data=="OK")
				{
					window.location.reload();	
				}
				else
				{
					alert('回答失败,请联系管理员查看原因!');	
				}
			});
		});
	});
</script>
